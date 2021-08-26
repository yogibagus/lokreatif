<?php

class General extends CI_Model {

    // STATUS PENDAFTARAN KOMPETISI
    public function cek_pendaftaranStatus(){
        $query  = $this->db->get_where("tb_pengaturan", array('KEY' => 'STATUS_PENDAFTARAN'));
        if ($query->row()->VALUE == 1) {
            return true;
        }else{
            return false;
        }
    }

    // DATA PESERTA

    // - get data peserta by email
    public function get_auth($email){
        $email = $this->db->escape($email);
        $query = $this->db->query("SELECT * FROM tb_auth a LEFT JOIN tb_peserta b ON a.KODE_USER = b.KODE_USER WHERE a.EMAIL = $email");

        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }

    // - get data peserta by kode_user
    public function get_akun($kode){
        $kode   = $this->db->escape($kode);
        $query  = $this->db->query("SELECT * FROM tb_auth a LEFT JOIN tb_peserta b ON a.KODE_USER = b.KODE_USER WHERE a.KODE_USER = $kode");

        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }

    // TRANSAKSI

    // - biaya daftar tim (KIRIM PARAM, jumlah tim dari pts X)
    public function get_biayaDaftar($jml_pts){
        $query = $this->db->query("SELECT a.DESKRIPSI FROM tb_pengaturan a WHERE a.VALUE <= {$jml_pts} AND a.KEY = 'BIAYA_DAFTAR' ORDER BY a.DESKRIPSI ASC LIMIT 1");
        return $query->row()->DESKRIPSI;
    }

    // - cek sudah melakukan proses PEMBAYARAN
    public function cek_sudahBayar($kode){
        $query = $this->db->query("SELECT * FROM tb_order WHERE KODE_PENDAFTARAN = '$kode' AND KODE_TRANS IN (SELECT KODE_TRANS FROM tb_transaksi)");
        if ($query->num_rows() > 0) {
            // sudah melakukan proses pembayaran
            return true;
        }else{
            // belum melakukan proses pembayaran
            return false;
        }
    }


    // - cek status PEMBAYARAN
    public function cek_statBayar($kode){
        $query = $this->db->query("SELECT * FROM tb_order WHERE KODE_PENDAFTARAN = '$kode' AND KODE_TRANS IN (SELECT KODE_TRANS FROM tb_transaksi WHERE STAT_BAYAR = 1)");
        if ($query->num_rows() > 0) {
            // sudah melakukan proses pembayaran
            return true;
        }else{
            // belum melakukan proses pembayaran
            return false;
        }
    }

    // - ambil kode_trans dari tb_order, saat status pembayaran sedang diproses (PARAM = KODE_PENDAFTARAN)
    public function get_kodeTrans($KODE_PENDAFTARAN){
        $this->db->select('KODE_TRANS');
        $this->db->from('tb_order');
        $this->db->where(array('KODE_PENDAFTARAN' => $KODE_PENDAFTARAN));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->KODE_TRANS;
        }else{
            return false;
        }
    }
}
