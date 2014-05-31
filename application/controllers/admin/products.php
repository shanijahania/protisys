<?php

class Products extends Admin_Controller {

	var $date;
	function __construct()
	{
		parent::__construct();
		$this->load->model('products_model');
		$this->date = date('Y-m-d H:i:s');
	}

	function index()
	{
		$data = array();

		$data['page_title'] = 'All products | Point-s';
		$data['heading'] = 'Products';

		$fields = array(
			'product_name' 				=> 'Product Name'
			);
		$data['fields'] = $fields;

		$str 			= "";
		$per_page 		= '20';
		$limit 			= 0;
		$sort_by		= "asc";
		$sort_column	= "product_id";
		// advanced search paramaters
		if(isset($_GET['s']) && $_GET['s'] !='')
		{
			$str = $_GET['s'];
			$uri_string = 'admin/products?s='.$_GET['s'];
		}
		else
		{
			$uri_string = 'admin/products?s='.$str;
		}

		if(isset($_GET['per_page']) && $_GET['per_page'] !='')
		{
			$limit = $_GET['per_page'];
		}
		if(isset($_GET['sort_by']) && $_GET['sort_by'] !='')
		{
			$sort_by = $_GET['sort_by'];
			$uri_string .= "&sort_by=".$sort_by;
		}
		if(isset($_GET['sort_column']) && $_GET['sort_column'] !='')
		{
			$sort_column = $_GET['sort_column'];
			$uri_string .= "&sort_column=".$sort_column;
		}

		$data['s'] = $str;

		$post_params = array();
		$post_params['limit'] 		= $limit;
		$post_params['per_page'] 	= $per_page;
		$post_params['str'] 		= $str;
		$post_params['sort_column'] = $sort_column;
		$post_params['sort_by'] 	= $sort_by;
		$post_params['fields'] 		= $fields;

		// pagination code goes here
		
		$base_url 	= base_url($uri_string);
		$product_total = $this->products_model->product_total($post_params);
		
		$config['base_url'] 			= $base_url;
		$config['total_rows'] 			= $product_total;
		$config['per_page'] 			= $per_page; 
		$config['page_query_string'] 	= TRUE;

		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();
		$data['pagination'] = $pagination;

		$products_records = $this->products_model->products_info($post_params)->get_all();

		$data['uri_string'] = $uri_string;
		$data['products_records'] = $products_records;
		$data['sort_by'] 		= $sort_by;
		$data['sort_column'] 	= $sort_column;

	    $data['main'] = 'admin/products/products_list';
	    $data['js_function'] = array('products_list');
		$this->load->view('admin/template/layout',$data);
	}

	function add_products()
	{
		$data = array();

		$data['page_title'] = 'Add products | Point-s';
		$data['heading'] = 'Add Products';

		$this->load->library('form_validation');
		$this->form_validation->set_rules('p_name', 'Product Name', 'trim|required');
		$this->form_validation->set_rules('p_price', 'Product Price', 'trim|required|numeric');
		$this->form_validation->set_rules('p_desc', 'Description', 'trim|required');
		$this->form_validation->set_rules('is_active', 'Is Active', 'trim');
		

		if($this->form_validation->run() == TRUE)
	    {
	    	$p_name		= $this->input->post('p_name');
			$price 		= $this->input->post('p_price');
			$desc 		= $this->input->post('p_desc');
			$is_active 	= $this->input->post('is_active');
			


	    	$data = array(
	    				'product_name'	=>$p_name,
	    				'product_desc'	=>$desc,
	    				'product_price'	=>$price,
	    				'created_at'	=>$this->date,
	    				'modified_at'	=>$this->date,
	    				'is_active'		=>$is_active
	    				);

	    	// echo "<pre>";
	    	// print_r($this->input->post());die();

	    	if($this->products_model->insert($data))
			{
				$this->session->set_flashdata('success', 'The products info have been successfully added');
				redirect('admin/products/add_products');
			}
			else
			{
				$this->session->set_flashdata('error', 'Error. Please try again.');
				redirect('admin/products/add_products');
			}
	    }
	    else //if page initial load or form validation false
	    {
	    	$data['main'] = 'admin/products/add_products';

			$this->load->view('admin/template/layout',$data);
	    }
	}

	function edit_products()
	{
		$data = array();
		$data['page_title'] = 'Edit product | Point-s';
		$data['heading'] = 'Edit Product';

		$this->load->library('form_validation');
		$this->form_validation->set_rules('p_name', 'Product Name', 'trim|required');
		$this->form_validation->set_rules('p_price', 'Product Price', 'trim|required|numeric');
		$this->form_validation->set_rules('p_desc', 'Description', 'trim|required');
		$this->form_validation->set_rules('is_active', 'Is Active', 'trim');		

		if($this->form_validation->run() == TRUE)
	    {
	    	$hash_products_id = $this->input->post('products_id');

	    	//check hash if the user edit it

	    	$products_id = $this->input->post('products_id');
	    	$hash = get_attr_hash($hash_products_id);

	    	// $this->permission->check_form_id_hash($products_id,$hash);

	    	$p_name		= $this->input->post('p_name');
			$price 		= $this->input->post('p_price');
			$desc 		= $this->input->post('p_desc');
			$is_active 	= $this->input->post('is_active');
			


	    	$data = array(
	    				'product_name'	=>$p_name,
	    				'product_desc'	=>$desc,
	    				'product_price'	=>$price,
	    				'modified_at'	=>$this->date,
	    				'is_active'		=>$is_active
	    				);

	    	if($this->products_model->update($products_id,$data))
			{
				$this->session->set_flashdata('success', 'The products info have been successfully updated');
				redirect("admin/products/edit_products/$products_id/$hash");
			}
			else
			{
				$this->session->set_flashdata('error', 'Error. Please try again.');
				redirect("admin/products/edit_products/$products_id/$hash");
			}
	    }
	    else //if page initial load or form validation false
	    {
	    	$products_id = $this->uri->segment(4);

	    	//means come from validation error

	    	if($this->input->post('products_id'))
	    	{
	    		$hash_products_id = $this->input->post('products_id');

		    	//check hash if the user edit it

		    	$products_id = $this->input->post('products_id');
		    	$hash = get_attr_hash($hash_products_id);

		    	// $this->permission->check_form_id_hash($products_id,$hash);
	    	}			

	    	$products_records = $this->products_model->get($products_id);

	    	$data['products_records'] = $products_records;

	    	$data['main'] = 'admin/products/edit_products';

			$this->load->view('admin/template/layout',$data);
	    }
	}

	function show_product(){

		$data = array();
		$data['page_title'] = 'View Product | Point-s';
		$data['heading'] = 'Product View';
		
		$hash_users_id = $this->uri->segment(4);

    	//check hash if the user edit it
    	$products_id = $this->uri->segment(4);
    	$hash = get_attr_hash($hash_users_id);
		$products_records = $this->products_model->get($products_id);
	    $data['products_records'] = $products_records;
	    $data['main'] = 'admin/products/show_products';

	    $this->load->view('admin/template/layout',$data);
	}

	function ajax_delete_products()
	{
		// $this->permission->is_ajax();

		$ajax_products_id = $this->input->post('products_id');

		//get the products_id

		$products_id = get_attr_id($ajax_products_id);

		//get the hash

		$hash = get_attr_hash($ajax_products_id);

		//check the hash

		// $this->permission->check_ajax_id_hash($products_id,$hash);

		if($this->products_model->delete($products_id))
		{
			echo '1';
		}
		else
		{
			echo '2';
		}

	}

}
?>