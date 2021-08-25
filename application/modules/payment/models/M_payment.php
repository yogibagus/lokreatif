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
}
