<?php

class Order_products_model extends MY_Model {

	protected $_table = 'order_products';
	protected $primary_key = 'order_products_id';

	public $belongs_to = array( 'orders' );
	public function order_products_info()
    {
        $this->db->join('tb_product', 'tb_product.product_id = ps_order_products.product_id');
        $this->db->join('tb_order', 'tb_order.order_id = ps_order_products.order_id');

        $this->db->select('*');

        return $this;
    }

}
?>