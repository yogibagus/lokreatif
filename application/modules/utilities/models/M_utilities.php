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
	function get_countMhs(){
		return $this->db->query("
			SELECT COUNT(ta.ID_ANGGOTA) AS JML_MHS
			FROM pendaftaran_kompetisi pk , tb_anggota ta 
			WHERE pk.KODE_PENDAFTARAN = ta.KODE_PENDAFTARAN AND ta.PERAN IN('1','3')
		")->row();
	}
	function get_countTim(){
		return $this->db->query("
			SELECT COUNT(pk.KODE_PENDAFTARAN) AS JML_TIM
			FROM pendaftaran_kompetisi pk
		")->row();
	}
	function get_countPTS(){
		return $this->db->query("
			SELECT COUNT(pk.ASAL_PTS) AS JML_PTS
			FROM pendaftaran_kompetisi pk
			GROUP BY pk.ASAL_PTS 
		")->result();
	}
	function get_timKategori(){
		return $this->db->query("
			SELECT
				bl.BIDANG_LOMBA,
				COUNT(pk.KODE_PENDAFTARAN) AS JML_TIM
			FROM bidang_lomba bl
			LEFT JOIN pendaftaran_kompetisi pk ON pk.BIDANG_LOMBA = bl.ID_BIDANG 
			GROUP BY bl.ID_BIDANG 
		")->result();
	}
	function get_timLLDIKTI(){
		return $this->db->query("
			SELECT
				p.kopertis ,
				COUNT(p.kopertis) AS JML_TIM
			FROM pendaftaran_kompetisi pk , pt p 
			WHERE pk.ASAL_PTS = p.kodept 
			GROUP BY p.kopertis  
			ORDER BY p.kopertis ASC
		")->result();
	}
}
