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
        $start      = $params['start'];
        $end        = $params['end'];
        $c_status   = $params['c_status'];

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

        if($c_status == 'paid')
        {
            $this->db->where('comm_status',1);
        }
        elseif($c_status == 'pending')
        {
            $this->db->where('comm_status',0);
        }

        if($start && $end)
        {
        	$this->db->where("created_at BETWEEN '$start' AND '$end'");
        }

        if($this->admin_session->userdata['admin']['access'] != 'super_admin')
        {
            $this->db->where('u_id', $this->admin_session->userdata['admin']['user_id']);
        }

        $this->db->join('users as u', 'u.user_id = u_id');
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
        $u_type     = $params['u_type'];
        $start      = $params['start'];
        $end        = $params['end'];
        $c_status   = $params['c_status'];
        
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

        if($c_status == 'paid')
        {
            $this->db->where('comm_status',1);
        }
        elseif($c_status == 'pending')
        {
            $this->db->where('comm_status',0);
        }

        if($start && $end)
        {
        	$this->db->where("created_at BETWEEN '$start' AND '$end'");
        }

        if($this->admin_session->userdata['admin']['access'] != 'super_admin')
        {
            $this->db->where('u_id', $this->admin_session->userdata['admin']['user_id']);
        }

        $this->db->join('users as u', 'u.user_id = u_id');

        $count = parent::count_by();

        return $count;
    }
    function total_commission($type)
    {
        if($type != 'all')
        {
            if($type == 'paid')
            {
                $this->db->where('comm_status', 1);    
            }
            else
            {
                $this->db->where('comm_status', 0);    
            }
        }

        if($this->admin_session->userdata['admin']['access'] != 'super_admin')
        {
            $this->db->where('u_id', $this->admin_session->userdata['admin']['user_id']);
        }

        $this->db->select_sum('ord_commission');
        return $this;
    }
}
?>