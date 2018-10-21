<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_kematian extends CI_Controller {

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
        $menuId = $this->home_m->get_menu_id('master/master_kematian/home');
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
            $this->template->load('template/template_dataTable', 'master/master_kematian_v', $data);
        }
    }

    function ajax_wafat() {
        $id_ktp=$this->input->post('sKtp');
        $return = $this->global_m->query("UPDATE `master_ktp` SET `is_delete`='1' WHERE id_ktp=".$id_ktp);
        if ($return) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Nik :'.$id_ktp.' telah meninggal.!'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Gagal'
            );
        }
        $this->output->set_output(json_encode($array));
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
                'select' => ($row->is_delete==0)?"<button onclick='wafat(".trim($row->id_ktp).")' class='btn primary btn-sm'><i class='glyphicon glyphicon-remove'></i> Wafat</button>":"Wafat",
                'id_ktp' => trim($row->id_ktp),
                'nama_ktp' => trim($row->nama_ktp),
                'jekel' => $ijekel,
                'tanggal_lahir' => trim($row->tanggal_lahir),
                /*,
                'alamatBantuan' => trim($row->alamat),
                'telpBantuan' => trim($row->telp)*/
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }




}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */