<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_juri extends CI_Model {
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

	function get_dataJuri($KODE_USER){
		$this->db->select('*');
		$this->db->from('tb_auth a');
		$this->db->join('tb_peserta b', 'a.KODE_USER = b.KODE_USER');
		$this->db->join('bidang_juri c', 'a.KODE_USER = c.KODE_USER');
		$this->db->join('bidang_lomba d', 'c.ID_BIDANG = d.ID_BIDANG');
		$this->db->where('a.KODE_USER', $KODE_USER);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	function get_pedoman(){
		$query = $this->db->query("SELECT * FROM berkas_kebutuhan WHERE JUDUL LIKE '%Pedoman%'");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}

	}

	function get_tahapPenilaian(){
		$now = date("Y-m-d");
		$query = $this->db->query("SELECT * FROM tahap_penilaian WHERE STATUS = 1 AND '$now' BETWEEN DATE_START AND DATE_END");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}

	}

	function get_countTIM($id_tahap, $id_bidang){
		return $this->db->query("SELECT count(*) as semua, (SELECT count(*) FROM pendaftaran_kompetisi WHERE BIDANG_LOMBA = '$id_bidang' AND KODE_PENDAFTARAN IN (SELECT KODE_PENDAFTARAN FROM tb_penilaian)) as sudah_nilai FROM pendaftaran_kompetisi WHERE BIDANG_LOMBA = '$id_bidang' AND STATUS_SELEKSI = {$id_tahap}")->row();
	}

	function get_dataTIM($id_tahap, $id_bidang){
		$query = $this->db->query("SELECT * FROM pendaftaran_kompetisi a JOIN tb_karya b ON a.KODE_PENDAFTARAN = b.KODE_PENDAFTARAN WHERE a.KODE_PENDAFTARAN NOT IN (SELECT KODE_PENDAFTARAN FROM tb_penilaian) AND a.BIDANG_LOMBA = {$id_bidang} AND a.STATUS_SELEKSI = {$id_tahap}");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	function get_timJuri($id_tahap, $id_bidang){
		$query = $this->db->query("SELECT * FROM pendaftaran_kompetisi a LEFT JOIN tb_penilaian b ON a.KODE_PENDAFTARAN = b.KODE_PENDAFTARAN JOIN pt c ON a.ASAL_PTS = c.kodept WHERE a.BIDANG_LOMBA = {$id_bidang} AND a.STATUS_SELEKSI = {$id_tahap}");
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	function get_karyaTim($KODE_PENDAFTARAN){
		$this->db->select('*');
		$this->db->from('pendaftaran_kompetisi a');
		$this->db->join('tb_karya b', 'a.KODE_PENDAFTARAN = b.KODE_PENDAFTARAN');
		$this->db->join('bidang_lomba c', 'a.BIDANG_LOMBA = c.ID_BIDANG');
		$this->db->where('a.KODE_PENDAFTARAN', $KODE_PENDAFTARAN);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function get_kriteriaPenilaian($id_tahap, $id_bidang){
		$this->db->select('*');
		$this->db->where(array('ID_TAHAP' => $id_tahap, 'ID_BIDANG' => $id_bidang));
		$query = $this->db->get('kriteria_penilaian');

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}

	}

	function submit_nilai($id_tahap, $kode_juri){
		if($this->input->post('ID_KRITERIA')){

			$KODE_PENDAFTARAN 	= $this->input->post('KODE_PENDAFTARAN', true);
			$ID_KRITERIA 		= $this->input->post('ID_KRITERIA', true);
			$BOBOT 				= $this->input->post('BOBOT', true);
			$NILAI 				= $this->input->post('NILAI', true);

			foreach ($ID_KRITERIA as $i => $a) {

				$data = array(
					'ID_TAHAP'  		=> $id_tahap,
					'KODE_JURI'  		=> $kode_juri,
					'KODE_PENDAFTARAN'  => $KODE_PENDAFTARAN,
					'ID_KRITERIA'  		=> isset($ID_KRITERIA[$i]) ? $ID_KRITERIA[$i] : '',
					'NILAI'  			=> number_format(isset($NILAI[$i]) ? $NILAI[$i] : '',2)
  				);
				$this->db->insert('tb_penilaian',$data);
				if ((($this->db->affected_rows() != 1) ? false : true) == false) {
					return false;
					$this->db->where('KODE_PENDAFTARAN', $KODE_PENDAFTARAN);
					$this->db->delete('tb_penilaian');
					break;
				}
			}
			return ($this->db->affected_rows() != 1) ? false : true;
		}
	}
}
