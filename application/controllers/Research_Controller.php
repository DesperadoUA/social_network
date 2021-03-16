<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Front_Controller.php';

class Research_Controller extends Front_Controller
{
	const LIMIT_POSTS = 8;
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->load->library('pagination');
		$path_lang = '';
		$total_posts = $this->research->getTotalPublicPostsByLang(LANG);
		if(LANG === 'ua') $path_lang = '/ua';
		$config['base_url'] = "{$path_lang}/research/page/";
		$config['total_rows'] = $total_posts;
		$config['per_page'] = self::LIMIT_POSTS;
		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['last_link'] = false;
		$config['first_link'] = false;
		$this->pagination->initialize($config);

		/*----- Filters -----*/
		$this->data['filter']['city'] = $this->research->getDistinctValueForPublicPosts(LANG, 'city');
		$this->data['filter']['region'] = $this->research->getDistinctValueForPublicPosts(LANG, 'region');
		$this->data['filter']['disease'] = $this->research->getDistinctValueForPublicPosts(LANG, 'disease');
		$this->data['filter']['clinics'] = [];
		$arr_clinic_id = $this->research->getDistinctClinics(LANG);
		foreach ($arr_clinic_id as $item) $clinics_id[] = $item['value'];
		$clinics = $this->post->getPublicPostsByArrId($clinics_id);
		foreach ($clinics as $item) {
			$this->data['filter']['clinics'][] = [
				'title' => $item['title'],
				'id' => $item['id']
			];
		}
		/*----- Filters End -----*/

		$page_url = '/'.$this->uri->segment(1);
		$data = $this->static_page->getDataByUrl($page_url)[0];
		$this->data['body'] = $data;
		$this->data['body']['content'] = json_decode($data['content'], true);
		$this->data['body']['h1'] = $this->data['body']['content']['h1'];
		$this->data['body']['total_posts'] = $total_posts;

		$page = $this->uri->segment(3);
		if(empty($page)) {
			$page = 0;
			$offset = 0;
		}
		else {
			$offset = ($page-1) * self::LIMIT_POSTS;
		}
		$this->data['research'] = $this->research->getPublicPosts($offset, self::LIMIT_POSTS, LANG);
		for($i = 0; $i<count($this->data['research']); $i++) {
			$this->data['research'][$i]['thumbnail'] = json_decode($this->data['research'][$i]['thumbnail'], true);
			$this->data['research'][$i]['permalink'] = LANG_PREFIX_LINK.'/'.$this->data['research'][$i]['slug'].'/'.$this->data['research'][$i]['permalink'];
			$this->data['research'][$i]['data_start'] = mb_substr($this->data['research'][$i]['data_start'], 0, 10);
			$this->data['research'][$i]['data_finish'] = mb_substr($this->data['research'][$i]['data_finish'], 0, 10);
		}
		$this->load->view('research/index', $this->data);
	}

	public function single($id) {
		$data = $this->research->getDataByPermalink($id);
		if(!empty($data)){
			$data = $data[0];
			$data_meta['additional_fields'] = $this->research_meta->getDataByKey($data['id'], 'additional_fields');
			if(!empty($data_meta['additional_fields'])) {
				$data_meta['additional_fields'] = json_decode($data_meta['additional_fields'], true);
			}
			$relative_clinic = [];
			$relative_clinic_id = $this->research_meta->getArrByKey($data['id'], 'clinic_id');
			if(!empty($relative_clinic_id)) {
				$clinics = $this->post->getPublicPostsByArrId($relative_clinic_id);
				foreach ($clinics as $item)  {
					$relative_clinic[] = [
						'title' => $item['title'],
						'permalink' => LANG_PREFIX_LINK.'/'.$item['slug'].'/'.$item['permalink'],
						'researchers' => $this->post_meta->getDataByKey($item['id'], 'researchers'),
						'city' => $this->post_meta->getDataByKey($item['id'], 'city'),
						'region' => $this->post_meta->getDataByKey($item['id'], 'region'),
					];
				}
			}
			$this->data['body'] = $data;
			$this->data['body']['data_start'] = mb_substr($data['data_start'], 0, 10);
			$this->data['body']['data_finish'] = mb_substr($data['data_finish'], 0, 10);
			$this->data['body']['additional_fields'] = $data_meta['additional_fields'];
			$this->data['body']['relative_clinic'] = $relative_clinic;
			$this->load->view('research/single', $this->data);
		}
		else {
			$this->show_404();
		}
	}
}

/*
 * регион * +
 * город * +
 * заболевание * +
 * исследователи * +
 * мед учереждение * +
 * с открытым набором *
 * для здоровых добровольцев *
 *
 * название протокола  +
 * терапевтическая область +
 * дата начала ки +
 * дата конца ки +
 * связь с клиникой +
 * активность исследования +
 * */