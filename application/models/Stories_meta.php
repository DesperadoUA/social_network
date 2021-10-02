<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stories_Meta extends CI_Model
{
	const NAME_DB = 'stories_meta';
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
	public function _getDataById($id) {
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'post_id' => $id,
			)
		);
		return $query->result_array();
	}
	public function _getDataByKey($id, $key) {
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
	public function _getArrByKey($id, $key) {
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'post_id' => $id,
				'key_meta' => $key
			)
		);
		if(empty($query->result_array())) return [];
		$data = [];
		foreach ($query->result_array() as $item) $data[] = $item['value'];
		return $data;
	}
	public function _getArrByKeyValue($key, $value) {
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'value' => $value,
				'key_meta' => $key
			)
		);
		if(empty($query->result_array())) return [];
		return $query->result_array();
	}
	public function _addDataByKey($post_id, $key, $data) {
		$candidate = $this->getDataByKey($post_id, $key);
		if(empty($candidate)) {
			$obj_data = [
				'post_id' => $post_id,
				'key_meta' => $key,
				'value' => $data
			];
			$this->db->insert(self::NAME_DB, $obj_data);
		}
		else {
			$this->db->set('value', $data);
			$this->db->where('post_id', $post_id);
			$this->db->where('key_meta', $key);
			$this->db->update(self::NAME_DB);
		}
	}
	public function _addArrByKey($post_id, $key, $data) {
		$this->db->where('post_id', $post_id);
		$this->db->where('key_meta', $key);
		$this->db->delete(self::NAME_DB);

		foreach ($data as $item){
			$obj_data = [
				'post_id' => $post_id,
				'key_meta' => $key,
				'value' => $item
			];
			$this->db->insert(self::NAME_DB, $obj_data);
		}
	}
	public function _delete($post_id) {
		$this->db->where('post_id', $post_id);
		$this->db->delete(self::NAME_DB);
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