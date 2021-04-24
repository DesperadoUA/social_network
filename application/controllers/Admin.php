<?php
include ROOT.'/application/core/Admin_Controller.php';
include ROOT.'/admin_modules/index.php';

class Admin extends Admin_Controller {
	public function __construct() {
		parent::__construct();
	}
	public function index() {
		$this->load->view('admin/admin');
	}
	public function page(){
		$data['title'] = 'Статические страницы';
		$data['pages'] = $this->static_page->getAllPage();
		$this->load->view('admin/page', $data);
	}
	public function pageEdit($id) {
		$data = $this->static_page->getDataByID($id);
		if(empty($data)) show_404();
		else {
			$data = $data[0];
			$data['h1'] = 'Редактирование страницы: '.$id;
			if(empty($data['content'])) $data['content'] = '';
			else {
				$data['content'] = json_decode($data['content'], true);
			}
			$this->load->view('admin/edit_template/home', $data);
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
	public function staticPageUpdate(){
		$id = $_POST['id'];
		$request['title'] = MM_Module_Input::getData('title');
		$request['h1'] = MM_Module_Input::getData('h1');
		$request['meta_title'] = MM_Module_Input::getData('meta_title');
		$request['description'] = MM_Module_Input::getData('description');
		$request['keywords'] = MM_Module_Input::getData('keywords');
		$request['short_desc'] = MM_Module_Textarea::getData('short_desc');
		$request['data_publick'] = MM_Module_Input::getData('data_publick');
		$request['data_change'] = MM_Module_Input::getData('data_change');
		$request['main_content'] = MM_Module_Rich_Text::getData('main_content');
		//---------------------//

		$data['title'] = $request['title'];
		$data['meta_title'] = $request['meta_title'];
		$data['description'] = $request['description'];
		$data['keywords'] = $request['keywords'];
		$data['data_publick'] = $request['data_publick'];
		$data['data_change'] = $request['data_change'];
		$data['short_desc'] = $request['short_desc'];
		$data['content'] = [
			'text' => $request['main_content'],
			'h1'   => $request['h1'],
		];

		$data['content'] = json_encode($data['content'], JSON_UNESCAPED_UNICODE);

		$this->static_page->updateDateById($id, $data);
		redirect('/admin/static-page/'.$id, 'location', 301);
	}
	public function settings(){
		$data['title'] = 'Настройки';
		$data['pages'] = $this->settings->getAllPage();
		$this->load->view('admin/page', $data);
	}
	public function settingsEdit($id) {
		$data = $this->settings->getDataByID($id);
		if(empty($data)) show_404();
		else {
			$data = $data[0];
			$data['h1'] = $data['title'];
			$data['content'] = json_decode($data['content'], true);
			$this->load->view('admin/edit_template/settings', $data);
		}
	}
	public function settingsUpdate(){
		$template = $_POST['template'];
		$id = $_POST['id'];
		
		$data = [];
		if($template === 'menu') {
			$request['menu'] = MM_Module_Two_Input::getData('menu');
			$data['content'] = [
				'menu' => $request['menu']
			];
		}
		elseif ($template === 'image') {
			$request['image'] = MM_Module_Image::getData('image');
			$data['content'] = [
				'image' => $request['image']
			];
		}
		elseif ($template === 'images_and_text') {
			$request['images_and_text'] = MM_Module_Multiple_Image_And_Text::getData('images_and_text');
			$data['content'] = [
				'images_and_text' => $request['images_and_text']
			];
		}
		elseif ($template === 'text') {
			$request['text'] = MM_Module_Input::getData('text');
			$data['content'] = [
				'text' => $request['text']
			];
		}
		elseif ($template === 'multiple_text') {
			$request['list'] = MM_Module_Multiple_Input::getData('list');
			$data['content'] = [
				'list' => $request['list']
			];
		}
		elseif ($template === 'input') {
			$request['text'] = MM_Module_Input::getData('text');
			$data['content'] = [
				'text' => $request['text']
			];
		}

		$data['content'] = json_encode($data['content'], JSON_UNESCAPED_UNICODE);
		$this->settings->updateDateById($id, $data);
		redirect('/admin/settings/'.$id, 'location', 301);
	}
	public function options(){
		$data['title'] = 'Опции';
		$data['pages'] = $this->options->getAllPages();
		$this->load->view('admin/page', $data);
	}
	public function optionsEdit($id) {
		$data = $this->options->getDataByID($id);
		if(empty($data)) show_404();
		else {
			$data = $data[0];
			$data['h1'] = $data['title'];
			$data['content'] = json_decode($data['content'], true);
			$this->load->view('admin/edit_template/settings', $data);
		}
	}
	public function optionsUpdate(){
		
		$template = $_POST['template'];
		$id = $_POST['id'];
		$data = [];
		if($template === 'menu') {
			$request['menu'] = MM_Module_Two_Input::getData('menu');
			$data['content'] = [
				'menu' => $request['menu']
			];
		}
		elseif ($template === 'image') {
			$request['image'] = MM_Module_Image::getData('image');
			$data['content'] = [
				'image' => $request['image']
			];
		}
		elseif ($template === 'images_and_text') {
			$request['images_and_text'] = MM_Module_Multiple_Image_And_Text::getData('images_and_text');
			$data['content'] = [
				'images_and_text' => $request['images_and_text']
			];
		}
		elseif ($template === 'text') {
			$request['text'] = MM_Module_Input::getData('text');
			$data['content'] = [
				'text' => $request['text']
			];
		}
		elseif ($template === 'multiple_text') {
			$request['list'] = MM_Module_Multiple_Input::getData('list');
			$data['content'] = [
				'list' => $request['list']
			];
		}
		elseif ($template === 'input') {
			$request['text'] = MM_Module_Input::getData('text');
			$data['content'] = [
				'text' => $request['text']
			];
		}
		elseif ($template === 'checkbox') {
			$request['text'] = MM_Module_Checkbox::getData('status');
			$data['content'] = [
				'status' => $request['text']
			];
		}

		$data['content'] = json_encode($data['content'], JSON_UNESCAPED_UNICODE);
		$this->options->updateDateById($id, $data);
		redirect('/admin/options/'.$id, 'location', 301);
	}
}