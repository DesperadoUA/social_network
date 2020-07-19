<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		$data['users'] = $this->users->getUsers();
		$this->load->view('blog/category', $data);
	}

	public function single($id) {
		$data['title'] = 'Single blog';
		$data['footer_text'] = 'Text in footer';
		$data['h1'] = 'Single blog h1 '.$id;
		$data['users'] = $this->users->getUsers($id);
		if(empty($data['users'])) show_404();
		else $this->load->view('blog/index', $data);
	}
}