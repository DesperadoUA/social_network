<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index() {
		$data['title'] = 'Страница логина';
		$this->load->view('static_page/login', $data);
	}

	public function api(){
		$_POST = !empty($_POST) ? $_POST : json_decode(file_get_contents('php://input'), true);
		$data = $_POST;
		echo json_encode($data);
	}
}