<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adjustment_m extends CI_Model {

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

    function getIdMasterAjm($bulan, $tahun){
        $sql = "select id_master_out from master_out where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun' and left(id_master_out,2)='AJ'";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        $kode = "AJ";
        $th = substr($tahun, -2);
        if ($jml == 0) {
            $id_adv = "0000001";
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        } else {
            $sql = "select max(substring(id_master_out,4,7)) as id_adv from master_out where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun' and left(id_master_out,2)='AJ'";
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

    function insertTransInOut($data) {
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
    public function cetakPOMaster($id_master) {
        $sql = "select * from master_in mi left join master_supplier ms on mi.id_spl = ms.id_spl where id_master_in = '$id_master' ";
        $query = $this->db->query($sql);
        $row = $query->result();
        return $row; // returning rows, not row
    }
    public function cetakPOTrans($id_master) {
        $sql = "select * from trans_in ti left join master_produk mp on ti.id_produk = mp.id_produk where ti.id_master = '$id_master' ";
        $query = $this->db->query($sql);
        $row = $query->result();
        return $row; // returning rows, not row
    }

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */