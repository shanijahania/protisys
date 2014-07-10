<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Payment_model
 *
 * @author Pierre Berchtold <pierre.berchtold@gmail.com>
 * @copyright Copyright (c) 11 October 2012, Berchtold Pierre
 * @version 1.0
 * @since 1.0
 *
 * 
 **/
class Payment_model extends MY_Model
{
    var $id = 0;
    var $token = NULL;
    var $amount = 0;
    var $currency = 'USD';
    var $checkout_status = NULL;
    var $status_change = NULL;
    var $payer_id = NULL;
    var $transaction_id = NULL;
    var $ACK = NULL;
    var $created_at = '';
    var $updated_at = '';
    var $status = 0;
    function __construct()
    {
        parent::__construct();
    }
    function get_last_payment()
    {
        $this->db->where('status', 1);
        $this->db->order_by('updated_at', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('payments');
        return $query->row_array();
    }
    function get_by_token($token = 0)
    {
        if ($token)
        {
            $this->db->where('token', $token);
            $this->db->where('status', 1);
            $query = $this->db->get('payments');
            return $query->row_array();
        }
        return NULL;
    }
    function save($payment = array())
    {
        // get old version
        $this->db->where('token', $this->token);
        $query       = $this->db->get('payments');
        $old_payment = $query->row_array();
        $new_payment = $old_payment;
        if ($old_payment != array())
        {
            $this->db->where('token', $this->token);
            $this->db->where('status', 1);
            $this->db->set('status', 2);
            $this->db->update('payments');
            foreach ($payment as $key => $value)
            {
                $new_payment[$key] = $value;
            }
            unset($new_payment['id']);
            $new_payment['status']     = 1;
            $new_payment['updated_at'] = date('Y-m-d H:i:s');
            $this->db->set($new_payment);
            $this->db->insert('payments');
            return $this->db->insert_id();
        }
        else
        {
            $this->created_at = date('Y-m-d H:i:s');
            $this->updated_at = date('Y-m-d H:i:s');
            $this->status     = 1;
            echo "<pre>";
            print_r($this); die();
            $this->db->set($this);
            $this->db->insert('payments');
            return $this->db->insert_id();
        }
    }
}
	
