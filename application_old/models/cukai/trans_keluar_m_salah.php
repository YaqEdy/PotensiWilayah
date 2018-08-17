<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_keluar_m extends CI_Model {

    public function getProduk() {
        $rows = array(); //will hold all results
        $sql = "select * from master_produk order by id_produk asc ";
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
    public function getDescCustomer($idCustomer) {
        $this->db->select('mc.id_produk');
        $this->db->from('master_customer mc');
        $this->db->where('mc.id_cust', $idCustomer);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getDescProdukStorage($idProduk) {
        $this->db->select('mp.id_storage');
        $this->db->from('master_produk mp');
        $this->db->where('mp.id_produk', $idProduk);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }
    function getIdMasterOut($bulan, $tahun) {
        $sql = "select id_master_out from master_out where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun'";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        $kode = "OU";
        $th = substr($tahun, -2);
        if ($jml == 0) {
            $id_adv = "0000001";
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        } else {
            $sql = "select max(substring(id_master_out,4,7)) as id_adv from master_out where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun'";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_adv = $hasil[0]->id_adv;
            $id_adv = sprintf('%07u', $id_adv + 1);
            return $kode . "-" . $id_adv . "-" . $bulan . $th;
        }
    }

    function insertMaster($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('master_out', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function insertTransInOut($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('trans_inout', $data);
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

//    public function getKurs() {
//		$rows 		=	array(); //will hold all results
//		$sql		=	"select * from master_kurs order by id_kurs asc ";
//		$query		=	$this->db->query($sql);
//		foreach($query->result_array() as $row){
//			$rows[] = $row; //add the fetched result to the result array;
//		}
//		return $rows; // returning rows, not row
//	}
//	public function getAdvAll()
//	{
//		$sql="SELECT ma.id_advance,mk.nama_kyw, ma.jml_uang from master_advance ma left join master_karyawan mk on ma.id_kyw = mk.id_kyw";
//		$query=$this->db->query($sql);
//		return $query->result(); // returning rows, not row
//	}
//	public function getAdvReq($requester)
//	{
//		$sql="SELECT ma.id_advance,mk.nama_kyw, ma.jml_uang from master_advance ma left join master_karyawan mk on ma.id_kyw = mk.id_kyw where ma.id_kyw = '$requester'";
//		$query=$this->db->query($sql);
//		return $query->result(); // returning rows, not row
//	}
//	public function getKywAll()
//	{
//		$sql="SELECT mk.id_kyw,mk.nama_kyw,mk.nama_akun_bank,mk.no_akun_bank,mk.nama_bank,md.nama_dept from master_karyawan mk left join master_dept md on mk.dept_kyw = md.id_dept";
//		$query=$this->db->query($sql);
//		return $query->result(); // returning rows, not row
//	}
//    public function getDescKurs($idKurs)
//	{
//		$this->db->select ( 'nilai_kurs' );
//		$this->db->from('master_kurs mk');
//		$this->db->where ( 'mk.id_kurs', $idKurs );
//		$query = $this->db->get ();
//		if($query->num_rows()== '1'){
//			return $query->result ();
//		}else{
//			return false;
//		}	
//	}
//	public function getPayTo($idKyw){
//		$this->db->select('nama_kyw');
//		$this->db->from('master_karyawan');
//		$this->db->where('id_kyw',$idKyw);
//		$query = $this->db->get();
//		return $query->result();
//	}
//	public function getCDescCpa($idAdv)
//	{
//		$this->db->select ( 'id_cpa,id_master,kode_perk,kode_cflow,keterangan,jumlah' );
//		$this->db->from('cpa');
//		$this->db->where ( 'id_master', $idAdv );
////
//		$query = $this->db->get ();
//		return $query->num_rows();
//	}
//	public function getDescCpa($idAdv)
//	{
//		$this->db->select ( 'id_cpa,id_master,kode_perk,kode_cflow,keterangan,jumlah' );
//		$this->db->from('cpa');
//		$this->db->where ( 'id_master', $idAdv );
////		$this->db->where ( 'T.STATUS_AKTIF <>', 3 );
//		$query = $this->db->get ();
//
//		$rows['data_cpa'] = $query->result();
//		return $rows;
//
//	}
//	function deleteCpa($IdAdv){
//		$this->db->trans_begin();
//		$query1	=	$this->db->where('id_master',$IdAdv);
//		$query2	=   $this->db->delete('cpa');
//		if ($this->db->trans_status() === FALSE){
//			$this->db->trans_rollback();
//			return false;
//		}
//		else{
//			$this->db->trans_commit();
//			return true;
//		}
//	}    
//	function updateBudgetCflowTerpakai($tmpKodeCflow,$tahun,$idProyek,$data){
//		$this->db->trans_begin();
//		$query1 = $this->db->where('kode_cflow', $tmpKodeCflow);
//		$query2 = $this->db->where('tahun', $tahun);
//		$query3 = $this->db->where('id_proyek', $idProyek);
//		$query4 = $this->db->update('budget_cflow', $data);
//
//		if ($this->db->trans_status() === FALSE){
//			$this->db->trans_rollback();
//			return false;
//		}
//		else{
//			$this->db->trans_commit();
//			return true;
//		}
//	}
//	function updateBudgetKdPerkTerpakai($tmpKodePerk,$tahun,$idProyek,$data){
//		$this->db->trans_begin();
//		$query1 = $this->db->where('kode_perk', $tmpKodePerk);
//		$query2 = $this->db->where('tahun', $tahun);
//		$query3 = $this->db->where('id_proyek', $idProyek);
//		$query4 = $this->db->update('budget_perkiraan', $data);
//		if ($this->db->trans_status() === FALSE){
//			$this->db->trans_rollback();
//			return false;
//		}
//		else{
//			$this->db->trans_commit();
//			return true;
//		}
//	}
//	function updateBudgetKdPerkSaldo($tmpKodePerk,$tahun,$idProyek){
//		$sql2  = "update budget_perkiraan set saldo= (saldo  - terpakai) where kode_perk = '$tmpKodePerk' and id_proyek = '$idProyek' and tahun = '$tahun'";
//		$query = $this->db->query($sql2);
//		if ($this->db->trans_status() === FALSE){
//			$this->db->trans_rollback();
//			return false;
//		}
//		else{
//			$this->db->trans_commit();
//			return true;
//		}
//	}
//	function updateAdv($data,$advId){
//		$this->db->trans_begin();
//		$query1 = $this->db->where('id_advance', $advId);
//		$query2 = $this->db->update('master_advance', $data);
//		if ($this->db->trans_status() === FALSE){
//			$this->db->trans_rollback();
//			return false;
//		}
//		else{
//			$this->db->trans_commit();
//			return true;
//		}
//	}
//	function deleteAdv($advId){
//		$this->db->trans_begin();
//		$query1	=	$this->db->where('id_advance',$advId);
//		$query2	=   $this->db->delete('master_advance');
//		if ($this->db->trans_status() === FALSE){
//			$this->db->trans_rollback();
//			return false;
//		}
//		else{
//			$this->db->trans_commit();
//			return true;
//		}
//	}
//    function cetak_cpa($idAdv){
//		$sql="select a.*,b.nama_proyek,c.nama_kyw,d.nama_dept, 
//			(select e.nama_kyw from master_karyawan e where e.id_kyw = a.pay_to) as pay,
//			(select e.nama_kyw from master_karyawan e where e.id_kyw = a.app_keuangan_id) as financeName,
//			(select e.nama_kyw from master_karyawan e where e.id_kyw = a.app_hd_id) as hdName,
//			(select e.nama_kyw from master_karyawan e where e.id_kyw = a.app_gm_id) as gmName,
//			(
//			CASE 
//			 WHEN app_keuangan_status = '1' THEN 'Approve'
//			 WHEN app_keuangan_status = '2' THEN 'Reject'
//			 WHEN app_keuangan_status = '3' THEN 'Paid'
//			END) AS statusKeuangan,
//			(
//			CASE 
//			 WHEN app_hd_status = '1' THEN 'Approve'
//			 WHEN app_hd_status = '2' THEN 'Reject'
//			 WHEN app_hd_status = '3' THEN 'Paid'
//			END) AS statusHd,
//			(
//			CASE 
//			 WHEN app_gm_status = '1' THEN 'Approve'
//			 WHEN app_gm_status = '2' THEN 'Reject'
//			 WHEN app_gm_status = '3' THEN 'Paid'
//			END) AS statusGm 
//			from master_advance a 
//			left join master_proyek b on a.id_proyek = b.id_proyek
//			left join master_karyawan c on a.id_kyw = c.id_kyw
//			left join master_dept d on c.dept_kyw = d.id_dept
//			where a.id_advance = '".$idAdv."'";
//		$query=$this->db->query($sql);
//		return $query->result(); // returning rows, not row
//	}
//	/*function getCflowTerpakai(){
//		$sql ="select ";
//	}*/
//	function cetak_cpa_detail($idAdv){
//		$sql=" select a.*, b.*, c.terpakai,c.saldo,(c.jan+c.feb+c.mar+c.apr+c.mei+c.jun+c.jul+c.agu+c.sep+c.okt+c.nov+c.des) as anggaran 
//				from cpa a left join master_cashflow b on a.kode_cflow = b.kode_cflow
//				left join budget_cflow c on a.kode_cflow = c.kode_cflow where a.id_master = '".$idAdv."'";
//		$query=$this->db->query($sql);
//		return $query->result(); // returning rows, not row
//	}
//	/*function cetak_cpa_detail($idAdv){
//		$sql="select a.*,b.nama_perk, c.tahun,c.id_proyek,c.kode_perk, 
//			  (c.jan+c.feb+c.mar+c.apr+c.mei+c.jun+c.jul+c.agu+c.sep+c.okt+c.nov+c.des) as anggaran,c.terpakai,c.saldo from cpa a
//			  left join perkiraan b on a.kode_perk=b.kode_perk 
//			  left join budget_perkiraan c on a.kode_perk=c.kode_perk where a.id_master = '".$idAdv."'";
//		$query=$this->db->query($sql);
//		return $query->result(); // returning rows, not row
//	}*/
//	function get_terpakai_cflow($tmpKodeCflow){
//		$sql="select terpakai from budget_cflow where kode_cflow = '".$tmpKodeCflow."'";
//		$query = $this->db->query($sql);
//		if($query->num_rows()== '1'){
//			$g = $query->row()->terpakai;
//			return $g;
//		}else{
//			return false;
//		}
//	}
//	function get_saldo_cflow($tmpKodeCflow){
//		$sql="select saldo from budget_cflow where kode_cflow = '".$tmpKodeCflow."'";
//		$query = $this->db->query($sql);
//		if($query->num_rows()== '1'){
//			$g = $query->row()->saldo;
//			return $g;
//		}else{
//			return false;
//		}
//	}
//	function get_terpakai_perk($tmpKodePerk){
//		$sql="select terpakai from budget_perkiraan where kode_perk = '".$tmpKodePerk."'";
//		$query = $this->db->query($sql);
//		if($query->num_rows()== '1'){
//			$g = $query->row()->terpakai;
//			return $g;
//		}else{
//			return false;
//		}
//	}
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */