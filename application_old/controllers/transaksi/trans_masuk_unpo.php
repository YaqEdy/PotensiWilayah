<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_masuk_unpo extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('global_m');
        $this->load->model('transaksi/trans_masuk_unpo_m');
        $this->load->library('pdf');
        session_start();
    }
    function PdfCreate($data, $viewName, $createName) {

        $html = $this->load->view('cetak/' . $viewName, $data, true);

        $this->pdf->pdf_create($html, $createName, true);
    }
    function cetakSTB($id_master) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            //$id_master = (isset($_GET['id']) == true ? $_GET['id'] : 0);
            $data['isidatamaster'] = $this->trans_masuk_unpo_m->cetakStbMaster($id_master);
            //print_r($data['isidatamaster']);
            $data['isidatatrans'] = $this->trans_masuk_unpo_m->cetakStbTrans($id_master);
            //print_r($data['isidatatrans']);
            $data['header'] = 'STB';
            $this->PdfCreate($data, 'STB_v', 'STB_v');
        }
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
        $menuId = $this->home_m->get_menu_id('transaksi/trans_masuk_unpo/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['produk'] = $this->trans_masuk_unpo_m->getProduk();
        $data['storage'] = $this->trans_masuk_unpo_m->getStorage();
        $data['suplier'] = $this->trans_masuk_unpo_m->getSuplier();

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'transaksi/trans_masuk_unpo_v', $data);
        }
    }

    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->trans_masuk_unpo_m->getDescProduk($idProduk);
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
        $rows = $this->trans_masuk_unpo_m->getDescStorage($idStorage);
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
        
        $noBatch = trim($this->input->post('noBatch'));
        $noCukai = trim($this->input->post('noCukai'));
        $idSpl = trim($this->input->post('suplier'));
        $nmPengirim = trim($this->input->post('namaPengirim'));
        $noMobil = trim($this->input->post('noMobil'));
        $beratMol = str_replace(',', '', trim($this->input->post('beratMolindo')));
        $bruto = str_replace(',', '', trim($this->input->post('bruto')));
        $tarra = str_replace(',', '', trim($this->input->post('tarra')));
        $netto = str_replace(',', '', trim($this->input->post('netto')));
        $selisihKg = str_replace(',', '', trim($this->input->post('selisihKg')));
        $selisihPersen = str_replace(',', '', trim($this->input->post('selisihPersen')));
        
        $totalKg = str_replace(',', '', trim($this->input->post('totalKg')));
        $totalHargaAll = str_replace(',', '', trim($this->input->post('totalHargaAll')));
        $ket = trim($this->input->post('keterangan'));
        
        
        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $idMasterIn = $this->trans_masuk_unpo_m->getIdMasterIn($bulan, $tahun);
        
        $data = array(
            'id_master_in' => $idMasterIn,
            'id_spl' => $idSpl,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'tgl_datang' => $tglTrans,
            'tgl_datang_input' => $this->session->userdata('tgl_y'),
            'etd' => $tglTrans,
            'eta' => $tglTrans,
            'no_cukai' => $noCukai,
            'no_batch' => $noBatch,
            'nama_pengirim' => $nmPengirim,
            'no_mobil' => $noMobil,
            'qty_spl_kg' => $beratMol,
            'qty_bruto_kg' => $bruto,
            'qty_tarra_kg' => $tarra,
            'qty_netto_kg' => $netto,
            'selisih_kg' => $selisihKg,
            'selisih_persen' => $selisihPersen,
            'total_qty' => $totalKg,
            'total_harga' => $totalHargaAll,
            'keterangan_datang' => $ket,
            'userid_datang' => $this->session->userdata('id_user'),
            'status_datang' => 1,
        );
        $model = $this->trans_masuk_unpo_m->insertMaster($data);

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
                    
                    $idTransIn  =   $idMasterIn."-".$i;  
                    
                    $data = array(
                        'id_trans_in' => $idTransIn,
                        'id_master' => $idMasterIn,
                        'id_produk' => $tmpKdProduk,
                        'kode_trans' => 100,
                        'tgl_trans' => $tglTrans,
                        'tgl_input' => $this->session->userdata('tgl_y'),
                        'tgl_datang' => $tglTrans,
                        'qty_realisasi' => $tmpKg,
                        'harga_satuan' =>$tmpHargaSatuan,
                        'id_storage' => $tmpKdStorage,
                        'keterangan_datang' => $tmpKet,
                        'userid' => $this->session->userdata('id_user')
                    );

                    $query = $this->trans_masuk_unpo_m->insertTransIn($data);
                    $queryUpdateMProduk = $this->global_m->updateMProdukMasuk($tmpKg, $tmpKdProduk);
                }
            }
        }

        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil disimpan.',
                'idMaster' => $idMasterIn
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