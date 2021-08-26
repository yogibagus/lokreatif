<?php
class M_Cronjob extends CI_Model{
    public function get_countTimUniv(){
        $query = $this->db->query("
            SELECT p.namapt , p.kodept , COUNT(pk.KODE_PENDAFTARAN) AS TOTAL_TIM
            FROM pendaftaran_kompetisi pk , pt p 
            WHERE pk.ASAL_PTS = p.kodept 
            GROUP BY p.kodept 
        ");

        return $query->result();
    }

    public function get_dataRefund($biayaUpdate, $kodept){
        $query = $this->db->query("
            SELECT to2.KODE_TRANS , (to2.BIAYA_TIM - $biayaUpdate) AS REFUND
            FROM tb_order to2 , tb_transaksi tt, pendaftaran_kompetisi pk 
            WHERE to2.KODE_TRANS = tt.KODE_TRANS 
                AND to2.KODE_PENDAFTARAN = pk.KODE_PENDAFTARAN 
                AND to2.BIAYA_TIM > $biayaUpdate 
                AND pk.ASAL_PTS = '$kodept'
                AND tt.STAT_BAYAR = 3
            GROUP BY to2.KODE_TRANS
        ");

        return $query->result();
    }

    public function update_biayaTim($biayaNew, $kodept){
        $this->db->query("
            UPDATE tb_order 
            SET BIAYA_TIM = $biayaNew
            WHERE KODE_TRANS 
                IN (SELECT to2.KODE_TRANS 
                    FROM tb_order to2, pendaftaran_kompetisi pk
                    WHERE to2.KODE_PENDAFTARAN = pk.KODE_PENDAFTARAN AND pk.ASAL_PTS = '$kodept'
                    GROUP BY to2.KODE_TRANS )
        ");
    }

    public function insert_refund($param){
        return $this->db->insert_batch('tb_refund', $param);
    }
}