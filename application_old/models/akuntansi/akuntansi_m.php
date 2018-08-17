<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Akuntansi_m extends CI_Model {
    function insert_jurnalK($modelidAPtrans, $tglTrans, $modelidAP, $getkodeperk, $deskripsiJurnal, $saldo,$totalHargaAll) {
        $sql = "INSERT INTO trans_detail_perk(id_trans,tgl_trans,tgl_input,trans_id,kode_perk,keterangan,deskripsi,debet,kredit,saldo_akhir,post) 
		VALUES ('" . $modelidAPtrans . "','" . $tglTrans . "','" . $this->session->userdata("tgl_y") . "','" . $modelidAP . "','" . $getkodeperk . "','" . $deskripsiJurnal . "','" . $deskripsiJurnal . "','0','" . $saldo . "','" . $totalHargaAll . "','0')";
        $query = $this->db->query($sql);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function insert_jurnalD($modelidAPtrans, $tglTrans, $modelidAP, $getkodeperk, $deskripsiJurnal, $saldo,$totalHargaAll) {
        $sql = "INSERT INTO trans_detail_perk(id_trans,tgl_trans,tgl_input,trans_id,kode_perk,keterangan,deskripsi,debet,kredit,saldo_akhir,post) 
		VALUES ('" . $modelidAPtrans . "','" . $tglTrans . "','" . $this->session->userdata("tgl_y") . "','" . $modelidAP . "','" . $getkodeperk . "','" . $deskripsiJurnal . "','" . $deskripsiJurnal . "','" . $saldo . "','0','" . $totalHargaAll . "','0')";
        $query = $this->db->query($sql);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    function getkodeperk($nama_integrasi) {
        $sql = "select kode_perk from integrasi_jurnal where nama_integrasi ='$nama_integrasi'";
        $query = $this->db->query($sql);
        $hasil = $query->result();
        $id_adv = $hasil[0]->kode_perk;
        return $id_adv;
    }
    function updatejurnal($trans_id) {
        $this->db->trans_begin();
        $query1 = $this->db->set('post', '1');
        $query1 = $this->db->where('trans_id', $trans_id);
        $query3 = $this->db->update('trans_detail_perk');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    
    function updatebroker($trans_id,$brokerfee){
        $this->db->trans_begin();
        $query1 = $this->db->set('kredit', $brokerfee);
        $query2 = $this->db->where('kode_perk', '40101');
        $query3 = $this->db->where('trans_id', $trans_id);
        $query4 = $this->db->update('trans_detail_perk');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function getCDescCpaJurnal($transid) {
        $sql = "select tdp.kode_perk,tdp.keterangan,tdc.kode_cflow,tdp.debet,tdp.kredit from trans_detail_perk tdp
			left join trans_detail_cflow tdc on tdp.trans_id = tdc.trans_id where tdp.trans_id = '" . $transid . "'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getDescCpaJurnal($transid) {
        $sql = "select tdp.kode_perk,tdp.keterangan,(select tdc.kode_cflow from trans_detail_cflow tdc
			 where tdc.trans_id = '" . $transid . "' and tdc.kode_perk = tdp.kode_perk) as kode_cflow,tdp.debet,
			 tdp.kredit from trans_detail_perk tdp where tdp.trans_id = '" . $transid . "' group by tdp.kode_perk";
        $query = $this->db->query($sql);
        $rows['data_cpa'] = $query->result();
        return $rows;
    }

    function deleteJurnalPerk($IdJurnal) {
        $this->db->trans_begin();
        $query1 = $this->db->where('trans_id', $IdJurnal);
        $query2 = $this->db->delete('trans_detail_perk');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function deleteJurnalCflow($IdJurnal) {
        $this->db->trans_begin();
        $query1 = $this->db->where('trans_id', $IdJurnal);
        $query2 = $this->db->delete('trans_detail_cflow');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function getJurnalAll() {
        $sql = "select tdp.trans_id,tdp.kode_jurnal, tdp.master_id,mk.nama_kyw,mr.keterangan,mr.jml_uang
				from trans_detail_perk tdp 
				left join master_reimpay mr on tdp.master_id = mr.id_reimpay
				left join master_karyawan mk on mr.id_kyw = mk.id_kyw
				group by tdp.trans_id order by tdp.trans_id asc";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    function getJurnalUnpost($tanggal) {
        $sql = "select distinct trans_id,tgl_trans,kode_jurnal,deskripsi,saldo_akhir,no_invoice from trans_detail_perk
                    where tgl_trans = '$tanggal' and  post = 0 group by trans_id order by trans_id asc"; 
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    function getJurnalPostAll($tanggal) {
        $sql = "select distinct trans_id,sum(debet) as debet,sum(kredit) as kredit,(sum(debet) - sum(kredit)) as selisih
                        from trans_detail_perk
                        where tgl_trans = '$tanggal' and post = 0
                        group by trans_id";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getDescUM($kdByr) {
        $this->db->select('ta.kode_perk,p.nama_perk');
        $this->db->from('type_advance ta');
        $this->db->join('perkiraan p', 'ta.kode_perk=p.kode_perk', 'LEFT');
        $this->db->where('id_account', $kdByr);
//		$this->db->where ( 'T.STATUS_AKTIF <>', 3 );
        $query = $this->db->get();

        $rows['data_cpa'] = $query->result();
        return $rows;
    }

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

    function getbrokerfee($trans_id) {
        $sql = "select kredit from trans_detail_perk where trans_id = '$trans_id' and kode_perk = '40101'";
        $query = $this->db->query($sql);
        $hasil = $query->result();
        $id_pemb = $hasil[0]->kredit;
        return $id_pemb;
    }

    function getIdAPtrans($tglTrans, $bulan, $tahun, $date) {
        $sql = "select id_trans from trans_detail_perk where tgl_trans = '$tglTrans'";
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
        $sql = "select td.kode_perk,td.keterangan,td.debet,td.kredit,td.saldo_akhir,td.NoReferensi,td.trans_id,
                        td.tgl_trans,td.deskripsi,p.nama_perk,td.no_invoice,td.id_trans_invoice,td.modul  
                        from trans_detail_perk td left join perkiraan p on td.kode_perk = p.kode_perk 
                        where td.trans_id = '" . $idPerk . "'";
        $query = $this->db->query($sql);
        $rows['data_ju'] = $query->result();
        return $rows;
    }

    public function getCDescJU($idPerk) {
        $sql = "select * from trans_detail_perk where trans_id = '" . $idPerk . "'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getDesc($idPerk) {
        $sql = "select distinct deskripsi,noreferensi from trans_detail_perk where trans_id = '" . $idPerk . "'";
        $query = $this->db->query($sql);
        $rows['data_ju'] = $query->result();
        return $rows;
    }

    public function getCDesc($idPerk) {
        $sql = "select distinct deskripsi,noreferensi from trans_detail_perk where trans_id ='" . $idPerk . "'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    function getIdTDPerk($modelidAP, $tglTrans, $tmpKodePerk, $tmpDb, $tmpKr) {
        $sql = "select id_trans from trans_detail_perk where trans_id ='$modelidAP' and tgl_trans = '$tglTrans'
				and kode_perk = '$tmpKodePerk' and debet = '$tmpDb' and kredit = '$tmpKr'";
        $query = $this->db->query($sql);
        $hasil = $query->result();
        return $hasil[0]->id_seq;
    }
    //DIBUAT KHUSUS LAUNDRY
    function insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi) {
        $data_perk = array(
            'id_trans' => $id_jurnal_detail,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'trans_id' => $id_jurnal,
            'modul' => $modul,
            'kode_perk' => $KodePerk,
            'debet' => $debet,
            'kredit' => $kredit,
            'post' => 0,
            'saldo_akhir' => $total_trans,
            'deskripsi' => $deskripsi,
            'keterangan' => $keterangan,
            'NoReferensi' => $noreferensi
        );
        $this->db->trans_begin();
        $model = $this->db->insert('trans_detail_perk', $data_perk);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    //END DIBUAT khusus LAUNDRY 

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

    function insertTDCflow($data) {
        $this->db->trans_begin();
        $model = $this->db->insert('trans_detail_cflow', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

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

//        function getDesc($idPerk){
//		$sql = "select distinct noreferensi,deskripsi from trans_detail_perk where trans_id = '".$idPerk."'";
//		$query = $this->db->query($sql);
//		return $query->result();
//	}
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