<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_hutang_outsource_m extends CI_Model {
    public function getCucianAmbil($tglAwal, $tglAkhir,$idOutsource) {
        if($idOutsource == ''){
           $idOutsource = "  and id_outsource <> ''"; 
        }else{
          $idOutsource = " and id_outsource = '$idOutsource'";  
        }
        $sql = "SELECT mc.id_master_cm, mc.no_bon_manual,mc.id_cust,mc.tgl_trans,mc.e_tgl_selesai,
            mc.tgl_selesai,mc.tgl_ambil,mc.waktu_masuk,mc.waktu_ambil,mc.tgl_outsource_keluar,
            mc.tgl_outsource_masuk,mc.total_qty_kg,mc.total_qty_satuan,mc.total_harga,mc.jml_bayar,mc.diskon, 
            mc.berat_ambil,mc.status_selesai,mc.status_bayar,mc.status_outsource,mt.nama_cust,mc.prioritas 
            FROM master_cm mc 
            LEFT JOIN master_customer mt ON mc.id_cust = mt.id_cust 
            where mc.tgl_trans between '$tglAwal' and '$tglAkhir'  ".$idOutsource." ";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    
    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */