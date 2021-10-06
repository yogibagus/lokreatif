<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_koordinator extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // TYPE CP, SOSMED, TIKET
    // 1. KOMPETISI
    // 2. KOMPETISI

    public function log_aktivitasKpanel($KODE_USER, $TYPE, $GROUP)
    {
        $data = array(
            'SENDER'         => $KODE_USER,
            'TYPE'             => $TYPE,
            'RECEIVER_GROUP' => $GROUP,
        );
        $this->db->insert('log_aktivitas', $data);
    }

    function count_peserta($kode)
    {
        return $this->db->get_where("pendaftaran_kompetisi", array('KODE_KOMPETISI' => $kode))->num_rows();
    }

    function count_pesertaVerif($kode)
    {
        return $this->db->get_where("pendaftaran_kompetisi", array('KODE_KOMPETISI' => $kode, 'STATUS' => 1))->num_rows();
    }

    //BIDANG LOMBA
    function get_bidangLomba()
    {
        $query    = $this->db->get('bidang_lomba');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_bidangLomba_by_id($id_bidang)
    {
        $query    = $this->db->query("SELECT * FROM bidang_lomba WHERE id_bidang = $id_bidang");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    // FORMULIR

    function cek_form()
    {
        $query = $this->db->get_where("form_meta", array('KODE' => 'lokreatif'));
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_dataPendaftaran()
    {
        $this->db->select("a.*, b.*, c.BIDANG_LOMBA as NAMA_LOMBA");
        $this->db->from("pendaftaran_kompetisi a");
        $this->db->join("tb_peserta b","a.KODE_USER = b.KODE_USER", 'left');
        $this->db->join("bidang_lomba c","a.BIDANG_LOMBA = c.ID_BIDANG", 'left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_dataPendaftaran_by_bidang_lomba($id_bidang)
    {
        $this->db->select("a.*, b.*, c.BIDANG_LOMBA as NAMA_LOMBA");
        $this->db->from("pendaftaran_kompetisi a");
        $this->db->join("tb_peserta b","a.KODE_USER = b.KODE_USER", 'left');
        $this->db->join("bidang_lomba c","a.BIDANG_LOMBA = c.ID_BIDANG", 'left');
        $this->db->where('a.BIDANG_LOMBA', $id_bidang);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_pendaftaran_by_kode_pendaftaran($kode_pendaftaran)
    {
        $this->db->select("*");
        $this->db->from("pendaftaran_kompetisi a");
        $this->db->join("tb_peserta b", "a.KODE_USER = b.KODE_USER");
        $this->db->join("tb_auth c", "c.KODE_USER = b.KODE_USER");
        $this->db->where('a.KODE_PENDAFTARAN', $kode_pendaftaran);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_form()
    {
        $query = $this->db->get_where("form_meta", array('KODE' => 'lokreatif'));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_formItem($kode)
    {
        $query = $this->db->get_where("form_item", array('ID_FORM' => $kode));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_formData($kode, $id)
    {
        $query = $this->db->get_where("pendaftaran_data", array('KODE_PENDAFTARAN' => $kode, 'ID_FORM' => $id));
        if ($query->num_rows() > 0) {
            return $query->row()->JAWABAN;
        } else {
            return false;
        }
    }

    function get_formBerkas()
    {
        $query = $this->db->get_where("form_meta", array('KODE' => 'lokreatif'));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }



    function terima_pendaftaran()
    {
        $KODE_USER = $this->input->post('KODE_USER');

        $this->db->where('KODE_USER', $KODE_USER);
        $this->db->update('pendaftaran_kompetisi', array('STATUS' => 1, 'STATUS_SELEKSI' => 1));
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function tolak_pendaftaran()
    {
        $KODE_USER = $this->input->post('KODE_USER');

        $this->db->where('KODE_USER', $KODE_USER);
        $this->db->update('pendaftaran_kompetisi', array('STATUS' => 2, 'STATUS_SELEKSI' => 0));
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function get_anggota_tim($kode_pendaftaran)
    {
        $query = $this->db->query("SELECT * FROM pendaftaran_kompetisi AS a, tb_anggota AS b 
        WHERE a.`KODE_PENDAFTARAN` = b.`KODE_PENDAFTARAN`
        AND a.`KODE_PENDAFTARAN` = '$kode_pendaftaran'");
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    function get_karya_by_kode_pendaftaran($kode_pendaftaran)
    {
        $query = $this->db->query("SELECT a.* , b.`NAMA_TIM`, b.`KODE_USER`,
        c.`BIDANG_LOMBA`, c.`ID_BIDANG`
        FROM tb_karya AS a, pendaftaran_kompetisi AS b, bidang_lomba AS c  WHERE a.`KODE_PENDAFTARAN` = b.`KODE_PENDAFTARAN`
        AND b.`BIDANG_LOMBA` = c.`ID_BIDANG`
        AND a.`KODE_PENDAFTARAN` = '$kode_pendaftaran'
       ");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_koordinator_by_kode_user($kode_user)
    {
        $query = $this->db->query("SELECT * FROM bidang_koordinator AS a, bidang_lomba AS b, tb_peserta AS c
        WHERE a.`ID_BIDANG` = b.`ID_BIDANG`
        AND a.`KODE_USER` = c.`KODE_USER`
        AND a.`KODE_USER` = '$kode_user'
       ");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_jumlah_tim($id_lomba = "")
    {
        if ($id_lomba == "") {
            $query = $this->db->query("SELECT COUNT(a.`KODE_PENDAFTARAN`) AS jumlah_tim FROM pendaftaran_kompetisi AS a");
        } else {
            $query = $this->db->query("SELECT COUNT(a.`KODE_PENDAFTARAN`) AS jumlah_tim FROM pendaftaran_kompetisi AS a WHERE a.`BIDANG_LOMBA` = $id_lomba");
        }
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_jumlah_berkas_belum_terverifikasi($id_bidang = "")
    {
        if ($id_bidang == "") {
            $query = $this->db->query("SELECT COUNT(a.`KODE_PENDAFTARAN`) AS jumlah_berkas_belum_terverifikasi 
            FROM pendaftaran_kompetisi AS a 
            WHERE a.`STATUS` = 0");
        } else {
            $query = $this->db->query("SELECT COUNT(a.`KODE_PENDAFTARAN`) AS jumlah_berkas_belum_terverifikasi 
            FROM pendaftaran_kompetisi AS a 
            WHERE a.`STATUS` = 0
            AND a.`BIDANG_LOMBA` = $id_bidang");
        }
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_jumlah_berkas_terverifikasi($id_bidang = "")
    {
        if ($id_bidang == "") {
            $query = $this->db->query("SELECT COUNT(a.`KODE_PENDAFTARAN`) AS jumlah_berkas_terverifikasi 
            FROM pendaftaran_kompetisi AS a 
            WHERE a.`STATUS` = 1");
        } else {
            $query = $this->db->query("SELECT COUNT(a.`KODE_PENDAFTARAN`) AS jumlah_berkas_terverifikasi 
            FROM pendaftaran_kompetisi AS a 
            WHERE a.`STATUS` = 1
            AND a.`BIDANG_LOMBA` = $id_bidang");
        }
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_jumlah_berkas_ditolak($id_bidang = "")
    {
        if ($id_bidang == "") {
            $query = $this->db->query("SELECT COUNT(a.`KODE_PENDAFTARAN`) AS jumlah_berkas_ditolak
            FROM pendaftaran_kompetisi AS a 
            WHERE a.`STATUS` = 2");
        } else {
            $query = $this->db->query("SELECT COUNT(a.`KODE_PENDAFTARAN`) AS jumlah_berkas_ditolak 
            FROM pendaftaran_kompetisi AS a 
            WHERE a.`STATUS` = 2
            AND a.`BIDANG_LOMBA` = $id_bidang");
        }
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    // HASIL PENILAIAN
    function get_tahapLomba_by_id($id_tahap){
        $query = $this->db->get_where('tahap_penilaian', array('ID_TAHAP' => $id_tahap));
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }
    function get_hasilPenilaian($id_tahap, $id_bidang){
        // case
        // 1. Berdasarkan nilai tertinggi (sudah ada data penilaian) / berdasarkan id tahap
        $this->db->select('*');
        $this->db->from('v_penilaian');
        
        if ($id_bidang != 0) {
            $this->db->where('ID_BIDANG', $id_bidang);
        }
        
        if ($id_tahap != 0) {
            $this->db->where('TAHAP', $id_tahap);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }

}
