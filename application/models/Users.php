<?php
class Users extends CI_Model
{
	public function __construct() {
		$this->load->database();
	}

	public function getUsers($slug = FALSE) {
		if($slug === FALSE) {
			$query = $this->db->get('users');
			return $query->result_array();
		}
		else {
			$query = $this->db->get_where('users', array(
				'id' => $slug,
			));
			return $query->result_array();
		}
	}
}