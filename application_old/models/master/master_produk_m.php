<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_produk_m extends CI_Model {

    public function getStorage() {
        $rows = array(); //will hold all results
        $sql = "select * from master_storage order by id_storage asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }
    public function getJnsProduk() {
        $rows = array(); //will hold all results
        $sql = "select * from master_jns_produk order by id_jns_produk asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function getProdukAll() {
        $sql = "SELECT * from master_produk mp where mp.status_aktif= 1 order by mp.id_produk asc";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getIdProduk() {
        $sql = "select id_produk from master_produk";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $id_produk = "000001";
            return $id_produk;
        } else {
            $sql = "select max(right(id_produk,6)) as id_produk from master_produk";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_produk = $hasil[0]->id_produk;
            $id_produk = sprintf('%06u', $id_produk + 1);
            return $id_produk;
        }
    }

    public function getDescProduk($idProduk) {
        $this->db->select('* ');
        $this->db->from('master_produk s');
        $this->db->where('s.id_produk', $idProduk);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    public function insert($data) {

        $this->db->trans_begin();
        $model = $this->db->insert('master_produk', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function update($data, $produkId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_produk', $produkId);
        $query2 = $this->db->update('master_produk', $data);
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