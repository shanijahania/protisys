<?php

class Products_model extends MY_Model {

	protected $_table = 'ps_products';
	protected $primary_key = 'product_id';

	public function products_info($params)
    {

        $this->db->select('*');
        $limit      = $params['limit'];
        $per_page   = $params['per_page'];
        $str        = $params['str'];
        $sort_by    = $params['sort_by'];
        $sort_column= $params['sort_column'];

        if($str)
        {
            $this->db->like('product_name', $str);
        }

        $this->db->order_by($sort_column, $sort_by);
        $this->db->limit($per_page,$limit);
        
        return $this;
    }

    public function product_total($params)
    {
        $limit      = $params['limit'];
        $per_page   = $params['per_page'];
        $str        = $params['str'];
        $sort_by    = $params['sort_by'];
        $sort_column= $params['sort_column'];

        if($str)
        {
            $this->db->like('product_name', $str);
        }

        $count = $this->db->count_all_results($this->db->dbprefix('products'));

        return $count;
    }
}
?>