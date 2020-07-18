<?php

class Blog extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users');
	}

	public function index() {
		$data['title'] = 'Category blog';
		$data['footer_text'] = 'Text in footer';
		$data['h1'] = 'Category h1';
		$users = $this->users->getUsers();
		/*echo "<pre>";
		var_dump($users);
		echo "</pre>";
		*/
		$this->load->view('blog/category', $data);
	}

	public function single($id) {
		$data['title'] = 'Single blog';
		$data['footer_text'] = 'Text in footer';
		$data['h1'] = 'Single blog h1 '.$id;
		$this->load->view('blog/index', $data);
	}
}