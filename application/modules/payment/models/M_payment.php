<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_payment extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // JENIS
    // 1 ARTIKEL
    // 2 BERITA

    // get transaksi berdasarkan Kode_user
    function get_transaksi_by_id($param)
    {
        $param   = $this->db->escape($param);
        $query = $this->db->query("SELECT * FROM tb_transaksi WHERE KODE_TRANS = $param");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    // get akun univ berdasarkan kode_user
    function get_univ_by_id($param)
    {
        $param   = $this->db->escape($param);
        $query = $this->db->query("SELECT * FROM tb_univ AS a, pt AS b, tb_auth AS c 
        WHERE a.`KODE_PT` = b.`kodept` 
        AND c.`KODE_USER` = a.`KODE_UNIV` 
        AND c.`KODE_USER` = $param");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_tim($param)
    {
        $query = $this->db->query("
            SELECT pk.NAMA_TIM 
            FROM tb_transaksi tt , tb_order to2 , pendaftaran_kompetisi pk 
            WHERE tt.KODE_TRANS = to2.KODE_TRANS AND to2.KODE_PENDAFTARAN = pk.KODE_PENDAFTARAN AND tt.KODE_TRANS = '$param'
        ");
        return $query->result();
    }

    // get jumlah total bayar untuk tim yang dibayarkan by kode_trans
    function get_total_bayar($kode_trans)
    {
        $kode_trans   = $this->db->escape($kode_trans);
        $query = $this->db->query("SELECT SUM(a.BIAYA_TIM) AS total_bayar 
        FROM tb_order AS a, tb_transaksi AS b 
        WHERE a.`KODE_TRANS` = b.`KODE_TRANS`
        AND a.`KODE_TRANS` = $kode_trans");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    // get jumlah total tim yang dibayarkan by kode_trans
    function get_total_team_and_biaya($kode_trans)
    {
        $kode_trans   = $this->db->escape($kode_trans);
        $query = $this->db->query("SELECT COUNT(a.KODE_TRANS) AS total_team, a.BIAYA_TIM as biaya
        FROM tb_order AS a, tb_transaksi AS b 
        WHERE a.`KODE_TRANS` = b.`KODE_TRANS`
        AND a.`KODE_TRANS` = $kode_trans");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    // update tb_transaksi berdasarkan kode_trans
    function update_transaksi($kode_trans, $data)
    {
        $this->db->where('KODE_TRANS', $kode_trans);
        $this->db->update('tb_transaksi', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    // insert or update payment value
    function update_pay($payment_id, $data)
    {
        // $payment_id   = $this->db->escape($payment_id);
        if ($payment_id == '') {
            // new insert
            $this->db->insert('tb_payment', $data);
            return ($this->db->affected_rows() != 1) ? false : true;
        } else {
            // update
            $query = $this->db->query("SELECT * FROM tb_payment WHERE PAYMENT_ID = '$payment_id'");
            if ($query->num_rows() == 0) {
                $this->db->insert('tb_payment', $data);
                return ($this->db->affected_rows() != 1) ? false : true;
            } else {
                $this->db->where('PAYMENT_ID', $payment_id);
                $this->db->update('tb_payment', $data);
                return ($this->db->affected_rows() != 1) ? true : false;
            }
        }
    }

    // get transaksi berdasarkan KODE_PAY
    function get_payment_by_id($kode_pay)
    {
        $kode_pay   = $this->db->escape($kode_pay);
        $query = $this->db->query("SELECT * FROM tb_payment WHERE KODE_PAY = $kode_pay");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    // get data tutorial by bank name
    function get_tutorial_payment_by_bank_name($bank_name)
    {
        $bank_name   = $this->db->escape($bank_name);
        $query = $this->db->query("SELECT * FROM tb_tutorial WHERE BANK_TUT = $bank_name");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    // get status payment by stat_pay
    function get_status_payment_by_stat_pay($stat_pay)
    {
        $stat_pay   = $this->db->escape($stat_pay);
        $query = $this->db->query("SELECT * FROM tb_status_payment where ID_STAT_PAY = $stat_pay");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function insert_log_webhook($data)
    {
        $this->db->insert('log_webhook', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
