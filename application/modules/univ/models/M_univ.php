<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_univ extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function cek_aktivasi($kode_user){
		$query = $this->db->query("SELECT * FROM tb_token WHERE KODE = '$kode_user' AND TYPE = 1");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else {
			return false;
		}
	}

	public function count_pesertaKegiatan($kode_user){
		$query = $this->db->get_where("pendaftaran_kegiatan", array('KODE_USER' => $kode_user));
		return $query->num_rows();
	}

	public function cek_daftarKompetisi($kode_user){
		$query = $this->db->get_where("pendaftaran_kompetisi", array('KODE_USER' => $kode_user));
		return $query->num_rows();
	}

	// NOTIFIKASI

	public function countAllNotifikasi($kode_user){
		$query = $this->db->query("SELECT * FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE a.RECEIVER = '$kode_user' AND b.TYPE = 1");
		return $query->num_rows();
	}

	public function get_AllNotifikasi($kode_user, $limit, $start){
		$query = $this->db->query("SELECT a.*, b.* FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE a.RECEIVER = '$kode_user' AND b.TYPE = 1 ORDER BY a.CREATED_AT DESC LIMIT $start, $limit");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else {
			return false;
		}
	}

	public function get_transaksi($kodept){
		$query = $this->db->query("
		SELECT 
			pk.KODE_PENDAFTARAN ,
			pk.KODE_USER ,
			tp.NAMA ,
			pk.NAMA_TIM ,
			pt.kodept ,
			pt.namapt ,
			bl.BIDANG_LOMBA ,
			to2.KODE_TRANS ,
			to2.BIAYA_TIM ,
			tt.ORDER_ID ,
			tt.TOT_BAYAR ,
			tt.STAT_BAYAR 
		FROM pendaftaran_kompetisi pk 
			JOIN tb_peserta tp ON tp.KODE_USER = pk.KODE_USER 
			JOIN pt ON pt.kodept = pk.ASAL_PTS
			JOIN bidang_lomba bl ON bl.ID_BIDANG = pk.BIDANG_LOMBA 
			LEFT JOIN tes_order to2 ON to2.KODE_PENDAFTARAN = pk.KODE_PENDAFTARAN 
			LEFT JOIN tes_trans tt ON tt.KODE_TRANS = to2.KODE_TRANS
		WHERE pk.ASAL_PTS = $kodept
			");
		return $query->result();
	}

	// public function count_alltim

	public function get_kodept($kode_user){
		return $this->db->query("SELECT pt.kodept FROM tb_univ u, pt WHERE u.KODE_PT = pt.kodept AND u.KODE_UNIV = '$kode_user'")->row();
	}

	public function get_notifikasi($kode_user){
		$query = $this->db->query("SELECT a.*, b.* FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE a.RECEIVER = '$kode_user' AND b.TYPE = 1 ORDER BY a.CREATED_AT DESC LIMIT 5");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else {
			return false;
		}
	}

	public function get_sender($kode){

		if ($kode == "System") {
			return "System";
		}else {
			$part	= explode("_", $kode);

			$this->db->select("NAMA");
			if($part[0] == "USR"):
				$this->db->where("KODE_USER", $kode);
				$sender = $this->db->get("tb_univ")->row()->NAMA;
			elseif($part[0] == "PYL"):
				$this->db->where("KODE_PENYELENGGARA", $kode);
				$sender = $this->db->get("tb_penyelenggara")->row()->NAMA;
			elseif($part[0] == "JRI"):
				$this->db->where("KODE_USER", $kode);
				$sender = $this->db->get("tb_univ")->row()->NAMA;
			else:
				$sender = "System";
			endif;

			return $sender;
		}
	}

	public function get_detailDaftarKompetisi($id){
		$query = $this->db->get_where("pendaftaran_kompetisi", array('KODE_USER' => $id));

		if ($query->num_rows() > 0) {
			return $query->row();
		}else {
			return false;
		}
	}

	public function get_detailDaftar($id){
		$query = $this->db->get_where("pendaftaran_kegiatan", array('KODE_PENDAFTARAN' => $id));

		if ($query->num_rows() > 0) {
			return $query->row();
		}else {
			return false;
		}
	}

	//KEGIATAN DIIKUTI

	public function count_kegiatanDiikuti($kode_user){
		$query = $this->db->get_where("pendaftaran_kegiatan", array('KODE_USER' => $kode_user));
		return $query->num_rows();
	}

	public function kegiatanDiikuti($kode_user, $limit, $start){

		$this->db->select("*");
		$this->db->from("pendaftaran_kegiatan a");
		$this->db->join("tb_kegiatan b", "a.KODE_KEGIATAN = b.KODE_KEGIATAN");
		$this->db->where("a.KODE_USER", $kode_user);
		$this->db->limit($limit, $start);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}else {
			return false;
		}
	}

	// PESERTA
	public function get_userDetail($kode_user){
		$kode_user	= $this->db->escape($kode_user);

		$query			= $this->db->query("SELECT a.*, p.namapt AS NAMA, b.EMAIL, b.NONAKTIF, b.DEADLINE FROM tb_univ a LEFT JOIN tb_auth b ON a.KODE_UNIV = b.KODE_USER LEFT JOIN pt p ON a.KODE_PT = p.kodept WHERE a.KODE_UNIV = $kode_user");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else {
			return false;
		}
	}

	// KEGIATAN

	public function get_kegiatanAll(){
		$query = $this->db->query("SELECT KODE_KEGIATAN as KODE, STATUS_KEGIATAN, JUDUL, TANGGAL FROM tb_kegiatan ORDER BY TANGGAL DESC LIMIT 5");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}


	// PROSES

	function ubah_profil($kode_user){

		$nama        	= htmlspecialchars($this->input->post('nama'), true);
		$jk   			= htmlspecialchars($this->input->post('jk'), true);
		$hp   			= htmlspecialchars($this->input->post('hp'), true);
		$alamat     	= htmlspecialchars($this->input->post('alamat'), true);
		$instagram   	= htmlspecialchars($this->input->post('instagram'), true);
		$instansi     	= htmlspecialchars($this->input->post('instansi'), true);
		$jabatan   		= htmlspecialchars($this->input->post('jabatan'), true);

		if ($jabatan == 3) {
			$jabatan = htmlspecialchars($this->input->post('lainnya'), true);
			$jabatan = "3|".$jabatan;
		}

		$data = array(
			'NAMA'  			=> $nama,
			'JK'  				=> $jk,
			'HP' 				=> $hp,
			'ALAMAT'			=> $alamat,
			'INSTAGRAM'			=> $instagram,
			'INSTANSI'			=> $instansi,
			'JABATAN'			=> $jabatan
		);

		$this->db->where('KODE_USER', $kode_user);
		$this->db->update('tb_univ', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function hapus_akun($kode_user, $deadline){
		$this->db->where('KODE_USER', $kode_user);
		$this->db->update('tb_auth', array('NONAKTIF' => 1, 'DEADLINE' => $deadline));
		$cek = ($this->db->affected_rows() != 1) ? false : true;

		$nama = $this->session->userdata('nama');
		$date = date("d F Y - H:i");

		if ($cek == true) {
			$data = array(
				'RECEIVER'  => $kode_user,
				'SENDER' 		=> "System",
				'TYPE'		  => 6,
			);
			$this->db->insert('log_aktivitas', $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}else {
			return false;
		}
	}

	function batal_hapus(){

		$kode_user 	= $this->session->userdata('kode_user');
		$nama 			= $this->session->userdata('nama');

		$this->db->where('KODE_USER', $kode_user);
		$this->db->update('tb_auth', array('NONAKTIF' => 0, 'DEADLINE' => NULL));
		$cek 	= ($this->db->affected_rows() != 1) ? false : true;

		if ($cek == true) {
			$data = array(
				'RECEIVER'  => $kode_user,
				'SENDER' 		=> "System",
				'TYPE'		  => 7,
			);
			$this->db->insert('log_aktivitas', $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}else {
			return false;
		}
	}

	function read_notifikasi($kode_notifikasi){

		$this->db->where('ID_LOG', $kode_notifikasi);
		$this->db->update('log_aktivitas', array('READ' => 1));
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	function read_notifikasiAll(){
		$kode = $this->session->userdata('kode_user');
		$this->db->query("UPDATE log_aktivitas a SET a.READ = 1 WHERE a.RECEIVER = '$kode' AND a.TYPE IN (SELECT ID_TYPE FROM log_type b WHERE b.TYPE = 1)");
		return true;

	}
}
