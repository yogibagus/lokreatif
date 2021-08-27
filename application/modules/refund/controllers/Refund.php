<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refund extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_refund');
		$this->load->library(['Transaksi']);

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
	}

	public function index(){

			if ($this->General->get_dataRefund($this->session->userdata("kode_user")) != false) {
				$dataPeserta 			= $this->General->get_detailDaftarKompetisi($this->session->userdata("kode_user"));
				$dataRefund 			= $this->General->get_dataRefund($this->session->userdata("kode_user"));
				$data['dataPendaftaran']= $dataPeserta;
				$data['dataRefund']		= $dataRefund;
	            $data['biayaRefund']    = $this->General->count_jmlRefund($dataRefund->KODE_TRANS);
	            $data['tim']        	= $this->General->get_tim($dataRefund->KODE_TRANS);

				$data['CI']				= $this;

				$data['module'] 		= "refund";
				$data['fileview'] 		= "refund";
				if ($this->session->userdata('role') == 1) {
					echo Modules::run('template/frontend_user', $data);
				}else{
					echo Modules::run('template/backend_main', $data);
				}
			}else{
				$this->session->set_flashdata('error', "Anda tidak memiliki satu pun data transaksi !!");
				redirect($this->agent->referrer());
			}
	}

	function atur_via(){

		if ($this->M_refund->atur_via() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengatur data VIA untuk proses refund anda !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengatur data VIA untuk proses refund anda !!");
			redirect($this->agent->referrer());
		}
	}


}?>
