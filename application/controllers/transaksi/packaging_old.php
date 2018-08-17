<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Packaging extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('global_m');
        $this->load->model('transaksi/packaging_m');
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
        $menuId = $this->home_m->get_menu_id('transaksi/packaging/home');
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
            $this->template->load('template/template_dataTable', 'transaksi/list_packaging_v', $data);
        }
    }
    
    public function getRencanaOutAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->packaging_m->getRencanaOutAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $tglTrans = trim($row->tgl_trans);
            $tglTrans = date('d-m-Y', strtotime($tglTrans));
            
            $tglKirim = trim($row->etd);
            $tglKirim = date('d-m-Y', strtotime($tglKirim));
            
            $tglJT = trim($row->eta);
            $tglJT = date('d-m-Y', strtotime($tglJT));
        
            $array = array(
                'idMaster' => trim($row->id_master_out),
                'poCust' => trim($row->no_po_cust),
                'namaCust' => trim($row->nama_cust),
                'tglOrder'  => $tglTrans,
                'tglKirim' => $tglKirim,
                'tglKirim' => $tglKirim,
                'tglJT' => $tglJT,
                'totalQty' => trim(number_format($row->total_qty,2)),
                'button' => "<button class='btn green btn-xs'>packaging</button>",
//                '' => trim($row->),
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }
    
    function selectedSO($noSO) {
        $menuId = $this->home_m->get_menu_id('transaksi/packaging/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['info_so'] = $this->packaging_m->getDescSO($noSO);
        $data['jml_rincian_so'] = $this->packaging_m->getJmlRincianSO($noSO);
        $data['rincian_so'] = $this->packaging_m->getRincianSO($noSO);
        $data['produk'] = $this->packaging_m->getProduk();
        $data['storage'] = $this->packaging_m->getStorage();

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
            $this->template->load('template/template_dataTable', 'transaksi/packaging_v', $data);
        }
    }
    
    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->packaging_m->getDescProduk($idProduk);
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

    function simpan() {
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));
        
        $idMaster = trim($this->input->post('idMaster'));
        
//        $nmPengirim = trim($this->input->post('namaPengirim'));
//        $noMobil = trim($this->input->post('noMobil'));
        
        //$ket = trim($this->input->post('keterangan'));
        
        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $dataMaster = array(
            'tgl_pack' => $tglTrans,
            'tgl_input_pack' => $this->session->userdata('tgl_y'),
//            'nama_pengirim' => $nmPengirim,
//            'no_mobil' => $noMobil,
            'userid_pack' => $this->session->userdata('id_user'),
            'status_pack' => 1,
        );
        $model = $this->packaging_m->updateMasterOut($dataMaster,$idMaster);

        $totJurnal = trim($this->input->post('txtTempLoop'));
        if ($totJurnal > 0) {
            for ($i = 1; $i <= $totJurnal; $i++) {
                $tKdProduk = 'tempKdProduk' . $i;
                $tmpKdProduk = trim($this->input->post($tKdProduk));

                if ($tmpKdProduk <> '') {
                    $tKdStorage = 'tempKdStorage' . $i;
                    $tKg = 'tempQty' . $i;
                    $tNamaPengirim = 'tempNamaPengirim' . $i;
                    $tNoMobil = 'tempNoMobil' . $i;
                    $tKet = 'tempKet' . $i;

                    $tmpKdStorage = trim($this->input->post($tKdStorage));
                    $tmpKg = str_replace(',', '', trim($this->input->post($tKg)));
                    $tmpNamaPengirim = trim($this->input->post($tNamaPengirim));
                    $tmpNoMobil = trim($this->input->post($tNoMobil));
                    $tmpKet = trim($this->input->post($tKet));
                    
                    $idTransOutPack  =   $idMaster."-".$i;  
                    
                    $dataTrans = array(
                        'id_trans_out_pack' => $idTransOutPack,
                        'id_master_out' => $idMaster,
                        'id_produk' => $tmpKdProduk,
                        'tgl_trans' => $tglTrans,
                        'tgl_input' => $this->session->userdata('tgl_y'),
                        'qty' => $tmpKg,
                        'id_storage' => $tmpKdStorage,
                        'nama_pengirim' => $tmpNamaPengirim,
                        'no_mobil' => $tmpNoMobil,
                        'keterangan' => $tmpKet,
                        'userid' => $this->session->userdata('id_user')
                    );

                    $query = $this->packaging_m->insertTransOutPack($dataTrans);
                    $queryUpdateMProduk = $this->global_m->updateMProdukKeluarPack($tmpKg, $tmpKdProduk);
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