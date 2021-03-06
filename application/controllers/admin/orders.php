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
		$this->load->model('order_commision_model');
		$this->load->model('order_status_model');
		$this->date = date('Y-m-d H:i:s');
	}

	function index()
	{
		$data = array();
		$fields = array(
			'first_name' => 'First Name',
			'email' 	=> 'Surname', 
			'postcode' => 'Username', 
			'showroom' => 'Email'
			);
		
		$data['fields'] = $fields;

		$str 			= '';
		$per_page 		= '20';
		$limit 			= 0;
		$sort_by		= "desc";
		$sort_column	= "order_id";
		$is_complete	= false;
		
		$post_params = array();
		
		if($this->admin_session->userdata['admin']['access'] == 'super_admin')
		{
			$is_complete	= 0;
		}
		else
		{
			$is_complete	= false;
		}
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

				if($this->admin_session->userdata['admin']['access'] == 'salesperson'):	

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
		$post_params['is_complete'] = $is_complete;
		
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
		$data['page_title'] = 'Orders | '.$this->config->item('site_name');
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
			$this->form_validation->set_rules('qty', 'Quantity', 'trim');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
			$this->form_validation->set_rules('postcode', 'Postcode', 'trim');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('payment_method', 'Payment Method', 'trim|required');
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
		    				'status'		=> $input['status'],
		    				'payment_type'	=> $input['payment_method']
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
		    				'status'		=> $input['status'],
		    				'payment_type'	=> $input['payment_method']
		    				);	

		    	$insert_id = $this->orders_model->insert($data);	
			endif;

	    	if($insert_id)
			{	
				// ***************** Insert order product *******************
				$product = $this->products_model->get($input['product_id']);
				$product_price 	= $product->product_price;
				$quantity 		= $input['qty'];
				$order_total 	= $product->product_price * $input['qty'];

				if($product)
				{
			    	$product_data = array(
			    			'product_id'	=> $input['product_id'], 
			    			'order_id'		=> $insert_id, 
			    			'p_name'		=> $product->product_name,
			    			'p_price'		=> $product->product_price,
			    			'p_qty'			=> $input['qty']
			    			);

			    	$this->db->set('product_stock', 'product_stock-1', FALSE);
			    	$this->db->where('product_id',$input['product_id']);
			    	$this->db->update('ps_products');
			    	$this->order_products_model->insert($product_data);

			    	if($this->admin_session->userdata['admin']['access'] == 'partners'):

			    		$partnerDetail = $this->users_model->get($this->admin_session->userdata['admin']['user_id']);
			    		$salespersonDetails = $this->users_model->get($this->admin_session->userdata['admin']['parent_id']);
			    		
			    		$partner_com 	= $order_total * $partnerDetail->commission_per/100;
			    		$saleperson_com = $order_total * $salespersonDetails->commission_per/100;
			    		
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
			    		$total_commission = $partnercommission->commission + $salecommission->commission;

			    	elseif($this->admin_session->userdata['admin']['access'] == 'salesperson'):
			    		
			    		$salespersonDetails = $this->users_model->get($this->admin_session->userdata['admin']['user_id']);

			    		$saleperson_com = $order_total * $salespersonDetails->commission_per/100;
			    		
			    		$salecommission = new stdClass();

			    		$salecommission->commission = $saleperson_com ;
			    		$salecommission->user_id	= $salespersonDetails->user_id;
			    		$salecommission->commissions_persantage	= $salespersonDetails->commission_per;

			    		$commissions[0]	= $salecommission;
			    		$total_commission = $salecommission->commission;

			    	elseif($this->admin_session->userdata['admin']['access'] == 'clients'):

			    		$getClientParentDetails = $this->users_model->get($this->admin_session->userdata['admin']['parent_id']);
			    		$getPartnerDetials		= $this->users_model->get($getClientParentDetails->parent_id);

			    		$partner_com 	= $order_total * $getClientParentDetails->commission_per/100;
			    		$saleperson_com = $order_total * $getPartnerDetials->commission_per/100;
			    		
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
			    		$total_commission = $partnercommission->commission + $salecommission->commission;
			    	
			    	else:
			    		$admin_com 	 = $order_total * 10/100;
			    		$admincommission = new stdClass();
			    		$admincommission->commission 				= $admin_com ;
			    		$admincommission->user_id					= $this->admin_session->userdata['admin']['user_id'];
			    		$admincommission->commissions_persantage	= 10;

			    		$commissions[1]	 = $admincommission;

			    		$total_commission = $admincommission->commission;
			    	endif;
			    	foreach($commissions as $key => $value):
			    		$data = array(
			    					'ord_id'			=> $insert_id,
			    					'u_id'				=> $value->user_id,
			    					'ord_total'			=> $order_total,
			    					'ord_commission'	=> $value->commission,
			    					'ord_commission_persentage' => $value->commissions_persantage 
			    				);
			    			$this->order_commision_model->insert($data);
			    	endforeach;
			    	
			    	// update order table with commission and totals
			    	$order_total = 
					$update_order = array(
						'total_amount' 		=> $order_total, 
						'total_qty' 		=> $quantity,
						'total_commission' 	=> $total_commission,
						'shipment' 			=> 0
						);
					$this->orders_model->update($insert_id, $update_order);

			    	$this->session->set_flashdata('success', 'The orders info have been successfully added');
					redirect('admin/orders/confirm_order/'.$insert_id);
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

	function confirm_order($order_id = false)
	{
		$data = array();
		$data['page_title'] = 'Confirm Order | '.$this->config->item('site_name');
		$data['heading'] = 'Confirm Order';
		if(!$order_id)
		{
			$order_id = $this->input->post('order_id');
		}
		$data['order_data'] 		= $this->orders_model->get($order_id);
		$data['order_products'] 	= $this->order_products_model->get_many_by('order_id', $order_id);
		$data['order_commission'] 	= $this->order_commision_model->get_many_by('ord_id', $order_id);

		if(!$data['order_data']->is_checkout)
		{
			$data['main'] = 'admin/orders/confirm_order';
			$this->load->view('admin/template/layout',$data);
		}
		else
		{
			redirect('admin/orders', 'refresh');
		}
		
	}	

	function process_order()
	{
		if($this->input->get_post('payment'))
		{
			if($this->input->get_post('payment') == 'success')
			{
				echo "payment succcess";
			}
			elseif($this->input->get_post('payment') == 'declined')
			{
				echo "payment declined";
			}
			else
			{
				if($this->input->get_post('order_id'))
				{
					$order_id 		= $this->input->get_post('order_id');
					$payment_method = $this->input->get_post('payment');
					if($payment_method == 'cash')
					{
						$update = array('is_checkout' => 1);
						if($this->orders_model->update($order_id, $update))
						{
							
							$this->sendEmails($order_id);

							$this->session->set_flashdata('success', 'Order made successfully');
							redirect('admin/orders', 'refresh');
						}
						else
						{
							$this->session->set_flashdata('error', 'order could not be completed');
							redirect('admin/orders/confirm_order/'.$order_id, 'refresh');	
						}
					}
					else
					{
						redirect('payment/checkout/'.$order_id, 'refresh');
					}
				}
				else
				{
					redirect('admin/orders', 'refresh');
				}
			}
		}
		
	}

	public function sendEmails($order_id)
	{
		$data['order_data'] 	= $this->orders_model->get($order_id);
		$data['order_products'] = $this->order_products_model->get_many_by('order_id', $order_id);

		$html = $this->load->view('admin/template/email_template',$data,true);
		$subject = "New Order";
		$from = $data['order_data']->email;
		$from_name = $data['order_data']->first_name. ' ' .$data['order_data']->surname;

		if($data['order_data']->user_id != '1'){
			$getParentDetails = $this->users_model->get($data['order_data']->user_id);
			$to = $getParentDetails->email;
		}
		else
		{
			$getParentDetails = $this->users_model->get($data['order_data']->user_id);
			$to = $getParentDetails->email;
		}
		sendHtmlMail($from,$from_name,$to,$subject,$html);

		if($data['order_data']->user_id != '0'){
			
			$subject = "Your Order Details";
			$from = 'no-reply@protisys.com';
			$from_name = "administrator";			
			$to = $data['order_data']->email;
			sendHtmlMail($from,$from_name,$to,$subject,$html);			
		}

	}

	function edit_orders($order_id = false)
	{
		$data = array();
	    $data['page_title'] = 'Edit Order | '.$this->config->item('site_name');
		$data['heading'] = 'Edit Order';

		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('surname', 'Surname', 'trim');
		$this->form_validation->set_rules('qty', 'Quantity', 'trim');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('payment_method', 'Payment Method', 'trim|required');

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
	    	$data = array();
			$data['page_title'] = 'Confirm Order | '.$this->config->item('site_name');
			$data['heading'] = 'Confirm Order';
			if(!$order_id)
			{
				$order_id = $this->input->post('order_id');
			}
			$data['order_data'] 		= $this->orders_model->get($order_id);
			$data['order_products'] 	= $this->order_products_model->get_many_by('order_id', $order_id);
			$data['order_commission'] 	= $this->order_commision_model->get_many_by('ord_id', $order_id);
			$this->db->where(array('is_active' => '1'));
			$data['allProducts'] = $this->products_model->get_all();
	    	$data['main'] = 'admin/orders/edit_orders';

			$this->load->view('admin/template/layout',$data);
	    }
	}
	function show_order($order_id = false){

		$data = array();
		$data['page_title'] = 'Order Detail | '.$this->config->item('site_name');
		$data['heading'] = 'Order Detail';
		if(!$order_id)
		{
			$order_id = $this->input->post('order_id');
		}
		$data['order_data'] 		= $this->orders_model->get($order_id);
		$data['order_products'] 	= $this->order_products_model->get_many_by('order_id', $order_id);
		$data['order_commission'] 	= $this->order_commision_model->get_many_by('ord_id', $order_id);

			$data['main'] = 'admin/orders/show_order';
			$this->load->view('admin/template/layout',$data);
	}
	public function save_order($order_id = false)
	{
		$this->session->set_flashdata('success', 'Order has been saved and can be completed later');
		redirect('admin/orders', 'refresh');
	}
	function delete_order()
	{
		if($this->input->get_post('order_id'))
		{
			$order_id = $this->input->get_post('order_id');

			// delete order
			if($this->orders_model->delete($order_id))
			{
				// delete commissions
				$this->order_commision_model->delete_by('ord_id', $order_id);

				// delete order products
				$this->order_products_model->delete_by('order_id', $order_id);

				$this->session->set_flashdata('success', 'Order deleted successfully');
				redirect('admin/orders', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Order could not be deleted');
				redirect('admin/orders', 'refresh');
			}
		}
		else
		{
			redirect('admin/orders', 'refresh');
		}
		
		
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
			// delete commissions
			$this->order_commision_model->delete_by('ord_id', $order_id);

			// delete order products
			$this->order_products_model->delete_by('order_id', $order_id);
			echo '1';
		}
		else
		{
			echo '2';
		}

	}

}
?>