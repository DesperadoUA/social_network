<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Disease extends CI_Model
{
	const NAME_DB = 'disease';
	const NAME_META_DB = 'disease_meta';
	const NAME_RELATIVE_DB = 'relative_disease';
	const ALL_FIELDS = [
		't1.id',
		'post_type',
		'status',
		'permalink',
		'title',
		'thumbnail',
		'short_desc',
		'h1',
		'meta_title',
		'description',
		'keywords',
		'content',
		'data_publick',
		'data_change',
		'slug',
		'lang',
		'name'
	];
	public function __construct() {
		$this->load->database();
	}
	public function getAllPages() {
		$query = $this->db->get(self::NAME_DB);
		return $query->result_array();
	}
	public function getDataById($id) {
		$this->db->select(implode(',', self::ALL_FIELDS))
		->from(self::NAME_DB.' as t1')
		->where('t1.id', $id)
		->join(self::NAME_META_DB.' as t2', "t1.id = t2.post_id");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getPublicDataById($id) {
		$this->db->select(implode(',', self::ALL_FIELDS))
			->from(self::NAME_DB.' as t1')
			->where('t1.id', $id)
			->where('t1.status', '1')
			->join(self::NAME_META_DB.' as t2', "t1.id = t2.post_id");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function updateDateById($id, $data) {
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update(self::NAME_DB);
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
	public function getPublicPosts($offset, $limit, $lang) {
		$this->db->select(implode(',', self::ALL_FIELDS))
		->from(self::NAME_DB.' as t1')
		->where('t1.status', 1)
		->where('t1.lang', $lang)
		->join(self::NAME_META_DB.' as t2', "t1.id = t2.post_id")
		->order_by('data_publick', 'DESC')
		->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getTotalPublicPostsByLang($lang) {
		$this->db->where(
			array(
				'lang' => $lang,
				'status' => 1
			)
		);
		$query = $this->db->get(self::NAME_DB);
		return $query->num_rows();
	}
	public function getDataByPermalink($permalink, $lang) {
		
		$this->db->select(implode(',', self::ALL_FIELDS))
		->from(self::NAME_DB.' as t1')
		->where('t1.status', 1)
		->where('t1.permalink', $permalink)
		->where('t1.lang', $lang)
		->join(self::NAME_META_DB.' as t2', "t1.id = t2.post_id");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getPostWithOutTranslate($lang){
		$this->db->select('t1.id, t1.title')
			->from(self::NAME_DB.' as t1')
			->where(['status' => 1, 'lang' => $lang])
			->join(self::NAME_RELATIVE_DB.' as t2', "t1.id = t2.post_id AND t2.key_meta = 'translate' AND t2.value = 0");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getPostsByLang($lang) {
		$query = $this->db
		              ->select('id, title')
					  ->where(['lang' => $lang])
					  ->get(self::NAME_DB);
		return $query->result_array();
	}
	public function getSearchPublicPosts($lang, $keywords) {
		$this->db->select(implode(',', self::ALL_FIELDS))
			->from(self::NAME_DB.' as t1')
			->where('t1.lang', $lang)
			->where('t1.status', '1')
			->like('title', $keywords)
			->join(self::NAME_META_DB." as t2", "t1.id = t2.post_id")
		    ->order_by('data_publick', 'DESC');

		$query = $this->db->get();
		return $query->result_array();
	}
}