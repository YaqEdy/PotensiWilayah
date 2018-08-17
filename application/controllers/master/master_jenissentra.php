<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_jenissentra extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('master/master_jenissentra_m');
        $this->load->model('global_m');
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
        $menuId = $this->home_m->get_menu_id('master/master_jenissentra/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        
        //$data['dept'] = $this->master_jenissentra_m->get_dept();

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
            $this->template->load('template/template_dataTable', 'master/master_jenissentra_v', $data);
        }
    }

    public function getJenissentraAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_jenissentra_m->getJenissentraAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'idJenissentra' => trim($row->id_jenissentra),
                'namaJenissentra' => trim($row->nama_jenissentra)
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function getDescJenissentra() {
        $this->CI = & get_instance();
        $idJenissentra = $this->input->post('idJenissentra', TRUE);
        $rows = $this->master_jenissentra_m->getDescJenissentra($idJenissentra);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'nama_jenissentra' => $row->nama_jenissentra
                );
        } else {
            $array = array('baris' => 0);
        }

        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        $namaJenissentra = trim($this->input->post('namaJenissentra'));
        $modelidJenissentra = $this->master_jenissentra_m->getIdJenissentra();
        $data = array(
            'id_jenissentra' => $modelidJenissentra,
            'nama_jenissentra' => $namaJenissentra
        );
        $model = $this->master_jenissentra_m->insert($data);
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
        $jenissentraId = trim($this->input->post('jenissentraId'));
        $namaJenissentra = trim($this->input->post('namaJenissentra'));
        $data = array(
            'nama_jenissentra' => $namaJenissentra,
            'alamat' => $alamat,
            'telp' => $telp,
            'npwp' => $npwp
        );

        $model = $this->master_jenissentra_m->update($data, $jenissentraId);
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
        $idJenissentra = trim($this->input->post('idJenissentra'));

        $model = $this->master_jenissentra_m->delete($idJenissentra);
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