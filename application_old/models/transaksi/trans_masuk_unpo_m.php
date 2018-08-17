<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_masuk_unpo_m extends CI_Model {

    public function getProduk() {
        $rows = array(); //will hold all results
        $sql = "select * from master_produk where jns_produk = 1 or jns_produk = 3  or jns_produk = 4 or jns_produk = 5 order by id_produk asc ";
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

    public function getSuplier() {
        $rows = array(); //will hold all results
        $sql = "select * from master_supplier order by id_spl asc ";
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

    function getIdMasterIn($bulan, $tahun) {
        $sql = "select id_master_in from master_in where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun'";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        $kode = "AV";
        $th = substr($tahun, -2);
        if ($jml == 0) {
            $id_adv = "0000001";
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        } else {
            $sql = "select max(substring(id_master_in,4,7)) as id_adv from master_in where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun'";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_adv = $hasil[0]->id_adv;
            $id_adv = sprintf('%07u', $id_adv + 1);
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        }
    }
    function getNoPO($bulan, $tahun) {
        $sql = "select no_po from master_in where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun' and no_po <> ''";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        $kode = "PO";
        $th = substr($tahun, -2);
        if ($jml == 0) {
            $id_adv = "0000001";
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        } else {
            $sql = "select max(substring(no_po,4,7)) as id_adv from master_in where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun' and no_po <> ''";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_adv = $hasil[0]->id_adv;
            $id_adv = sprintf('%07u', $id_adv + 1);
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        }
    }

    function insertMaster($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('master_in', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function insertTransIn($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('trans_in', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    public function cetakStbMaster($id_master) {
        $sql = "select * from master_in mi left join master_supplier ms on mi.id_spl = ms.id_spl where id_master_in = '$id_master' ";
        $query = $this->db->query($sql);
        $row = $query->result();
        return $row; // returning rows, not row
    }
    public function cetakStbTrans($id_master) {
        $sql = "select * from trans_in ti left join master_produk mp on ti.id_produk = mp.id_produk where ti.id_master = '$id_master' ";
        $query = $this->db->query($sql);
        $row = $query->result();
        return $row; // returning rows, not row
    }
//    function updateMProduk($qty_kg, $id_produk) {
//        $sql2 = "update master_produk set masuk= (masuk  + '$qty_kg') where id_produk = '$id_produk'";
//        $query = $this->db->query($sql2);
//        if ($this->db->trans_status() === FALSE) {
//            $this->db->trans_rollback();
//            return false;
//        } else {
//            $this->db->trans_commit();
//            return true;
//        }
//    }
    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */