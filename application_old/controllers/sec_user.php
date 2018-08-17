<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sec_user extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('admin/konfigurasi_menu_status_user_m');
        $this->load->model('sec_user_m');
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
        $menuId = $this->home_m->get_menu_id('sec_user/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['status_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->sec_user_m->get_level_user();
        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } elseif (isset($_POST["btnUbah"])) {
            $this->ubah();
        } elseif (isset($_POST["btnHapus"])) {
            $this->hapus();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['karyawan'] = $this->sec_user_m->getAllKaryawan();

            $this->template->set('title', 'Konfigurasi User');
            $this->template->load('template/template_dataTable', 'admin/sec_user_v', $data);
        }
    }

    public function getUserInfo() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->sec_user_m->getUserInfo();
        $data['data'] = array();
        foreach ($rows as $row) {
            $passwd = base64_decode($row->password);
            $array = array(
                'userid' => trim($row->userid),
                'username' => trim($row->username),
                'nama_kyw' => trim($row->nama_kyw),
                'passwd' => $passwd,
                'usergroup' => trim($row->usergroup),
                'id_kyw' => trim($row->id_kyw)
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function simpan() {
        $userName = trim($this->input->post('userName'));
        $idKyw = trim($this->input->post('karyawan'));
        $userFullName = $this->sec_user_m->getNamaKaryawan($idKyw);
        $password = base64_encode(trim($this->input->post('kataKunci')));
        $groupUser = trim($this->input->post('userGroup'));

        $data = array(
            'userid' => '0',
            'id_kyw' => $idKyw,
            'username' => $userName,
//            'userfullname'		        =>$userFullName,
            'password' => $password,
            'status_password' => 0,
            'tgl_password' => '1970-01-01',
            'usergroup' => $groupUser
        );
        $model = $this->sec_user_m->insertUser($data);
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

    function ubah() {
        $userId = trim($this->input->post('userId'));
        $userName = trim($this->input->post('userName'));
        $idKyw = trim($this->input->post('karyawan'));
        $userFullName = $this->sec_user_m->getNamaKaryawan($idKyw);
        $password = base64_encode(trim($this->input->post('kataKunci')));
        $groupUser = trim($this->input->post('userGroup'));

        $data = array(
            'id_kyw' => $idKyw,
            'username' => $userName,
//            'userfullname'		        =>$userFullName,
            'password' => $password,
            'status_password' => 0,
            'tgl_password' => '1970-01-01',
            'usergroup' => $groupUser
        );

        $model = $this->sec_user_m->updateUser($data, $userId);
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

    function hapus() {
        $this->CI = & get_instance();
        $userId = $this->input->post('userId', TRUE);
        $model = $this->sec_user_m->deleteUser($userId);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil dihapus.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal dihapus.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */