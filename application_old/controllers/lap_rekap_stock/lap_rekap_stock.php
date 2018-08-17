<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_rekap_stock extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('lap_rekap_stock/lap_rekap_stock_m');
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
        $menuId = $this->home_m->get_menu_id('lap_rekap_stock/lap_rekap_stock/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['produk'] = $this->lap_rekap_stock_m->getProduk();
        $data['storage'] = $this->lap_rekap_stock_m->getStorage();
        $data['cust'] = $this->lap_rekap_stock_m->getCust();

        if (isset($_POST["btnSimpan"])) {
            $this->display();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'lap_rekap_stock/lap_rekap_stock_v', $data);
        }
    }

    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->lap_rekap_stock_m->getDescProduk($idProduk);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'satuan_lt' => $row->satuan_lt,
                    'satuan_ml' => $row->satuan_ml,
                    'satuan_gr' => $row->satuan_gr,
                    'satuan_drum' => $row->satuan_drum
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
        $rows = $this->lap_rekap_stock_m->getDescStorage($idStorage);
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
    function display() {
        $menuId = $this->home_m->get_menu_id('lap_rekap_stock/lap_rekap_stock/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));
        $idStorage = trim($this->input->post('storage_produk_jadi'));

        $data['datarusun'] = $this->lap_rekap_stock_m->get_dataStorage($idStorage,$tglTrans);

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
	

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'lap_rekap_stock/lap_rekap_stock_display_v', $data);
        
        
    }

    function simpan() {
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));

        $idProdukJadi = trim($this->input->post('produk_jadi'));
        $idStorageProdukJadi = trim($this->input->post('storage_produk_jadi'));
        $totalKg = str_replace(',', '', trim($this->input->post('totalKg')));
        $totalDrum = str_replace(',', '', trim($this->input->post('totalDrum')));

        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $idMasterInCamp = $this->lap_rekap_stock_m->getIdMasterInCamp($bulan, $tahun);

        $data = array(
            'id_master_in_camp' => $idMasterInCamp,
            'id_produk' => $idProdukJadi,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'total_kg' => $totalKg,
            'total_drum' => $totalDrum,
            //'keterangan' => $ket,
            'userid' => $this->session->userdata('id_user')
        );
        $model = $this->lap_rekap_stock_m->insertMasterInCamp($data);

        $data = array(
            'id_master' => $idMasterInCamp,
            'id_produk' => $idProdukJadi,
            'kode_trans' => 110,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'qty_kg' => $totalKg,
            'qty_drum' => $totalDrum,
            'id_storage' => $idStorageProdukJadi,
            //'keterangan' => $tmpKet,
            'userid' => $this->session->userdata('id_user')
        );

        $query = $this->lap_rekap_stock_m->insertTransInOut($data);
        $queryUpdateMProduk = $this->lap_rekap_stock_m->updateMProduk($totalKg, $idProdukJadi);

        $totJurnal = trim($this->input->post('txtTempLoop'));
        if ($totJurnal > 0) {
            for ($i = 1; $i <= $totJurnal; $i++) {
                $tKdProduk = 'tempKdProduk' . $i;
                $tmpKdProduk = trim($this->input->post($tKdProduk));

                if ($tmpKdProduk <> '') {
                    $tKdStorage = 'tempKdStorage' . $i;
                    $tKg = 'tempKg' . $i;
                    $tDrum = 'tempDrum' . $i;
                    $tKet = 'tempKet' . $i;

                    $tmpKdStorage = trim($this->input->post($tKdStorage));
                    $tmpKg = str_replace(',', '', trim($this->input->post($tKg)));
                    $tmpDrum = str_replace(',', '', trim($this->input->post($tDrum)));
                    $tmpKet = trim($this->input->post($tKet));

                    $data = array(
                        'id_master' => $idMasterInCamp,
                        'id_produk' => $tmpKdProduk,
                        'kode_trans' => 210,
                        'tgl_trans' => $tglTrans,
                        'tgl_input' => $this->session->userdata('tgl_y'),
                        'qty_kg' => $tmpKg,
                        'qty_drum' => $tmpDrum,
                        'id_storage' => $tmpKdStorage,
                        'keterangan' => $tmpKet,
                        'userid' => $this->session->userdata('id_user')
                    );

                    $query = $this->lap_rekap_stock_m->insertTransInOut($data);
                    $queryUpdateMProduk = $this->lap_rekap_stock_m->updateMProduk($tmpKg, $tmpKdProduk);
                }
            }
        }

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


}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */