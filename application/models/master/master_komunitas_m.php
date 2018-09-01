<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_komunitas_m extends CI_Model {
    

    public function getKomunitasAll() {
        $sql = "SELECT * from master_komunitas kt "
                . "left join master_kecamatan kc on kt.id_kec = kc.id_kec "
                . "left join master_kelurahan kl on kt.id_kel = kl.id_kel "
                . "left join master_jeniskomunitas js on kt.id_jeniskomunitas = js.id_jeniskomunitas ";
        $query = $this->db->query($sql);
        return $query->result(); // returning rows, not row
    }

    public function getIdKomunitas() {
        $sql = "select id_komunitas from master_komunitas";
        $query = $this->db->query($sql);
        $jml = $query->num_rows();
        if ($jml == 0) {
            $id_kel = "000001";
            return $id_kel;
        } else {
            $sql = "select max(right(id_komunitas,6)) as id_kel from master_komunitas";
            $query = $this->db->query($sql);
            $hasil = $query->result();
            $id_kel = $hasil[0]->id_kel;
            $id_kel = sprintf('%06u', $id_kel + 1);
            return $id_kel;
        }
    }

    public function getDescKel($idKel) {
        $this->db->select('l.nama_kel,k.id_kec,k.nama_kec'); //, s.alamat, s.telp, s.npwp
        $this->db->from('master_komunitas l');
        $this->db->join('master_kecamatan k', 'l.id_kec = k.id_kec', 'LEFT');
        $this->db->where('l.id_kel', $idKel);
        $query = $this->db->get();
        if ($query->num_rows() == '1') {
            return $query->result();
        } else {
            return false;
        }
    }

    public function insert($data) {

        $this->db->trans_begin();
        $model = $this->db->insert('master_komunitas', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function update($data, $kelId) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_komunitas', $kelId);
        $query2 = $this->db->update('master_komunitas', $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function delete($Id) {
        $this->db->trans_begin();
        $query1 = $this->db->where('id_komunitas', $Id);
        $query2 = $this->db->delete('master_komunitas');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

}

/* End of file sec_menu_user_m.php */
/* Location: ./application/models/sec_menu_user.php */