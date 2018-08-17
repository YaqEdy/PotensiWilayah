<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_jenislk extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('master/master_jenislk_m');
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
        $menuId = $this->home_m->get_menu_id('master/master_jenislk/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        //$data['dept'] = $this->master_jenislk_m->get_dept();

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
            $this->template->load('template/template_dataTable', 'master/master_jenislk_v', $data);
        }
    }

    public function getJenislkAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_jenislk_m->getJenislkAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'idJenislk' => trim($row->id_jenislk),
                'namaJenislk' => trim($row->nama_jenislk)
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function getDescJenislk() {
        $this->CI = & get_instance();
        $idJenislk = $this->input->post('idJenislk', TRUE);
        $rows = $this->master_jenislk_m->getDescJenislk($idJenislk);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'nama_jenislk' => $row->nama_jenislk
                );
        } else {
            $array = array('baris' => 0);
        }

        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        $namaJenislk = trim($this->input->post('namaJenislk'));
        $modelidJenislk = $this->master_jenislk_m->getIdJenislk();
        $data = array(
            'id_jenislk' => $modelidJenislk,
            'nama_jenislk' => $namaJenislk
        );
        $model = $this->master_jenislk_m->insert($data);
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
        $jenislkId = trim($this->input->post('jenislkId'));
        $namaJenislk = trim($this->input->post('namaJenislk'));
        $data = array(
            'nama_jenislk' => $namaJenislk,
            'alamat' => $alamat,
            'telp' => $telp,
            'npwp' => $npwp
        );

        $model = $this->master_jenislk_m->update($data, $jenislkId);
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
        $idJenislk = trim($this->input->post('idJenislk'));

        $model = $this->master_jenislk_m->delete($idJenislk);
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