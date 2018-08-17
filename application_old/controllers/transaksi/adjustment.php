<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adjustment extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('transaksi/sales_order_m');
        $this->load->model('transaksi/adjustment_m');
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

    function cetakPO($id_master) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            //$id_master = (isset($_GET['id']) == true ? $_GET['id'] : 0);
            $data['isidatamaster'] = $this->adjustment_m->cetakPOMaster($id_master);
            //print_r($data['isidatamaster']);
            $data['isidatatrans'] = $this->adjustment_m->cetakPOTrans($id_master);
            //print_r($data['isidatatrans']);
            $data['header'] = 'PO';
            $this->PdfCreate($data, 'PO_v', 'PO_v');
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('transaksi/adjustment/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['produk'] = $this->adjustment_m->getProduk();
        $data['storage'] = $this->adjustment_m->getStorage();
        $data['suplier'] = $this->adjustment_m->getSuplier();

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
            echo "hehe";
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'transaksi/adjustment_v', $data);
        }
    }

    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->adjustment_m->getDescProduk($idProduk);
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
        $rows = $this->adjustment_m->getDescStorage($idStorage);
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
        $jnsOut = trim($this->input->post('jns_out'));

        $idSpl = '';
        $totalKg = str_replace(',', '', trim($this->input->post('totalKg')));
        $totalHargaAll = 0;
        $ket = trim($this->input->post('keterangan'));

        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $idMasterOut = $this->adjustment_m->getIdMasterAjm($bulan, $tahun);

        $data = array(
            'id_master_out' => $idMasterOut,
            'jns_out'=>$jnsOut,
            'id_cust' => '',
            'no_po_cust' => '',
            'no_skep' => '',
            'id_jnsdoc' => '',
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'etd' => $tglTrans,
            'eta' => $tglTrans,
            'id_produk' => '',
            'total_qty' => $totalKg,
            'keterangan_so' => $ket,
            'keterangan_distribusi' => $ket,
            'keterangan_keluar' => $ket,
            'userid' => $this->session->userdata('id_user'),
            'no_suratjalan' => '',
            'tgl_approval' => $tglTrans,
            'tgl_input_approval' => $this->session->userdata('tgl_y'),
            'userid_approval' => $this->session->userdata('id_user'),
            'status_pack' => 1,
            'status_distribusi' => 1,
            'status_keluar' => 1
        );
        $model = $this->sales_order_m->insertMaster($data);

        $idTransOut = $idMasterOut . "-" . 1;
        
        $totJurnal = trim($this->input->post('txtTempLoop'));
        if ($totJurnal > 0) {
            for ($i = 1; $i <= $totJurnal; $i++) {
                $tKdProduk = 'tempKdProduk' . $i;
                $tmpKdProduk = trim($this->input->post($tKdProduk));

                if ($tmpKdProduk <> '') {
                    $tKdStorage = 'tempKdStorage' . $i;
                    $tKg = 'tempKg' . $i;
                    $tKet = 'tempKet' . $i;

                    $tmpKdStorage = trim($this->input->post($tKdStorage));
                    $tmpKg = str_replace(',', '', trim($this->input->post($tKg)));
                    $tmpKet = trim($this->input->post($tKet));
                    $idTransOut = $idMasterOut . "-" . $i;

                    $dataTrans = array(
                        'id_trans_out' => $idTransOut,
                        'id_master' => $idMasterOut,
                        'id_produk' => $tmpKdProduk,
                        'kode_trans' => 230,
                        'tgl_trans' => $tglTrans,
                        'tgl_input' => $this->session->userdata('tgl_y'),
                        'qty_rencana' => $tmpKg,
                        'qty_realisasi' => $tmpKg,
                        'id_storage' => $tmpKdStorage,
                        'keterangan' => $tmpKet,
                        'userid' => $this->session->userdata('id_user')
                    );
                    $query = $this->sales_order_m->insertTransOut($dataTrans);
                    $queryUpdateMProduk = $this->global_m->updateMProdukKeluarReq($tmpKg, $tmpKdProduk);
                    $queryUpdateMProduk = $this->global_m->updateMProdukKeluar($tmpKg, $tmpKdProduk);
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