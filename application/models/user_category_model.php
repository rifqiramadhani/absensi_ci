<?php

class User_category_model extends CI_Model{
	private $table_name = 't_user_type';
	private $table_pk = 'id_user_type';
	private $table_status = 'active';

	public function __construct(){
		parent::__construct();
	}

	public function get_all($paging=true,$start=0,$limit=10){
		$this->db->select('id_user_type,id_jabatan,nama_user_type,t_user_type.active');
		$this->db->from($this->table_name);
		$this->db->where($this->table_status,'1');
		if($paging==true){
			$this->db->limit($limit,$start);
		}
		return $this->db->get();
	}

	public function get_by_id($user_category_id){
		$this->db->select('id_user_type,id_jabatan,nama_user_type,t_user_type.active');
		$this->db->from($this->table_name);
		$this->db->where($this->table_pk,$user_category_id);
		$this->db->where($this->table_status,'1');
		return $this->db->get();
	}

	public function save($data_user_category){
		$this->db->insert($this->table_name,$data_user_category);
	}

	public function update($user_category_id,$data_user_category){
		$this->db->where($this->table_pk,$user_category_id);
		$this->db->update($this->table_name,$data_user_category);
	}

	public function delete($user_category_id){
		$this->db->where($this->table_pk,$user_category_id);
		$this->db->delete($this->table_name);
	}
}