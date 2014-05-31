<?php

class Permissions_model extends MY_Model {

	protected $_table = 'permissions';
	protected $primary_key = 'id_permission';

	public function permissions_info()
    {

        $this->db->select('*');
        return $this;
    }

    public function getPermissionsByUser($user_id)
    {

        $this->db->join('modules', 'modules.id_module = permissions.modules_id');
        $this->db->select('*');
        return $this;
    }

    public function delete_by_user($user_id)
    {
        $this->db->delete('mytable', array('id' => $id));
    }
}
?>