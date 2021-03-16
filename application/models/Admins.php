<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admins extends CI_Model
{
	public function __construct() {
		$this->load->database();
	}

	public function getAdmins($login = FALSE, $password = FALSE) {
		$query = $this->db->get_where('admins', array(
			'email' => $login,
			'password' => md5($password)
		));
		return $query->result_array();
	}
}