<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_piutang_agen_m extends CI_Model {
    public function getCucianAmbil($tglAwal, $tglAkhir,$idAgen) {
        if($idAgen == ''){
           $idAgen = "  and id_agen = '$idAgen'"; 
        }else if($idAgen == 'x'){
           $idAgen = ""; 
        }else{
          $idAgen = " and id_agen = '$idAgen'";  
        }
        $sql = "SELECT mc.id_master_cm, mc.no_bon_manual,mc.id_cust,mc.tgl_trans,mc.e_tgl_selesai,
            mc.tgl_selesai,mc.tgl_ambil,mc.waktu_masuk,mc.waktu_ambil,mc.tgl_outsource_keluar,
            mc.tgl_outsource_masuk,mc.total_qty_kg,mc.total_qty_satuan,mc.total_harga,mc.jml_bayar,mc.diskon, 
            mc.berat_ambil,mc.status_selesai,mc.status_bayar,mc.status_outsource,mt.nama_cust,mc.prioritas 
            FROM master_cm mc 
            LEFT JOIN master_customer mt ON mc.id_cust = mt.id_cust 
            where mc.tgl_trans between '$tglAwal' and '$tglAkhir'  ".$idAgen." ";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getStatusSelesai($id_master){
        $sql ="select status_selesai from master_cm where id_master_cm ='$id_master'";
        $query =$this->db->query($sql);
        $result = $query->result();
        $status_selesai = $result[0]->status_selesai;
        return $status_selesai;
    }
    public function getStatusBayar($id_master){
        $sql ="select status_bayar from master_cm where id_master_cm ='$id_master'";
        $query =$this->db->query($sql);
        $result = $query->result();
        $status_bayar = $result[0]->status_bayar;
        return $status_bayar;
    }
    public function getStatusOutsource($id_master){
        $sql ="select status_outsource from master_cm where id_master_cm ='$id_master'";
        $query =$this->db->query($sql);
        $result = $query->result();
        $status_outsource = $result[0]->status_outsource;
        return $status_outsource;
    }
    public function getPiutang($id_master){
        $sql ="select total_harga_kg,total_harga_satuan from master_cm where id_master_cm ='$id_master'";
        $query =$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getInfoOutsource($idOutsource){
        $sql ="select * from master_outsource where id_outsource ='$idOutsource'";
        $query =$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getInfoAgen($idAgen){
        $sql ="select * from master_agen where id_agen ='$idAgen'";
        $query =$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getInfoKyw($idKyw){
        $sql ="select * from master_karyawan where id_kyw ='$idKyw'";
        $query =$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getInfoTransCM($row_idtransos){
        $sql ="select (qty * harga_satuan) as harga_cucian from trans_cm where id_trans ='$row_idtransos'";
        $query =$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */