<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_produk extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('master/master_produk_m');
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
        $menuId = $this->home_m->get_menu_id('master/master_produk/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        //$data['storage'] = $this->master_produk_m->getStorage();
        $data['jns_produk'] = $this->master_produk_m->getJnsProduk();
        //$data['dept'] = $this->master_produk_m->get_dept();

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
            $this->template->load('template/template_dataTable', 'master/master_produk_v', $data);
        }
    }

    public function getProdukAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_produk_m->getProdukAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'idProduk' => trim($row->id_produk),
                'namaProduk' => trim($row->nama_produk),
                'harga1' => number_format($row->harga1),
                'harga2' => number_format($row->harga2),
                'harga3' => number_format($row->harga3),
                'harga4' => number_format($row->harga4),
                'harga5' => number_format($row->harga5),
                'harga6' => number_format($row->harga6),
                'harga7' => number_format($row->harga7),
                'keterangan' => trim($row->keterangan)
                    //'' => trim($row->),
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->master_produk_m->getDescProduk($idProduk);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'nama_produk' => $row->nama_produk,
                    'harga1' => number_format($row->harga1),
                    'harga2' => number_format($row->harga2),
                    'harga3' => number_format($row->harga3),
                    'harga4' => number_format($row->harga4),
                    'harga5' => number_format($row->harga5),
                    'harga6' => number_format($row->harga6),
                    'harga7' => number_format($row->harga7),
                    'keterangan' => $row->keterangan
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }

        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        //$id_produk = trim($this->input->post('produk'));
        $namaProduk = trim($this->input->post('namaProduk'));
        $harga1 = str_replace(',', '', trim($this->input->post('harga1')));
        $harga2 = str_replace(',', '', trim($this->input->post('harga2')));
        $harga3 = str_replace(',', '', trim($this->input->post('harga3')));
        $harga4 = str_replace(',', '', trim($this->input->post('harga4')));
        $harga5 = str_replace(',', '', trim($this->input->post('harga5')));
        $harga6 = str_replace(',', '', trim($this->input->post('harga6')));
        $harga7 = str_replace(',', '', trim($this->input->post('harga7')));
        $keterangan = trim($this->input->post('keterangan'));

        $modelidProduk = $this->master_produk_m->getIdProduk();
        $data = array(
            'id_produk' => $modelidProduk,
            'nama_produk' => $namaProduk,
            'harga1' => $harga1,
            'harga2' => $harga2,
            'harga3' => $harga3,
            'harga4' => $harga4,
            'harga5' => $harga5,
            'harga6' => $harga6,
            'harga7' => $harga7,
            'keterangan' => $keterangan
        );
        $model = $this->master_produk_m->insert($data);
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
        $id_produk = trim($this->input->post('produkId'));
        $namaProduk = trim($this->input->post('namaProduk'));
        $harga1 = str_replace(',', '', trim($this->input->post('harga1')));
        $harga2 = str_replace(',', '', trim($this->input->post('harga2')));
        $harga3 = str_replace(',', '', trim($this->input->post('harga3')));
        $harga4 = str_replace(',', '', trim($this->input->post('harga4')));
        $harga5 = str_replace(',', '', trim($this->input->post('harga5')));
        $harga6 = str_replace(',', '', trim($this->input->post('harga6')));
        $harga7 = str_replace(',', '', trim($this->input->post('harga7')));
        $keterangan = trim($this->input->post('keterangan'));

        $data = array(
            'nama_produk' => $namaProduk,
            'harga1' => $harga1,
            'harga2' => $harga2,
            'harga3' => $harga3,
            'harga4' => $harga4,
            'harga5' => $harga5,
            'harga6' => $harga6,
            'harga7' => $harga7,
            'keterangan' => $keterangan
        );

        $model = $this->master_produk_m->update($data, $id_produk);
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
        $id_produk = trim($this->input->post('idProduk'));
        
        $data = array(
            'status_aktif' => '0'
        );

        $model = $this->master_produk_m->update($data, $id_produk);

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
        $idProduk = trim($this->input->post('produkId'));

        $model = $this->master_produk_m->delete($idProduk);
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