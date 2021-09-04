<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_manageKompetisi extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	// TYPE CP, SOSMED, TIKET
	// 1. KOMPETISI
	// 2. KOMPETISI

	public function log_aktivitasKpanel($KODE_USER, $TYPE, $GROUP){
		$data = array(
			'SENDER' 		=> $KODE_USER,
			'TYPE'	 		=> $TYPE,
			'RECEIVER_GROUP'=> $GROUP,
		);
		$this->db->insert('log_aktivitas', $data);
	}

	function count_peserta($kode){
		return $this->db->get_where("pendaftaran_kompetisi", array('KODE_KOMPETISI' => $kode))->num_rows();
	}

	function count_pesertaVerif($kode){
		return $this->db->get_where("pendaftaran_kompetisi", array('KODE_KOMPETISI' => $kode, 'STATUS' => 1))->num_rows();
	}

	//BIDANG LOMBA
	function get_bidangLomba(){
		$query	= $this->db->get('bidang_lomba');
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	function tambah_bidangLomba(){
		$BIDANG_LOMBA 	= htmlspecialchars($this->input->post('BIDANG_LOMBA'), true);
		$KETERANGAN 	= htmlspecialchars($this->input->post('KETERANGAN'), true);

		$data = array(
			'BIDANG_LOMBA' 	=> $BIDANG_LOMBA,
			'KETERANGAN' 	=> $KETERANGAN,
		);
		$this->db->insert('bidang_lomba', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function edit_bidangLomba(){
		$ID_BIDANG 		= $this->input->post('ID_BIDANG');

		$BIDANG_LOMBA 	= htmlspecialchars($this->input->post('BIDANG_LOMBA'), true);
		$KETERANGAN 	= htmlspecialchars($this->input->post('KETERANGAN'), true);

		$data = array(
			'BIDANG_LOMBA' 	=> $BIDANG_LOMBA,
			'KETERANGAN' 	=> $KETERANGAN,
		);

		$this->db->where('ID_BIDANG', $ID_BIDANG);
		$this->db->update('bidang_lomba', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function hapus_bidangLomba(){
		$ID_BIDANG 		= $this->input->post('ID_BIDANG');

		$this->db->where('ID_BIDANG', $ID_BIDANG);
		$this->db->delete('bidang_lomba');
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	//DATA JURI
	function get_dataJuri(){
		$query = $this->db->query("SELECT * FROM tb_auth a JOIN tb_peserta b ON a.KODE_USER = b.KODE_USER LEFT JOIN bidang_juri c ON a.KODE_USER = c.KODE_USER WHERE a.ROLE = 2 AND a.KODE_USER IN (SELECT KODE_USER FROM bidang_juri WHERE ID_BIDANG IN (SELECT ID_BIDANG FROM bidang_lomba))");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}
	function get_bidangJuri($kode_user){
		$this->db->select('a.ID, a.ID_BIDANG, b.BIDANG_LOMBA');
		$this->db->from('bidang_juri a');
		$this->db->join('bidang_lomba b', 'a.ID_BIDANG = b.ID_BIDANG');
		$query = $this->db->get_where('bidang_juri', array('a.KODE_USER' => $kode_user));
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function cek_kodeUser($kode_user){
		$kode_user 	= $this->db->escape($kode_user);
		$query 		= $this->db->query("SELECT * FROM tb_auth WHERE KODE_USER = $kode_user");
		return $query->num_rows();
	}

	public function del_user($kode_user){
		$kode_user 			= $this->db->escape($kode_user);
		$this->db->where('KODE_USER', $kode_user);
		$this->db->delete('tb_auth');
	}

	function tambah_juri($KODE_USER, $file){
		$NAMA_JURI 		= htmlspecialchars($this->input->post('NAMA_JURI'), true);
		$PEKERJAAN 		= htmlspecialchars($this->input->post('PEKERJAAN'), true);
		$EMAIL 			= htmlspecialchars($this->input->post('EMAIL'), true);
		$HP 			= htmlspecialchars($this->input->post('HP'), true);
		$PASSWORD 		= htmlspecialchars($this->input->post('PASSWORD'), true);
		$BIDANG_JURI 	= htmlspecialchars($this->input->post('BIDANG_JURI'), true);

		$data = array(
			'KODE_USER'		=> $KODE_USER,
			'EMAIL'			=> $EMAIL,
			'PASSWORD'		=> password_hash($PASSWORD, PASSWORD_DEFAULT),
			'ROLE'			=> 2,
		);
		$this->db->insert('tb_auth', $data);

		if ($this->db->affected_rows() == true) {

			$peserta = array(
				'KODE_USER' 		=> $KODE_USER,
				'PROFIL'  			=> $file,
				'NAMA'  			=> $NAMA_JURI,
				'HP' 				=> $HP,
			);

			$this->db->insert('tb_peserta', $peserta);

			if ($this->db->affected_rows() == true) {

				$bidang = array(
					'KODE_USER' 		=> $KODE_USER,
					'ID_BIDANG'  		=> $BIDANG_JURI,
					'PEKERJAAN'  			=> $PEKERJAAN,
				);

				$this->db->insert('bidang_juri', $bidang);
				return ($this->db->affected_rows() != 1) ? false : true;

			}else{
				$this->del_user($KODE_USER);
				return false;
			}
			
		}else{
			$this->del_user($KODE_USER);
			return false;
		}
	}

	function edit_juri($file){
		$ID 			= htmlspecialchars($this->input->post('ID'), true);
		$KODE_USER 		= htmlspecialchars($this->input->post('KODE_USER'), true);

		$NAMA_JURI 		= htmlspecialchars($this->input->post('NAMA_JURI'), true);
		$PEKERJAAN 		= htmlspecialchars($this->input->post('PEKERJAAN'), true);
		$EMAIL 			= htmlspecialchars($this->input->post('EMAIL'), true);
		$HP 			= htmlspecialchars($this->input->post('HP'), true);
		$PASSWORD 		= htmlspecialchars($this->input->post('PASSWORD'), true);
		$BIDANG_JURI 	= htmlspecialchars($this->input->post('BIDANG_JURI'), true);


		$data = array(
			'EMAIL'			=> $EMAIL,
			'PASSWORD'		=> password_hash($PASSWORD, PASSWORD_DEFAULT),
		);

		$this->db->where('KODE_USER', $KODE_USER);
		$this->db->update('tb_auth', $data);

		$peserta = array(
			'NAMA'  			=> $NAMA_JURI,
			'PROFIL'  			=> $file,
			'HP' 				=> $HP,
		);

		$this->db->where('KODE_USER', $KODE_USER);
		$this->db->update('tb_peserta', $peserta);

		$bidang = array(
			'ID_BIDANG'  		=> $BIDANG_JURI,
			'PEKERJAAN'  			=> $PEKERJAAN,
		);

		$this->db->where('ID', $ID);
		$this->db->update('bidang_juri', $bidang);
		return true;
	}

	function hapus_juri(){
		$ID 			= $this->input->post('ID');
		$KODE_USER 		= $this->input->post('KODE_USER');

		$this->db->where('ID', $ID);
		$this->db->delete('bidang_juri');

		$this->db->where('KODE_USER', $KODE_USER);
		$this->db->delete('tb_auth');
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	//TAHAP PENILAIAN
	function get_tahapPenilaian(){
		$query	= $this->db->get('tahap_penilaian');
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	function tambah_tahap(){
		$NAMA_TAHAP 		= htmlspecialchars($this->input->post('NAMA_TAHAP'), true);
		$KETERANGAN 		= htmlspecialchars($this->input->post('KETERANGAN'), true);
		$TANGGAL_MULAI 		= htmlspecialchars($this->input->post('TANGGAL_MULAI'), true);
		$WAKTU_MULAI 		= htmlspecialchars($this->input->post('WAKTU_MULAI'), true);
		$TANGGAL_BERAKHIR 	= htmlspecialchars($this->input->post('TANGGAL_BERAKHIR'), true);
		$WAKTU_BERAKHIR 	= htmlspecialchars($this->input->post('WAKTU_BERAKHIR'), true);
		$TEAM 				= htmlspecialchars($this->input->post('TEAM'), true);

		$data = array(
			'NAMA_TAHAP'		=> $NAMA_TAHAP,
			'KETERANGAN'		=> $KETERANGAN,
			'DATE_START'		=> $TANGGAL_MULAI,
			'TIME_START'		=> $WAKTU_MULAI,
			'DATE_END'			=> $TANGGAL_BERAKHIR,
			'TIME_END'			=> $WAKTU_BERAKHIR,
			'TEAM'				=> $TEAM,
		);
		$this->db->insert('tahap_penilaian', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function edit_tahap(){
		$ID_TAHAP 			= $this->input->post('ID_TAHAP');

		$NAMA_TAHAP 		= htmlspecialchars($this->input->post('NAMA_TAHAP'), true);
		$KETERANGAN 		= htmlspecialchars($this->input->post('KETERANGAN'), true);
		$TANGGAL_MULAI 		= htmlspecialchars($this->input->post('TANGGAL_MULAI'), true);
		$WAKTU_MULAI 		= htmlspecialchars($this->input->post('WAKTU_MULAI'), true);
		$TANGGAL_BERAKHIR 	= htmlspecialchars($this->input->post('TANGGAL_BERAKHIR'), true);
		$WAKTU_BERAKHIR 	= htmlspecialchars($this->input->post('WAKTU_BERAKHIR'), true);
		$TEAM 				= htmlspecialchars($this->input->post('TEAM'), true);

		$data = array(
			'NAMA_TAHAP'		=> $NAMA_TAHAP,
			'KETERANGAN'		=> $KETERANGAN,
			'DATE_START'		=> $TANGGAL_MULAI,
			'TIME_START'		=> $WAKTU_MULAI,
			'DATE_END'			=> $TANGGAL_BERAKHIR,
			'TIME_END'			=> $WAKTU_BERAKHIR,
			'TEAM'				=> $TEAM,
		);

		$this->db->where('ID_TAHAP', $ID_TAHAP);
		$this->db->update('tahap_penilaian', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function hapus_tahap(){
		$ID_TAHAP 		= $this->input->post('ID_TAHAP');

		$this->db->where('ID_TAHAP', $ID_TAHAP);
		$this->db->delete('tahap_penilaian');
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	//KRITERIA PENILAIAN

	function cek_kriteriaAtur($id_tahap, $id_bidang){
		return $this->db->get_where('kriteria_penilaian', array('ID_TAHAP' => $id_tahap, 'ID_BIDANG' => $id_bidang))->num_rows();
	}

	function get_kriteriaPenilaian($id_tahap, $id_bidang){
		$query	= $this->db->get_where('kriteria_penilaian', array('ID_TAHAP' => $id_tahap, 'ID_BIDANG' => $id_bidang));
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}
	function get_bidangKriteria($id_tahap){
		$query	= $this->db->get_where('bidang_lomba', array('KODE_KOMPETISI' => $kode_kompetisi));
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	function tambah_kriteria($id_tahap, $id_bidang){
		$KRITERIA 		= $this->input->post('KRITERIA', true);
		$BOBOT 			= $this->input->post('BOBOT', true);
		$KETERANGAN 	= $this->input->post('KETERANGAN', true);

		if (!empty($KRITERIA) && isset($KRITERIA)) {
			foreach ($KRITERIA as $i => $a) {
				$data = array(
					'ID_TAHAP'		=> isset($KRITERIA[$i]) ? $id_tahap : '',
					'ID_BIDANG' 	=> isset($KRITERIA[$i]) ? $id_bidang : '',
					'KRITERIA'		=> isset($KRITERIA[$i]) ? $KRITERIA[$i] : '',
					'BOBOT'			=> isset($BOBOT[$i]) ? $BOBOT[$i] : '',
					'KETERANGAN'	=> isset($KETERANGAN[$i]) ? $KETERANGAN[$i] : '',
				);
				$this->db->insert('kriteria_penilaian', $data);
			}
			return ($this->db->affected_rows() != 1) ? false : true;
		}else{
			return false;
		}
	}

	function edit_kriteria(){
		$ID_KRITERIA 		= $this->input->post('ID_KRITERIA');

		$KRITERIA 		= htmlspecialchars($this->input->post('KRITERIA'), true);
		$BOBOT 			= htmlspecialchars($this->input->post('BOBOT'), true);
		$KETERANGAN 	= htmlspecialchars($this->input->post('KETERANGAN'), true);

		$data = array(
			'KRITERIA'		=> $KRITERIA,
			'BOBOT'			=> $BOBOT,
			'KETERANGAN'	=> $KETERANGAN,
		);

		$this->db->where('ID_KRITERIA', $ID_KRITERIA);
		$this->db->update('kriteria_penilaian', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function hapus_kriteria(){
		$ID_KRITERIA 		= $this->input->post('ID_KRITERIA');

		$this->db->where('ID_KRITERIA', $ID_KRITERIA);
		$this->db->delete('kriteria_penilaian');
		return ($this->db->affected_rows() != 1) ? false : true;

	}

	// FORMULIR

	function cek_form(){
		$query = $this->db->get_where("form_meta", array('KODE' => 'lokreatif'));
		if ($query->num_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function get_dataPendaftaran(){
		$this->db->select("a.*, b.NAMA");
		$this->db->from("pendaftaran_kompetisi a");
		$this->db->join("tb_peserta b", "a.KODE_USER = b.KODE_USER");
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	function get_form(){
		$query = $this->db->get_where("form_meta", array('KODE' => 'lokreatif'));
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	function get_formItem($kode){
		$query = $this->db->get_where("form_item", array('ID_FORM' => $kode));
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	function get_formData($kode, $id){
		$query = $this->db->get_where("pendaftaran_data", array('KODE_PENDAFTARAN' => $kode, 'ID_FORM' => $id));
		if ($query->num_rows() > 0) {
			return $query->row()->JAWABAN;
		}else{
			return false;
		}
	}

	function get_formBerkas(){
		$query = $this->db->get_where("form_meta", array('KODE' => 'lokreatif', 'TYPE' => 'FILE'));
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	// function get_formDataBerkas($kode, $id){
	// 	$query = $this->db->get_where("pendaftaran_data", array('KODE_PENDAFTARAN' => $kode, 'ID_FORM' => $id));
	// 	if ($query->num_rows() > 0) {
	// 		return $query->row()->JAWABAN;
	// 	}else{
	// 		return false;
	// 	}
	// }

	// PROSES

	function proses_aturPendaftaran(){

		$PERTANYAAN   = $this->input->post('PERTANYAAN', true);
		$TYPE         = $this->input->post('TIPE', true);
		$REQUIRED     = $this->input->post('REQUIRED');
		$KETERANGAN   = $this->input->post('KETERANGAN', true);
		$FILE_SIZE    = $this->input->post('FILE_SIZE', true);
		$FILE_TYPE    = $this->input->post('FILE_TYPE', true);
		$ITEM         = $this->input->post('ITEM', true);
		$ITEM_SPLIT   = $this->input->post('ITEM_SPLIT', true);

		$ct = 0;

		foreach ($PERTANYAAN as $i => $a) {
			$data = array(
				'KEGIATAN'      => 2, //1. KEGIATAN, 2. KOMPETISI
				'KODE'          => 'lokreatif',
				'PERTANYAAN'    => isset($PERTANYAAN[$i]) ? $PERTANYAAN[$i] : null,
				'TYPE'          => isset($TYPE[$i]) ? $TYPE[$i] : null,
				'REQUIRED'      => isset($REQUIRED[$i]) ? ($REQUIRED[$i] == TRUE ? 1 : 0) : 0,
				'KETERANGAN'    => isset($KETERANGAN[$i]) ? $KETERANGAN[$i] : null,
				'FILE_SIZE'     => isset($FILE_SIZE[$i]) ? $FILE_SIZE[$i] : null,
				'FILE_TYPE'     => isset($FILE_TYPE[$i]) ? $FILE_TYPE[$i] : null,
			);
			$this->db->insert('form_meta', $data);
			$cek    = ($this->db->affected_rows() != 1) ? false : true;

			if ($TYPE[$i] == "RADIO" || $TYPE[$i] == "CHECK" || $TYPE[$i] == "SELECT" && $cek == true) {
				$ID_FORM  = $this->db->insert_id();

				if ($this->input->post('ITEM')) {
					echo var_dump($ITEM_SPLIT);

					for($c=1; $c <= $ITEM_SPLIT[$i]; $c++) {

						$data = array(
							'ID_FORM'     => $ID_FORM,
							'ITEM'        => isset($ITEM[$ct]) ? $ITEM[$ct] : null,
						);
						$this->db->insert('form_item', $data);
						$ct++;
					}
				}
			}

			if ($cek == false) {        
				$this->db->where('KODE', $kode);
				$this->db->delete('form_meta');
				break;
				return false;
			}
		}
		return true;
	}


	function proses_deletePendaftaran(){
		$this->db->where('KODE', 'lokreatif');
		$this->db->delete('form_meta');
		return true;
	}

}
