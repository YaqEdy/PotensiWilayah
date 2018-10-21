<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Konfigurasi_menu_status_user extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('konfigurasi_menu_status_user_m');
        session_start();
    }

    public function index() {
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));

            //$data ['nama'] = $this->home_m->get_nama_kantor ();
            $this->template->set('title', 'home');
            $this->template->load('template/template1', 'global/index', $data);
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('konfigurasi_menu_status_user/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['status_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
            $data['usergrup'] = $this->session->userdata('usergroup');

            $this->template->set('title', 'home');
            $this->template->load('template/template2', 'admin/konfigurasi_menu_status_user_v', $data);
        }
    }

    function get_menu_group_user() {
        $this->CI = & get_instance();
        $kd_group_user = $this->input->post('kd_group_user', TRUE);
        $rows = $this->konfigurasi_menu_status_user_m->get_menu_group_user_m($kd_group_user);

        $this->output->set_output(json_encode($rows));
    }

    function simpan() {
        $status_user = trim($this->input->post('status_user'));
        $menu_allow = trim($this->input->post('menu_allow'));
        
        $data_menu = array();
        $data_menu = explode(',', $menu_allow);
        ///print_r($data_menu);
        //die($menu_allow);
        $this->konfigurasi_menu_status_user_m->update_menu_status_user_m($data_menu, $status_user);

        $this->session->set_flashdata('success', 'Simpan user berhasil');
        redirect('konfigurasi_menu_status_user/home');

        /* $this->session->set_flashdata('error','User tidak dapat disimpan');
          redirect('akses_user/aksesuser'); */
    }
    function update_level(){
        $this->konfigurasi_menu_status_user_m->update_level();
    }

}

/* End of file akses_user.php */
/* Location: ./application/controllers/akses_user.php */