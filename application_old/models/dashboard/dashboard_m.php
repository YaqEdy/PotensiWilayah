<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_m extends CI_Model {

    public function get_cm($tgl_trans) {
        $sql = "select count(id_master_cm) as jml_cm from master_cm where tgl_trans = '$tgl_trans' and status_ambil = 0";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->jml_cm;
    }
    public function get_ca($tgl_trans) {
        $sql = "select count(id_master_cm) as jml_cm from master_cm where tgl_ambil = '$tgl_trans' and status_ambil = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->jml_cm;
    }
    public function get_cs($tgl_trans) {
        $sql = "select count(id_master_cm) as jml_cm from master_cm where tgl_selesai = '$tgl_trans'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->jml_cm;
    }
    public function get_chs($tgl_trans) {
        $sql = "select count(id_master_cm) as jml_cm from master_cm where e_tgl_selesai = '$tgl_trans'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->jml_cm;
    }
    public function get_um($tgl_trans) {
        $sql = "select coalesce(sum(jml_bayar),0) as jml_cm from master_cm where tgl_ambil = '$tgl_trans' or tgl_trans = '$tgl_trans'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->jml_cm;
    }
    
    
    public function get_db_total() {
        $sql = "select coalesce(jumlah,0) as jumlah from dashboard_total";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
                //[0]->jml_cm;
    }
    public function getDbSuNusapenida() {
        $sql = "SELECT * from dashboard_table where id_kec = '5105010'";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    public function getDbBajangkaran() {
        $sql = "SELECT * from dashboard_table where id_kec = '5105020'";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    public function getDbKlungkung() {
        $sql = "SELECT * from dashboard_table where id_kec = '5105030'";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    public function getDbDawan() {
        $sql = "SELECT * from dashboard_table where id_kec = '5105040'";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

}
