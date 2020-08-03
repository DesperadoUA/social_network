<?php
include_once ROOT.'/application/core/Admin_Controller.php';

class Admin extends Admin_Controller {
	public function __construct() {
		parent::__construct();
	}
	public function index() {
		$this->load->view('admin/admin');
	}
	public function page(){
		$data['h1'] = 'Статические страницы';
		$data['pages'] = $this->static_page->getAllPage();
		$this->load->view('admin/page', $data);
	}
	public function pageEdit($id) {
		$data = $this->static_page->getDataByID($id);
		if(empty($data)) show_404();
		else {
			$data = $data[0];
			$data['h1'] = 'Редактирование страницы: '.$id;
			$data['content'] = json_decode($data['content']);
			$this->load->view('admin/edit_template/'.$data['post_type'], $data);
		}
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
		$data['h1'] = 'Тесты';
		$this->load->view('admin/tests', $data);
	}
}