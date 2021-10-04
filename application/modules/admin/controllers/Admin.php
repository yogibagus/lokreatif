<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->agent->is_mobile()) {
			$this->session->set_flashdata('error', "ADMIN PANEL HANYA DAPAT DIAKSES MELALUI BROWSER");
			redirect(base_url());
		}
		if ($this->session->userdata('logged_in') == FALSE || !$this->session->userdata('logged_in')) {
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
		$this->load->model('Utilities/M_utilities');
		$this->load->model('Koordinator/M_koordinator');
		$this->load->model('General');
	}


	// MAILER SENDER
	function send_email($email, $subject, $message){

		$mail = array(
			'to' 			=> $email,
			'subject'		=> $subject,
			'message'		=> $this->body_html($message)
		);

		if ($this->mailer->send($mail) == TRUE) {
			return true;
		}else {
			return false;
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

	function get_tahapData(){
		$tahap = $this->M_admin->get_tahapData($this->input->post('TAHAP'));
        switch ($tahap->STATUS) {
          case 0:
            $status = '<span class"badge badge-secondary">belum dimulai</span>';
            break;

          case 1:
            $status = '<span class"badge badge-success">berlangsung</span>';
            break;

          case 2:
            $status = '<span class"badge badge-warning">berakhir</span>';
            break;
          
          default:
            $status = '<span class"badge badge-secondary">belum dimulai</span>';
            break;
        }
		echo json_encode(['tim' => ($tahap->TEAM == 0 ? 'tidak ada batasan' : $tahap->TEAM), 'status' => $status]);
	}

	function get_tahapDataTujuan(){
		$tahap = $this->M_admin->get_tahapData($this->input->post('KE_TAHAP'));
        switch ($tahap->STATUS) {
          case 0:
            $status = '<span class"badge badge-secondary">belum dimulai</span>';
            break;

          case 1:
            $status = '<span class"badge badge-success">berlangsung</span>';
            break;

          case 2:
            $status = '<span class"badge badge-warning">berakhir</span>';
            break;
          
          default:
            $status = '<span class"badge badge-secondary">belum dimulai</span>';
            break;
        }
		echo json_encode(['tim' => ($tahap->TEAM == 0 ? 'tidak ada batasan' : $tahap->TEAM), 'status' => $status]);
	}

	public function index()
	{
		$data['jmlMhs'] 		= $this->M_utilities->get_countMhs();
		$data['jmlTim'] 		= $this->M_utilities->get_countTim();
		$data['jmlTimBayar'] 	= $this->M_utilities->get_countTimBayar();
		$data['jmlPTS'] 		= count($this->M_utilities->get_countPTS());

		$timKategori 					= $this->M_utilities->get_timKategori();
		$data['timKategori']['lomba'] 	= array();
		$data['timKategori']['jmlTim'] 	= array();
		foreach ($timKategori as $item) {
			$data['timKategori']['lomba'][]  = "'".$item->BIDANG_LOMBA."'";
			$data['timKategori']['jmlTim'][] = $item->JML_TIM;
		}

		$timLLDIKTI 					= $this->M_utilities->get_timLLDIKTI();
		$data['timLLDIKTI']['lldikti']	= array();
		$data['timLLDIKTI']['jmlTim'] 	= array();
		foreach ($timLLDIKTI as $item) {
			$data['timLLDIKTI']['lldikti'][]  = "'".$item->kopertis."'";
			$data['timLLDIKTI']['jmlTim'][]	  = $item->JML_TIM;
		}
		
		$data['timPTS'] 	= $this->M_utilities->get_timPTS();
		$data['detStatTim'] = $this->M_utilities->get_detStatTim();

		$data['CI']						= $this;

		$data['module'] 		= "admin";
		$data['fileview'] 		= "dashboard";
		echo Modules::run('template/backend_main', $data);
	}

	// DATA BERKAS LOMBA
	public function berkas_lomba()
	{
		$data['berkas_lomba']		  	= $this->M_admin->get_berkasLomba();

		$data['module'] 	= "admin";
		$data['fileview'] 	= "berkas_lomba";
		echo Modules::run('template/backend_main', $data);
	}

	function tambahBerkas()
	{

		// UPLOAD
		if (!empty($_FILES['LINK']['name'])) {

			$folder   = "berkas/kebutuhan/";

			if (!is_dir($folder)) {
				mkdir($folder, 0755, true);
			}

			// UPLOAD FILE
			$config['upload_path']    		= $folder;
			$config['allowed_types']        = '*';
			$config['max_size']             = 10 * 1024;
			$config['overwrite']			= TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('LINK')) {
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat mengunggah berkas!!');
				redirect($this->agent->referrer());
			} else {
				$upload_data = $this->upload->data();

				if ($this->M_admin->tambahBerkas($upload_data['file_name']) == TRUE) {

					$this->session->set_flashdata('success', "Berhasil menambahkan berkas kebutuhan !!");
					redirect($this->agent->referrer());
				} else {
					$this->session->set_flashdata('error', "Terjadi kesalahan saat menambahkan berkas kebutuhan !!");
					redirect($this->agent->referrer());
				}
			}
		} else {
			$this->session->set_flashdata('warning', 'Anda tidak memilih file untuk diunggah!!');
			redirect($this->agent->referrer());
		}
	}

	function editBerkas()
	{

		// UPLOAD
		if (!empty($_FILES['NEW_LINK']['name'])) {

			$folder   = "berkas/kebutuhan/";

			if (!is_dir($folder)) {
				mkdir($folder, 0755, true);
			}

			// UPLOAD FILE
			$config['upload_path']    		= $folder;
			$config['allowed_types']        = '*';
			$config['max_size']             = 10 * 1024;
			$config['overwrite']			= TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('NEW_LINK')) {
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat mengunggah berkas!!');
				redirect($this->agent->referrer());
			} else {
				$upload_data = $this->upload->data();
				if ($this->M_admin->editBerkas($upload_data['file_name']) == TRUE) {

					$this->session->set_flashdata('success', "Berhasil mengubah berkas kebutuhan !!");
					redirect($this->agent->referrer());
				} else {
					$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah berkas kebutuhan !!");
					redirect($this->agent->referrer());
				}
			}
		} else {
			if ($this->M_admin->editBerkas($this->input->post('LINK')) == TRUE) {

				$this->session->set_flashdata('success', "Berhasil mengubah berkas kebutuhan !!");
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah berkas kebutuhan !!");
				redirect($this->agent->referrer());
			}
		}
	}

	function hapusBerkas()
	{
		if ($this->M_admin->hapusBerkas() == TRUE) {

			$this->session->set_flashdata('success', "Berhasil menghapus berkas kebutuhan !!");
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menghapus berkas kebutuhan !!");
			redirect($this->agent->referrer());
		}
	}

	// DATA PENGATURAN
	public function pengaturan()
	{

		$data['module'] 	= "admin";
		$data['fileview'] 	= "pengaturan/pengaturan";
		echo Modules::run('template/backend_main', $data);
	}
	public function pengaturan_akunAdmin()
	{

		// MAILER
		$data['SMPT_GMAIL']		= $this->M_admin->get_mailerSmpt();
		$data['EM_HOST']		= $this->M_admin->get_mailerHost();
		$data['EM_USERNAME']	= $this->M_admin->get_mailerUsername();
		$data['EM_PASSWORD']	= $this->M_admin->get_mailerPassword();

		$data['module'] 	= "admin";
		$data['fileview'] 	= "pengaturan/akun_admin";
		echo Modules::run('template/backend_main', $data);
	}
	public function pengaturan_sistem()
	{

		// MAILER
		$data['SMPT_GMAIL']		= $this->M_admin->get_mailerSmpt();
		$data['EM_HOST']		= $this->M_admin->get_mailerHost();
		$data['EM_USERNAME']	= $this->M_admin->get_mailerUsername();
		$data['EM_PASSWORD']	= $this->M_admin->get_mailerPassword();

		$data['module'] 	= "admin";
		$data['fileview'] 	= "pengaturan/sistem";
		echo Modules::run('template/backend_main', $data);
	}
	public function pengaturan_website()
	{

		// MEGA MENU PENYELENGGARA
		$data['CI']					= $this;

		$data['module'] 	= "admin";
		$data['fileview'] 	= "pengaturan/website";
		echo Modules::run('template/backend_main', $data);
	}

	// DATA KOORDINATOR

	public function data_koordinator()
	{

		$data['bidang_lomba'] = $this->M_admin->get_bidangLomba();
		$data['data_koordinator']    = $this->M_admin->get_dataKoordinator();
		$data['CI']           = $this;

		$data['module']     = "admin";
		$data['fileview']   = "data_koordinator";
		echo Modules::run('template/backend_main', $data);
	}

	//PROSES

	function tambah_koordinator()
	{
		if ($this->input->post('PASSWORD') == $this->input->post('CONFIRM_PASSWORD')) {


      		// CREATE UNIQ NAME KODE USER
			$string = preg_replace('/[^a-z]/i', '', $this->input->post('NAMA_KOORDINATOR'));

			$vocal  = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " ");
			$scrap  = str_replace($vocal, "", $string);
			$begin  = substr($scrap, 0, 4);
			$uniqid = strtoupper($begin);

			// CREATE KODE USER
			do {
				$KODE_USER      = "KOR_" . $uniqid . substr(md5(time()), 0, 3);
			} while ($this->M_admin->cek_kodeUser($KODE_USER) > 0);

			if ($this->M_admin->tambah_koordinator($KODE_USER) == TRUE) {

				$BIDANG_LOMBA 		= $this->M_admin->get_bidangKoordinator($KODE_USER) != false ? $this->M_admin->get_bidangKoordinator($KODE_USER)->BIDANG_LOMBA : 'BIDANG TIDAK DITEMUKAN';
				$NAMA_KOORDINATOR	= $this->input->post('NAMA_KOORDINATOR');
				$EMAIL				= $this->input->post('EMAIL');
				$PASSWORD			= $this->input->post('PASSWORD');

				$subject	= "Akun koordinator LO Kreatif Bidang Lomba - {$BIDANG_LOMBA}";
				$message 	= "Hai {$NAMA_KOORDINATOR}, kamu telah ditambahkan sebagai koordinator LO Kreatif bidang lomba <i>{$BIDANG_LOMBA}</i>. Berikut hak akses untuk masuk ke akun kamu:</br></br><table cellspacing='0' cellpadding='0' style='table{border:none}'><tr><td><b>Email</b></td><td>: {$EMAIL}</td></tr><tr><td><b>Password</b></td><td>: {$PASSWORD}</td></tr></table></br></br>";

				$this->send_email($EMAIL, $subject, $message);
				$this->session->set_flashdata('success', "Berhasil menambahkan data koordinator !!");
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('error', "Terjadi kesalahan saat menambahkan data koordinator !!");
				redirect($this->agent->referrer());
			}
		} else {
			$this->session->set_flashdata('error', "Password yang anda masukkan tidak sama !!");
			redirect($this->agent->referrer());
		}
	}

	function edit_koordinator()
	{
		if ($this->M_admin->edit_koordinator() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah data koordinator !!");
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah data koordinator !!");
			redirect($this->agent->referrer());
		}
	}

	function hapus_koordinator()
	{
		if ($this->M_admin->hapus_koordinator() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil menghapus data koordinator !!");
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menghapus data koordinator !!");
			redirect($this->agent->referrer());
		}
	}

	// END DATA KOORDINATOR

	// DATA AKUN KOLEKTIF PTS
	public function data_kolektifPts()
	{
		$data['pts']			= $this->M_admin->get_akunPTS();

		$data['CI']				= $this;
		$data['module'] 		= "admin";
		$data['fileview'] 		= "data_kolektifPts";
		echo Modules::run('template/backend_main', $data);
	}

	// DATA PENGGUNA
	public function data_peserta()
	{
		$data['peserta']				= $this->M_admin->get_peserta();
		$data['countPeserta']			= $this->M_admin->countPeserta();
		$data['diffPeserta']		  	= $this->M_admin->countDiffPeserta();
		$data['nonPeserta']				= $this->M_admin->countNonPeserta();
		$data['diffNonPeserta']  		= $this->M_admin->countDiffNonPeserta();
		$data['NewPeserta']  	  		= $this->M_admin->countNewPeserta();

		$data['CI']				= $this;
		$data['module'] 		= "admin";
		$data['fileview'] 		= "data_peserta";
		echo Modules::run('template/backend_main', $data);
	}

	// KEGIATAN
	public function kegiatanku()
	{
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

	public function buat_kegiatan()
	{

		$data['module']     = "admin";
		$data['fileview']   = "tambah_kegiatan";
		echo Modules::run('template/backend_main', $data);
	}

	// DATA KEGIATAN
	public function data_kegiatan()
	{
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

	// REFUND
	public function data_refund()
	{
		$data['countRefund']		  	= $this->M_admin->countRefund();
		$data['countSudahRefund']		= $this->M_admin->countSudahRefund();
		$data['sumTotalRefundSukses']		= $this->M_admin->sumTotalRefundSukses()->total_refund;
		$data['refund'] = $this->M_admin->get_refund();

		$data['ci'] = $this;
		$data['module']     = "admin";
		$data['fileview']   = "data_refund";
		echo Modules::run('template/backend_main', $data);
	}

	public function update_refund($id_refund, $stat_refund)
	{
		$refund = $this->M_admin->get_refund_by_id($id_refund);
		if($refund != false){
			$data['STAT_REFUND'] = $stat_refund;
			$data['LOG_TIME'] = date("Y-m-d H:i:s");
			if($this->M_admin->update_refund($data, $id_refund) != false){
				$this->session->set_flashdata('success', "Status Refund ID " . $id_refund . " berhasil dirubah!");
				redirect($this->agent->referrer());
			}
		}else{
			$this->session->set_flashdata('warning', "Refund ID tidak ditemukan!");
			redirect($this->agent->referrer());
		}
	}

	// DATA AKTIVITAS SISTEM
	public function aktivitas()
	{
		$this->load->library('pagination');

		$config['base_url'] 				= base_url() . 'aktivitas-sistem';
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
	public function notifikasi()
	{
		$this->load->library('pagination');

		$config['base_url'] 				= base_url() . 'notifikasi-sistem';
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

	// DATA PTS BARU
	public function pengajuan_pts()
	{
		$data['ptsBaru']  	  	= $this->M_admin->get_ptsBaru();

		$data['module'] 		= "admin";
		$data['fileview'] 		= "pengajuan_pts";
		echo Modules::run('template/backend_main', $data);
	}


	// PROSES

	function terima_pts($id)
	{
		if ($this->M_admin->cek_kodePTSbaru($this->input->post('kodept')) == TRUE) {
			$this->session->set_flashdata('warning', "KODE PTS telah ada !!");
			redirect($this->agent->referrer());
		} else {
			if ($this->M_admin->terima_pts($id) == TRUE) {

				$this->session->set_flashdata('success', "Berhasil menerima dan menambahkan data PTS !!");
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('error', "Terjadi kesalahan saat menerima dan menambahkan data PTS !!");
				redirect($this->agent->referrer());
			}
		}
	}

	function tolak_pts($id)
	{
		if ($this->M_admin->tolak_pts($id) == TRUE) {

			$this->session->set_flashdata('success', "Berhasil menolak pengajuan data PTS !!");
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menolak pengajuan data PTS !!");
			redirect($this->agent->referrer());
		}
	}

	function ubah_passwordAdmin()
	{
		if ($this->M_admin->cek_passAdmin($this->input->post("PASS_LAMA")) == TRUE) {
			if ($this->input->post("PASS_BARU") == $this->input->post("CON_PASS")) {
				if ($this->M_admin->ganti_passAdmin() == TRUE) {
					$this->session->set_flashdata('success', "Berhasil mengubah password untuk akun admin !!");
					redirect($this->agent->referrer());
				} else {
					$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah password untuk akun admin !!");
					redirect($this->agent->referrer());
				}
			} else {
				$this->session->set_flashdata('error', "Konfirmasi password baru tidak sama!!");
				redirect($this->agent->referrer());
			}
		} else {
			$this->session->set_flashdata('error', "Password lama anda salah !!");
			redirect($this->agent->referrer());
		}
	}

	function ubah_mailer()
	{
		if ($this->M_admin->ubah_mailer() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah data !!");
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah data !!");
			redirect($this->agent->referrer());
		}
	}

	function ubah_sosmed()
	{
		if ($this->M_admin->ubah_sosmed() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah data !!");
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah data !!");
			redirect($this->agent->referrer());
		}
	}

	function ubah_websiteInfo()
	{
		if ($this->M_admin->ubah_websiteInfo() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah data !!");
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah data !!");
			redirect($this->agent->referrer());
		}
	}

	function atur_daftarPenyelenggara()
	{
		if ($this->M_admin->atur_daftarPenyelenggara() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengatur daftar menu penyelenggara !!");
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengatur daftar menu penyelenggara !!");
			redirect($this->agent->referrer());
		}
	}

	// LOGO

	function ubah_logoFav()
	{
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

			if (!$this->upload->do_upload('LOGO_FAV')) {
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat meng-upload logo!!');
				redirect($this->agent->referrer());
			} else {

				$this->db->where('KEY', 'LOGO_FAV');
				$this->db->update('tb_pengaturan', array('VALUE' => $filename));
				$cek = ($this->db->affected_rows() != 1) ? false : true;
				if ($cek == TRUE) {
					$this->session->set_flashdata('success', 'Berhasil mengubah logo!!');
					redirect($this->agent->referrer());
				} else {
					$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah logo!");
					redirect($this->agent->referrer());
				}
			}
		} else {
			$this->session->set_flashdata('error', 'Harap pilih foto untuk dapat diupload!!');
			redirect($this->agent->referrer());
		}
	}

	function ubah_logoBlack()
	{
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

			if (!$this->upload->do_upload('LOGO_BLACK')) {
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat meng-upload logo!!');
				redirect($this->agent->referrer());
			} else {

				$this->db->where('KEY', 'LOGO_BLACK');
				$this->db->update('tb_pengaturan', array('VALUE' => $filename));
				$cek = ($this->db->affected_rows() != 1) ? false : true;
				if ($cek == TRUE) {
					$this->session->set_flashdata('success', 'Berhasil mengubah logo!!');
					redirect($this->agent->referrer());
				} else {
					$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah logo!");
					redirect($this->agent->referrer());
				}
			}
		} else {
			$this->session->set_flashdata('error', 'Harap pilih foto untuk dapat diupload!!');
			redirect($this->agent->referrer());
		}
	}

	function ubah_logoWhite()
	{
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

			if (!$this->upload->do_upload('LOGO_WHITE')) {
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat meng-upload logo!!');
				redirect($this->agent->referrer());
			} else {

				$this->db->where('KEY', 'LOGO_WHITE');
				$this->db->update('tb_pengaturan', array('VALUE' => $filename));
				$cek = ($this->db->affected_rows() != 1) ? false : true;
				if ($cek == TRUE) {
					$this->session->set_flashdata('success', 'Berhasil mengubah logo!!');
					redirect($this->agent->referrer());
				} else {
					$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah logo!");
					redirect($this->agent->referrer());
				}
			}
		} else {
			$this->session->set_flashdata('error', 'Harap pilih foto untuk dapat diupload!!');
			redirect($this->agent->referrer());
		}
	}

	// END LOGO

	// PROSES BUAT KEGIATAN
	function proses_buatKegiatan()
	{
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

			if (!$this->upload->do_upload('POSTER')) {
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat mengunggah Poster anda!!');
				redirect($this->agent->referrer());
			} else {
				if ($this->M_admin->proses_buatKegiatan($KODE_KEGIATAN, $filename) == TRUE) {

					// SAVE LOG
					$this->M_admin->log_aktivitasKpanel($this->session->userdata("kode_user"), 11, 3);

					$this->session->set_flashdata('success', 'Berhasil membuat kegiatan anda!!');
					redirect('kegiatanku');
				} else {
					$this->session->set_flashdata('error', "Terjadi kesalahan saat membuat kegiatan anda!");
					redirect($this->agent->referrer());
				}
			}
		} else {
			$this->session->set_flashdata('error', 'Harap pilih Poster untuk dapat diupload!!');
			redirect($this->agent->referrer());
		}
	}

	// END PROSES


	// TRANSAKSI GOES HERE
	public function data_transaksi($param = "")
	{
		// get total uang masuk
		$total_uang_masuk = $this->M_admin->sum_total_uang_masuk();
		$jumlah_transaksi = $this->M_admin->count_jumlah_transaksi();
		$jumlah_pembayaran_sukses = $this->M_admin->count_jumlah_pembyaran_sukses();
		
		$data['total_uang_masuk'] = $total_uang_masuk->total_uang_masuk;
		$data['jumlah_transaksi'] = $jumlah_transaksi->jumlah_transaksi;
		$data['jumlah_pembayaran_sukses'] = $jumlah_pembayaran_sukses->jumlah_pembayaran_sukses;
		if ($param == "tim") {
			$data['transaksi'] = $this->M_admin->data_transaksi_tim();
			$data['stat_pay'] = $this->M_admin->get_all_status_payment();
			$data['ci'] = $this;

			$data['module'] 	= "admin";
			$data['fileview'] 	= "data_transaksi_pertim";
		} else {
			$data['transaksi'] = $this->M_admin->data_transaksi();
			$data['stat_pay'] = $this->M_admin->get_all_status_payment();
			$data['ci'] = $this;

			$data['module'] 	= "admin";
			$data['fileview'] 	= "data_transaksi";
		}

		echo Modules::run('template/backend_main', $data);
	}

	public function get_details_tim_payment($param = "") // for ajax
	{
		if ($param != "") {
			$this->load->model('payment/M_payment');
			$transaksi = $this->M_payment->get_transaksi_by_id($param);
			if ($transaksi != false) {
				$data['fee'] = $transaksi->TOT_BAYAR - $transaksi->BAYAR;
				$data['total_bayar'] = $transaksi->TOT_BAYAR;
				$data['total_team'] = $this->M_payment->get_total_team_and_biaya($transaksi->KODE_TRANS);
				$data['tim']        = $this->M_payment->get_tim($transaksi->KODE_TRANS);

				$data['module'] 	= "admin";
				$data['fileview'] 	= "detail_payment";
				echo Modules::run('template/blank_template', $data);
			}
		}
	}

	public function update_status_transaksi($kode_trans = "")
	{
		if ($kode_trans != "") {
			$this->load->model('payment/M_payment');
			$transaksi = $this->M_payment->get_transaksi_by_id($kode_trans);
			if ($transaksi != false) {
				$kode_trans = $transaksi->KODE_TRANS;
				// update tb transaksi
				$data_payment['STAT_PAY'] = $this->input->post('status_transaksi');
				$this->M_payment->update_pay_by_kode_trans($kode_trans, $data_payment);

				// update tb payment
				$data_transaksi['STAT_BAYAR'] = $this->input->post('status_transaksi');
				$this->M_payment->update_transaksi($kode_trans, $data_transaksi);

				$this->session->set_flashdata('success', "Status pembayaran #" . $kode_trans . " berhasil diperbarui!");
				redirect($this->agent->referrer());
			} else {
				$this->session->set_flashdata('error', "Kode Transaksi tidak ditemukan!!");
				redirect($this->agent->referrer());
			}
		} else {
			redirect($this->agent->referrer());
		}
	}

	public function delete_transaksi($kode_trans = "")
	{
		if ($kode_trans != "") {
			$this->load->model('payment/M_payment');
			$transaksi = $this->M_payment->get_transaksi_by_id($kode_trans);
			if ($transaksi != false) {
				$delete_transaksi = $this->M_payment->delete_transaksi($kode_trans);
				if ($delete_transaksi == true) {
					$this->session->set_flashdata('success', "Berhasil menghapus Transaksi # " . $kode_trans);
					redirect($this->agent->referrer());
				} else {
					$this->session->set_flashdata('error', "Terjadi kesalahan, gagal menghapus transaksi!");
					redirect($this->agent->referrer());
				}
			} else {
				$this->session->set_flashdata('error', "Kode Transaksi tidak ditemukan!!");
				redirect($this->agent->referrer());
			}
		} else {
			$this->session->set_flashdata('error', "Kode Transaksi tidak ditemukan!!");
			redirect($this->agent->referrer());
		}
	}
	
	public function get_seleksiTIM($id_bidang = 0, $tim = 0, $id_tahap = 0){
		if ($id_tahap == 0) {
			$this->load->view('ajax/ajax_seleksi404');
		}else{
	        $bidang_lomba = $this->M_koordinator->get_bidangLomba_by_id($id_bidang);
	        if($bidang_lomba == false){
	            $data['max_tim']	= $tim;
	            $data['tahap']		= $id_tahap;
				$data['tim']		= $this->M_admin->get_seleksiTIM($param = 1, $id_bidang, $id_tahap);
	        }else{
	            $data['id_bidang'] 	= $bidang_lomba->BIDANG_LOMBA;
	            $data['max_tim']	= $tim;
	            $data['tahap']		= $id_tahap;
				$data['tim']		= $this->M_admin->get_seleksiTIM($param = 1, $bidang_lomba->ID_BIDANG, $id_tahap);
	        }

	        $data['CI']			= $this;
			$data['module'] 	= "admin";
			$data['fileview'] 	= "ajax/ajax_tableSeleksi";
			echo Modules::run('template/blank_template', $data);
		}
	}
	
	public function hasil_seleksi($param = 0){

        $bidang_lomba = $this->M_koordinator->get_bidangLomba_by_id($param);
        if($bidang_lomba == false){
            $data['all_bidang_lomba'] 	= $this->M_koordinator->get_bidangLomba();
            $data['bidang_lomba'] 		= "Semua";
            $data['id_bidang'] 			= 0;
			$data['tahap']		= $this->M_admin->get_tahapPenilaian();
			$data['tim']		= $this->M_admin->get_daftarTIM($param = 0, $id_bidang = 0, $id_tahap = 0);
        }else{
            $data['all_bidang_lomba'] 	= $this->M_koordinator->get_bidangLomba();
            $data['bidang_lomba'] 		= $bidang_lomba->BIDANG_LOMBA;
            $data['id_bidang'] 			= $bidang_lomba->ID_BIDANG;
			$data['tahap']		= $this->M_admin->get_tahapPenilaian();
			$data['tim']		= $this->M_admin->get_daftarTIM($param = 0, $bidang_lomba->ID_BIDANG, $id_tahap = 0);
        }


        $data['CI']			= $this;
		$data['module'] 	= "admin";
		$data['fileview'] 	= "hasil_seleksi";
		echo Modules::run('template/backend_main', $data);
	}
	
	public function seleksi($param = 1){

        $bidang_lomba = $this->M_koordinator->get_bidangLomba_by_id($param);
        if($bidang_lomba == false){
            $data['all_bidang_lomba'] 	= $this->M_koordinator->get_bidangLomba();
            $data['bidang_lomba'] 		= "Semua";
            $data['id_bidang'] 			= 0;
			$data['tahap']		= $this->M_admin->get_tahapPenilaian();
			$data['tim']		= $this->M_admin->get_daftarTIM($param, $id_bidang = 0, $id_tahap = 1);
        }else{
            $data['all_bidang_lomba'] 	= $this->M_koordinator->get_bidangLomba();
            $data['bidang_lomba'] 		= $bidang_lomba->BIDANG_LOMBA;
            $data['id_bidang'] 			= $bidang_lomba->ID_BIDANG;
			$data['tahap']		= $this->M_admin->get_tahapPenilaian();
			$data['tim']		= $this->M_admin->get_daftarTIM($param, $bidang_lomba->ID_BIDANG, $id_tahap = 1);
        }


        $data['CI']			= $this;
		$data['module'] 	= "admin";
		$data['fileview'] 	= "seleksi";
		echo Modules::run('template/backend_main', $data);
	}

	function seleksi_tim(){
		$kodePendaftaran	= explode(',', $_POST['KODE_PENDAFTARAN']);
		$tahap				= $_POST['KE_TAHAP'];
		$dataStoreOrd		= array();
		
		foreach ($kodePendaftaran as $item) {		
			$this->M_admin->seleksi_tim($item, $tahap);
		}

		$this->session->set_flashdata('success', "Berhasil menyeleksi tim kedalam tahap yang ditentukan!");
		redirect(site_url('admin/seleksi'));
	}

	function body_html($message){
		return '
		<html>

		<head>
		<title>Lo Kreatif</title>
		</head>

		<body style="
		font-family: -webkit-pictograph;
		color: #333333;
		font-size: 16px;
		background:#EEEEEE;">
		<div style="margin: 0 auto 0 auto; width: 560px;">
		<div style="padding-top: 55px; text-align : center;">
		<div style="font-weight: 700;font-size: 32px;">
		<span style="font-size: 32px; ">LO-KREATIF</span>
		</div>
		</div>
		<div style="background: white">
		<main><div style="margin-top: 32px;">
		<div style="height: 12px; background: #0B4C8A;"></div>
		<div style="margin: 32px 56px 0 56px">
		<div>
		<span style="font-size: 16px;">
		'.$message.'
		<br><br><br>
		<span class="text-muted">Regards,<br>LO Kreatif</span>
		</span>
		</div>
		</div>
		</div>

		</main>
		<hr style="
		width: 513px; 
		margin-top: 34px;
		border-top: 1px solid #cecece; 
		border-bottom: none;" />
		<div>
		<div style="margin: 32px 56px 0 56px">
		<div style="margin-top: 32px">
		<img style="margin: auto;display: block;" src="https://i.ibb.co/XtvzJBX/icon-ts.png" width="75px" height="auto" alt="LO Kreatif logo">
		<div style="text-align: center; font-size: 10px; margin-top:10px">LO-KREATIF 2021</div>
		</div>
		</div>
		</div>
		<hr style="border-top: 1px dashed #CECECE; margin-top: 24px; border-bottom: none;">
		<div style="margin-top: 13px; text-align : center; font-size:10px;">This email has been generated
		automatically, please do not reply.</div>
		<div style="height: 12px; background: #0B4C8A; margin-top:10px;"></div>
		</div>
		</body>
		';
	}

}?>

