<?php

class Workday_plan_model extends CI_Model{
	private $table_name = 't_perencanaan_harikerja';
	private $table_pk = 'id_perencanaan';
	private $table_status = 'active';

	public function __construct(){
		parent::__construct();
	}

	public function get_all_per_month($start=0,$limit=10){
		$this->db->select('COUNT(tanggal) AS hari,bulan,tahun');
		$this->db->from($this->table_name);
		$this->db->where($this->table_status,'1');
		$this->db->group_by(array('bulan','tahun'));
		$this->db->limit($limit,$start);
		return $this->db->get();
	}

	public function get_by_month($month,$year){
		$this->db->select('id_perencanaan,tanggal,bulan,tahun,status,keterangan');
		$this->db->from($this->table_name);
		$this->db->where('bulan',$month);
		$this->db->where('tahun',$year);
		$this->db->where($this->table_status,'1');
		return $this->db->get();
	}

	public function get_by_date($date,$month,$year){
		$this->db->select('id_perencanaan,tanggal,bulan,tahun,status,keterangan');
		$this->db->from($this->table_name);
		$this->db->where('tanggal',$date);
		$this->db->where('bulan',$month);
		$this->db->where('tahun',$year);
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