<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Master_jeniskomunitas_m extends CI_Model {
	public function getJeniskomunitasAll()
	{
		$sql="SELECT * from master_jeniskomunitas ";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}
	public function getIdJeniskomunitas(){
		$sql= "select id_jeniskomunitas from master_jeniskomunitas";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			$id_jeniskomunitas = "000001";
			return $id_jeniskomunitas;
		}else{
			$sql= "select max(right(id_jeniskomunitas,6)) as id_jeniskomunitas from master_jeniskomunitas";
			$query = $this->db->query($sql);
			$hasil = $query->result();
			$id_jeniskomunitas =  $hasil[0]->id_jeniskomunitas;
			$id_jeniskomunitas = sprintf('%06u',$id_jeniskomunitas+1);
			return $id_jeniskomunitas;
		}
	}
	public function getDescJeniskomunitas($idJeniskomunitas)
	{
		$this->db->select ( 's.nama_jeniskomunitas, s.id_jeniskomunitas ' );
		$this->db->from('master_jeniskomunitas s');
		$this->db->where ( 's.id_jeniskomunitas', $idJeniskomunitas);
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	public function insert($data){
		
		$this->db->trans_begin();
		$model = $this->db->insert('master_jeniskomunitas', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	
	}
	function update($data,$jeniskomunitasId){
		$this->db->trans_begin();
		$query1 = $this->db->where('id_jeniskomunitas', $jeniskomunitasId);
		$query2 = $this->db->update('master_jeniskomunitas', $data);
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
	function delete($jeniskomunitasId){
		$this->db->trans_begin();
		$query1	=	$this->db->where('id_jeniskomunitas',$jeniskomunitasId);
		$query2	=   $this->db->delete('master_jeniskomunitas');
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