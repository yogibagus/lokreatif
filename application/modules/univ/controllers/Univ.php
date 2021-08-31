<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Univ extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_univ');
		$this->load->library('transaksi');
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

		if ($this->session->userdata('role') != 3) {
			$this->session->set_flashdata('error', "Mohon maaf hak akses anda tidak diperuntukan untuk halaman ini");
			redirect($this->agent->referrer());
		}

		$univ 	= $this->M_univ->cek_aktivasi($this->session->userdata('kode_user'));
		$profil		= ($this->uri->segment(1) == "univ" && empty($this->uri->segment(2)) ? TRUE : FALSE);

		if ($univ->STATUS == 0 AND $profil == FALSE) {
			$this->session->set_flashdata('error', "Harap lakukan aktivasi akun anda, untuk melanjutkan");
			redirect(site_url('hold-verification'));
		}
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
		$data['notifikasi']			= $this->M_univ->get_notifikasi($this->session->userdata("kode_user"));

		$kodept						= $this->M_univ->get_kodept($this->session->userdata("kode_user"))->kodept;
		$data['transaksi']			= $this->M_univ->get_transaksi($kodept);
		$data['transaksiDetail']	= $this->M_univ->get_transaksiDetail($kodept);
		$data['allTim']				= $this->M_univ->get_allTim($kodept);
		$data['allTimTerbayar']		= $this->M_univ->get_allTimTerbayar($kodept)->TOTAL_TIM;

		$data['CI']					= $this;

		$data['module'] 			= "univ";
		$data['fileview'] 			= "profil";
		echo Modules::run('template/backend_main', $data);
	}

	public function transaksi(){
		$data['notifikasi']			= $this->M_univ->get_notifikasi($this->session->userdata("kode_user"));

		$kodept						= $this->M_univ->get_kodept($this->session->userdata("kode_user"))->kodept;
		$data['transaksi']			= $this->M_univ->get_transaksi($kodept);

		foreach ($data['transaksi'] as $item) {
			$data['payment'][$item->KODE_TRANS] = $this->M_univ->get_payment($item->KODE_TRANS);
		}


		$data['CI']					= $this;

		$data['module'] 			= "univ";
		$data['fileview'] 			= "transaksi";
		echo Modules::run('template/backend_main', $data);
	}

	public function order(){
		$kodePendaftaran	= explode(',', $_POST['KODE_PENDAFTARAN']);
		$totTim				= $_POST['TOTAL_TIM'];
		$kodeTrans			= $this->transaksi->gen_kodeTrans();
		$dataStoreOrd		= array();

		$dataStoreTrans['KODE_TRANS'] 		= $kodeTrans;
		$dataStoreTrans['KODE_USER_BILL'] 	= $this->session->userdata('kode_user');
		$dataStoreTrans['ROLE_USER_BILL'] 	= $this->session->userdata('role');
		
		foreach ($kodePendaftaran as $item) {
			$temp['KODE_TRANS'] 		= $kodeTrans;
			$temp['KODE_PENDAFTARAN']	= $item;
			$temp['BIAYA_TIM']			= $this->General->get_biayaDaftar($totTim);
			array_push($dataStoreOrd, $temp);
		}
		
		$this->M_univ->insert_trans($dataStoreTrans);
		$this->M_univ->insert_order($dataStoreOrd);

		redirect('payment/checkout/'.$kodeTrans);
	}

	

	public function notifikasi(){
		$this->load->library('pagination');

		$config['base_url'] 				= base_url().'pts/notifikasi';
		$config['total_rows'] 				= $this->M_univ->countAllNotifikasi($this->session->userdata("kode_user"));
		$config['per_page'] 				= 10;

		$config['full_tag_open'] 			= '<nav class="d-flex justify-content-between align-items-center" aria-label="Page navigation example"><ul class="pagination pagination-sm">';
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

		$config['attributes']					= array('class' => 'page-link');

		$this->pagination->initialize($config);

		$data['notifikasi']	= $this->M_univ->get_AllNotifikasi($this->session->userdata("kode_user"), $config['per_page'], (!$this->uri->segment(3) ? 0 : $this->uri->segment(3)));
		$data['CI']					= $this;

		$data['module'] 		= "univ";
		$data['fileview'] 		= "notifikasi";
		echo Modules::run('template/frontend_user', $data);
	}

	public function pengaturan(){
		if ($this->M_univ->get_userDetail($this->session->userdata("kode_user")) == false) {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menampilkan data diri anda!");
			redirect(base_url());
		}else{
			$data['user']			= $this->M_univ->get_userDetail($this->session->userdata("kode_user"));

			$data['CI']				= $this;

			$data['module'] 		= "univ";
			$data['fileview'] 		= "pengaturan";
			echo Modules::run('template/backend_main', $data);
		}
	}

	// PROSES
	function ubah_profil(){
		if ($this->M_univ->ubah_profil($this->session->userdata("kode_user")) == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah data diri anda!");
			redirect(site_url('pts/pengaturan'));
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah data diri anda!");
			redirect($this->agent->referrer());
		}
	}

	public function ubah_foto(){

		$filename 	= null;
		$kode_user	= $this->session->userdata("kode_user");
		// UPLOAD
		if (!empty($_FILES['profil']['name'])) {
			// CREATE FILENAME
			$path  		= $_FILES['profil']['name'];
			$ext   		= pathinfo($path, PATHINFO_EXTENSION);

			$time		= time();
			$filename	= "FOTO_-{$time}.{$ext}";

			$folder		= "berkas/univ/{$kode_user}/foto";

			if (!is_dir($folder)) {
				mkdir($folder, 0755, true);
			}

			// UPLOAD FILE
			$config['upload_path']          = $folder;
			$config['allowed_types']        = 'JPEG|jpeg|JPG|jpg|PNG|png';
			$config['max_size']             = 10048;
			$config['file_name']			= $filename;
			$config['overwrite']			= TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('profil')){
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat meng-upload Foto anda!!');
				redirect($this->agent->referrer());
			}else {

				$this->db->where('KODE_USER', $kode_user);
				$this->db->update('tb_univ', array('PROFIL' => $filename));
				$cek = ($this->db->affected_rows() != 1) ? false : true;
				if ($cek == TRUE) {
					$this->session->set_flashdata('success', 'Berhasil mengubah foto profil akun anda!!');
					redirect($this->agent->referrer());
				}else {
					$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah foto profil akun anda!");
					redirect($this->agent->referrer());
				}
			}
		}else {
			$this->session->set_flashdata('error', 'Harap pilih foto untuk dapat diupload!!');
			redirect($this->agent->referrer());
		}
	}

	function hapus_foto(){

		$this->db->where('KODE_USER', $this->session->userdata("kode_user"));
		$this->db->update('tb_univ', array('PROFIL' => null));

		$cek = ($this->db->affected_rows() != 1) ? false : true;
		if ($cek == TRUE) {
			$this->session->set_flashdata('success', "Berhasil menghapus foto profil anda !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menghapus foto profil akun anda!");
			redirect($this->agent->referrer());
		}
	}

	function read_notifikasi($kode_notifikasi){

		if ($this->M_univ->read_notifikasi($kode_notifikasi) == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah status notifikasi !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah status notifikasi!!");
			redirect($this->agent->referrer());
		}
	}

	function read_notifikasiAll(){

		if ($this->M_univ->read_notifikasiAll() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah status semua notifikasi !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah status semua notifikasi!!");
			redirect($this->agent->referrer());
		}
	}

}?>
