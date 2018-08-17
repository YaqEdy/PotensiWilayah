<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_supplier extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('master/master_supplier_m');
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
        $menuId = $this->home_m->get_menu_id('master/master_supplier/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        //$data['dept'] = $this->master_supplier_m->get_dept();

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
            $this->template->load('template/template_dataTable', 'master/master_supplier_v', $data);
        }
    }

    public function getSplAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_supplier_m->getSplAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'idSpl' => trim($row->id_spl),
                'namaSpl' => trim($row->nama_spl),
                'alamatSpl' => trim($row->alamat),
                'telpSpl' => trim($row->telp)
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function getDescSpl() {
        $this->CI = & get_instance();
        $idSpl = $this->input->post('idSpl', TRUE);
        $rows = $this->master_supplier_m->getDescSpl($idSpl);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'nama_spl' => $row->nama_spl,
                    'alamat' => $row->alamat,
                    'telp' => $row->telp,
                    'npwp' => $row->npwp
                );
        } else {
            $array = array('baris' => 0);
        }

        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        $namaSpl = trim($this->input->post('namaSpl'));
        $alamat = trim($this->input->post('alamat'));
        $telp = trim($this->input->post('telp'));
        $npwp = trim($this->input->post('npwp'));
        $modelidSpl = $this->master_supplier_m->getIdSpl();
        $data = array(
            'id_spl' => $modelidSpl,
            'nama_spl' => $namaSpl,
            'alamat' => $alamat,
            'telp' => $telp,
            'npwp' => $npwp
        );
        $model = $this->master_supplier_m->insert($data);
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
        $splId = trim($this->input->post('splId'));
        $namaSpl = trim($this->input->post('namaSpl'));
        $alamat = trim($this->input->post('alamat'));
        $telp = trim($this->input->post('telp'));
        $npwp = trim($this->input->post('npwp'));

        $data = array(
            'nama_spl' => $namaSpl,
            'alamat' => $alamat,
            'telp' => $telp,
            'npwp' => $npwp
        );

        $model = $this->master_supplier_m->update($data, $splId);
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
        $idSpl = trim($this->input->post('idSpl'));

        $model = $this->master_supplier_m->delete($idSpl);
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