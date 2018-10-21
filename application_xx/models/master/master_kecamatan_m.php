<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Master_kecamatan_m extends CI_Model {
	public function getKecAll()
	{
		$sql="SELECT * from master_kecamatan ";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}
	public function getIdKec(){
		$sql= "select id_kec from master_kecamatan";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			$id_kec = "000001";
			return $id_kec;
		}else{
			$sql= "select max(right(id_kec,6)) as id_kec from master_kecamatan";
			$query = $this->db->query($sql);
			$hasil = $query->result();
			$id_kec =  $hasil[0]->id_kec;
			$id_kec = sprintf('%06u',$id_kec+1);
			return $id_kec;
		}
	}
	public function getDescKec($idKec)
	{
		$this->db->select ( 's.nama_kec' );//, s.alamat, s.telp, s.npwp
		$this->db->from('master_kecamatan s');
		$this->db->where ( 's.id_kec', $idKec);
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	public function insert($data){
		
		$this->db->trans_begin();
		$model = $this->db->insert('master_kecamatan', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	
	}
	function update($data,$kecId){
		$this->db->trans_begin();
		$query1 = $this->db->where('id_kec', $kecId);
		$query2 = $this->db->update('master_kecamatan', $data);
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
	function delete($kecId){
		$this->db->trans_begin();
		$query1	=	$this->db->where('id_kec',$kecId);
		$query2	=   $this->db->delete('master_kecamatan');
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