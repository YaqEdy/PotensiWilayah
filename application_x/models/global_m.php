<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Global_m extends CI_Model {

    public function getSelectOption($tabel,$par1,$var1,$par2,$var2,$orderbyasc) {
        if($par1 != ''){
            $par1 =  'where '.$par1.'= ';
        }
        $rows = array(); //will hold all results
        $sql = "select * from $tabel $par1  $var1 order by $orderbyasc asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }
    public function getRincianKel($idKec) {
        $sql = "select * from master_kelurahan where id_kec = '$idKec' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            
            $rows['data_cpa'] = $query->result();
            return $rows;
        } else {
            return false;
        }
    }
    public function getRincianBanjar($idKel) {
        $sql = "select * from master_banjar where id_kel = '$idKel' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            
            $rows['data_cpa'] = $query->result();
            return $rows;
        } else {
            return false;
        }
    }
    public function getJmlKel($idKec) {
        $sql = "select * from master_kelurahan where id_kec = '$idKec' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }
    public function getJmlBanjar($idKel) {
        $sql = "select * from master_banjar where id_kel = '$idKel' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }
    public function get_data($sql) {
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function get_data_array($sql){
        $rows = array(); //will hold all results
        
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function simpan($tabel, $data) {
        $this->db->trans_begin();
        $model = $this->db->insert($tabel, $data);
//        echo $this->db->last_query(); die();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function ubah($tabel, $data, $id_kolom, $id_data) {
        $this->db->trans_begin();
        $query1 = $this->db->where($id_kolom, $id_data);
        $query2 = $this->db->update($tabel, $data);

        // echo $this->db->last_query(); die('');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function query($sql){
		$this->db->trans_begin();
        $query = $this->db->query($sql);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	}



}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */