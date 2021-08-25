<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pendaftaran extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	// PENDAFTARAN KOMPETISI
	function get_bidangLomba(){
		$query = $this->db->get('bidang_lomba');
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	function get_pts(){
		$this->db->select('kodept,namapt');
		$query  = $this->db->get('pt');
		$result = $query->result();

		foreach ($result as $row){
			$pt[$row->kodept] = $row->kodept . '-'. $row->namapt;
		}
		return $pt;
	}

	// PENDAFTARAN KOMPETISI - get biaya daftar


	// PENDAFTARAN ALL
	function cek_pendaftaranStatus(){
		$query 	= $this->db->get_where("tb_pengaturan", array('KEY' => 'STATUS_PENDAFTARAN'));
		if ($query->row()->VALUE == 1) {
			return true;
		}else{
			return false;
		}
	}

	function get_kegiatan($kode){
		$kode 	= $this->db->escape($kode);
		$query 	= $this->db->query("SELECT JUDUL, TANGGAL FROM tb_kegiatan a WHERE KODE_KEGIATAN = $kode ");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	function cek_dataPeserta($id, $kode, $tabel){
		$kode 	= $this->db->escape($kode);
		$id 	= $this->db->escape($id);
		$query 	= $this->db->query("SELECT KODE_PENDAFTARAN, KODE_KEGIATAN as KODE, STATUS FROM {$tabel} WHERE KODE_USER = $kode AND KODE_KEGIATAN = $id");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	function cek_dataPesertaKompetisi($kode, $tabel){
		$kode 	= $this->db->escape($kode);
		// $id 	= $this->db->escape($id);
		$query 	= $this->db->query("SELECT KODE_PENDAFTARAN as KODE, STATUS FROM {$tabel} WHERE KODE_USER = $kode");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}
	
	function get_formMeta($kode){
		$this->db->where('KODE', $kode);
		$query = $this->db->get("form_meta");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	function get_formItem($kode){
		$query = $this->db->get_where("form_item", array('ID_FORM' => $kode));
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	function cek_kodeDaftar($kode){
		$query = $this->db->query("SELECT * FROM (SELECT KODE_PENDAFTARAN FROM pendaftaran_kegiatan UNION SELECT KODE_PENDAFTARAN FROM pendaftaran_kompetisi) U WHERE U.KODE_PENDAFTARAN = '$kode'");

		return $query->num_rows();
	}

	function insert_pendaftaran($data, $tabel){
		$this->db->insert($tabel, $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function insert_jawaban($data){
		$this->db->insert('pendaftaran_data', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function delete_pendaftaran($kode, $tabel){
		$this->db->where('KODE_PENDAFTARAN', $kode);
		$this->db->delete($tabel);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
}
