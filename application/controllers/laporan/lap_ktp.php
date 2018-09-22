<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_ktp extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('global_m');
        $this->load->model('transaksi/trans_bantuan_m');
        $this->load->library('pdf1');
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
        $menuId = $this->home_m->get_menu_id('laporan/lap_ktp/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        $data['ktp'] = $this->global_m->getSelectOption('master_ktp','is_delete','0','','','id_ktp');

        // $data['suplier'] = $this->kedatangan_m->getSuplier();
        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'laporan/lap_ktp_v', $data);
        }
    }

    function cetak($id_ktp) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            $data['data_ktp'] = $this->global_m->get_data("select * from vw_t_kk where id_ktp=".$id_ktp)[0];
            $data['komunitas'] = $this->global_m->get_data("select * from vw_komunitas where id_ktp=".$id_ktp);
            $data['bantuan'] = $this->global_m->get_data("select * from vw_t_bantuan where id_ktp=".$id_ktp);

            $this->load->view('laporan/cetak_ktp_pdf_v.php',$data);
        }
    }

    public function getKTP() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->trans_bantuan_m->getKtpAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            if($row->jekel=='0'){
                $ijekel="Pria";
            }else{
                $ijekel="Wanita";                
            }
            $array = array(
                // 'select' => "<button id='".trim($row->id_ktp)."' name='".trim($row->nama_ktp)."' onclick='select(this)' class='btn primary btn-sm'><i class='fa fa-print'></i> Cetak</button>",
                'select' => "<button onclick='cetak(".trim($row->id_ktp).")' class='btn primary btn-sm'><i class='fa fa-print'></i> Cetak</button>",
                'id_ktp' => trim($row->id_ktp),
                'nama_ktp' => trim($row->nama_ktp),
                'jekel' => $ijekel,
                'tanggal_lahir' => trim($row->tanggal_lahir),
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }




}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */