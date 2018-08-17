<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Global_cukai_m extends CI_Model {

    public function getHitungStokAkhirAll() {//belum
        
    }

    public function getHitungStokAvlAll() {//belum
        
    }

    public function getStokAkhirAll() {
        $sql = "select (saldo_awal + stok_akhir) as stok_akhir from master_produk_cukai order by id_produk asc ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getStokAvlAll() {
        $sql = "select (saldo_awal + stok_avl) as stok_avl from master_produk_cukai order by id_produk asc ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getStokAkhirProduk($id_produk) {
        $sql = "select (saldo_awal + stok_akhir) as stok_akhir from master_produk_cukai where id_produk ='$id_produk' ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getStokAvlProduk($id_produk) {
        $sql = "select (saldo_awal + stok_avl) as stok_avl from master_produk_cukai where id_produk ='$id_produk' ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    function updateMProdukMasuk($qty_kg, $id_produk) {
        $sql2 = "update master_produk_cukai set masuk= (masuk  + '$qty_kg'), stok_avl = (stok_avl + '$qty_kg'), stok_akhir = (stok_akhir + '$qty_kg')  where id_produk = '$id_produk'";
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    /*Function untuk edit produk menjadi pada posisi sebelum dirubah --updateMProdukKeluarReqEdit*/
    function updateMProdukKelReqEdit($qty_kg, $id_produk) {
        $sql2 = "update master_produk_cukai set keluar_req= (keluar_req  - '$qty_kg'), stok_avl= ( stok_avl  + '$qty_kg') where id_produk = '$id_produk'";
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function updateMProdukKeluarReq($qty_kg, $id_produk) {
        $sql2 = "update master_produk_cukai set keluar_req= (keluar_req  + '$qty_kg'), stok_avl= ( stok_avl  - '$qty_kg') where id_produk = '$id_produk'";
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function updateMProdukKeluarPack($qty_kg, $id_produk) {
        $sql2 = "update master_produk_cukai set keluar_req = (keluar_req  + '$qty_kg'), stok_avl= ( stok_avl  - '$qty_kg') where id_produk = '$id_produk'";//, stok_akhir= ( stok_akhir  - '$qty_kg')
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function updateMProdukKeluarPackEdit($qty_kg, $id_produk) {
        $sql2 = "update master_produk_cukai set keluar_req = (keluar_req  - '$qty_kg'), stok_avl= ( stok_avl  + '$qty_kg') where id_produk = '$id_produk'"; //, stok_akhir= ( stok_akhir  + '$qty_kg')
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function updateMProdukKeluar($qty_kg, $id_produk) {
        $sql2 = "update master_produk_cukai set keluar = (keluar  + '$qty_kg'), stok_akhir= (stok_akhir  - '$qty_kg') where id_produk = '$id_produk'";
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function updateMProdukInCamp($qty_kg, $id_produk) {
        $sql2 = "update master_produk_cukai set masuk_campur = (masuk_campur  + '$qty_kg'), stok_avl = (stok_avl + '$qty_kg'), stok_akhir = (stok_akhir + '$qty_kg')  where id_produk = '$id_produk'";
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function updateMProdukOutCamp($qty_kg, $id_produk) {
        $sql2 = "update master_produk_cukai set keluar_campur = (keluar_campur  + '$qty_kg'), stok_avl= (stok_avl  - '$qty_kg'), stok_akhir= (stok_akhir  - '$qty_kg') where id_produk = '$id_produk'";
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    public function getKuotaCust($idCust,$tahun) {
        $this->db->select('kuota,terpakai,saldo_akhir');
        $this->db->from('master_kuota');
        $this->db->where( "id_cust = '$idCust' and tahun = '$tahun'");
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }
    function updateKuotaTerpakaiCust($idCust,$produkKg) {
        $sql2 = "update master_kuota set terpakai = (terpakai  + '$produkKg'), saldo_akhir= (saldo_akhir  - '$produkKg') where id_cust = '$idCust'";
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    public function truncateAllData() {
        $this->db->query("truncate table master_in");
        $this->db->query("truncate table master_in_camp");
        $this->db->query("truncate table master_out");
        $this->db->query("truncate table master_out_camp");
        $this->db->query("truncate table trans_campur");
        $this->db->query("truncate table trans_in");
        $this->db->query("truncate table trans_out");
        $this->db->query("truncate table trans_out_pack");
        $this->db->query("update master_produk_cukai set masuk= 0.00, masuk_campur = 0.00, masuk_lain = 0.00, keluar = 0.00, keluar_req = 0.00, keluar_campur = 0.00, keluar_lain = 0.00, stok_avl =0.00, stok_akhir = 0.00");
        
        //$result = $query->result();
        //return $result;
    }

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */