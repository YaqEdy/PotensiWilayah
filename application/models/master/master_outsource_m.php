<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_outsource_m extends CI_Model {

    public function getOutsourceAll() {
        $sql = "SELECT * from master_outsource mp left join perkiraan p on mp.kode_perk = p.kode_perk where mp.status_aktif= 1 order by mp.id_outsource asc";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getIdOutsource() {
        $sql = "select id_outsource from master_outsource";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $id_outsource = "000001";
            return $id_outsource;
        } else {
            $sql = "select max(right(id_outsource,6)) as id_outsource from master_outsource";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_outsource = $hasil[0]->id_outsource;
            $id_outsource = sprintf('%06u', $id_outsource + 1);
            return $id_outsource;
        }
    }

    public function getDescOutsource($idOutsource) {
        $this->db->select('* ');
        $this->db->from('master_outsource s');
        $this->db->where('s.id_outsource', $idOutsource);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    public function insert($data) {

        $this->db->trans_begin();
        $model = $this->db->insert('master_outsource', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function update($data, $outsourceId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_outsource', $outsourceId);
        $query2 = $this->db->update('master_outsource', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    /* 	public function cekMasterAdvance($kywId){
      $sql= "select id_kyw from master_advance where id_kyw = '$kywId'";
      $query = $this->db->query($sql);
      $jml = $query->num_rows();
      if($jml == 0){
      return true;
      }else{
      return false;
      }
      }
      public function cekMasterReqpay($kywId){
      $sql= "select id_kyw from master_reqpay where id_kyw = '$kywId'";
      $query = $this->db->query($sql);
      $jml = $query->num_rows();
      if($jml == 0){
      return true;
      }else{
      return false;
      }
      }
      public function cekMasterReimpay($kywId){
      $sql= "select id_kyw from master_reimpay where id_kyw = '$kywId'";
      $query = $this->db->query($sql);
      $jml = $query->num_rows();
      if($jml == 0){
      return true;
      }else{
      return false;
      }
      } */

    function delete($outsourceId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_outsource', $outsourceId);
        $query2 = $this->db->delete('master_outsource');
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