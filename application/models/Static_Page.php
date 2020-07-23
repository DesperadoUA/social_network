<?php
class Static_Page extends CI_Model
{
	public function __construct() {
		$this->load->database();
	}

	public function getAllPage() {
		$query = $this->db->get('static_page');
		return $query->result_array();
	}
}