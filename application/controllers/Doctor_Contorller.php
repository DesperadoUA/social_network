<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Front_Controller.php';
include ROOT.'/application/helpers/CardBuilder.php';

class Doctor_Contorller extends Front_Controller
{
	const LIMIT_POSTS = 9;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('post');
		$this->load->model('doctors');
		$this->load->model('relative_doctors');
		$this->load->model('relative_research');
		$this->load->model('research');
	}

	public function index() {
		$this->load->library('pagination');
		$CURRENT_SEGMENT = 1;
		$PAGE_SEGMENT = 3;
		if(LANG === 'ru') {
			$CURRENT_SEGMENT = 2;
			$PAGE_SEGMENT = 4;
		}
		$page_url = '/'.$this->uri->segment($CURRENT_SEGMENT);

		$total_posts = $this->doctors->getTotalPublicPostsByLang(LANG);
		$config['base_url'] = LANG_PREFIX_LINK.$page_url."/page";
		$config['total_rows'] = $total_posts;
		$config['per_page'] = self::LIMIT_POSTS;
		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['last_link'] = false;
		$config['first_link'] = false;
		$this->pagination->initialize($config);

		/*----- Filters -----*/
		$arr_city = [];
		$city = $this->post->getPublicPosts('city', 0, 0, LANG);
		if(!empty($city)) {
			foreach ($city as $item) $arr_city[] = $item['title'];
		}
		$this->data['filter']['city'] = $arr_city;

		$arr_specialization = [];
		$specialization = $this->doctors->getDistinctSpecialization(LANG);
		if(!empty($specialization)) {
			foreach ($specialization as $item) $arr_specialization[] = $item['specialization'];
		}
		$this->data['filter']['specialization'] = $arr_specialization;

		$data = $this->static_page->getDataByUrl($page_url);
		if(!empty($data)) {
			$data = $data[0];
			$this->data['body'] = $data;
			$this->data['body']['content'] = json_decode($data['content'], true);
			$this->data['body']['total_posts'] = $total_posts;
			$page = $this->uri->segment($PAGE_SEGMENT);
			if(empty($page)) {
				$page = 0;
				$offset = 0;
			}
			else {
				$offset = ($page-1) * self::LIMIT_POSTS;
			}
			$posts = $this->doctors->getPublicPosts($offset, self::LIMIT_POSTS, LANG);
			$this->data['posts'] = [];
			$this->data['total_posts'] = $this->doctors->getTotalPublicPostsByLang(LANG);

			foreach($posts as $post) {
				$city_id = $this->relative_doctors->getDataByKey($post['id'], 'city_id');
				$clinic_id = $this->relative_doctors->getDataByKey($post['id'], 'clinic_id');
				$city_arr = $this->post->getPublicPostsByArrId($city_id);
				$clinic_arr = $this->post->getPublicPostsByArrId($clinic_id);
				$city = empty($city_arr) ? '' : $city_arr[0]['title'];
				$clinic = empty($clinic_arr) ? '' : $clinic_arr[0]['title'];
				$research_arr = $this->relative_research->getArrByKeyValue('doctor_id', $post['id']);
				$research_id = [];
				foreach($research_arr as $item) $research_id[] = $item['post_id'];
				$research = $this->research->getPostsByArrId($research_id);

				$year = ($post['experience_cr'] > 4) 
				        ? $post['experience_cr']." ".TRANSLATE['YEAR_PLURAL'][LANG] 
						: $post['experience_cr']." ".TRANSLATE['YEAR'][LANG];
				$this->data['posts'][] = [
					'title' => $post['title'],
					'permalink' => LANG_PREFIX_LINK.'/'.$post['slug'].'/'.$post['permalink'],
					'city' => $city,
					'clinic' => $clinic,
					'experience_cr' => $year,
					'count_research' => count($research)
				];
			}
			
			$translate_id = $this->relative_static_page->getDataByKey($data['id'], 'translate');
			if(!empty($translate_id)) {
				$url = $this->static_page->getDataById($translate_id)[0]['permalink'];
				$this->data['body']['permalink'] = LANG_PREFIX_LINK.$this->data['body']['permalink'];
				LANG === 'ru' ? $PREFIX_TRANSLATE = '' : $PREFIX_TRANSLATE = '/ru';
				$this->data['body']['translate'] = $PREFIX_TRANSLATE.$url;
			}
			$this->load->view('doctors/index', $this->data);
			
		}
		else {
			$this->output->set_status_header('404');
			$this->load->view('404');
		}
	}

	public function single($id) {
		$data = $this->doctors->getDataByPermalink($id, LANG);
		if(!empty($data)){
			$data = $data[0];
			$this->data['body'] = $data;
			$this->data['body']['content'] = $data['content'];
			$this->data['body']['thumbnail'] = json_decode($data['thumbnail'], true);

			$clinic_id = $this->relative_doctors->getDataByKey($data['id'], 'clinic_id');
			$clinic_arr = $this->post->getPublicPostsByArrId($clinic_id);
			$clinic = empty($clinic_arr) ? '' : $clinic_arr[0]['title'];
			$this->data['body']['clinic'] = $clinic; 

			$year = ($data['experience_cr'] > 4) 
				        ? $data['experience_cr']." ".TRANSLATE['YEAR_PLURAL'][LANG] 
						: $data['experience_cr']." ".TRANSLATE['YEAR'][LANG];
			$this->data['body']['experience_cr'] = $year;

			$year = ($data['experience'] > 4) 
				        ? $data['experience']." ".TRANSLATE['YEAR_PLURAL'][LANG] 
						: $data['experience']." ".TRANSLATE['YEAR'][LANG];
			$this->data['body']['experience'] = $year;


			$research_arr = $this->relative_research->getArrByKeyValue('doctor_id', $data['id']);
			$research_id = [];
			foreach($research_arr as $item) $research_id[] = $item['post_id'];
			$research = $this->research->getPostsByArrId($research_id);
			$this->data['body']['research_completed'] = [];
			$this->data['body']['research_active'] = [];
			if(!empty($research)) {
				foreach($research as $item) {
					if(empty($item['active'])) {
						$this->data['body']['research_completed'][] = $item;
					} 
					else {
						$this->data['body']['research_active'][] = $item;
					}
				 
				}
				$this->data['body']['research_completed'] = CardBuilder::researchCard($this->data['body']['research_completed'], LANG_PREFIX_LINK);
				$this->data['body']['research'] = CardBuilder::researchCard($this->data['body']['research_active'], LANG_PREFIX_LINK);
			}
			
			$translate_id = $this->relative_doctors->getDataByKey($data['id'], 'translate');
			if(!empty($translate_id)) {
				$translate = $this->doctors->getPublicDataById($translate_id);
				if(!empty($translate)) {
					$this->data['body']['permalink'] = LANG_PREFIX_LINK.'/'.$this->data['body']['slug'].'/'.$this->data['body']['permalink'];
					LANG === 'ru' ? $PREFIX_TRANSLATE = '' : $PREFIX_TRANSLATE = '/ru';
					$this->data['body']['translate'] = $PREFIX_TRANSLATE.'/'.$translate[0]['slug'].'/'.$translate[0]['permalink'];
				}
			}

			$this->load->view('doctors/single', $this->data);
		}
		else {
			$this->show_404();
		}
	}
}