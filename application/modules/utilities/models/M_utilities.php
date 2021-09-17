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
	function get_timPTS(){
		return $this->db->query("
			SELECT 
				p.kodept , 
				p.namapt ,
				COUNT(pk.ASAL_PTS) AS JML_TIM
			FROM pendaftaran_kompetisi pk, pt p 
			WHERE pk.ASAL_PTS = p.kodept 
			GROUP BY pk.ASAL_PTS 
			ORDER BY COUNT(pk.ASAL_PTS) DESC, p.kodept ASC
		")->result();
	}
	function get_detStatTim(){
		return $this->db->query("
			SELECT 
				pk2.NAMA_TIM ,
				bl.BIDANG_LOMBA ,
				p.namapt AS NAMA_PTS,
				tt.STAT_BAYAR ,
				tk.ID_KARYA 
			FROM pendaftaran_kompetisi pk2 
				JOIN bidang_lomba bl ON bl.ID_BIDANG = pk2.BIDANG_LOMBA 
				JOIN pt p ON p.kodept = pk2.ASAL_PTS 
				LEFT JOIN tb_order to2 ON to2.KODE_PENDAFTARAN = pk2.KODE_PENDAFTARAN 
				LEFT JOIN tb_transaksi tt ON tt.KODE_TRANS = to2.KODE_TRANS 
				LEFT JOIN tb_karya tk ON tk.KODE_PENDAFTARAN = pk2.KODE_PENDAFTARAN 
			GROUP BY pk2.KODE_PENDAFTARAN 
			ORDER BY 
				tk.ID_KARYA IS NOT NULL DESC ,
				tt.STAT_BAYAR IS NOT NULL DESC 	
		")->result();
	}
}
