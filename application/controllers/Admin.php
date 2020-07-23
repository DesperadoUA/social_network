<?php

class Admin extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		if(isset($_COOKIE['admin'])) {
			session_start();
			$_SESSION['admin'] = $_COOKIE['admin'];
		}
		if(!isset($_SESSION['admin'])) redirect('/login', 'location', 301);
		$this->load->model('static_page');
	}
	public function index() {
		$this->load->view('admin/admin');
	}
	public function page(){
		$data['h1'] = 'Статические страницы';
		$data['pages'] = $this->static_page->getAllPage();
		$this->load->view('admin/page', $data);
	}
	public function logout(){
		$this->output->delete_cache();
		if(isset($_SESSION['admin'])) {
			unset($_SESSION['admin']);
			unset($_COOKIE['admin']);
			setcookie('admin', null, -1, '/');
			redirect('/login', 'location', 301);
		}
	}
	public function questionary(){
		$data['h1'] = 'Анкеты';
		$this->load->view('admin/questionary', $data);
	}
	public function tests(){
		$data['h1'] = 'Тестирования';
		$this->load->view('admin/tests', $data);
	}
}