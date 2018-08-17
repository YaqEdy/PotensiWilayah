<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_jenissentra_m extends CI_Model {

    public function getJenissentraAll() {
        $sql = "SELECT * from master_jenissentra ";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getIdJenissentra() {
        $sql = "select id_jenissentra from master_jenissentra";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $id_jenissentra = "000001";
            return $id_jenissentra;
        } else {
            $sql = "select max(right(id_jenissentra,6)) as id_jenissentra from master_jenissentra";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_jenissentra = $hasil[0]->id_jenissentra;
            $id_jenissentra = sprintf('%06u', $id_jenissentra + 1);
            return $id_jenissentra;
        }
    }

    public function getDescJenissentra($idJenissentra) {
        $this->db->select('s.nama_jenissentra, s.alamat, s.telp, s.npwp ');
        $this->db->from('master_jenissentra s');
        $this->db->where('s.id_jenissentra', $idJenissentra);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    public function insert($data) {

        $this->db->trans_begin();
        $model = $this->db->insert('master_jenissentra', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function update($data, $jenissentraId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_jenissentra', $jenissentraId);
        $query2 = $this->db->update('master_jenissentra', $data);
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

    function delete($jenissentraId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_jenissentra', $jenissentraId);
        $query2 = $this->db->delete('master_jenissentra');
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