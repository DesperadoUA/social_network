<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Post_Meta extends CI_Model
{
	const NAME_DB = 'post_meta';
	public function __construct() {
		$this->load->database();
	}
	public function getDataById($id) {
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'post_id' => $id,
			)
		);
		return $query->result_array();
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
		if($candidate === NULL){
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
	public function delete($post_id) {
		$this->db->where('post_id', $post_id);
		$this->db->delete(self::NAME_DB);
	}
	public function getDistinctValueForPublicPosts($post_type, $lang, $key) {
		$this->db->distinct();
		$this->db->select('value')
			->from('posts as t1')
			->where('t1.post_type', $post_type)
			->where('t1.lang', $lang)
			->where('t1.status', '1')
			->join("post_meta as t2", "t1.id = t2.post_id AND t2.key_meta = '{$key}'");

		$query = $this->db->get();
		return $query->result_array();
	}
}