<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Master_supplier_m extends CI_Model {
	public function getSplAll()
	{
		$sql="SELECT * from master_supplier ";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}
	public function getIdSpl(){
		$sql= "select id_spl from master_supplier";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			$id_spl = "000001";
			return $id_spl;
		}else{
			$sql= "select max(right(id_spl,6)) as id_spl from master_supplier";
			$query = $this->db->query($sql);
			$hasil = $query->result();
			$id_spl =  $hasil[0]->id_spl;
			$id_spl = sprintf('%06u',$id_spl+1);
			return $id_spl;
		}
	}
	public function getDescSpl($idSpl)
	{
		$this->db->select ( 's.nama_spl, s.alamat, s.telp, s.npwp ' );
		$this->db->from('master_supplier s');
		$this->db->where ( 's.id_spl', $idSpl);
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	public function insert($data){
		
		$this->db->trans_begin();
		$model = $this->db->insert('master_supplier', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	
	}
	function update($data,$splId){
		$this->db->trans_begin();
		$query1 = $this->db->where('id_spl', $splId);
		$query2 = $this->db->update('master_supplier', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	}
/*	public function cekMasterAdvance($kywId){
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
	}*/
	function delete($splId){
		$this->db->trans_begin();
		$query1	=	$this->db->where('id_spl',$splId);
		$query2	=   $this->db->delete('master_supplier');
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	}
	
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */