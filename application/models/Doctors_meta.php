<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Doctors_Meta extends CI_Model
{
	const NAME_DB = 'doctors_meta';
	public function __construct() {
		$this->load->database();
	}
	public function updateDateByForeignId($id, $data) {
		$candidate = $this->getDataByForeignId($id);
		if(empty($candidate)) {
			$data['post_id'] = $id;
			$this->db->insert(self::NAME_DB, $data);
		}
		else {
			$this->db->set($data);
			$this->db->where('post_id', $id);
			$this->db->update(self::NAME_DB);
		}
	}
	public function getDataByForeignId($id) {
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'post_id' => $id,
			)
		);
		return $query->result_array();
	}
}