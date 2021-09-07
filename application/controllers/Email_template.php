<?php

class Email_template extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('General');
        $this->load->model('payment/M_payment');
    }

    public function default_auth($message)
    {
        $data['message']    = $message;
        $this->load->view('email/header');
        $this->load->view('email/auth', $data);
        $this->load->view('email/footer');
    }

    public function send_invoice($param = "")
    {
        $transaksi = $this->M_payment->get_transaksi_by_id($param);
        $payment = $this->M_payment->get_payment_by_kode_trans($param);
        $status = $this->M_payment->get_status_payment_by_stat_pay($payment->STAT_PAY);
        if ($payment != false) {
            if ($transaksi->ROLE_USER_BILL == 3) {
                $user = $this->M_payment->get_univ_by_id($transaksi->KODE_USER_BILL);
                $nama = $user->namapt;
            } else {
                $user = $this->General->get_akun($transaksi->KODE_USER_BILL);
                $nama = $user->NAMA;
            }
            $data['status'] = $status;
            $data['nama'] = $nama;
            $data['payment']    = $payment;
            $this->load->view('email/header');
            $this->load->view('email/invoice', $data);
            $this->load->view('email/footer');
        }
    }
}
