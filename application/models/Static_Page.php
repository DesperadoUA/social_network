<?php
class Static_Page extends CI_Model
{
	const NAME_DB = 'static_page';
	public function __construct() {
		$this->load->database();
	}

	public function getAllPage() {
		$query = $this->db->get('static_page');
		return $query->result_array();
	}

	public function getDataById($id){
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'id' => $id,
			)
		);
		return $query->result_array();
	}
}