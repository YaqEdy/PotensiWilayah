<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Input_kuota_m extends CI_Model {

    function getTahun() {
        $rows = array(); //will hold all results
        $sql = "select distinct(tahun) as tahun from master_kuota order by tahun asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function getKuota($tahun) {
        $sql = "SELECT k.*,c.nama_cust from master_kuota k 
		left join master_customer c on k.id_cust = c.id_cust where k.tahun = '$tahun' ";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getTotalKuota($tahun, $proyek) {
        $sql = "select 	sum(kuota) as total	
				from master_kuota b where b.tahun = '$tahun' ";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    function update($data, $id_cust, $tahun) {
        $this->db->trans_begin();
        $sql2 = "update master_kuota set kuota = '$data[kuota]', no_skep = '$data[no_skep]', saldo_akhir = ('$data[kuota]' - terpakai) where id_cust = '$id_cust' and tahun = '$tahun'";
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    public function insertKuota($data) {

        $this->db->trans_begin();
        $model = $this->db->insert('master_kuota', $data);
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