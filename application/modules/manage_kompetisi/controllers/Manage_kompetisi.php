<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_kompetisi extends MX_Controller {
	public function __construct(){
		parent::__construct();

		if ($this->agent->is_mobile()) {
			$this->session->set_flashdata('error', "PANEL HANYA DAPAT DIAKSES MELALUI BROWSER");
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

		$this->load->model('M_manageKompetisi', 'M_manage');
		$this->load->model('admin/M_admin');
        $this->load->model('juri/M_juri');
		$this->load->model('koordinator/M_koordinator');
	}

  // BIDANG LOMBA

	public function bidang_lomba(){

		$data['bidang_lomba'] = $this->M_manage->get_bidangLomba();

		$data['module']     = "manage_kompetisi";
		$data['fileview']   = "kompetisi/bidang_lomba";
		echo Modules::run('template/backend_main', $data);
	}

  //PROSES

	function tambah_bidangLomba(){
		if ($this->M_manage->tambah_bidangLomba() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil menambahkan data bidang lomba !!");
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menambahkan data bidang lomba !!");
			redirect($this->agent->referrer());
		}
	}

	function edit_bidangLomba(){
		if ($this->M_manage->edit_bidangLomba() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah data bidang lomba !!");
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah data bidang lomba !!");
			redirect($this->agent->referrer());
		}
	}

	function hapus_bidangLomba(){
		if ($this->M_manage->hapus_bidangLomba() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil menghapus data bidang lomba !!");
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menghapus data bidang lomba !!");
			redirect($this->agent->referrer());
		}
	}

  // END BIDANG LOMBA

  // DATA JURI

	public function data_juri(){

		$data['bidang_lomba'] = $this->M_manage->get_bidangLomba();
		$data['data_juri']    = $this->M_manage->get_dataJuri();
		$data['CI']           = $this;

		$data['module']     = "manage_kompetisi";
		$data['fileview']   = "data_juri";
		echo Modules::run('template/backend_main', $data);
	}

  //PROSES

	function tambah_juri(){
		if ($this->input->post('PASSWORD') == $this->input->post('CONFIRM_PASSWORD')) {


      // CREATE UNIQ NAME KODE USER

			$string = preg_replace('/[^a-z]/i', '', $this->input->post("NAMA_JURI"));

			$vocal  = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " ");
			$scrap  = str_replace($vocal, "", $string);
			$begin  = substr($scrap, 0, 4);
			$uniqid = strtoupper($begin);

      // CREATE KODE USER
			do {
				$KODE_USER      = "JRI_".$uniqid.substr(md5(time()), 0, 3);
			} while ($this->M_manage->cek_kodeUser($KODE_USER) > 0);

          // UPLOAD
			if (!empty($_FILES['PROFIL']['name'])) {

				$folder   = "berkas/juri/{$KODE_USER}/";

				if (!is_dir($folder)) {
					mkdir($folder, 0755, true);
				}

              // UPLOAD FILE
				$config['upload_path']        = $folder;
				$config['allowed_types']      = 'png|jpg|jpeg|gif';
				$config['max_size']           = 10*1024;
				$config['overwrite']          = TRUE;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('PROFIL')){
					$this->session->set_flashdata('error', 'Terjadi kesalahan saat mengunggah foto!!');
					redirect($this->agent->referrer());
				}else {
					$upload_data = $this->upload->data();

					if ($this->M_manage->tambah_juri($KODE_USER, $upload_data['file_name']) == TRUE) {
						$this->session->set_flashdata('success', "Berhasil menambahkan data juri !!");
						redirect($this->agent->referrer());
					}else{
						$this->session->set_flashdata('error', "Terjadi kesalahan saat menambahkan data juri !!");
						redirect($this->agent->referrer());
					}
				}
			}else {

				if ($this->M_manage->tambah_juri($KODE_USER, null) == TRUE) {
					$this->session->set_flashdata('success', "Berhasil menambahkan data juri !!");
					redirect($this->agent->referrer());
				}else{
					$this->session->set_flashdata('error', "Terjadi kesalahan saat menambahkan data juri !!");
					redirect($this->agent->referrer());
				}
			}
		}else{
			$this->session->set_flashdata('error', "Password yang anda masukkan tidak sama !!");
			redirect($this->agent->referrer());
		}
	}

	function edit_juri(){
		if (!empty($_FILES['NEW_PROFIL']['name'])) {
			$KODE_USER = $this->input->post('KODE_USER');
			$folder   = "berkas/juri/{$KODE_USER}/";

			if (!is_dir($folder)) {
				mkdir($folder, 0755, true);
			}

              // UPLOAD FILE
			$config['upload_path']        = $folder;
			$config['allowed_types']      = 'png|jpg|jpeg|gif';
			$config['max_size']           = 10*1024;
			$config['overwrite']          = TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('NEW_PROFIL')){
				$this->session->set_flashdata('error', 'Terjadi kesalahan saat mengunggah foto!!');
				redirect($this->agent->referrer());
			}else {
				$upload_data = $this->upload->data();

				if ($this->M_manage->edit_juri($upload_data['file_name']) == TRUE) {
					$this->session->set_flashdata('success', "Berhasil mengubah data juri !!");
					redirect($this->agent->referrer());
				}else{
					$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah data juri !!");
					redirect($this->agent->referrer());
				}
			}
		}else {
			if ($this->M_manage->edit_juri($this->input->post('PROFIL')) == TRUE) {
				$this->session->set_flashdata('success', "Berhasil mengubah data juri !!");
				redirect($this->agent->referrer());
			}else{
				$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah data juri !!");
				redirect($this->agent->referrer());
			}
		}
	}

	function pass_juri(){
		if ($this->M_manage->pass_juri() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah password juri !!");
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah password juri !!");
			redirect($this->agent->referrer());
		}
	}

	function hapus_juri(){
		if ($this->M_manage->hapus_juri() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil menghapus data juri !!");
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menghapus data juri !!");
			redirect($this->agent->referrer());
		}
	}

  // END DATA JURI

  // TAHAP PENILAIAN

	public function tahap_penilaian(){
		$data['tahap_penilaian']  = $this->M_manage->get_tahapPenilaian();

		$data['module']     = "manage_kompetisi";
		$data['fileview']   = "kompetisi/tahap_penilaian";
		echo Modules::run('template/backend_main', $data);
	}

  //PROSES

	function tambah_tahap(){
		if ($this->M_manage->tambah_tahap() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil menambahkan tahap penilaian !!");
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menambahkan tahap penilaian !!");
			redirect($this->agent->referrer());
		}
	}

	function edit_tahap(){
		if ($this->M_manage->edit_tahap() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah tahap penilaian !!");
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah tahap penilaian !!");
			redirect($this->agent->referrer());
		}
	}

	function update_status_tahap(){
		if ($this->M_manage->update_status_tahap() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah status tahap penilaian !!");
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah status tahap penilaian !!");
			redirect($this->agent->referrer());
		}
	}

	function hapus_tahap(){
		if ($this->M_manage->hapus_tahap() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil menghapus tahap penilaian !!");
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menghapus tahap penilaian !!");
			redirect($this->agent->referrer());
		}
	}

  // END TAHAP PENILAIAN

  // KRITERIA PENILAIAN

	public function kriteria_penilaian(){
		$data['tahap_penilaian']  = $this->M_manage->get_tahapPenilaian();
		$data['bidang_lomba']     = $this->M_manage->get_bidangLomba();
		$data['CI']               = $this;

		$data['module']     = "manage_kompetisi";
		$data['fileview']   = "kompetisi/kriteria_penilaian";
		echo Modules::run('template/backend_main', $data);
	}

	public function data_kriteria($id_tahap, $id_bidang){
		$data['kriteria_penilaian']     = $this->M_manage->get_kriteriaPenilaian($id_tahap, $id_bidang);

		$data['id_tahap']   = $id_tahap;
		$data['id_bidang']  = $id_bidang;

		$data['module']     = "manage_kompetisi";
		$data['fileview']   = "kompetisi/kriteria_data";
		echo Modules::run('template/backend_main', $data);
	}

  //PROSES

	function tambah_kriteria($id_tahap, $id_bidang){
		if ($this->M_manage->tambah_kriteria($id_tahap, $id_bidang) == TRUE) {
			$this->session->set_flashdata('success', "Berhasil menambahkan kriteria penilaian !!");
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menambahkan kriteria penilaian !!");
			redirect($this->agent->referrer());
		}
	}

	function edit_kriteria(){
		if ($this->M_manage->edit_kriteria() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil mengubah kriteria penilaian !!");
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah kriteria penilaian !!");
			redirect($this->agent->referrer());
		}
	}

	function hapus_kriteria(){
		if ($this->M_manage->hapus_kriteria() == TRUE) {
			$this->session->set_flashdata('success', "Berhasil menghapus kriteria penilaian !!");
			redirect($this->agent->referrer());
		}else{
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menghapus kriteria penilaian !!");
			redirect($this->agent->referrer());
		}
	}

  // END KRITERIA PENILAIAN

  //PENDAFTARAN

	public function atur_pendaftaran(){
		$data['cek_form']   = $this->M_manage->cek_form();
		$data['get_form']   = $this->M_manage->get_form();

		$data['CI']         = $this;

		$data['module']     = "manage_kompetisi";
		$data['fileview']   = "pendaftaran/atur_pendaftaran";
		echo Modules::run('template/backend_main', $data);
	}

	public function data_peserta(){
		$data['cek_form']         = $this->M_manage->cek_form();
		$data['get_form']         = $this->M_manage->get_form();

		$data['get_pendaftaran']  = $this->M_manage->get_dataPendaftaran();

		$data['module']     = "manage_kompetisi";
		$data['fileview']   = "pendaftaran/data_peserta";
		echo Modules::run('template/backend_main', $data);
	}

	public function verifikasi_berkas(){
		$data['cek_form']         = $this->M_manage->cek_form();
		$data['get_form']         = $this->M_manage->get_formBerkas();

		$data['get_pendaftaran']  = $this->M_manage->get_dataPendaftaran();

		$data['module']     = "manage_kompetisi";
		$data['fileview']   = "pendaftaran/verifikasi_berkas";
		echo Modules::run('template/backend_main', $data);
	}

	public function hasil_penilaian($tahap = 0, $bidang = 0){

		$data['tahap']				= $this->M_admin->get_tahapPenilaian();
        $data['all_bidang_lomba'] 	= $this->M_koordinator->get_bidangLomba();
        $bidang_lomba 				= $this->M_koordinator->get_bidangLomba_by_id($bidang);
        $tahap_penilaian 			= $this->M_manage->get_tahapLomba_by_id($tahap);

        if($tahap == false){
            $data['tahap_penilaian'] 	= "Pilih Tahap";
        }else{
            $data['tahap_penilaian'] 	= $tahap_penilaian->NAMA_TAHAP;
        }

        if($bidang_lomba == false){
            $data['bidang_lomba'] 		= "Semua";
        }else{
            $data['bidang_lomba'] 		= $bidang_lomba->BIDANG_LOMBA;
        }
        
        $data['id_tahap'] 	= $tahap;
        $data['id_bidang'] 	= $bidang;

		$data['tim']		= $this->M_manage->get_hasilPenilaian($tahap, $bidang);

        $data['CI']			= $this;

		$data['module']     = "manage_kompetisi";
		$data['fileview']   = "kompetisi/hasil_penilaian";
		echo Modules::run('template/backend_main', $data);
	}

  //PROSES

	function proses_aturPendaftaran(){
		if ($this->M_manage->proses_aturPendaftaran() == TRUE)  {

			$this->session->set_flashdata('success', "Berhasil mengatur form pendaftaran !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat mengatur form pendaftaran!");
			redirect($this->agent->referrer());
		}
	}

	function proses_deletePendaftaran(){
		if ($this->M_manage->proses_deletePendaftaran() == TRUE)  {

			$this->session->set_flashdata('success', "Berhasil menghapus form pendaftaran !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menghapus form pendaftaran!");
			redirect($this->agent->referrer());
		}
	}

	function terima_pendaftaran(){
		$nama_tim = $this->input->post('NAMA_TIM');
		if ($this->M_manage->terima_pendaftaran() == TRUE)  {

			$this->session->set_flashdata('success', "Berhasil verifikasi data pendaftaran TIM {$nama_tim} !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat verifikasi data pendaftaran TIM {$nama_tim}!");
			redirect($this->agent->referrer());
		}
	}

	function tolak_pendaftaran(){
		$nama_tim = $this->input->post('NAMA_TIM');
		if ($this->M_manage->tolak_pendaftaran() == TRUE)  {

			$this->session->set_flashdata('success', "Berhasil menolak data pendaftaran TIM {$nama_tim} !!");
			redirect($this->agent->referrer());
		}else {
			$this->session->set_flashdata('error', "Terjadi kesalahan saat menolak data pendaftaran TIM {$nama_tim}!");
			redirect($this->agent->referrer());
		}
	}
  // END PROSES
}
