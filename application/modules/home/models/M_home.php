<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function get_kegiatanAll(){
		$query = $this->db->query("SELECT KODE_KEGIATAN as KODE, JUDUL, BAYAR, TANGGAL FROM tb_kegiatan ORDER BY TANGGAL DESC LIMIT 6");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_juriLomba($id){
		$query = $this->db->query("SELECT * FROM tb_peserta a LEFT JOIN bidang_juri b ON a.KODE_USER = b.KODE_USER WHERE b.ID_BIDANG = '$id'");

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_bidangLombaAll(){
		$query = $this->db->query("SELECT * FROM bidang_lomba");

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_bidangLomba(){
		$query = $this->db->query("SELECT * FROM bidang_lomba WHERE ID_BIDANG != 13");

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_detailLomba($id){
		$this->db->select('*');
		$query = $this->db->get_where('bidang_lomba', array('ID_BIDANG' => $id));

		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}

	}

	public function get_tahapPenilaian(){
		$this->db->select('*');
		$query = $this->db->get('tahap_penilaian');

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_kriteriaPenilaian($id_tahap, $id_bidang){
		$this->db->select('*');
		$this->db->where(array('ID_TAHAP' => $id_tahap, 'ID_BIDANG' => $id_bidang));
		$query = $this->db->get('kriteria_penilaian');

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}
}
