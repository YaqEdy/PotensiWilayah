<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_kelurahan extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('master/master_kelurahan_m');
        session_start();
    }

    public function index() {
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));

            $this->template->set('title', 'Home');
            $this->template->load('template/template1', 'global/index', $data);
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('master/master_kelurahan/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        //$data['dept'] = $this->master_kelurahan_m->get_dept();

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } elseif (isset($_POST["btnUbah"])) {
            $this->ubah();
        } elseif (isset($_POST["btnHapus"])) {
            $this->hapus();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'master/master_kelurahan_v', $data);
        }
    }

    public function getKelAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_kelurahan_m->getKelAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'idKel' => trim($row->id_kel),
                'namaKel' => trim($row->nama_kel),
                'idKec' => trim($row->id_kec),
                'namaKec' => trim($row->nama_kec)
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function getDescKel() {
        $this->CI = & get_instance();
        $idKel = $this->input->post('idKel', TRUE);
        $rows = $this->master_kelurahan_m->getDescKel($idKel);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'nama_kel' => $row->nama_kel,
                    'id_kec' => $row->id_kec,
                    'nama_kec' => $row->nama_kec
                );
        } else {
            $array = array('baris' => 0);
        }

        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        $namaKel = trim($this->input->post('namaKel'));
        /*$alamat = trim($this->input->post('alamat'));
        $telp = trim($this->input->post('telp'));
        $npwp = trim($this->input->post('npwp'));*/
        $modelidKel = $this->master_kelurahan_m->getIdKel();
        $data = array(
            'id_kel' => $modelidKel,
            'nama_kel' => $namaKel
                /*,
            'alamat' => $alamat,
            'telp' => $telp,
            'npwp' => $npwp*/
        );
        $model = $this->master_kelurahan_m->insert($data);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil disimpan.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal disimpan.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

    function ubah() {
        $kelId = trim($this->input->post('kelId'));
        $namaKel = trim($this->input->post('namaKel'));
        /*$alamat = trim($this->input->post('alamat'));
        $telp = trim($this->input->post('telp'));
        $npwp = trim($this->input->post('npwp'));*/

        $data = array(
            'nama_kel' => $namaKel
                /*,
            'alamat' => $alamat,
            'telp' => $telp,
            'npwp' => $npwp*/
        );

        $model = $this->master_kelurahan_m->update($data, $kelId);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil diubah.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal diubah.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

    function hapus() {
        $this->CI = & get_instance();
        $idKel = trim($this->input->post('idKel'));

        $model = $this->master_kelurahan_m->delete($idKel);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil dihapus.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal dihapus.'
            );
        }

        $this->output->set_output(json_encode($array));
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */