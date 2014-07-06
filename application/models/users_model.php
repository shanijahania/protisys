<?php

class Users_model extends MY_Model {

	protected $_table = 'users';
	protected $primary_key = 'user_id';

	public function users_info($params)
    {

        $limit      = $params['limit'];
        $per_page   = $params['per_page'];
        $str        = $params['str'];
        $sort_by    = $params['sort_by'];
        $sort_column= $params['sort_column'];
        $access     = $params['access'];

        $this->db->where('access', $access);

        if($str)
        {
            $this->db->like('name', $str);
            $this->db->or_like('surname', $str);
            $this->db->or_like('username', $str);
            $this->db->or_like('email', $str);
        }
        if ($params['parent_id'] != '') 
        {
            $this->db->where('parent_id',$params['parent_id']);
        }

        $this->db->order_by($sort_column, $sort_by);
        $this->db->limit($per_page,$limit);
        $this->db->select('*');
        return $this;
    }
    public function users_total($params)
    {
        $limit      = $params['limit'];
        $per_page   = $params['per_page'];
        $str        = $params['str'];
        $sort_by    = $params['sort_by'];
        $sort_column= $params['sort_column'];
        $access     = $params['access'];

        $this->db->where('access', $access);
        
        if($str)
        {
            $this->db->like('name', $str);
            $this->db->or_like('surname', $str);
            $this->db->or_like('username', $str);
            $this->db->or_like('email', $str);
        }
        if ($params['parent_id'] != '') 
        {
            $this->db->where('parent_id',$params['parent_id']);
        }
        $count = $this->db->count_all_results($this->db->dbprefix('users'));

        return $count;
    }
    public function unique_email($email){

    	$this->db->where('email', $email);
    	$count = $this->db->get($this->_table)->num_rows();
    	return $count;
    }

    public function get_users($type = false){

    	$access = array('admin', 'member');
    	if($type && in_array($type, $access))
    	{
    		$this->db->where('access' , $type);
    	}
    	$this->db->select('*');
        return $this;
    }
}
?>