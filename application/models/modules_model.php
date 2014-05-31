<?php

class Modules_model extends MY_Model {

	protected $_table = 'modules';
	protected $primary_key = 'id_module';

	public function modules_info()
    {

        $this->db->select('*');
        return $this;
    }

}
?>