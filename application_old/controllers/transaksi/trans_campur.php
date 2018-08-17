<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_campur extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('transaksi/trans_campur_m');
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
        $menuId = $this->home_m->get_menu_id('transaksi/trans_campur/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['produk'] = $this->trans_campur_m->getProduk();
        $data['produk_katalis'] = $this->trans_campur_m->getProdukKatalis();
        $data['storage'] = $this->trans_campur_m->getStorage();
        $data['cust'] = $this->trans_campur_m->getCust();

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'transaksi/trans_campur_v', $data);
        }
    }

    function getDescProdukJadi() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->trans_campur_m->getDescProdukJadi($idProduk);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'id_storage' => $row->id_storage
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
        $rows = $this->trans_campur_m->getDescStorage($idStorage);
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
    function getIsiCamp()
    {
        $this->CI =& get_instance();
        $idProdukJadi = $this->input->post('idProdukJadi', TRUE);
        $crows = $this->trans_campur_m->getCIsiCamp($idProdukJadi);
        if ($crows <= 0) {
            $array = array('baris' => 0);
            $rows['data_cpa'] = $array;
            $this->output->set_output(json_encode($rows));
        } else {
            $rows = $this->trans_campur_m->getDescIsiCamp($idProdukJadi);
            $this->output->set_output(json_encode($rows));
            //$this->cekStok();
        }
    }
    function cekStokAkhir(){
        $this->CI =& get_instance();
        $idProdukJadi = $this->input->post('idProdukJadi', TRUE);
        $rows = array();
        $i = 1;
        $data['isi_camp'] = $this->trans_campur_m->getDescIsiCamp2($idProdukJadi);
        foreach ($data['isi_camp'] as $tr){
            $stokakhirproduk = $this->global_m->getStokAkhirProduk($tr->id_produk_isi);
            if($stokakhirproduk[0]->stok_akhir <=0){
                $rows[] = '<div class="alert alert-danger"> Maaf, stok produk <strong>'.$tr->nama_produk.'</strong> tidak mencukupi.</div>';
            }
            $i++;
        }
        //print_r($rows);
        $this->output->set_output(json_encode($rows));
        //$data['notif'] = $rows;
    }

    function simpan() {
        
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));

        $idProdukJadiCamp = trim($this->input->post('produk_jadi'));//id masterisicamp
        $idProdukJadi = $this->trans_campur_m->getProdukJadi($idProdukJadiCamp);
        $idProdukJadi = $idProdukJadi[0]->id_produk_jadi;
        
        $idStorageProdukJadi = trim($this->input->post('storage_produk_jadi'));
        $totalKg = str_replace(',', '', trim($this->input->post('totalKg')));
        $totalDrum = str_replace(',', '', trim($this->input->post('totalDrum')));

        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $idMasterInCamp = $this->trans_campur_m->getIdMasterInCamp($bulan, $tahun);

        $data = array(
            'id_master_in_camp' => $idMasterInCamp,
            'id_produk_jadi' => $idProdukJadiCamp,
            'id_produk' => $idProdukJadi,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'total_kg' => $totalKg,
            //'keterangan' => $ket,
            'userid' => $this->session->userdata('id_user')
        );
        $model = $this->trans_campur_m->insertMasterInCamp($data);
        
        $idTransIn  =   $idMasterInCamp."-1"; 
        
        $data = array(
            'id_trans_in' => $idTransIn,
            'id_master' => $idMasterInCamp,
            'id_produk' => $idProdukJadi,
            'kode_trans' => 110,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'qty_realisasi' => $totalKg,
            'id_storage' => $idStorageProdukJadi,
            //'keterangan' => $tmpKet,
            'userid' => $this->session->userdata('id_user')
        );

        $query = $this->trans_campur_m->insertTransIn($data);
        $queryUpdateMProduk = $this->global_m->updateMProdukInCamp($totalKg, $idProdukJadi);

        $totJurnal = trim($this->input->post('txtTempLoop'));
        if ($totJurnal > 0) {
            for ($i = 0; $i <= $totJurnal; $i++) {
                $tKdProduk = 'tempKdProduk' . $i;
                $tmpKdProduk = trim($this->input->post($tKdProduk));

                if ($tmpKdProduk <> '') {
                    $tKdStorage = 'tempKdStorage' . $i;
                    $tKg = 'tempKg' . $i;                    
                    $tKet = 'tempKet' . $i;

                    $tmpKdStorage = trim($this->input->post($tKdStorage));
                    $tmpKg = str_replace(',', '', trim($this->input->post($tKg)));
                    $tmpKet = trim($this->input->post($tKet));
                    
                    $idTransOut  =   $idMasterInCamp."-".$i;
                    
                    $data = array(
                        'id_trans_out' => $idTransOut,
                        'id_master' => $idMasterInCamp,
                        'id_produk' => $tmpKdProduk,
                        'kode_trans' => 210,
                        'tgl_trans' => $tglTrans,
                        'tgl_input' => $this->session->userdata('tgl_y'),
                        'qty_realisasi' => $tmpKg,
                        'id_storage' => $tmpKdStorage,
                        'keterangan' => $tmpKet,
                        'userid' => $this->session->userdata('id_user')
                    );

                    $query = $this->trans_campur_m->insertTransOut($data);
                    $queryUpdateMProduk = $this->global_m->updateMProdukOutCamp($tmpKg, $tmpKdProduk);
                }
            }
        }

        if ($query) {
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