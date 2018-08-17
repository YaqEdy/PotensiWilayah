<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekap_stok2_m extends CI_Model {
    public function createMasterProdukView($id_user) {
        $sql ="delete from master_produk_view where user_id = '$id_user'";
        $query = $this->db->query($sql);
        $sql2 = "INSERT INTO master_produk_view (
user_id,id_produk,nama_produk,id_packsize,id_storage,jns_produk,saldo_awal,masuk,masuk_campur,masuk_lain,keluar,keluar_req,keluar_campur,keluar_lain,stok_avl,stok_akhir,nama_pck1,nama_pck2,nama_pck3,nama_pck4,packsize1,packsize2,packsize3,packsize4,packsize5)
SELECT '$id_user' AS user_id,id_produk,nama_produk,id_packsize,id_storage,jns_produk,saldo_awal,masuk,masuk_campur,masuk_lain,keluar,keluar_req,keluar_campur,keluar_lain,stok_avl,stok_akhir,nama_pck1,nama_pck2,nama_pck3,nama_pck4,packsize1,packsize2,packsize3,packsize4,packsize5
FROM master_produk
";       
        $result2 = $this->db->query($sql2);        
        if ($result2){
            return 1;
        }else{
            return 0;
        }
    }
    public function getAllProduk() {
        $sql = "select id_produk from master_produk order by id_storage asc, id_produk asc ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function get_SaldoAwal($tglAwal,$id_produk) {
        $data = array();
        /*
        $sql = "SELECT coalesce(COALESCE((
SELECT saldo_awal
FROM master_produk
WHERE id_produk = '$id_produk'),0) + COALESCE((SUM(CASE WHEN
LEFT(data_mutasi.kode_trans,1) = '1' THEN qty_realisasi ELSE 0 END))- 
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
         * */
        
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
            $sql = "update master_produk_view set saldo_awal='$stok_akhir' where id_produk = '$id_produk' ";
            $query = $this->db->query($sql);
          /*  
         if($id_produk == '000002'){
                echo $stokakhir;
            die($sql);
            }*/
    }
    
    public function get_SaldoTrans($tglAwal,$tglAkhir,$id_produk) {
        $data = array();
        //coalesce(sum(data_mutasi.qty_realisasi),0) as jmlProduk
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
) AS data_mutasi"; //die($sql);
        $query = $this->db->query($sql);
         $result = $query->result() ;
         
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
            $totmmm = $tot100 +$tot120 ;// barang masuk + barang mutasi masuk
            //$totkkm = $tot200 ;// barang keluar + barang mutasi keluar
            $keluar = $tot200 + $tot220;
            $stokakhir = $tot100 + $tot110  -$tot200-$tot210-$tot220-$tot230;
            $sql = "update master_produk_view set masuk = '$totmmm', masuk_campur = '$tot110', keluar = '$keluar', keluar_campur='$tot210', keluar_lain = '$tot230' where id_produk = '$id_produk'";
            
            $query = $this->db->query($sql);
            /*
            $hasil = $query->result();
            $saldo_awal = $hasil[0]->saldo_awal;
            
            $stok_akhir = $stokakhir + $saldo_awal;
            
         
         return $result[0]->jmlProduk;
             * */
             
    }
    public function updateSaldoView($namaMasterProdukView,$saldo,$id_produk,$namaField){
        $sql = "update ".$namaMasterProdukView." set ".$namaField." = ".$saldo." where id_produk = '$id_produk'";
        
        $query = $this->db->query($sql);
        //die($sql);
        //return $result;
    }
    
    
    public function get_dataProdukView() {
        $data = array();
        $sql = "SELECT mp.id_storage,ms.nama_storage,coalesce(mp.nama_produk,'') as nama_produk,mp.id_produk,
            COALESCE(mp.saldo_awal,0) as saldo_awal,
            coalesce(mp.masuk,0) as masuk,
            coalesce(mp.masuk_campur,0) as masuk_campur, 
            coalesce(mp.keluar,0) as keluar,
            coalesce(mp.keluar_campur,0) as keluar_campur,
            coalesce(mp.saldo_awal + mp.masuk + mp.masuk_campur - mp.keluar - mp.keluar_campur -mp.keluar_lain,0) as stok_akhir, 
            coalesce(mp.keluar_lain) as keluar_lain, 
            coalesce(((coalesce(mp.saldo_awal + mp.masuk + mp.masuk_campur - mp.keluar - mp.keluar_campur-mp.keluar_lain,0))/ ms.kapasitas*100),0) as progress 
FROM master_produk_view mp
LEFT JOIN master_storage ms ON mp.id_storage = ms.id_storage 
ORDER BY ms.id_storage asc, mp.id_produk asc";
        $result = $this->db->query($sql);

        
        return $result->result();
    }
    
    
    public function get_RincianStokProduk($id_storage, $id_produk) {
        $data = array();
        $sql = "(select r.id_produk,r.kode_trans,r.tgl_trans,r.qty_realisasi,l.nama_produk from trans_in r ".
               "left join master_produk l on r.id_produk = l.id_produk ".
                "where r.id_storage = '$id_storage' and r.id_produk = '$id_produk' order by r.id_produk asc) ".
                "union all". 
                "(select r.id_produk,r.kode_trans,r.tgl_trans,r.qty_realisasi,l.nama_produk from trans_out r ".
                "left join master_produk l on r.id_produk = l.id_produk ".
                "where r.id_storage = '$id_storage' and r.id_produk = '$id_produk' order by r.id_produk asc) ".
                "union all". 
                "(select r.id_produk,r.kode_trans,r.tgl_trans,r.qty as qty_realisasi,l.nama_produk from trans_out_pack r ".
                "left join master_produk l on r.id_produk = l.id_produk ".
                "where r.id_storage = '$id_storage' and r.id_produk = '$id_produk' order by r.id_produk asc) ".
                "order by tgl_trans asc";
        $result = $this->db->query($sql);
        $jmlrow = $result->num_rows();

        if ($jmlrow == 0) {
            $data[] = array(
                'jml_row' => $jmlrow
            );
        } else {
            foreach ($result->result() as $row) {
                $data[] = array(
                    'jml_row' => $jmlrow,
                    'kode_trans' => $row->kode_trans,
                    'nama_produk' => $row->nama_produk,
                    'tgl_trans' => $row->tgl_trans,
                    'qty_kg' => $row->qty_realisasi,
                    //'qty_drum' => $row->qty_drum
                        //'child' => $this->get_dataRusun($row->id_lantai)
                );
            }
        }

        return $data;
    }

    public function getCetak($dari, $sampai, $id_lokasi) {
        $data = array();

        $sql = "select ms.ndr,ts.tgl_trans,ts.trans_jaminan,(ts.trans_pokok + ts.trans_pl) as uangsewa,ts.trans_listrik,ts.trans_air,
                ts.trans_gas,ts.denda,ts.denda_listrik,ts.denda_air,ts.denda_gas,ml.nama_lokasi,mc.nama_cust
                from trans_sewa ts
                left join master_sewa ms on ts.id_sewa = ms.id_sewa
                left join master_room mr on ms.id_room = mr.id_room
                left join master_lokasi ml on mr.id_lokasi = ml.id_lokasi
                left join master_customer mc on mr.id_cust = mc.id_cust
                WHERE ml.id_lokasi='$id_lokasi' and ts.status_koreksi = '0' and ms.status_sewa = '1' and ts.kode_trans in ('301','302') 
                and ts.tgl_trans BETWEEN '$dari' and '$sampai'";
        $hasil = $this->db->query($sql);

        if ($hasil->num_rows() > 0) {
            $data = $hasil->result();
        }

        $hasil->free_result();

        return $data;
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

    public function getStorage() {
        $rows = array(); //will hold all results
        $sql = "select * from master_storage order by id_storage asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function getCust() {
        $rows = array(); //will hold all results
        $sql = "select * from master_customer order by id_cust asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

   
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */