<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Koreksi_trans_campur_m extends CI_Model {

    public function getTransCampur($tglAwal, $tglAkhir) {
        $sql = "SELECT mic.id_master_in_camp, mic.tgl_trans, mi.nama_produk_jadi, mic.total_kg,mi.id_produk_jadi,mi.id_master_isi_camp as idFormula  
FROM master_in_camp mic
LEFT JOIN master_isi_camp mi ON mic.id_produk_jadi= mi.id_master_isi_camp
LEFT JOIN master_produk mp ON mic.id_produk = mp.id_produk
WHERE tgl_trans BETWEEN '$tglAwal' AND '$tglAkhir'";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }


    public function getFormula($idFormula) {
        $sql = "select id_produk_isi,packsize1 from trans_isi_camp where id_master_isi_camp = '$idFormula'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    


    function deleteMasterNTransCamp($idMaster) {
        $this->db->trans_begin();
        $sql1 = "delete from master_in_camp where id_master_in_camp ='$idMaster'";
        $sql2 = "delete from trans_in where id_master ='$idMaster'";
        $query = $this->db->query($sql1);
        $query = $this->db->query($sql2);
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