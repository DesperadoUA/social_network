<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Front_Controller.php';
include ROOT.'/application/helpers/CardBuilder.php';

class Healing_Controller extends Front_Controller
{
	const LIMIT_POSTS = 9;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('disease');
		$this->load->model('healing');
		$this->load->model('relative_healing');
		$this->load->model('doctors');
		$this->load->model('relative_doctors');
		$this->load->model('post');
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

		$config['base_url'] = LANG_PREFIX_LINK.$page_url."/page";
		$config['total_rows'] = $this->disease->getTotalPublicPostsByLang(LANG);
		$config['per_page'] = self::LIMIT_POSTS;
		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['last_link'] = false;
		$config['first_link'] = false;
		$this->pagination->initialize($config);

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
			$this->data['posts'] = $this->disease->getPublicPosts($offset, self::LIMIT_POSTS, LANG);
			$this->data['total_posts'] = $this->disease->getTotalPublicPostsByLang(LANG);

			for($i = 0; $i<count($this->data['posts']); $i++) {
				$this->data['posts'][$i]['title'] = $this->data['posts'][$i]['title'];
				$this->data['posts'][$i]['permalink'] = LANG_PREFIX_LINK.'/'.$this->data['posts'][$i]['slug'].'/'.$this->data['posts'][$i]['permalink'];
				$this->data['posts'][$i]['child'] = [];
				$child = $this->relative_healing->getArrByKeyValue('disease', $this->data['posts'][$i]['id']);

				if(!empty($child)) {
					$arr_id = [];
					foreach($child as $item) $arr_id[] = $item['post_id'];
					$posts = $this->healing->getPublicPostsByArrId($arr_id);
					if(!empty($posts)) {
						foreach($posts as $item) {
							$this->data['posts'][$i]['child'][] = [
								'title' => $item['title'],
								'permalink' => LANG_PREFIX_LINK.'/'.$item['slug'].'/'.$item['permalink']
							];
						}
					}
				}
			}
			
			$translate_id = $this->relative_static_page->getDataByKey($data['id'], 'translate');
			if(!empty($translate_id)) {
				$url = $this->static_page->getDataById($translate_id)[0]['permalink'];
				$this->data['body']['permalink'] = LANG_PREFIX_LINK.$this->data['body']['permalink'];
				LANG === 'ru' ? $PREFIX_TRANSLATE = '' : $PREFIX_TRANSLATE = '/ru';
				$this->data['body']['translate'] = $PREFIX_TRANSLATE.$url;
			}
			
			$this->load->view('healing/index', $this->data);
			
		}
		else {
			$this->output->set_status_header('404');
			$this->load->view('404');
		}
	}

	public function single($id) {
		$data = $this->healing->getDataByPermalink($id, LANG);
		if(!empty($data)){
			$data = $data[0];
			$this->data['body'] = $data;
			$this->data['body']['content'] = $data['content'];
			$this->data['body']['thumbnail'] = json_decode($data['thumbnail'], true);

			$translate_id = $this->relative_healing->getDataByKey($data['id'], 'translate');
			if(!empty($translate_id)) {
				$translate = $this->healing->getPublicDataById($translate_id);
				$doctor_id = $this->relative_healing->getDataByKey($data['id'], 'doctor_id');
				$doctor = $this->doctors->getPublicDataById($doctor_id);
				$this->data['body']['autor'] = [];
				if(!empty($doctor)) {
					$clinic_id = $this->relative_doctors->getDataByKey($doctor_id, 'clinic_id');
			        $clinic_arr = $this->post->getPublicPostsByArrId($clinic_id);
			        $clinic = empty($clinic_arr) ? '' : $clinic_arr[0]['title'];
					$doctor[0]['clinic'] = $clinic;
					$this->data['body']['autor'] = CardBuilder::articleDoctorCard($doctor);
				} else {
					$year = ($data['autor_experience'] > 4) 
				        ? $data['autor_experience']." ".TRANSLATE['YEAR_PLURAL'][LANG] 
						: $data['autor_experience']." ".TRANSLATE['YEAR'][LANG];
					if(!empty($data['autor_name'])) {
						$this->data['body']['autor'][] = [
							'permalink' => '',
							'title' => $data['autor_name'],
							'experience' => $year,
							'clinic' => $data['autor_clinic'],
							'specialization' => $data['autor_specialization'],
							'thumbnail' => json_decode($data['autor_thumbnail'], true)
						];
					}
				}
				if(!empty($translate)) {
					$this->data['body']['permalink'] = LANG_PREFIX_LINK.'/'.$this->data['body']['slug'].'/'.$this->data['body']['permalink'];
					LANG === 'ru' ? $PREFIX_TRANSLATE = '' : $PREFIX_TRANSLATE = '/ru';
					$this->data['body']['translate'] = $PREFIX_TRANSLATE.'/'.$translate[0]['slug'].'/'.$translate[0]['permalink'];
				}
			}

			$this->load->view('healing/single', $this->data);
		}
		else {
			$this->show_404();
		}
	}
}