<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Admin_Controller.php';
include ROOT.'/admin_modules/index.php';

class Admin_Doctor extends Admin_Controller
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
				'key' => 'name',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'education',
				'JSON' => false
			]
		],
	];
	const DB = 'doctors';
	public function __construct() {
		parent::__construct();
		$this->load->model('post');
		$this->load->model('doctors');
		$this->load->model('doctors_meta');
		$this->load->model('relative_doctors');
		$this->load->model('relative_research');
		$this->load->model('relative_healing');
	}
	public function index() {
		$data['title'] = 'Врачи';
		$data['pages'] = $this->doctors->getAllPages();
		$this->load->view('admin/page', $data);
	}
	public function single($id) {
		$data = $this->doctors->getDataByID($id);
		if(empty($data)) show_404();
		else {
			$data = $data[0];
			$clinics = $this->post->getPostsByLang('clinic', $data['lang']);
			$relative_clinics = [];
			foreach ($clinics as $clinic) {
				$relative_clinics[] = [
					'id' => $clinic['id'],
					'post_title' => $clinic['title']
				];
			}
			$data['relative_clinics'] = [
				'all_data' => $relative_clinics,
				'id' => $this->relative_doctors->getArrByKey($id, 'clinic_id')
			];

			$cities = $this->post->getPostsByLang('city', $data['lang']);
			$relative_city = [];
			foreach ($cities as $city) {
				$relative_city[] = [
					'id' => $city['id'],
					'post_title' => $city['title']
				];
			}
			$data['relative_cityes'] = [
				'all_data' => $relative_city,
				'id' => $this->relative_doctors->getArrByKey($id, 'city_id')
			];

			if($data['lang'] === 'ru') $lang_translate = 'ua';
			else $lang_translate = 'ru';
			$post_without_translate = $this->doctors->getPostWithOutTranslate($lang_translate);
			$current_translate = $this->relative_doctors->getDataByKey($data['id'], 'translate');
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
				$current = $this->doctors->getDataById($current_translate);
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

			$this->load->view('admin/edit_template/doctor', $data);
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

		$data_meta['name'] = MM_Module_Input::getData('name');
		$data_meta['education'] = MM_Module_Input::getData('education');
		$data_meta['degree'] = MM_Module_Input::getData('degree');
		$data_meta['specialization'] = MM_Module_Input::getData('specialization');
		$data_meta['experience'] = MM_Module_Input::getData('experience');
		$data_meta['experience_cr'] = MM_Module_Input::getData('experience_cr');
		$data_meta['region'] = MM_Module_Input::getData('region');

		//--------- Post relative -----------//

		$data_relative['translate'] = MM_Module_Select::getData('translate');
		$data_relative['clinic'] = MM_Module_Relative::getData('relative_clinic');
		$data_relative['city'] = MM_Module_Relative::getData('relative_city');
		
		$this->doctors->updateDateById($id, $data);
		$this->doctors_meta->updateDateByForeignId($id, $data_meta);
		$this->relative_doctors->updateTranslateById($id, $data_relative['translate']);
		$this->relative_doctors->addArrByKey($id, 'clinic_id', $data_relative['clinic']);
		$this->relative_doctors->addArrByKey($id, 'city_id', $data_relative['city']);
		redirect('/admin/doctor/'.$id, 'location', 301);
	}
	public function add() {
		$data['title'] = "Добавить врача";
		$data['current_date'] = date("Y-m-d H:i:s");
		$data['thumbnail'] = '';
		$this->load->view('admin/add_template/doctor', $data);
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

		$data_meta['name'] = MM_Module_Input::getData('name');
		$data_meta['education'] = MM_Module_Input::getData('education');
		$data_meta['degree'] = MM_Module_Input::getData('degree');
		$data_meta['specialization'] = MM_Module_Input::getData('specialization');
		$data_meta['experience'] = MM_Module_Input::getData('experience');
		$data_meta['experience_cr'] = MM_Module_Input::getData('experience_cr');
		$data_meta['region'] = MM_Module_Input::getData('region');

		$insert_id = $this->doctors->insert($data);
		$this->doctors_meta->updateDateByForeignId($insert_id, $data_meta);
		$this->relative_doctors->addDataByKey($insert_id, 'translate', '0');
		redirect('/admin/doctor/'.$insert_id, 'location', 301);
	}
	public function delete() {
		$this->relative_research->deleteByPostIdKey($_POST['id'], 'doctor_id');
		$this->relative_healing->deleteByPostIdKey($_POST['id'], 'doctor_id');
		$this->relative_doctors->deleteTranslateById($_POST['id']);
		$this->doctors->delete($_POST['id']);
		redirect('/admin/doctor', 'location', 301);
	}
}
