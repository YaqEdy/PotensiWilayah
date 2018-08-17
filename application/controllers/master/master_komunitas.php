<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_komunitas extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('master/master_komunitas_m');
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
        $menuId = $this->home_m->get_menu_id('master/master_komunitas/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['kec'] = $this->global_m->getSelectOption('master_kecamatan','','','','','id_kec');
        $data['kel'] = $this->global_m->getSelectOption('master_kelurahan','','','','','id_kel');
        $data['jeniskomunitas'] = $this->global_m->getSelectOption('master_jeniskomunitas','','','','','id_jeniskomunitas');

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
            $this->template->load('template/template_dataTable', 'master/master_komunitas_v', $data);
        }
    }

    public function getKomunitasAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_komunitas_m->getKomunitasAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'idKomunitas' => trim($row->id_komunitas),
                'namaKomunitas' => trim($row->nama_komunitas),
                'kec' => trim($row->nama_kec),
                'kel' => trim($row->nama_kel),
                'jeniskomunitas'=>$row->nama_jeniskomunitas
            );
            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }
    

    function getDescKel() {
        $this->CI = & get_instance();
        $idKel = $this->input->post('idKel', TRUE);
        $rows = $this->master_komunitas_m->getDescKel($idKel);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'nama_kel' => $row->nama_kel,
                    'id_kec' => $row->id_kec,
                    'nama_kec' => $row->nama_kec,
                    'jeniskomunitas'=>$row->nama_jeniskomunitas
                );
        } else {
            $array = array('baris' => 0);
        }

        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        $namaKomunitas = trim($this->input->post('namaKomunitas'));
        $kec = trim($this->input->post('kec'));
        $kel = trim($this->input->post('kel'));
        $alamat = trim($this->input->post('alamat'));
        $nama_koordinator = trim($this->input->post('namaKoordinator'));
        $no_telp = trim($this->input->post('noTelp'));
        $jeniskomunitas = trim($this->input->post('jeniskomunitas'));
        $modelidKomunitas = $this->master_komunitas_m->getIdKomunitas();
        $data = array(
            'id_komunitas' => $modelidKomunitas,
            'nama_komunitas' => $namaKomunitas,
            'id_kec' => $kec,
            'id_kel' => $kel,
            'alamat' => $alamat,
            'nama_koordinator' => $nama_koordinator,
            'no_telp'=>$no_telp,
            'id_jeniskomunitas'=>$jeniskomunitas
        );
        $model = $this->master_komunitas_m->insert($data);
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

        $model = $this->master_komunitas_m->update($data, $kelId);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'komunitasccess',
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

        $model = $this->master_komunitas_m->delete($idKel);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'komunitasccess',
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