<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Relative_Doctors extends CI_Model
{
	const NAME_DB = 'relative_doctors';
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
		if(empty($query->result_array())) return [];
		return $query->result_array()[0]['value'];
	}
	public function getArrByKeyValue($key, $value) {
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
	public function addDataByKey($post_id, $key, $data) {
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
	public function updateTranslateById($post_id, $relative_id) {
		$old_relative_id = $this->getDataByKey($post_id, 'translate');
		if($old_relative_id === NULL) {
			/* При первом добавлении поста */
			$obj_data = [
				'post_id' => $post_id,
				'key_meta' => 'translate',
				'value' => $relative_id
			];
			$this->db->insert(self::NAME_DB, $obj_data);
		}
		else {
			/* При обновлении связей */
			if($old_relative_id !== $relative_id) {
				$this->db->set('value', $relative_id);
				$this->db->where('post_id', $post_id);
				$this->db->where('key_meta', 'translate');
				$this->db->update(self::NAME_DB);

				$this->db->set('value', 0);
				$this->db->where('post_id', $old_relative_id);
				$this->db->where('key_meta', 'translate');
				$this->db->update(self::NAME_DB);

				$this->db->set('value', $post_id);
				$this->db->where('post_id', $relative_id);
				$this->db->where('key_meta', 'translate');
				$this->db->update(self::NAME_DB);
			}
		}
	}
	public function deleteTranslateById($post_id) {
		$old_relative_id = $this->getDataByKey($post_id, 'translate');
		if(!empty($old_relative_id)) {
			$this->db->set('value', 0);
			$this->db->where('post_id', $old_relative_id);
			$this->db->where('key_meta', 'translate');
			$this->db->update(self::NAME_DB);
		}
	}
	public function getArrByKey($id, $key) {
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
	public function addArrByKey($post_id, $key, $data) {
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
	public function deleteByPostIdKey($post_id, $key) {
		$this->db->where('value', $post_id);
		$this->db->where('key_meta', $key);
		$this->db->delete(self::NAME_DB);
	}
}