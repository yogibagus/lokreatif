<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilities extends MX_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('M_utilities', 'M_uti');

	}

	// Util Page

	public function e_404(){

		$data['module'] 		= "utilities";
		$data['fileview'] 	= "404";
		echo Modules::run('template/frontend_util', $data);
	}

	public function maintenance(){

		$data['module'] 		= "utilities";
		$data['fileview'] 	= "maintenance";
		echo Modules::run('template/frontend_util', $data);
	}

	public function statistik(){
		$data['jmlPesertaVerif'] 	 = $this->M_uti->get_jmlPesertaVerif();
		$data['jmlPesertaBelum'] 	 = $this->M_uti->get_jmlPesertaBelum();
		$data['jmlPeserta'] 	 	 = $this->M_uti->get_jmlPeserta();
		$data['listPTDetail'] 	 	 = $this->M_uti->get_listPTDetail();
		$data['jmlPesertaPerLomba']	 = array();
		$data['jmlVerifPerLomba']	 = array();
		$data['jmlBelumPerLomba']	 = array();
		$data['jmlTolakPerLomba']	 = array();
		$data['bidangLomba']		 = array();
		$data['posterLomba']	 	 = array();

		$bidangLomba = $this->M_uti->get_bidangLomba();
		foreach ($bidangLomba as $item) {
			$data['bidangLomba'][] 	= '"'.$item->BIDANG_LOMBA.'"';
			$data['posterLomba'][]	= $item->POSTER != null ? '"'.base_url('berkas/kompetisi/bidang-lomba/'.$item->POSTER).'"' : '"'.base_url('assets/frontend/svg/illustrations/discussion-scene.svg').'"';
			
			$detailTotal = $this->M_uti->get_pesertaLombaDetail($item->ID_BIDANG);
			$data['jmlPesertaPerLomba'][]	= $detailTotal['TOTAL_PESERTA'];
			$data['jmlVerifPerLomba'][]		= $detailTotal['JML_VERIF'];
			$data['jmlBelumPerLomba'][]		= $detailTotal['JML_BELUM'];
			$data['jmlTolakPerLomba'][]		= $detailTotal['JML_TOLAK'];
		}

		$data['module'] 	= "utilities";
		$data['fileview'] 	= "statistik";
		echo Modules::run('template/frontend_main', $data);
	}

	public function jadwal(){

		$data['module'] 	= "utilities";
		$data['fileview'] 	= "jadwal";
		echo Modules::run('template/frontend_main', $data);
	}

	public function coming_soon(){

		$data['module'] 		= "utilities";
		$data['fileview'] 	= "coming-soon";
		echo Modules::run('template/frontend_util', $data);
	}

	// Company page

	public function about(){

		$data['c_penyelenggara']	= $this->M_uti->c_penyelenggara();
		$data['c_peserta']			= $this->M_uti->c_peserta();
		$data['c_kegiatan']			= $this->M_uti->c_kegiatan();

		$data['module'] 	= "utilities";
		$data['fileview'] 	= "about";
		echo Modules::run('template/frontend_main', $data);
	}

	public function contact(){

		$data['module'] 		= "utilities";
		$data['fileview'] 	= "contact";
		echo Modules::run('template/frontend_main', $data);
	}

	public function bantuan(){

		$data['module'] 		= "utilities";
		$data['fileview'] 	= "bantuan";
		echo Modules::run('template/frontend_main', $data);
	}

	public function unduhan(){
		$data['unduhan']	= $this->M_uti->get_unduhanList();

		$data['module'] 	= "utilities";
		$data['fileview'] 	= "unduhan";
		echo Modules::run('template/frontend_main', $data);
	}

	public function unduh($berkas, $link){
		$link = base_url()."berkas/kebutuhan/".$link;
		$this->load->helper('download');
		force_download($berkas, $link);
	}

	public function package(){

		$data['module'] 		= "utilities";
		$data['fileview'] 	= "package";
		echo Modules::run('template/frontend_main', $data);
	}

	public function hireus(){

		$data['module'] 		= "utilities";
		$data['fileview'] 	= "hire-us";
		echo Modules::run('template/frontend_main', $data);
	}

	public function careers(){

		$data['module'] 		= "utilities";
		$data['fileview'] 	= "careers";
		echo Modules::run('template/frontend_main', $data);
	}

	public function careers_detail($id){

		$data['module'] 		= "utilities";
		$data['fileview'] 	= "career_detail";
		echo Modules::run('template/frontend_main', $data);
	}


	// Policy page

	public function privacy(){

		$data['module'] 		= "utilities";
		$data['fileview'] 	= "privacy";
		echo Modules::run('template/frontend_main', $data);
	}

	public function term(){

		$data['module'] 		= "utilities";
		$data['fileview'] 	= "term";
		echo Modules::run('template/frontend_main', $data);
	}

}

?>
