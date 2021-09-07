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
            SELECT pk.NAMA_TIM, bl.BIDANG_LOMBA 
            FROM tb_transaksi tt , tb_order to2 , pendaftaran_kompetisi pk, bidang_lomba bl 
            WHERE tt.KODE_TRANS = to2.KODE_TRANS 
            AND to2.KODE_PENDAFTARAN = pk.KODE_PENDAFTARAN 
            AND pk.BIDANG_LOMBA = bl.ID_BIDANG 
            AND tt.KODE_TRANS = '$param'
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
        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
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
                if ($this->db->affected_rows() >= 0) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    // get transaksi berdasarkan KODE_PAY
    function get_payment_by_id($kode_pay)
    {
        $kode_pay   = $this->db->escape($kode_pay);
        $query = $this->db->query("SELECT * FROM tb_payment AS a, tb_status_payment AS b, tb_payment_method AS c 
        WHERE a.`KODE_PAY` = $kode_pay
        AND a.`STAT_PAY` = b.`ID_STAT_PAY`
        AND a.`ID_PAY_METHOD` = c.`ID_PAY_METHOD`");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    // get data tutorial by id_pay_method
    function get_tutorial_payment_by_id_pay_method($id_pay_method)
    {
        $id_pay_method   = $this->db->escape($id_pay_method);
        $query = $this->db->query("SELECT * FROM tb_tutorial WHERE ID_PAY_METHOD = $id_pay_method");
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

    // get last payment by user
    function get_last_payment($kode_trans)
    {
        $kode_trans   = $this->db->escape($kode_trans);
        $query = $this->db->query("SELECT * FROM tb_payment AS a, tb_transaksi AS b 
        WHERE a.`KODE_TRANS` = $kode_trans ORDER BY a.`CREATED_TIME` DESC LIMIT 1");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    // get payment berdasarkan KODE_TRANS
    function get_payment_by_kode_trans($kode_trans)
    {
        $kode_trans   = $this->db->escape($kode_trans);
        $query = $this->db->query("SELECT * FROM tb_payment AS a, tb_status_payment AS b, tb_payment_method AS c 
        WHERE a.`KODE_TRANS` = $kode_trans
        AND a.`STAT_PAY` = b.`ID_STAT_PAY`
        AND a.`ID_PAY_METHOD` = c.`ID_PAY_METHOD`");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    // get payment history that hasn't paid
    function count_payment_by_kode_trans($kode_trans)
    {
        $kode_trans   = $this->db->escape($kode_trans);
        $query = $this->db->query("SELECT COUNT(KODE_TRANS) AS belum_selesai FROM tb_payment 
        WHERE KODE_TRANS = $kode_trans AND STAT_PAY = '2'");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return $query->row();
        }
    }

    // delete payment sebelumnya
    function delete_last_payment($kode_pay)
    {
        $kode_pay   = $this->db->escape($kode_pay);
        $this->db->query("DELETE FROM tb_payment WHERE KODE_PAY = $kode_pay");
    }

    // update tb_transaksi berdasarkan kode_trans
    function update_pay_by_order_id($order_id, $data)
    {
        $this->db->where('ORDER_ID', $order_id);
        $this->db->update('tb_payment', $data);
        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_payment_by_order_id($order_id)
    {
        $order_id   = $this->db->escape($order_id);
        $query = $this->db->query("SELECT * FROM tb_payment WHERE ORDER_ID = $order_id");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_user_by_order_id($order_id)
    {
        $order_id   = $this->db->escape($order_id);
        $query = $this->db->query("    SELECT * FROM tb_payment AS a, tb_transaksi AS b, tb_auth AS c WHERE a.`ORDER_ID` = $order_id 
        AND a.`KODE_TRANS` = b.`KODE_TRANS` 
        AND c.`KODE_USER` = b.`KODE_USER_BILL`");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }



    function get_all_payment_method()
    {
        $query = $this->db->query("SELECT * FROM tb_payment_method WHERE STAT_PAY_METHOD = 1");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_payment_method_by_id($id_pay_method)
    {
        $id_pay_method   = $this->db->escape($id_pay_method);
        $query = $this->db->query("SELECT * FROM tb_payment_method WHERE ID_PAY_METHOD = $id_pay_method AND  STAT_PAY_METHOD = 1");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_list_payment_by_kode_user($kodeUser)
    {
        return $this->db->query("
        SELECT 
            tt.KODE_TRANS ,
            tp.KODE_PAY ,
            tp.CREATED_TIME ,
            tp.EXP_TIME ,
            tpm.IMG_PAY_METHOD ,
            tp.PAID_AMOUNT ,
            tp.STAT_PAY ,
            tsp.COLOR_STAT_PAY ,
            tsp.ALIAS_STAT_PAY ,
            tr.KODE_REFUND ,
            tr.STAT_REFUND 
        FROM  tb_transaksi tt
        LEFT JOIN tb_payment tp ON tt.KODE_TRANS = tp.KODE_TRANS 
        LEFT JOIN tb_payment_method tpm ON tp.ID_PAY_METHOD = tpm.ID_PAY_METHOD
        LEFT JOIN tb_status_payment tsp ON tsp.ID_STAT_PAY = tp.STAT_PAY 
        LEFT JOIN tb_refund tr ON tr.KODE_TRANS = tt.KODE_TRANS
        WHERE tt.KODE_USER_BILL = '$kodeUser'
        ORDER BY FIELD(tp.CREATED_TIME, null), tp.CREATED_TIME DESC             
        ");
    }

    public function get_payment_by_kode_pay($kodePay)
    {
        return $this->db->query("
            SELECT 
                tt.KODE_TRANS ,
                tp.KODE_PAY ,
                tp.CREATED_TIME ,
                tp.EXP_TIME ,
                tpm.IMG_PAY_METHOD ,
                tp.PAID_AMOUNT ,
                tp.STAT_PAY ,
                tsp.COLOR_STAT_PAY ,
                tsp.ALIAS_STAT_PAY 
            FROM  tb_transaksi tt
            LEFT JOIN tb_payment tp ON tt.KODE_TRANS = tp.KODE_TRANS 
            LEFT JOIN tb_payment_method tpm ON tp.ID_PAY_METHOD = tpm.ID_PAY_METHOD
            LEFT JOIN tb_status_payment tsp ON tsp.ID_STAT_PAY = tp.STAT_PAY 
            WHERE tp.KODE_PAY = '$kodePay'
            ORDER BY tp.CREATED_TIME DESC           
            ")->row();
    }

    public function get_status_payment($kodeTrans)
    {
        return $this->db->query("
            SELECT tsp.*
            FROM tb_payment p, tb_status_payment tsp 
            WHERE p.STAT_PAY = tsp.ID_STAT_PAY AND p.KODE_TRANS = '$kodeTrans'
        ")->row();
    }
}
