<?php
class Admin_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		session_start();
		if(!isset($_SESSION['admin'])) redirect('/login', 'location', 301);
		$this->load->model('static_page');
		$this->load->model('settings');
		$this->load->model('options');
		$this->load->model('research');
		$this->load->model('relative_post');
	}
	public function permalinkExist($name_db, $permalink){
		$query = $this->db->get_where(
			$name_db,
			array(
				'permalink' => $permalink,
			)
		);
		return $query->result_array();
	}
	public function permalinkUpdate($name_db, $permalink, $id){
		$query = $this->db->get_where(
			$name_db,
			array(
				'permalink' => $permalink,
			)
		);
		$result = $query->result_array();
		
		if(count($result) === 0) {
			return $permalink;
		}
		else {
			if($result[0]['id'] == $id) {
			  	return $permalink;
			}
			else {
				$counter = 0;
				$candidate = [];
				$new_permalink = '';
				do {
					$counter++;
					$new_permalink = $permalink.'-'.$counter;
					$query = $this->db->get_where(
						$name_db,
						array(
							'permalink' => $new_permalink,
						)
					);
					$candidate = $query->result_array();
					if(count($candidate) === 0) break;
				} while (true);
				return $new_permalink;
			}
		}
	}
	public function newPermalink($name_db, $permalink){
		$query = $this->db->get_where(
			$name_db,
			array(
				'permalink' => $permalink,
			)
		);
		$result = $query->result_array();

		if(count($result) === 0) {
			return $permalink;
		}
		else {

				$counter = 0;
				$candidate = [];
				$new_permalink = '';
				do {
					$counter++;
					$new_permalink = $permalink.'-'.$counter;
					$query = $this->db->get_where(
						$name_db,
						array(
							'permalink' => $new_permalink,
						)
					);
					$candidate = $query->result_array();
					if(count($candidate) === 0) break;
				} while (true);
				return $new_permalink;
		}
	}

}