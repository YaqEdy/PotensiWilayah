<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Labnobatch extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('global_m');
        $this->load->model('transaksi/labnobatch_m');
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
        $menuId = $this->home_m->get_menu_id('transaksi/labnobatch/home');
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
            $this->template->load('template/template_dataTable', 'transaksi/list_so_batch_v', $data);
        }
    }
    
    public function getRencanaOutAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $tglAwal = $this->input->post('tglAwalDaftar', TRUE);
        $tglAwal = date("Y-m-d",strtotime($tglAwal));
        $tglAkhir = $this->input->post('tglAkhirDaftar', TRUE);
        $tglAkhir = date("Y-m-d",strtotime($tglAkhir));
        
        $rows = $this->labnobatch_m->getRencanaOutAll($tglAwal,$tglAkhir);
        $data['data'] = array();
        $i = 0;
        $noSeq = 1;
        foreach ($rows as $row) {
            $tglKirim = trim($row->etd);
            $tglKirim = date('d-m-Y', strtotime($tglKirim));
            
            $act = "<a href='#' class='btn yellow btn-sm' onclick='editBaris(".$i.")' ><i class='fa fa-edit fa-fw'/></i></a>";
            
            $array = array(
                'noSeq' => $noSeq,
                'idMaster' => trim($row->id_master_out),
                'no_sj' => trim($row->no_sj),
                'nama_produk' => trim($row->nama_produk),
                'namaCust' => trim($row->nama_cust),
                'no_jnsdoc' => trim($row->no_jnsdoc),
                'nama_jnsdoc'  => trim($row->nama_jnsdoc),
                'no_batch' => trim($row->no_batch),
                'input_no_batch' => "<input type='text' class ='form-control input-sm' value='".trim($row->no_batch)."' name='tempNoBatch".$i."' id='id_tempNoBatch".$i."' />",//trim($row->no_batch),
                'tglKirim' => $tglKirim,
                'no_aju' => trim($row->no_aju),
                'no_cukai' => trim($row->no_cukai),
                'totalQty' => trim(number_format($row->total_qty,2)),
                'keterangan_so'=>trim($row->keterangan_so),
                'act'=>$act
            );

            array_push($data['data'], $array);
            $i++;
            $noSeq++;
        }
        $this->output->set_output(json_encode($data));
    }
    
    function selectedSO($noSO) {
        $menuId = $this->home_m->get_menu_id('transaksi/labnobatch/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['info_so'] = $this->labnobatch_m->getDescSO($noSO);
        $data['jml_rincian_so'] = $this->labnobatch_m->getJmlRincianSO($noSO);
        $data['rincian_so'] = $this->labnobatch_m->getRincianSO($noSO);
        $data['produk'] = $this->labnobatch_m->getProduk();
        $data['storage'] = $this->labnobatch_m->getStorage();

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
            $this->template->load('template/template_dataTable', 'transaksi/labnobatch_v', $data);
        }
    }
    
    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->labnobatch_m->getDescProduk($idProduk);
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
    function ubah() {
        $this->CI = & get_instance();
        $noSO = trim($this->input->post('noSO', TRUE));
        $noBatch = trim($this->input->post('noBatch', TRUE));
        $dataMaster = array(
            'tgl_trans_batch' => $this->session->userdata('tgl_y'),
            'tgl_input_batch' => $this->session->userdata('tgl_y'),
            'no_batch' =>$noBatch,
            'userid_batch' => $this->session->userdata('id_user')
        );
        $model = $this->labnobatch_m->updateMasterOut($dataMaster,$noSO);

        if ($model) {

            $array = array(
                'baris' => 1,
                'no_batch' => $noBatch,
                'tipePesan' => 'success',
                'pesan' => 'Data no batch ' . $noBatch . ' berhasil diubah.'
            );
        } else {
            $array = array(
                'baris' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data no batch ' . $noBatch . ' gagal diubah.'
            );
        }

        $this->output->set_output(json_encode($array));
    }
    function simpan() {
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));
        
        $idMaster = trim($this->input->post('idMaster'));
        $noBatch = trim($this->input->post('noBatch'));
   
        $dataMaster = array(
            'tgl_trans_batch' => $tglTrans,
            'tgl_input_batch' => $this->session->userdata('tgl_y'),
            'no_batch' =>$noBatch,
            'userid_batch' => $this->session->userdata('id_user')
        );
        $model = $this->labnobatch_m->updateMasterOut($dataMaster,$idMaster);

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