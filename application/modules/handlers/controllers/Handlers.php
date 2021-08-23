<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Handlers extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_handlers');

	}

// SAVE LOG
// 1. LOGIN
// 2. DAFTAR
// 3. AKTIVASI
// 4. RECOVERY

// RECEIVER GROUP
// 1. PRIVATE
// 2. ADMIN
// 4. KEGIATAN

	function akses_kegiatan($kode){

		if ($this->session->userdata('logged_in') == FALSE || !$this->session->userdata('logged_in')){
			if (!empty($_SERVER['QUERY_STRING'])) {
				$uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
			} else {
				$uri = uri_string();
			}
			$this->session->set_userdata('redirect', $uri);
			$this->session->set_flashdata('error', "Harap login ke akun anda, untuk melanjutkan");
			redirect('login');
		}else{

			$data = $this->M_handlers->get_kegiatanData($kode);

			$sessiondata = array(
				'manage_kegiatan'     	=> $data->KODE_KEGIATAN,
				'manage_namaKegiatan'   => $data->JUDUL,
				'mstatus_kegiatan'      => TRUE
			);

			$this->session->set_userdata($sessiondata);

				// SAVE LOG K-Panel
			$this->M_handlers->log_aktivitasKpanel($kode, $this->session->userdata("kode_user"), 12, 4);

			$this->session->set_flashdata('success', "Selamat datang, ".$this->session->userdata("nama")." di panel kegiatanmu");
			redirect('manage-kegiatan');

		}
	}

}
