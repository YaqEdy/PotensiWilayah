<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Master_pekerjaan_m extends CI_Model {
	public function getPekerjaanAll()
	{
		$sql="SELECT * from tbl_m_pekerjaan ";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}
	public function getIdPekerjaan(){
		$sql= "select id_pekerjaan from tbl_m_pekerjaan";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			$id_pekerjaan = "000001";
			return $id_pekerjaan;
		}else{
			$sql= "select max(right(id_pekerjaan,6)) as id_pekerjaan from tbl_m_pekerjaan";
			$query = $this->db->query($sql);
			$hasil = $query->result();
			$id_pekerjaan =  $hasil[0]->id_pekerjaan;
			$id_pekerjaan = sprintf('%06u',$id_pekerjaan+1);
			return $id_pekerjaan;
		}
	}
	public function getDescPekerjaan($idPekerjaan)
	{
		$this->db->select ( 'nama_pekerjaan' );//, s.alamat, s.telp, s.npwp
		$this->db->from('tbl_m_pekerjaan');
		$this->db->where ( 'id_pekerjaan', $idPekerjaan);
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	public function insert($data){
		
		$this->db->trans_begin();
		$model = $this->db->insert('tbl_m_pekerjaan', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	
	}
	function update($data,$idPekerjaan){
		$this->db->trans_begin();
		$query1 = $this->db->where('id_pekerjaan', $idPekerjaan);
		$query2 = $this->db->update('tbl_m_pekerjaan', $data);
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
	function delete($idPekerjaan){
		$this->db->trans_begin();
		$query1	=	$this->db->where('id_pekerjaan',$idPekerjaan);
		$query2	=   $this->db->delete('tbl_m_pekerjaan');
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