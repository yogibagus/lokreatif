<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_authentication extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	// AUTHENTICATION
	
	public function get_auth_univ($email){
		$email = $this->db->escape($email);
		$query = $this->db->query("SELECT * FROM tb_auth a LEFT JOIN tb_univ b ON a.KODE_USER = b.KODE_UNIV LEFT JOIN pt p ON b.KODE_PT = p.kodept WHERE a.EMAIL = $email");

		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function get_pts($search = null){
		$querSearch = "";
		if($search != null){
			$querSearch = " AND namapt LIKE '%$search%' OR kodept LIKE '%$search%' AND kodept != 000001";
		}

        $query  = $this->db->query("SELECT kodept,namapt FROM pt WHERE kodept NOT IN (SELECT KODE_PT FROM tb_univ) $querSearch LIMIT 20");
        $result = $query->result();
        return $result;
	}

	public function get_ptsAll($search = null){
		$querSearch = "";
		if($search != null){
			$querSearch = "WHERE namapt LIKE '%$search%' OR kodept LIKE '%$search%' AND kodept != 000001";
		}

        $query  = $this->db->query("SELECT kodept,namapt FROM pt $querSearch LIMIT 20");
        $result = $query->result();
        return $result;
	}

	public function cek_kodeUser($kode_user){
		$kode_user 	= $this->db->escape($kode_user);
		$query 		= $this->db->query("SELECT * FROM tb_auth WHERE KODE_USER = $kode_user");
		return $query->num_rows();
	}

	// AKTIVASI

	public function get_aktivasi($kode_user){
		$kode_user 	= $this->db->escape($kode_user);
		$query 		= $this->db->query("SELECT * FROM tb_token WHERE KODE = $kode_user AND TYPE = 1");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else {
			return false;
		}
	}

	public function cek_aktivasi($kode_user){
		$kode_user 	= $this->db->escape($kode_user);
		$query 		= $this->db->query("SELECT * FROM tb_token WHERE KODE = $kode_user AND TYPE = 1");
		return $query->num_rows();
	}

	public function aktivasi_kode($kode_aktivasi, $kode_user){

		$db_code 	= $this->encryption->decrypt($this->get_aktivasi($kode_user)->KEY);

		if ($kode_aktivasi == $db_code) {
			return TRUE;
		}else {
			return FALSE;
		}
	}

	public function create_aktivasi(){

		// CREATE KODE AKTIVASI
		$this->encryption->initialize(array('driver' => 'openssl'));

		do {
			$KODE_AKTIVASI	= random_string('numeric', 6);

			// ENCRYPT KODE AKTIVASI
			$ciphercode 	= $this->encryption->encrypt($KODE_AKTIVASI);
		} while ($this->cek_aktivasi($KODE_AKTIVASI) > 0);

		return $ciphercode;
	}

	//PROSES

	public function del_user($kode_user){
		$kode_user 		= $this->db->escape($kode_user);
		$this->db->where('KODE_USER', $kode_user);
		$this->db->delete('tb_auth');
	}

	public function register_peserta(){
		$kolabolator    = $this->input->post('KOLABOLATOR');

		$nama        	= htmlspecialchars($this->input->post('nama'), true);
		$jk   			= htmlspecialchars($this->input->post('jk'), true);
		$hp   			= htmlspecialchars($this->input->post('hp'), true);
		$alamat     	= htmlspecialchars($this->input->post('alamat'), true);
		$instagram   	= htmlspecialchars($this->input->post('instagram'), true);
		$instansi     	= htmlspecialchars($this->input->post('instansi'), true);
		$jabatan   		= htmlspecialchars($this->input->post('jabatan'), true);

		if ($jabatan == 3):
			$jabatan 	= htmlspecialchars($this->input->post('lainnya'), true);
			$jabatan 	= "3|".$jabatan;
		endif;

		$email        	= htmlspecialchars($this->input->post('email'), true);
		$password   	= htmlspecialchars($this->input->post('password'), true);

		// CREATE UNIQ NAME KODE USER

		$string = preg_replace('/[^a-z]/i', '', $nama);

		$vocal  = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " ");
		$scrap  = str_replace($vocal, "", $string);
		$begin  = substr($scrap, 0, 4);
		$uniqid	= strtoupper($begin);

		// CREATE KODE USER
		do {
			$KODE_USER 				= "USR_".$uniqid.substr(md5(time()), 0, 3);
		} while ($this->cek_kodeUser($KODE_USER) > 0);

		// TB AUTH
		$auth = array(
			'KODE_USER' 			=> $KODE_USER,
			'EMAIL' 				=> $email,
			'PASSWORD' 				=> password_hash($password, PASSWORD_DEFAULT),
			'ROLE' 					=> 1,
		);

		$this->db->insert('tb_auth', $auth);

		if ($this->db->affected_rows() == true) {

// 			if ($kolabolator == true) {
// 				$this->db->where('email', $email);
// 				$this->db->update('tb_kolabolator', array('STATUS' => 1));
// 			}

			$peserta = array(
				'KODE_USER' 		=> $KODE_USER,
				'NAMA'  			=> $nama,
				'JK'  				=> $jk,
				'HP' 				=> $hp
			);

			$this->db->insert('tb_peserta', $peserta);

			if ($this->db->affected_rows() == true) {

				$chiper 	= $this->create_aktivasi();

				$aktivasi = array(
					'KODE' 			=> $KODE_USER,
					'KEY'  			=> $chiper,
					'TYPE' 			=> 1,
					'STATUS'		=> 0,
					'DATE_CREATED'	=> time()
				);

				$this->db->insert('tb_token', $aktivasi);
				return ($this->db->affected_rows() != 1) ? false : true;

			}else {
				$this->db->delete('tb_token', array('KODE' => $this->db->escape($KODE_USER), 'TYPE' => 1));

				$this->del_user($KODE_USER);
				return false;
			}
		}else {
			$this->del_user($KODE_USER);
			return false;
		}

	}
	public function register_univ(){
		$kolabolator    = $this->input->post('KOLABOLATOR');

		$kodept        	= htmlspecialchars($this->input->post('kodept'), true);
		$namapt			= $this->db->get_where('pt', ['kodept' => $this->input->post('kodept')])->row()->namapt;
		$hp   			= htmlspecialchars($this->input->post('hp'), true);
		$email        	= htmlspecialchars($this->input->post('email'), true);
		$password   	= htmlspecialchars($this->input->post('password'), true);

		// CREATE UNIQ NAME KODE USER

		$string = preg_replace('/[^a-z]/i', '', $namapt);

		$vocal  = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " ");
		$scrap  = str_replace($vocal, "", $string);
		$begin  = substr($scrap, 0, 4);
		$uniqid	= strtoupper($begin);

		// CREATE KODE USER
		do {
			$KODE_USER 				= "UNIV_".$uniqid.substr(md5(time()), 0, 3);
		} while ($this->cek_kodeUser($KODE_USER) > 0);

		// TB AUTH
		$auth = array(
			'KODE_USER' 			=> $KODE_USER,
			'EMAIL' 				=> $email,
			'PASSWORD' 				=> password_hash($password, PASSWORD_DEFAULT),
			'ROLE' 					=> 3,
		);

		$this->db->insert('tb_auth', $auth);

		if ($this->db->affected_rows() == true) {

// 			if ($kolabolator == true) {
// 				$this->db->where('email', $email);
// 				$this->db->update('tb_kolabolator', array('STATUS' => 1));
// 			}

			$univ = array(
				'KODE_UNIV' 		=> $KODE_USER,
				'KODE_PT'  			=> $kodept,
				'HP' 				=> $hp
			);

			$this->db->insert('tb_univ', $univ);

			if ($this->db->affected_rows() == true) {

				$chiper 	= $this->create_aktivasi();

				$aktivasi = array(
					'KODE' 			=> $KODE_USER,
					'KEY'  			=> $chiper,
					'TYPE' 			=> 1,
					'STATUS'		=> 0,
					'DATE_CREATED'	=> time()
				);

				$this->db->insert('tb_token', $aktivasi);
				return ($this->db->affected_rows() != 1) ? false : true;

			}else {
				$this->db->delete('tb_token', array('KODE' => $this->db->escape($KODE_USER), 'TYPE' => 1));

				$this->del_user($KODE_USER);
				return false;
			}
		}else {
			$this->del_user($KODE_USER);
			return false;
		}

	}

	public function aktivasi_akun($kode_user){

		$data = array('STATUS' => 1);

		$this->db->where('KODE', $kode_user);
		$this->db->update('tb_token', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}


	// PROSES LUPA

	public function cek_kode($kode){
		$kode = $this->db->escape($kode);
		$query = $this->db->query("SELECT * FROM tb_auth WHERE KODE_USER = $kode");
		return $query->num_rows();
	}

	public function cek_akun($email){
		$email = $this->db->escape($email);
		$query = $this->db->query("SELECT * FROM tb_auth WHERE EMAIL = $email");

		if ($query->num_rows() > 0) {
			return TRUE;
		}else{
			return false;
		}
	}

	public function cek_token($token){
		$token = $this->db->escape($token);
		$query = $this->db->query("SELECT * FROM tb_token a WHERE a.KEY = $token AND a.TYPE = 2");

		if ($query->num_rows() > 0) {
			return TRUE;
		}else{
			return false;
		}
	}

	public function get_token($token){
		$token = $this->db->escape($token);
		$query = $this->db->query("SELECT * FROM tb_token a WHERE a.KEY = $token AND a.TYPE = 2");

		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function get_prov(){
		return $this->db->get('md_provinsi')->result();
	}
	
	public function cek_pt($kodept){
		return $this->db->get_where('pt', ['kodept' => $kodept])->result();
	}
	
	public function cek_pt_raw($kodept){
		return $this->db->get_where('pt_raw', ['kodept' => $kodept, 'status' => '0'])->result();
	}
	public function insert_pt_raw($param){
		$this->db->insert('pt_raw', $param);		
	}
}
