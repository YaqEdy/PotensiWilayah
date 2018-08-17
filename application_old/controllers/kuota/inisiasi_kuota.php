<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inisiasi_kuota extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('kuota/inisiasi_kuota_m');
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
        $menuId = $this->home_m->get_menu_id('kuota/inisiasi_kuota/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        //$data['proyek'] = $this->inisiasi_kuota_m->getProyek();
        //$data['dept'] = $this->master_advance_m->get_dept();

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
            $this->template->load('template/template_dataTable', 'kuota/inisiasi_kuota_v', $data);
        }
    }

    function simpan() {
        $tahun = trim($this->input->post('tahun'));
        $cek_tahun = $this->inisiasi_kuota_m->cekTahun($tahun);
        if ($cek_tahun == 0) {
            $get_customer = $this->inisiasi_kuota_m->getAllCustomer();
            foreach ($get_customer as $idcust) {
                $id_cust = $idcust->id_cust;
                $data = array(
                    'tahun' => $tahun,
                    'id_cust' => $id_cust,
                    'kuota' => 0,
                    'terpakai' => 0,
                    'saldo_akhir' => 0
                );
                $model = $this->inisiasi_kuota_m->inisiasiKuota($data);
            }
            if ($model) {
                $array = array(
                    'act' => 1,
                    'tipePesan' => 'success',
                    'pesan' => 'Data berhasil disimpan.'
                );
            }
            $this->output->set_output(json_encode($array));
        } else {
            $array = array(
                'act' => 1,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal disimpan.<br>Tahun sudah pernah diinisialisasi.'
            );
            $this->output->set_output(json_encode($array));
        }
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */