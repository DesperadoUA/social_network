<?php
class Main extends CI_Controller
{
	public function index() {
		$data['title'] = 'Главная страница';
		$data['footer_text'] = 'Text in footer';
		$data['h1'] = 'Main page h1';
		$this->load->view('static_page/index', $data);
	}
}