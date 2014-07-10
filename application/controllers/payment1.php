<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Payment1 extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
    $this->load->helper('form');
	}
	
	
	function index()
	{
	
	  $data = array();	
	  $this->load->view('payment/form', $data);

	}
  
  


	function checkout()
	{

    $this->load->model('payment_model', 'payment');

    if(
      $this->input->post('payment-amount')
      && $this->input->post('payment-amount') > 39
    )
      $this->payment->amount = $this->input->post('payment-amount');
    else
      $this->payment->amount = 80;

    
    $this->payment->currency = 'CHF';  
  
  
    $this->load->library('paypallib');
  
    $requestParams = array(
       'RETURNURL' => base_url('payment/consolidate'),
       'CANCELURL' => base_url('payment/cancelled')
    );
    
    $orderParams = array(
       'PAYMENTREQUEST_0_AMT' => $this->payment->amount,
       'PAYMENTREQUEST_0_SHIPPINGAMT' => '0',
       'PAYMENTREQUEST_0_CURRENCYCODE' => $this->payment->currency,
       'PAYMENTREQUEST_0_ITEMAMT' => $this->payment->amount
    );
    
    $item = array(
       'L_PAYMENTREQUEST_0_NAME0' => 'Hochzeitswebseite',
       'L_PAYMENTREQUEST_0_DESC0' => 'Crazy In Love',
       'L_PAYMENTREQUEST_0_AMT0' => $this->payment->amount,
       'L_PAYMENTREQUEST_0_QTY0' => '1'
    );


	  
		$paypal = $this->paypallib;
    $response = $paypal->request('SetExpressCheckout',$requestParams + $orderParams + $item);
    


	
    if(is_array($response) && $response['ACK'] == 'Success')
    { //Request successful
    
      $token = $response['TOKEN'];
      //die(print_r($response));
    
      // Save Payment Infos in Databank

      $this->payment->token = $token;
      $this->payment->ACK = $response['ACK'];

      $this->payment->save();
      
     
      if($paypal->is_sandbox)
        redirect('https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=' . urlencode($token), 'refresh');
      else
        echo 'https://www.paypal.com/webscr?cmd=_express-checkout&token=' . urlencode($token) ;
      
      
    }
    else return false;
		
	}
	
	
	
	function consolidate()
	{
	
	
    if( $this->input->get('token') ) { // Token parameter exists
       // Get checkout details, including buyer information.
       // We can save it for future reference or cross-check with the data we have
       
       $this->load->model('payment_model', 'payment');
       
       $payment = $this->payment->get_by_token($this->input->get('token'));
        
       $payment['payer_id'] = $this->input->get('PayerID');
       
       
       $this->load->library('paypallib');
       $paypal = $this->paypallib;
       
       $checkoutDetails = $paypal->request('GetExpressCheckoutDetails', array('TOKEN' => $this->input->get('token')));
    
       // Complete the checkout transaction
       $requestParams = array(
           'TOKEN' => $this->input->get('token'),
           'PAYMENTACTION' => 'Sale',
           'PAYERID' => $this->input->get('PayerID'),
           'PAYMENTREQUEST_0_AMT' => $checkoutDetails['PAYMENTREQUEST_0_AMT'], // Same amount as in the original request
           'PAYMENTREQUEST_0_CURRENCYCODE' => 'CHF' // Same currency as the original request
       );
       

    
       $response = $paypal -> request('DoExpressCheckoutPayment',$requestParams);
       if( is_array($response) && $response['ACK'] == 'Success') { // Payment successful
       
       
         $payment['checkout_status'] = $checkoutDetails['CHECKOUTSTATUS'];
         $payment['status_change'] = $checkoutDetails['TIMESTAMP'];
         $payment['transaction_id'] = $response['PAYMENTINFO_0_TRANSACTIONID']; 
         $this->payment->token = $this->input->get('token');
         $this->payment->save($payment);
         
         
         $this->payment->save($payment);
         //print_r($response);
         
         
         
       }
       
       redirect('payment/success');
          
    }
    	
	
	
	}
	
	function success()
	{
	
	  $data = array();
	  
    $this->load->model('payment_model', 'payment');
	  $data['payment'] = $this->payment->get_last_payment();
		
		
	  $this->load->view('payment/success', $data);
	
	}
	
	
	
	
	function cancelled()
	{
	
	
	  $data = array();
		$this->lang->load('register');	
		
		

	
	  
	  
    if( $this->input->get('token')) { // Token parameter exists
    
      $this->load->model('payment_model', 'payment');
       
      
      
      if($payment = $this->payment->get_by_token($this->input->get('token')))
      {
        $data['error'] = 'Der Zahlungsvorgang wurde abgebrochen.';
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