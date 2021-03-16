<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Front_Controller.php';

class Clinic_Controller extends Front_Controller
{
	const LIMIT_POSTS = 8;
	const POST_TYPE = 'clinic';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('research');
	}

	public function index() {
		$this->load->library('pagination');
		$CURRENT_SEGMENT = 1;
		$PAGE_SEGMENT = 3;
		if(LANG === 'ua'){
			$CURRENT_SEGMENT = 2;
			$PAGE_SEGMENT = 4;
		}

		$config['base_url'] = LANG_PREFIX_LINK.'/'."clinics/page";
		$config['total_rows'] = $this->post->getTotalPublicPostsByLang(self::POST_TYPE, LANG);
		$config['per_page'] = self::LIMIT_POSTS;
		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['last_link'] = false;
		$config['first_link'] = false;
		$this->pagination->initialize($config);

		$page_url = '/'.$this->uri->segment($CURRENT_SEGMENT);
		$data = $this->static_page->getDataByUrl($page_url)[0];
		if(!empty($data)) {
			$this->data['filter']['city'] = $this->post_meta->getDistinctValueForPublicPosts(self::POST_TYPE, LANG, 'city');
			$this->data['filter']['region'] = $this->post_meta->getDistinctValueForPublicPosts(self::POST_TYPE, LANG, 'region');
			$this->data['filter']['therapeutic_area'] = $this->post_meta->getDistinctValueForPublicPosts(self::POST_TYPE, LANG, 'therapeutic_area');
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
				$this->data['posts'][$i]['full_name'] = $this->post_meta->getDataByKey($this->data['posts'][$i]['id'], 'full_name');
				$this->data['posts'][$i]['city'] = $this->post_meta->getDataByKey($this->data['posts'][$i]['id'], 'city');
				$this->data['posts'][$i]['address'] = $this->post_meta->getDataByKey($this->data['posts'][$i]['id'], 'address');
				$this->data['posts'][$i]['researchers'] = $this->post_meta->getDataByKey($this->data['posts'][$i]['id'], 'researchers');
				$this->data['posts'][$i]['permalink'] = LANG_PREFIX_LINK.'/'.$this->data['posts'][$i]['slug'].'/'.$this->data['posts'][$i]['permalink'];
				$total_research = $this->research_meta->getArrByKeyValue( 'clinic_id', $this->data['posts'][$i]['id']);
				$this->data['posts'][$i]['total_research'] = count($total_research);
				$relative_research_id = [];
				foreach ($total_research as $item) $relative_research_id[] = $item['post_id'];
				$this->data['posts'][$i]['total_active_research'] = $this->research->getTotalPublicActivePostsByArrId($relative_research_id);
			}
			$this->load->view('clinics/index', $this->data);
		}
		else {
			$this->output->set_status_header('404');
			$this->load->view('404');
		}
	}
	public function single($id, $page) {
		$data = $this->post->getDataByPermalink($id);
		if(!empty($data)){
			$data = $data[0];
			if(empty($page)) {
				$page = 0;
				$offset = 0;
			}
			else {
				$offset = ($page-1) * self::LIMIT_POSTS;
			}

			$relative_research = $this->research_meta->getArrByKeyValue( 'clinic_id', $data['id']);
			$research_id = [];

			foreach ($relative_research as $item) $research_id[] = $item['post_id'];
			$relative_posts = $this->research->getDataPublicActivePostsByArrId($research_id);

			$this->data['research'] = array_slice($relative_posts, $offset, self::LIMIT_POSTS);

			if(!empty($this->data['research'])) {
				for($i = 0; $i<count($this->data['research']); $i++) {
					$this->data['research'][$i]['permalink'] = LANG_PREFIX_LINK.'/'.$this->data['research'][$i]['slug'].'/'.$this->data['research'][$i]['permalink'];
					$this->data['research'][$i]['data_start'] = mb_substr($this->data['research'][$i]['data_start'], 0, 10);
					$this->data['research'][$i]['data_finish'] = mb_substr($this->data['research'][$i]['data_finish'], 0, 10);
				}
			}
			$this->data['total_research'] = count($relative_posts);

			$this->load->library('pagination');

			$config['base_url'] = LANG_PREFIX_LINK.'/'.self::POST_TYPE."/{$id}/page/";
			$config['total_rows'] = $this->data['total_research'];
			$config['per_page'] = self::LIMIT_POSTS;
			$config['num_links'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['last_link'] = false;
			$config['first_link'] = false;
			$this->pagination->initialize($config);


			$this->data['body'] = $data;
			$this->data['body']['content'] = $data['content'];
			$this->data['body']['full_name'] = $this->post_meta->getDataByKey($data['id'], 'full_name');
			$this->data['body']['city'] = $this->post_meta->getDataByKey($data['id'], 'city');
			$this->data['body']['address'] = $this->post_meta->getDataByKey($data['id'], 'address');
			$this->data['body']['therapeutic_area'] = $this->post_meta->getDataByKey($data['id'], 'therapeutic_area');

			$this->load->view('clinics/single', $this->data);
		} else {
			$this->show_404();
		}
	}
}