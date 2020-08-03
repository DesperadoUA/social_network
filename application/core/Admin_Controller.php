<?php
class Admin_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		session_start();
		if(!isset($_SESSION['admin'])) redirect('/login', 'location', 301);
		$this->load->model('static_page');
	}
}