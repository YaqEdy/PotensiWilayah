<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Master_instansi_m extends CI_Model {
	public function getInstansiAll()
	{
		$sql="SELECT * from tbl_m_instansi ";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}
	public function getIdInstansi(){
		$sql= "select id_instansi from tbl_m_instansi";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			$id_instansi = "000001";
			return $id_instansi;
		}else{
			$sql= "select max(right(id_instansi,6)) as id_instansi from tbl_m_instansi";
			$query = $this->db->query($sql);
			$hasil = $query->result();
			$id_instansi =  $hasil[0]->id_instansi;
			$id_instansi = sprintf('%06u',$id_instansi+1);
			return $id_instansi;
		}
	}
	public function getDescInstansi($idInstansi)
	{
		$this->db->select ( 'nama_instansi' );//, s.alamat, s.telp, s.npwp
		$this->db->from('tbl_m_instansi');
		$this->db->where ( 'id_instansi', $idInstansi);
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	public function insert($data){
		
		$this->db->trans_begin();
		$model = $this->db->insert('tbl_m_instansi', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	
	}
	function update($data,$idInstansi){
		$this->db->trans_begin();
		$query1 = $this->db->where('id_instansi', $idInstansi);
		$query2 = $this->db->update('tbl_m_instansi', $data);
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
	function delete($idInstansi){
		$this->db->trans_begin();
		$query1	=	$this->db->where('id_instansi',$idInstansi);
		$query2	=   $this->db->delete('tbl_m_instansi');
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