<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Relative_Static_Page extends CI_Model
{
	const NAME_DB = 'relative_static_page';
	public function __construct() {
		$this->load->database();
	}
	public function getDataByKey($id, $key) {
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'post_id' => $id,
				'key_meta' => $key
			)
		);
		if(empty($query->result_array())) return '';
		return $query->result_array()[0]['value'];
	}
}