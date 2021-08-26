<?php defined('BASEPATH') or exit('No direct script access allowed');

class Generatepay
{
    public function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->database();
    }

    // GENERATE KODE TRANSAKSI

    function cek_kodePay($KODE_PAY)
    {
        $query  = $this->_ci->db->get_where("tb_payment", array('KODE_PAY' => $KODE_PAY));
        return $query->num_rows();
    }

    public function gen_kodePay()
    {
        do {
            $time           = substr(md5(time()), 0, 6);
            $KODE_PAY     = "PAY_{$time}";
        } while ($this->cek_kodePay($KODE_PAY) > 0);

        return $KODE_PAY;
    }

    // MORE IN THE FUTURE
}
