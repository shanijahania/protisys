<?php

class Order_status_model extends MY_Model {

	protected $_table = 'ps_order_status';
	protected $primary_key = 'order_status_id';

	public function order_status_info()
    {
        $this->db->select('*');

        return $this;
    }

}
?>