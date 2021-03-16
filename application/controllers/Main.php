<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Front_Controller.php';

class Main extends Front_Controller
{
	const LIMIT_MAIN = 6;
	public function index() {
		$page_url = '/'.$this->uri->segment(1);
		$data = $this->static_page->getDataByUrl($page_url)[0];
		$this->data['body'] = $data;
		$this->data['body']['content'] = json_decode($data['content'], true);
		if($data['post_type'] === 'home') {
			$this->data['research'] = $this->research->getPublicPosts(0, self::LIMIT_MAIN, LANG);
			for($i = 0; $i<count($this->data['research']); $i++) {
				$this->data['research'][$i]['thumbnail'] = json_decode($this->data['research'][$i]['thumbnail'], true);
			}
		}
		elseif ($data['post_type'] === 'for-specialists') {

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