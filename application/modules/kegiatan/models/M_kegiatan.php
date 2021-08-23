<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kegiatan extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function count_kegiatan(){
		$query = $this->db->get('TB_KEGIATAN');
		return $query->num_rows();

	}

	function cek_dataPeserta($kode, $id){
		$kode 	= $this->db->escape($kode);
		$id 	= $this->db->escape($id);
		$query 	= $this->db->query("SELECT KODE_PENDAFTARAN, KODE_KEGIATAN as KODE, STATUS FROM PENDAFTARAN_KEGIATAN WHERE KODE_USER = $kode AND KODE_KEGIATAN = $id");
		if ($query->num_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function get_kegiatanAll(){
		$this->db->select('*');
		$this->db->from('TB_KEGIATAN');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_kegiatanDetail($KODE_KEGIATAN){
		$this->db->select('*');
		$this->db->from('TB_KEGIATAN');
		$this->db->where('KODE_KEGIATAN', $KODE_KEGIATAN);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}

	}

	public function get_tiketKegiatan($KODE_KEGIATAN){
		$this->db->select('*');
		$this->db->from('TB_TIKET');
		$this->db->where(array('TYPE' => 1, 'KODE' => $KODE_KEGIATAN));
		$this->db->order_by('HARGA_TIKET', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_tiketRange($KODE_KEGIATAN){
		$this->db->select('min(HARGA_TIKET) as low, max(HARGA_TIKET) as high');
		$this->db->from('TB_TIKET');
		$this->db->where(array('TYPE' => 1, 'KODE' => $KODE_KEGIATAN));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}

	}

	public function get_sosmedKegiatan($KODE_KEGIATAN){
		$this->db->select('*');
		$this->db->from('TB_SOSMED');
		$this->db->where(array('TYPE' => 1, 'KODE' => $KODE_KEGIATAN));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_contactKegiatan($KODE_KEGIATAN){
		$this->db->select('*');
		$this->db->from('TB_CONTACT_PERSON');
		$this->db->where(array('TYPE' => 1, 'KODE' => $KODE_KEGIATAN));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}
}
