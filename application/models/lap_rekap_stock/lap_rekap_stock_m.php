<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_rekap_stock_m extends CI_Model {

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

    public function getDescProduk($idProduk) {
        $this->db->select('*');
        $this->db->from('master_produk');
        $this->db->where('id_produk', $idProduk);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getDescStorage($idStorage) {
        $this->db->select('mjs.nama_jns_storage');
        $this->db->from('master_storage ms');
        $this->db->join('master_jns_storage mjs', 'ms.id_jns_storage = mjs.id_jns_storage', 'LEFT');
        $this->db->where('ms.id_storage', $idStorage);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    /*
      query get data stock saat ini
     * 
     * SELECT ms.id_storage,ms.nama_storage, COALESCE((mp.saldo_awal+ SUM(mp.masuk+mp.masuk_lain -mp.keluar-mp.keluar_lain)),0)
      FROM master_storage ms
      LEFT JOIN master_produk mp ON ms.id_storage = mp.id_storage
      GROUP BY mp.id_storage
      ORDER BY ms.id_storage
     *  */

    public function get_dataStorage($id_storage, $tglTrans) {
        $data = array();
//$sql = "SELECT ms.id_storage,ms.nama_storage, COALESCE((mp.saldo_awal+ SUM(mp.masuk+mp.masuk_lain -mp.keluar-mp.keluar_lain)),0) as stok 
//FROM master_storage ms
//LEFT JOIN master_produk mp ON ms.id_storage = mp.id_storage 
//GROUP BY mp.id_storage
//ORDER BY ms.id_storage";
        $sql = "SELECT ms.id_storage,ms.nama_storage,mp.nama_produk,mp.id_produk,
            COALESCE(mp.saldo_awal,0) as saldo_awal,
            coalesce(mp.masuk,0) as masuk,
            coalesce(mp.masuk_campur,0) as masuk_campur, 
            coalesce(mp.keluar,0) as keluar,
            coalesce(mp.keluar_campur,0) as keluar_campur,
            coalesce(mp.saldo_awal + mp.masuk + mp.masuk_campur - mp.keluar - mp.keluar_campur,0) as stok_akhir 
FROM master_storage ms
LEFT JOIN master_produk mp ON ms.id_storage = mp.id_storage 
ORDER BY ms.id_storage";
        $result = $this->db->query($sql);

        foreach ($result->result() as $row) {
            $data[] = array(
                'id_storage' => $row->id_storage,
                'nama_storage' => $row->nama_storage,
                'id_produk' => $row->id_produk,
                'nama_produk' => $row->nama_produk,
                'saldo_awal' => $row->saldo_awal,
                'masuk' => $row->masuk,
                'masuk_campur' => $row->masuk_campur,
                'keluar' => $row->keluar,
                'keluar_campur' => $row->keluar_campur,
                'stok_akhir' => $row->stok_akhir,
                // recursive
                'child' => $this->get_RincianStok($row->id_storage, $row->id_produk)
            );
        }
        return $data;
    }

    public function get_RincianStok($id_storage, $id_produk) {
        $data = array();
        $sql = "(select r.id_produk,r.kode_trans,r.tgl_trans,r.qty_realisasi,l.nama_produk from trans_in r ".
               "left join master_produk l on r.id_produk = l.id_produk ".
                "where r.id_storage = '$id_storage' and r.id_produk = '$id_produk' and r.qty_realisasi <> 0 ".
                "order by r.id_produk asc) ".
                "union all". 
                "(select r.id_produk,r.kode_trans,r.tgl_trans,r.qty_realisasi,l.nama_produk from trans_out r ".
                "left join master_produk l on r.id_produk = l.id_produk ".
                "where r.id_storage = '$id_storage' and r.id_produk = '$id_produk' and r.qty_realisasi <> 0 ".
                "order by r.id_produk asc) ".
                "union all". 
                "(select r.id_produk,r.kode_trans,r.tgl_trans,r.qty as qty_realisasi,l.nama_produk from trans_out_pack r ".
                "left join master_produk l on r.id_produk = l.id_produk ".
                "where r.id_storage = '$id_storage' and r.id_produk = '$id_produk' and r.qty <> 0 order by r.id_produk asc) ".
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

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */