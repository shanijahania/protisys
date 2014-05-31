<?php

class Member_meta_model extends MY_Model {

	protected $_table = 'member_meta';
	protected $primary_key = 'meta_id';

	public function member_meta_info()
    {

        $this->db->select('*');
        return $this;
    }

}
?>