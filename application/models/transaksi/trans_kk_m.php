<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_kk_m extends CI_Model {
    public function getKKAll() {
        $sql = "SELECT * from vw_t_kk WHERE hub_keluarga=1";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }
    

    public function getProduk() {
        $rows = array(); //will hold all results
        $sql = "select * from master_produk where status_aktif = 1 order  by id_produk asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }

    public function getCustomer() {
        $rows = array(); //will hold all results
        $sql = "select * from master_customer where status_aktif =1 order by id_cust asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }
    public function getAgen(){
        $rows = array(); //will hold all results
        $sql = "select * from master_agen where status_aktif =1 order by id_agen asc ";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $rows[] = $row; //add the fetched result to the result array;
        }
        return $rows; // returning rows, not row
    }
    public function getAllOutsource() {
        $sql = "select * from master_outsource where status_aktif = 1 order  by id_outsource asc ";
        $query = $this->db->query($sql);
        return $query->result();
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
    public function getCucianMasuk($tglAwal, $tglAkhir) {
        $sql = "SELECT mc.id_master_cm, mc.no_bon_manual,mc.id_cust,mc.tgl_trans,mc.e_tgl_selesai,
            mc.tgl_selesai,mc.tgl_ambil,mc.waktu_masuk,mc.waktu_ambil,mc.tgl_outsource_keluar,
            mc.tgl_outsource_masuk,mc.total_qty_kg,mc.total_qty_satuan,mc.total_harga,
            mc.berat_ambil,mc.status_selesai,mc.status_bayar,mc.status_outsource,mt.nama_cust,mc.prioritas 
            FROM master_cm mc 
            LEFT JOIN master_customer mt ON mc.id_cust = mt.id_cust 
            where mc.tgl_trans between '$tglAwal' and '$tglAkhir' and mc.status_ambil<> 1  ";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    function getIdMasterIn($bulan, $tahun) {
        $sql = "select id_master_cm from master_cm where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun'";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        $kode = "CM";
        $th = substr($tahun, -2);
        if ($jml == 0) {
            $id_adv = "0000001";
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        } else {
            $sql = "select max(substring(id_master_cm,4,7)) as id_adv from master_cm where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun'";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_adv = $hasil[0]->id_adv;
            $id_adv = sprintf('%07u', $id_adv + 1);
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        }
    }
    

    function insertMaster($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('master_cm', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function ubahMaster($data, $id_master) {
        $model1 = $this->db->where('id_master_cm', $id_master);
        $model2 = $this->db->update('master_cm', $data);
        if ($model1 && $model2) {
            return true;
        } else {
            return false;
        }
    }

    function insertTransInOut($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('trans_cm', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function ubahTrans($data, $id_trans) {
        $model1 = $this->db->where('id_trans', $id_trans);
        $model2 = $this->db->update('trans_cm', $data);
        if ($model1 && $model2) {
            return true;
        } else {
            return false;
        }
    }
    public function cetakPOMaster($id_master) {
        $sql = "select * from master_cm mi left join master_supplier ms on mi.id_spl = ms.id_spl where id_master_cm = '$id_master' ";
        $query = $this->db->query($sql);
        $row = $query->result();
        return $row; // returning rows, not row
    }
    public function cetakPOTrans($id_master) {
        $sql = "select * from trans_cm ti left join master_produk mp on ti.id_produk = mp.id_produk where ti.id_master = '$id_master' ";
        $query = $this->db->query($sql);
        $row = $query->result();
        return $row; // returning rows, not row
    }
    public function getJmlRincianCM($noCM) {
        $sql = "select * from trans_cm where id_master = '$noCM' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }
    

    public function getRincianCM($noCM) {
        $sql = "select mc.total_qty_kg, mc.total_qty_satuan, mc.total_harga,mc.id_outsource,mc.id_kyw,mc.status_selesai, "
                . "DATE_FORMAT(mc.tgl_outsource_keluar, '%d-%m-%Y') as tgl_os_kel , DATE_FORMAT(mc.tgl_selesai, '%d-%m-%Y') as tgl_selesai, "
                . "DATE_FORMAT(mc.tgl_outsource_masuk, '%d-%m-%Y') as tgl_os_msk, mc.status_outsource as status_outsource, mc.status_bayar, "
                . "ti.id_trans,ti.id_produk,ti.id_layanan,ti.qty,ti.harga_satuan,mp.nama_produk,ml.nama_layanan, ti.status_outsource as status_outsource_trans, "
                . "mct.nama_cust,mc.id_agen,ma.nama_agen from trans_cm ti "
                . "left join master_cm mc on ti.id_master = mc.id_master_cm "
                . "left join master_produk mp on ti.id_produk = mp.id_produk "
                . "left join master_layanan ml on ti.id_layanan = ml.id_layanan "
                . "left join master_customer mct on mc.id_cust = mct.id_cust "
                . "left join master_agen ma on mc.id_agen = ma.id_agen "
                . "where ti.id_master = '$noCM' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            
            $rows['data_cpa'] = $query->result();
            return $rows;
        } else {
            return false;
        }
    }  
    public function getJmlRincianOS($noCM) {
        $sql = "select * from trans_cm where id_master = '$noCM' and status_outsource = 1 ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <> 0) {
            return $query->num_rows();
        } else {
            return false;
        }
    }
    public function getStatusSelesai($id_master){
        $sql ="select status_selesai from master_cm where id_master_cm ='$id_master'";
        $query =$this->db->query($sql);
        $result = $query->result();
        $status_selesai = $result[0]->status_selesai;
        return $status_selesai;
    }
    public function getStatusBayar($id_master){
        $sql ="select status_bayar from master_cm where id_master_cm ='$id_master'";
        $query =$this->db->query($sql);
        $result = $query->result();
        $status_bayar = $result[0]->status_bayar;
        return $status_bayar;
    }
    public function getStatusOutsource($id_master){
        $sql ="select status_outsource from master_cm where id_master_cm ='$id_master'";
        $query =$this->db->query($sql);
        $result = $query->result();
        $status_outsource = $result[0]->status_outsource;
        return $status_outsource;
    }
    public function getPiutang($id_master){
        $sql ="select total_harga_kg,total_harga_satuan from master_cm where id_master_cm ='$id_master'";
        $query =$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getInfoOutsource($idOutsource){
        $sql ="select * from master_outsource where id_outsource ='$idOutsource'";
        $query =$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getInfoAgen($idAgen){
        $sql ="select * from master_agen where id_agen ='$idAgen'";
        $query =$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getInfoKyw($idKyw){
        $sql ="select * from master_karyawan where id_kyw ='$idKyw'";
        $query =$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function getInfoTransCM($row_idtransos){
        $sql ="select (qty * harga_satuan) as harga_cucian from trans_cm where id_trans ='$row_idtransos'";
        $query =$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */