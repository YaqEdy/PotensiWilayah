<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_biaya_trans_m extends CI_Model {
    function getJurnalUnpost($tanggal) {
        $sql = "select distinct trans_id,tgl_trans,kode_jurnal,deskripsi,saldo_akhir,no_invoice from trans_detail_perk
                    where tgl_trans = '$tanggal' and  post = 0 group by trans_id order by trans_id asc"; 
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    
    public function getLapBiayaTrans($tglAwal, $tglAkhir,$idJnsTransaksi) {
        if($idJnsTransaksi == ''){
           $idJnsTransaksi = "  and modul = '2'"; 
        }else{
          $idJnsTransaksi = "  and modul = '2' and kode_perk = '$idJnsTransaksi'";  
        }
        $sql = "SELECT trans_id,tgl_trans,kode_jurnal,deskripsi,debet,no_invoice 
            from trans_detail_perk 
            where debet <> 0 and tgl_trans between '$tglAwal' and '$tglAkhir'  ".$idJnsTransaksi." ";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    function getBiayaTrans() {
        $sql = "SELECT kode_perk,nama_jns_transaksi from jenis_transaksi";
        $query = $this->db->query($sql);
        return $query->result();
    }

    
    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */