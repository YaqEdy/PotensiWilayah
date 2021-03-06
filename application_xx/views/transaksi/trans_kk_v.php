<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">
    table#idTabelAdv td:nth-child(3) {
        text-align: right;
    }
</style>
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<!-- <form id="id_formKK" enctype="multipart/form-data" id="uploadpr" method="POST"> -->
<form id="id_formKK">
<div class="row">
    <div class="col-md-12">
        <div class="portlet portlet-sortable light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-pencil-square-o font-blue-chambray"></i>
                    <span class="caption-subject font-blue-chambray bold uppercase"><?php echo $menu_header; ?></span>
                </div>
                <div class="actions">
                    <a href="javascript:;" class="btn btn-default btn-sm" onclick="cetak();">
                        <i class="fa fa-print"></i> Cetak </a>
                    <a class="btn btn-icon-only btn-default btn-sm fullscreen" href="javascript:;"
                       data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <span id="event_result">
                    </span>
                </div>
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Data Kartu Keluarga </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab" onclick="formClear('id_formKK')">
                            Form Input Kartu Keluarga </a>
                    </li>

                </ul>
                <!-- <form role="form" method="post" action="<?php echo base_url('transaksi/trans_kk/home'); ?>" id="id_formAdvance"> -->
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_2_1">

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover styleDataTabel" id="idGridKK">
                                        <thead>
                                            <tr>
                                                <th>
                                                    No
                                                </th>
                                                <th>
                                                    Ses
                                                </th>
                                                <th>
                                                    No KK
                                                </th>
                                                <th>
                                                    NIK KK
                                                </th>
                                                <th>
                                                    Nama KK
                                                </th>
                                                <th>
                                                    Kecamatan
                                                </th>
                                                <th>
                                                    Kelurahan
                                                </th>
                                                <th>
                                                    RW
                                                </th>
                                                <th>
                                                    RT
                                                </th>
                                                <th>
                                                    Jml Anggota Keluarga
                                                </th>
                                                <th>
                                                    kemiskinan
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="tab_2_2">

                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h2>Data keluarga</h2>
                                            <!-- <input id="idtrans_kk" class="form-control" type="hidden" name="idtrans_kk" value=""/> -->

                                        </div>
                                        <div class="form-group">
                                            <label>No KK</label>
                                            <input id="id_noKK" required="required" class="form-control input-sm"
                                                   type="text" name="noKK" />
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea rows="2" cols="" name="alamat_" id="id_alamat_"
                                                      class="form-control input-sm" placeholder="Alamat"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>RT</label>
                                                    <input id="id_rt_"  class="form-control input-sm"
                                                           type="text" name="rt_"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>RW</label>
                                                    <input id="id_rw_"  class="form-control input-sm"
                                                           type="text" name="rw_"/>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Kecamatan</label>
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($kec as $row) :
                                                        $data[$row['id_kec']] = $row['nama_kec'];
                                                    endforeach;
                                                    echo form_dropdown('kec_', $data, '', 'required id="id_kec_" class="form-control input-sm select2me "');
                                                    ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Kelurahan</label>
                                                    <select name="kel_" id="id_kel_" class="form-control input-sm select2me "></select>
                                                </div>

                                            </div>
                                        </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Banjar</label>
                                                <select name="banjar" id="id_banjar" class="form-control input-sm select2me "></select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Kemiskinan</label>
                                                <?php
                                                $data = array();
                                                $data[''] = '';
                                                foreach ($kemiskinan as $row) :
                                                    $data[$row['id_kemiskinan']] = $row['nama_kemiskinan'];
                                                endforeach;
                                                echo form_dropdown('kemiskinan', $data, '', ' id="id_kemiskinan" class="form-control input-sm select2me "');
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    </div>


                                    <!--end <div class="col-md-6"> 1 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <h4>&nbsp;</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <br>
                                                <div class="form-group">
                                                    <!-- <label>Foto Rumah</label> -->
                                                    <a href="#" class="btn btn-primary" onclick="onFotoRmh()">Foto Rumah</a>
                                                    <!-- <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 225px; height: 170px;">
                                                            <img src="<?= site_url('metronic/img/no-image.png'); ?>" id="gambar_foto_rumah" alt="" />    

                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail hidden" style="max-width: 250px; max-height: 200px;"> </div>
                                                            <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> Pilih /</span>
                                                                    <span class="fileinput-exists"> Ubah Foto Rumah </span>
                                                                    <input type="file" id="foto_rumah" name="foto_rumah" > </span>
                                                                 <input type="hidden" name="unlinkimg" value="">
                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Hapus Foto Rumah</a> -->
                                                            <!-- </div> -->
                                                    <!-- </div> --> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <!-- <br><br>
                                            <h4>&nbsp;</h4> -->
                                        </div>
                                    </div>

                                </div>
                                        
                                <!-- HIDDEN INPUT -->
                                <input type="text" id="idTmpAksiBtn" class="hidden">
                                <!-- END HIDDEN INPUT -->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <input type="text" id="idTxtTempLoop" name="txtTempLoop" class="form-control nomor1 hidden">
                                        <a href="#" class="btn green-haze btn-sm" data-target="#idDivInputProduk"
                                           id="id_btnModalTambah" data-toggle="modal">
                                            <i class="fa fa-plus fa-fw"/></i>&nbsp;Tambah Anggota Keluarga
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <div class="form-body table-responsive">
                                        <table class="table table-striped table-hover table-bordered" id="id_tabelAnggotaKel" name="tabelAnggotaKel"> -->
                                        <br>
                                        <table class="table table-striped table-bordered table-hover text_kanan" id="idGridAnggotaKel">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        No
                                                    </th>
                                                    <th>
                                                        NIK
                                                    </th>
                                                    <th>
                                                        Nama
                                                    </th>
                                                    <th>
                                                        Tempat Lahir
                                                    </th>
                                                    <th>
                                                        Tgl Lahir
                                                    </th>
                                                    <th>
                                                        Jenis Kelamin
                                                    </th>
                                                    <th>
                                                        Gol Darah
                                                    </th>
                                                    <th>
                                                        Agama
                                                    </th>
                                                    <th>
                                                        Status Kawin
                                                    </th>
                                                    <th>
                                                        Pekerjaan
                                                    </th>
                                                    <th>
                                                        Difabel
                                                    </th>
                                                    <th>
                                                        Pendidikan
                                                    </th>
                                                    <th>
                                                        Hubungan Keluarga
                                                    </th>
                                                    <th>
                                                        Act
                                                    </th>
                                                    <!-- <th>
                                                        Kemiskinan
                                                    </th> -->

                                                    <th></th>

                                                </tr>

                                            </thead>
                                            <tbody id="id_body_data">

                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>
                                    <!-- </div> -->
                                </div>
                            </div>

                            <!--  END  MODAL Data CPA -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-actions ">
                                        <button type="button" name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                            <!--<i class="fa fa-check"></i>--> Simpan
                                        </button>
                                        <button type="button" name="btnSimpan" class="btn blue" id="id_btnUbah">
                                            <!--<i class="fa fa-check"></i>--> Update
                                        </button>
                                        <button type="button" name="btnCetak" class="btn yellow" id="id_btnCetakStruk">Cetak
                                        </button>
                                        <button id="id_btnBatal" type="button" class="btn default">Clear</button>
                                    </div>
                                </div>
                            </div>

                        </div>    
                        <!--<div class="tab-pane fade" id="tab_2_3">-->
                <!-- </form> -->
            </div>
        </div>
        <!-- end <div class="portlet green-meadow box"> -->
    </div>
</div>
<!-- END PAGE CONTENT-->

<!--  MODAL Input Data Cucian Masuk -->
<div class="modal fade draggable-modal" id="idDivInputProduk"  role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data Anggota Keluarga</h4>
            </div>
            <div class="modal-body">
                <!-- <div class="scroller" style="height:450px; "> -->
                <!-- <form id="fmKtp"> -->
                    <!-- <ul class="nav nav-pills">
                        <li class="linav active" id="linav3_1">
                            <a href="#tab_3_1" data-toggle="tab" id="navitab_3_1" class="anavitab">
                                Data Keluarga </a>
                        </li>
                        <li class="linav" id="linav3_2">
                            <a href="#tab_3_2" data-toggle="tab" id="navitab_3_2" class="anavitab" >
                                Pendidikan Formal </a>
                        </li>
                        <li class="linav" id="linav3_3">
                            <a href="#tab_3_3" data-toggle="tab" id="navitab_3_3" class="anavitab" >
                                Pendidikan Non Formal </a>
                        </li>
                    </ul> -->

                    <!-- <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_3_1"> -->
                        <div id="divktp" hidden>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input id="id_nik"  class="form-control input-sm"
                                            type="text" name="nik"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input id="id_nama"  class="form-control input-sm"
                                            type="text" name="nama"/>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Tempat lahir</label>
                                                <input id="id_tmpt_lahir"  class="form-control input-sm"
                                                    type="text" name="tmpt_lahir"/>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Tanggal Lahir</label>
                                                <input id="id_tgl_lahir"  class="form-control input-sm date-picker" data-date-format="dd-mm-yyyy"
                                                    type="text" name="tgl_lahir"/>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Jenis kelamin</label>
                                                <select name="jekel" id="id_jekel" class="select2me">
                                                    <option value="">--Pilih--</option>
                                                    <option value="0">Pria</option>
                                                    <option value="1">Wanita</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Golongan darah</label>
                                                <select name="gol_darah" id="id_gol_darah" class="select2me">
                                                    <option value="">--Pilih--</option>
                                                    <option value="O">O</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="AB">AB</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Agama</label>
                                                <?php
                                                $data = array();
                                                $data[''] = '';
                                                foreach ($agama as $row) :
                                                    $data[$row['id_agama']] = $row['nama_agama'];
                                                endforeach;
                                                echo form_dropdown('agama', $data, '', ' id="id_agama" class="form-control input-sm select2me "');
                                                ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Status Kawin</label>
                                                <select name="status" id="id_status" class="select2me">
                                                    <option value="">--Pilih--</option>
                                                    <option value="0">Tdk/Blm Kawin</option>
                                                    <option value="1">Kawin</option>
                                                    <option value="2">Duda</option>
                                                    <option value="3">Janda</option>

                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Pekerjaan</label>
                                                <?php
                                                $data = array();
                                                $data[''] = '';
                                                foreach ($pekerjaan as $row) :
                                                    $data[$row['id_pekerjaan']] = $row['nama_pekerjaan'];
                                                endforeach;
                                                echo form_dropdown('pekerjaan', $data, '', ' id="id_pekerjaan" class="form-control input-sm select2me "');
                                                ?>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <div class="form-group"> -->
                                                <label>Difabel</label>
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($difabel as $row) :
                                                        $data[$row['id_difabel']] = $row['nama_difabel'];
                                                    endforeach;
                                                    echo form_dropdown('difabel', $data, '', ' id="id_difabel" class="form-control input-sm select2me"');
                                                    ?>
                                                </select>
                                                <!-- </div> -->
                                            <!-- <label>Warga Negara</label>
                                                <select name="warga_negara" id="id_warga_negara" class="select2me">
                                                    <option value="">--Pilih--</option>
                                                    <option value="0">WNI</option>
                                                    <option value="1">WNA</option>
                                                </select> -->
                                            </div>

                                        </div>                                
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <label>Pendidikan</label>
                                                <?php
                                                $data = array();
                                                $data[''] = '';
                                                foreach ($pendidikan as $row) :
                                                    $data[$row['id_pend']] = $row['nama_pend'];
                                                endforeach;
                                                echo form_dropdown('pendidikan', $data, '', ' id="id_pendidikan" class="form-control input-sm select2me"');
                                                ?>
                                            </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Hubungan Keluarga</label>
                                                <?php
                                                $data = array();
                                                $data[''] = '';
                                                foreach ($hub_kel as $row) :
                                                    $data[$row['id_hub_kel']] = $row['nama_hub_kel'];
                                                endforeach;
                                                echo form_dropdown('hub_kel', $data, '', ' id="id_hub_kel" class="form-control input-sm select2me "');
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 150px; height: 170px;">
                                                <div id="imgKTP"></div>
                                                <img src="<?= site_url('metronic/img/no-image.png'); ?>" id="gambar_foto_ktp" alt="" />    
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail hidden" style="max-width: 250px; max-height: 200px;"> </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new"> Pilih /</span>
                                                        <span class="fileinput-exists"> Ubah Foto </span>
                                                            <div id="fileFoto"></div>
                                                            <input type="file" id="foto_ktp" name="foto_ktp" > 
                                                    </span>
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Kemiskinan</label>
                                        <?php
                                        $data = array();
                                        $data[''] = '';
                                        foreach ($kemiskinan as $row) :
                                            $data[$row['id_kemiskinan']] = $row['nama_kemiskinan'];
                                        endforeach;
                                        echo form_dropdown('kemiskinan', $data, '', ' id="id_kemiskinan" class="form-control input-sm select2me "');
                                        ?>
                                    </div>
                                </div> -->

                            </div>
                        </div>

                        <div id="divftRumah" hidden>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Upload Foto Rumah</label>
                                        <input id="id_foto_rmh"  class=""
                                                type="file" name="foto_rmh"  multiple="multiple"/>
                                    </div>

                                </div>
                            </div>

                            <table class="table table-striped table-bordered table-hover text_kanan" id="idGridFotoRumah">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Foto Rumah
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                        <!-- <th>
                                            Ses
                                        </th> -->

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>

                        </div>

                        <!-- <div class="tab-pane fade" id="tab_3_2">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pendidikan</label>
                                            <?php
                                            $data = array();
                                            $data[' '] = ' ';
                                            foreach ($pendidikan as $row) :
                                                $data[$row['id_pend']] = $row['nama_pend'];
                                            endforeach;
                                            echo form_dropdown('pendidikan', $data, '', ' id="id_pendidikan" class="form-control input-sm select2me"');
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Masuk</label>
                                            <input id="id_thn_masuk"  class="form-control input-sm"
                                                type="text" name="thn_masuk"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Lulus</label>
                                            <input id="id_thn_lulus"  class="form-control input-sm"
                                                type="text" name="thn_lulus"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Sekolah</label>
                                        <input id="id_nama_sekolah"  class="form-control input-sm"
                                            type="text" name="nama_sekolah"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_3_3">
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Pendidikan</label>
                                        <input id="id_nama_pend"  class="form-control input-sm"
                                            type="text" name="nama_pend"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Pendidikan</label>
                                        <input id="id_jenis_pend"  class="form-control input-sm"
                                            type="text" name="jenis_pend"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun</label>
                                            <input id="id_thn"  class="form-control input-sm"
                                                type="text" name="thn"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input id="id_ket"  class="form-control input-sm"
                                            type="text" name="keterangan"/>
                                    </div>
                                    <div class="form-group">
                                            <label>Instansi</label>
                                            <?php
                                            $data = array();
                                            $data[' '] = ' ';
                                            foreach ($instansi as $row) :
                                                $data[$row['id_instansi']] = $row['nama_instansi'];
                                            endforeach;
                                            echo form_dropdown('instansi', $data, '', ' id="id_instansi" class="form-control input-sm select2me" value="" ');
                                            ?>
                                        </div>

                                </div>
                            </div>

                        </div> -->

                <!-- </form> -->
                    <!-- END ROW-->
                <!-- </div> -->
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <button type="submit" class="btn blue" id="id_All"><i class="fa fa-plus"></i>&nbsp; Tambah </button>
                <button type="submit" class="btn blue" id="id_btnEditCpa"><i class="fa fa-pencil"></i>&nbsp; Update </button>
                <button type="button" class="btn default" data-dismiss="modal" id="id_btnBatalCpa"><i class="fa fa-times"></i>&nbsp;Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- End MODAL Input Data Cucian Masuk -->

</form>

<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('transaksi/js/trans_kk.js.php'); ?>
