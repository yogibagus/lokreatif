<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_handlers extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function log_aktivitasKpanel($KODE_PENYELENGGARA, $KODE_USER, $TYPE, $GROUP){
		$data = array(
			'RECEIVER' 	 	=> $KODE_PENYELENGGARA,
			'SENDER' 		=> $KODE_USER,
			'TYPE'	 		=> $TYPE,
			'RECEIVER_GROUP'=> $GROUP,
		);
		$this->db->insert('log_aktivitas', $data);
	}

	public function get_kegiatanData($kode){
		$query = $this->db->get_where('tb_kegiatan', array('KODE_KEGIATAN' => $kode));
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
		
	}
}
