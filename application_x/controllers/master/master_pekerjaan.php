<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_pekerjaan extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('master/master_pekerjaan_m');
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
        $menuId = $this->home_m->get_menu_id('master/master_pekerjaan/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        //$data['dept'] = $this->master_pekerjaan_m->get_dept();

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
            $this->template->load('template/template_dataTable', 'master/master_pekerjaan_v', $data);
        }
    }

    public function getPekerjaanAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_pekerjaan_m->getPekerjaanAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'idPekerjaan' => trim($row->id_pekerjaan),
                'namaPekerjaan' => trim($row->nama_pekerjaan)
                /*,
                'alamatPekerjaan' => trim($row->alamat),
                'telpPekerjaan' => trim($row->telp)*/
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function getDescPekerjaan() {
        $this->CI = & get_instance();
        $idPekerjaan = $this->input->post('idPekerjaan', TRUE);
        $rows = $this->master_pekerjaan_m->getDescPekerjaan($idPekerjaan);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'nama_pekerjaan' => $row->nama_pekerjaan
                    /*,
                    'alamat' => $row->alamat,
                    'telp' => $row->telp,
                    'npwp' => $row->npwp*/
                );
        } else {
            $array = array('baris' => 0);
        }

        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        $namaPekerjaan = trim($this->input->post('namaPekerjaan'));
        /*$alamat = trim($this->input->post('alamat'));
        $telp = trim($this->input->post('telp'));
        $npwp = trim($this->input->post('npwp'));*/
        $modelidPekerjaan = $this->master_pekerjaan_m->getIdPekerjaan();
        $data = array(
            'id_pekerjaan' => $modelidPekerjaan,
            'nama_pekerjaan' => $namaPekerjaan
                /*,
            'alamat' => $alamat,
            'telp' => $telp,
            'npwp' => $npwp*/
        );
        $model = $this->master_pekerjaan_m->insert($data);
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
        $PekerjaanId = trim($this->input->post('PekerjaanId'));
        $namaPekerjaan = trim($this->input->post('namaPekerjaan'));
        /*$alamat = trim($this->input->post('alamat'));
        $telp = trim($this->input->post('telp'));
        $npwp = trim($this->input->post('npwp'));*/

        $data = array(
            'nama_pekerjaan' => $namaPekerjaan
                /*,
            'alamat' => $alamat,
            'telp' => $telp,
            'npwp' => $npwp*/
        );

        $model = $this->master_pekerjaan_m->update($data, $PekerjaanId);
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
        $idPekerjaan = trim($this->input->post('idPekerjaan'));

        $model = $this->master_pekerjaan_m->delete($idPekerjaan);
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