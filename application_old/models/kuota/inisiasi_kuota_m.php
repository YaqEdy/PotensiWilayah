<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inisiasi_kuota_m extends CI_Model {

    public function getAllCustomer() {
        $sql = "select id_cust from master_customer";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function cekTahun($tahun) {
        $sql = "SELECT tahun from master_kuota where tahun ='$tahun'";
        $query = $this->db->query($sql);
        //$hasil = $query->result();
        $jml = $query->num_rows();
        return $jml;
        // returning rows, not row
    }

    public function inisiasiKuota($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('master_kuota', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */