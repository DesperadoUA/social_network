<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Research extends CI_Model
{
	const NAME_DB = 'research';
	public function __construct() {
		$this->load->database();
	}
	public function getAllPages() {
		$query = $this->db->get(self::NAME_DB);
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
	public function insert($data){
	  $this->db->insert(self::NAME_DB, $data);
	  $result = $this->db->insert_id();
	  return $result;
	}
	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete(self::NAME_DB);
	}
	public function getPublicPosts($offset, $limit, $lang){
		$this->db->order_by('data_publick', 'DESC');
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'lang' => $lang,
				'status' => 1
			),
			$limit,
			$offset
		);
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
		$this->db->where_in('id', $arr);
		$this->db->where(
			array(
				'status' => 1,
				'active' => 1
			)
		);
		$query = $this->db->get(self::NAME_DB);
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
	public function getDataPublicActivePostsByArrId($arr){
		if(empty($arr)) return [];
		$this->db->order_by('data_publick', 'DESC');
		$this->db->where_in('id', $arr);
		$this->db->where(
			array(
				'status' => 1,
				'active' => 1
			)
		);
		$query = $this->db->get(self::NAME_DB);
		return $query->result_array();
	}
    public function getDistinctValueForPublicPosts($lang, $key){
		$this->db->distinct();
		$this->db->select($key);
		$query = $this->db->get_where(
			self::NAME_DB,
			array(
				'lang' => $lang,
				'status' => 1
			)
		);
		return $query->result_array();
	}
	public function getDistinctClinics($lang){
		$this->db->distinct();
		$this->db->select('value')
			->from('research as t1')
			->where('t1.lang', $lang)
			->where('t1.status', '1')
			->join("research_meta as t2", "t1.id = t2.post_id AND t2.key_meta = 'clinic_id'");

		$query = $this->db->get();
		return $query->result_array();

	}
	public function getSearchPublicPosts($arr){
		$this->db->order_by('data_publick', 'DESC');
		$query = $this->db->get_where(
			self::NAME_DB,
			$arr
		);
		return $query->result_array();
	}
	public function getPostsByArrId($arr) {
		if(!empty($arr)) {
			$this->db->where_in('id', $arr);
			$this->db->where(
				['status' => 1]
			);
			$query = $this->db->get(self::NAME_DB);
			return $query->result_array();
		}
		else {
			return [];
		}
	}
}