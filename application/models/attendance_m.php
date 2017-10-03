<?php

class Attendance_m extends CI_Model{
	private $table_name = 't_absen_susulan';
	private $table_pk = 'id_absen_susulan';
	private $table_status = 't_absen_susulan.active';

	public function __construct(){
		parent::__construct();
	}

	public function get_all($paging=true,$start=0,$limit=10){
		$this->db->select('id_kehadiran,nomor_induk,tanggal,jam_masuk,jam_keluar,hadir,id_alasan,keterangan');
		$this->db->from($this->table_name);
		$this->db->where($this->table_status,'1');
		if($paging==true){
			$this->db->limit($limit,$start);
		}
		return $this->db->get();
	}

	public function get_by_id($id_absen_susulan){
		$this->db->select('id_absen_susulan,nomor_induk,id_atasan,tanggal_absen,t_alasan.id_alasan,nama_alasan,keterangan,approval_atasan');
		$this->db->from($this->table_name);
		$this->db->join('t_alasan','t_alasan.id_alasan = '.$this->table_name.'.id_alasan');
		$this->db->where($this->table_status,'1');
		$this->db->where($this->table_pk,$id_absen_susulan);
		return $this->db->get();
	}

	public function get_by_date($tanggal,$nomor_induk){
		$this->db->select('id_kehadiran,t_kehadiran.nomor_induk,nama,tanggal,jam_masuk,jam_keluar,hadir,t_kehadiran.id_alasan,nama_alasan,keterangan');
		$this->db->from($this->table_name);
		$this->db->join('t_pegawai','t_pegawai.nomor_induk = '.$this->table_name.'.nomor_induk');
		$this->db->join('t_alasan','t_alasan.id_alasan = '.$this->table_name.'.id_alasan');
		$this->db->where($this->table_name.'.nomor_induk',$nomor_induk);
		$this->db->where('tanggal',$tanggal);
		$this->db->where($this->table_name.'.nomor_induk',$nomor_induk);
		$this->db->where($this->table_status,'1');
		return $this->db->get();
	}

	public function get_all_pending($nomor_induk){
		$this->db->select('id_absen_susulan,nomor_induk,id_atasan,tanggal_absen,nama_alasan,keterangan,approval_atasan');
		$this->db->from($this->table_name);
		$this->db->join('t_alasan','t_alasan.id_alasan = '.$this->table_name.'.id_alasan');
		$this->db->where('nomor_induk',$nomor_induk);
		$this->db->where($this->table_status,'1');
		$this->db->where('approval_atasan','0');
		return $this->db->get();
	}

	public function get_all_approval($id_atasan){
		$this->db->select('id_absen_susulan,nama,id_atasan,tanggal_absen,nama_alasan,keterangan,approval_atasan');
		$this->db->from($this->table_name);
		$this->db->join('t_alasan','t_alasan.id_alasan = '.$this->table_name.'.id_alasan');
		$this->db->join('t_pegawai','t_pegawai.nomor_induk = '.$this->table_name.'.nomor_induk');
		$this->db->where('id_atasan',$id_atasan);
		$this->db->where($this->table_status,'1');
		$this->db->where('approval_atasan','0');
		return $this->db->get();
	}

	public function save($data_absensi){
		$this->db->insert($this->table_name,$data_absensi);
	}

	public function update($id_kehadiran,$data_absensi){
		$this->db->where($this->table_pk,$id_kehadiran);
		$this->db->update($this->table_name,$data_absensi);
	}

	public function delete($id_kehadiran){
		$this->db->where($this->table_pk,$id_kehadiran);
		$this->db->delete($this->table_name);
	}
}