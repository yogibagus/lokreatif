<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends MX_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_peserta');
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

		if ($this->session->userdata('role') != 1) {
			$this->session->set_flashdata('error', "Mohon maaf hak akses anda tidak diperuntukan untuk halaman ini");
			redirect($this->agent->referrer());
		}

		$peserta 	= $this->M_peserta->cek_aktivasi($this->session->userdata('kode_user'));
		$profil		= ($this->uri->segment(1) == "peserta" && empty($this->uri->segment(2)) ? TRUE : FALSE);

		if ($peserta->STATUS == 0 AND $profil == FALSE) {
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
		$data['notifikasi']			= $this->M_peserta->get_notifikasi($this->session->userdata("kode_user"));
		$data['kegiatan']			= $this->M_peserta->get_kegiatanAll();
		$data['daftarKompetisi']	= $this->M_peserta->cek_daftarKompetisi($this->session->userdata("kode_user"));
		$data['daftarKegiatan']		= $this->M_peserta->count_pesertaKegiatan($this->session->userdata("kode_user"));

		$data['CI']					= $this;

		$data['module'] 			= "peserta";
		$data['fileview'] 			= "profil";
		echo Modules::run('template/frontend_user', $data);
	}

	public function notifikasi(){
		$this->load->library('pagination');

		$config['base_url'] 				= base_url().'peserta/notifikasi';
		$config['total_rows'] 				= $this->M_peserta->countAllNotifikasi($this->session->userdata("kode_user"));
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

		$data['notifikasi']	= $this->M_peserta->get_AllNotifikasi($this->session->userdata("kode_user"), $config['per_page'], (!$this->uri->segment(3) ? 0 : $this->uri->segment(3)));
		$data['CI']					= $this;

		$data['module'] 		= "peserta";
		$data['fileview'] 		= "notifikasi";
		echo Modules::run('template/frontend_user', $data);
	}

	public function kegiatan(){
		$this->load->library('pagination');

		$config['base_url'] 				= base_url().'peserta/kegiatan';
		$config['total_rows'] 				= $this->M_peserta->count_kegiatanDiikuti($this->session->userdata("kode_user"));
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

		$config['attributes']				= array('class' => 'page-link');

		$this->pagination->initialize($config);

		$data['kegiatanDiikuti']			= $this->M_peserta->kegiatanDiikuti($this->session->userdata('kode_user'), $config['per_page'], (!$this->uri->segment(3) ? 0 : $this->uri->segment(3)));

		$data['module'] 		= "peserta";
		$data['fileview'] 		= "kegiatan";
		echo Modules::run('template/frontend_user', $data);
	}

	public function data_pendaftaran(){
		if ($this->M_peserta->cek_daftarKompetisi($this->session->userdata("kode_user")) == false) {
			$this->session->set_flashdata('error', "Anda belum melakukan pendaftaran kompetisi !!");
			redirect($this->agent->referrer());
		}else{
			$dataPeserta 			= $this->M_peserta->get_detailDaftarKompetisi($this->session->userdata("kode_user"));

			$data['dataPendaftaran']= $dataPeserta;
			$data['sudahBayar']		= $this->General->cek_sudahBayar($dataPeserta->KODE_PENDAFTARAN);
			$data['statBayar']		= $this->General->cek_statBayar($dataPeserta->KODE_PENDAFTARAN);
			$data['totBayar']		= $this->General->get_biayaDaftar($dataPeserta->JML_TIM);
			$data['dataAnggota']	= $this->General->get_dataAnggota($dataPeserta->KODE_PENDAFTARAN);
			$data['dataKetua']		= $this->General->get_dataKetua($dataPeserta->KODE_PENDAFTARAN);
			$data['dataDospem']		= $this->General->get_dataDospem($dataPeserta->KODE_PENDAFTARAN);
			$data['pts']			= $this->M_peserta->get_pts();
			
			$data['CI']				= $this;

			$data['module'] 		= "peserta";
			$data['fileview'] 		= "pendaftaran_detail";
			echo Modules::run('template/frontend_user', $data);
		}
	}

	public function data_anggota(){
		if ($this->M_peserta->cek_daftarKompetisi($this->session->userdata("kode_user")) == false) {
			$this->session->set_flashdata('error', "Anda belum melakukan pendaftaran kompetisi !!");
			redirect($this->agent->referrer());
		}else{
			$dataPeserta 			= $this->M_peserta->get_detailDaftarKompetisi($this->session->userdata("kode_user"));
			$data['dataPendaftaran']= $dataPeserta;
			$data['dataAnggota']	= $this->General->get_dataAnggota($dataPeserta->KODE_PENDAFTARAN);
			$data['dataKetua']		= $this->General->get_dataKetua($dataPeserta->KODE_PENDAFTARAN);
			$data['dataDospem']		= $this->General->get_dataDospem($dataPeserta->KODE_PENDAFTARAN);
			
			$data['CI']				= $this;

			$data['module'] 		= "peserta";
			$data['fileview'] 		= "pendaftaran_anggota";
			echo Modules::run('template/frontend_user', $data);
		}
	}

	public function berkas_kompetisi(){
		$kode 	= 'lokreatif';
		$tabel	= 'pendaftaran_kompetisi';
		if ($this->General->cek_pendaftaranStatus() != false) {
			if ($this->General->get_bidangLomba() != false) {
				if ($this->General->get_formMeta($kode) != false) {
					$dataPeserta 			= $this->M_peserta->get_detailDaftarKompetisi($this->session->userdata("kode_user"));
					$data['dataPendaftaran']= $dataPeserta;
					$data['kegiatan']		= $this->General->get_kegiatan($kode);
					$data['formulir']		= $this->General->get_formMeta($kode);
					$data['bidang_lomba']	= $this->General->get_bidangLomba();
					$data['pts']			= $this->General->get_pts();

					$data['KODE_KEGIATAN']	= $kode;

					$data['CI']			= $this;

					$data['module'] 	= "peserta";
					$data['fileview'] 	= "pendaftaran_berkas";
					echo Modules::run('template/frontend_user', $data);
				}else{
					$this->session->set_flashdata('error', "Mohon maaf formulir pendaftaran sedang diatur, harap tunggu beberapa saat !!");
					redirect($this->agent->referrer());
				}
			}else{
				$this->session->set_flashdata('error', "Mohon maaf bekum ada bidang lomba yang dibuka, harap tunggu beberapa saat !!");
				redirect($this->agent->referrer());
			}
		}else{
			$this->session->set_flashdata('error', "Pendaftaran belum dibuka !!");
			redirect($this->agent->referrer());
		}
	}

	public function detail_daftar($id){
		if ($this->M_peserta->get_detailDaftar($id) == false) {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menampilkan data pendaftaran anda!");
			redirect($this->agent->referrer());
		}else{
			$data['data-pendaftaran']	= $this->M_peserta->get_detailDaftar($id);

			$data['CI']				= $this;

			$data['module'] 		= "peserta";
			$data['fileview'] 		= "pendaftaran_detail";
			echo Modules::run('template/frontend_user', $data);
		}
	}

	public function pengaturan(){
		if ($this->M_peserta->get_userDetail($this->session->userdata("kode_user")) == false) {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menampilkan data diri anda!");
			redirect(base_url());
		}else{
			$data['user']			= $this->M_peserta->get_userDetail($this->session->userdata("kode_user"));

			$data['CI']				= $this;

			$data['module'] 		= "peserta";
			$data['fileview'] 		= "pengaturan";
			echo Modules::run('template/frontend_user', $data);
		}
	}

	// PROSES
	function ubah_profil(){
		if ($this->M_peserta->ubah_profil($this->session->userdata("kode_user")) == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah data diri anda!");
			redirect(site_url('peserta/pengaturan'));
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

			$folder		= "berkas/peserta/{$kode_user}/foto";

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
				$this->db->update('tb_peserta', array('PROFIL' => $filename));
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
		$this->db->update('tb_peserta', array('PROFIL' => null));

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

		if ($this->M_peserta->read_notifikasi($kode_notifikasi) == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah status notifikasi !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah status notifikasi!!");
			redirect($this->agent->referrer());
		}
	}

	function read_notifikasiAll(){

		if ($this->M_peserta->read_notifikasiAll() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah status semua notifikasi !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah status semua notifikasi!!");
			redirect($this->agent->referrer());
		}
	}

	// DATA PENDAFTARAN KOMPETISI

	function set_anggota(){

		if ($this->M_peserta->set_anggota() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengatur data anggota !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengatur data anggota !!");
			redirect($this->agent->referrer());
		}
	}

	function hapus_anggota($id){

		if ($this->M_peserta->hapus_anggota($id) == TRUE) {
			$this->session->set_flashdata('success', "Berhasil menghapus data anggota !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menghapus data anggota !!");
			redirect($this->agent->referrer());
		}
	}

	function update_pts(){

		if ($this->M_peserta->update_pts() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah data PTS anda !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah  data PTS anda !!");
			redirect($this->agent->referrer());
		}
	}

	function bayar_pendaftaran(){

		$KODE_PENDAFTARAN	= $this->input->post('KODE_PENDAFTARAN');

		// CHECK IF HAVE PENDING TRANSACTION
		if ($this->General->cek_sudahBayar($KODE_PENDAFTARAN) == true) {

			// GET KODE_TRANS FROM DB WHEN HAVE PENDING TRANSACTION
			$KODE_TRANS			= $this->General->get_kodeTrans($KODE_PENDAFTARAN);

			// REDIRECT WHEN HAVE PENDING TRANSACTION
			$this->session->set_flashdata('success', "Anda memiliki pembayaran yang belum diselesaikan !!");
			redirect(site_url('payment/checkout/'.$KODE_TRANS));
		}else{

			// GENERATE KODE_TRANS
			$KODE_TRANS			= $this->transaksi->gen_kodeTrans();

			// INSERT INTO DB WHEN DONT HAVE ANY PENDING TRANSACTION
			if ($this->M_peserta->bayar_pendaftaran($KODE_TRANS) == TRUE) {
				$this->General->log_aktivitas($this->session->userdata('kode_user'), $this->session->userdata('kode_user'), 15);
				$this->session->set_flashdata('success', "Harap lanjutkan proses pembayaran !!");
				redirect(site_url('payment/checkout/'.$KODE_TRANS));
			}else {
				$this->session->set_flashdata('error', "Terjadi kesalahan saat melakukan proses pembayaran!!");
				redirect($this->agent->referrer());
			}
		}
	}


}?>
