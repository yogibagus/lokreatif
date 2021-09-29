<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Juri extends MX_Controller {
	public function __construct(){
		parent::__construct();
		if ($this->agent->is_mobile()) {
			$this->session->set_flashdata('error', "Halaman penjurian hanya dapat diakses melalui dekstop browser");
			redirect(base_url());
		}
		if ($this->session->userdata('logged_in') == FALSE || !$this->session->userdata('logged_in')){
			if (!empty($_SERVER['QUERY_STRING'])) {
				$uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
			} else {
				$uri = uri_string();
			}
			$this->session->set_userdata('redirect', $uri);
			$this->session->set_flashdata('error', "Harap login ke akun anda, untuk melanjutkan");
			redirect('login');
		}
		if ($this->session->userdata("role") != 2) {
			$this->session->set_flashdata('error', "Mohon maaf hak akses anda bukan juri");
			redirect(base_url());
		}
		$this->load->model('M_juri');
		$this->load->model('General');
	}

	function get_karyaTim($kode){
		$karya = $this->M_juri->get_karyaTim($kode);
		if ($karya == false || empty($karya->FILE)) {
			$this->load->view('ajax/karya_404');
		}else{
			$data['berkas']	= $karya;
			$this->load->view('ajax/karya_tim', $data);
		}
	}

	function bidang_juri($param = 1){

		$juri = $this->M_juri->get_dataJuri($this->session->userdata('kode_user'));

		switch ($param) {

			// GET ID BIDANG LOMBA JURI
			case 1:
			return $juri->ID_BIDANG;
			break;

			// GET NAMA BIDANG LOMBA JURI
			case 2:
			return $juri->BIDANG_LOMBA;
			break;
			
			default:
			return "Terjadi Masalah, saat mengambil data juri!!";
			break;
		}
	}

	function tahap_aktif($param = 1){

		$tahap = $this->M_juri->get_tahapPenilaian();
		if ($tahap != false) {
			switch ($param) {

				// GET ID TAHAP AKIF
				case 1:
				return $tahap->ID_TAHAP;
				break;

				// GET NAMA TAHAP AKIF
				case 2:
				return $tahap->NAMA_TAHAP;
				break;
				
				default:
				return "Terjadi Masalah, saat mengambil tahap aktif!!";
				break;
			}
		}else{
			return 0;
		}
	}

	public function index(){
		$data['tahap']			= $this->M_juri->get_tahapPenilaian();
		$data['tim']			= $this->M_juri->get_countTIM($this->tahap_aktif(1), $this->bidang_juri(1));
		$data['nilai_tim']		= $this->M_juri->get_timJuri($this->tahap_aktif(1), $this->bidang_juri(1));
		$data['pedoman']		= $this->M_juri->get_pedoman();
		$data['CI']				= $this;

		$data['module'] 		= "juri";
		$data['fileview'] 		= "dashboard";
		echo Modules::run('template/backend_main', $data);
	}

	public function penilaian(){
		if ($this->agent->is_mobile()) {
			$this->session->set_flashdata('warning', "Penilaian hanya dapat dilakukan melalui dekstop browser");
			redirect(base_url());
		}else{
			$data['tahap']			= $this->M_juri->get_tahapPenilaian();
			$data['dataKriteria']   = $this->M_juri->get_kriteriaPenilaian($this->tahap_aktif(1), $this->bidang_juri(1));
			$data['tim']			= $this->M_juri->get_countTIM($this->tahap_aktif(1), $this->bidang_juri(1));
			$data['daftar_tim']		= $this->M_juri->get_dataTIM($this->tahap_aktif(1), $this->bidang_juri(1));
			$data['bidang_juri']    = $this->tahap_aktif(2);

			$data['CI']				= $this;

			$data['module'] 		= "juri";
			$data['fileview'] 		= "penilaian";
			echo Modules::run('template/backend_main', $data);
		}
	}

	// PROSES

	function submit_nilai(){
		if ($this->M_juri->submit_nilai($this->tahap_aktif(1), $this->session->userdata('kode_user')) == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengirim data nilai anda !!");
			redirect(site_url('juri/penilaian'));
		} else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengirim data nilai anda!!");
			redirect($this->agent->referrer());
		}
	}

}?>
