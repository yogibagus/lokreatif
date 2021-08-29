<?php defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi
{
    public function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->database();
    }

    // GENERATE KODE TRANSAKSI

    function cek_kodeTransaksi($KODE_TRANS)
    {
        $query  = $this->_ci->db->get_where("tb_transaksi", array('KODE_TRANS' => $KODE_TRANS));
        return $query->num_rows();
    }

    public function gen_kodeTrans()
    {
        do {
            $time           = substr(md5(time()), 0, 6);
            $KODE_TRANS     = "TRAN_{$time}";
        } while ($this->cek_kodeTransaksi($KODE_TRANS) > 0);

        return $KODE_TRANS;
    }

    // GENERATE KODE REFUND

    function cek_kodeRefund($KODE_REFUND)
    {
        $query  = $this->_ci->db->get_where("tb_refund", array('KODE_REFUND' => $KODE_REFUND));
        return $query->num_rows();
    }

    public function gen_kodeRefund()
    {
        do {
            $time           = substr(str_shuffle(substr('abcdefghijklmnopqrstuvwxyz1234567890', 1)) . md5(time()), 0, 6);
            $KODE_REFUND     = "REFD_{$time}";
        } while ($this->cek_kodeRefund($KODE_REFUND) > 0);

        return $KODE_REFUND;
    }
    public function get_imageMethodPayment($method){
		if($method == "OVO"){
			return "https://image.cermati.com/c_fit,fl_progressive,h_240,q_80,w_360/pm2gnkl5edgago9h4lho.jpg";
		}else if($method == "DANA"){
			return "https://1.bp.blogspot.com/-LDwtS_oxYgg/XO67MmzGN7I/AAAAAAAAADI/hrSqgCRod3oIS6NtwjOqdY0okl8hwyi6gCLcBGAs/s1600/logo%2Bdana%2Bdompet%2Bdigital%2BPNG.png";
		}else if($method == "SHOPEEPAY"){
			return "https://kampungbahasajogja.net/assets/img/about/shopeepay.png";
		}else if($method == "LINKAJA"){
			return "https://vectorlogo4u.com/wp-content/uploads/2019/03/link-aja-logo-vector.png";
		}else if($method == "MANDIRI"){
			return "https://brandeps.com/logo-download/B/Bank-Mandiri-logo-vector-01.svg";
		}else if($method == "MANDIRI"){
			return "https://brandeps.com/logo-download/B/Bank-Mandiri-logo-vector-01.svg";
		}else if($method == "BNI"){
			return "https://i.pinimg.com/originals/36/38/43/36384348ef9d7bfff66da6da9e975d56.png";
		}else if($method == "BRI"){
			return "https://i.ibb.co/Hg1gDdM/images-q-tbn-ANd9-Gc-TIan-Xv-IR5-Wnc-Pv461-AIGT8-FL7t-JJk-A7z-Ui-Dw-usqp-CAU.png";
		}else if($method == "PERMATA"){
			return "https://1.bp.blogspot.com/-tZkp5O70Rqo/XAJ7BwL9_lI/AAAAAAAAAZw/DGusJ0Y5XL84uKmWpnPJ0kQPOjabtqMTwCPcBGAYYCw/s1600/Lowongan%2BKerja%2BTerbaru%2BBank%2BPermata.png";
		}
	}

    // MORE IN THE FUTURE
}
