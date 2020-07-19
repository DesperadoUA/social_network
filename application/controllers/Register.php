<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
	public function index() {
		$data['title'] = 'Регистрация нового пользователя';
		$this->load->view('static_page/register', $data);
	}
}