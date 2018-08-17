<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mutasi_produk_m extends CI_Model {

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

    public function get_RincianStokProduk($tglAwal,$tglAkhir,$id_produk) {
        $data = array();
        $sql = "SELECT *
FROM(
(
SELECT r.id_produk,r.id_storage,r.kode_trans,r.tgl_trans,r.qty_realisasi,l.nama_produk,ms.nama_storage 
FROM trans_in r
LEFT JOIN master_produk l ON r.id_produk = l.id_produk 
left join master_storage ms on r.id_storage = ms.id_storage 
WHERE (r.tgl_trans BETWEEN '$tglAwal' AND '$tglAkhir') and r.id_produk = '$id_produk' and qty_realisasi > 0 
ORDER BY r.id_produk ASC) UNION ALL 
 (
SELECT r.id_produk,r.id_storage,r.kode_trans,r.tgl_trans,r.qty_realisasi,l.nama_produk,ms.nama_storage 
FROM trans_out r
LEFT JOIN master_produk l ON r.id_produk = l.id_produk 
left join master_storage ms on r.id_storage = ms.id_storage 
WHERE (r.tgl_trans BETWEEN '$tglAwal' AND '$tglAkhir') and r.id_produk = '$id_produk' and qty_realisasi > 0 
ORDER BY r.id_produk ASC) UNION ALL 
 (
SELECT r.id_produk,r.id_storage,r.kode_trans,r.tgl_trans,r.qty AS qty_realisasi,l.nama_produk,ms.nama_storage 
FROM trans_out_pack r
LEFT JOIN master_produk l ON r.id_produk = l.id_produk 
left join master_storage ms on r.id_storage = ms.id_storage 
WHERE (r.tgl_trans BETWEEN '$tglAwal' AND '$tglAkhir') and r.id_produk = '$id_produk' and qty > 0 
ORDER BY r.id_produk ASC)
ORDER BY tgl_trans ASC
) AS data_mutasi";
        $result = $this->db->query($sql);
        

        return $result->result() ;
    }

    public function get_SaldoAwal($tglAwal,$id_produk) {
        /* 
        $data = array();
        $sql = "SELECT coalesce(COALESCE((
SELECT saldo_awal
FROM master_produk
WHERE id_produk = '$id_produk'),0) + COALESCE((SUM(CASE WHEN
LEFT(data_mutasi.kode_trans,1) = '1' THEN qty_realisasi ELSE 0 END))+ 
 (SUM(CASE WHEN
LEFT(data_mutasi.kode_trans,1) = '2' THEN qty_realisasi ELSE 0 END)),0),0) AS saldo_awal
FROM(
(
SELECT r.id_produk,r.id_storage,r.kode_trans,r.tgl_trans,r.qty_realisasi,l.nama_produk,ms.nama_storage
FROM trans_in r
LEFT JOIN master_produk l ON r.id_produk = l.id_produk
LEFT JOIN master_storage ms ON r.id_storage = ms.id_storage
WHERE (r.tgl_trans < '$tglAwal') AND r.id_produk = '$id_produk'
ORDER BY r.id_produk ASC) UNION ALL 
 (
SELECT r.id_produk,r.id_storage,r.kode_trans,r.tgl_trans,r.qty_realisasi,l.nama_produk,ms.nama_storage
FROM trans_out r
LEFT JOIN master_produk l ON r.id_produk = l.id_produk
LEFT JOIN master_storage ms ON r.id_storage = ms.id_storage
WHERE (r.tgl_trans < '$tglAwal') AND r.id_produk = '$id_produk'
ORDER BY r.id_produk ASC) UNION ALL 
 (
SELECT r.id_produk,r.id_storage,r.kode_trans,r.tgl_trans,r.qty AS qty_realisasi,l.nama_produk,ms.nama_storage
FROM trans_out_pack r
LEFT JOIN master_produk l ON r.id_produk = l.id_produk
LEFT JOIN master_storage ms ON r.id_storage = ms.id_storage
WHERE (r.tgl_trans < '$tglAwal') AND r.id_produk = '$id_produk'
ORDER BY r.id_produk ASC)
ORDER BY tgl_trans ASC
) AS data_mutasi";
        $result = $this->db->query($sql);
        $result= $result->result() ;
        return $result[0]->saldo_awal;
         
         */
        $sql_produk = "SELECT *
FROM(
(
SELECT r.id_produk,r.id_storage,r.kode_trans,r.tgl_trans,r.qty_realisasi,l.nama_produk,ms.nama_storage 
FROM trans_in r
LEFT JOIN master_produk l ON r.id_produk = l.id_produk 
left join master_storage ms on r.id_storage = ms.id_storage 
WHERE (r.tgl_trans < '$tglAwal') AND r.id_produk = '$id_produk' and qty_realisasi > 0 
) UNION ALL 
 (
SELECT r.id_produk,r.id_storage,r.kode_trans,r.tgl_trans,r.qty_realisasi,l.nama_produk,ms.nama_storage 
FROM trans_out r
LEFT JOIN master_produk l ON r.id_produk = l.id_produk 
left join master_storage ms on r.id_storage = ms.id_storage 
WHERE (r.tgl_trans < '$tglAwal') AND r.id_produk = '$id_produk' and qty_realisasi > 0 
) UNION ALL 
 (
SELECT r.id_produk,r.id_storage,r.kode_trans,r.tgl_trans,r.qty AS qty_realisasi,l.nama_produk,ms.nama_storage 
FROM trans_out_pack r
LEFT JOIN master_produk l ON r.id_produk = l.id_produk 
left join master_storage ms on r.id_storage = ms.id_storage 
WHERE (r.tgl_trans < '$tglAwal') AND r.id_produk = '$id_produk' and qty > 0 
)
) AS data_mutasi";
            $query = $this->db->query($sql_produk);
            $stok_produk = $query->result();
            
            $tot100 = 0;
            $tot110 = 0;
            $tot120 = 0;
            $tot200 = 0;
            $tot210 = 0;
            $tot220 = 0;
            $tot230 = 0;
            foreach ($stok_produk as $dat) {
                if ($dat->kode_trans == 100) {
                    $tot100 = $tot100 + $dat->qty_realisasi;
                } else if ($dat->kode_trans == 200) {
                    $tot200 = $tot200 + $dat->qty_realisasi;
                } else if ($dat->kode_trans == 110) {
                    $tot110 = $tot110 + $dat->qty_realisasi;
                } else if ($dat->kode_trans == 210) {
                    $tot210 = $tot210 + $dat->qty_realisasi;
                } else if ($dat->kode_trans == 120) {
                    $tot120 = $tot120 + $dat->qty_realisasi;
                } else if ($dat->kode_trans == 220) {
                    $tot220 = $tot220 + $dat->qty_realisasi;
                }else if ($dat->kode_trans == 230) {
                    $tot230 = $tot230 + $dat->qty_realisasi;
                }
                
            }
            $totmmm = $tot100;// barang masuk + barang mutasi masuk
            $totkkm = $tot200;// barang keluar + barang mutasi keluar
            $keluar = $tot200 + $tot220+$tot230;
            $stokakhir = $tot100 + $tot110  -$tot200-$tot210-$tot220-$tot230;
            $sql = "select saldo_awal from master_produk where id_produk = '$id_produk'";
            
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $saldo_awal = $hasil[0]->saldo_awal;
            
            $stok_akhir = $stokakhir + $saldo_awal;
            
            return $stok_akhir;
    }

    public function getProduk() {
        $rows = array(); //will hold all results
        $sql = "select * from master_produk order by id_produk asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function get_produkName($idProduk) {
        $sql = "select nama_produk from master_produk where id_produk ='$idProduk'";
        $query = $this->db->query($sql);
        
        return $query->result(); // returning rows, not row
    }

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */