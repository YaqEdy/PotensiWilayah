<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_masuk_m extends CI_Model {

    public function getPOAll() {
        $sql = "SELECT * from master_in mi left join master_supplier ms on mi.id_spl = ms.id_spl where mi.status_datang = '1' and  mi.status_cukai = '0'";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    
    public function getDescPO($idMaster) {

        $sql = "select * from master_in mi left join master_supplier ms on mi.id_spl = ms.id_spl where mi.id_master_in = '$idMaster' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getJmlRincianPO($idMaster) {
        $sql = "select * from trans_in ti "
                . "left join master_produk mp on ti.id_produk = mp.id_produk "
                . "left join master_storage ms on ti.id_storage = ms.id_storage "
                . "where id_master = '$idMaster' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            $data['jml']= $query->num_rows();
            return $data;
        } else {
            return false;
        }
    }
    public function getRincianPO($idMaster) {
        $sql = "select * from trans_in ti "
                . "left join master_produk mp on ti.id_produk = mp.id_produk "
                . "left join master_storage ms on ti.id_storage = ms.id_storage "
                . "where id_master = '$idMaster' ";
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
    function insertTransInCukai($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('trans_in_cukai', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function updateTransIn($dataTrans,$tmpKdTrans) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_trans_in', $tmpKdTrans);
        $query2 = $this->db->update('trans_in_cukai', $dataTrans);
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