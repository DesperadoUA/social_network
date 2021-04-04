<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Admin_Controller.php';
include ROOT.'/admin_modules/index.php';

class Admin_Post extends Admin_Controller
{
	const NAME_DB = 'posts';
	const ARR_POST_TYPE_KEY = [
		'clinic' => [
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'full_name'
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'city'
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'region'
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'address'
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'researchers'
			],
			[
				'type' => 'string',
				'editor' => 'MM_Module_Input',
				'key' => 'therapeutic_area'
			]
		],
		'blog' => [], 
		'city' => []
	];
	const DEFAULT_VALUE = [
		'string' => '',
		'array' => []
	];
	public function __construct()
	{
		parent::__construct();
		$this->load->model('post');
		$this->load->model('post_meta');
	}
	public function index() {
		$data['title'] = 'Посты';
		$post_type = $this->uri->segment(2);
		$data['pages'] = $this->post->getAllPages($post_type);
		$this->load->view('admin/page', $data);
	}
	public function single($id) {
		$data = $this->post->getDataByID($id);
		if(empty($data)) show_404();
		else {
			$data = $data[0];
			foreach (self::ARR_POST_TYPE_KEY[$data['post_type']] as $value) {
				$item = $this->post_meta->getDataByKey($data['id'], $value['key']);
				if(empty($item)) $data[$value['key']] =  self::DEFAULT_VALUE[$value['type']];
				else $data[$value['key']] = $item;

			}
			/* Translate */
			if($data['lang'] === 'ru') $lang_translate = 'ua';
			else $lang_translate = 'ru';

			$post_without_translate = $this->post->getPostWithOutTranslate($lang_translate, $data['post_type']);
			$current_translate = $this->relative_post->getDataByKey($data['id'], 'translate');

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
				$current = $this->post->getDataById($current_translate)[0];
				$current_post_translate = [
					'id' => $current['id'],
					'post_title' => $current['title']
				];
				$post_translate[] = $current_post_translate;
				$data['post_translate'] = [
					'all_data' => $post_translate,
					'id' => $current['id']
				];
			}
			/* End Translate */
			$this->load->view('admin/edit_template/index', $data);
		}
	}
	public function update() {

		$id = $_POST['id'];
		$post_type = $this->post->getPostTypeById($id);
		$candidate = MM_Module_Input::getData('permalink');
		$data['permalink'] = $this->permalinkUpdate('posts', $candidate, $id);
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
		$data_relative['translate'] = MM_Module_Select::getData('translate');

        //--------- Post meta -----------//
		foreach (self::ARR_POST_TYPE_KEY[$post_type] as $value){
			$result = call_user_func_array([$value['editor'], 'getData'], [$value['key']]);
			$this->post_meta->addDataByKey($id, $value['key'], $result);
		}

		$this->post->updateDateById($id, $data);
		$this->relative_post->updateTranslateById($id, $data_relative['translate']);
		redirect('/admin/'.$post_type.'/'.$id, 'location', 301);
	}
	public function add() {
		$data['title'] = "Добавить пост";
		$data['current_date'] = date("Y-m-d H:i:s");
		$data['thumbnail'] = '';
		$data['post_type'] = $this->uri->segment(2);
		$this->load->view('admin/add_template/post', $data);
	}
	public function addPost(){
		$data['post_type'] = $_POST['post_type'];
		$data['title'] = MM_Module_Cyr_To_Lat::getData('title');
		$data['permalink'] = $this->newPermalink(self::NAME_DB, MM_Module_Cyr_To_Lat::getData('permalink'));
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
		$data['slug'] = $_POST['post_type'];

		$insert_id = $this->post->insert($data);
		$this->relative_post->addDataByKey($insert_id, 'translate', '0');
		redirect('/admin/'.$data['post_type'].'/'.$insert_id, 'location', 301);

	}
	public function delete(){
		$id = $_POST['id'];
		$post_type = $this->post->getPostTypeById($id);
		$this->relative_post->deleteTranslateById($id);
		$this->post->delete($id);
		redirect('/admin/'.$post_type.'/', 'location', 301);
	}
}