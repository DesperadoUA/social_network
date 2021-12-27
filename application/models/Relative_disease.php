<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Relative_Disease extends CI_Model
{
	const NAME_DB = 'relative_disease';
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
		if(empty($query->result_array())) return NULL;
		return $query->result_array()[0]['value'];
	}
	public function addDataByKey($post_id, $key, $data) {
		$candidate = $this->getDataByKey($post_id, $key);
		if($candidate === NULL) {
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
}