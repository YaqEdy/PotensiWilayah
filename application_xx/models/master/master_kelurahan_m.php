<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Master_kelurahan_m extends CI_Model {
	public function getKelAll()
	{
		$sql="SELECT * from master_kelurahan l left join master_kecamatan k on l.id_kec = k.id_kec ";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}
	public function getIdKel(){
		$sql= "select id_kel from master_kelurahan";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			$id_kel = "000001";
			return $id_kel;
		}else{
			$sql= "select max(right(id_kel,6)) as id_kel from master_kelurahan";
			$query = $this->db->query($sql);
			$hasil = $query->result();
			$id_kel =  $hasil[0]->id_kel;
			$id_kel = sprintf('%06u',$id_kel+1);
			return $id_kel;
		}
	}
	public function getDescKel($idKel)
	{
		$this->db->select ( 'l.nama_kel,k.id_kec,k.nama_kec' );//, s.alamat, s.telp, s.npwp
		$this->db->from('master_kelurahan l');
                $this->db->join('master_kecamatan k', 'l.id_kec = k.id_kec', 'LEFT');
		$this->db->where ( 'l.id_kel', $idKel);
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	public function insert($data){
		
		$this->db->trans_begin();
		$model = $this->db->insert('master_kelurahan', $data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	
	}
	function update($data,$kelId){
		$this->db->trans_begin();
		$query1 = $this->db->where('id_kel', $kelId);
		$query2 = $this->db->update('master_kelurahan', $data);
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
	function delete($kelId){
		$this->db->trans_begin();
		$query1	=	$this->db->where('id_kel',$kelId);
		$query2	=   $this->db->delete('master_kelurahan');
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