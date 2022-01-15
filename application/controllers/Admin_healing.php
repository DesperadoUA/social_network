<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Admin_Controller.php';
include ROOT.'/admin_modules/index.php';

class Admin_Healing extends Admin_Controller
{
	const ARR_KEY = [
		[
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'title',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'h1',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Checkbox',
				'key' => 'public',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => '',
				'key' => 'post_type',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'permalink',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'meta_title',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'description',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'keywords',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Textarea',
				'key' => 'short_desc',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'data_publick',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'data_change',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Rich_Text',
				'key' => 'main_content',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Image',
				'key' => 'thumbnail',
				'JSON' => true
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Radio_Button',
				'key' => 'lang',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'autor_name',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'autor_experience',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'autor_specialization',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Image',
				'key' => 'autor_thumbnail',
				'JSON' => true
			]
		],
	];
	const DB = 'healing';
	public function __construct() {
		parent::__construct();
		$this->load->model('healing');
		$this->load->model('healing_meta');
		$this->load->model('relative_healing');
		$this->load->model('disease');
		$this->load->model('doctors');
	}
	public function index() {
		$data['title'] = 'Лечение';
		$data['pages'] = $this->healing->getAllPages();
		$this->load->view('admin/page', $data);
	}
	public function single($id) {
		
		$data = $this->healing->getDataByID($id);
		if(empty($data)) show_404();
		else {
			$data = $data[0];

			if($data['lang'] === 'ru') $lang_translate = 'ua';
			else $lang_translate = 'ru';

			$post_without_translate = $this->healing->getPostWithOutTranslate($lang_translate);
			$current_translate = $this->relative_healing->getDataByKey($data['id'], 'translate');
			$post_translate = [];
			foreach ($post_without_translate as $post) {
				$post_translate[] = [
					'id' => $post['id'],
					'post_title' => $post['title']
				];
			}

			if($current_translate === '0') {
				$data['post_translate'] = [
					'all_data' => $post_translate,
					'id' => 0
				];
			}
			else {
				$current = $this->healing->getDataById($current_translate);
				if(!empty($current)) {
					$current_post_translate = [
						'id' => $current[0]['id'],
						'post_title' => $current[0]['title']
					];
					$post_translate[] = $current_post_translate;
					$data['post_translate'] = [
						'all_data' => $post_translate,
						'id' => $current[0]['id']
					];
				} else {
					$data['post_translate'] = [
						'all_data' => $post_translate,
						'id' => 0
					];
				}

			}

			$disease = $this->disease->getPostsByLang($data['lang']);
			$relative_disease = [];
			foreach ($disease as $item) {
				$relative_disease[] = [
					'id' => $item['id'],
					'post_title' => $item['title']
				];
			}
			$data['relative_disease'] = [
				'all_data' => $relative_disease,
				'id' => $this->relative_healing->getArrByKey($id, 'disease')
			];

			$doctors = $this->doctors->getPostsByLang($data['lang']);
			$relative_doctors = [];
			foreach ($doctors as $item) {
				$relative_doctors[] = [
					'id' => $item['id'],
					'post_title' => $item['title']
				];
			}
			$data['relative_doctors'] = [
				'all_data' => $relative_doctors,
				'id' => $this->relative_healing->getArrByKey($id, 'doctor_id')
			];

			$this->load->view('admin/edit_template/healing', $data);
		}
	}
	public function update() {
		
		$id = $_POST['id'];
		$candidate = MM_Module_Input::getData('permalink');
		$data['permalink'] = $this->permalinkUpdate(self::DB, $candidate, $id);
		$data['title'] = MM_Module_Input::getData('title');
		$data['h1'] = MM_Module_Input::getData('h1');
		$data['status'] = MM_Module_Checkbox::getData('public');
		$data['meta_title'] = MM_Module_Input::getData('meta_title');
		$data['description'] = MM_Module_Input::getData('description');
		$data['keywords'] = MM_Module_Input::getData('keywords');
		$data['short_desc'] = MM_Module_Textarea::getData('short_desc');
		$data['data_publick'] = MM_Module_Input::getData('data_publick');
		$data['data_change'] = MM_Module_Input::getData('data_change');
		$data['content'] = MM_Module_Rich_Text::getData('main_content');
		$data['thumbnail'] = json_encode(MM_Module_Image::getData('thumbnail'), JSON_UNESCAPED_UNICODE);

		//--------- Post meta -----------//

		$data_meta['autor_name'] = MM_Module_Input::getData('autor_name');
		$data_meta['autor_experience'] = MM_Module_Input::getData('autor_experience');
		$data_meta['autor_specialization'] = MM_Module_Input::getData('autor_specialization');
		$data_meta['autor_clinic'] = MM_Module_Input::getData('autor_clinic');
		$data_meta['autor_thumbnail'] = json_encode(MM_Module_Image::getData('autor_thumbnail'), JSON_UNESCAPED_UNICODE);
		//--------- Post relative -----------//

		$data_relative['translate'] = MM_Module_Select::getData('translate');
		$data_relative['disease'] = MM_Module_Relative::getData('relative_disease');
		$data_relative['doctors'] = MM_Module_Relative::getData('relative_doctors');
		
		$this->healing->updateDateById($id, $data);
		$this->healing_meta->updateDateByForeignId($id, $data_meta);
		$this->relative_healing->updateTranslateById($id, $data_relative['translate']);
		$this->relative_healing->addArrByKey($id, 'disease', $data_relative['disease']);
		$this->relative_healing->addArrByKey($id, 'doctor_id', $data_relative['doctors']);
		redirect('/admin/healing/'.$id, 'location', 301);
	}
	public function add() {
		$data['title'] = "Добавить лучение";
		$data['current_date'] = date("Y-m-d H:i:s");
		$data['thumbnail'] = '';
		$this->load->view('admin/add_template/healing', $data);
	}
	public function addPost(){
		
		$data['title'] = MM_Module_Cyr_To_Lat::getData('title');
		$data['permalink'] = $this->newPermalink(self::DB, MM_Module_Cyr_To_Lat::getData('permalink'));
		$data['status'] = MM_Module_Checkbox::getData('public');
		$data['h1'] = MM_Module_Input::getData('h1');
		$data['meta_title'] = MM_Module_Input::getData('meta_title');
		$data['description'] = MM_Module_Input::getData('description');
		$data['keywords'] = MM_Module_Input::getData('keywords');
		$data['short_desc'] = MM_Module_Textarea::getData('short_desc');
		$data['data_publick'] = MM_Module_Input::getData('data_publick');
		$data['data_change'] = MM_Module_Input::getData('data_change');
		$data['content'] = MM_Module_Rich_Text::getData('main_content');
		$data['thumbnail'] = MM_Module_Image::getData('thumbnail');
		$data['thumbnail'] = json_encode(MM_Module_Image::getData('thumbnail'), JSON_UNESCAPED_UNICODE);
		$data['lang'] = MM_Module_Radio_Button::getData('lang');

		//--------- Post meta -----------//

		$data_meta['autor_name'] = MM_Module_Input::getData('autor_name');
		$data_meta['autor_experience'] = MM_Module_Input::getData('autor_experience');
		$data_meta['autor_specialization'] = MM_Module_Input::getData('autor_specialization');
		$data_meta['autor_clinic'] = MM_Module_Input::getData('autor_clinic');
		$data_meta['autor_thumbnail'] = json_encode(MM_Module_Image::getData('autor_thumbnail'), JSON_UNESCAPED_UNICODE);

		$insert_id = $this->healing->insert($data);
		$this->healing_meta->updateDateByForeignId($insert_id, $data_meta);
		$this->relative_healing->addDataByKey($insert_id, 'translate', '0');
		redirect('/admin/healing/'.$insert_id, 'location', 301);
		
	}
	public function delete(){
		
		$this->relative_healing->deleteTranslateById($_POST['id']);
		$this->healing->delete($_POST['id']);
		redirect('/admin/healing', 'location', 301);
	}
}
