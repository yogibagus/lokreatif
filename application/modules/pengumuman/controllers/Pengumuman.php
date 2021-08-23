<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_pengumuman');

	}

	public function index(){

		$data['CI']			= $this;

		$data['module'] 	= "pengumuman";
		$data['fileview'] 	= "pengumuman_list";
		echo Modules::run('template/frontend_main', $data);
	}

	public function artikel($id){

		$data['module'] 	= "pengumuman";
		$data['fileview'] 	= "pengumuman_detail";
		echo Modules::run('template/frontend_main', $data);
	}
}
