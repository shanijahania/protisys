<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class profilemodel extends CI_Model
{
	public function getUser($uid = FALSE){

		$sql = "SELECT * FROM ".$this->db->dbprefix('users');
		if($uid){
			$sql .= " WHERE id_users = '".$uid."'";
		}
		$limit = '';
		// echo $sql;
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row;

	}
	public function updatUser($data){
		$update = '';
		$id = $data['id'];

		$update = array(
			'name' => 		$data['name'],
			'surname' => 	$data['surname'],
			'password' => 	$data['password'],
			'mobile'=> 		$data['mobile'],	
			'address'=>		$data['address'],
			'gender'=>		$data['gender'],
			'avatar'=>		$data['avatar'],
			'modified_at'=>	$data['modified_at']
		);	
		$this->db->where('id_users', $id);
		if($this->db->update('users', $update)){
			return true;
		}else{
			return false;
		}
	}
}
?>