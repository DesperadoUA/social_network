<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Static_Page extends CI_Model
{
	const NAME_DB = 'static_page';
	public function __construct() {
		$this->load->database();
	}
	public function getAllPage() {
		$query = $this->db->get('static_page');
		return $query->result_array();
	}
	public function getDataById($id){
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'id' => $id,
			)
		);
		return $query->result_array();
	}
	public function getDataByUrl($url){
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'permalink' => $url,
			)
		);
		return $query->result_array();
	}
	public function updateDateById($id, $data) {
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update(self::NAME_DB);
	}
}