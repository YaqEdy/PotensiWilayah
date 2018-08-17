<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kedatangan_m extends CI_Model {
    
    public function get_Po($tglAwal,$tglAkhir,$id_spl) {
        if($id_spl=='-'){
            $where =" where mi.tgl_trans between '$tglAwal' and '$tglAkhir' and mi.status_datang = 1 ";
        }else{
            $where =" where mi.id_spl = '$id_spl' and mi.tgl_trans between '$tglAwal' and '$tglAkhir' and mi.status_datang = 1 ";
        }
        $sql = "select * from master_in mi left join master_supplier ms on mi.id_spl = ms.id_spl ".$where." order by mi.tgl_trans asc";
        $result = $this->db->query($sql);
        return $result->result() ;
    }

    
    public function getSuplier() {
        $rows = array(); //will hold all results
        $sql = "select id_spl,nama_spl from master_supplier order by id_spl asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */