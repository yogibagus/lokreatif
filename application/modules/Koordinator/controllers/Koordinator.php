<?php
defined('BASEPATH') or exit('No direct script access allowed');

class koordinator extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        // get session
        $this->kode_user = $this->session->userdata('kode_user');
        $this->email = $this->session->userdata('email');
        $this->nama = $this->session->userdata('nama');
        $this->role = $this->session->userdata('role');
        $this->logged_in = $this->session->userdata('logged_in');

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
            if($this->session->userdata("role") != 4){
                $this->session->set_flashdata('error', "Mohon maaf hak akses anda bukan admin");
                redirect('peserta');
            }
        }

        $this->load->model('General');
        $this->load->model('M_koordinator');
        $this->load->model('admin/M_admin');
        $this->load->model('manage_kompetisi/M_manageKompetisi');
    }

    public function index(){
        echo "tes";

    }

    public function verifikasi_berkas($param = "0")
    {   
        // if admin
        if($this->role == 0){
            $bidang_lomba = $this->M_koordinator->get_bidangLomba_by_id($param);
            if($bidang_lomba == false){
                $data['all_bidang_lomba'] = $this->M_koordinator->get_bidangLomba();
                $data['bidang_lomba'] = "Semua";
                $data["jumlah_tim"] =  $this->M_koordinator->get_jumlah_tim()->jumlah_tim;
                $data['jumlah_berkas_belum_terverifikasi'] = $this->M_koordinator->get_jumlah_berkas_belum_terverifikasi()->jumlah_berkas_belum_terverifikasi;;
                $data['jumlah_berkas_terverifikasi'] = $this->M_koordinator->get_jumlah_berkas_terverifikasi()->jumlah_berkas_terverifikasi;;
                $data['jumlah_berkas_ditolak'] = $this->M_koordinator->get_jumlah_berkas_ditolak()->jumlah_berkas_ditolak;;
                $data['get_pendaftaran']  = $this->M_koordinator->get_dataPendaftaran();
            }else{
                $data['all_bidang_lomba'] = $this->M_koordinator->get_bidangLomba();
                $data['bidang_lomba'] = $bidang_lomba->BIDANG_LOMBA;
                $data["jumlah_tim"] =  $this->M_koordinator->get_jumlah_tim($bidang_lomba->ID_BIDANG)->jumlah_tim;
                $data['jumlah_berkas_belum_terverifikasi'] = $this->M_koordinator->get_jumlah_berkas_belum_terverifikasi($bidang_lomba->ID_BIDANG)->jumlah_berkas_belum_terverifikasi;
                $data['jumlah_berkas_terverifikasi'] = $this->M_koordinator->get_jumlah_berkas_terverifikasi($bidang_lomba->ID_BIDANG)->jumlah_berkas_terverifikasi;
                $data['jumlah_berkas_ditolak'] = $this->M_koordinator->get_jumlah_berkas_ditolak($bidang_lomba->ID_BIDANG)->jumlah_berkas_ditolak;
                $data['get_pendaftaran']  = $this->M_koordinator->get_dataPendaftaran_by_bidang_lomba($bidang_lomba->ID_BIDANG);
            }
        }else{
            $koordinator = $this->M_koordinator->get_koordinator_by_kode_user($this->kode_user);
            $data['bidang_lomba'] = $koordinator->BIDANG_LOMBA;
            $data["jumlah_tim"] = $this->M_koordinator->get_jumlah_tim($koordinator->ID_BIDANG)->jumlah_tim;
            $data['jumlah_berkas_belum_terverifikasi'] = $this->M_koordinator->get_jumlah_berkas_belum_terverifikasi($koordinator->ID_BIDANG)->jumlah_berkas_belum_terverifikasi;
            $data['jumlah_berkas_terverifikasi'] = $this->M_koordinator->get_jumlah_berkas_terverifikasi($koordinator->ID_BIDANG)->jumlah_berkas_terverifikasi;
            $data['jumlah_berkas_ditolak'] = $this->M_koordinator->get_jumlah_berkas_ditolak($koordinator->ID_BIDANG)->jumlah_berkas_ditolak;
            $data['get_pendaftaran']  = $this->M_koordinator->get_dataPendaftaran_by_bidang_lomba($koordinator->ID_BIDANG);
        }
        $data['cek_form']         = $this->M_koordinator->cek_form();
        $data['get_form']         = $this->M_koordinator->get_formBerkas();
        $data['CI']               = $this;

        $data['module']     = "koordinator";
        $data['fileview']   = "verifikasi_berkas";
        echo Modules::run('template/backend_main', $data);
    }

    public function hasil_penilaian($tahap = 0){

        $data['tahap']              = $this->M_admin->get_tahapPenilaian();
        $koordinator                = $this->M_koordinator->get_koordinator_by_kode_user($this->kode_user);
        $tahap_penilaian            = $this->M_manageKompetisi->get_tahapLomba_by_id($tahap);

        if($tahap == false){
            $data['tahap_penilaian']    = "Pilih Tahap";
        }else{
            $data['tahap_penilaian']    = $tahap_penilaian->NAMA_TAHAP;
        }

        if($koordinator->BIDANG_LOMBA == false){
            $data['bidang_lomba']       = "Semua";
        }else{
            $data['bidang_lomba']       = $koordinator->BIDANG_LOMBA;
        }
        $data['id_tahap']   = $tahap;
        $data['id_bidang']  = $koordinator->ID_BIDANG;

        $data['tim']        = $this->M_manageKompetisi->get_hasilPenilaian($tahap, $koordinator->ID_BIDANG);

        $data['CI']         = $this;

        $data['module']     = "koordinator";
        $data['fileview']   = "hasil_penilaian";
        echo Modules::run('template/backend_main', $data);
    }

    function terima_pendaftaran()
    {
        $nama_tim = $this->input->post('NAMA_TIM');
        if ($this->M_koordinator->terima_pendaftaran() == TRUE) {

            $this->session->set_flashdata('success', "Berhasil verifikasi data pendaftaran TIM {$nama_tim} !!");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', "Terjadi kesalahan saat verifikasi data pendaftaran TIM {$nama_tim}!");
            redirect($this->agent->referrer());
        }
    }

    function tolak_pendaftaran()
    {
        $nama_tim = $this->input->post('NAMA_TIM');
        if ($this->M_koordinator->tolak_pendaftaran() == TRUE) {

            $this->session->set_flashdata('success', "Berhasil menolak data pendaftaran TIM {$nama_tim} !!");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', "Terjadi kesalahan saat menolak data pendaftaran TIM {$nama_tim}!");
            redirect($this->agent->referrer());
        }
    }

    // AJAX GOES HERE

    function tampil_anggota_tim($kode_pendaftaran = "")
    {   
        $anggota = $this->M_koordinator->get_anggota_tim($kode_pendaftaran);
        if($anggota != false){
            $data['anggota'] = $anggota;
            $data['module']     = "koordinator";
            $data['fileview']     = "ajax/tampil_anggota_tim";
            echo Modules::run('template/blank_template', $data);
        }else{
            $data['tim'] = $this->M_koordinator->get_pendaftaran_by_kode_pendaftaran($kode_pendaftaran);
            $data['anggota'] = false;
            $data['module']     = "koordinator";
            $data['fileview']     = "ajax/tampil_anggota_tim";
            echo Modules::run('template/blank_template', $data);
        }
    }

    function tampil_berkas_tim($kode_pendaftaran = "")
    {
        $berkas = $this->M_koordinator->get_karya_by_kode_pendaftaran($kode_pendaftaran);
        if ($berkas != false) {
            $data['berkas'] = $berkas;
            $data['module']     = "koordinator";
            $data['fileview']     = "ajax/tampil_berkas_tim";
            echo Modules::run('template/blank_template', $data);
        } else {
            $data['berkas'] = false;
            $data['module']     = "koordinator";
            $data['fileview']     = "ajax/tampil_berkas_tim";
            echo Modules::run('template/blank_template', $data);
        }
    }

    function tampil_surat($kode_pendaftaran = "", $id = "")
    {
        $form = $this->M_koordinator->get_formData($kode_pendaftaran, $id);
        if ($form != false) {
            $data['form'] = $form;
            $data['pendaftaran'] = $this->M_koordinator->get_pendaftaran_by_kode_pendaftaran($kode_pendaftaran);
            $data['module']     = "koordinator";
            $data['fileview']     = "ajax/tampil_surat";
            echo Modules::run('template/blank_template', $data);
        } else {
            $data['form'] = false;
            $data['module']     = "koordinator";
            $data['fileview']     = "ajax/tampil_surat";
            echo Modules::run('template/blank_template', $data);
        }
    }


}


