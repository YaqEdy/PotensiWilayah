<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_agen extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('master/master_agen_m');
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
        $menuId = $this->home_m->get_menu_id('master/master_agen/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } elseif (isset($_POST["btnUbah"])) {
            $this->ubah();
        } elseif (isset($_POST["btnHapus"])) {
            $this->nonaktif();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'master/master_agen_v', $data);
        }
    }

    public function getAgenAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_agen_m->getAgenAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'idAgen' => trim($row->id_agen),
                'namaAgen' => trim($row->nama_agen),
                'alamat' => trim($row->alamat),
                'telp' => trim($row->telp),
                'kode_perk' => trim($row->kode_perk),
                'nama_perk' => trim($row->nama_perk),
                'keterangan' => trim($row->keterangan)
                    //'' => trim($row->),
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    

    function simpan() {
        //$id_produk = trim($this->input->post('produk'));
        $namaAgen = trim($this->input->post('namaAgen'));
        $alamat = trim($this->input->post('alamat'));
        $telp = trim($this->input->post('telp'));
        $kodePerk = trim($this->input->post('kodePerk'));
        $keterangan = trim($this->input->post('keterangan'));

        $modelidAgen = $this->master_agen_m->getIdAgen();
        $data = array(
            'id_agen' => $modelidAgen,
            'nama_agen' => $namaAgen,
            'alamat' => $alamat,
            'telp' => $telp,
            'kode_perk' => $kodePerk,
            'keterangan' => $keterangan
        );
        $model = $this->master_agen_m->insert($data);
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
        $id_agen = trim($this->input->post('agenId'));
        $namaAgen = trim($this->input->post('namaAgen'));
        $alamat = trim($this->input->post('alamat'));
        $telp = trim($this->input->post('telp'));
        $kodePerk = trim($this->input->post('kodePerk'));
        $keterangan = trim($this->input->post('keterangan'));

        $data = array(
            'nama_agen' => $namaAgen,
            'alamat' => $alamat,
            'telp' => $telp,
            'kode_perk' => $kodePerk,
            'keterangan' => $keterangan
        );

        $model = $this->master_agen_m->update($data, $id_agen);
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

    function nonaktif() {
        $id_produk = trim($this->input->post('idAgen'));

        $data = array(
            'status_aktif' => '0'
        );

        $model = $this->master_agen_m->update($data, $id_produk);

        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil dinonaktifkan.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal dinonaktifkan.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

    function hapus() {
        $this->CI = & get_instance();
        $idAgen = trim($this->input->post('produkId'));

        $model = $this->master_agen_m->delete($idAgen);
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