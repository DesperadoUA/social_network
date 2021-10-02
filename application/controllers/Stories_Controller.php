<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Front_Controller.php';

class Stories_Controller extends Front_Controller
{
	const LIMIT_POSTS = 6;
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$CURRENT_SEGMENT = LANG === 'ru' ? 2 : 1;
		$page_url = '/'.$this->uri->segment($CURRENT_SEGMENT);

		$data = $this->static_page->getDataByUrl($page_url)[0];
		$this->data['body'] = $data;
		$this->data['body']['content'] = json_decode($data['content'], true);
		$this->data['body']['h1'] = $this->data['body']['content']['h1'];
		$this->data['body']['total_posts'] = $this->stories->getTotalPublicPostsByLang(LANG);
		$this->data['body']['posts_on_page'] = 6;
		$translate_id = $this->relative_static_page->getDataByKey($data['id'], 'translate');
		if(!empty($translate_id)) {
			$url = $this->static_page->getDataById($translate_id)[0]['permalink'];
			$this->data['body']['permalink'] = LANG_PREFIX_LINK.$this->data['body']['permalink'];
			LANG === 'ru' ? $PREFIX_TRANSLATE = '' : $PREFIX_TRANSLATE = '/ru';
			$this->data['body']['translate'] = $PREFIX_TRANSLATE.$url;
		}
		$offset = 0 ;
		$this->data['posts'] = $this->stories->getPublicPosts($offset, self::LIMIT_POSTS, LANG);
		for($i = 0; $i<count($this->data['posts']); $i++) {
			$this->data['posts'][$i]['thumbnail'] = json_decode($this->data['posts'][$i]['thumbnail'], true);
			$this->data['posts'][$i]['permalink'] = LANG_PREFIX_LINK.'/'.$this->data['posts'][$i]['slug'].'/'.$this->data['posts'][$i]['permalink'];
		}
		$this->load->view('stories/index', $this->data);
	}

	public function single($id) {
		$data = $this->stories->getDataByPermalink($id, LANG);
		if(!empty($data)){
			$data = $data[0];
			$this->data['body'] = $data;
			$this->data['body']['content'] = $data['content'];
			$this->data['body']['thumbnail'] = json_decode($data['thumbnail'], true);

			$translate_id = $this->relative_stories->getDataByKey($data['id'], 'translate');
			if(!empty($translate_id)) {
				$translate = $this->stories->getPublicDataById($translate_id);
				if(!empty($translate)) {
					$this->data['body']['permalink'] = LANG_PREFIX_LINK.'/'.$this->data['body']['slug'].'/'.$this->data['body']['permalink'];
					LANG === 'ru' ? $PREFIX_TRANSLATE = '' : $PREFIX_TRANSLATE = '/ru';
					$this->data['body']['translate'] = $PREFIX_TRANSLATE.'/'.$translate[0]['slug'].'/'.$translate[0]['permalink'];
				}
			}

			$this->load->view('stories/single', $this->data);
		}
		else {
			$this->show_404();
		}
	}
}