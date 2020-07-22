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
	}
	public function index() {
		$this->load->view('admin/admin');
	}
	public function page(){
		$this->load->view('admin/page');
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
		$this->load->view('admin/questionary');
	}
	public function tests(){
		$this->load->view('admin/tests');
	}
}