<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pendaftaran extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	function cek_pendaftaranStatus(){
		$query 	= $this->db->get_where("TB_PENGATURAN", array('KEY' => 'STATUS_PENDAFTARAN'));
		if ($query->row()->VALUE == 1) {
			return true;
		}else{
			return false;
		}
	}

	function get_kegiatan($kode){
		$kode 	= $this->db->escape($kode);
		$query 	= $this->db->query("SELECT JUDUL, TANGGAL FROM TB_KEGIATAN a WHERE KODE_KEGIATAN = $kode ");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	function cek_dataPeserta($id, $kode){
		$kode 	= $this->db->escape($kode);
		$id 	= $this->db->escape($id);
		$query 	= $this->db->query("SELECT KODE_PENDAFTARAN, KODE_KEGIATAN as KODE, STATUS FROM PENDAFTARAN_KEGIATAN WHERE KODE_USER = $kode AND KODE_KEGIATAN = $id ");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}
	
	function get_formMeta($kode){
		$this->db->where('KODE', $kode);
		$query = $this->db->get("FORM_META");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	function get_formItem($kode){
		$query = $this->db->get_where("FORM_ITEM", array('ID_FORM' => $kode));
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	function cek_kodeDaftar($kode){
		$query = $this->db->query("SELECT * FROM (SELECT KODE_PENDAFTARAN FROM PENDAFTARAN_KEGIATAN UNION SELECT KODE_PENDAFTARAN FROM PENDAFTARAN_KOMPETISI) U WHERE U.KODE_PENDAFTARAN = '$kode'");

		return $query->num_rows();
	}

	function insert_pendaftaran($data, $tabel){
		$this->db->insert($tabel, $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function insert_jawaban($data){
		$this->db->insert('PENDAFTARAN_DATA', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function delete_pendaftaran($kode, $tabel){
		$this->db->where('KODE_PENDAFTARAN', $kode);
		$this->db->delete($tabel);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
}
