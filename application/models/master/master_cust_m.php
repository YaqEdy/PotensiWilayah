<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_cust_m extends CI_Model {

    public function getCustAll() {
        $sql = "SELECT * from master_customer mc where mc.status_aktif = 1 order by mc.id_cust asc";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getIdCust() {
        $sql = "select id_cust from master_customer";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $id_cust = "000001";
            return $id_cust;
        } else {
            $sql = "select max(right(id_cust,6)) as id_cust from master_customer";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_cust = $hasil[0]->id_cust;
            $id_cust = sprintf('%06u', $id_cust + 1);
            return $id_cust;
        }
    }
    

    public function getDescCust($idCust) {
        $this->db->select('* ');
        $this->db->from('master_customer s');
        $this->db->where('s.id_cust', $idCust);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getSearchCust($namaCust) {
        $this->db->select('* ');
        $this->db->from('master_customer s');
        $this->db->like('s.nama_cust', $namaCust);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return json_encode($query->result());
        }
    }
    
    public function insert($data) {

        $this->db->trans_begin();
        $model = $this->db->insert('master_customer', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function update($data, $custId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_cust', $custId);
        $query2 = $this->db->update('master_customer', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    

    function delete($custId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_cust', $custId);
        $query2 = $this->db->delete('master_customer');
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