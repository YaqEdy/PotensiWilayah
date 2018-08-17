<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekap_stok_m extends CI_Model {
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