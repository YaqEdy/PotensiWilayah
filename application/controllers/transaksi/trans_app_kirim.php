<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_app_kirim extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('transaksi/trans_app_kirim_m');
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

    function cetakSuratJalan($id_master) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            //$id_master = (isset($_GET['id']) == true ? $_GET['id'] : 0);
            $data['isidatamaster'] = $this->trans_app_kirim_m->cetakSuratJalanMaster($id_master);
            //print_r($data['isidatamaster']);
            $data['isidatatrans'] = $this->trans_app_kirim_m->cetakSuratJalanPack($id_master);
            if(sizeof($data['isidatatrans']) <1 ){
                $data['packaging'][0]="Mobil";
            }else{
                $data['packaging'][0]=$data['isidatatrans'][0]->nama_produk;
            } 
            //print_r($data);
            $data['header'] = 'Surat Jalan';
            $this->PdfCreate($data, 'SuratJalan_v', 'SuratJalan_v');
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('transaksi/trans_app_kirim/home');
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
            $this->template->load('template/template_dataTable', 'transaksi/list_app_kirim_v', $data);
        }
    }

    public function getRencanaOutAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $tglAwal = $this->input->post('tglAwalDaftar', TRUE);
        $tglAwal = date("Y-m-d", strtotime($tglAwal));
        $tglAkhir = $this->input->post('tglAkhirDaftar', TRUE);
        $tglAkhir = date("Y-m-d", strtotime($tglAkhir));

        $rows = $this->trans_app_kirim_m->getRencanaOutAll($tglAwal, $tglAkhir);
        $data['data'] = array();
        $i = 0;
        $noSeq = 1;
        foreach ($rows as $row) {
            $tglKirim = trim($row->etd);
            $tglKirim = date('d-m-Y', strtotime($tglKirim));

            if ($row->status_pack == 0) {
                $label_pack = "<button class='btn red btn-xs'>Not Ok</button>";
            } else {
                $label_pack = "<button class='btn green btn-xs'>Ok</button>";
            }

            if ($row->status_distribusi == 0) {
                $label_distribusi = "<button class='btn red btn-xs'>Not Ok</button>";
            } else {
                $label_distribusi = "<button class='btn green btn-xs'>Ok</button>";
            }

            if ($row->status_keluar == 0) {
                $label_keluar = "<button class='btn red btn-xs'>Not Ok</button>";
            } else {
                $label_keluar = "<button class='btn green btn-xs'>Ok</button>";
            }
            $array = array(
                'noSeq' => $noSeq,
                'idMaster' => trim($row->id_master_out),
                'no_sj' => trim($row->no_sj),
                'nama_produk' => trim($row->nama_produk),
                'namaCust' => trim($row->nama_cust),
                'no_jnsdoc' => trim($row->no_jnsdoc),
                'nama_jnsdoc' => trim($row->nama_jnsdoc),
                'no_batch' => trim($row->no_batch),
                'tglKirim' => $tglKirim,
                'no_aju' => trim($row->no_aju),
                'no_cukai' => trim($row->no_cukai),
                'totalQty' => trim(number_format($row->total_qty, 2)),
                'keterangan_so' => trim($row->keterangan_so),
                'label_distribusi' => $label_distribusi,
                'flag_distribusi' => $row->status_distribusi,
                'label_pack' => $label_pack,
                'flag_pack' => $row->status_pack,
                'label_keluar' => $label_keluar,
                'flag_keluar' => $row->status_keluar
                    //'act'=>$act
            );

            array_push($data['data'], $array);
            $noSeq++;
        }
        $this->output->set_output(json_encode($data));
    }

    function selectedSO($noSO, $status) {
        //echo $noSO;
        $menuId = $this->home_m->get_menu_id('transaksi/trans_app_kirim/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['info_so'] = $this->trans_app_kirim_m->getDescSO($noSO);
        $data['jml_rincian_so'] = $this->trans_app_kirim_m->getJmlRincianSO($noSO);
        $data['rincian_so'] = $this->trans_app_kirim_m->getRincianSO($noSO);

        $data['jml_rincian_pack'] = $this->trans_app_kirim_m->getJmlRincianPack($noSO);
         $rincian_pack = $this->trans_app_kirim_m->getRincianPack($noSO);
        if($rincian_pack<>0){
            $data['rincian_pack'] = $rincian_pack;
        }else{
            $data['rincian_pack'] = 0;
        }

        $data['produk'] = $this->trans_app_kirim_m->getProduk();
        $data['storage'] = $this->trans_app_kirim_m->getStorage();
        $data['status'] = $status;
        $data['noSO'] = $noSO;
        //allRincianSO
        $rows = array();
        $i = 1;
        $data['all_rincian_so'] = $this->trans_app_kirim_m->getAllRincianSO($noSO);
        //print_r($data['all_rincian_so']);
        foreach ($data['all_rincian_so'] as $tr) {
            if ($tr->id_produk <> '' || $tr->id_produk <> null) {
                $stokakhirproduk = $this->global_m->getStokAkhirProduk($tr->id_produk);
                if ($stokakhirproduk[0]->stok_akhir <= 0) {
                    $rows[] = '<div class="alert alert-danger"> Maaf,stok produk <strong>' . $tr->nama_produk . '</strong> tidak mencukupi.</div>';
                }
                $i++;
            }
        }
        //print_r($rows);

        $data['notif'] = $rows;

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
            $this->template->load('template/template_dataTable', 'transaksi/trans_app_kirim_v', $data);
        }
    }

    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->trans_app_kirim_m->getDescProduk($idProduk);
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

        //$ket = trim($this->input->post('keterangan'));

        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $noSuratJalan = $this->trans_app_kirim_m->getNoSuratJalan($bulan, $tahun);

        $dataMaster = array(
            'no_suratjalan' => $noSuratJalan,
            'tgl_approval' => $tglTrans,
            'tgl_input_approval' => $this->session->userdata('tgl_y'),
            'userid_approval' => $this->session->userdata('id_user'),
            'status_keluar' => 1,
        );
        $model = $this->trans_app_kirim_m->updateMasterOut($dataMaster, $idMaster);
        $query = $this->trans_app_kirim_m->updateTransOut($idMaster);

        $produkKeluar = $this->trans_app_kirim_m->getProdukKeluar($idMaster);

        foreach ($produkKeluar as $tr) {
            if ($tr->id_produk <> '' || $tr->id_produk <> null) {
                $queryUpdateMProduk = $this->global_m->updateMProdukKeluar($tr->qty_rencana, $tr->id_produk);
            }
        }

        //$queryUpdateMProduk = $this->global_m->updateMProdukKeluar($produkKeluar[0]->qty_rencana, $produkKeluar[0]->id_produk);

        $packKeluar = $this->trans_app_kirim_m->getPackKeluar($idMaster);
        if($packKeluar<>null){
            $queryUpdateMProduk = $this->global_m->updateMProdukKeluar($packKeluar[0]->qty, $packKeluar[0]->id_produk);
        }
        /*
        if ($packKeluar[0]->id_produk <> '' || $packKeluar[0]->id_produk <> null) {
            $queryUpdateMProduk = $this->global_m->updateMProdukKeluar($packKeluar[0]->qty, $packKeluar[0]->id_produk);
        }
        */

        /*
          $totJurnal = trim($this->input->post('txtTempLoop'));
          if ($totJurnal > 0) {
          for ($i = 1; $i <= $totJurnal; $i++) {
          $tKdProduk = 'tempKdProduk' . $i;
          $tmpKdProduk = trim($this->input->post($tKdProduk));

          if ($tmpKdProduk <> '') {
          $tKdStorage = 'tempKdStorage' . $i;
          $tKg = 'tempQty' . $i;
          $tKet = 'tempKet' . $i;

          $tmpKdStorage = trim($this->input->post($tKdStorage));
          $tmpKg = str_replace(',', '', trim($this->input->post($tKg)));
          $tmpKet = trim($this->input->post($tKet));

          $queryUpdateMProduk = $this->global_m->updateMProdukKeluar($tmpKg, $tmpKdProduk);
          }
          }
          }
         */

        if ($query) {
            $array = array(
                'act' => 1,
                'noSuratJalan' => $noSuratJalan,
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