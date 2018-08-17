<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_produk_camp_m extends CI_Model {

    public function getProdukJadi() {
        $rows = array(); //will hold all results
        $sql = "select * from master_produk where jns_produk = 2  order by id_produk asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }
    public function getProdukMurni() {
        $rows = array(); //will hold all results
        $sql = "select * from master_produk where jns_produk = 1 or jns_produk = 3  order by id_produk asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }
    public function getProdukPencamp() {
        $rows = array(); //will hold all results
        $sql = "select * from master_produk where jns_produk = 4 order by id_produk asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function getProdukAll() {
        $sql = "SELECT * from master_isi_camp mic left join master_produk mp on mic.id_produk_jadi = mp.id_produk order by id_master_isi_camp asc";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getIdProduk() {
        $sql = "select id_master_isi_camp from master_isi_camp";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        $kode = "C";
        if ($jml == 0) {
            $id_produk = "000001";
            return $kode."-".$id_produk;
        } else {
            $sql = "select max(right(id_master_isi_camp,6)) as id_produk from master_isi_camp";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_produk = $hasil[0]->id_produk;
            $id_produk = sprintf('%06u', $id_produk + 1);
            return $kode."-".$id_produk;
        }
    }

    public function getDescMaster($idProduk) {
        $this->db->select('* ');
        $this->db->from('master_isi_camp s');
        $this->db->where('s.id_master_isi_camp', $idProduk);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getDescTrans($idProduk,$flag) {
        $this->db->select('* ');
        $this->db->from('trans_isi_camp s');
        $this->db->where('s.id_master_isi_camp', $idProduk);
        $this->db->where('s.flag_produk', $flag);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    public function insertMaster($data) {

        $this->db->trans_begin();
        $model = $this->db->insert('master_isi_camp', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    public function insertTrans($data) {

        $this->db->trans_begin();
        $model = $this->db->insert('trans_isi_camp', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function updateMaster($data, $produkId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_master_isi_camp', $produkId);
        $query2 = $this->db->update('master_isi_camp', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function updateTrans($data, $produkId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_master_isi_camp', $produkId);
        $query2 = $this->db->where('flag_produk', $data["flag_produk"]);
        $query3 = $this->db->update('trans_isi_camp', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function deleteMaster($produkId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_master_isi_camp', $produkId);
        $query2 = $this->db->delete('master_isi_camp');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function deleteTrans($produkId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_master_isi_camp', $produkId);
        $query2 = $this->db->delete('trans_isi_camp');
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

    function delete($produkId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_produk', $produkId);
        $query2 = $this->db->delete('master_produk');
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