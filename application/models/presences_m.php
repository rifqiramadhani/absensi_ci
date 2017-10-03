<?php

class Presences_m extends CI_Model{
	private $table_name = 't_kehadiran';
	private $table_pk = 'id_kehadiran';
	private $table_status = 't_kehadiran.active';

	public function __construct(){
		parent::__construct();
	}

	public function get_all($paging=true,$start=0,$limit=10){
		$this->db->select('id_kehadiran,kode_mesin,tanggal,jam_masuk,jam_keluar,hadir,id_alasan,keterangan');
		$this->db->from($this->table_name);
		$this->db->where($this->table_status,'1');
		if($paging==true){
			$this->db->limit($limit,$start);
		}
		return $this->db->get();
	}

	public function get_by_id($id_kehadiran){
		$this->db->select('id_kehadiran,t_kehadiran.kode_mesin,nama,tanggal,jam_masuk,jam_keluar,hadir,t_kehadiran.id_alasan,nama_alasan,keterangan');
		$this->db->from($this->table_name);
		$this->db->join('t_pegawai','t_pegawai.kode_mesin = '.$this->table_name.'.kode_mesin');
		$this->db->join('t_alasan','t_alasan.id_alasan = '.$this->table_name.'.id_alasan');
		$this->db->where($this->table_pk,$id_kehadiran);
		$this->db->where($this->table_status,'1');
		return $this->db->get();
	}

	public function get_by_date($tanggal,$nomor_induk){
		$this->db->select('id_kehadiran,t_kehadiran.kode_mesin,nama,tanggal,jam_masuk,jam_keluar,hadir,t_kehadiran.id_alasan,nama_alasan,keterangan');
		$this->db->from($this->table_name);
		$this->db->join('t_pegawai','t_pegawai.kode_mesin = '.$this->table_name.'.kode_mesin');
		$this->db->join('t_alasan','t_alasan.id_alasan = '.$this->table_name.'.id_alasan');
		$this->db->where($this->table_name.'.kode_mesin = t_pegawai.kode_mesin');
		$this->db->where('t_pegawai.nomor_induk',$nomor_induk);
		$this->db->where('tanggal',$tanggal);
		$this->db->where($this->table_status,'1');
		return $this->db->get();
	}

	public function save($data_kehadiran){
		$this->db->insert($this->table_name,$data_kehadiran);
	}

	public function update($id_kehadiran,$data_kehadiran){
		$this->db->where($this->table_pk,$id_kehadiran);
		$this->db->update($this->table_name,$data_kehadiran);
	}

	public function delete($id_kehadiran){
		$this->db->where($this->table_pk,$id_kehadiran);
		$this->db->delete($this->table_name);
	}

	public function save_all($data){
		$this->db->insert_batch($this->table_name, $data); 
	}

	public function get_by_range($startDate, $endDate, $nomorInduk){
		$this->db->select('id_kehadiran,t_kehadiran.kode_mesin,nama,tanggal,jam_masuk,jam_keluar,hadir,t_kehadiran.id_alasan,nama_alasan,keterangan');
		$this->db->from('t_pegawai');
		$this->db->join('t_kehadiran','t_kehadiran.kode_mesin = t_pegawai.kode_mesin');
		$this->db->join('t_alasan','t_kehadiran.id_alasan = t_alasan.id_alasan');
		$this->db->where('t_pegawai.nomor_induk',$nomorInduk);
		$this->db->where('tanggal >=', $startDate);
		$this->db->where('tanggal <=', $endDate);
		$this->db->where($this->table_status,'1');
		return $this->db->get();
	}


	public function get_rekap($bulan, $tahun){
		$this->db->select('t_pegawai.nomor_induk,t_pegawai.nama,id_kehadiran,t_kehadiran.kode_mesin,nama,tanggal,jam_masuk,jam_keluar,hadir,t_kehadiran.id_alasan,nama_alasan,keterangan');
		$this->db->from('t_pegawai');
		$this->db->join('t_kehadiran','t_kehadiran.kode_mesin = t_pegawai.kode_mesin');
		$this->db->join('t_alasan','t_kehadiran.id_alasan = t_alasan.id_alasan');
		$this->db->where("DATE_FORMAT(tanggal,'%m')", $bulan);
		$this->db->where("DATE_FORMAT(tanggal,'%Y')", $tahun);
		$this->db->where($this->table_status,'1');
		return $this->db->get();
	}

	public function get_all_alasan(){
		$this->db->select('*');
		$this->db->from('t_alasan');
		return $this->db->get();
	}
}