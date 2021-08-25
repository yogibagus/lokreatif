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

    // MORE IN THE FUTURE
}?>
