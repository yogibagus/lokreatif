<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_refund extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function cek_daftarKompetisi($kode_user){
		$query = $this->db->get_where("pendaftaran_kompetisi", array('KODE_USER' => $kode_user));
		return $query->num_rows();
	}

	function atur_via(){
		$KODE_REFUND 	= $this->input->post('KODE_REFUND');
		$JML_REFUND 	= $this->input->post('JML_REFUND');
		$METHOD 		= $this->input->post('METHOD');
		$VIA 			= $this->input->post('VIA');
		$AN_VIA 		= $this->input->post('AN_VIA');
		$NO_VIA			= $this->input->post('NO_VIA');

		$data = array(
			'JML_REFUND' 	=> $JML_REFUND,
			'METHOD' 			=> $METHOD,
			'VIA' 			=> $VIA,
			'AN_VIA' 		=> $AN_VIA,
			'NO_VIA' 		=> $NO_VIA,
			'STAT_REFUND'	=> 1
		);

		$this->db->where('KODE_REFUND', $KODE_REFUND);
		$this->db->update('tb_refund', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
}
