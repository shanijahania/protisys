<?php

class Order_commision_model extends MY_Model {

	protected $_table = 'commission';
	protected $primary_key = 'c_id';

	public function commission_info()
    {
        $this->db->select('*');

        return $this;
    }

}
?>