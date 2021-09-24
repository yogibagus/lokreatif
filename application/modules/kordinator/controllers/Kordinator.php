<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kordinator extends MX_Controller
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

        $this->load->model('General');
        $this->load->model('M_kordinator');
    }

    public function index(){
        echo "tes";

    }

    public function verifikasi_berkas()
    {
        $data['cek_form']         = $this->M_kordinator->cek_form();
        $data['get_form']         = $this->M_kordinator->get_formBerkas();

        $data['get_pendaftaran']  = $this->M_kordinator->get_dataPendaftaran();

        $data['module']     = "kordinator";
        $data['fileview']   = "verifikasi_berkas";
        echo Modules::run('template/backend_main', $data);
    }

    function terima_pendaftaran()
    {
        $nama_tim = $this->input->post('NAMA_TIM');
        if ($this->M_kordinator->terima_pendaftaran() == TRUE) {

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
        if ($this->M_kordinator->tolak_pendaftaran() == TRUE) {

            $this->session->set_flashdata('success', "Berhasil menolak data pendaftaran TIM {$nama_tim} !!");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', "Terjadi kesalahan saat menolak data pendaftaran TIM {$nama_tim}!");
            redirect($this->agent->referrer());
        }
    }


}
