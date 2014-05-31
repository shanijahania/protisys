<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class settings extends Admin_Controller {

	var $date;
	function __construct()
	{
		parent::__construct();

		$this->load->model('settingsmodel');
		$this->lang->load('dashboard');
		$this->date = date('Y-m-d H:i:s');
		$this->load->library('image_lib');
	}

	public function index()
	{
		$data = '';
		$data['page_title'] = 'All settings';
		$data['heading'] = 'All settings';
		$data['action'] = base_url('admin/settings/update');

		$data['settings']['title'] = 'My Social Site';
		$data['settings']['tag'] = 'discuss the world, share yours...';
		$data['settings']['logo'] = THEME_URL."assets/images/logo.png";
		$data['settings']['email'] = 'abc@example.com';
		$data['settings']['meta_keywords'] = '';
		$data['settings']['meta_description'] = '';
		$data['settings']['logo_img'] = '';

		$data['settings']['edit_post'] = '';
		$data['settings']['delete_post'] = '';
		$data['settings']['edit_comment'] = '';
		$data['settings']['delete_comment'] = '';

		$settings = $this->settingsmodel->getSettings();
		foreach ($settings as $setting) {

			if($setting->meta_key == 'title'){
			$data['settings']['title'] = $setting->meta_value;
			}
			if($setting->meta_key == 'email'){
				$data['settings']['email'] = $setting->meta_value;
			}
			if($setting->meta_key == 'keywords'){
				$data['settings']['meta_keywords'] = $setting->meta_value;
			}
			if($setting->meta_key == 'description'){
				$data['settings']['meta_description'] = $setting->meta_value;
			}
			if($setting->meta_key == 'tag'){
				$data['settings']['tag'] = $setting->meta_value;
			}
			if($setting->meta_key == 'logo'){
				$data['settings']['logo_img'] = $setting->meta_value;
			}
			if($setting->meta_key == 'edit_post'){
				$data['settings']['edit_post'] = $setting->meta_value;
			}
			if($setting->meta_key == 'delete_post'){
				$data['settings']['delete_post'] = $setting->meta_value;
			}
			if($setting->meta_key == 'edit_comment'){
				$data['settings']['edit_comment'] = $setting->meta_value;
			}
			if($setting->meta_key == 'delete_comment'){
				$data['settings']['delete_comment'] = $setting->meta_value;
			}
			
		}
		$data['main'] = 'admin/settings_form';	
		$this->load->view('admin/template/layout', $data);
	}
	public function update(){
		
		$update = array();

		// >>>>>>>> IMAGE upload script <<<<<<<<<<<<<
		$output_dir = IMAGE_PATH;
		$thumb_dir = IMAGE_PATH;

		if(isset($_FILES["logo"]))
		{
			if ($_FILES["logo"]["error"] > 0)
			{
				if($_FILES["logo"]["error"] == 4){
					$update['logo'] = $this->input->post('logo_img');
				}else{
					echo "Error: " . $_FILES["logo"]["error"] . "<br>";	
				}
				
			}
			else
			{
				$logo1 = $output_dir."80x80_".$this->input->post('logo_img');
				$logo2 = $output_dir."150x150_".$this->input->post('logo_img');

				if(file_exists($logo1)){
					unlink($logo1);
				}
				if(file_exists($logo2)){
					unlink($logo2);	
				}

				$time = time();
				$path_parts1 = pathinfo($_FILES["logo"]["name"]);
				$name = $path_parts1['filename'];
				$ext1 = $path_parts1['extension'];

				$newImg1 = "logo_".$time.".".$ext1;
				$logo_small = "80x80_".$newImg1;
				$logo_large = "150x150_".$newImg1;

				$configs[] = array('source_image' => $_FILES["logo"]["tmp_name"], 'new_image' => $output_dir.$logo_small, 'width' => 80, 'height' => 80, 'maintain_ratio' => TRUE);
		        $configs[] = array('source_image' => $_FILES["logo"]["tmp_name"], 'new_image' => $output_dir.$logo_large, 'width' => 140, 'height' => 140, 'maintain_ratio' => TRUE);
		        foreach ($configs as $config) {
		        	$this->image_lib->initialize($config);
		          	if(!$this->image_lib->resize()){
		          		 echo $this->image_lib->display_errors();
		          	}
		        }
		        $update['logo'] = $newImg1;
			}

		}else{
			$update['logo'] = $this->input->post('logo_img');
		}
		$update['id'] 				= $this->input->post('settings_id');
		$update['title'] 			= $this->input->post('title');
		$update['email'] 			= $this->input->post('email');
		$update['tag'] 				= $this->input->post('tag');
		$update['keywords'] 		= $this->input->post('keywords');
		$update['description'] 		= $this->input->post('description');
		$update['modified_at'] 		= $this->date;
		$update['edit_post'] 		= '0';
		$update['delete_post'] 		= '0';
		$update['edit_comment'] 	= '0';
		$update['delete_comment'] 	= '0';

		if($this->input->post('edit_post')){
			$update['edit_post'] = $this->input->post('edit_post');
		}
		if($this->input->post('delete_post')){
			$update['delete_post'] = $this->input->post('delete_post');
		}
		if($this->input->post('edit_comment')){
			$update['edit_comment'] = $this->input->post('edit_comment');
		}
		if($this->input->post('delete_comment')){
			$update['delete_comment'] = $this->input->post('delete_comment');
		}

		if($this->settingsmodel->updatSettings($update)){

			$this->session->set_flashdata('success', 'Settings Updated Successfully..');
			redirect('admin/settings', 'refresh');
		}else{

			$this->session->set_flashdata('error', 'Oops! Settings could not be Updated...');
			redirect('admin/settings', 'refresh');
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

	function _404(){

		$data['title'] = "404 Page not found.";

		$data['main'] = 'admin/404';	
		$this->load->view('admin/template/layout', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */