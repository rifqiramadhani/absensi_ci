<?php

class Alasan_m extends CI_Model{
	private $table_name = 't_alasan';
	private $table_pk = 'id_alasan';
	private $table_status = 't_alasan.active';

	public function __construct(){
		parent::__construct();
	}

	public function get_all($paging=true,$start=0,$limit=10){
		$this->db->select('id_alasan,nama_alasan,created_date,created_user,active');
		$this->db->from($this->table_name);
		$this->db->where($this->table_status,'1');
		if($paging==true){
			$this->db->limit($limit,$start);
		}
		return $this->db->get();
	}

	public function get_by_id($id_alasan){
		$this->db->select('id_alasan,nama_alasan,created_date,created_user,active');
		$this->db->from($this->table_name);
		$this->db->where($this->table_pk,$id_alasan);
		$this->db->where($this->table_status,'1');
		return $this->db->get();
	}

	public function save($data_alasan){
		$this->db->insert($this->table_name,$data_alasan);
	}

	public function update($id_alasan,$data_alasan){
		$this->db->where($this->table_pk,$id_alasan);
		$this->db->update($this->table_name,$data_alasan);
	}

	public function delete($id_alasan){
		$this->db->where($this->table_pk,$id_alasan);
		$this->db->delete($this->table_name);
	}
}