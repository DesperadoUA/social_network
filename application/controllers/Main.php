<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Front_Controller.php';

class Main extends Front_Controller
{
	const LIMIT_MAIN = 6;
	public function index() {
		if(base_url() === current_url() or base_url().'ua' === current_url()) $PAGE_SEGMENT = 1;
		else LANG === 'ua' ? $PAGE_SEGMENT = 2 : $PAGE_SEGMENT = 1;

		$page_url = '/'.$this->uri->segment($PAGE_SEGMENT);
		$data = $this->static_page->getDataByUrl($page_url)[0];
		$this->data['body'] = $data;
		$this->data['body']['content'] = json_decode($data['content'], true);
		$this->data['body']['translate'] = '';
		$translate_id = $this->relative_static_page->getDataByKey($data['id'], 'translate');
		if(!empty($translate_id)) {
			$url = $this->static_page->getDataById($translate_id)[0]['permalink'];
			if(base_url() === current_url() or base_url().'ua' === current_url()) {
				$this->data['body']['permalink'] = $this->data['body']['permalink'];
				$this->data['body']['translate'] = $url;
			} else {
				$this->data['body']['permalink'] = LANG_PREFIX_LINK.$this->data['body']['permalink'];
				LANG === 'ru' ? $PREFIX_TRANSLATE = '/ua' : $PREFIX_TRANSLATE = '';
				$this->data['body']['translate'] = $PREFIX_TRANSLATE.$url;
			}
		}
		if($data['post_type'] === 'home') {
			$this->data['research'] = $this->research->getPublicPosts(0, self::LIMIT_MAIN, LANG);
			for($i = 0; $i<count($this->data['research']); $i++) {
				$this->data['research'][$i]['thumbnail'] = json_decode($this->data['research'][$i]['thumbnail'], true);
			}
		}

		$this->load->view('static_page/'.$data['post_type'], $this->data);
	}
	public function show_404(){
		$this->output->set_status_header('404');
		$this->data['body']['meta_title'] = 'Not found 404';
		$this->data['body']['keywords'] = 'Not found 404';
		$this->data['body']['description'] = 'Not found 404';
		$this->data['body']['post_type'] = '404';
		$this->data['body']['content']['h1'] = '404';
		$this->data['body']['short_desc'] = 'Страница не найдена';
		$this->load->view('static_page/404', $this->data);
	}
}