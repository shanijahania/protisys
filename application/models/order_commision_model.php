<?php

class Order_commision_model extends MY_Model {

	protected $_table = 'commission';
	protected $primary_key = 'c_id';

	public function orders_info($params)
    {
    	$limit      = $params['limit'];
        $per_page   = $params['per_page'];
        $str        = $params['str'];
        $sort_by    = $params['sort_by'];
        $sort_column= $params['sort_column'];
        $uid        = $params['uid'];
        $u_type		= $params['u_type'];
         
        if($str)
        {
        	$this->db->like('username', $str);	
        }  
        
        if($uid)
        {
            $this->db->where('u_id', $uid);
        }

        if($u_type)
        {
        	$this->db->where('access',$u_type);
        }

        $this->db->join('users as u', 'u.id_users = u_id');
        $this->db->limit($per_page,$limit);
        $this->db->select('*');

        return $this;
    }
    public function orders_total($params)
    {
        $limit      = $params['limit'];
        $per_page   = $params['per_page'];
        $str        = $params['str'];
        $sort_by    = $params['sort_by'];
        $sort_column= $params['sort_column'];
        $uid        = $params['uid'];
        
        if($str)
        {
        	$this->db->like('username', $str);	
        }  

        if($uid)
        {
            $this->db->where('u_id', $uid);
        }

        $this->db->join('users as u', 'u.id_users = u_id');

        $count = parent::count_by();

        return $count;
    }

}
?>