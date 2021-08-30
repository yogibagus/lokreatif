<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_template extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	// SOSMED

	function get_facebookLink(){
		$query 	= $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'LN_FACEBOOK'");
		return $query->row()->VALUE;
	}

	function get_instagramLink(){
		$query 	= $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'LN_INSTAGRAM'");
		return $query->row()->VALUE;
	}

	function get_twitterLink(){
		$query 	= $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'LN_TWITTER'");
		return $query->row()->VALUE;
	}

	function get_githubLink(){
		$query 	= $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'LN_GITHUB'");
		return $query->row()->VALUE;
	}

	// LOGO

	function get_logoFav(){
		$query 	= $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'LOGO_FAV'");
		return $query->row()->VALUE;
	}

	function get_logoWhite(){
		$query 	= $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'LOGO_WHITE'");
		return $query->row()->VALUE;
	}

	function get_logoBlack(){
		$query 	= $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'LOGO_BLACK'");
		return $query->row()->VALUE;
	}

	// META

	function get_webJudul(){
		$query 	= $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'WEB_JUDUL'");
		return $query->row()->VALUE;
	}

	function get_webDeskripsi(){
		$query 	= $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'WEB_DESKRIPSI'");
		return $query->row()->VALUE;
	}

	function get_webWa(){
		$query 	= $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'WEB_WA'");
		return $query->row()->VALUE;
	}

	function get_webHeroButton(){
		$query 	= $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'WEB_HERO_BUTTON'");
		return $query->row()->VALUE;
	}

	function get_termAndCondition(){
		$query 	= $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'TERM_CONDITION'");
		return $query->row()->VALUE;
	}

	// NOTIFIKASI & AKTIVITAS ADMIN

	public function count_notifikasi($kode){
		$query = $this->db->query("SELECT * FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 1 AND a.RECEIVER = '$kode' AND a.READ = 0");
		return $query->num_rows();
	}

	public function count_notifikasiAdmin(){
		$query = $this->db->query("SELECT * FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 1 AND a.READ = 0");
		return $query->num_rows();
	}

	public function count_aktivitasAdmin(){
		$query = $this->db->query("SELECT * FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 0");
		return $query->num_rows();
	}

	public function get_notifikasiAdmin(){
		$query = $this->db->query("SELECT a.*, b.* FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 1 ORDER BY a.CREATED_AT DESC LIMIT 5");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else {
			return false;
		}
	}

	public function get_aktivitasAdmin(){
		$query = $this->db->query("SELECT a.*, b.* FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 0 ORDER BY a.CREATED_AT DESC LIMIT 8");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else {
			return false;
		}
	}

	// NOTIFIKASI & AKTIVITAS K-PANEL

	public function count_notifikasiKpanel($kode_akses){
		$query = $this->db->query("SELECT * FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 1 AND a.READ = 0 AND a.RECEIVER_GROUP = 3 AND a.RECEIVER = '$kode_akses'");
		return $query->num_rows();
	}

	public function count_aktivitasKpanel($kode_akses){
		$query = $this->db->query("SELECT * FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 0 AND a.RECEIVER_GROUP = 3 AND a.RECEIVER = '$kode_akses'");
		return $query->num_rows();
	}

	public function get_notifikasiKpanel($kode_akses){
		$query = $this->db->query("SELECT a.*, b.* FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 1 AND a.RECEIVER_GROUP = 3 AND a.RECEIVER = '$kode_akses' ORDER BY a.CREATED_AT DESC LIMIT 5");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else {
			return false;
		}
	}

	public function get_aktivitasKpanel($kode_akses){
		$query = $this->db->query("SELECT a.*, b.* FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 0 AND a.RECEIVER_GROUP = 3 AND a.RECEIVER = '$kode_akses' ORDER BY a.CREATED_AT DESC LIMIT 8");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else {
			return false;
		}
	}

	// NOTIFIKASI & AKTIVITAS EVENT


	public function count_notifikasiKegiatan($kode_akses){
		$query = $this->db->query("SELECT * FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 1 AND a.READ = 0 AND a.RECEIVER_GROUP = 4 AND a.RECEIVER = '$kode_akses'");
		return $query->num_rows();
	}

	public function count_aktivitasKegiatan($kode_akses){
		$query = $this->db->query("SELECT * FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 0 AND a.RECEIVER_GROUP = 4 AND a.RECEIVER = '$kode_akses'");
		return $query->num_rows();
	}

	public function get_notifikasiKegiatan($kode_akses){
		$query = $this->db->query("SELECT a.*, b.* FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 1 AND a.RECEIVER_GROUP = 4 AND a.RECEIVER = '$kode_akses' ORDER BY a.CREATED_AT DESC LIMIT 5");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else {
			return false;
		}
	}

	public function get_aktivitasKegiatan($kode_akses){
		$query = $this->db->query("SELECT a.*, b.* FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 0 AND a.RECEIVER_GROUP = 4 AND a.RECEIVER = '$kode_akses' ORDER BY a.CREATED_AT DESC LIMIT 8");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else {
			return false;
		}
	}

	// NOTIFIKASI & AKTIVITAS KOMPETISI


	public function count_notifikasiKompetisi($kode_akses){
		$query = $this->db->query("SELECT * FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 1 AND a.READ = 0 AND a.RECEIVER_GROUP = 5 AND a.RECEIVER = '$kode_akses'");
		return $query->num_rows();
	}

	public function count_aktivitasKompetisi($kode_akses){
		$query = $this->db->query("SELECT * FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 0 AND a.RECEIVER_GROUP = 5 AND a.RECEIVER = '$kode_akses'");
		return $query->num_rows();
	}

	public function get_notifikasiKompetisi($kode_akses){
		$query = $this->db->query("SELECT a.*, b.* FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 1 AND a.RECEIVER_GROUP = 5 AND a.RECEIVER = '$kode_akses' ORDER BY a.CREATED_AT DESC LIMIT 5");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else {
			return false;
		}
	}

	public function get_aktivitasKompetisi($kode_akses){
		$query = $this->db->query("SELECT a.*, b.* FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 0 AND a.RECEIVER_GROUP = 5 AND a.RECEIVER = '$kode_akses' ORDER BY a.CREATED_AT DESC LIMIT 8");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else {
			return false;
		}
	}

	// GET PROFIL & SENDER

	public function get_profil($kode){
		$part	= explode("_", $kode);

		$this->db->select("PROFIL");
		if($part[0] == "USR" || $part[0] == "ADM" || $part[0] == "JRI"):
			$this->db->where("KODE_USER", $kode);
			$sender = $this->db->get("tb_peserta")->row()->PROFIL;
		elseif($part[0] == "PYL"):
			$this->db->where("KODE_PENYELENGGARA", $kode);
			$sender = $this->db->get("tb_penyelenggara")->row()->PROFIL;
		else:
			$sender = "System";
		endif;

		return $sender;
	}

	public function get_sender($kode){

		if ($kode == "System") {
			return "System";
		}else {
			$part	= explode("_", $kode);

			$this->db->select("NAMA");
			if($part[0] == "USR" || $part[0] == "ADM" || $part[0] == "JRI"):
				$this->db->where("KODE_USER", $kode);
				$sender = $this->db->get("tb_peserta")->row()->NAMA;
			elseif($part[0] == "PYL"):
				$this->db->where("KODE_PENYELENGGARA", $kode);
				$sender = $this->db->get("tb_penyelenggara")->row()->NAMA;
			else:
				$sender = "System";
			endif;

			return $sender;
		}
	}

	// END NOTIFIKASI

	public function cek_aktivasi($kode_user){
		$query = $this->db->query("SELECT * FROM tb_token WHERE KODE = '$kode_user' AND TYPE = 1");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else {
			return false;
		}
	}

	function count_kpanel($email){
		$email 	= $this->db->escape($email);

		$query	= $this->db->query("SELECT * FROM tb_kolabolator WHERE EMAIL = $email");

		return $query->num_rows();

	}

	function get_foto($kode_user, $role){
		$kode_user 	= $this->db->escape($kode_user);

		if($role == "3"){
			$query	= $this->db->query("SELECT * FROM tb_univ WHERE KODE_UNIV = $kode_user");
		}else{
			$query	= $this->db->query("SELECT * FROM tb_peserta WHERE KODE_USER = $kode_user");
		}
		return $query->row();

	}

	// PENDAFTARAN

	function cek_form($kode){
		$query = $this->db->get_where("form_meta", array('KODE' => $kode));
		if ($query->num_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	// END PENDAFTARAN

}
