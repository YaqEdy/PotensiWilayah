<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Packaging_m extends CI_Model {

    public function getRencanaOutAll() {
        $sql = "SELECT * from master_out mo left join master_customer mc on mo.id_cust = mc.id_cust where mo.status_keluar = 0 and mo.status_pack=0";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    
    public function getDescSO($noSO) {
        $sql = "select * from master_out mo left join master_customer mc on mo.id_cust = mc.id_cust where mo.id_master_out = '$noSO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getJmlRincianSO($noSO) {
        $sql = "select * from trans_out ti "
                . "left join master_produk mp on ti.id_produk = mp.id_produk "
                . "left join master_storage ms on ti.id_storage = ms.id_storage "
                . "where id_master = '$noSO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            $data['jml']= $query->num_rows();
            return $data;
        } else {
            return false;
        }
    }
    public function getRincianSO($noSO) {
        $sql = "select * from trans_out ti "
                . "left join master_produk mp on ti.id_produk = mp.id_produk "
                . "left join master_storage ms on ti.id_storage = ms.id_storage "
                . "where id_master = '$noSO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getProduk() {
        $rows = array(); //will hold all results
        $sql = "select * from master_produk where jns_produk = 5 order by id_produk asc ";
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

    function updateMasterOut($data, $id_master) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_master_out', $id_master);
        $query2 = $this->db->update('master_out', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    
    function updateMProduk($qty_kg, $id_produk) {
        $sql2 = "update master_produk set keluar = (keluar  + '$qty_kg') where id_produk = '$id_produk'";
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function insertTransOutPack($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('trans_out_pack', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */