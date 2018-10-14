
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_perkiraan extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('master/master_perkiraan_m');
        $this->load->model('setting_laporan_m');
        $this->load->library('fpdf');
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
        $menuId = $this->home_m->get_menu_id('master/master_perkiraan/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        //$data['dept'] = $this->master_perkiraan_m->get_dept();

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
            $this->template->load('template/template_dataTable', 'master/master_perkiraan_v', $data);
        }
    }

    public function getAllPerkiraan() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_perkiraan_m->getAllPerkiraan();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'kode_perk' => $row->kode_perk,
                'kode_alt' => $row->kode_alt,
                'nama_perk' => $row->nama_perk,
                'level' => $row->level,
                'type' => $row->type,
                'dk' => $row->dk
            );
            array_push($data['data'], $array);
        }
        //echo json_encode($data['data']);
        $this->output->set_output(json_encode($data));
    }

    public function getLastKdPerk() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $kdPerkRoot = trim($this->input->post('kodePerkRoot'));
        $lvlPerkRoot = trim($this->input->post('lvlPerkRoot'));
        $lvlPerk = $lvlPerkRoot + 1;
        /* $typePerkRoot	= trim($this->input->post('typePerkRoot')); */
        $mLastKdPerk = $this->master_perkiraan_m->getLastKdPerk($kdPerkRoot, $lvlPerk);
        /* if($mLastKdPerk){
          $kdPerk = trim($mLastKdPerk[0]->kdPerk)+1;
          }else{
          $kdPerk = $kdPerk.'01';
          } */
        $array = array(
            'kdPerk' => $mLastKdPerk
        );

        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        $kdPerkRoot = trim($this->input->post('kodePerkRoot'));
        $kdPerk = trim($this->input->post('kodePerk'));
        $kdAlt = trim($this->input->post('kodeAlt'));
        $namaPerk = trim($this->input->post('namaPerk'));
        $lvlPerk = trim($this->input->post('lvlPerk'));
        $typePerk = trim($this->input->post('typePerk'));
        $dkPerk = trim($this->input->post('dkPerk'));
        //$ket			= trim($this->input->post(''));

        $data = array(
            'kode_perk' => $kdPerk,
            'kode_alt' => $kdAlt,
            'nama_perk' => $namaPerk,
            'kode_induk' => $kdPerkRoot,
            'level' => $lvlPerk,
            'type' => $typePerk,
            'dk' => $dkPerk
//        		''		        	=>$,
        );
        $model = $this->master_perkiraan_m->insert($data);

        $data = array(
            'type' => 'G'
                //        		''		        	=>$,
        );
        $model2 = $this->master_perkiraan_m->updateTipe($data, $kdPerkRoot);
        if ($model && $model2) {
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
        $kdPerk = trim($this->input->post('kodePerk'));
        $kdAlt = trim($this->input->post('kodeAlt'));
        $namaPerk = trim($this->input->post('namaPerk'));

        $data = array(
            'kode_alt' => $kdAlt,
            'nama_perk' => $namaPerk
        );
        $model = $this->master_perkiraan_m->update($data, $kdPerk);
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
        $kdPerk = trim($this->input->post('idPerk'));
        $cekSaldoKodePerk = $this->master_perkiraan_m->cekSaldoKodePerk($kdPerk);
        if ($cekSaldoKodePerk[0]->saldo > 0) {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal dihapus.<br/> Kode Perk mempunyai saldo.'
            );
        } else {
            $cekTipeKodePerk = $this->master_perkiraan_m->cekTipeKodePerk($kdPerk);
            if ($cekTipeKodePerk[0]->type == 'G') {
                $array = array(
                    'act' => 0,
                    'tipePesan' => 'error',
                    'pesan' => 'Data gagal dihapus.<br/> Kode Perk induk tidak dapat dihapus .'
                );
            } else if ($cekTipeKodePerk[0]->type == 'D') {
                $model = $this->master_perkiraan_m->delete($kdPerk);

                if ($model) {
                    $kodePerkRoot = substr($kdPerk, 0, -2);
                    $cekJmlKodeInduk = $this->master_perkiraan_m->cekJmlKodeInduk($kodePerkRoot); // cek kode induk punya anak berapa buah
                    if ($cekJmlKodeInduk == 0) {

                        $data = array(
                            'type' => 'D'
                        );
                        $model2 = $this->master_perkiraan_m->updateTipe($data, $kodePerkRoot);
                    }
                    $array = array(
                        'act' => 1,
                        'tipePesan' => 'success',
                        'pesan' => 'Data berhasil dihapus. '//.$cekJmlKodeInduk
                    );
                } else {
                    $array = array(
                        'act' => 0,
                        'tipePesan' => 'error',
                        'pesan' => 'Data gagal dihapus.'
                    );
                }
            } else {
                $array = array(
                    'act' => 0,
                    'tipePesan' => 'error',
                    'pesan' => 'Data gagal dihapus.<br> Tipe kode perkiraan tidak ditemukan.'
                );
            }
        }
        $this->output->set_output(json_encode($array));
    }

    function updatekodeinduk() {
        $this->master_perkiraan_m->updatekodeinduk();
    }

    function cetak() {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            $info = $this->setting_laporan_m->getAllSetting();
            foreach ($info as $i) {
                $nama = $i->pt;
                $kantor = $i->kantor;
                $alamat = $i->alamat;
            }
            define('FPDF_FONTPATH', $this->config->item('fonts_path'));
            $data['image1'] = base_url('metronic/img/logo_berkah.png');
            $data['nama'] = trim($nama);
            $data['tower'] = trim($kantor);
            $data['alamat'] = trim($alamat);
            $data['laporan'] = 'Laporan Perkiraan';
            $data['user'] = $this->session->userdata('username');
            $data['all'] = $this->master_perkiraan_m->getAllPerkiraan();
            $this->load->view('cetak/cetak_perkiraan_b', $data);
        }
    }

    function page_upload_perkiraan() {
        $menuId = $this->home_m->get_menu_id('master_perkiraan/page_upload_perkiraan');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        //    $data['status_user'] = $this->konfigurasi_menu_status_user_m->get_status_user();
        //$data['level_user'] = $this->data_invoice_m->get_level_user();
        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } elseif (isset($_POST["btnUbah"])) {
            $this->ubah();
        } elseif (isset($_POST["btnHapus"])) {
            $this->hapus();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            //	$data['invoice'] = $this->data_invoice_m->getAllInvoice();

            $this->template->set('title', 'Data Invoice');
            $this->template->load('template/template3', 'admin/perkiraan/page_upload_perkiraan', $data);
        }
    }

    // function proses_upload_perkiraan() {
    //     $this->load->library('upload');
    //     $config['upload_path'] = './uploads/'; //path folder
    //     $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|xls|xlsx'; //type yang dapat diakses bisa anda sesuaikan
    //     $config['max_size'] = '5048'; //maksimum besar file 5M
    //     $config['file_name'] = $_FILES['file_excel']['name']; //nama yang terupload nantinya
    //     $this->upload->initialize($config);

    //     $maxRow = str_replace(',', '', trim($this->input->post('max_row')));
    //     $nama_file = $_FILES['file_excel']['name'];
    //     $maxRow = $maxRow;

    //     //$id = $this->master_sitemap_m->getIdSitemap();
    //     if ($_FILES['file_excel']['name']) {
    //         if ($this->upload->do_upload('file_excel')) {
    //             $gbr = $this->upload->data();

    //             $this->load->library("Excel/PHPExcel");

    //             $reader = PHPExcel_IOFactory::createReader('Excel2007');
    //             $reader->setReadDataOnly(true);
    //             $file_excelnya = $config['upload_path'] . $nama_file;
    //             $excel = $reader->load($file_excelnya);

    //             $sheet = $excel->setActiveSheetIndex(0);


    //             for ($i = 2; $i <= $maxRow; $i++):// dicetak mulai baris 3
    //                 //		$no = $sheet->getCellByColumnAndRow(0, $i)->getValue();
    //                 //	$tglTrans = PHPExcel_Shared_Date::ExcelToPHP($sheet->getCellByColumnAndRow(1, $i)->getValue()); //getCalculatedValue();
    //                 //	$id_invoice = $sheet->getCellByColumnAndRow(0, $i)->getValue();
    //                 //	$nama_invoice = $sheet->getCellByColumnAndRow(1, $i)->getValue();
    //                 $userid = $this->session->userdata('id_user');
    //                 $no_reg = $sheet->getCellByColumnAndRow(0, $i)->getValue();
    //                 $no_fas = $sheet->getCellByColumnAndRow(1, $i)->getValue();
    //                 $nama_nasabah = $sheet->getCellByColumnAndRow(2, $i)->getValue();
    //                 $alamat = $sheet->getCellByColumnAndRow(3, $i)->getValue();
    //                 $nilai_manfaat = $sheet->getCellByColumnAndRow(4, $i)->getValue();
    //                 $premi = $sheet->getCellByColumnAndRow(5, $i)->getValue();
    //                 $tipe_asuransi = $sheet->getCellByColumnAndRow(6, $i)->getValue();

    //                 if ($sheet->getCellByColumnAndRow(5, $i)->getValue() <= 25000) {
    //                     $premi_dibayar = '25000';
    //                 } else {
    //                     $premi_dibayar = $premi;
    //                 }
    //                 $tgl_mulai = $sheet->getCellByColumnAndRow(8, $i)->getValue();
    //                 $jkw = $sheet->getCellByColumnAndRow(9, $i)->getValue();
    //                 $kodeCabang = $sheet->getCellByColumnAndRow(11, $i)->getValue();
    //                 $jumlahBulan = "+" . $jkw . " month";
    //                 $tgl_akhir = date('Y-m-d', strtotime($jumlahBulan, strtotime($tgl_mulai)));
    //                 //	$ = $sheet->getCellByColumnAndRow(8, $i)->getValue();
    //                 $no_invoice = $sheet->getCellByColumnAndRow(15, $i)->getValue();
    //                 $tgl_invoice = $sheet->getCellByColumnAndRow(13, $i)->getValue();
    //                 $tgl_input = $sheet->getCellByColumnAndRow(7, $i)->getValue();
    //                 $Cabang = $this->data_cabang_m->getCabangInfoByKodeCabang($kodeCabang);
    //                 foreach ($Cabang as $row) {
    //                     $kode_group = $row->kodeGroup;
    //                     $kode_unit = $row->kodeCabang;
    //                 }


    //                 //	$tglTrans	= date('Y-m-d', trim($tglTrans));
    //                 if ($this->data_invoice_m->cekNoInvoice($no_invoice) == true) {
    //                     // Jika No Invoice sudah maka akan menambah di tabel transaksi detail saja 
    //                     //	$tglTrans 	= date('Y-m-d', strtotime($tgl_invoice));
    //                     //	$bulan = date('m', strtotime($tglTrans));//$tglTrans->format("m");
    //                     //	$tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");
    //                     //	$tglTrans 	= date('Y-m-d', strtotime($tgl_invoice));
    //                     $bulan = date('m'); //$tglTrans->format("m");
    //                     $tahun = date('Y'); //$tglTrans->format("Y");

    //                     $id_invoice = $this->data_invoice_m->getIdInvoiceBeforeByNoInvoice($no_invoice, $bulan, $tahun); // 0000 0003
    //                     $id_trans_invoice = $this->data_trans_invoice_m->getIdTransInvoice($bulan, $tahun, $id_invoice); //002
    //                     $Invoice = $this->data_invoice_m->getAllInvoiceByIdInvoice($id_invoice);

    //                     foreach ($Invoice as $row) {
    //                         $data_total_premi = $row->total_premi + $premi;
    //                         $data_total_manfaat = $row->total_manfaat + $nilai_manfaat;
    //                         $data_total_premi_dibayar = $row->total_premi_dibayar + $premi_dibayar;
    //                     }
    //                     $dataInvoice = array(
    //                         'total_premi' => trim($data_total_premi),
    //                         'total_premi_dibayar' => trim($data_total_premi_dibayar),
    //                         'total_manfaat' => trim($data_total_manfaat),
    //                     );
    //                     $this->data_invoice_m->updateInvoice($dataInvoice, $id_invoice);
    //                     echo "<br>" . $i . "Ada " . $premi . " | " . $id_invoice . " | " . $premi_dibayar;
    //                     echo '<br>';
    //                     $dataTransInvoice = array(
    //                         'id_trans_invoice' => trim($id_trans_invoice),
    //                         'id_invoice' => trim($id_invoice),
    //                         'no_invoice' => trim($no_invoice),
    //                         'no_reg' => trim($no_reg),
    //                         'no_fas' => trim($no_fas),
    //                         'nama' => trim($nama_nasabah),
    //                         'alamat' => trim($alamat),
    //                         'nilai_manfaat' => trim($nilai_manfaat),
    //                         'premi' => trim($premi),
    //                         'tipe_asuransi' => trim($tipe_asuransi),
    //                         'premi_dibayar' => trim($premi_dibayar),
    //                         'tgl_mulai' => trim($tgl_mulai),
    //                         'jkw' => trim($jkw),
    //                         'kode_group' => trim($kode_group),
    //                         'kode_unit' => trim($kode_unit),
    //                         'tgl_akhir' => trim($tgl_akhir)
    //                     );
    //                     $this->data_trans_invoice_m->insertTransInvoice($dataTransInvoice);
    //                 } else {
    //                     //$tglTrans 	= trim($this->input->post('tglTrans'));
    //                     $bulan = date('m'); //$tglTrans->format("m");
    //                     $tahun = date('Y'); //$tglTrans->format("Y");
    //                     $id_invoice = $this->data_invoice_m->getIdInvoice($bulan, $tahun);

    //                     $dataInvoice = array(
    //                         'id_invoice' => trim($id_invoice),
    //                         'no_invoice' => trim($no_invoice),
    //                         'tgl_invoice' => trim($tgl_invoice),
    //                         'kode_grup' => trim($kode_group),
    //                         'total_premi' => trim($premi),
    //                         'total_premi_dibayar' => trim($premi_dibayar),
    //                         'total_manfaat' => trim($nilai_manfaat),
    //                         'userid' => trim($userid),
    //                         'tgl_input' => trim($tgl_input)
    //                     );
    //                     $this->data_invoice_m->insertInvoice($dataInvoice);
    //                     $id_trans_invoice = $this->data_trans_invoice_m->getIdTransInvoice($bulan, $tahun, $id_invoice);
    //                     $dataTransInvoice = array(
    //                         'id_trans_invoice' => trim($id_trans_invoice),
    //                         'id_invoice' => trim($id_invoice),
    //                         'no_invoice' => trim($no_invoice),
    //                         'no_reg' => trim($no_reg),
    //                         'no_fas' => trim($no_fas),
    //                         'nama' => trim($nama_nasabah),
    //                         'alamat' => trim($alamat),
    //                         'nilai_manfaat' => trim($nilai_manfaat),
    //                         'premi' => trim($premi),
    //                         'tipe_asuransi' => trim($tipe_asuransi),
    //                         'premi_dibayar' => trim($premi_dibayar),
    //                         'tgl_mulai' => trim($tgl_mulai),
    //                         'jkw' => trim($jkw),
    //                         'kode_group' => trim($kode_group),
    //                         'kode_unit' => trim($kode_unit),
    //                         'tgl_akhir' => trim($tgl_akhir)
    //                     );
    //                     $this->data_trans_invoice_m->insertTransInvoice($dataTransInvoice);
    //                     echo "<br>" . $i . "Tidka " . $premi . " | " . $id_invoice . " | " . $premi_dibayar;
    //                     echo '<br>';
    //                 }

    //                 //$this->data_invoice_m->insertInvoice($data);
    //                 //	echo $nama_invoice;
    //             endfor;
    //             break;
    //             unlink($file_excelnya);

    //             $this->session->set_flashdata('success', 'Data pembayaran telah selesai diupload');
    //             redirect('data_invoice/home');
    //         } else {
    //             $this->session->set_flashdata('error', $this->upload->display_errors());
    //             redirect('data_invoice/home');
    //         }
    //     }
    //     //$this->output->set_output(json_encode($array));
    // }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */