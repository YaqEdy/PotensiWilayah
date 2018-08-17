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
    public function getJmlKel($idKec) {
        $sql = "select * from master_kelurahan where id_kec = '$idKec' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */