<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hapus_trans_m extends CI_Model {

    public function getAgenAll() {
        $sql = "SELECT * from master_agen mp left join perkiraan p on mp.kode_perk = p.kode_perk where mp.status_aktif= 1 order by mp.id_agen asc";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getIdAgen() {
        $sql = "select id_agen from master_agen";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $id_agen = "000001";
            return $id_agen;
        } else {
            $sql = "select max(right(id_agen,6)) as id_agen from master_agen";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_agen = $hasil[0]->id_agen;
            $id_agen = sprintf('%06u', $id_agen + 1);
            return $id_agen;
        }
    }

    public function getDescAgen($idAgen) {
        $this->db->select('* ');
        $this->db->from('master_agen s');
        $this->db->where('s.id_agen', $idAgen);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    public function insert($data) {

        $this->db->trans_begin();
        $model = $this->db->insert('master_agen', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function update($data, $agenId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_agen', $agenId);
        $query2 = $this->db->update('master_agen', $data);
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

    function delete($masterId,$namaTabel,$field) {
        $this->db->trans_begin();
        $query1 = $this->db->where($field, $masterId);
        $query2 = $this->db->delete($namaTabel);
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