<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_produk_camp extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('master/master_produk_camp_m');
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
        $menuId = $this->home_m->get_menu_id('master/master_produk_camp/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['produkjadi'] = $this->master_produk_camp_m->getProdukJadi();
        $data['produkmurni'] = $this->master_produk_camp_m->getProdukMurni();
        $data['produkpencampur'] = $this->master_produk_camp_m->getProdukPencamp();
        //$data['dept'] = $this->master_produk_camp_m->get_dept();

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
            $this->template->load('template/template_dataTable', 'master/master_produk_camp_v', $data);
        }
    }

    public function getProdukAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_produk_camp_m->getProdukAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'idProdukCamp' => trim($row->id_master_isi_camp),
                'idProdukJadi' => trim($row->id_produk_jadi),
                'namaProduk' => trim($row->nama_produk),
                //'namaStorage' => trim($row->nama_produk),
                'nama_produk_jadi' => trim($row->nama_produk_jadi),
                'total_isi' => trim($row->total_isi)
                    //'' => trim($row->),
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function getDescMaster() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->master_produk_camp_m->getDescMaster($idProduk);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'id_produk_jadi' => $row->id_produk_jadi,
                    'nama_produk_jadi' => $row->nama_produk_jadi,
                    'total_isi' => $row->total_isi
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }
        

        $this->output->set_output(json_encode($array));
    }
    function getDescTrans() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $flag = $this->input->post('flag', TRUE);
        
        $rows = $this->master_produk_camp_m->getDescTrans($idProduk,$flag);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'id_produk_isi' => $row->id_produk_isi,
                    'packsize1' => $row->packsize1,
                    'flag'=>$row->flag_produk
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }
        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        //$id_produk = trim($this->input->post('produk'));
        $produk_jadi = trim($this->input->post('produk_jadi'));
        $jmlProdJadi = str_replace(',', '', trim($this->input->post('jmlProdJadi')));
        $namaProdukCamp = trim($this->input->post('namaProdukCamp'));
        
        $produk_murni = trim($this->input->post('produk_murni'));
        $jmlProdMurni = str_replace(',', '', trim($this->input->post('jmlProdMurni')));
        
        $produk_pencampur = trim($this->input->post('produk_pencampur'));
        $jmlProdPencamp = str_replace(',', '', trim($this->input->post('jmlProdPencamp')));
        
        $modelidProduk = $this->master_produk_camp_m->getIdProduk();
        
        $data1 = array(
            'id_master_isi_camp' => $modelidProduk,
            'id_produk_jadi' => $produk_jadi,
            'nama_produk_jadi' => $namaProdukCamp,
            'total_isi' => $jmlProdJadi
        );
        $model = $this->master_produk_camp_m->insertMaster($data1);
        
        $data2 = array(
            'id_master_isi_camp' => $modelidProduk,
            'id_produk_jadi' => $produk_jadi,
            'id_produk_isi' => $produk_murni,
            'packsize1' => $jmlProdMurni,
            'total_isi' => $jmlProdJadi,
            'flag_produk'=>0
        );
        $model = $this->master_produk_camp_m->insertTrans($data2);
        $data3 = array(
            'id_master_isi_camp' => $modelidProduk,
            'id_produk_jadi' => $produk_jadi,
            'id_produk_isi' => $produk_pencampur,
            'packsize1' => $jmlProdPencamp,
            'total_isi' => $jmlProdJadi,
            'flag_produk'=>1
        );
        $model = $this->master_produk_camp_m->insertTrans($data3);
        
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
        $id_produk_camp = trim($this->input->post('produkCampId'));
        $produk_jadi = trim($this->input->post('produk_jadi'));
        $jmlProdJadi = str_replace(',', '', trim($this->input->post('jmlProdJadi')));
        $namaProdukCamp = trim($this->input->post('namaProdukCamp'));
        $produk_murni = trim($this->input->post('produk_murni'));
        $jmlProdMurni = str_replace(',', '', trim($this->input->post('jmlProdMurni')));
        $produk_pencampur = trim($this->input->post('produk_pencampur'));
        $jmlProdPencamp = str_replace(',', '', trim($this->input->post('jmlProdPencamp')));

         $data1 = array(
            'id_produk_jadi' => $produk_jadi,
            'nama_produk_jadi' => $namaProdukCamp,
            'total_isi' => $jmlProdJadi
        );

        $model = $this->master_produk_camp_m->updateMaster($data1, $id_produk_camp);
        
        $data2 = array(
            'id_produk_jadi' => $produk_jadi,
            'id_produk_isi' => $produk_murni,
            'packsize1' => $jmlProdMurni,
            'total_isi' => $jmlProdJadi,
            'flag_produk'=>0
        );
        $model = $this->master_produk_camp_m->updateTrans($data2, $id_produk_camp);
        
        $data3 = array(
            'id_produk_jadi' => $produk_jadi,
            'id_produk_isi' => $produk_pencampur,
            'packsize1' => $jmlProdPencamp,
            'total_isi' => $jmlProdJadi,
            'flag_produk'=>1
        );
        $model = $this->master_produk_camp_m->updateTrans($data3, $id_produk_camp);
        
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
        $id_produk_camp = trim($this->input->post('produkCampId'));

        $model = $this->master_produk_camp_m->deleteMaster($id_produk_camp);
        $model = $this->master_produk_camp_m->deleteTrans($id_produk_camp);
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