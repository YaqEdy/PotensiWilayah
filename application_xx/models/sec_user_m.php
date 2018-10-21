<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sec_user_m extends CI_Model {

    public function get_level_user() {
        $rows = array(); //will hold all results
        $sql = "select * from sec_level order by level_id asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function insertUser($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('sec_passwd', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function updateUser($data, $userId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('userid', $userId);
        $query2 = $this->db->update('sec_passwd', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function deleteUser($userId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('userid', $userId);
        $query2 = $this->db->delete('sec_passwd');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function getUserInfo() {
        /* $sql="SELECT * from sec_passwd ";
          $query=$this->db->query($sql);
          return $query->result(); // returning rows, not row */

        $this->db->select('sp.userid, sp.username, sp.id_kyw,sp.password, sp.usergroup, mk.nama_kyw');
        $this->db->from('sec_passwd sp');
        $this->db->join('master_karyawan mk', 'sp.id_kyw = mk.id_kyw', 'LEFT');
        //$this->db->join('master_dept md', 'mk.dept_kyw=md.id_dept', 'LEFT');
        $query = $this->db->get();
        return $query->result();
    }

    function getAllKaryawan() {
        $sql = "SELECT * from master_karyawan";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getNamaKaryawan($id) {
        $this->db->select('nama_kyw');
        $this->db->from('master_karyawan');
        $this->db->where('id_kyw', $id);
        $query = $this->db->get();
        return $query->row()->nama_kyw;
    }

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */