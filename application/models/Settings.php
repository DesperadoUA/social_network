<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends CI_Model
{
	const NAME_DB = 'settings';
	public function __construct() {
		$this->load->database();
	}
	public function getAllPage() {
		$query = $this->db->get(self::NAME_DB);
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
	public function updateDateById($id, $data) {
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update(self::NAME_DB);
	}
	public function getAllPagesByLang($lang) {
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'lang' => $lang,
			)
		);
		return $query->result_array();
	}
}