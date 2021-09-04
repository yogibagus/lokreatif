<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_peserta extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	// DATA PENDAFTARAN KOMPETISI & get biaya daftar

	function get_detailDaftar($id){
		$query = $this->db->get_where("pendaftaran_kegiatan", array('KODE_PENDAFTARAN' => $id));

		if ($query->num_rows() > 0) {
			return $query->row();
		}else {
			return false;
		}
	}

	// PESERTA

	public function cek_kodePendaftaran($kode){
		$kode  = $this->db->escape($kode);
		$query = $this->db->query("SELECT * FROM pendaftaran_kompetisi WHERE KODE_PENDAFTARAN = $kode");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else {
			return false;
		}
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
				$sender = $this->db->get("tb_peserta")->row()->NAMA;
			elseif($part[0] == "PYL"):
				$this->db->where("KODE_PENYELENGGARA", $kode);
				$sender = $this->db->get("tb_penyelenggara")->row()->NAMA;
			elseif($part[0] == "JRI"):
				$this->db->where("KODE_USER", $kode);
				$sender = $this->db->get("tb_peserta")->row()->NAMA;
			else:
				$sender = "System";
			endif;

			return $sender;
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

		$query			= $this->db->query("SELECT a.*, b.EMAIL, b.NONAKTIF, b.DEADLINE FROM tb_peserta a LEFT JOIN tb_auth b ON a.KODE_USER = b.KODE_USER WHERE a.KODE_USER = $kode_user");
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

	// PAYMENT

	function get_paymentList($KODE_TRANS){
		$query = $this->db->query("SELECT * FROM tb_payment a LEFT JOIN tb_payment_method b ON a.ID_PAY_METHOD = b.ID_PAY_METHOD WHERE a.KODE_TRANS = '$KODE_TRANS' ORDER BY a.CREATED_TIME DESC");
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

		$data = array(
			'NAMA'  			=> $nama,
			'JK'  				=> $jk,
			'HP' 				=> $hp
		);

		$this->db->where('KODE_USER', $kode_user);
		$this->db->update('tb_peserta', $data);
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

	function set_anggota(){

		$KODE_PENDAFTARAN	= $this->input->post('KODE_PENDAFTARAN');

		$this->db->where('KODE_PENDAFTARAN', $KODE_PENDAFTARAN);
		$this->db->delete('tb_anggota');

		// KETUA
		$NAMA_KETUA			= $this->input->post('NAMA_KETUA');
		$NIM_KETUA			= $this->input->post('NIM_KETUA');
		$EMAIL_KETUA		= $this->input->post('EMAIL_KETUA');

		$ketua = array(
			'KODE_PENDAFTARAN'  => $KODE_PENDAFTARAN,
			'NAMA'  			=> $NAMA_KETUA,
			'NIM'  				=> $NIM_KETUA,
			'EMAIL'  			=> $EMAIL_KETUA,
			'PERAN'				=> 1
		);

		// DOSPEM
		$NAMA_DOSPEM		= $this->input->post('NAMA_DOSPEM');
		$NIM_DOSPEM			= $this->input->post('NIM_DOSPEM');
		$EMAIL_DOSPEM		= $this->input->post('EMAIL_DOSPEM');

		$dospem = array(
			'KODE_PENDAFTARAN'  => $KODE_PENDAFTARAN,
			'NAMA'  			=> $NAMA_DOSPEM,
			'NIM'  				=> $NIM_DOSPEM,
			'EMAIL'  			=> $EMAIL_DOSPEM,
			'PERAN'				=> 2
		);
		$this->db->insert('tb_anggota', $dospem);

		$this->db->insert('tb_anggota', $ketua);

		// ANGGOTA
		$NAMA_ANGGOTA 		= $this->input->post('NAMA_ANGGOTA', true);
		$NIM_ANGGOTA 		= $this->input->post('NIM_ANGGOTA', true);
		$EMAIL_ANGGOTA 		= $this->input->post('EMAIL_ANGGOTA', true);

		// cek data anggota redundant
		foreach ($NIM_ANGGOTA as $i) {
			$nim = isset($i) ? $i : '';
			if($this->General->cek_anggotaRedundant($this->session->userdata('kode_user'), $nim) != null){
				return ['status' => false, 'msg' => "Data dengan NIM $nim telah terdaftar !!!"];
			}
		}

		foreach ($NAMA_ANGGOTA as $i => $a) {
			$anggota = array(
				'KODE_PENDAFTARAN' 	=> $KODE_PENDAFTARAN,
				'NAMA' 				=> isset($NAMA_ANGGOTA[$i]) ? $NAMA_ANGGOTA[$i] : '',
				'NIM'				=> isset($NIM_ANGGOTA[$i]) ? $NIM_ANGGOTA[$i] : '',
				'EMAIL'				=> isset($EMAIL_ANGGOTA[$i]) ? $EMAIL_ANGGOTA[$i] : '',
				'PERAN'				=> 3
			);

			$this->db->insert('tb_anggota', $anggota);

			if ((($this->db->affected_rows() != 1) ? false : true) == false) {
				return ['status' => false, 'msg' => "Terjadi kesalahan saat mengatur data anggota !!"];
			}
		}
		return ($this->db->affected_rows() != 1) ? ['status' => false, 'msg' => "Terjadi kesalahan saat mengatur data anggota !!"] : ['status' => true, 'msg' => "Berhasil mengatur data anggota !!"];
	}

	function hapus_anggota($id){

		$this->db->where('ID_ANGGOTA', $id);
		$this->db->delete('tb_anggota');
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function update_pts(){

		$KODE_PENDAFTARAN	= $this->input->post('KODE_PENDAFTARAN');
		$PT					= $this->input->post('ASAL_PTS');
		$PT 	    		= explode("-", $PT);
		$ASAL_PTS			= $PT[0];
		$ALAMAT_PTS			= $this->input->post('ALAMAT_PTS');

		$data = array(
			'ASAL_PTS'  		=> $ASAL_PTS,
			'ALAMAT_PTS'  		=> $ALAMAT_PTS
		);

		$this->db->where('KODE_PENDAFTARAN', $KODE_PENDAFTARAN);
		$this->db->update('pendaftaran_kompetisi', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function bayar_pendaftaran($KODE_TRANS, $KODE_PENDAFTARAN, $BIAYA_TIM){
		$KODE_USER_BILL 	= $this->session->userdata('kode_user');
		$ROLE_USER_BILL 	= $this->session->userdata('role');

		$transaksi = array(
			'KODE_TRANS' 		=> $KODE_TRANS,
			'KODE_USER_BILL' 	=> $KODE_USER_BILL,
			'ROLE_USER_BILL' 	=> $ROLE_USER_BILL,
		);

		$this->db->insert('tb_transaksi', $transaksi);

		if ((($this->db->affected_rows() != 1) ? false : true) == true) {
			$order = array(
				'KODE_TRANS' 		=> $KODE_TRANS,
				'KODE_PENDAFTARAN' 	=> $KODE_PENDAFTARAN,
				'BIAYA_TIM' 		=> $BIAYA_TIM
			);

			$this->db->insert('tb_order', $order);
			return ($this->db->affected_rows() != 1) ? false : true;
		}else{
			return false;
		}
	}

	function update_berkas($data, $KODE_PENDAFTARAN){
		$this->db->where('KODE_PENDAFTARAN', $KODE_PENDAFTARAN);
		$this->db->update('pendaftaran_kompetisi', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function update_jawaban($KODE_PENDAFTARAN, $ID_FORM, $data){

		$cek = $this->db->get_where('pendaftaran_data', array('KODE_PENDAFTARAN' => $KODE_PENDAFTARAN, 'ID_FORM' => $ID_FORM));

		if ($cek->num_rows() > 0) {
			$this->db->where(array('KODE_PENDAFTARAN' => $KODE_PENDAFTARAN, 'ID_FORM' => $ID_FORM));
			$this->db->update('pendaftaran_data', $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}else{

			$this->db->insert('pendaftaran_data', array('KODE_PENDAFTARAN' => $KODE_PENDAFTARAN, 'ID_FORM' => $ID_FORM));

			$this->db->where(array('KODE_PENDAFTARAN' => $KODE_PENDAFTARAN, 'ID_FORM' => $ID_FORM));
			$this->db->update('pendaftaran_data', $data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}
	}
}
