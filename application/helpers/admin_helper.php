<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Path Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/xml_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Set Realpath
 *
 * @access	public
 * @param	string
 * @param	bool	checks to see if the path exists
 * @return	string
 */

if ( ! function_exists('remove_accent')){

	function remove_accent($str){

		$a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','Ā','ā','Ă','ă','Ą','ą','Ć','ć','Ĉ','ĉ','Ċ','ċ','Č','č','Ď','ď','Đ','đ','Ē','ē','Ĕ','ĕ','Ė','ė','Ę','ę','Ě','ě','Ĝ','ĝ','Ğ','ğ','Ġ','ġ','Ģ','ģ','Ĥ','ĥ','Ħ','ħ','Ĩ','ĩ','Ī','ī','Ĭ','ĭ','Į','į','İ','ı','Ĳ','ĳ','Ĵ','ĵ','Ķ','ķ','Ĺ','ĺ','Ļ','ļ','Ľ','ľ','Ŀ','ŀ','Ł','ł','Ń','ń','Ņ','ņ','Ň','ň','ŉ','Ō','ō','Ŏ','ŏ','Ő','ő','Œ','œ','Ŕ','ŕ','Ŗ','ŗ','Ř','ř','Ś','ś','Ŝ','ŝ','Ş','ş','Š','š','Ţ','ţ','Ť','ť','Ŧ','ŧ','Ũ','ũ','Ū','ū','Ŭ','ŭ','Ů','ů','Ű','ű','Ų','ų','Ŵ','ŵ','Ŷ','ŷ','Ÿ','Ź','ź','Ż','ż','Ž','ž','ſ','ƒ','Ơ','ơ','Ư','ư','Ǎ','ǎ','Ǐ','ǐ','Ǒ','ǒ','Ǔ','ǔ','Ǖ','ǖ','Ǘ','ǘ','Ǚ','ǚ','Ǜ','ǜ','Ǻ','ǻ','Ǽ','ǽ','Ǿ','ǿ');
		$b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');
		return str_replace($a, $b, $str);
	}
}
if ( ! function_exists('post_slug')){
	function post_slug($str){

		return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), remove_accent($str)));

	}
}

if( ! function_exists('no_image')){
	function no_image($gender = FALSE, $size = FALSE){
		if($gender == "male"){

			if($size == '64'){
				$image = base_url('assets/images/man-64.png');
			}elseif($size == '128'){
				$image = base_url('assets/images/man-128.png');
			}elseif($size == '512'){
				$image = base_url('assets/images/man-512.png');
			}else{
				$image = base_url('assets/images/man-256.png');
			}
		}elseif($gender == 'female'){
			if($size == '64'){
				$image = base_url('assets/images/woman-64.png');
			}elseif($size == '128'){
				$image = base_url('assets/images/woman-128.png');
			}elseif($size == '512'){
				$image = base_url('assets/images/woman-512.png');
			}else{
				$image = base_url('assets/images/woman-256.png');
			}
		}else{
			if($size == '64'){
				$image = base_url('assets/images/no_img-64.png');
			}elseif($size == '128'){
				$image = base_url('assets/images/no_img-128.png');
			}elseif($size == '512'){
				$image = base_url('assets/images/no_img-512.png');
			}else{
				$image = base_url('assets/images/no_img-256.png');
			}
		}
		return $image;
	}
}
if( ! function_exists('get_avatar')){
	function get_avatar($id = FALSE, $size = FALSE){
		$url = AVATAR_URL;
		$path = AVATAR_PATH;
		$ci=& get_instance();
		$ci->load->database();
		$sql = "SELECT * from ".$ci->db->dbprefix('users')." WHERE user_id =".$id;
		$query = $ci->db->query($sql);
		$row = $query->row();
		if(isset($row->avatar)){

			if($size == 'small'){
				$img = $path."80x80_".$row->avatar;
				if(file_exists($img)){
					$image = $url."80x80_".$row->avatar;
				}else{
					$image = no_image($row->gender, '64');
				}
			}elseif($size == 'large'){
				$img = $path."400x400_".$row->avatar;
				if(file_exists($img)){
					$image = $url."400x400_".$row->avatar;
				}else{
					$image = no_image($row->gender, '512');
				}
			}else{
				$img = $path."150x150_".$row->avatar;
				if(file_exists($img)){
					$image = $url."150x150_".$row->avatar;
				}else{
					$image = no_image($row->gender);
				}
			}
		}else{
			if($size == 'small'){
				$image = no_image($row->gender, '64');
			}elseif($size == 'large'){
				$image = no_image($row->gender, '512');
			}else{
				$image = no_image($row->gender);
			}
		}
		return $image;
	}
}


if( ! function_exists('get_title')){
	function get_title(){

		$ci=& get_instance();
		$ci->load->database();

		$sql = "SELECT * FROM ".$ci->db->dbprefix('settings')." WHERE group_id = '1'";
		$query = $ci->db->query($sql);
		$rows = $query->result();
		$default = "Gossbox";
		if($rows){
			foreach ($rows as $setting) {

				if($setting->meta_key == 'title'){
					$title = $setting->meta_value;
					break;
				}else{
					$title = $default;
				}
			}
		}else{
			$title = $default;
		}
		return $title;
	}
}
if( ! function_exists('get_tagline')){
	function get_tagline(){

		$ci=& get_instance();
		$ci->load->database();

		$sql = "SELECT * FROM ".$ci->db->dbprefix('settings')." WHERE group_id = '1'";
		$query = $ci->db->query($sql);
		$rows = $query->result();
		$default = "discuss the world, share yours ...";
		if($rows){
			foreach ($rows as $setting) {

				if($setting->meta_key == 'tag'){
					$tagline = $setting->meta_value;
					break;
				}else{
					$tagline = $default;
				}
			}
		}else{
			$tagline = $default;
		}
		return $tagline;
	}
}
if( ! function_exists('get_email')){
	function get_email(){

		$ci=& get_instance();
		$ci->load->database();

		$sql = "SELECT * FROM ".$ci->db->dbprefix('settings')." WHERE group_id = '1'";
		$query = $ci->db->query($sql);
		$rows = $query->result();
		$default = "webmaster@gossbox.com";
		if($rows){
			foreach ($rows as $setting) {

				if($setting->meta_key == 'email'){
					$email = $setting->meta_value;
					break;
				}else{
					$email = $default;
				}
			}
		}else{
			$email = $default;
		}
		return $email;
	}
}

if( ! function_exists('get_settings')){
	function get_settings(){

		$ci=& get_instance();
		$ci->load->database();

		$sql = "SELECT * FROM ".$ci->db->dbprefix('settings')." WHERE group_id = '1'";
		$query = $ci->db->query($sql);
		$result = $query->result();
		$rows = array();
		if($result){
			foreach ($result as $setting) {
				$rows[$setting->meta_key] = $setting->meta_value;
			}
			return $rows;
		}else{
			return false;
		}
	}
}
if( ! function_exists('get_logo')){
	function get_logo($size = false){

		$ci=& get_instance();
		$ci->load->database();

		$sql = "SELECT * FROM ".$ci->db->dbprefix('settings')." WHERE group_id = '1'";
		$query = $ci->db->query($sql);
		$rows = $query->result();
		$default = THEME_URL."assets/images/logo.png";
		if($rows){
			foreach ($rows as $setting) {

				if($setting->meta_key == 'logo'){

					if($size == 'small'){
						$image = "80x80_".$setting->meta_value;
					}else{
						$image = "150x150_".$setting->meta_value;
					}
					$path = IMAGE_PATH.$image;
					if(file_exists($path)){
						$logo = IMAGE_URL.$image;
					}else{
						$logo = $default;
					}
					
					break;
				}else{
					$logo = $default;
				}
			}
		}else{
			$logo = $default;
		}
		echo $logo;
	}
}


if( ! function_exists('get_categories')){

	function get_categories($parent_id = 0, $page=false, $per_page=false, $string=false) {

		$ci=& get_instance();
		$ci->load->database();

		$categories = array();

		$ci->db->from('categories');
		$ci->db->where('parent', $parent_id);
		if($string){
			$ci->db->like('name', $string);
		}
		if($page && $per_page){
			$ci->db->limit($per_page ,$page);	
		}
		$ci->db->order_by('id_category', "desc");
		$result = $ci->db->get()->result();
		foreach ($result as $mainCategory) {
			$cat_id = $mainCategory->id_category;
			$favourites = cat_favourites($cat_id);
			
			$category = array();
			$category['id'] = 				$mainCategory->id_category;
			$category['name'] = 			strtolower($mainCategory->name);
			$category['parent_id'] = 		$mainCategory->parent;
			$category['color'] = 			$mainCategory->color;
			$category['created'] = 			$mainCategory->created_at;
			$category['active'] = 			$mainCategory->is_active;
			$category['slug'] = 			$mainCategory->slug;
			$category['posts'] = 			'';
			$category['permalink'] = 		base_url('feed/'.$mainCategory->id_category);
			$category['sub_categories'] = 	get_categories($category['id']);
			$category['favourites'] =		$favourites;

			$categories[$mainCategory->id_category] = $category;
		}

		return $categories;
	}

}

if( ! function_exists('create_unique_slug')){

	function create_unique_slug($string, $table)
	{
		$ci=& get_instance();
		$ci->load->database();

	    $slug = url_title($string);
	    $slug = strtolower($slug);
	    $i = 0;
	    $params = array();
	    $params['slug'] = $slug;
	    // if ($this->input->post('id')) {
	    //     $params['id !='] = $this->input->post('id');
	    // }
	    
	    while ($ci->db->where($params)->get($table)->num_rows()) {
	        if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
	            $slug .= '-' . ++$i;
	        } else {
	            $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
	        }
	        $params ['slug'] = $slug;
	    }
	    return $slug;
	}
}

if( ! function_exists('current_time')){
	function current_time(){
		$time = date("g:i a");
		return $time;
	}
}
if( ! function_exists('current_date')){
	function current_date(){
		$date = date("j F, Y");
		return $date;	
	}
}

if( ! function_exists('created_at')){
	function created_at($date){

		$timespan = timespan(strtotime($date));
		$timespan = explode(',', $timespan);
		$created = $timespan['0'];
		if(isset($timespan['1'])){
			$created .= ', '.$timespan['1'];
		}

	return($created);
	}
}

if(!function_exists('encode_id'))
{
	function encode_id($id)
	{
		$ci=& get_instance();
		$ci->load->library('encrypt');
		$encrypted_id = $ci->encrypt->encode($id);
		return $encrypted_id;
	}
}

if(!function_exists('encode_ajax_id'))
{
	function encode_ajax_id($id)
	{
		$ci=& get_instance();
		$ci->load->library('encrypt');
		$encrypted_id = $ci->encrypt->encode($id);
		return $encrypted_id;
	}
}

if(!function_exists('get_attr_id'))
{
	function get_attr_id($id)
	{
		$ci=& get_instance();
		$ci->load->library('encrypt');
		$encrypted_id = $ci->encrypt->decode($id);
		return $encrypted_id;
	}
}

if(!function_exists('get_attr_hash'))
{
	function get_attr_hash($id)
	{
		$ci=& get_instance();
		$ci->load->library('encrypt');
		$encrypted_id = $ci->encrypt->encode($id);
		return $encrypted_id;
	}
}

if(!function_exists('order_status'))
{
	function order_status()
	{
		// create ci instance
		$ci=& get_instance();

		// load required models
		$ci->load->model('order_status_model');
		$get_status = $ci->order_status_model->get_all();
		$status = array();
		foreach ($get_status as $single) 
		{
			$status[] = $single->name;
		}
		return $status;
	}
}