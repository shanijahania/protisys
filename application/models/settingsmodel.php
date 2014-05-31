<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class settingsmodel extends CI_Model
{
	public function getSettings($gid = FALSE){

		$sql = "SELECT * FROM ".$this->db->dbprefix('settings');
		if($gid){
			$sql .= " WHERE group_id = '".$gid."'";
		}
		$limit = '';
		// echo $sql;
		$query = $this->db->query($sql);
		$rows = $query->result();
		return $rows;

	}
	public function updatSettings($data){

		$update = '';
		$id = $data['id'];

		foreach ($data as $key => $value) {
			$update[] = array(
			'group_id' => 		$id,
			'meta_key' => 		$key,
			'meta_value' => 	$value
			);	
		}
		$this->db->delete('settings', array('group_id' => $id));

		if($this->db->insert_batch('settings', $update)){
			return true;
		}else{
			return false;
		}
	}
}
?>