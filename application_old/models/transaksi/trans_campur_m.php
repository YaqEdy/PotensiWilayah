<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_campur_m extends CI_Model {

    public function getProduk() {
        $rows = array(); //will hold all results
        $sql = "select * from master_isi_camp order by id_master_isi_camp asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }
    public function getProdukKatalis() {
        $rows = array(); //will hold all results
        $sql = "select * from master_produk where jns_produk = 4 order by id_produk asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }
    //
    public function getProdukJadi($idProdukJadiCamp) {
        $sql = "select id_produk_jadi from master_isi_camp where id_master_isi_camp='$idProdukJadiCamp' ";
        $query = $this->db->query($sql);
        $row = $query->result();
        return $row; // returning rows, not row
    }
    public function getCIsiCamp($idProdukJadi)
	{
		$this->db->select ( '*' );
		$this->db->from('trans_isi_camp');
		$this->db->where ( 'id_master_isi_camp', $idProdukJadi );
//
		$query = $this->db->get ();
		return $query->num_rows();
	}
	public function getDescIsiCamp($idProdukJadi)
	{
		$this->db->select ( 'mic.total_isi,tc.id_produk_isi,mp.nama_produk,ms.id_storage,ms.nama_storage,tc.packsize1' );
		$this->db->from('trans_isi_camp tc');
                $this->db->join('master_isi_camp mic', 'tc.id_master_isi_camp = mic.id_master_isi_camp', 'LEFT');
                $this->db->join('master_produk mp', 'tc.id_produk_isi = mp.id_produk', 'LEFT');
                $this->db->join('master_storage ms', 'mp.id_storage = ms.id_storage', 'LEFT');
		$this->db->where ( 'tc.id_master_isi_camp', $idProdukJadi );
		$query = $this->db->get ();

		$rows['data_cpa'] = $query->result();
		return $rows;

	}
        public function getDescIsiCamp2($idProdukJadi)
	{
            //$rows = array();
		$this->db->select ( 'tc.id_produk_isi,mp.nama_produk,ms.id_storage,ms.nama_storage,tc.packsize1' );
		$this->db->from('trans_isi_camp tc');
                $this->db->join('master_produk mp', 'tc.id_produk_isi = mp.id_produk', 'LEFT');
                $this->db->join('master_storage ms', 'mp.id_storage = ms.id_storage', 'LEFT');
		$this->db->where ( 'tc.id_master_isi_camp', $idProdukJadi );
		$query = $this->db->get ();

		$rows = $query->result();
		return $rows;

	}
    
        public function getStorage() {
        $rows = array(); //will hold all results
        $sql = "select * from master_storage order by id_storage asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function getCust() {
        $rows = array(); //will hold all results
        $sql = "select * from master_customer order by id_cust asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function getDescProduk($idProduk) {
        $this->db->select('*');
        $this->db->from('master_produk');
        $this->db->where('id_produk', $idProduk);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getDescProdukJadi($idProduk) {
        
        $sql = "SELECT mp.id_storage
FROM master_isi_camp mc
LEFT JOIN master_produk mp ON mc.id_produk_jadi = mp.id_produk
WHERE mc.id_master_isi_camp ='$idProduk'";
        $query = $this->db->query($sql);
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getDescStorage($idStorage) {
        $this->db->select('mjs.nama_jns_storage');
        $this->db->from('master_storage ms');
        $this->db->join('master_jns_storage mjs', 'ms.id_jns_storage = mjs.id_jns_storage', 'LEFT');
        $this->db->where('ms.id_storage', $idStorage);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    function getIdMasterInCamp($bulan, $tahun) {
        $sql = "select id_master_in_camp from master_in_camp where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun'";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        $kode = "IC";
        $th = substr($tahun, -2);
        if ($jml == 0) {
            $id_adv = "0000001";
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        } else {
            $sql = "select max(substring(id_master_in_camp,4,7)) as id_adv from master_in_camp where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun'";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_adv = $hasil[0]->id_adv;
            $id_adv = sprintf('%07u', $id_adv + 1);
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        }
    }

    function insertMasterInCamp($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('master_in_camp', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    
    function insertTransIn($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('trans_in', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function insertTransOut($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('trans_out', $data);
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