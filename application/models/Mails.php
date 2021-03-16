<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mails extends CI_Model
{
	const NAME_DB = 'mails';
	public function __construct() {
		$this->load->database();
	}
	public function getAllPages() {
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
	public function insert($data){
		$this->db->insert(self::NAME_DB, $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function updateDateById($id, $data) {
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update(self::NAME_DB);
	}
}