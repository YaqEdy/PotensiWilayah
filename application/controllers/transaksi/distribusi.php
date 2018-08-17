<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distribusi extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('global_m');
        $this->load->model('transaksi/distribusi_m');
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
        $menuId = $this->home_m->get_menu_id('transaksi/distribusi/home');
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
            $this->template->load('template/template_dataTable', 'transaksi/list_distribusi_v', $data);
        }
    }
    function getDataDistribusi()
    {
        $this->CI =& get_instance();
        $noSO = $this->input->post('noSO', TRUE);
        $crows = $this->distribusi_m->getCDistribusi($noSO);
        if ($crows <= 0) {
            $array = array('baris' => 0);
            $rows['data_cpa'] = $array;
            $this->output->set_output(json_encode($rows));
        } else {
            $rows = $this->distribusi_m->getDescDistribusi($noSO);
            $this->output->set_output(json_encode($rows));
        }
    }
    public function getRencanaOutAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $tglAwal = $this->input->post('tglAwalDaftar', TRUE);
        $tglAwal = date("Y-m-d",strtotime($tglAwal));
        $tglAkhir = $this->input->post('tglAkhirDaftar', TRUE);
        $tglAkhir = date("Y-m-d",strtotime($tglAkhir));
        
        $rows = $this->distribusi_m->getRencanaOutAll($tglAwal,$tglAkhir);
        $data['data'] = array();
        $i = 0;
        $noSeq = 1;
        foreach ($rows as $row) {
            
            $tglKirim = trim($row->etd);
            $tglKirim = date('d-m-Y', strtotime($tglKirim));
            $tglTransDistribusi = trim($row->tgl_trans_distribusi);
            if($tglTransDistribusi == '0000-00-00'){
                $label = "<button class='btn red btn-xs'>not ok</button>";
                $status = 0;
            }else{
                $label = "<button class='btn green btn-xs'>ok</button>";
                $status = 1;
            }
            //$act = "<a href='#' class='btn yellow btn-sm' onclick='editBaris(tr".$i.")' ><i class='fa fa-edit fa-fw'/></i></a>";
        
            $array = array(
                'noSeq' => $noSeq,
                'idMaster' => trim($row->id_master_out),
                'no_sj' => trim($row->no_sj),
                'nama_produk' => trim($row->nama_produk),
                'namaCust' => trim($row->nama_cust),
                'no_jnsdoc' => trim($row->no_jnsdoc),
                'nama_jnsdoc'  => trim($row->nama_jnsdoc),
                'no_batch' => trim($row->no_batch),
                'tglKirim' => $tglKirim,
                'no_aju' => trim($row->no_aju),
                'no_cukai' => trim($row->no_cukai),
                'totalQty' => trim(number_format($row->total_qty,2)),
                'keterangan_so'=>trim($row->keterangan_so),
                'label' => $label,
                'status'=>$status
                //'act'=>$act
            );

            array_push($data['data'], $array);
            $i++;
            $noSeq++;
        }
        $this->output->set_output(json_encode($data));
    }
    
    function selectedSO($noSO,$status) {
        $menuId = $this->home_m->get_menu_id('transaksi/distribusi/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['info_so'] = $this->distribusi_m->getDescSO($noSO);
        $data['jml_rincian_so'] = $this->distribusi_m->getJmlRincianSO($noSO);
        $data['rincian_so'] = $this->distribusi_m->getRincianSO($noSO);
        $data['jnsmobil'] = $this->distribusi_m->getJnsMobil();
        $data['jnssegel'] = $this->distribusi_m->getJnsSegel();
        $data['status'] = $status;
        $data['noSO'] = $noSO;

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
            $this->template->load('template/template_dataTable', 'transaksi/distribusi_v', $data);
        }
    }
    
    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->distribusi_m->getDescProduk($idProduk);
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
        
        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");   
        
        $driverMaster = "";
        $noMobilMaster = "";
        $space ="";
        $totJurnal = trim($this->input->post('txtTempLoop'));
        if ($totJurnal > 0) {
            for ($i = 1; $i <= $totJurnal; $i++) {
                $tDriver = 'tempDriver' . $i;
                $tmpDriver = trim($this->input->post($tDriver));

                if ($tmpDriver <> '') {
                    $tNoMobil = 'tempNoMobil' . $i;
                    $tJnsMobil = 'tempJnsMobil' . $i;
                    $tJnsSegel = 'tempJnsSegel' . $i;
                    $tJnsMobilSw = 'tempJnsMobilSw' . $i;
                    $tKet = 'tempKet' . $i;

                    $tmpNoMobil = trim($this->input->post($tNoMobil));
                    $tmpJnsMobil = trim($this->input->post($tJnsMobil));
                    $tmpJnsSegel = trim($this->input->post($tJnsSegel));
                    $tmpJnsMobilSw = trim($this->input->post($tJnsMobilSw));
                    $tmpKet = trim($this->input->post($tKet));
                    
                    $idTransOutDist  =   $idMaster."-".$i;  
                    
                    $dataTrans = array(
                        'id_trans_out_dist' => $idTransOutDist,
                        'id_master_out' => $idMaster,
                        'tgl_trans' => $tglTrans,
                        'tgl_input' => $this->session->userdata('tgl_y'),
                        'id_jnsmobil' => $tmpJnsMobil,
                        'id_jnsmobilsewa' => $tmpJnsMobilSw,
                        'id_jnssegel' => $tmpJnsSegel,
                        'nama_pengirim' => $tmpDriver,
                        'no_mobil' => $tmpNoMobil,
                        'keterangan' => $tmpKet,
                        'userid' => $this->session->userdata('id_user')
                    );

                    $query = $this->distribusi_m->insertTransOutDistribusi($dataTrans);
                    if($i>1){
                        $space = ", ";
                    }
                    $driverMaster = $driverMaster.$space.$tmpDriver;
                    $noMobilMaster = $noMobilMaster.$space.$tmpNoMobil;
                }
            }
        }
        $dataMaster = array(
            'tgl_trans_distribusi' => $tglTrans,
            'tgl_input_distribusi' => $this->session->userdata('tgl_y'),
            'userid_distribusi' => $this->session->userdata('id_user'),
            'status_distribusi' => 1,
            'nama_pengirim'=>$driverMaster,
            'no_mobil'=>$noMobilMaster
        );
        $model = $this->distribusi_m->updateMasterOut($dataMaster,$idMaster);

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
    function ubah() {
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));
        
        $idMaster = trim($this->input->post('idMaster'));
        
        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");   
        
        $model = $this->distribusi_m->deleteDataDistribusi($idMaster);
        $driverMaster = "";
        $noMobilMaster = "";
        $space ="";
        $totJurnal = trim($this->input->post('txtTempLoop'));
        if ($totJurnal > 0) {
            for ($i = 0; $i <= $totJurnal; $i++) {
                $tDriver = 'tempDriver' . $i;
                $tmpDriver = trim($this->input->post($tDriver));

                if ($tmpDriver <> '') {
                    $tNoMobil = 'tempNoMobil' . $i;
                    $tJnsMobil = 'tempJnsMobil' . $i;
                    $tJnsSegel = 'tempJnsSegel' . $i;
                    $tJnsMobilSw = 'tempJnsMobilSw' . $i;
                    $tKet = 'tempKet' . $i;

                    $tmpNoMobil = trim($this->input->post($tNoMobil));
                    $tmpJnsMobil = trim($this->input->post($tJnsMobil));
                    $tmpJnsSegel = trim($this->input->post($tJnsSegel));
                    $tmpJnsMobilSw = trim($this->input->post($tJnsMobilSw));
                    $tmpKet = trim($this->input->post($tKet));
                    
                    $idTransOutDist  =   $idMaster."-".$i;  
                    
                    $dataTrans = array(
                        'id_trans_out_dist' => $idTransOutDist,
                        'id_master_out' => $idMaster,
                        'tgl_trans' => $tglTrans,
                        'tgl_input' => $this->session->userdata('tgl_y'),
                        'id_jnsmobil' => $tmpJnsMobil,
                        'id_jnsmobilsewa' => $tmpJnsMobilSw,
                        'id_jnssegel' => $tmpJnsSegel,
                        'nama_pengirim' => $tmpDriver,
                        'no_mobil' => $tmpNoMobil,
                        'keterangan' => $tmpKet,
                        'userid' => $this->session->userdata('id_user')
                    );

                    $query = $this->distribusi_m->insertTransOutDistribusi($dataTrans);
                    if($i>0){
                        $space = ", ";
                    }
                    $driverMaster = $driverMaster.$space.$tmpDriver;
                    $noMobilMaster = $noMobilMaster.$space.$tmpNoMobil;
                }
            }
        }
        $dataMaster = array(
            'tgl_trans_distribusi' => $tglTrans,
            'tgl_input_distribusi' => $this->session->userdata('tgl_y'),
            'userid_distribusi' => $this->session->userdata('id_user'),
            'nama_pengirim'=>$driverMaster,
            'no_mobil'=>$noMobilMaster
        );
        $model = $this->distribusi_m->updateMasterOut($dataMaster,$idMaster);

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


}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */