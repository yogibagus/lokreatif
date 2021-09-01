<?php

class General extends CI_Model {

    // save log-aktivitas
    public function log_aktivitas($KODE_USER, $SENDER, $TYPE){
        $data = array(
            'RECEIVER'      => $KODE_USER,
            'SENDER'        => $SENDER,
            'TYPE'          => $TYPE,
        );
        $this->db->insert('log_aktivitas', $data);
    }

    // get status pembukaan pendaftaran kompetisi
    public function cek_pendaftaranStatus(){
        $query  = $this->db->get_where("tb_pengaturan", array('KEY' => 'STATUS_PENDAFTARAN'));
        if ($query->row()->VALUE == 1) {
            return true;
        }else{
            return false;
        }
    }

    // get daftar bidang lomba
    public function get_bidangLomba(){
        $query = $this->db->get('bidang_lomba');
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }

    // get pts
    public function get_pts(){
        $this->db->select('kodept,namapt');
        $query  = $this->db->get('pt');
        $result = $query->result();

        foreach ($result as $row){
            $pt[$row->kodept] = $row->kodept . '-'. $row->namapt;
        }
        return $pt;
    }

    // PROSES PENDAFTARAN

    // - get kegiatan by kode_kegiatan
    public function get_kegiatan($kode){
        $kode   = $this->db->escape($kode);
        $query  = $this->db->query("SELECT JUDUL, TANGGAL FROM tb_kegiatan a WHERE KODE_KEGIATAN = $kode ");
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }
    
    // get form meta by kode_kegiatan
    public function get_formMeta($kode){
        $this->db->where('KODE', $kode);
        $query = $this->db->get("form_meta");
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }

    // get form item by kode meta
    public function get_formItem($kode){
        $query = $this->db->get_where("form_item", array('ID_FORM' => $kode));
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }

    // get data pendaftara by kode_pendaftaran and id_form
    public function get_formData($kode, $id){
        $query = $this->db->get_where("pendaftaran_data", array('KODE_PENDAFTARAN' => $kode, 'ID_FORM' => $id));
        if ($query->num_rows() > 0) {
            return $query->row()->JAWABAN;
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

    // - get data ketua by kode_pendaftaran jabatan 1

    public function get_dataKetua($kode){
        $query = $this->db->get_where('tb_anggota', array('KODE_PENDAFTARAN' => $kode, 'PERAN' => 1));
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }

    // - get data dospem by kode_pendaftaran jabatan 2

    public function get_dataDospem($kode){
        $query = $this->db->get_where('tb_anggota', array('KODE_PENDAFTARAN' => $kode, 'PERAN' => 2));
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }

    // - get data anggota by kode_pendaftaran jabatan 3

    public function get_dataAnggota($kode){
        $query = $this->db->get_where('tb_anggota', array('KODE_PENDAFTARAN' => $kode, 'PERAN' => 3));
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }

    // - cek kelengkapan data berkas peserta by kode_pendaftaran

    public function cek_kelengkapanBerkas($kode){
        $query = $this->db->query("SELECT ID_FORM FROM form_meta WHERE KODE = 'lokreatif' AND ID_FORM NOT IN (SELECT ID_FORM FROM pendaftaran_data WHERE KODE_PENDAFTARAN = '$kode' AND JAWABAN != '')");
        if ($query->num_rows() > 0) {
            return false;
        }else{
            return true;
        }
    }

    // - get data pendaftaran kompetisi by kode_user
    public function get_detailDaftarKompetisi($id){
        $this->db->select("a.*, b.*, c.namapt");
        $this->db->from("pendaftaran_kompetisi a");
        $this->db->join("bidang_lomba b", "a.BIDANG_LOMBA = b.ID_BIDANG");
        $this->db->join("pt c", "a.ASAL_PTS = c.kodept");
        $this->db->where("a.KODE_USER", $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }else {
            return false;
        }
    }

    // - get data pendaftaran kompetisi by kode_user
    public function get_jmlPTSbayar($kode_pts){
        $query = $this->db->query("SELECT COUNT(*) as TOTAL_TIM FROM pendaftaran_kompetisi WHERE KODE_PENDAFTARAN IN (SELECT KODE_PENDAFTARAN FROM tb_order WHERE KODE_TRANS IN  (SELECT KODE_TRANS FROM tb_transaksi WHERE STAT_BAYAR = 3)) AND ASAL_PTS = '$kode_pts' 
        ");
        if ($query->num_rows() > 0) {
            return $query->row()->TOTAL_TIM;
        }else {
            return false;
        }
    }

    // get jml data tim pts
    public function get_jmlPTSTim($asalPTS){
        $query = $this->db->query("
            SELECT COUNT(*) AS JML_TIM  
            FROM pendaftaran_kompetisi pk
            WHERE pk.ASAL_PTS = '$asalPTS'
        ");
        return $query->row()->JML_TIM;
    }

    // TRANSAKSI

    // - biaya daftar tim (KIRIM PARAM, jumlah tim dari pts X)
    public function get_biayaDaftar($jml_pts){
        $query = $this->db->query("SELECT a.DESKRIPSI FROM tb_pengaturan a WHERE a.VALUE <= {$jml_pts} AND a.KEY = 'BIAYA_DAFTAR' ORDER BY a.DESKRIPSI ASC LIMIT 1");
        return $query->row()->DESKRIPSI;
    }

    // - cek status PEMBAYARAN sudah dibayar oleh univ?
    public function cek_dibayarinUniv($kode, $payer){
        $query = $this->db->query("SELECT * FROM tb_order WHERE KODE_PENDAFTARAN = '$kode' AND KODE_TRANS IN (SELECT KODE_TRANS FROM tb_transaksi WHERE KODE_USER_BILL != '$payer' AND ROLE_USER_BILL = 3)");
        if ($query->num_rows() > 0) {
            // sudah dibayari PTS
            return true;
        }else{
            // belum dibayari PTS
            return false;
        }
    }

    // - cek sudah melakukan proses PEMBAYARAN [REDUNDANT]
    public function cek_sudahBayar($kode){
        $query = $this->db->query("SELECT * FROM tb_order WHERE KODE_PENDAFTARAN = '$kode' AND KODE_TRANS IN (SELECT KODE_TRANS FROM tb_transaksi WHERE STAT_BAYAR > 0)");
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
        $query = $this->db->query("SELECT * FROM tb_order WHERE KODE_PENDAFTARAN = '$kode' AND KODE_TRANS IN (SELECT KODE_TRANS FROM tb_transaksi WHERE STAT_BAYAR = 3)");
        if ($query->num_rows() > 0) {
            // sudah membayar biaya pendaftaran
            return true;
        }else{
            // belum membayar biaya pendaftaran
            return false;
        }
    }

    // - cek PEMBAYARAN FAILED
    public function cek_statBayarFailed($kode){
        $query = $this->db->query("SELECT * FROM tb_order WHERE KODE_PENDAFTARAN = '$kode' AND KODE_TRANS IN (SELECT KODE_TRANS FROM tb_transaksi WHERE STAT_BAYAR = 4)");
        if ($query->num_rows() > 0) {
            // Pembayaran gagal
            return true;
        }else{
            // ?
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

    // - get data refund by kode_user
    public function get_dataRefund($KODE_USER){
        $this->db->select('*');
        $this->db->from('tb_transaksi a');
        $this->db->join('tb_refund b', 'a.KODE_TRANS = b.KODE_TRANS');
        $this->db->join('tb_order c', 'a.KODE_TRANS = c.KODE_TRANS');
        $this->db->where(array('a.KODE_USER_BILL' => $KODE_USER));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }

    public function cek_refeundUniv($KODE_TRANS){
        $query = $this->db->get_where('tb_refund', array('KODE_TRANS' => $KODE_TRANS, 'STAT_REFUND' => 0));
        if ($query->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function count_jmlRefund($KODE_TRANS){
        // $query= $this->db->query("SELECT (TOT_BAYAR - (SELECT SUM(BIAYA_TIM) FROM tb_order WHERE KODE_TRANS = '$KODE_TRANS')) AS JML_REFUND FROM tb_transaksi WHERE KODE_TRANS = '$KODE_TRANS'");
        $query = $this->db->get_where('tb_refund', ['KODE_TRANS' => $KODE_TRANS]);
        return $query->row();
    }

    // - get data tim refund by kode_trans
    public function get_tim($param)
    {
        $query = $this->db->query("
            SELECT pk.NAMA_TIM 
            FROM tb_transaksi tt , tb_order to2 , pendaftaran_kompetisi pk 
            WHERE tt.KODE_TRANS = to2.KODE_TRANS AND to2.KODE_PENDAFTARAN = pk.KODE_PENDAFTARAN AND tt.KODE_TRANS = '$param'
        ");
        return $query->result();
    }
    public function cek_anggotaRedundant($kodeUser, $nim){
        $query = $this->db->query("
            SELECT ta.NIM 
            FROM tb_anggota ta , pendaftaran_kompetisi pk , pt p 
            WHERE ta.KODE_PENDAFTARAN = pk.KODE_PENDAFTARAN 
                AND ta.NIM = '$nim'
                AND ta.PERAN = '3'
                AND pk.ASAL_PTS IN (
                    SELECT p2.kodept 
                    FROM pt p2 , pendaftaran_kompetisi pk2 
                    WHERE p2.kodept = pk2.ASAL_PTS 
                        AND pk2.KODE_USER = '$kodeUser'
                )
            GROUP BY ta.NIM 
        ");

        return $query->result();
    }
}
