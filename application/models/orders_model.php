<?php

class Orders_model extends MY_Model {

	protected $_table = 'ps_orders';
	protected $primary_key = 'order_id';

    public $belongs_to = array( 'user' );
    public $has_many = array( 'order_products' );

	public function orders_info($params)
    {
    	$limit      = $params['limit'];
        $per_page   = $params['per_page'];
        $str        = $params['str'];
        $sort_by    = $params['sort_by'];
        $sort_column= $params['sort_column'];
        $access     = $params['access'];
        $uid        = $params['uid'];

        if($params['is_complete'])
        {
            $is_checkout = 1;
        }
        else
        {
            $is_checkout = 0;
        }
        if($str)
        {
            $this->db->like('orders.first_name', $str);
            $this->db->or_like('orders.email', $str);
            $this->db->or_like('orders.phone', $str);
            $this->db->or_like('orders.postcode', $str);
            $this->db->or_like('orders.address', $str);
        }
        if($uid)
        {
            $this->db->where('orders.user_id', $uid);
            if(@$params['ids_users']):
                foreach($params['ids_users'] as $u)
                {
                    $this->db->or_where_in('orders.user_id',$u);                    
                }
            endif;
        }
        if($is_checkout)
        {
            $this->db->where('is_checkout', 1);            
        }
        $this->db->join('order_products as op', 'op.order_id = orders.order_id');
        $this->db->limit($per_page,$limit);
        $this->db->group_by('orders.order_id');
        $this->db->order_by("orders.".$sort_column, $sort_by);
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
        $access     = $params['access'];
        $uid        = $params['uid'];
        
        if($str)
        {
            $this->db->like('orders.first_name', $str);
            $this->db->or_like('orders.email', $str);
            $this->db->or_like('orders.phone', $str);
            $this->db->or_like('orders.postcode', $str);
            $this->db->or_like('orders.address', $str);
        }

        if($uid)
        {
            $this->db->where('orders.user_id',$uid);

            if(@$params['ids_users']):
                foreach($params['ids_users'] as $u)
                {
                    $this->db->or_where_in('orders.user_id',$u);                    
                }
            endif;

        }

        $count = $this->db->count_all_results($this->db->dbprefix('orders'));

        return $count;
    }
    function GerOrderById($id)
    {
    	$this->db->where('orders.order_id', $id);
        $this->db->join('order_products as op', 'op.order_id = orders.order_id');
    	$this->db->select('
    		orders.order_id as id,
    		orders.first_name as customer_name,
    		orders.surname as customer_surname,
    		orders.email as customer_email,
    		orders.phone as customer_phone,
    		orders.postcode as customer_postcode,
    		orders.address as customer_address,
    		orders.created_at as created,
    		orders.modified_at as modified,
    		orders.is_active as active,
    		orders.status as status,
    		op.order_product_id as product_id,
 			op.p_name,
 			op.p_price,
    		');
    	return $this;

    }

    function totalSales()
    {
        $uid = $this->admin_session->userdata['admin']['user_id'];
        if($this->admin_session->userdata['admin']['access'] != 'super_admin' && $this->admin_session->userdata['admin']['access'] == 'salesperson')
        {
            $getPartnerID = $this->getPartnerID(array('parent_id' => $uid));
            
            $this->db->where('user_id',$uid);
                $ids_users = array();
                if(!empty($getPartnerID)):
                    foreach ($getPartnerID as $key => $value) 
                    {
                        $this->db->or_where_in('user_id',$value->user_id); 
                    }
                endif;

        }
        else
        {
            $this->db->where('user_id',$uid);
        }

        $this->db->select('SUM(total_amount) as total');
        $this->db->from('orders as o');

        $result = $this->db->get();
        
        return $result->row()->total;
    }

    function getPartnerID($array)
    {
        $this->db->select('user_id')
                ->from('users');
        $this->db->where($array);
        $result = $this->db->get();

        return $result->result();   
    }

    function count_by()
    {

        $uid = $this->admin_session->userdata['admin']['user_id'];
        if($this->admin_session->userdata['admin']['access'] != 'super_admin' && $this->admin_session->userdata['admin']['access'] == 'salesperson')
        {
            $getPartnerID = $this->getPartnerID(array('parent_id' => $uid));
            
            $this->db->where('user_id',$uid);
                $ids_users = array();
                if(!empty($getPartnerID)):
                    foreach ($getPartnerID as $key => $value) 
                    {
                        $this->db->or_where_in('user_id',$value->user_id); 
                    }
                endif;

        }
        else
        {
            $this->db->where('user_id',$uid);
        }

        return parent::count_by();
    }
}
?>