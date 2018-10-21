<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Trans_bantuan_m extends CI_Model {
	public function getBantuanAll()
	{
		$sql="SELECT * from vw_t_bantuan ";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}
	public function getKtpAll()
	{
		$sql="SELECT id_ktp,nama_ktp,jekel,date_format(tanggal_lahir,'%d-%m-%Y') as tanggal_lahir,is_delete FROM master_ktp";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}

	public function getKtpAll_Rpt($kec,$kel,$banjar)
	{
		$sql="SELECT id_ktp,nama_ktp,jekel,date_format(tanggal_lahir,'%d-%m-%Y') as tanggal_lahir,is_delete FROM master_ktp WHERE id_kec=$kec and id_kel=$kel and id_banjar=$banjar";
		$query=$this->db->query($sql);
		return $query->result(); // returning rows, not row
	}

	public function getIdBantuan(){
		$sql= "select id_t_bantuan from tbl_t_bantuan";
		$query = $this->db->query($sql);
		$jml = $query->num_rows();
		if($jml == 0){
			$id_t_bantuan = "000001";
			return $id_t_bantuan;
		}else{
			$sql= "select max(right(id_t_bantuan,6)) as id_t_bantuan from tbl_t_bantuan";
			$query = $this->db->query($sql);
			$hasil = $query->result();
			$id_t_bantuan =  $hasil[0]->id_t_bantuan;
			$id_t_bantuan = sprintf('%06u',$id_t_bantuan+1);
			return $id_t_bantuan;
		}
	}
	public function getDescBantuan($idBantuan)
	{
		$this->db->select ( 'nama_bantuan' );//, s.alamat, s.telp, s.npwp
		$this->db->from('tbl_t_bantuan');
		$this->db->where ( 'id_t_bantuan', $idBantuan);
		$query = $this->db->get ();
		if($query->num_rows()== '1'){
			return $query->result ();
		}else{
			return false;
		}
	}
	public function insert($data){
		
		$this->db->trans_begin();
		$model = $this->db->insert('tbl_t_bantuan', $data);
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
		$query1 = $this->db->where('id_t_bantuan', $idBantuan);
		$query2 = $this->db->update('tbl_t_bantuan', $data);
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
	function query($sql){
		$this->db->trans_begin();
        $query = $this->db->query($sql);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	}

	function delete($sql){
		$this->db->trans_begin();
        $query = $this->db->query($sql);
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