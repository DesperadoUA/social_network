<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Admin_Controller.php';
include ROOT.'/admin_modules/index.php';

class Admin_Stories extends Admin_Controller
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
			]

		],
	];
	public function __construct() {
		parent::__construct();
		$this->load->model('stories');
		$this->load->model('stories_meta');
		$this->load->model('relative_stories');
	}
	public function index() {
		$data['title'] = 'Истории';
		$data['pages'] = $this->stories->getAllPages();
		$this->load->view('admin/page', $data);
	}
	public function single($id) {
		$data = $this->stories->getDataByID($id);
		if(empty($data)) show_404();
		else {
			$data = $data[0];

			if($data['lang'] === 'ru') $lang_translate = 'ua';
			else $lang_translate = 'ru';

			$post_without_translate = $this->stories->getPostWithOutTranslate($lang_translate);
			$current_translate = $this->relative_stories->getDataByKey($data['id'], 'translate');
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
				$current = $this->stories->getDataById($current_translate);
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

			$this->load->view('admin/edit_template/stories', $data);
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

		//--------- Post meta -----------//

		$data_meta['name'] = MM_Module_Input::getData('name');

		//--------- Post relative -----------//

		$data_relative['translate'] = MM_Module_Select::getData('translate');
		
		$this->stories->updateDateById($id, $data);
		$this->stories_meta->updateDateByForeignId($id, $data_meta);
		$this->relative_stories->updateTranslateById($id, $data_relative['translate']);
		redirect('/admin/stories/'.$id, 'location', 301);
	}
	public function add() {
		$data['title'] = "Добавить историю";
		$data['current_date'] = date("Y-m-d H:i:s");
		$data['thumbnail'] = '';
		$this->load->view('admin/add_template/stories', $data);
	}
	public function addPost(){
		$data['title'] = MM_Module_Cyr_To_Lat::getData('title');
		$data['permalink'] = $this->newPermalink('stories', MM_Module_Cyr_To_Lat::getData('permalink'));
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

		$insert_id = $this->stories->insert($data);
		$this->stories_meta->updateDateByForeignId($insert_id, $data_meta);
		$this->relative_stories->addDataByKey($insert_id, 'translate', '0');
		redirect('/admin/stories/'.$insert_id, 'location', 301);
		
	}
	public function delete(){
		$this->relative_stories->deleteTranslateById($_POST['id']);
		$this->stories->delete($_POST['id']);
		redirect('/admin/stories', 'location', 301);
	}
	private static function checkData($data){
		return "Check";
	}
}
