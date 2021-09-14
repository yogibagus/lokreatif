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
	function get_bidangLomba(){
		return $this->db->get('bidang_lomba')->result();
	}
	function get_jmlPesertaVerif(){
		return $this->db->query("SELECT COUNT(*) AS JML FROM pendaftaran_kompetisi WHERE STATUS = '1'")->row();
	}
	function get_jmlPesertaBelum(){
		return $this->db->query("SELECT COUNT(*) AS JML FROM pendaftaran_kompetisi WHERE STATUS = '0'")->row();
	}
	function get_jmlPeserta(){
		return $this->db->query("SELECT COUNT(*) AS JML FROM pendaftaran_kompetisi")->row();
	}
	function get_pesertaLombaDetail($idBidangLomba){
		$tot = $this->db->query("
			SELECT COUNT(*) AS JML
			FROM pendaftaran_kompetisi pk 
			WHERE pk.BIDANG_LOMBA = '$idBidangLomba'
		")->row();
		$verif = $this->db->query("
			SELECT COUNT(*) AS JML
			FROM pendaftaran_kompetisi pk 
			WHERE pk.BIDANG_LOMBA = '$idBidangLomba' AND pk.STATUS = '1'
		")->row();
		$belum = $this->db->query("
			SELECT COUNT(*) AS JML
			FROM pendaftaran_kompetisi pk 
			WHERE pk.BIDANG_LOMBA = '$idBidangLomba' AND pk.STATUS = '0'
		")->row();
		$tolak = $this->db->query("
			SELECT COUNT(*) AS JML
			FROM pendaftaran_kompetisi pk 
			WHERE pk.BIDANG_LOMBA = '$idBidangLomba' AND pk.STATUS = '2'
		")->row();

		return ['TOTAL_PESERTA' => $tot->JML, 'JML_VERIF' => $verif->JML, 'JML_BELUM' => $belum->JML, 'JML_TOLAK' => $tolak->JML];
	}
	function get_listPTDetail(){
		return $this->db->query("
			SELECT 
				p.kodept ,
				p.namapt ,
				(SELECT COUNT(*) FROM pendaftaran_kompetisi pk2 WHERE STATUS = '1') AS JML_TERVERIFIKASI,
				COUNT(pk.ASAL_PTS) AS JML_PESERTA
			FROM pendaftaran_kompetisi pk , pt p 
			WHERE pk.ASAL_PTS = p.kodept 
			GROUP BY pk.ASAL_PTS 
			ORDER BY (SELECT COUNT(*) FROM pendaftaran_kompetisi pk2 WHERE STATUS = '1') DESC
		")->result();
	}
}
