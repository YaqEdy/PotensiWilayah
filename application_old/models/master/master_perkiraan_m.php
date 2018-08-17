<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_perkiraan_m extends CI_Model {

    public function getAllPerkiraan() {
        $sql = "SELECT kode_perk,kode_alt,nama_perk,level,type,dk from perkiraan order by kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getLastKdPerk($kdPerkRoot, $levelPerk) {
        $sql = "SELECT max(kode_perk) as kdPerk from perkiraan where kode_induk ='$kdPerkRoot' and level ='$levelPerk'";
        $query = $this->db->query($sql);
        $hasil = $query->result();
        if ($hasil[0]->kdPerk == null) {
            $kdPerk = $kdPerkRoot . "01";
            return $kdPerk;
        } else {
            $kdPerk = trim($hasil[0]->kdPerk) + 1;
            return $kdPerk;
        }   // returning rows, not row
    }

    public function getDescAdv($idAdv) {
        $this->db->select('ma.id_kyw, mk.nama_kyw, md.nama_dept, ma.jml_uang, ma.tgl_jt, ma.pay_to, ma.nama_akun_bank, ma.no_akun_bank, ma.nama_bank, ma.keterangan, ma.dok_po, ma.dok_sp, ma.dok_ssp, ma.dok_sspk, ma.dok_sbj, ma.app_keuangan_id, ma.app_hd_id, ma.app_gm_id, ma.app_keuangan_status, ma.app_hd_status, ma.app_gm_status, ma.app_keuangan_tgl, ma.app_hd_tgl, ma.app_gm_tgl, ma.app_keuangan_ket, ma.app_hd_ket, ma.app_gm_ket');
        $this->db->from('master_advance ma');
        $this->db->join('master_karyawan mk', 'ma.id_kyw=mk.id_kyw', 'LEFT');
        $this->db->join('master_dept md', 'mk.dept_kyw=md.id_dept', 'LEFT');
        $this->db->where('ma.id_advance', $idAdv);
//		$this->db->where ( 'T.STATUS_AKTIF <>', 3 );
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    public function insert($data) {

        $this->db->trans_begin();
        $model = $this->db->insert('perkiraan', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function updateTipe($data, $kodePerk) {
        $this->db->trans_begin();
        $query1 = $this->db->where('kode_perk', $kodePerk);
        $query2 = $this->db->update('perkiraan', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function update($data, $kdPerk) {
        $this->db->trans_begin();
        $query1 = $this->db->where('kode_perk', $kdPerk);
        $query2 = $this->db->update('perkiraan', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function cekSaldoKodePerk($kdPerk) {
        $sql = "SELECT saldo_akhir as saldo from perkiraan where kode_perk ='$kdPerk'";
        $query = $this->db->query($sql);
        $hasil = $query->result();
        return $hasil;
        // returning rows, not row
    }

    public function cekTipeKodePerk($kdPerk) {
        $sql = "SELECT type from perkiraan where kode_perk ='$kdPerk'";
        $query = $this->db->query($sql);
        $hasil = $query->result();
        return $hasil;
        // returning rows, not row
    }

    public function cekJmlKodeInduk($kodePerkRoot) {
        $sql = "SELECT kode_perk from perkiraan where kode_induk ='$kodePerkRoot'";
        $query = $this->db->query($sql);
        //$hasil = $query->result();
        $jml = $query->num_rows();
        return $jml;
        // returning rows, not row
    }

    function delete($idPerk) {
        $this->db->trans_begin();
        $query1 = $this->db->where('kode_perk', $idPerk);
        $query2 = $this->db->delete('perkiraan');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function updatekodeinduk() {
        //substr($kdPerk,0,-2);
        $sql1 = "select kode_perk from perkiraan";
        $query = $this->db->query($sql1);
        foreach ($query->result() as $row) {
            $kdPerk = $row->kode_perk;
            $kode_induk = substr($kdPerk, 0, -2);
            $sql = "update perkiraan set kode_induk = '$kode_induk' where kode_perk ='$kdPerk'";
            $this->db->query($sql);
        }
    }

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */