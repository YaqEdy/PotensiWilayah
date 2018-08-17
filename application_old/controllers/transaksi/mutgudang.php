<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mutgudang extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('global_m');
        $this->load->model('transaksi/sales_order_m');
        $this->load->model('transaksi/mutgudang_m');
        $this->load->library('pdf');
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

    function PdfCreate($data, $viewName, $createName) {

        $html = $this->load->view('cetak/' . $viewName, $data, true);

        $this->pdf->pdf_create($html, $createName, true);
    }

    function cetakPO($id_master) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            //$id_master = (isset($_GET['id']) == true ? $_GET['id'] : 0);
            $data['isidatamaster'] = $this->mutgudang_m->cetakPOMaster($id_master);
            //print_r($data['isidatamaster']);
            $data['isidatatrans'] = $this->mutgudang_m->cetakPOTrans($id_master);
            //print_r($data['isidatatrans']);
            $data['header'] = 'PO';
            $this->PdfCreate($data, 'PO_v', 'PO_v');
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('transaksi/mutgudang/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['produk'] = $this->mutgudang_m->getProduk();
        $data['storage'] = $this->mutgudang_m->getStorage();

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'transaksi/mutgudang_v', $data);
        }
    }
    
    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->mutgudang_m->getDescProduk($idProduk);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'id_storage' => $row->id_storage,
                    'packsize2' => $row->packsize2,
                    'packsize3' => $row->packsize3,
                    'packsize4' => $row->packsize4,
                    'packsize5' => $row->packsize5
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }
        $this->output->set_output(json_encode($array));
    }

    function getDescStorage() {
        $this->CI = & get_instance();
        $idStorage = $this->input->post('idStorage', TRUE);
        $rows = $this->mutgudang_m->getDescStorage($idStorage);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'nama_jns_storage' => $row->nama_jns_storage
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }
        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));

        $keterangan = trim($this->input->post('keteranganCPA'));

        $storage_from = trim($this->input->post('storage_from'));
        $storage_to = trim($this->input->post('storage_to'));
        $produk = trim($this->input->post('produk'));
        $produk_to = trim($this->input->post('produk_to'));

        $produkKg = str_replace(',', '', trim($this->input->post('produkKg')));

        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $idMasterMutasi = $this->mutgudang_m->getIdMasterMutasi($bulan, $tahun);

        $data = array(
            'id_master_mutasi' => $idMasterMutasi,
            'id_produk_from' => $produk,
            'id_produk_to' => $produk_to,
            'id_storage_from' => $storage_from,
            'id_storage_to' => $storage_to,
            'total_kg' => $produkKg,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'userid' => $this->session->userdata('id_user'),
            'keterangan' => $keterangan
        );
        
        $modelMaster = $this->mutgudang_m->insertMaster($data);
        
        $i = 1;
        $idTransIn = $idMasterMutasi . "-" . $i;

        $data = array(
            'id_trans_in' => $idTransIn,
            'id_master' => $idMasterMutasi,
            'no_po' => '',
            'id_produk' => $produk_to,
            'kode_trans' => 120,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'qty_realisasi' => $produkKg,
            //'harga_satuan' =>$tmpHargaSatuan,
            'id_storage' => $storage_to,
            'keterangan' => $keterangan,
            'userid' => $this->session->userdata('id_user')
        );
        $query = $this->mutgudang_m->insertTransIn($data);
        $queryUpdateMProduk = $this->global_m->updateMProdukMasuk($produkKg, $produk_to);

        $dataTrans = array(
            'id_trans_out' => $idTransIn,
            'id_master' => $idMasterMutasi,
            'id_produk' => $produk,
            'kode_trans' => 220,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'qty_realisasi' => $produkKg,
            'id_storage' => $storage_from,
            'keterangan' => $keterangan,
            'userid' => $this->session->userdata('id_user')
        );

        $query = $this->sales_order_m->insertTransOut($dataTrans);
        $queryUpdateMProduk = $this->global_m->updateMProdukKeluar($produkKg, $produk);
        
/*

        $totJurnal = trim($this->input->post('txtTempLoop'));
        if ($totJurnal > 0) {
            for ($i = 1; $i <= $totJurnal; $i++) {
                $tKdProduk = 'tempKdProduk' . $i;
                $tmpKdProduk = trim($this->input->post($tKdProduk));

                if ($tmpKdProduk <> '') {
                    $tKdStorage = 'tempKdStorage' . $i;
                    $tKg = 'tempKg' . $i;
                    $tHargaSatuan = 'tempHargaSatuan' . $i;
                    $tKet = 'tempKet' . $i;

                    $tmpKdStorage = trim($this->input->post($tKdStorage));
                    $tmpKg = str_replace(',', '', trim($this->input->post($tKg)));
                    $tmpHargaSatuan = str_replace(',', '', trim($this->input->post($tHargaSatuan)));
                    $tmpKet = trim($this->input->post($tKet));

                    $idTransIn = $idMasterIn . "-" . $i;

                    $data = array(
                        'id_trans_in' => $idTransIn,
                        'id_master' => $idMasterIn,
                        'no_po' => $noPO,
                        'id_produk' => $tmpKdProduk,
                        'kode_trans' => 100,
                        'tgl_trans' => $tglTrans,
                        'tgl_input' => $this->session->userdata('tgl_y'),
                        'qty_rencana' => $tmpKg,
                        'harga_satuan' => $tmpHargaSatuan,
                        'id_storage' => $tmpKdStorage,
                        'keterangan' => $tmpKet,
                        'userid' => $this->session->userdata('id_user')
                    );

                    $query = $this->mutgudang_m->insertTransInOut($data);
                    //$queryUpdateMProduk = $this->mutgudang_m->updateMProduk($tmpKg, $tmpKdProduk);
                }
            }
        }
        */
        if ($modelMaster) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil disimpan.',
                'idMaster' => $idMasterMutasi
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

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */