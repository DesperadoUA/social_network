<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Research extends CI_Model
{
	const NAME_DB = 'research';
	const ALL_FIELDS_RESEARCH = [
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
		'protocol_name',
		'therapeutic_area',
		'data_start',
		'data_finish',
		'name_organization',
		'active',
		'region',
		'city',
		'disease',
		'researchers',
		'clinic_name',
		'open_set',
		'for_volunteers',
		'additional_fields'
	];
	public function __construct() {
		$this->load->database();
	}
	public function getAllPages() {
		$query = $this->db->get(self::NAME_DB);
		return $query->result_array();
	}
	public function getDataById($id) {
		$this->db->select(implode(',', self::ALL_FIELDS_RESEARCH))
		->from('research as t1')
		->where('t1.id', $id)
		->join('research_meta as t2', "t1.id = t2.post_id");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getPublicDataById($id) {
		$this->db->select(implode(',', self::ALL_FIELDS_RESEARCH))
			->from('research as t1')
			->where('t1.id', $id)
			->where('t1.status', '1')
			->join('research_meta as t2', "t1.id = t2.post_id");
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
		$this->db->select(implode(',', self::ALL_FIELDS_RESEARCH))
		->from('research as t1')
		->where('t1.status', 1)
		->where('t1.lang', $lang)
		->join('research_meta as t2', "t1.id = t2.post_id")
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
	public function getTotalPublicPostsByIdOrganization($id) {
		$this->db->where(
			array(
				'organization' => $id,
				'status' => 1
			)
		);
		$query = $this->db->get(self::NAME_DB);
		return $query->num_rows();
	}
	public function getTotalPublicActivePostsByIdOrganization($id) {
		$this->db->where(
			array(
				'organization' => $id,
				'status' => 1,
				'active' => 1
			)
		);
		$query = $this->db->get(self::NAME_DB);
		return $query->num_rows();
	}
	public function getTotalPublicActivePostsByArrId($arr) {
		if(empty($arr)) return 0;
		$this->db->select('t1.id')
		->from('research as t1')
		->where_in('t1.id', $arr)
		->where(['status' => 1])
		->join('research_meta as t2', "t1.id = t2.post_id AND t2.active = 1");
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getPublicPostsByIdOrganization($id, $offset, $limit) {
		$this->db->order_by('data_publick', 'DESC');
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'organization' => $id,
				'status' => 1
			),
			$limit,
			$offset
		);
		return $query->result_array();
	}
	public function getDataByPermalink($permalink, $lang) {
		
		$this->db->select(implode(',', self::ALL_FIELDS_RESEARCH))
		->from('research as t1')
		->where('t1.status', 1)
		->where('t1.permalink', $permalink)
			->where('t1.lang', $lang)
		->join('research_meta as t2', "t1.id = t2.post_id");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getDataPublicActivePostsByArrId($arr){

		if(empty($arr)) return [];
		$this->db->select(implode(',', self::ALL_FIELDS_RESEARCH))
		->from('research as t1')
		->where_in('t1.id', $arr)
		->where(['status' => 1])
		->join('research_meta as t2', "t1.id = t2.post_id AND t2.active = 1");
		$this->db->order_by('data_publick', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
    public function getDistinctValueForPublicPosts($lang, $key){
		$this->db->distinct();
		$this->db->select($key)
		->from('research as t1')
		->where('t1.lang', $lang)
		->where('t1.status', 1)
		->join('research_meta as t2', "t1.id = t2.post_id");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getDistinctClinics($lang){
		$this->db->distinct();
		$this->db->select('value')
			->from('research as t1')
			->where('t1.lang', $lang)
			->where('t1.status', '1')
			->join("relative_research as t2", "t1.id = t2.post_id AND t2.key_meta = 'clinic_id'");

		$query = $this->db->get();
		return $query->result_array();

	}
	public function getSearchPublicPosts($lang, $query_str){
		$this->db->select(implode(',', self::ALL_FIELDS_RESEARCH))
			->from('research as t1')
			->where('t1.lang', $lang)
			->where('t1.status', '1')
			->join("research_meta as t2", "t1.id = t2.post_id {$query_str}")
		    ->order_by('data_publick', 'DESC');

		$query = $this->db->get();
		return $query->result_array();
	}
	public function getPostsByArrId($arr) {
		if(!empty($arr)) {
			$this->db->select(implode(',', self::ALL_FIELDS_RESEARCH))
				->from('research as t1')
				->where_in('t1.id', $arr)
				->where('t1.status', 1)
				->join('research_meta as t2', "t1.id = t2.post_id");
			$query = $this->db->get();
			return $query->result_array();
		}
		else {
			return [];
		}
	}
	public function getPostsByClinicIdAndQueryParams($lang, $clinic_id, $query_str){
		$this->db->distinct('t1.id');
		$this->db->select(implode(',', self::ALL_FIELDS_RESEARCH))
			->from('research as t1')
			->where('t1.lang', $lang)
			->where('t1.status', '1')
			->join("research_meta as t2", "t1.id = t2.post_id {$query_str}")
			->join('relative_research as t3',
				    "t1.id = t3.post_id 
				     AND t3.key_meta = 'clinic_id' 
					 AND t3.value = '{$clinic_id}'
					 ");
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getPostWithOutTranslate($lang){
		$this->db->select('t1.id, t1.title')
			->from('research as t1')
			->where(['status' => 1, 'lang' => $lang])
			->join('relative_research as t2', "t1.id = t2.post_id AND t2.key_meta = 'translate' AND t2.value = 0");
		$query = $this->db->get();
		return $query->result_array();
	}
}