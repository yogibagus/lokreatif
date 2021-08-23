<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {
	public function __construct(){
		parent::__construct();
		if ($this->agent->is_mobile()) {
			$this->session->set_flashdata('error', "ADMIN PANEL HANYA DAPAT DIAKSES MELALUI BROWSER");
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
		if ($this->session->userdata("role") != 0) {
			$this->session->set_flashdata('error', "Mohon maaf hak akses anda bukan admin");
			redirect('peserta');
		}
		$this->load->model('M_admin');

	}

	function time_elapsed($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'min',
			's' => 'sec',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}

	public function index(){
		$data['peserta']		  		= $this->M_admin->countPeserta();
		$data['diffPeserta']		  	= $this->M_admin->countDiffPeserta();
		$data['countKegiatan']			= $this->M_admin->countKegiatan();
		$data['diffKegiatan']			= $this->M_admin->countDiffKegiatan();
		$data['newKegiatan']			= $this->M_admin->countNewKegiatan();
		$data['CI']						= $this;

		$data['kegiatan']				= $this->M_admin->get_kegiatanAllD();
		$data['kompetisi']				= $this->M_admin->get_kompetisiAllD();

		$data['module'] 		= "admin";
		$data['fileview'] 		= "dashboard";
		echo Modules::run('template/backend_main', $data);
	}

	// DATA PENGATURAN
	public function pengaturan(){

		$data['module'] 	= "admin";
		$data['fileview'] 	= "pengaturan/pengaturan";
		echo Modules::run('template/backend_main', $data);
	}
	public function pengaturan_akunAdmin(){

		// MAILER
		$data['SMPT_GMAIL']		= $this->M_admin->get_mailerSmpt();
		$data['EM_HOST']		= $this->M_admin->get_mailerHost();
		$data['EM_USERNAME']	= $this->M_admin->get_mailerUsername();
		$data['EM_PASSWORD']	= $this->M_admin->get_mailerPassword();

		$data['module'] 	= "admin";
		$data['fileview'] 	= "pengaturan/akun_admin";
		echo Modules::run('template/backend_main', $data);
	}
	public function pengaturan_sistem(){

		// MAILER
		$data['SMPT_GMAIL']		= $this->M_admin->get_mailerSmpt();
		$data['EM_HOST']		= $this->M_admin->get_mailerHost();
		$data['EM_USERNAME']	= $this->M_admin->get_mailerUsername();
		$data['EM_PASSWORD']	= $this->M_admin->get_mailerPassword();

		$data['module'] 	= "admin";
		$data['fileview'] 	= "pengaturan/sistem";
		echo Modules::run('template/backend_main', $data);
	}
	public function pengaturan_website(){

		// MEGA MENU PENYELENGGARA
		$data['CI']					= $this;

		$data['module'] 	= "admin";
		$data['fileview'] 	= "pengaturan/website";
		echo Modules::run('template/backend_main', $data);
	}

	// DATA PENGGUNA
	public function data_peserta(){
		$data['peserta']				= $this->M_admin->get_peserta();
		$data['countPeserta']			= $this->M_admin->countPeserta();
		$data['diffPeserta']		  	= $this->M_admin->countDiffPeserta();
		$data['nonPeserta']				= $this->M_admin->countNonPeserta();
		$data['diffNonPeserta']  		= $this->M_admin->countDiffNonPeserta();
		$data['NewPeserta']  	  		= $this->M_admin->countNewPeserta();

		$data['module'] 		= "admin";
		$data['fileview'] 		= "data_peserta";
		echo Modules::run('template/backend_main', $data);
	}

	  // KEGIATAN
	public function kegiatanku(){
		$data['peserta']		  		= $this->M_admin->countPeserta();
		$data['diffPeserta']		  	= $this->M_admin->countDiffPeserta();
		$data['countKegiatan']			= $this->M_admin->countKegiatan();
		$data['diffKegiatan']			= $this->M_admin->countDiffKegiatan();
		$data['newKegiatan']			= $this->M_admin->countNewKegiatan();
		$data['kegiatan']   			= $this->M_admin->get_kegiatanAll();

		$data['module']     = "admin";
		$data['fileview']   = "data_kegiatan";
		echo Modules::run('template/backend_main', $data);
	}

	public function buat_kegiatan(){

		$data['module']     = "admin";
		$data['fileview']   = "tambah_kegiatan";
		echo Modules::run('template/backend_main', $data);
	}

	// DATA KEGIATAN
	public function data_kegiatan(){
		$data['countKegiatan']			= $this->M_admin->countKegiatan();
		$data['diffKegiatan']			= $this->M_admin->countDiffKegiatan();
		$data['newKegiatan']			= $this->M_admin->countNewKegiatan();
		$data['peserta']				= $this->M_admin->count_pesertaKegiatanAll();
		
		$data['kegiatan']				= $this->M_admin->get_kegiatanAll();
		$data['CI']						= $this;

		$data['module'] 	= "admin";
		$data['fileview'] 	= "data_kegiatan";
		echo Modules::run('template/backend_main', $data);
	}

	// DATA AKTIVITAS SISTEM
	public function aktivitas(){
		$this->load->library('pagination');

		$config['base_url'] 				= base_url().'aktivitas-sistem';
		$config['total_rows'] 				= $this->M_admin->count_aktivitasAdmin();
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

		$data['aktivitas']	= $this->M_admin->get_aktivitasAdmin($config['per_page'], (!$this->uri->segment(3) ? 0 : $this->uri->segment(3)));
		$data['CI']				= $this;

		$data['module'] 		= "admin";
		$data['fileview'] 		= "aktivitas";
		echo Modules::run('template/backend_main', $data);
	}

	// DATA NOTIFIKASI SISTEM
	public function notifikasi(){
		$this->load->library('pagination');

		$config['base_url'] 				= base_url().'notifikasi-sistem';
		$config['total_rows'] 				= $this->M_admin->count_notifikasiAdmin();
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

		$data['notifikasi']	= $this->M_admin->get_notifikasiAdmin($config['per_page'], (!$this->uri->segment(3) ? 0 : $this->uri->segment(3)));
		$data['CI']				= $this;

		$data['module'] 		= "admin";
		$data['fileview'] 		= "notifikasi";
		echo Modules::run('template/backend_main', $data);
	}


	// PROSES

	function terimaPenyelenggara(){
		if ($this->M_admin->terimaPenyelenggara() == TRUE)  {

			$this->session->set_flashdata('success', "Berhasil menerima permintaan pengajuan AKSES K-Panel !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menerima permintaan pengajuan AKSES K-Panel!");
			redirect($this->agent->referrer());
		}
	}

	function tolakPenyelenggara(){
		if ($this->M_admin->tolakPenyelenggara() == TRUE) {

			$this->session->set_flashdata('success', "Berhasil menolak permintaan pengajuan AKSES K-Panel !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menolak permintaan pengajuan AKSES K-Panel !!");
			redirect($this->agent->referrer());
		}
	}

	function ubah_passwordAdmin(){
		if ($this->M_admin->cek_passAdmin($this->input->post("PASS_LAMA")) == TRUE) {
			if ($this->input->post("PASS_BARU") == $this->input->post("CON_PASS")) {
				if ($this->M_admin->ganti_passAdmin() == TRUE) {
					$this->session->set_flashdata('success', "Berhasil mengubah password untuk akun admin !!");
					redirect($this->agent->referrer());
				}else {
					$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah password untuk akun admin !!");
					redirect($this->agent->referrer());
				}
			}else{
				$this->session->set_flashdata('error', "Konfirmasi password baru tidak sama!!");
				redirect($this->agent->referrer());
			}
		}else{
			$this->session->set_flashdata('error', "Password lama anda salah !!");
			redirect($this->agent->referrer());
		}
	}

	function ubah_mailer(){
		if ($this->M_admin->ubah_mailer() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah data !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah data !!");
			redirect($this->agent->referrer());
		}
	}

	function ubah_sosmed(){
		if ($this->M_admin->ubah_sosmed() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah data !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah data !!");
			redirect($this->agent->referrer());
		}
	}

	function ubah_websiteInfo(){
		if ($this->M_admin->ubah_websiteInfo() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah data !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah data !!");
			redirect($this->agent->referrer());
		}
	}

	function atur_daftarPenyelenggara(){
		if ($this->M_admin->atur_daftarPenyelenggara() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengatur daftar menu penyelenggara !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengatur daftar menu penyelenggara !!");
			redirect($this->agent->referrer());
		}
	}

	// LOGO

	function ubah_logoFav(){
		// UPLOAD
		if (!empty($_FILES['LOGO_FAV']['name'])) {
			// CREATE FILENAME
			$path  		= $_FILES['LOGO_FAV']['name'];
			$ext   		= pathinfo($path, PATHINFO_EXTENSION);

			$filename	= "icon-ts.{$ext}";

			// UPLOAD FILE
			$config['upload_path']          = "assets";
			$config['allowed_types']        = 'JPEG|jpeg|JPG|jpg|PNG|png';
			$config['max_size']             = 10048;
			$config['file_name']			= $filename;
			$config['overwrite']			= TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('LOGO_FAV')){
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat meng-upload logo!!');
				redirect($this->agent->referrer());
			}else {

				$this->db->where('KEY', 'LOGO_FAV');
				$this->db->update('TB_PENGATURAN', array('VALUE' => $filename));
				$cek = ($this->db->affected_rows() != 1) ? false : true;
				if ($cek == TRUE) {
					$this->session->set_flashdata('success', 'Berhasil mengubah logo!!');
					redirect($this->agent->referrer());
				}else {
					$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah logo!");
					redirect($this->agent->referrer());
				}
			}
		}else {
			$this->session->set_flashdata('error', 'Harap pilih foto untuk dapat diupload!!');
			redirect($this->agent->referrer());
		}
	}

	function ubah_logoBlack(){
		// UPLOAD
		if (!empty($_FILES['LOGO_BLACK']['name'])) {
			// CREATE FILENAME
			$path  		= $_FILES['LOGO_BLACK']['name'];
			$ext   		= pathinfo($path, PATHINFO_EXTENSION);

			$filename	= "logo-ts.{$ext}";

			// UPLOAD FILE
			$config['upload_path']          = "assets";
			$config['allowed_types']        = 'JPEG|jpeg|JPG|jpg|PNG|png';
			$config['max_size']             = 10048;
			$config['file_name']			= $filename;
			$config['overwrite']			= TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('LOGO_BLACK')){
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat meng-upload logo!!');
				redirect($this->agent->referrer());
			}else {

				$this->db->where('KEY', 'LOGO_BLACK');
				$this->db->update('TB_PENGATURAN', array('VALUE' => $filename));
				$cek = ($this->db->affected_rows() != 1) ? false : true;
				if ($cek == TRUE) {
					$this->session->set_flashdata('success', 'Berhasil mengubah logo!!');
					redirect($this->agent->referrer());
				}else {
					$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah logo!");
					redirect($this->agent->referrer());
				}
			}
		}else {
			$this->session->set_flashdata('error', 'Harap pilih foto untuk dapat diupload!!');
			redirect($this->agent->referrer());
		}
	}

	function ubah_logoWhite(){
		// UPLOAD
		if (!empty($_FILES['LOGO_WHITE']['name'])) {
			// CREATE FILENAME
			$path  		= $_FILES['LOGO_WHITE']['name'];
			$ext   		= pathinfo($path, PATHINFO_EXTENSION);

			$filename	= "logo-in.{$ext}";

			// UPLOAD FILE
			$config['upload_path']          = "assets";
			$config['allowed_types']        = 'JPEG|jpeg|JPG|jpg|PNG|png';
			$config['max_size']             = 10048;
			$config['file_name']			= $filename;
			$config['overwrite']			= TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('LOGO_WHITE')){
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat meng-upload logo!!');
				redirect($this->agent->referrer());
			}else {

				$this->db->where('KEY', 'LOGO_WHITE');
				$this->db->update('TB_PENGATURAN', array('VALUE' => $filename));
				$cek = ($this->db->affected_rows() != 1) ? false : true;
				if ($cek == TRUE) {
					$this->session->set_flashdata('success', 'Berhasil mengubah logo!!');
					redirect($this->agent->referrer());
				}else {
					$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah logo!");
					redirect($this->agent->referrer());
				}
			}
		}else {
			$this->session->set_flashdata('error', 'Harap pilih foto untuk dapat diupload!!');
			redirect($this->agent->referrer());
		}
	}

	// END LOGO

	// PROSES BUAT KEGIATAN
	function proses_buatKegiatan(){
		$filename             = null;
		$JUDUL                = htmlspecialchars($this->input->post("JUDUL"), true);

    // UPLOAD
		if (!empty($_FILES['POSTER']['name'])) {
      // CREATE FILENAME
			$path     	= $_FILES['POSTER']['name'];
			$ext      	= pathinfo($path, PATHINFO_EXTENSION);

			$char 		= array('!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '+', '=', '|', ';', '.', '`', '~', '[', ']', '{', '}', '?', '/\s+/', ' ', '_', '"');
			$uniqid 	= str_replace($char, '-', $JUDUL);
			$uniqid 	= str_replace('--', '-', $uniqid);
			$uniqid 	= strtolower($uniqid);
			$time 		= substr(md5(time()), 0, 3);

     		 // CREATE KODE KEGIATAN
			do {
				$KODE_KEGIATAN      = "kegiatan-{$uniqid}-{$time}";
			} while ($this->M_admin->cek_kodeKegiatan($KODE_KEGIATAN) > 0);

			$time   = time();
			$filename = "POSTER_-{$time}.{$ext}";

			$folder   = "berkas/kegiatan/{$KODE_KEGIATAN}/POSTER/";

			if (!is_dir($folder)) {
				mkdir($folder, 0755, true);
			}

      		// UPLOAD FILE
			$config['upload_path']    = $folder;
			$config['allowed_types']  = 'JPEG|jpeg|JPG|jpg|PNG|png';
			$config['max_size']       = 2048;
			$config['file_name']      = $filename;
			$config['overwrite']      = TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('POSTER')){
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat mengunggah Poster anda!!');
				redirect($this->agent->referrer());
			}else {
				if ($this->M_admin->proses_buatKegiatan($KODE_KEGIATAN, $filename) == TRUE) {

        			// SAVE LOG
					$this->M_admin->log_aktivitasKpanel($this->session->userdata("kode_user"), 11, 3);

					$this->session->set_flashdata('success', 'Berhasil membuat kegiatan anda!!');
					redirect('kegiatanku');
				}else {
					$this->session->set_flashdata('error', "Terjadi kesalahan saat membuat kegiatan anda!");
					redirect($this->agent->referrer());
				}
			}
		}else {
			$this->session->set_flashdata('error', 'Harap pilih Poster untuk dapat diupload!!');
			redirect($this->agent->referrer());
		}
	}

	// END PROSES

}?>
