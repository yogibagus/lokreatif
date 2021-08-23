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
      if ($this->M_manage->tambah_juri() == TRUE) {
        $this->session->set_flashdata('success', "Berhasil menambahkan data juri !!");
        redirect($this->agent->referrer());
      }else{
        $this->session->set_flashdata('error', "Terjadi kesalahan saat menambahkan data juri !!");
        redirect($this->agent->referrer());
      }
    }else{
      $this->session->set_flashdata('error', "Password yang anda masukkan tidak sama !!");
      redirect($this->agent->referrer());
    }
  }
  
  function edit_juri(){
    if ($this->M_manage->edit_juri() == TRUE) {
      $this->session->set_flashdata('success', "Berhasil mengubah data juri !!");
      redirect($this->agent->referrer());
    }else{
      $this->session->set_flashdata('error', "Terjadi kesalahan saat mengubah data juri !!");
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
    $data['get_form']         = $this->M_manage->get_formBerkas();

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

  public function hasil_penilaian(){

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
  // END PROSES
}
