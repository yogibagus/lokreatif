<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_kegiatan');

	}

	public function index(){
		$this->load->library('pagination');

		$config['base_url'] 				= base_url().'kegiatan';
		$config['total_rows'] 				= $this->M_kegiatan->count_kegiatan();
		$config['per_page'] 				= 5;

		$config['full_tag_open'] 			= '<nav class="d-flex justify-content-between align-items-center" aria-label="Page navigation example"><ul class="pagination justify-content-center pagination-sm">';
		$config['full_tag_close'] 			= '</ul></nav>';

		$config['next_link'] 				= '&raquo';
		$config['next_tag_open'] 			= '<li class="page-item">';
		$config['next_tag_close'] 			= '</li>';

		$config['prev_link'] 				= '&laquo';
		$config['prev_tag_open'] 			= '<li class="page-item">';
		$config['prev_tag_close'] 			= '</li>';

		$config['cur_tag_open'] 			= '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] 			= '<span class="sr-only">(current)</span></a></li>';

		$config['num_tag_open'] 			= '<li class="page-item">';
		$config['num_tag_close'] 			= '</li>';

		$config['attributes']				= array('class' => 'page-link');

		$this->pagination->initialize($config);

		$data['kegiatan']	= $this->M_kegiatan->get_kegiatanAll($config['per_page'], (!$this->uri->segment(2) ? 0 : $this->uri->segment(2)));
		$data['CI']			= $this;

		$data['module'] 	= "kegiatan";
		$data['fileview'] 	= "kegiatan";
		echo Modules::run('template/frontend_main', $data);
	}

	public function kegiatan_detail($id){

		if ($this->M_kegiatan->get_kegiatanDetail($id) == FALSE) {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menampilkan detail kegiatan tersebut !!");
			redirect($this->agent->referrer());
		}else{

			$data['daftar']		= $this->M_kegiatan->cek_dataPeserta($this->session->userdata('kode_user'), $id);
			$data['kegiatan']	= $this->M_kegiatan->get_kegiatanDetail($id);

			$data['tiket']		= $this->M_kegiatan->get_tiketKegiatan($id);
			$data['sosmed']		= $this->M_kegiatan->get_sosmedKegiatan($id);
			$data['contact']	= $this->M_kegiatan->get_contactKegiatan($id);
			$data['CI']			= $this;

			$data['module'] 	= "kegiatan";
			$data['fileview'] 	= "kegiatan_detail";
			echo Modules::run('template/frontend_main', $data);
		}
	}

}?>
