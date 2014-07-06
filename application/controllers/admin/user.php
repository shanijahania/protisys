<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller {

	var $date;
	function __construct()
	{
		parent::__construct();

		$this->load->model('usersModel');
		$this->lang->load('dashboard');
		$this->date = date('Y-m-d H:i:s');
	}

	public function index()
	{
		$data = '';
		$data['page_title'] = 'Users';
		$data['heading'] = 'Users';
		$data['action'] = base_url('admin/user/add');
		$data['action_update'] = base_url('admin/user/update');
		$data['action_search'] = base_url('admin/user');
		$str = '';
		$per_page = '20';
		
		$limit = 0;
		if(isset($_GET['per_page']) && $_GET['per_page'] !=''){
			$limit = $_GET['per_page'];
		}
		if(isset($_GET['s']) && $_GET['s'] !=''){
			$str = $_GET['s'];
		}
		$data['s'] = $str;
		// pagination config
		$totalUsers = $this->usersModel->getUsersTotal($limit, $per_page, $str);
		$config['base_url'] = base_url('admin/user?s='.$str);
		$config['total_rows'] = $totalUsers;
		$config['per_page'] = $per_page; 
		$config['page_query_string'] = TRUE;
		$this->pagination->initialize($config);

		$pagination = $this->pagination->create_links();
		$data['pagination'] = $pagination;


		// get all age groups
		$ageGroup = array();
		$ageGroup = ageGroups();
		$data['ageGroups'] = $ageGroup;
		
		$userArray = array();
		$users = $this->usersModel->getUsers($limit, $per_page, $str);
		foreach ($users as $user) {

			$stats = $this->usersModel->getUserStats($user->user_id);

			$stat_posts 		= '0';
			$stat_likes 		= '0';
			$stat_dislikes 		= '0';
			$stat_following 	= '0';
			$stat_shares 		= '0';

			if($stats['posts']){
				$stat_posts = $stats['posts'];
			}
			if($stats['likes']){
				$stat_likes = $stats['likes'];
			}
			if($stats['dislikes']){
				$stat_dislikes = $stats['dislikes'];
			}
			if($stats['shares']){
				$stat_shares = $stats['shares'];
			}
			if($stats['following']){
				$stat_following = $stats['following'];
			}

			$userArray[] = array(
				'id' =>				$user->user_id,
				'name' => 			$user->name,
				'surname' => 		$user->surname,
				'username' => 		$user->username,
				'password' => 		$user->password,
				'gender' => 		$user->gender,
				'email' => 			$user->email,
				'location' => 		$user->location,
				'created_at' => 	$user->created_at,
				'modified_at' =>	$user->modified_at,
				'age' => 			$user->age,
				'access' => 		$user->access,
				'active' => 		$user->is_active,
				'mobile' => 		$user->mobile,
				'posts' => 			$stat_posts,
				'likes' => 			$stat_likes,
				'dislikes' => 		$stat_dislikes,
				'shares' =>			$stat_shares,
				'following' => 		$stat_following
				);
		}

		$data['users'] = $userArray;
		// $data['locations'] = $this->getLocations();

		$this->load->view('admin/users_view', $data);
	}

	public function getUser(){
		$data = array();
		$data['action_update'] = base_url('admin/user/update');

		// get all age groups
		$ageGroup = array();
		$ageGroup = ageGroups();
		$data['ageGroups'] = $ageGroup;

		$user_id = $this->input->post('id');
		$view = 'ajax';
		$user = $this->usersModel->getUserByID($user_id);
		$userArray = array(
			'id' =>				$user->user_id,
			'name' => 			$user->name,
			'surname' => 		$user->surname,
			'username' => 		$user->username,
			'password' => 		$user->password,
			'gender' => 		$user->gender,
			'email' => 			$user->email,
			'location' => 		$user->location,
			'created_at' => 	$user->created_at,
			'modified_at' =>	$user->modified_at,
			'age' => 			$user->age,
			'access' => 		$user->access,
			'active' => 		$user->is_active,
			'mobile' => 		$user->mobile
			);
		$data['user'] = $userArray;
		if($view == 'ajax'){
			return $this->load->view('admin/partials/user_model', $data);
		}
	}
	public function add(){

		$password = sha1($this->input->post('password'));
		$insert = array();
		$insert['type'] 		= $this->input->post('type');
		$insert['name'] 		= $this->input->post('name');
		$insert['surname'] 		= $this->input->post('surname');
		$insert['username'] 	= $this->input->post('username');
		$insert['email'] 		= $this->input->post('email');
		$insert['password'] 	= $password;
		$insert['gender'] 		= $this->input->post('gender');
		$insert['location'] 	= $this->input->post('location');
		$insert['date_range'] 	= $this->input->post('date_range');
		$insert['mobile'] 		= $this->input->post('mobile');
		$insert['created_at'] 	= $this->date;
		$insert['modified_at'] 	= $this->date;
		$insert['access'] 		= 'member';
		$insert['is_active'] 	= '1';


		if($this->usersModel->insertUser($insert)){
			echo 1;
			$this->session->set_flashdata('success', 'User Added Successfully.');
		}else{
			echo 0;
			$this->session->set_flashdata('error', 'Oops! User Could not be added.');
		}

	}

	public function update(){
		
		if($this->input->post('password')){
			$new_pass = sha1($this->input->post('password'));
		}else{
			$new_pass = $this->input->post('pass_hash');
		}
		$update = array();
		$update['id'] 			= $this->input->post('id');
		$update['type'] 		= $this->input->post('type');
		$update['name'] 		= $this->input->post('name');
		$update['surname'] 		= $this->input->post('surname');
		// $update['username'] 	= $this->input->post('username');
		// $update['email'] 		= $this->input->post('email');
		$update['password'] 	= $new_pass;
		$update['gender'] 		= $this->input->post('gender');
		$update['location'] 	= $this->input->post('location');
		$update['date_range'] 	= $this->input->post('date_range');
		$update['mobile'] 		= $this->input->post('mobile');
		// $update['created_at'] 	= $this->date;
		$update['modified_at'] 	= $this->date;
		// $update['access'] 		= 'member';
		// $update['is_active'] 	= '1';


		if($this->usersModel->updatUser($update)){
			echo 1;
			$this->session->set_flashdata('success', 'User Updated Successfully.');
		}else{
			echo 0;
			$this->session->set_flashdata('error', 'Oops! User could not be Updated.');
		}
	}
	public function destroy(){
		$id = $this->input->post('id');

		if($this->usersModel->destroyUser($id)){
			echo 1;
			$this->session->set_flashdata('success', 'User Deleted Successfully.');
		}else{
			echo 0;
			$this->session->set_flashdata('error', 'Oops! User could not be Deleted.');
		}

	}

	public function is_active(){
		$id = $this->input->post('id');
		$val = $this->input->post('val');
		if($this->usersModel->activeUser($id, $val)){
			echo 1;
		}else{
			echo 0;
		}
	}
	public function getLocations(){

		$towns = AllLocations();
		$arrayTowns = array();
		$results = array();
		foreach ($towns as $town) {
			$arrayTowns[strtolower($town->name)] = strtolower($town->id_town);
		}
		
		if (isset($_GET['q'])) {
		    $q = strtolower($_GET['q']);
		    if ($q) {
		        foreach ($arrayTowns as $key => $value) {
		            if (strpos(strtolower($key), $q) !== false) {
		                $results[] = array($key, $value);
		            }
		        }
		    }
		}
		$output = 'autocomplete';
		if (isset($_GET['output'])) {
		    $output = strtolower($_GET['output']);
		}
		if ($output === 'json') {
		    echo json_encode($results);
		} else {
		    echo $this->autocomplete_format($results);
		}
	}

	function autocomplete_format($results) {
	    foreach ($results as $result) {
	        echo $result[0] . '|' . $result[1] . "\n";
	    }
	}
	public function checkEmail(){

		$type = $this->input->post('type');
		if($type == 'email'){
			$value = $this->input->post('email');
		}else{
			$value = $this->input->post('username');
		}
		if($this->usersModel->check_email($value, $type)){
			echo 'false';
		}else{
			echo 'true';
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */