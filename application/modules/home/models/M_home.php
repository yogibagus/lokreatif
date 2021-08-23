<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function get_kegiatanAll(){
		$query = $this->db->query("SELECT KODE_KEGIATAN as KODE, JUDUL, BAYAR, TANGGAL FROM TB_KEGIATAN ORDER BY TANGGAL DESC LIMIT 6");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_bidangLomba(){
		$this->db->select('*');
		$query = $this->db->get('BIDANG_LOMBA');

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_tahapPenilaian(){
		$this->db->select('*');
		$query = $this->db->get('TAHAP_PENILAIAN');

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_kriteriaPenilaian($id_tahap, $id_bidang){
		$this->db->select('*');
		$this->db->where(array('ID_TAHAP' => $id_tahap, 'ID_BIDANG' => $id_bidang));
		$query = $this->db->get('KRITERIA_PENILAIAN');

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}
}
