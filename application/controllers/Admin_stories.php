<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Admin_Controller.php';
include ROOT.'/admin_modules/index.php';

class Admin_Research extends Admin_Controller
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
				'editor' => 'MM_Module_Textarea',
				'key' => 'protocol_name',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'therapeutic_area',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Textarea',
				'key' => 'name_organization',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'data_start',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'data_finish',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Relative',
				'key' => 'relative_clinic',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Relative',
				'key' => 'relative_city',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Checkbox',
				'key' => 'active',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'region',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'city',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'disease',
				'JSON' => false
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'researchers',
				'JSON' => false
			],
		],
	];
	public function __construct() {
		parent::__construct();
		$this->load->model('post');
		$this->load->model('research_meta');
		$this->load->model('relative_research');
	}
	public function index() {
		$data['title'] = 'Исследования';
		$data['pages'] = $this->research->getAllPages();
		$this->load->view('admin/page', $data);
	}
	public function single($id) {
		$data = $this->research->getDataByID($id);
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
				'id' => $this->relative_research->getArrByKey($id, 'clinic_id')
			];

			$research = $this->research->getPostsByLang($data['lang']);
			$relative_research = [];
			foreach ($research as $item) {
				$relative_research[] = [
					'id' => $item['id'],
					'post_title' => $item['title']
				];
			}

			$data['relative_research'] = [
				'all_data' => $relative_research,
				'id' => $this->relative_research->getArrByKey($id, 'research_id')
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
				'id' => $this->relative_research->getArrByKey($id, 'city_id')
			];

			if($data['lang'] === 'ru') $lang_translate = 'ua';
			else $lang_translate = 'ru';

			$post_without_translate = $this->research->getPostWithOutTranslate($lang_translate);
			$current_translate = $this->relative_research->getDataByKey($data['id'], 'translate');
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
				$current = $this->research->getDataById($current_translate);
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

			if(empty($data['additional_fields'])) $data['additional_fields'] = [];
			else $data['additional_fields'] = json_decode($data['additional_fields'], true);

			$this->load->view('admin/edit_template/research', $data);
		}
	}
	public function update() {

		$id = $_POST['id'];
		$candidate = MM_Module_Input::getData('permalink');
		$data['permalink'] = $this->permalinkUpdate('research', $candidate, $id);
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
		//$data['lang'] = MM_Module_Radio_Button::getData('lang');

		//--------- Post meta -----------//

		$data_meta['protocol_name'] = MM_Module_Textarea::getData('protocol_name');
		$data_meta['therapeutic_area'] = MM_Module_Input::getData('therapeutic_area');
		$data_meta['name_organization'] = MM_Module_Textarea::getData('name_organization');
		$data_meta['data_start'] = MM_Module_Input::getData('data_start');
		$data_meta['data_finish'] = MM_Module_Input::getData('data_finish');
		$data_meta['active'] = MM_Module_Checkbox::getData('active');
		$data_meta['region'] = MM_Module_Input::getData('region');
		$data_meta['city'] = MM_Module_Input::getData('city');
		$data_meta['disease'] = MM_Module_Input::getData('disease');
		$data_meta['researchers'] = MM_Module_Input::getData('researchers');
		$data_meta['clinic_name'] = MM_Module_Input::getData('clinic_name');
		$data_meta['open_set'] = MM_Module_Checkbox::getData('open_set');
		$data_meta['for_volunteers'] = MM_Module_Checkbox::getData('for_volunteers');
		$data_meta['paid'] = MM_Module_Checkbox::getData('paid');
		$data_meta['additional_fields'] = json_encode(MM_Module_Two_Input::getData('additional_fields'), JSON_UNESCAPED_UNICODE);
		
		//--------- Post relative -----------//

		$data_relative['clinic'] = MM_Module_Relative::getData('relative_clinic');
		$data_relative['city'] = MM_Module_Relative::getData('relative_city');
		$data_relative['research'] = MM_Module_Relative::getData('relative_research');
		$data_relative['translate'] = MM_Module_Select::getData('translate');
		
		$this->research->updateDateById($id, $data);
		$this->research_meta->updateDateByForeignId($id, $data_meta);
		$this->relative_research->addArrByKey($id, 'city_id', $data_relative['city']);
		$this->relative_research->addArrByKey($id, 'clinic_id', $data_relative['clinic']);
		$this->relative_research->addArrByKey($id, 'research_id', $data_relative['research']);
		$this->relative_research->updateTranslateById($id, $data_relative['translate']);
		redirect('/admin/research/'.$id, 'location', 301);
	}
	public function add() {
		$data['title'] = "Добавить исследование";
		$data['current_date'] = date("Y-m-d H:i:s");
		$data['thumbnail'] = '';
		$this->load->view('admin/add_template/research', $data);
	}
	public function addPost(){
		
		$data['title'] = MM_Module_Cyr_To_Lat::getData('title');
		$data['permalink'] = $this->newPermalink('research', MM_Module_Cyr_To_Lat::getData('permalink'));
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

		$data_meta['protocol_name'] = MM_Module_Textarea::getData('protocol_name');
		$data_meta['therapeutic_area'] = MM_Module_Input::getData('therapeutic_area');
		$data_meta['name_organization'] = MM_Module_Textarea::getData('name_organization');
		$data_meta['data_start'] = MM_Module_Input::getData('data_start');
		$data_meta['data_finish'] = MM_Module_Input::getData('data_finish');
		$data_meta['active'] = MM_Module_Checkbox::getData('active');
		$data_meta['region'] = MM_Module_Input::getData('region');
		$data_meta['city'] = MM_Module_Input::getData('city');
		$data_meta['disease'] = MM_Module_Input::getData('disease');
		$data_meta['researchers'] = MM_Module_Input::getData('researchers');
		$data_meta['clinic_name'] = MM_Module_Input::getData('clinic_name');
		$data_meta['open_set'] = MM_Module_Checkbox::getData('open_set');
		$data_meta['for_volunteers'] = MM_Module_Checkbox::getData('for_volunteers');
		$data_meta['paid'] = MM_Module_Checkbox::getData('paid');
		$data_meta['additional_fields'] = json_encode(MM_Module_Two_Input::getData('additional_fields'), JSON_UNESCAPED_UNICODE);

		$insert_id = $this->research->insert($data);
		$this->research_meta->updateDateByForeignId($insert_id, $data_meta);
		$this->relative_research->addDataByKey($insert_id, 'translate', '0');
		redirect('/admin/research/'.$insert_id, 'location', 301);
		
	}
	public function delete(){
		$this->research->delete($_POST['id']);
		$this->relative_research->deleteTranslateById($_POST['id']);
		$this->relative_research->deleteByPostIdKey($_POST['id'], 'research_id');
		redirect('/admin/research/', 'location', 301);
	}
	private static function checkData($data){
		return "Check";
	}
}
