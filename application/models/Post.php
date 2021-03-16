<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Post extends CI_Model
{
	const NAME_DB = 'posts';
	public function __construct() {
		$this->load->database();
	}
	public function getAllPages($post_type) {
		$query = $this->db->get_where(
			self::NAME_DB,
			[
				'post_type' => $post_type
			]
			);
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
	public function updateDateById($id, $data) {
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update(self::NAME_DB);
	}
	public function getPostTypeById($id) {
		$query = $this->db->select('post_type')->get_where(
			self::NAME_DB,
			array(
				'id' => $id,
			)
		);
		if(!empty($query->result_array())) return $query->result_array()[0]['post_type'];
		else return '';
	}
	public function insert($data){
	  $this->db->insert(self::NAME_DB, $data);
	  $result = $this->db->insert_id();
	  return $result;
	}
	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete(self::NAME_DB);
	}
	public function getPublicPosts($post_type, $offset, $limit, $lang){
		$this->db->order_by('data_publick', 'DESC');
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'lang' => $lang,
				'status' => 1,
				'post_type' => $post_type
			),
			$limit,
			$offset
		);
		return $query->result_array();
	}
	public function getTotalPublicPostsByLang($post_type, $lang) {
		$this->db->where(
			[
				'lang' => $lang,
				'status' => 1,
				'post_type' => $post_type
			]
		);
		$query = $this->db->get(self::NAME_DB);
		return $query->num_rows();
	}
	public function getPostsByLang($post_type, $lang) {
		$this->db->where(
			[
				'lang' => $lang,
				'post_type' => $post_type
			]
		);
		$query = $this->db->get(self::NAME_DB);
		return $query->result_array();
	}
	public function getDataByPermalink($permalink) {
		$this->db->where(
			[
				'status' => 1,
				'permalink' => $permalink
			]
		);
		$query = $this->db->get(self::NAME_DB);
		return $query->result_array();
	}
	public function getPublicPostsByArrId($arr_id){
		$this->db->where_in('id', $arr_id);
		$this->db->where(['status' => 1]);
		$query = $this->db->get(self::NAME_DB);
		return $query->result_array();
	}
}