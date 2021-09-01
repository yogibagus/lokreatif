<?php

class Cronjob extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_Cronjob');
        $this->load->library('transaksi');
    }
    public function index(){
        print('ilham');
    }
    public function cek_refund(){
        $jmlTimUniv = $this->M_Cronjob->get_countTimUniv();
        foreach ($jmlTimUniv as $item) {
            $biayaUpdate    = $this->General->get_biayaDaftar($item->TOTAL_TIM);
            $transRefund    = $this->M_Cronjob->get_dataRefund($biayaUpdate, $item->kodept);

            if($transRefund != null){
                $dataStoreRefund = array();
                foreach ($transRefund as $item2) {
                    $temp['KODE_REFUND'] = $this->transaksi->gen_kodeRefund();
                    $temp['KODE_TRANS']  = $item2->KODE_TRANS;
                    $temp['JML_REFUND']  = $item2->REFUND;
                    array_push($dataStoreRefund, $temp);
                }
                $this->M_Cronjob->insert_refund($dataStoreRefund);
            }

            $this->M_Cronjob->update_biayaTim($biayaUpdate, $item->kodept);
        }
    }
}