<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include ROOT.'/application/core/Front_Controller.php';

class City_Controller extends Front_Controller
{
	const LIMIT_POSTS = 8;
	public function __construct() {
		parent::__construct();
		$this->load->model('relative_research');
	}
	public function single($id) {
		$data = $this->post->getDataByPermalink($id, LANG);
		if(!empty($data)){
			$data = $data[0];
			$arr_research = $this->relative_research->getArrByKeyValue('city_id', $data['id']);
			$arr_research_id = [];
			foreach($arr_research as $item) $arr_research_id[] = $item['post_id'];


			$this->data['research'] = $this->research->getPostsByArrId($arr_research_id);

			for($i = 0; $i<count($this->data['research']); $i++) {
				$this->data['research'][$i]['thumbnail'] = json_decode($this->data['research'][$i]['thumbnail'], true);
				$this->data['research'][$i]['permalink'] = LANG_PREFIX_LINK.'/'.$this->data['research'][$i]['slug'].'/'.$this->data['research'][$i]['permalink'];
				$this->data['research'][$i]['data_start'] = mb_substr($this->data['research'][$i]['data_start'], 0, 10);
				$this->data['research'][$i]['data_finish'] = mb_substr($this->data['research'][$i]['data_finish'], 0, 10);
			}
		
			$this->data['body'] = $data;
			$this->data['body']['total_posts'] = count($this->data['research']);
		    $this->data['filter']['city'] = $this->research->getDistinctValueForPublicPosts(LANG, 'city');
		    $this->data['filter']['region'] = $this->research->getDistinctValueForPublicPosts(LANG, 'region');
		    $this->data['filter']['disease'] = $this->research->getDistinctValueForPublicPosts(LANG, 'disease');
		    $this->data['filter']['clinics'] = [];
		    $arr_clinic_id = $this->research->getDistinctClinics(LANG);
			$clinics_id = [];
		    foreach ($arr_clinic_id as $item) $clinics_id[] = $item['value'];
		    $clinics = $this->post->getPublicPostsByArrId($clinics_id);
		    foreach ($clinics as $item) {
			   	$this->data['filter']['clinics'][] = [
				  'title' => $item['title'],
				  'id' => $item['id']
				];
			}

			$translate_id = $this->relative_post->getDataByKey($data['id'], 'translate');
			if(!empty($translate_id)) {
				$translate = $this->post->getPublicDataById($translate_id);
				if(!empty($translate)) {
					$this->data['body']['permalink'] = LANG_PREFIX_LINK.'/'.$this->data['body']['slug'].'/'.$this->data['body']['permalink'];
					LANG === 'ru' ? $PREFIX_TRANSLATE = '/ua' : $PREFIX_TRANSLATE = '';
					$this->data['body']['translate'] = $PREFIX_TRANSLATE.'/'.$translate[0]['slug'].'/'.$translate[0]['permalink'];
				}
			}

			$this->load->view('city/single', $this->data);
		}
		else {
			$this->show_404();
		}
	
	}
}
