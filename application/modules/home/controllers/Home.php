<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('M_home');

	}

	// Home page

	public function index(){
		$data['kegiatan']			= $this->M_home->get_kegiatanAll();
		$data['bidangLomba']		= $this->M_home->get_bidangLomba();
		
		$data['CI']			= $this;

		$data['module'] 	= "home";
		$data['fileview'] 	= "home";
		echo Modules::run('template/frontend_main', $data);
	}

	public function bidang_lomba(){
		$data['bidangLomba']		= $this->M_home->get_bidangLomba();
		$data['tahapPenilaian']		= $this->M_home->get_tahapPenilaian();
		
		$data['CI']			= $this;

		$data['module'] 	= "home";
		$data['fileview'] 	= "bidang_lomba";
		echo Modules::run('template/frontend_main', $data);
	}

	public function tentang_juri(){
		
		$data['CI']			= $this;

		$data['module'] 	= "home";
		$data['fileview'] 	= "tentang_juri";
		echo Modules::run('template/frontend_main', $data);
	}
}
