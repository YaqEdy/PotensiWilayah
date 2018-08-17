<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class koreksi_jurnal extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('akuntansi/koreksi_jurnal_m');
        $this->load->model('setting_laporan_m');
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
        $menuId = $this->home_m->get_menu_id('akuntansi/koreksi_jurnal/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
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
            $this->template->load('template/template_dataTable', 'akuntansi/koreksi_jurnal_v', $data);
        }
    }

//    function getJurnalAll() {
//        $this->CI = & get_instance(); 
//        $rows = $this->akuntansi_m->getJurnalAll();
//        $data['data'] = array();
//        foreach ($rows as $row) {
//            $jmlUang = number_format($row->jml_uang, 2);
//            $array = array(
//                'trans_id' => trim($row->trans_id),
//                'kode_jurnal' => trim($row->kode_jurnal),
//                'master_id' => trim($row->master_id),
//                'nama_kyw' => trim($row->nama_kyw),
//                'keterangan' => trim($row->keterangan),
//                'jml_uang' => $jmlUang
//            );
//            array_push($data['data'], $array);
//        }
//        $this->output->set_output(json_encode($data));
//    }
    function getDescJU() {
        $this->CI = & get_instance();
        $idPerk = $this->input->post('idPerk', TRUE);
        $crows = $this->koreksi_jurnal_m->getCDescJU($idPerk);
        if ($crows <= 0) {
            $array = array('baris' => 0);
            $rows['data_ju'] = $array;
            $this->output->set_output(json_encode($rows));
        } else {
            $rows = $this->koreksi_jurnal_m->getDescJU($idPerk);
            $this->output->set_output(json_encode($rows));
        }
    }

    function getJurnalUnpostAll() {
        $tanggal = trim($this->input->post('tanggal', TRUE));
        $this->CI = & get_instance();
        if ($tanggal == '') {
            $tanggal = $this->session->userdata('tgl_y');
        } else {
            $tanggal = date('Y-m-d', strtotime($tanggal));
        }
        $rows = $this->koreksi_jurnal_m->getJurnalUnpost($tanggal);
        $data['data'] = array();
        foreach ($rows as $row) {
            $jmlUang = number_format($row->saldo_akhir, 2);
            $array = array(
                'aksi' => '<a href="#"
                    name="btnCari" class="btn yellow" id="id_btnPrint" onclick="cetak(' . "'" . $row->trans_id . "'" . ')"><i class="fa fa-print"></i></a><a href="#"
                    name="btnCari" class="btn green " id="id_btnCari" onclick="getDescJU(' . "'" . $row->trans_id . "'" . ')"> Detail</a>',
                'trans_id' => trim($row->trans_id),
                'tgl_trans' => trim($row->tgl_trans),
                'kode_jurnal' => trim($row->kode_jurnal),
                'deskripsi' => trim($row->deskripsi),
                'saldo_akhir' => $jmlUang
            );
            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function simpan() {
        $idJurnal = trim($this->input->post('idJurnal'));
        $transid = trim($this->input->post('trans_id'));
        $kodeJurnal = trim($this->input->post('kodeJurnal'));
        $deskripsi = trim($this->input->post('Deskripsi'));
        $noreferensi = trim($this->input->post('NoReferensi'));
        $totalDb = str_replace(',', '', trim($this->input->post('totalDb')));
        $totalKr = str_replace(',', '', trim($this->input->post('totalKr')));
        $data_model2 = array(
            'status_akuntansi' => 1
        );
        if ($totalDb === $totalKr) {
            if ($transid == '') {
                $tglTrans = $this->session->userdata('tgl_y');
                $modelidAP = $this->koreksi_jurnal_m->getIdAP($bulan, $tahun);
            } else {
                $tglTrans = trim($this->input->post('tanggal_trans'));
                $model = $this->koreksi_jurnal_m->deleteJUunpost($transid);
                $modelidAP = $transid;
            }

            $date = date('d', strtotime($tglTrans));
            $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
            $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");
            $totJurnal = trim($this->input->post('txtTempLoop'));
            if ($totJurnal > 0) {
                for ($i = 1; $i <= $totJurnal; $i++) {
                    $tKodePerk = 'tempKodePerk' . $i;
                    $tDb = 'tempDb' . $i;
                    $tKr = 'tempKr' . $i;
                    $tKet = 'tempKet' . $i;

                    $modelidAPtrans = $this->koreksi_jurnal_m->getIdAPtrans($tglTrans, $bulan, $tahun, $date);
                    $tmpKodePerk = trim($this->input->post($tKodePerk));
                    $tmpDb = str_replace(',', '', trim($this->input->post($tDb)));
                    $tmpKr = str_replace(',', '', trim($this->input->post($tKr)));
                    $tmpKet = trim($this->input->post($tKet));

                    $data_perk = array(
                        'id_trans' => $modelidAPtrans,
                        'tgl_trans' => $tglTrans,
                        'trans_id' => $modelidAP,
                        'kode_jurnal' => 1,
                        'modul' => 1,
                        'kode_perk' => $tmpKodePerk,
                        'debet' => $tmpDb,
                        'kredit' => $tmpKr,
                        'post' => 1,
                        'saldo_akhir' => $totalDb,
                        'deskripsi' => $deskripsi,
                        'keterangan' => $tmpKet,
                        'NoReferensi' => $noreferensi
                    );
                    $model = $this->koreksi_jurnal_m->insertTDPerk($data_perk);
                }
            }
            if ($model) {
                $array = array(
                    'act' => 1,
                    'idAP' => $modelidAP,
                    'kodeJurnal' => $kodeJurnal,
                    'tipePesan' => 'success',
                    'pesan' => 'Data berhasil disimpan.'
                );
            } else {
                $array = array(
                    'act' => 0,
                    'hasil' => 'DKTS',
                    'tipePesan' => 'error',
                    'pesan' => 'Data gagal disimpan.'
                );
            }
            $this->output->set_output(json_encode($array));
        } else {
            $array = array(
                'act' => 0,
                'hasil' => 'DKTS',
                'tipePesan' => 'error',
                'pesan' => 'Data gagal disimpan. Debit dan Kredit harus Sama'
            );
            $this->output->set_output(json_encode($array));
        }
    }

    function cetak($idPerk) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            $info = $this->setting_laporan_m->getAllSetting();
            foreach ($info as $i) {
                $nama = $i->pt;
                $kantor = $i->kantor;
                $alamat = $i->alamat;
            }
            $info2 = $this->koreksi_jurnal_m->getJurnal($idPerk);
            foreach ($info2 as $g) {
                $noreferensi = $g->NoReferensi;
                $tgltrans = $g->tgl_trans;
            }
            $info3 = $this->koreksi_jurnal_m->getTotal($idPerk);
            foreach ($info3 as $h) {
                $debet = $h->debet;
                $kredit = $h->kredit;
            }
            $info4 = $this->koreksi_jurnal_m->getDescription($idPerk);
            foreach ($info4 as $t) {
                $deskripsi = $t->deskripsi;
            }
            $data['nama'] = trim($nama);
            $data['tower'] = trim($kantor);
            $data['alamat'] = trim($alamat);
            $data['noreferensi'] = trim($noreferensi);
            $data['tgltrans'] = trim($tgltrans);
            $data['all'] = $this->koreksi_jurnal_m->getJurnalAllP($idPerk);
            $data['debet'] = trim($debet);
            $data['kredit'] = trim($kredit);
            $data['deskripsi'] = trim($deskripsi);
            //$data['detail'] = $this->akuntansi_m->getDetailAp($idJurnal);
            $this->load->view('cetak/cetak_jurnal', $data);
        }
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */