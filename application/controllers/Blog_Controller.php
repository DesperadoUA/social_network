<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Front_Controller.php';

class Blog_Controller extends Front_Controller
{
	const LIMIT_POSTS = 9;
	const POST_TYPE = 'blog';
	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		$this->load->library('pagination');
		$CURRENT_SEGMENT = 1;
		$PAGE_SEGMENT = 3;
		if(LANG === 'ua'){
			$CURRENT_SEGMENT = 2;
			$PAGE_SEGMENT = 4;
		}

		$config['base_url'] = LANG_PREFIX_LINK.'/'."blog/page";
		$config['total_rows'] = $this->post->getTotalPublicPostsByLang(self::POST_TYPE, LANG);
		$config['per_page'] = self::LIMIT_POSTS;
		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['last_link'] = false;
		$config['first_link'] = false;
		$this->pagination->initialize($config);

		$page_url = '/'.$this->uri->segment($CURRENT_SEGMENT);
		$data = $this->static_page->getDataByUrl($page_url);
		if(!empty($data)) {
			$data = $data[0];
			$this->data['body'] = $data;
			$this->data['body']['content'] = json_decode($data['content'], true);
			$page = $this->uri->segment($PAGE_SEGMENT);
			if(empty($page)) {
				$page = 0;
				$offset = 0;
			}
			else {
				$offset = ($page-1) * self::LIMIT_POSTS;
			}
			$this->data['posts'] = $this->post->getPublicPosts(self::POST_TYPE, $offset, self::LIMIT_POSTS, LANG);
			$this->data['total_posts'] = $this->post->getTotalPublicPostsByLang(self::POST_TYPE, LANG);
			for($i = 0; $i<count($this->data['posts']); $i++) {
				$this->data['posts'][$i]['thumbnail'] = json_decode($this->data['posts'][$i]['thumbnail'], true);
				$this->data['posts'][$i]['permalink'] = LANG_PREFIX_LINK.'/'.$this->data['posts'][$i]['slug'].'/'.$this->data['posts'][$i]['permalink'];
				$this->data['posts'][$i]['data_change'] = date("d.m.Y", strtotime($this->data['posts'][$i]['data_change']));
			}
			$this->load->view('blog/index', $this->data);
		}
		else {
			$this->output->set_status_header('404');
			$this->load->view('404');
		}
	}

	public function single($id) {
		$data = $this->post->getDataByPermalink($id);
		if(!empty($data)){
			$data = $data[0];
			$this->data['body'] = $data;
			$this->data['body']['content'] = $data['content'];
			$this->data['body']['content_2'] = $this->post_meta->getDataByKey($data['id'], 'content_2');
			$this->data['body']['thumbnail'] = json_decode($data['thumbnail'], true);
			$this->data['body']['data_change'] = date("d.m.Y", strtotime($data['data_change']));
			$this->load->view('blog/single', $this->data);
		}
		else {
			$this->show_404();
		}
	}
}