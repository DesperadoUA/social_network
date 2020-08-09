<?php
include ROOT.'/application/core/Admin_Controller.php';

include ROOT.'/admin_modules/MM_Module_Cyr_To_Lat/MM_Module_Cyr_To_Lat.php';
include ROOT.'/admin_modules/MM_Module_Input/MM_Module_Input.php';
include ROOT.'/admin_modules/MM_Module_Rich_Text/MM_Module_Rich_Text.php';
include ROOT.'/admin_modules/MM_Module_Two_Input/MM_Module_Two_Input.php';

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
			$data['content'] = json_decode($data['content'], true);
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
	public function staticPageUpdate(){
		$request['breadcrumbs'] = MM_Module_Two_Input::getData('breadcrumbs');
		$request['menu'] = MM_Module_Two_Input::getData('menu');
		$request['main_content'] = MM_Module_Rich_Text::getData('main_content');
		$request['title_cyr_to_lat'] = MM_Module_Cyr_To_Lat::getData('title');
		$request['permalink_cyr_to_lat'] = MM_Module_Cyr_To_Lat::getData('permalink');
		$request['title'] = MM_Module_Input::getData('title');
		$request['description'] = MM_Module_Input::getData('description');
		$request['permalink'] = MM_Module_Input::getData('permalink');
		$request['keywords'] = MM_Module_Input::getData('keywords');

		//---------------------//

		$data['title'] = $request['title'];
		$data['permalink'] = $request['permalink'];
		$data['keywords'] = $request['keywords'];
		$data['description'] = $request['description'];
		$data['content'] = [
			'text'        => $request['main_content'],
			'breadcrumbs' => $request['breadcrumbs'],
			'menu'        => $request['menu'],
		];

		$data['content'] = json_encode($data['content'], JSON_UNESCAPED_UNICODE);

		$this->static_page->updateDateById(1, $data);
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		echo "Update static page";
	}
}