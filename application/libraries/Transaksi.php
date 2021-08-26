<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi{
  public function __construct(){
    $this->_ci = &get_instance();
    $this->_ci->load->database();
    }

    // GENERATE KODE TRANSAKSI

    function cek_kodeTransaksi($KODE_TRANS){
        $query  = $this->_ci->db->get_where("tb_transaksi", array('KODE_TRANS' => $KODE_TRANS));
        return $query->num_rows();
    }

    public function gen_kodeTrans(){
        do {
         $time           = substr(md5(time()), 0, 6);
         $KODE_TRANS     = "TRAN_{$time}";
        } while ($this->cek_kodeTransaksi($KODE_TRANS) > 0);

        return $KODE_TRANS;
    }

    // GENERATE KODE REFUND

    function cek_kodeRefund($KODE_REFUND){
        $query  = $this->_ci->db->get_where("tb_refund", array('KODE_REFUND' => $KODE_REFUND));
        return $query->num_rows();
    }

    public function gen_kodeTrans(){
        do {
         $time           = substr(md5(time()), 0, 6);
         $KODE_REFUND     = "REFD_{$time}";
        } while ($this->cek_kodeRefund($KODE_REFUND) > 0);

        return $KODE_REFUND;
    }

    // MORE IN THE FUTURE
}?>
