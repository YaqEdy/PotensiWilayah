<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class koreksi_jurnal_m extends CI_Model {

//	public function getCDescCpaJurnal($transid)
//	{
//		$sql="select tdp.kode_perk,tdp.keterangan,tdc.kode_cflow,tdp.debet,tdp.kredit from trans_detail_perk tdp
//			left join trans_detail_cflow tdc on tdp.trans_id = tdc.trans_id where tdp.trans_id = '".$transid."'";
//		$query=$this->db->query($sql);
//		return $query->num_rows();
//	}
//	public function getDescCpaJurnal($transid)
//	{
//		$sql="select tdp.kode_perk,tdp.keterangan,(select tdc.kode_cflow from trans_detail_cflow tdc
//			 where tdc.trans_id = '".$transid."' and tdc.kode_perk = tdp.kode_perk) as kode_cflow,tdp.debet,
//			 tdp.kredit from trans_detail_perk tdp where tdp.trans_id = '".$transid."' group by tdp.kode_perk";
//		$query=$this->db->query($sql);
//		$rows['data_cpa'] = $query->result();
//		return $rows;
//
//	}
//	function deleteJurnalPerk($IdJurnal){
//		$this->db->trans_begin();
//		$query1	=	$this->db->where('trans_id',$IdJurnal);
//		$query2	=   $this->db->delete('trans_detail_perk');
//		if ($this->db->trans_status() === FALSE){
//			$this->db->trans_rollback();
//			return false;
//		}
//		else{
//			$this->db->trans_commit();
//			return true;
//		}
//	}
//	function deleteJurnalCflow($IdJurnal){
//		$this->db->trans_begin();
//		$query1	=	$this->db->where('trans_id',$IdJurnal);
//		$query2	=   $this->db->delete('trans_detail_cflow');
//		if ($this->db->trans_status() === FALSE){
//			$this->db->trans_rollback();
//			return false;
//		}
//		else{
//			$this->db->trans_commit();
//			return true;
//		}
//	}
//	function getJurnalAll()
//	{
//		$sql="select tdp.trans_id,tdp.kode_jurnal, tdp.master_id,mk.nama_kyw,mr.keterangan,mr.jml_uang
//				from trans_detail_perk tdp 
//				left join master_reimpay mr on tdp.master_id = mr.id_reimpay
//				left join master_karyawan mk on mr.id_kyw = mk.id_kyw
//				group by tdp.trans_id order by tdp.trans_id asc";
//		$query=$this->db->query($sql);
//		return $query->result(); // returning rows, not row
//	}
    function getJurnalUnpost($tanggal) {
        $sql = "select distinct trans_id,tgl_trans,kode_jurnal,deskripsi,saldo_akhir from trans_detail_perk
                    where tgl_trans = '$tanggal' and  post = 1  group by trans_id order by trans_id asc"; //tgl_trans = '$tanggal' and 
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

//	public function getDescUM($kdByr)
//	{
//		$this->db->select ( 'ta.kode_perk,p.nama_perk' );
//		$this->db->from('type_advance ta');
//		$this->db->join('perkiraan p', 'ta.kode_perk=p.kode_perk', 'LEFT');
//		$this->db->where ( 'id_account', $kdByr );
////		$this->db->where ( 'T.STATUS_AKTIF <>', 3 );
//		$query = $this->db->get ();
//
//		$rows['data_cpa'] = $query->result();
//		return $rows;
//
//	}
    function getIdAP($bulan, $tahun) {
        $sql = "select trans_id from trans_detail_perk where MONTH(tgl_trans)='$bulan' and YEAR(tgl_trans)='$tahun'";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        $kode = "JU";
        $th = substr($tahun, -2);
        if ($jml == 0) {
            $id_pemb = "0000001";
            return $kode . "-" . $id_pemb . "-" . $bulan . $th;
        } else {
            $sql = "select max(substring(trans_id,4,7)) as id_pemb from trans_detail_perk";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_pemb = $hasil[0]->id_pemb;
            $id_pemb = sprintf('%07u', $id_pemb + 1);
            return $kode . "-" . $id_pemb . "-" . $bulan . $th;
        }
    }

    function getIdAPtrans($tglTrans, $bulan, $tahun, $date) {
        $sql = "select trans_id from trans_detail_perk where tgl_trans = '$tglTrans'";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        $kode = "TR";
        $th = substr($tahun, -2);
        if ($jml == 0) {
            $id_pemb = "0000001";
            return $kode . "-" . $id_pemb . "-" . $date . $bulan . $th;
        } else {
            $sql = "select substring(max(id_trans),4,7) as id_pemb from trans_detail_perk where tgl_trans = '$tglTrans'";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_pemb = $hasil[0]->id_pemb;
            $id_pemb = sprintf('%07u', $id_pemb + 1);
            return $kode . "-" . $id_pemb . "-" . $date . $bulan . $th;
        }
    }

    public function getDescJU($idPerk) {
        $sql = "select * from trans_detail_perk where trans_id = '" . $idPerk . "'";
        $query = $this->db->query($sql);
        $rows['data_ju'] = $query->result();
        return $rows;
    }

    public function getCDescJU($idPerk) {
        $sql = "select * from trans_detail_perk where trans_id = '" . $idPerk . "'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    //	function getIdTDPerk($modelidAP,$tglTrans,$tmpKodePerk,$tmpDb,$tmpKr){
//		$sql= "select id_trans from trans_detail_perk where trans_id ='$modelidAP' and tgl_trans = '$tglTrans'
//				and kode_perk = '$tmpKodePerk' and debet = '$tmpDb' and kredit = '$tmpKr'";
//		$query = $this->db->query($sql);
//		$hasil = $query->result();
//		return $hasil[0]->id_seq;
//	}

    function insertTDPerk($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('trans_detail_perk', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

//	function insertTDCflow($data){
//		$this->db->trans_begin();
//		$model = $this->db->insert('trans_detail_cflow', $data);
//		if ($this->db->trans_status() === FALSE){
//			$this->db->trans_rollback();
//			return false;
//		}
//		else{
//			$this->db->trans_commit();
//			return true;
//		}
//	}
    /* Fungsi Cetak */
    function getJurnal($idPerk) {
        $sql = "select distinct NoReferensi,tgl_trans from trans_detail_perk where trans_id = '" . $idPerk . "'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getJurnalAllP($idPerk) {
        $sql = "select a.kode_perk,b.nama_perk,a.debet,a.kredit,a.keterangan from trans_detail_perk a left join perkiraan b 
                        on a.kode_perk =b.kode_perk 
                        where a.trans_id = '" . $idPerk . "'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getTotal($idPerk) {
        $sql = "select sum(debet) as debet,sum(kredit) as kredit from trans_detail_perk where trans_id = '" . $idPerk . "'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getDescription($idPerk) {
        $sql = "select distinct deskripsi from trans_detail_perk where trans_id = '" . $idPerk . "'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAp($idPP) {
        $sql = "select t.trans_id,t.tgl_trans,mr.no_invoice,mr.tgl_jt,mr.id_reqpay,mr.tgl_trans as tgl_ap,
				mk.nama_kyw,ms.nama_spl,mp.nama_proyek from trans_detail_perk t
				left join master_reqpay mr on t.master_id = mr.id_reqpay
				left join master_karyawan mk on mr.id_kyw = mk.id_kyw
				left join master_supplier ms on mr.pay_to = ms.id_spl
				left join master_proyek mp on mr.id_proyek = mp.id_proyek where t.trans_id = '" . $idPP . "' group by t.trans_id ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getApRp($idPP) {
        $sql = "select t.trans_id,t.tgl_trans,mr.no_invoice,mr.tgl_jt,mr.id_reimpay,mr.tgl_trans as tgl_ap,
				mk.nama_kyw,(select mmk.nama_kyw from master_karyawan mmk where mmk.id_kyw = mr.pay_to) as nama_spl,
				mp.nama_proyek from trans_detail_perk t
				left join master_reimpay mr on t.master_id = mr.id_reimpay
				left join master_karyawan mk on mr.id_kyw = mk.id_kyw
				left join master_supplier ms on mr.pay_to = ms.id_spl
				left join master_proyek mp on mr.id_proyek = mp.id_proyek where t.trans_id = '" . $idPP . "' group by t.trans_id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getApSt($idPP) {
        $sql = "select t.trans_id,t.tgl_trans,mr.no_invoice,mr.tgl_jt,mr.id_settle_adv,mr.tgl_trans as tgl_ap,
				mk.nama_kyw,(select mmk.nama_kyw from master_karyawan mmk where mmk.id_kyw = mr.pay_to) as nama_spl,
				mp.nama_proyek from trans_detail_perk t
				left join master_settle_adv ms on t.master_id = ms.id_settle_adv
				left join master_karyawan mk on mr.id_kyw = mk.id_kyw
				left join master_proyek mp on mr.id_proyek = mp.id_proyek where t.trans_id = '" . $idPP . "'
				group by t.trans_id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getDetailAp($idPP) {
        $sql = "select t.kode_perk,td.kode_cflow,t.debet,t.kredit,p.nama_perk from trans_detail_perk t
				left join trans_detail_cflow td on t.id_seq = td.id_seq_perk
				left join perkiraan p on t.kode_perk = p.kode_perk
				where t.trans_id = '" . $idPP . "'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /* End Fungsi cetak */

    //update saldo
    function getPerkTerpakai15($tahun, $idProyek, $kode_perk) {
        $sql = "SELECT SUM(trans_detail_perk.debet) - SUM(trans_detail_perk.kredit) AS jumlah_psv
				FROM trans_detail_perk WHERE tgl_trans <= '" . $tahun . "' AND kode_perk = '" . $kode_perk . "'";
        $query = $this->db->query($sql)->row()->jumlah_psv;
        return $query;
    }

    function getPerkTerpakai234($tahun, $idProyek, $kode_perk) {
        $sql = "SELECT SUM(trans_detail_perk.kredit) - SUM(trans_detail_perk.debet) AS jumlah_psv
				FROM trans_detail_perk WHERE tgl_trans <= '" . $tahun . "' AND kode_perk = '" . $kode_perk . "'";
        $query = $this->db->query($sql)->row()->jumlah_psv;
        return $query;
    }

    function updateBudgetPerk($terpakai, $tahun, $idProyek, $kode_perk) {
        $sql = "update budget_perkiraan bp set bp.terpakai = '" . $terpakai . "' where bp.tahun = '" . $tahun . "' and bp.kode_perk = '" . $kode_perk . "' and bp.id_proyek = '" . $idProyek . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function getCflowTerpakai15($tahun, $idProyek, $kode_cflow) {
        $sql = "SELECT SUM(trans_detail_cflow.debet) - SUM(trans_detail_cflow.kredit) AS jumlah_psv
				FROM trans_detail_cflow WHERE tgl_trans <= '" . $tahun . "' AND id_proyek = '" . $idProyek . "' AND kode_cflow = '" . $kode_cflow . "'";
        $query = $this->db->query($sql)->row()->jumlah_psv;
        return $query;
    }

    function getCflowTerpakai234($tahun, $idProyek, $kode_cflow) {
        $sql = "SELECT SUM(trans_detail_cflow.kredit) - SUM(trans_detail_cflow.debet) AS jumlah_psv
				FROM trans_detail_cflow WHERE tgl_trans <= '" . $tahun . "' AND id_proyek = '" . $idProyek . "' AND kode_cflow = '" . $kode_cflow . "'";
        $query = $this->db->query($sql)->row()->jumlah_psv;
        return $query;
    }

    function updateBudgetCflow($terpakai, $tahun, $idProyek, $kode_cflow) {
        $sql = "update budget_cflow bp set bp.terpakai = '" . $terpakai . "' where bp.tahun = '" . $tahun . "' and bp.kode_cflow = '" . $kode_cflow . "' and bp.id_proyek = '" . $idProyek . "'";
        $query = $this->db->query($sql);
    }

    function deleteJUunpost($transid) {
        $this->db->trans_begin();
        $query1 = $this->db->where('trans_id', $transid);
        $query2 = $this->db->delete('trans_detail_perk');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    //end update saldo
}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */