<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function log_aktivitas($KODE_USER, $SENDER, $TYPE){
		$data = array(
			'RECEIVER' 	 	=> $KODE_USER,
			'SENDER' 		=> $SENDER,
			'TYPE'	 		=> $TYPE,
		);
		$this->db->insert('log_aktivitas', $data);
	}

	public function log_aktivitasKpanel($KODE_USER, $TYPE, $GROUP){
		$data = array(
			'RECEIVER' 	 	=> "ADMIN",
			'SENDER' 		=> $KODE_USER,
			'TYPE'	 		=> $TYPE,
			'RECEIVER_GROUP'=> $GROUP,
		);
		$this->db->insert('log_aktivitas', $data);
	}

	function cek_passAdmin($pass){
		$kode_user 		= $this->session->userdata("kode_user");
		$query 			= $this->db->query("SELECT * FROM tb_auth WHERE KODE_USER = '$kode_user'");
		$password_lama	= $query->row()->PASSWORD;

		if(password_verify($pass, $password_lama)){
			return TRUE;
		}else{
			return FALSE;

		}
	}

	// COUNTING

	public function count_pesertaKegiatan($kode){
		return $this->db->get_where('pendaftaran_kegiatan', array('KODE_KEGIATAN' => $kode))->num_rows();
	}

	public function count_pesertaKompetisi($kode){
		return $this->db->get_where('pendaftaran_kegiatan', array('KODE_KEGIATAN' => $kode))->num_rows();
	}

	public function count_pesertaKegiatanAll(){
		return $this->db->get('pendaftaran_kegiatan')->num_rows();
	}

	public function count_pesertaKompetisiAll(){
		return $this->db->get('pendaftaran_kegiatan')->num_rows();
	}

	// REFUND

	public function countRefund(){
		return $this->db->get('tb_refund')->num_rows();
	}

	public function countSudahRefund(){
		return $this->db->get_where('tb_refund', array('STAT_REFUND' => 1))->num_rows();
	}


	// PESERTA
	function countPeserta(){
		$query 	= $this->db->query("SELECT * FROM tb_auth WHERE ROLE = 1");
		return $query->num_rows();
	}

	function countDiffPeserta(){
		$query 	= $this->db->query("SELECT * FROM tb_auth WHERE ROLE = 1 AND JOIN_DATE <= now() - INTERVAL 1 DAY");
		return $query->num_rows();
	}

	function countNonPeserta(){
		$query 	= $this->db->query("SELECT * FROM tb_auth WHERE ROLE = 1 AND NONAKTIF = 1");
		return $query->num_rows();
	}

	function countDiffNonPeserta(){
		$query 	= $this->db->query("SELECT * FROM tb_auth WHERE ROLE = 1 AND NONAKTIF = 1 AND JOIN_DATE <= now() - INTERVAL 8 DAY");
		return $query->num_rows();
	}

	function countNewPeserta(){
		$query 	= $this->db->query("SELECT * FROM tb_auth WHERE ROLE = 1 AND JOIN_DATE >= now() - INTERVAL 1 DAY");
		return $query->num_rows();
	}

	// KEGIATAN

	function countKegiatan(){
		$query 	= $this->db->query("SELECT * FROM tb_kegiatan");
		return $query->num_rows();
	}

	function countDiffKegiatan(){
		$query 	= $this->db->query("SELECT * FROM tb_kegiatan WHERE LOG_TIME <= now() - INTERVAL 8 DAY");
		return $query->num_rows();
	}

	function countNewKegiatan(){
		$query 	= $this->db->query("SELECT * FROM tb_kegiatan WHERE LOG_TIME >= now() - INTERVAL 1 DAY");
		return $query->num_rows();
	}

	// END COUNTING

	// REFUND

	// function get_refund(){
	// 	$query 	= $this->db->query("SELECT * FROM tb_refund a JOIN tb_transaksi b ON a.KODE_USER = b.KODE_USER WHERE a.ROLE = 1");
	// 	return $query->result();
	// }

	// PESERTA

	function get_peserta(){
		$query 	= $this->db->query("SELECT * FROM tb_auth a JOIN tb_peserta b ON a.KODE_USER = b.KODE_USER WHERE a.ROLE = 1");
		return $query->result();
	}

	// AKTIVITAS & NOTIFIKASI

	public function count_aktivitasAdmin(){
		$query = $this->db->query("SELECT * FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 0");
		return $query->num_rows();
	}

	public function get_aktivitasAdmin($limit, $start){
		$query = $this->db->query("SELECT a.*, b.* FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 0 ORDER BY a.CREATED_AT DESC LIMIT $start, $limit");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else {
			return false;
		}
	}

	public function count_notifikasiAdmin(){
		$query = $this->db->query("SELECT * FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 1");
		return $query->num_rows();
	}

	public function get_notifikasiAdmin($limit, $start){
		$query = $this->db->query("SELECT a.*, b.* FROM log_aktivitas a JOIN log_type b ON a.TYPE = b.ID_TYPE WHERE b.TYPE = 1 ORDER BY a.CREATED_AT DESC LIMIT $start, $limit");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else {
			return false;
		}
	}

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

	// PENGATURAN

	// MAILER

	function get_mailerSmpt(){
		$query = $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'SMPT_GMAIL'");
		return $query->row()->VALUE;
	}

	function get_mailerHost(){
		$query = $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'EM_HOST'");
		return $query->row()->VALUE;
	}

	function get_mailerUsername(){
		$query = $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'EM_USERNAME'");
		return $query->row()->VALUE;
	}

	function get_mailerPassword(){
		$query = $this->db->query("SELECT VALUE FROM tb_pengaturan a WHERE a.KEY = 'EM_PASSWORD'");
		return $query->row()->VALUE;
	}

	// END PENGATURAN

	// KEGIATAN

	public function get_kegiatanAllD(){
		$this->db->select('*');
		$this->db->from('tb_kegiatan');
		$this->db->limit(5);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_kegiatanAll(){
		$this->db->select('*');
		$this->db->from('tb_kegiatan');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	// KOMPETISI

	public function get_kompetisiAllD(){
		$this->db->select('*');
		$this->db->from('tb_kegiatan');
		$this->db->limit(5);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	public function get_kompetisiAll(){
		$this->db->select('*');
		$this->db->from('tb_kegiatan');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	// BERKAS

	public function get_berkasLomba(){
		$this->db->select('*');
		$this->db->from('berkas_kebutuhan');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	// PTS BARU

	public function cek_kodePTSbaru($kodept){
		$query = $this->db->get_where('pt', array('kodept' => $kodept));
		if ($query->num_rows() > 0) {
			return true;
		}else{
			return false;
		}

	}

	public function get_ptsBaru(){
		$this->db->select('*');
		$this->db->from('pt_raw');
		$this->db->order_by('STATUS ASC', 'kodept ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}


	// PROSES

	// VERIFIKASI PENGAJUAN
	// 0 MENUNGGU VERIFIKASI / NON-ACTIVE
	// 1 DITERIMA / ACTIVE
	// 2 DITOLAK / CANCELED
	// 3 SUSPENDED

	// BERKAS


	public function tambahBerkas($file){
		$JUDUL 		= $this->input->post('JUDUL');
		$KETERANGAN = $this->input->post('KETERANGAN');

		$data = array(
			'JUDUL' 		=> $JUDUL,
			'LINK' 			=> $file,
			'KETERANGAN' 	=> $KETERANGAN,
		);

		$this->db->insert('berkas_kebutuhan', $data);
		return ($this->db->affected_rows() != 1) ? false : true;

	}


	public function editBerkas($file){
		$ID_BERKAS 	= $this->input->post('ID_BERKAS');
		$JUDUL 		= $this->input->post('JUDUL');
		$KETERANGAN = $this->input->post('KETERANGAN');

		$data = array(
			'JUDUL' 		=> $JUDUL,
			'LINK' 			=> $file,
			'KETERANGAN' 	=> $KETERANGAN,
		);

		$this->db->where('ID_BERKAS', $ID_BERKAS);
		$this->db->update('berkas_kebutuhan', $data);
		return ($this->db->affected_rows() != 1) ? false : true;

	}


	public function hapusBerkas(){
		$ID_BERKAS 	= $this->input->post('ID_BERKAS');

		$this->db->where('ID_BERKAS', $ID_BERKAS);
		$this->db->delete('berkas_kebutuhan');
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	// PENGATURAN

	public function ganti_passAdmin(){
		$pass 		= htmlspecialchars($this->input->post('PASS_BARU'), true);
		$pass 		= password_hash($pass, PASSWORD_DEFAULT);

		$this->db->where('KODE_USER', $this->session->userdata("kode_user"));
		$this->db->update('tb_auth', array('PASSWORD' => $pass));

		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function ubah_mailer(){
		$SMPT_GMAIL 		= $this->input->post('SMPT_GMAIL');
		$EM_HOST 			= $this->input->post('EM_HOST');
		$EM_USERNAME 		= $this->input->post('EM_USERNAME');
		$EM_PASSWORD 		= $this->input->post('EM_PASSWORD');


		$this->db->where('KEY', "SMPT_GMAIL");
		$this->db->update('tb_pengaturan', array('VALUE' => ($SMPT_GMAIL == true ? 1 : 0)));

		$this->db->where('KEY', "EM_HOST");
		$this->db->update('tb_pengaturan', array('VALUE' => $EM_HOST));

		$this->db->where('KEY', "EM_USERNAME");
		$this->db->update('tb_pengaturan', array('VALUE' => $EM_USERNAME));

		$this->db->where('KEY', "EM_PASSWORD");
		$this->db->update('tb_pengaturan', array('VALUE' => $EM_PASSWORD));


		return true;
	}

	public function ubah_sosmed(){
		$LN_FACEBOOK 		= $this->input->post('LN_FACEBOOK');
		$LN_INSTAGRAM 		= $this->input->post('LN_INSTAGRAM');
		$LN_TWITTER 		= $this->input->post('LN_TWITTER');
		$LN_GITHUB 			= $this->input->post('LN_GITHUB');


		$this->db->where('KEY', "LN_FACEBOOK");
		$this->db->update('tb_pengaturan', array('VALUE' => $LN_FACEBOOK));

		$this->db->where('KEY', "LN_INSTAGRAM");
		$this->db->update('tb_pengaturan', array('VALUE' => $LN_INSTAGRAM));

		$this->db->where('KEY', "LN_TWITTER");
		$this->db->update('tb_pengaturan', array('VALUE' => $LN_TWITTER));

		$this->db->where('KEY', "LN_GITHUB");
		$this->db->update('tb_pengaturan', array('VALUE' => $LN_GITHUB));


		return true;
	}

	public function ubah_websiteInfo(){
		$WEB_JUDUL 			= $this->input->POST('WEB_JUDUL');
		$WEB_DESKRIPSI 		= $this->input->POST('WEB_DESKRIPSI');
		$WEB_WA 			= $this->input->POST('WEB_WA');
		$WEB_HERO_BUTTON 	= $this->input->POST('WEB_HERO_BUTTON');
		$OPEN_CAREER 		= $this->input->POST('OPEN_CAREER');


		$this->db->where('KEY', "WEB_JUDUL");
		$this->db->update('tb_pengaturan', array('VALUE' => $WEB_JUDUL));

		$this->db->where('KEY', "WEB_DESKRIPSI");
		$this->db->update('tb_pengaturan', array('VALUE' => $WEB_DESKRIPSI));

		$this->db->where('KEY', "WEB_WA");
		$this->db->update('tb_pengaturan', array('VALUE' => $WEB_WA));

		$this->db->where('KEY', "WEB_HERO_BUTTON");
		$this->db->update('tb_pengaturan', array('VALUE' => ($WEB_HERO_BUTTON == true ? 1 : 0)));

		$this->db->where('KEY', "OPEN_CAREER");
		$this->db->update('tb_pengaturan', array('VALUE' => ($OPEN_CAREER == true ? 1 : 0)));


		return true;
	}

	// KEGIATAN
	function cek_kodeKegiatan($kode){
		$query 		= $this->db->query("SELECT * FROM tb_kegiatan WHERE KODE_KEGIATAN = '$kode'");
		return $query->num_rows();
	}

	function proses_buatKegiatan($KODE_KEGIATAN, $filename){
		// KEGIATAN
		$JENIS				= htmlspecialchars($this->input->post('JENIS'), true);
		$JUDUL				= htmlspecialchars($this->input->post('JUDUL'), true);
		$TANGGAL			= htmlspecialchars($this->input->post('TANGGAL'), true);
		$WAKTU				= htmlspecialchars($this->input->post('WAKTU'), true);
		$MEDIA 				= htmlspecialchars($this->input->post('MEDIA'), true);
		$BAYAR 				= $this->input->post('BAYAR');
		$ONLINE 			= $this->input->post('ONLINE');
		$DESKRIPSI 			= $this->input->post('DESKRIPSI');

		//TIKET
		$NAMA_TIKET 		= $this->input->post('NAMA_TIKET', true);
		$HARGA_TIKET 		= $this->input->post('HARGA_TIKET', true);

		//SOSMED
		$SOSMED 			= $this->input->post('SOSMED', true);
		$NAMA_SOSMED 		= $this->input->post('NAMA_SOSMED', true);
		$LINK_SOSMED 		= $this->input->post('LINK_SOSMED', true);

		//CONTACT
		$NAMA_CONTACT 		= $this->input->post('NAMA_CONTACT', true);
		$CONTACT 			= $this->input->post('CONTACT', true);
		$CONTACT_MEDIA 		= $this->input->post('CONTACT_MEDIA', true);


		// INSERT KEGIATAN

		$kegiatan = array(
			'KODE_KEGIATAN' 		=> $KODE_KEGIATAN,
			'JUDUL' 				=> $JUDUL,
			'JENIS' 				=> $JENIS,
			'POSTER' 				=> $filename,
			'TANGGAL' 				=> $TANGGAL,
			'WAKTU' 				=> $WAKTU,
			'MEDIA' 				=> $MEDIA,
			'BAYAR' 				=> ($BAYAR == TRUE ? 1 : 0),
			'ONLINE' 				=> ($ONLINE == TRUE ? 1 : 0),
			'DESKRIPSI' 			=> $DESKRIPSI,
		);

		$this->db->insert('tb_kegiatan', $kegiatan);

		$cek = ($this->db->affected_rows() != 1) ? false : true;

		if ($cek == TRUE) {
			// TIKET
			foreach ($NAMA_TIKET as $i => $a) {
				if ($NAMA_TIKET[$i] != "") {
					$tiket = array(
						'TYPE' 				=> 1,
						'KODE' 				=> $KODE_KEGIATAN,
						'NAMA_TIKET' 		=> isset($NAMA_TIKET[$i]) ? $NAMA_TIKET[$i] : '',
						'HARGA_TIKET'		=> isset($HARGA_TIKET[$i]) ? $HARGA_TIKET[$i] : '',
					);
					$this->db->insert('tb_tiket', $tiket);
				}
			}

			// SOSMED
			foreach ($NAMA_SOSMED as $j => $b) {
				if ($NAMA_SOSMED[$j] != "") {
					$sosmed = array(
						'TYPE' 				=> 1,
						'KODE' 				=> $KODE_KEGIATAN,
						'NAMA_SOSMED' 		=> isset($NAMA_SOSMED[$j]) ? $NAMA_SOSMED[$j] : '',
						'LINK_SOSMED'		=> isset($LINK_SOSMED[$j]) ? $LINK_SOSMED[$j] : '',
						'SOSMED'			=> isset($SOSMED[$j]) ? $SOSMED[$j] : '',
					);
					$this->db->insert('tb_sosmed', $sosmed);
				}
			}

			// CP
			foreach ($NAMA_CONTACT as $k => $a) {
				if ($NAMA_CONTACT[$k] != "") {
					$contact = array(
						'TYPE' 				=> 1,
						'KODE' 				=> $KODE_KEGIATAN,
						'NAMA_CONTACT' 		=> isset($NAMA_CONTACT[$k]) ? $NAMA_CONTACT[$k] : '',
						'CONTACT'			=> isset($CONTACT[$k]) ? $CONTACT[$k] : '',
						'CONTACT_MEDIA'		=> isset($CONTACT_MEDIA[$k]) ? $CONTACT_MEDIA[$k] : '',
					);
					$this->db->insert('tb_contact_person', $contact);
				}
			}
			return true;
		}else{
			$this->db->delete('tb_kegiatan', array('KODE_KEGIATAN', $KODE_KEGIATAN));
			return false;
		}
	}


	// PTS BARU


	public function terima_pts($id){
		//TIKET
		$KOPERTIS 		= $this->input->post('KOPERTIS', true);
		$WILAYAH 		= $this->input->post('WILAYAH', true);
		$AGAMA 			= $this->input->post('AGAMA', true);

		$this->db->where('id', $id);
		$this->db->update('pt_raw', array('STATUS' => 1));
		$cek = ($this->db->affected_rows() != 1) ? false : true;

		if ($cek == true) {
			$ptsBaru = $this->db->get_where('pt_raw', array('id' => $id))->row();

			$data = array(
				'kodept' 	=> $ptsBaru->kodept,
				'namapt' 	=> $ptsBaru->namapt,
				'kopertis' 	=> $KOPERTIS,
				'wilayah' 	=> $WILAYAH,
				'jenis' 	=> $ptsBaru->jenis,
				'agama' 	=> $AGAMA,
				'statuspt' 	=> 'AKTIF',
				'provinsi'	=> $ptsBaru->provinsi,
			);

			$this->db->insert('pt', $data);
			return ($this->db->affected_rows() != 1) ? false : true;

		}else{

			$this->db->where('id', $id);
			$this->db->update('pt_raw', array('STATUS' => 0));
			return false;
		}

	}


	public function tolak_pts($id){

		$this->db->where('id', $id);
		$this->db->update('pt_raw', array('STATUS' => 0));
		$cek = ($this->db->affected_rows() != 1) ? false : true;

		if ($cek == true) {
			$ptsBaru = $this->db->get_where('pt_raw', array('id' => $id))->row();

			$this->db->where('kodept', $ptsBaru->kodept);
			$this->db->delete('pt');
			return ($this->db->affected_rows() != 1) ? false : true;

		}else{

			$this->db->where('id', $id);
			$this->db->update('pt_raw', array('STATUS' => 1));
			return false;
		}

	}

}
