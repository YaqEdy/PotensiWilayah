<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengiriman_m extends CI_Model {
    public function get_dataProduk() {
        $data = array();
        $sql = "SELECT mp.id_storage,ms.nama_storage,coalesce(mp.nama_produk,'') as nama_produk,mp.id_produk,
            COALESCE(mp.saldo_awal,0) as saldo_awal,
            coalesce(mp.masuk,0) as masuk,
            coalesce(mp.masuk_campur,0) as masuk_campur, 
            coalesce(mp.keluar,0) as keluar,
            coalesce(mp.keluar_campur,0) as keluar_campur,
            coalesce(mp.saldo_awal + mp.masuk + mp.masuk_campur - mp.keluar - mp.keluar_campur,0) as stok_akhir, 
            coalesce(mp.saldo_awal + mp.stok_avl) as stok_avl, 
            coalesce(((coalesce(mp.saldo_awal + mp.masuk + mp.masuk_campur - mp.keluar - mp.keluar_campur,0))/ ms.kapasitas*100),0) as progress 
FROM master_produk mp
LEFT JOIN master_storage ms ON mp.id_storage = ms.id_storage 
ORDER BY mp.id_produk asc, ms.id_storage asc";
        $result = $this->db->query($sql);

        
        return $result->result();
    }
    public function getRencanaOutAll($tglAwal, $tglAkhir) {
        $sql = "SELECT mo.id_master_out as id_master_out, 
            mc.nama_cust as nama_cust,
            mo.no_suratjalan as no_sj,
            mp.nama_produk as nama_produk,
            mjd.no_jnsdoc as no_jnsdoc,
            mjd.nama_jnsdoc as nama_jnsdoc,
            mo.total_qty as total_qty,
            mo.no_batch as no_batch, 
            mo.nama_pengirim,
            mo.no_mobil,
            mo.no_aju as no_aju,
            mo.no_cukai as no_cukai, 
            mo.etd as etd, 
            mo.keterangan_distribusi, 
            mo.status_distribusi, 
            mo.status_pack, 
            mo.status_keluar 
            FROM master_out mo 
            LEFT JOIN master_customer mc ON mo.id_cust = mc.id_cust 
            left join trans_out tou on mo.id_master_out = tou.id_master 
            left join master_produk mp on tou.id_produk = mp.id_produk 
            left join master_jnsdoc mjd on mo.id_jnsdoc = mjd.id_jnsdoc 
            where mo.etd between '$tglAwal' and '$tglAkhir' and jns_out= 0";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

   
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */