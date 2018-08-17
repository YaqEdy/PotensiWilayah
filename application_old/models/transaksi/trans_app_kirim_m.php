<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_app_kirim_m extends CI_Model {
    
    function getNoSuratJalan($bulan, $tahun) {
        $sql = "select no_suratjalan from master_out where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun'";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        $kode = "SJ";
        $th = substr($tahun, -2);
        if ($jml == 0) {
            $id_adv = "0000001";
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        } else {
            $sql = "select max(substring(no_suratjalan,4,7)) as id_adv from master_out where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun'";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_adv = $hasil[0]->id_adv;
            $id_adv = sprintf('%07u', $id_adv + 1);
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        }
    }
    public function getRencanaOutAll($tglAwal, $tglAkhir) {
        $sql = "SELECT mo.id_master_out as id_master_out, 
            mc.nama_cust as nama_cust,
            mo.no_suratjalan as no_sj,
            mp.nama_produk as nama_produk,
            mjd.no_jnsdoc as no_jnsdoc,
            mjd.nama_jnsdoc as nama_jnsdoc,
            mo.total_qty as total_qty,
            mo.no_batch as no_batch,
            mo.no_aju as no_aju,
            mo.no_cukai as no_cukai, 
            mo.etd as etd, 
            mo.keterangan_so, 
            mo.status_distribusi, 
            mo.status_pack, 
            mo.status_keluar 
            FROM master_out mo 
            LEFT JOIN master_customer mc ON mo.id_cust = mc.id_cust  
            left join master_produk mp on mo.id_produk = mp.id_produk 
            left join master_jnsdoc mjd on mo.id_jnsdoc = mjd.id_jnsdoc 
            where mo.etd between '$tglAwal' and '$tglAkhir'";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    /*
    public function getRencanaOutAll() {
        $sql = "SELECT * from master_out mo left join master_customer mc on mo.id_cust = mc.id_cust where mo.status_keluar = 0 and mo.status_pack=1";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    */
    public function getDescSO($noSO) {

        $sql = "select * from master_out mo left join master_customer mc on mo.id_cust = mc.id_cust left join master_jnsdoc mj on mo.id_jnsdoc = mj.id_jnsdoc where mo.id_master_out = '$noSO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getAllRincianSO($noSO) {
        $sql = "select ti.id_produk,mp.nama_produk from trans_out ti left join master_produk mp on ti.id_produk = mp.id_produk where id_master = '$noSO' union all
select ti.id_produk,mp.nama_produk from trans_out_pack ti  left join master_produk mp on ti.id_produk = mp.id_produk where id_master_out = '$noSO'";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getJmlRincianSO($noSO) {
        $sql = "select * from trans_out ti "
                . "left join master_produk mp on ti.id_produk = mp.id_produk "
                . "left join master_storage ms on ti.id_storage = ms.id_storage "
                . "where id_master = '$noSO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            $data['jml']= $query->num_rows();
            return $data;
        } else {
            return false;
        }
    }
    public function getRincianSO($noSO) {
        $sql = "select * from trans_out ti "
                . "left join master_produk mp on ti.id_produk = mp.id_produk "
                . "left join master_storage ms on ti.id_storage = ms.id_storage "
                . "where id_master = '$noSO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getJmlRincianPack($noSO) {
        $sql = "select * from trans_out_pack ti "
                . "left join master_produk mp on ti.id_produk = mp.id_produk "
                . "left join master_storage ms on ti.id_storage = ms.id_storage "
                . "where id_master_out = '$noSO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            $data['jml']= $query->num_rows();
            return $data;
        } else {
            $data['jml']= 0;
            return $data;
        }
    }
    public function getRincianPack($noSO) {
        $sql = "select * from trans_out_pack ti "
                . "left join master_produk mp on ti.id_produk = mp.id_produk "
                . "left join master_storage ms on ti.id_storage = ms.id_storage "
                . "where id_master_out = '$noSO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            return $query->result();
        } else {
            return 0;
        }
    }
    public function getProduk() {
        $rows = array(); //will hold all results
        $sql = "select * from master_produk where jns_produk = 5 order by id_produk asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
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
    public function getProdukKeluar($noSO) {
        $sql = "select id_produk,qty_rencana from trans_out ti "
                . "where id_master = '$noSO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getPackKeluar($noSO) {
        $sql = "select id_produk,qty from trans_out_pack ti "
                . "where id_master_out = '$noSO' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }
    function updateMasterOut($data, $id_master) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_master_out', $id_master);
        $query2 = $this->db->update('master_out', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    
    function updateMProduk($qty_kg, $id_produk) {
        $sql2 = "update master_produk set keluar = (keluar  + '$qty_kg') where id_produk = '$id_produk'";
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function updateTransOut($id_master) {
        $sql2 = "update trans_out set qty_realisasi = qty_rencana where id_master = '$id_master'";
        $query = $this->db->query($sql2);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    public function cetakSuratJalanMaster($id_master) {
        $sql = "select * from master_out mi left join master_customer ms on mi.id_cust = ms.id_cust left join master_produk mp on mi.id_produk = mp.id_produk where mi.id_master_out = '$id_master' ";
        $query = $this->db->query($sql);
        $row = $query->result();
        return $row; // returning rows, not row
    }
    public function cetakSuratJalanPack($id_master) {
        $sql = "SELECT coalesce(tp.qty,0) as qty,mp.nama_produk as nama_produk
FROM trans_out_pack tp 
LEFT JOIN master_produk mp ON tp.id_produk = mp.id_produk
WHERE tp.id_master_out = '$id_master'";
        $query = $this->db->query($sql);
        $row = $query->result();
        return $row; // returning rows, not row
    }
    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */