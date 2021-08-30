<?php

class Webhook extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payment/M_payment');
    }
    public function index()
    {
        redirect();
    }

    public function callback()
    {
        $data = file_get_contents('php://input');
        $action = json_decode($data, false);
        $data_log['CONTENT_LOG'] = $data;
        $this->M_payment->insert_log_webhook($data_log);
    }
}
