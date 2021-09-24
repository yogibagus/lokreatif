<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kordinator extends CI_Model
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
        $this->db->select("*");
        $this->db->from("pendaftaran_kompetisi a");
        $this->db->join("tb_peserta b", "a.KODE_USER = b.KODE_USER");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
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
        $query = $this->db->get_where("form_meta", array('KODE' => 'lokreatif', 'TYPE' => 'FILE'));
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
        $this->db->update('pendaftaran_kompetisi', array('STATUS' => 1));
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function tolak_pendaftaran()
    {
        $KODE_USER = $this->input->post('KODE_USER');

        $this->db->where('KODE_USER', $KODE_USER);
        $this->db->update('pendaftaran_kompetisi', array('STATUS' => 2));
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
