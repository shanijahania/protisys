<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profile extends Admin_Controller {

	var $date;
	function __construct()
	{
		parent::__construct();

		$this->load->model('profilemodel');
		$this->lang->load('dashboard');
		$this->date = date('Y-m-d H:i:s');
		$this->load->library('image_lib');
	}

	public function index()
	{
		$data = '';
		$data['page_title'] = 'Edit Profile';
		$data['heading'] = 'Edit Profile';
		$data['action'] = base_url('admin/profile/update');

		$uid = $this->admin_session->userdata['admin']['user_id'];
		$data['profile']['name'] = '';
		$data['profile']['surname'] = '';
		$data['profile']['username'] = '';
		$data['profile']['password'] = '';
		$data['profile']['email'] = '';
		$data['profile']['mobile'] = '';
		$data['profile']['address'] = '';
		$data['profile']['avatar'] = '';
		$data['profile']['gender'] = '';


		$user = $this->profilemodel->getUser($uid);
		if($user->user_id)
		{
			$data['profile']['id'] = $user->user_id;
		}
		if($user->name)
		{
			$data['profile']['name'] = $user->name;
		}
		if($user->surname)
		{
			$data['profile']['surname'] = $user->surname;
		}
		if($user->username)
		{
			$data['profile']['username'] = $user->username;
		}
		if($user->password)
		{
			$data['profile']['password'] = $user->password;
		}
		if($user->email)
		{
			$data['profile']['email'] = $user->email;
		}
		if($user->mobile)
		{
			$data['profile']['mobile'] = $user->mobile;
		}
		if($user->address)
		{
			$data['profile']['address'] = $user->address;
		}
		if($user->gender)
		{
			$data['profile']['gender'] = $user->gender;
		}
		if($user->avatar)
		{
			$data['profile']['avatar'] = $user->avatar;
		}
		if($user->created_at)
		{
			$data['profile']['created_at'] = $user->created_at;
		}
		if($user->modified_at)
		{
			$data['profile']['modified_at'] = $user->modified_at;
		}
		
		if($user->access)
		{
			$data['profile']['access'] = $user->access;
		}
		$data['main'] = 'admin/profile_form';
		$this->load->view('admin/template/layout', $data);
	}
	public function update()
	{
		$update = array();
		// >>>>>>>> IMAGE upload script <<<<<<<<<<<<<
		$output_dir = AVATAR_PATH;
		$thumb_dir = AVATAR_PATH;
		if(isset($_FILES["avatar"]))
		{
			if ($_FILES["avatar"]["error"] > 0)
			{
				if($_FILES["avatar"]["error"] == 4){
					$update['avatar'] = $this->input->post('avatar');
				}else{
					echo "Error: " . $_FILES["avatar"]["error"] . "<br>";	
				}
				
			}
			else
			{
				$image1 = $output_dir."80x80_".$this->input->post('avatar');
				$image2 = $output_dir."150x150_".$this->input->post('avatar');
				$image3 = $output_dir."400x400_".$this->input->post('avatar');

				if(file_exists($image1)){
					unlink($image1);
				}
				if(file_exists($image2)){
					unlink($image2);	
				}
				if(file_exists($image3)){
					unlink($image3);	
				}

				$time = time();
				$path_parts1 = pathinfo($_FILES["avatar"]["name"]);
				$name = $path_parts1['filename'];
				$ext1 = $path_parts1['extension'];

				$newImg1 = post_slug($this->input->post('name'))."_".$time.".".$ext1;
				$image1 = "80x80_".$newImg1;
				$image2 = "150x150_".$newImg1;
				$image3 = "400x400_".$newImg1;

				$configs[] = array('source_image' => $_FILES["avatar"]["tmp_name"], 'new_image' => $output_dir.$image1, 'width' => 80, 'height' => 80, 'maintain_ratio' => TRUE);
		        $configs[] = array('source_image' => $_FILES["avatar"]["tmp_name"], 'new_image' => $output_dir.$image2, 'width' => 150, 'height' => 150, 'maintain_ratio' => TRUE);
		        $configs[] = array('source_image' => $_FILES["avatar"]["tmp_name"], 'new_image' => $output_dir.$image3, 'width' => 400, 'height' => 400, 'maintain_ratio' => TRUE);
		        foreach ($configs as $config) {
		        	$this->image_lib->initialize($config);
		          	if(!$this->image_lib->resize()){
		          		 echo $this->image_lib->display_errors();
		          	}
		        }
		        $update['avatar'] = $newImg1;
			}

		}else{
			$update['avatar'] = '';
		}

		if($this->input->post('password')){
			$password = sha1($this->input->post('password'));
			$update['password'] = $password;
		}else{
			$update['password'] = $this->input->post('token');
		}

		$update['id'] 			= $this->input->post('profile_id');
		$update['name'] 		= $this->input->post('name');
		$update['surname'] 		= $this->input->post('surname');
		$update['mobile'] 		= $this->input->post('mobile');
		$update['address'] 		= $this->input->post('address');
		$update['gender'] 		= $this->input->post('gender');
		$update['modified_at'] 	= $this->date;
		// print_r($update);
		// exit();
		if($this->profilemodel->updatUser($update)){

			$this->session->set_flashdata('success', 'Profile Updated Successfully..');
			redirect('admin/profile', 'refresh');
		}else{

			$this->session->set_flashdata('error', 'Oops! Profile could not be Updated...');
			redirect('admin/profile', 'refresh');
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */