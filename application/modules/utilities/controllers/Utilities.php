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
		$data['jmlMhs'] = $this->M_uti->get_countMhs();
		$data['jmlTim'] = $this->M_uti->get_countTim();
		$data['jmlPTS'] = count($this->M_uti->get_countPTS());

		$timKategori 					= $this->M_uti->get_timKategori();
		$data['timKategori']['lomba'] 	= array();
		$data['timKategori']['jmlTim'] 	= array();
		foreach ($timKategori as $item) {
			$data['timKategori']['lomba'][]  = "'".$item->BIDANG_LOMBA."'";
			$data['timKategori']['jmlTim'][] = $item->JML_TIM;
		}

		$timLLDIKTI 					= $this->M_uti->get_timLLDIKTI();
		$data['timLLDIKTI']['lldikti']	= array();
		$data['timLLDIKTI']['jmlTim'] 	= array();
		foreach ($timLLDIKTI as $item) {
			$data['timLLDIKTI']['lldikti'][]  = "'".$item->kopertis."'";
			$data['timLLDIKTI']['jmlTim'][]	  = $item->JML_TIM;
		}
		
		$data['timPTS'] 	= $this->M_uti->get_timPTS();
		$data['detStatTim'] = $this->M_uti->get_detStatTim();

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
