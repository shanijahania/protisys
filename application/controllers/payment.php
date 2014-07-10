<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Payment extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('payment_model', 'payment');
        $this->load->model('orders_model');
        $this->load->model('products_model');
        $this->load->model('order_products_model');
        $this->load->model('users_model');
        $this->load->model('order_commision_model');
        $this->load->model('order_status_model');
        $this->load->helper('form');
    }
    function index()
    {
        $data = array();
        $this->load->view('payment/form', $data);
    }
    function checkout($order_id = false)
    {   
        // echo "You are redirecting to Paypal, Please wait....";
        /*
        // get order data
        */
        $order_data         = $this->orders_model->get($order_id);
        $order_products     = $this->order_products_model->get_many_by('order_id', $order_id);
        $order_commission   = $this->order_commision_model->get_many_by('ord_id', $order_id);

        $this->payment->amount = $order_data->total_amount;
        $this->payment->currency = 'USD';
        $quantity       = $order_data->total_qty;
        $product_name   = $order_products[0]->p_name;
        $product_price  = $order_products[0]->p_price;

        $this->load->library('paypallib');
        $requestParams = array(
            'RETURNURL' => base_url('payment/consolidate/'.$order_id),
            'CANCELURL' => base_url('payment/cancelled'.$order_id)
        );
        $orderParams   = array(
            'PAYMENTREQUEST_0_AMT' => $this->payment->amount,
            'PAYMENTREQUEST_0_SHIPPINGAMT' => '0',
            'PAYMENTREQUEST_0_CURRENCYCODE' => $this->payment->currency,
            'PAYMENTREQUEST_0_ITEMAMT' => $this->payment->amount
        );
        $item          = array(
            'L_PAYMENTREQUEST_0_NAME0'  => $product_name,
            'L_PAYMENTREQUEST_0_DESC0'  => $product_name,
            'L_PAYMENTREQUEST_0_AMT0'   => $product_price,
            'L_PAYMENTREQUEST_0_QTY0'   => $quantity
        );
        $paypal        = $this->paypallib;
        $response      = $paypal->request('SetExpressCheckout', $requestParams + $orderParams + $item);

        if (is_array($response) && $response['ACK'] == 'Success')
        {
            $token                  = $response['TOKEN'];
            $this->payment->token   = $token;
            $this->payment->ACK     = $response['ACK'];
            $this->payment->order_id= $order_id;
            $this->payment->save();
            if ($paypal->is_sandbox)
            {
                redirect('https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=' . urlencode($token), 'refresh');
            }
            else
            {
                echo 'https://www.paypal.com/webscr?cmd=_express-checkout&token=' . urlencode($token);
            }
        }
        else
        {
            echo "<pre>";
            print_r($response);
            echo "</pre>";

            return false;
        }
    }
    function consolidate($order_id = false)
    {

        if ($this->input->get('token')) // Token parameter exists
        {
            // Get checkout details, including buyer information.
            // We can save it for future reference or cross-check with the data we have

            $this->load->model('payment_model', 'payment');
            $payment             = $this->payment->get_by_token($this->input->get('token'));
            $payment['payer_id'] = $this->input->get('PayerID');
            $this->load->library('paypallib');
            $paypal          = $this->paypallib;
            $checkoutDetails = $paypal->request('GetExpressCheckoutDetails', array(
                'TOKEN' => $this->input->get('token')
            ));
            // Complete the checkout transaction
            $requestParams   = array(
                'TOKEN' => $this->input->get('token'),
                'PAYMENTACTION' => 'Sale',
                'PAYERID' => $this->input->get('PayerID'),
                'PAYMENTREQUEST_0_AMT' => $checkoutDetails['PAYMENTREQUEST_0_AMT'], // Same amount as in the original request
                'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD' // Same currency as the original request
            );
            $response        = $paypal->request('DoExpressCheckoutPayment', $requestParams);
            if (is_array($response) && $response['ACK'] == 'Success') // Payment successful
            {
                $payment['checkout_status'] = $checkoutDetails['CHECKOUTSTATUS'];
                $payment['status_change']   = $checkoutDetails['TIMESTAMP'];
                $payment['transaction_id']  = $response['PAYMENTINFO_0_TRANSACTIONID'];

                $this->payment->token       = $this->input->get('token');
                $this->payment->token       = $order_id;
                $this->payment->save($payment);
                $this->payment->save($payment);
                //print_r($response);
            }
            redirect('payment/success/'.$order_id);
        }
    }
    function success($order_id = false)
    {

        $data = array();
        $data['page_title'] = 'Payment Success';
        $data['heading'] = 'Payment Success';

        // remove junk rows from payment table
        // $delete_where = array('order_id' => '0', 'payer_id' => '', 'transaction_id' => '');
        $deleted_rows = $this->payment->delete_null_rows();

        if($order_id)
        {
            $update = array('is_checkout' => 1);
            $update_order = $this->orders_model->update($order_id, $update);
        }
        $data['payment'] = $this->payment->get_last_payment();

        $data['main'] = 'admin/payment/success';
        $this->load->view('admin/template/layout',$data);
    }
    function cancelled($order_id)
    {
        $data = array();
        $this->lang->load('register');
        if ($this->input->get('token')) // Token parameter exists
        {
            if ($payment = $this->payment->get_by_token($this->input->get('token')))
            {
                $data['error']  = 'Der Zahlungsvorgang wurde abgebrochen.';
                $data['amount'] = $payment['amount'];
            }
        }
        $this->load->view('payment/form', $data);
    }
    function error()
    {
        echo 'oops!';
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */