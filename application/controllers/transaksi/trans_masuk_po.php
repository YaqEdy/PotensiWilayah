<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_masuk_po extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('transaksi/trans_masuk_po_m');
        $this->load->model('global_m');
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
    function cetakSTB($id_master) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            //$id_master = (isset($_GET['id']) == true ? $_GET['id'] : 0);
            $data['isidatamaster'] = $this->trans_masuk_po_m->cetakStbMaster($id_master);
            //print_r($data['isidatamaster']);
            $data['isidatatrans'] = $this->trans_masuk_po_m->cetakStbTrans($id_master);
            //print_r($data['isidatatrans']);
            $data['header'] = 'STB';
            $this->PdfCreate($data, 'STB_v', 'STB_v');
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('transaksi/trans_masuk_po/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        
        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'transaksi/trans_list_po_v', $data);
        }
    }
    
    public function getPOAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->trans_masuk_po_m->getPOAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'noPO' => trim($row->no_po),
                'namaSpl' => trim($row->nama_spl),
                'tglPO' => date('d-m-Y', strtotime(trim($row->tgl_trans))),
                'jml' => trim(number_format($row->total_qty,2)),
                'totalHarga' => trim(number_format($row->total_harga,2)),
                'button' => "<button class='btn green btn-xs'>realisasi</button>",
//                '' => trim($row->),
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }
    
    function selectedPO($noPO) {
        $menuId = $this->home_m->get_menu_id('transaksi/trans_masuk_po/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['info_po'] = $this->trans_masuk_po_m->getDescPO($noPO);
        $data['jml_rincian_po'] = $this->trans_masuk_po_m->getJmlRincianPO($noPO);
        $data['rincian_po'] = $this->trans_masuk_po_m->getRincianPO($noPO);

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
            $this->template->load('template/template_dataTable', 'transaksi/trans_masuk_po_v', $data);
        }
    }
    
    

    function simpan() {
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));
        
        $idMaster = trim($this->input->post('idMaster'));
        $noPO = trim($this->input->post('noPO'));
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
        $ket = trim($this->input->post('keterangan'));
        
        
        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $dataMaster = array(
            'tgl_datang' => $tglTrans,
            'tgl_datang_input' => $this->session->userdata('tgl_y'),
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
            'keterangan_datang' => $ket,
            'userid_datang' => $this->session->userdata('id_user'),
            'status_datang' => 1,
        );
        $model = $this->trans_masuk_po_m->updateMasterIn($dataMaster,$idMaster);

        $totJurnal = trim($this->input->post('txtTempLoop'));
        if ($totJurnal > 0) {
            for ($i = 1; $i <= $totJurnal; $i++) {
                $tKdProduk = 'tempKdProduk' . $i;
                $tmpKdProduk = trim($this->input->post($tKdProduk));

                if ($tmpKdProduk <> '') {
                    $tKdTrans = 'tempKdTrans' . $i;
                    $tKdStorage = 'tempKdStorage' . $i;
                    $tKg = 'tempQty' . $i;
                    $tHargaSatuan = 'tempHargaSatuan' . $i;
                    $tKet = 'tempKet' . $i;

                    $tmpKdTrans = trim($this->input->post($tKdTrans));
                    $tmpKdStorage = trim($this->input->post($tKdStorage));
                    $tmpKg = str_replace(',', '', trim($this->input->post($tKg)));
                    $tmpHargaSatuan = str_replace(',', '', trim($this->input->post($tHargaSatuan)));
                    $tmpKet = trim($this->input->post($tKet));
                    
                    $dataTrans = array(
                        'qty_realisasi' => $tmpKg,
                        'tgl_datang' => $tglTrans,
                        'id_storage' => $tmpKdStorage,
                        'keterangan_datang' => $tmpKet,
                        'userid' => $this->session->userdata('id_user')
                    );

                    $query = $this->trans_masuk_po_m->updateTransIn($dataTrans,$tmpKdTrans);
                    $queryUpdateMProduk = $this->global_m->updateMProdukMasuk($tmpKg, $tmpKdProduk);
                }
            }
        }

        if ($query) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil disimpan.',//$tmpKg.'- '.$tmpKdProduk.' '.$tmpKdTrans.'-'.
                'idMaster' => $idMaster
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