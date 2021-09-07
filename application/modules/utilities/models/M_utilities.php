<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_utilities extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	function c_penyelenggara(){
		return $this->db->get("bidang_lomba")->num_rows();
	}

	function c_peserta(){
		return $this->db->get_where("tb_auth", array('ROLE' => 1))->num_rows();
	}

	function c_kegiatan(){
		return $this->db->query("SELECT KODE_KEGIATAN FROM tb_kegiatan")->num_rows();
	}

	function get_unduhanList(){
		$query = $this->db->get('berkas_kebutuhan');
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

}
