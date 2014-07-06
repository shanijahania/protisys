<?php

class Orders extends Admin_Controller {
	var $date;
	function __construct()
	{
		parent::__construct();
		$this->load->model('orders_model');
		$this->load->model('products_model');
		$this->load->model('order_products_model');
		$this->load->model('users_model');
		$this->load->model('order_status_model');
		$this->date = date('Y-m-d H:i:s');
	}

	function index()
	{
		$data = array();
		$fields = array(
			'first_name' => 'First Name',
			'email' => 'Surname', 
			'postcode' => 'Username', 
			'showroom' => 'Email'
			);
		
		$data['fields'] = $fields;

		$str 			= '';
		$per_page 		= '20';
		$limit 			= 0;
		$sort_by		= "desc";
		$sort_column	= "orders_id";
		
		$post_params = array();
		
		if(isset($_GET['s']) && $_GET['s'] !='')
		{
			$str = $_GET['s'];
			$uri_string = 'admin/orders?s='.$_GET['s'];
		}
		else
		{
			$uri_string = 'admin/orders?s='.$str;
		}

		if(isset($_GET['uid']) && $_GET['uid'] !='')
		{
			$uid = $_GET['uid'];
			if(isset($_GET['role']) && $_GET['role'] == 'salesperson'):
				$getPartnerID = $this->users_model->get_many_by(array('parent_id' => $uid));
			
				$ids_users = array();
				if(!empty($getPartnerID)):
					foreach ($getPartnerID as $key => $value) 
					{
						$ids_users[$key] = $value->user_id; 
					}
				
					$post_params['ids_users'] = $ids_users;
				endif;


			endif;
			$uri_string .= "&uid=".$uid;
		}
		else
		{
			if($this->admin_session->userdata['admin']['access'] != 'super_admin')
			{
				$uid = $this->admin_session->userdata['admin']['user_id'];
			}
			else
			{
				$uid = false;
			}
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

		
		$post_params['limit'] 		= $limit;
		$post_params['per_page'] 	= $per_page;
		$post_params['str'] 		= $str;
		$post_params['sort_column'] = $sort_column;
		$post_params['sort_by'] 	= $sort_by;
		$post_params['fields'] 		= $fields;
		$post_params['uid'] 		= $uid;
		$post_params['access'] 		= 'admin';
		
		$base_url 	= base_url($uri_string);
		$total_orders = $this->orders_model->orders_total($post_params);
		$config['base_url'] 			= $base_url;
		$config['total_rows'] 			= $total_orders;
		$config['per_page'] 			= $per_page; 
		$config['page_query_string'] 	= TRUE;

		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();
		$data['pagination'] = $pagination;

		$orders_records = $this->orders_model->orders_info($post_params)->get_all();
		$data['orders_records'] = $orders_records;

		$data['sort_by'] 		= $sort_by;
		$data['sort_column'] 	= $sort_column;

		$data['uri_string'] = $uri_string;
		$data['page_title'] = 'Orders | Point-s';
		$data['heading'] = 'Orders';

	    $data['main'] = 'admin/orders/orders_list';
	    $data['js_function'] = array('orders_list');

		$this->load->view('admin/template/layout',$data);
	}

	function add_orders()
	{
		$data = array();
	    $data['page_title'] = 'Order | '.$this->config->item('site_name');
		$data['heading'] = 'Order';
		$product = '';
		$uri = '';
		
		$this->load->library('form_validation');

		$input = $this->input->post();

		if($input['client_id'] == 'others')
		{
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('surname', 'Surname', 'trim');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
			$this->form_validation->set_rules('postcode', 'Postcode', 'trim');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
		}

		
		$this->form_validation->set_rules('product_id', 'Product', 'trim|required');


		if($this->form_validation->run() == TRUE)
	    {
	    	if($input['client_id'] == 'others'):
	    		$first_name 	= $input['first_name'];
				$surname 		= $input['surname'];
				$email 			= $input['email'];
				$phone 			= $input['phone'];
				$postcode 		= $input['postcode'];
				$address 		= $input['address'];
				$created_at 	= $this->date;
				$modified_at 	= $this->date;

		    	$data = array(
		    				'client_id'		=> '',
		    				'user_id'		=> $this->admin_session->userdata['admin']['user_id'],	
		    				'first_name'	=> $first_name,
		    				'surname'		=> $surname,
		    				'email'			=> $email,
		    				'phone'			=> $phone,
		    				'postcode'		=> $postcode,
		    				'address'		=> $address,
		    				'created_at'	=> $created_at,
		    				'modified_at'	=> $modified_at,
		    				'is_active'		=> $input['is_active'],
		    				'status'		=> $input['status']
		    				);
				
				$insert_id = $this->orders_model->insert($data);
		    else:

			    $userInfo = $this->users_model->get($input['client_id']);
		    		
		    	$data = array(
		    				'client_id'		=> $input['client_id'],
		    				'user_id'		=> $userInfo->parent_id,
		    				'first_name'	=> $userInfo->name,
		    				'surname'		=> $userInfo->surname,
		    				'email'			=> $userInfo->email,
		    				'phone'			=> $userInfo->mobile,
		    				'postcode'		=> $userInfo->postcode,
		    				'address'		=> $userInfo->address,
		    				'created_at'	=> $this->date,
		    				'modified_at'	=> $this->date,
		    				'is_active'		=> $input['is_active'],
		    				'status'		=> $input['status']
		    				);	

		    	$insert_id = $this->orders_model->insert($data);	
			endif;

	    	if($insert_id)
			{	
				// ***************** Insert order product *******************
				$product = $this->products_model->get($input['product_id']);

				if($product)
				{

			    	$product_data = array(
			    			'product_id'	=> $input['product_id'], 
			    			'order_id'		=> $insert_id, 
			    			'p_name'		=> $product->product_name,
			    			'p_price'		=> $product->product_price,
			    			'p_qty'			=> '1'
			    			);
			    	$this->db->set('product_stock', 'product_stock-1', FALSE);
			    	$this->db->where('product_id',$input['product_id']);
			    	$this->db->update('ps_products');
			    	$this->order_products_model->insert($product_data);

			    	if($this->admin_session->userdata['admin']['access'] == 'partners'):

			    		$partnerDetail = $this->users_model->get($this->admin_session->userdata['admin']['user_id']);
			    		$salespersonDetails = $this->users_model->get($this->admin_session->userdata['admin']['parent_id']);
			    		

			    		$partner_com 	= $product->product_price * $partnerDetail->commission_per/100;
			    		$saleperson_com = $product->product_price * $salespersonDetails->commission_per/100;
			    		
			    		$partnercommission = new stdClass();

			    		$partnercommission->commission 	= $partner_com;
			    		$partnercommission->user_id		= $partnerDetail->user_id;
			    		$partnercommission->commissions_persantage	= $partnerDetail->commission_per; 
			    		
			    		$salecommission = new stdClass();

			    		$salecommission->commission = $saleperson_com ;
			    		$salecommission->user_id	= $salespersonDetails->user_id;
			    		$salecommission->commissions_persantage	= $salespersonDetails->commission_per;
			    		// $partnerArray 		= array($partnercommission);
			    		// $salespersonArray 	= array($salecommission);

			    		$commissions[0] = $partnercommission;
			    		$commissions[1]	= $salecommission;

			    	elseif($this->admin_session->userdata['admin']['access'] == 'salesperson'):
			    		
			    		$salespersonDetails = $this->users_model->get($this->admin_session->userdata['admin']['user_id']);

			    		$saleperson_com = $product->product_price * $salespersonDetails->commission_per/100;
			    		
			    		$salecommission = new stdClass();

			    		$salecommission->commission = $saleperson_com ;
			    		$salecommission->user_id	= $salespersonDetails->user_id;
			    		$salecommission->commissions_persantage	= $salespersonDetails->commission_per;

			    		$commissions[0]	= $salecommission;

			    	else:

			    		$getClientParentDetails = $this->users_model->get($this->admin_session->userdata['admin']['parent_id']);
			    		$getPartnerDetials		= $this->users_model->get($getClientParentDetails->parent_id);

			    		$partner_com 	= $product->product_price * $getClientParentDetails->commission_per/100;
			    		$saleperson_com = $product->product_price * $getPartnerDetials->commission_per/100;
			    		
			    		$partnercommission = new stdClass();

			    		$partnercommission->commission 	= $partner_com;
			    		$partnercommission->user_id		= $getClientParentDetails->user_id; 
			    		$partnercommission->commissions_persantage	= $getPartnerDetials->commission_per; 

			    		$salecommission = new stdClass();

			    		$salecommission->commission = $saleperson_com ;
			    		$salecommission->user_id	= $getClientParentDetails->parent_id;
			    		$salecommission->commissions_persantage	= $getPartnerDetials->commission_per; 

			    		$commissions[0]	= $partnercommission;
			    		$commissions[1]	= $salecommission;
			    	
			    	endif;

			    	$this->load->model('order_commision_model');
			    	
			    	foreach($commissions as $key => $value):
			    		$data = array(
			    					'ord_id'			=> $insert_id,
			    					'u_id'				=> $value->user_id,
			    					'ord_total'			=> $product->product_price,
			    					'ord_commission'	=> $value->commission,
			    					'ord_commission_persentage' => $value->commissions_persantage 
			    				);
			    			$this->order_commision_model->insert($data);
			    	endforeach;
			    	
			    	$this->session->set_flashdata('success', 'The orders info have been successfully added');
					redirect('admin/orders/add_orders'.$uri);
				}
				else
				{
					$this->orders_model->delete($insert_id);
					$this->session->set_flashdata('error', 'Product not found or removed.');
					redirect('admin/orders/add_orders'.$uri);
				}
				
			}
			else
			{
				$this->session->set_flashdata('error', 'Error. Please try again.');
				redirect('admin/orders/add_orders'.$uri);
			}
	    }
	    else //if page initial load or form validation false
	    {

			//$data['order_status'] = $this->order_status_model->get_all();
			
			if($this->admin_session->userdata['admin']['access'] == 'partners') 
			{
				$this->db->where('parent_id',$this->admin_session->userdata['admin']['user_id']);
				$this->db->where('access','clients');
				$this->db->where('is_active','1');
				$data['allClients'] = $this->users_model->get_many_by();
				$data['dispalyAllClients'] = 'block';
			}
			elseif($this->admin_session->userdata['admin']['access'] == 'salesperson') 
			{
				$this->db->where('parent_id',$this->admin_session->userdata['admin']['user_id']);
				$this->db->where('access','clients');
				$this->db->where('is_active','1');
				$data['allClients'] = $this->users_model->get_many_by();
				$data['dispalyAllClients'] = 'block';
			}
			else
			{
				$data['allClients'] = array();
				$data['dispalyAllClients'] = 'none';	
			}

			if(! empty($data['allClients'])):
				$other = new stdClass();

				$other->user_id 	= 'others';
				$other->name 		= 'Others';

				$others = array($other);
				$data['allClients'] = array_merge((array)$others,$data['allClients']);

			else:
				$other = new stdClass();

				$other->user_id 	= 'others';
				$other->name 		= 'Others';

				$others = array($other);
				$data['allClients'] = $others;

			endif;

			$this->db->where(array('is_active' => '1'));
			$data['allProducts'] = $this->products_model->get_all();
			$data['main'] = 'admin/orders/add_orders';
			$this->load->view('admin/template/layout',$data);
	    }
	}

	function edit_orders()
	{
		$data = array();
	    $data['page_title'] = 'Edit Order | Point-s';
		$data['heading'] = 'Edit Order';

		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('surname', 'Surname', 'trim');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('showroom_id', 'Showroom', 'trim|required');
		$this->form_validation->set_rules('vehicle_registration', 'Vehicle Registration', 'trim|required');
		$this->form_validation->set_rules('is_active', 'Is Active', 'trim');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		

		if($this->form_validation->run() == TRUE)
	    {
	    	$hash_orders_id = $this->input->post('orders_id');

	    	//check hash if the user edit it

	    	$orders_id = $this->input->post('orders_id');
	    	$hash = get_attr_hash($hash_orders_id);

	    	// $this->permission->check_form_id_hash($orders_id,$hash);

	    	$first_name 			= $this->input->post('first_name');
			$surname 				= $this->input->post('surname');
			$email 					= $this->input->post('email');
			$phone 					= $this->input->post('phone');
			$postcode 				= $this->input->post('postcode');
			$address 				= $this->input->post('address');
			$showroom_id 			= $this->input->post('showroom_id');
			$vehicle_registration 	= $this->input->post('vehicle_registration');
			$modified_at 			= $this->date;
			$is_active 				= $this->input->post('is_active');
			$status 				= $this->input->post('status');

	    	$data = array('first_name'=>$first_name,'surname'=>$surname,'email'=>$email,'phone'=>$phone,'postcode'=>$postcode,'address'=>$address,'showroom_id'=>$showroom_id,'vehicle_registration'=>$vehicle_registration,'modified_at'=>$modified_at,'is_active'=>$is_active, 'status' => $status);

	    	if($this->orders_model->update($orders_id,$data))
			{
				$this->session->set_flashdata('success', 'The orders info have been successfully updated');
				redirect("admin/orders/edit_orders/$orders_id/$hash");
			}
			else
			{
				$this->session->set_flashdata('error', 'Error. Please try again.');
				redirect("admin/orders/edit_orders/$orders_id/$hash");
			}
	    }
	    else //if page initial load or form validation false
	    {
	    	$orders_id = $this->uri->segment(4);

	    	//means come from orders list

	    	if($this->uri->segment(4))
	    	{
	    		// $this->permission->check_id_hash($orders_id);
	    	}

	    	//means come from validation error

	    	if($this->input->post('orders_id'))
	    	{
	    		$hash_orders_id = $this->input->post('orders_id');

		    	//check hash if the user edit it

		    	$orders_id = $this->input->post('orders_id');
		    	$hash = get_attr_hash($hash_orders_id);

		    	// $this->permission->check_form_id_hash($orders_id,$hash);
	    	}

			// $showroom_records = $this->showrooms_model->get_all();
			// $data['showroom_records'] = $showroom_records;
			$data['order_status'] = $this->order_status_model->get_all();

	    	$orders_records = $this->orders_model->get($orders_id);

	    	$data['orders_records'] = $orders_records;

	    	$data['main'] = 'admin/orders/edit_orders';

			$this->load->view('admin/template/layout',$data);
	    }
	}
	function show_order(){

		$data = array();
		$data['page_title'] = 'Order | Point-s';
		$data['heading'] 	= 'Order Detail';

    	//check hash if the user edit it
    	$order_id = $this->uri->segment(4);
		$orders_record = $this->orders_model->GerOrderById($order_id)->get_by();

	    $data['orders_record'] = $orders_record;

	    $data['main'] = 'admin/orders/show_order';

	    $this->load->view('admin/template/layout',$data);
	}
	function ajax_delete_orders()
	{
		// $this->permission->is_ajax();

		$ajax_orders_id = $this->input->post('orders_id');

		//get the orders_id

		$orders_id = get_attr_id($ajax_orders_id);

		//get the hash

		$hash = get_attr_hash($ajax_orders_id);

		//check the hash

		// $this->permission->check_ajax_id_hash($orders_id,$hash);

		if($this->orders_model->delete($orders_id))
		{
			$this->order_products_model->delete_by('order_id', $orders_id);
			echo '1';
		}
		else
		{
			echo '2';
		}

	}

}
?>