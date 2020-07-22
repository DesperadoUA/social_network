<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->model('admins');
	}

	public function index() {
		$data['title'] = 'Страница логина';
		$this->load->view('static_page/login', $data);
	}

	public function api(){
		$_POST = !empty($_POST) ? $_POST : json_decode(file_get_contents('php://input'), true);
		$response['status'] = 'false';
		$data = $this->admins->getAdmins($_POST['login'], $_POST['password']);
		if(!empty($data)) {
			$response['status'] = 'success';
			$response['id'] = $data[0]['id'];
		}

		echo json_encode($response);
	}
}