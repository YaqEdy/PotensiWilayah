<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Master_bantuan_m extends CI_Model {
	public function getBantuanAll()
	{
		$sql="SELECT * from tbl_m_bantuan ";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}
	public function getIdBantuan(){
		$sql= "select id_bantuan from tbl_m_bantuan";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			$id_bantuan = "000001";
			return $id_bantuan;
		}else{
			$sql= "select max(right(id_bantuan,6)) as id_bantuan from tbl_m_bantuan";
			$query = $this->db->query($sql);
			$hasil = $query->result();
			$id_bantuan =  $hasil[0]->id_bantuan;
			$id_bantuan = sprintf('%06u',$id_bantuan+1);
			return $id_bantuan;
		}
	}
	public function getDescBantuan($idBantuan)
	{
		$this->db->select ( 'nama_bantuan' );//, s.alamat, s.telp, s.npwp
		$this->db->from('tbl_m_bantuan');
		$this->db->where ( 'id_bantuan', $idBantuan);
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	public function insert($data){
		
		$this->db->trans_begin();
		$model = $this->db->insert('tbl_m_bantuan', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	
	}
	function update($data,$idBantuan){
		$this->db->trans_begin();
		$query1 = $this->db->where('id_bantuan', $idBantuan);
		$query2 = $this->db->update('tbl_m_bantuan', $data);
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
	function delete($idBantuan){
		$this->db->trans_begin();
		$query1	=	$this->db->where('id_bantuan',$idBantuan);
		$query2	=   $this->db->delete('tbl_m_bantuan');
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