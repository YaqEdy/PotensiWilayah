<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_masuk_po_m extends CI_Model {

    public function getPOAll() {
        $sql = "SELECT * from master_in mi left join master_supplier ms on mi.id_spl = ms.id_spl where mi.no_po <> '' and mi.status_datang = 0";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    
    public function getDescPO($noPO) {

        $sql = "select * from master_in mi left join master_supplier ms on mi.id_spl = ms.id_spl where mi.no_po = '$noPO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getJmlRincianPO($noPO) {
        $sql = "select * from trans_in ti "
                . "left join master_produk mp on ti.id_produk = mp.id_produk "
                . "left join master_storage ms on ti.id_storage = ms.id_storage "
                . "where no_po = '$noPO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            $data['jml']= $query->num_rows();
            return $data;
        } else {
            return false;
        }
    }
    public function getRincianPO($noPO) {
        $sql = "select * from trans_in ti "
                . "left join master_produk mp on ti.id_produk = mp.id_produk "
                . "left join master_storage ms on ti.id_storage = ms.id_storage "
                . "where no_po = '$noPO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function updateMasterIn($data, $id_master) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_master_in', $id_master);
        $query2 = $this->db->update('master_in', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
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

    function updateTransIn($dataTrans,$tmpKdTrans) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_trans_in', $tmpKdTrans);
        $query2 = $this->db->update('trans_in', $dataTrans);
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

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */