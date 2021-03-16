<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Admin_Controller.php';
include ROOT.'/admin_modules/index.php';

class Admin_Post extends Admin_Controller
{
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
		'blog' => [
			[
				'type' => 'string',
				'editor' => 'MM_Module_Rich_Text',
				'key' => 'content_2'
			],
		],
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
		$data['lang'] = MM_Module_Radio_Button::getData('lang');

        //--------- Post meta -----------//
		foreach (self::ARR_POST_TYPE_KEY[$post_type] as $value){
			$result = call_user_func_array([$value['editor'], 'getData'], [$value['key']]);
			$this->post_meta->addDataByKey($id, $value['key'], $result);
		}

		$this->post->updateDateById($id, $data);
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
		$data['slug'] = $_POST['post_type'];

		$insert_id = $this->post->insert($data);
		redirect('/admin/'.$data['post_type'].'/'.$insert_id, 'location', 301);

	}
	public function delete(){
		$id = $_POST['id'];
		$post_type = $this->post->getPostTypeById($id);
		$this->post->delete($id);
		$this->post_meta->delete($id);
		redirect('/admin/'.$post_type.'/', 'location', 301);
	}

}