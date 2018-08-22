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
<form id="id_formKK" enctype="multipart/form-data" id="uploadpr" method="POST">
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
                                    <table class="table table-striped table-bordered table-hover styleDataTabel" id="idTabelPO">
                                        <thead>
                                            <tr>
                                                <th>
                                                    No
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
                                        <!-- <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>NIK</label>
                                                    <input id="id_nik_" required="required" class="form-control input-sm"
                                                           type="text" name="nik_" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nama</label>
                                                    <input id="id_nama_" class="form-control input-sm"
                                                           type="text" name="nama_" />
                                                </div>

                                            </div>

                                        </div> -->


                                        <!-- <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Tempat lahir</label>
                                                    <input id="id_tmpt_lahir_"  class="form-control input-sm"
                                                           type="text" name="tmpt_lahir_"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Tanggal Lahir</label>
                                                    <input id="id_tglLahir_"  placeholder="dd-mm-yyyy"
                                                           class="form-control input-sm date-picker" type="text"
                                                           name="tglLahir_" data-date-format="dd-mm-yyyy" />

                                                </div>

                                            </div>
                                        </div> -->
                                        <!-- <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Jenis kelamin</label>
                                                    <select name="jekel_" id="id_jekel_" class="select2me">
                                                        <option value="0">Pria</option>
                                                        <option value="1">Wanita</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Golongan darah</label>
                                                    <select name="gol_darah_" id="id_gol_darah_" class="select2me">
                                                        <option value="0">O</option>
                                                        <option value="1">A</option>
                                                        <option value="2">B</option>
                                                        <option value="3">AB</option>

                                                    </select>
                                                </div>

                                            </div>
                                        </div> -->
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
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($kel as $row) :
                                                        $data[$row['id_kel']] = $row['nama_kel'];
                                                    endforeach;
                                                    echo form_dropdown('kel_', $data, '', 'required id="id_kel_" class="form-control input-sm select2me "');
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
                                            <!-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Foto</label>
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 170px;">
                                                            <img src="<?= site_url('metronic/img/no-image.png'); ?>" id="gambar_foto_ktp" alt="" />    

                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail hidden" style="max-width: 250px; max-height: 200px;"> </div>
                                                            <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> Pilih /</span>
                                                                    <span class="fileinput-exists"> Ubah Foto </span>
                                                                    <input type="file" id="foto_ktp" name="foto_ktp" > </span>
                                                                <input type="hidden" name="unlinkimg" value="">
                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Hapus Foto </a>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Foto Rumah</label>
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 225px; height: 170px;">
                                                            <img src="<?= site_url('metronic/img/no-image.png'); ?>" id="gambar_foto_rumah" alt="" />    

                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail hidden" style="max-width: 250px; max-height: 200px;"> </div>
                                                            <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> Pilih /</span>
                                                                    <span class="fileinput-exists"> Ubah Foto Rumah </span>
                                                                    <input type="file" id="foto_rumah" name="foto_rumah" > </span>
                                                                <!-- <input type="hidden" name="unlinkimg" value="">
                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Hapus Foto Rumah</a> -->
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <!-- <br><br>
                                            <h4>&nbsp;</h4> -->
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Agama</label>
                                                    <select name="agama_" id="id_agama_" class="select2me">
                                                        <option value="0">Islam</option>
                                                        <option value="1">Khatolik</option>
                                                        <option value="2">Kristen</option>
                                                        <option value="3">Hindu</option>
                                                        <option value="4">Budha</option>
                                                        <option value="5">Lain-lain</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Status Kawin</label>
                                                    <select name="status_" id="id_status_" class="select2me">
                                                        <option value="0">Tdk/Blm Kawin</option>
                                                        <option value="1">Kawin</option>
                                                        <option value="2">Duda</option>
                                                        <option value="3">Janda</option>

                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Warga Negara</label>
                                                    <select name="warga_negara_" id="id_warga_negara_" class="select2me">
                                                        <option value="0">WNI</option>
                                                        <option value="1">WNA</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Pendidikan</label>
                                                    <select name="pendidikan_" id="id_pendidikan_" class="select2me">
                                                    <option value="1">SD</option>
                                                    <option value="2">SLTP</option>
                                                    <option value="3">SLTA</option>
                                                    <option value="4">D3</option>
                                                    <option value="5">D4/S1</option>
                                                    <option value="6">S2</option>
                                                    <option value="7">S3</option>
                                                    <option value="8">Profesor</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Pekerjaan</label>
                                                    <input id="id_pekerjaan_"  class="form-control input-sm"
                                                           type="text" name="pekerjaan_"/>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Difabel</label>
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($difabel as $row) :
                                                        $data[$row['id_difabel']] = $row['nama_difabel'];
                                                    endforeach;
                                                    echo form_dropdown('difabel_', $data, '', ' id="id_difabel_" class="form-control input-sm select2me "');
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Bantuan</label>
                                        <input id="id_bantuan_"  class="form-control input-sm"
                                                type="text" name="bantuan_"/>
                                    </div>
                                </div> -->
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
                                    <div class="form-body">
                                        <table class="table table-striped table-hover table-bordered" id="id_tabelAnggotaKel" name="tabelAnggotaKel">
                                            <thead>
                                                <tr>
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
                                                        Pendidikan
                                                    </th>
                                                    <th>
                                                        Pekerjaan
                                                    </th>
                                                    <th>
                                                        Warga Negara
                                                    </th>
                                                    <th>
                                                        Hubungan Keluarga
                                                    </th>
                                                    <th width="5%">
                                                        Act
                                                    </th>

                                                    <th hidden></th>
                                                    <th hidden></th>
                                                    <th hidden></th>
                                                    <th hidden></th>
                                                    <th hidden></th>
                                                    <th hidden></th>
                                                    <th hidden></th>

                                                </tr>

                                            </thead>
                                            <tbody id="id_body_data">

                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!--  END  MODAL Data CPA -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-actions ">
                                        <button type="submit" name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                            <!--<i class="fa fa-check"></i>--> Simpan
                                        </button>
                                        <button type="submit" name="btnSimpan" class="btn blue" id="id_btnUbah">
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
                <div class="scroller" style="height:450px; ">
                <form id="fmKtp">
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
                                            <option value="0,Pria">Pria</option>
                                            <option value="1,Wanita">Wanita</option>
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
                                        <select name="agama" id="id_agama" class="select2me">
                                            <option value="">--Pilih--</option>
                                            <option value="0,Islam">Islam</option>
                                            <option value="1,Khatolik">Khatolik</option>
                                            <option value="2,Kristen">Kristen</option>
                                            <option value="3,Hindu">Hindu</option>
                                            <option value="4,Budha">Budha</option>
                                            <option value="5,Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Status Kawin</label>
                                        <select name="status" id="id_status" class="select2me">
                                            <option value="">--Pilih--</option>
                                            <option value="0,Tdk/Blm Kawin">Tdk/Blm Kawin</option>
                                            <option value="1,Kawin">Kawin</option>
                                            <option value="2,Duda">Duda</option>
                                            <option value="3,Janda">Janda</option>

                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Pendidikan</label>
                                        <select name="pendidikan" id="id_pendidikan" class="select2me">
                                            <option value="">--Pilih--</option>
                                            <option value="1,SD">SD</option>
                                            <option value="2,SLTP">SLTP</option>
                                            <option value="3,SLTA">SLTA</option>
                                            <option value="4,D3">D3</option>
                                            <option value="5,D4/S1">D4/S1</option>
                                            <option value="6,S2">S2</option>
                                            <option value="7,S3">S3</option>
                                            <option value="8,Profesor">Profesor</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Pekerjaan</label>
                                        <input id="id_pekerjaan"  class="form-control input-sm"
                                               type="text" name="pekerjaan"/>
                                    </div>

                                </div>                                
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                    <label>Warga Negara</label>
                                        <select name="warga_negara" id="id_warga_negara" class="select2me">
                                            <option value="0,WNI">WNI</option>
                                            <option value="1,WNA">WNA</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Hubungan Keluarga</label>
                                        <?php
                                        $data = array();
                                        $data[''] = '';
                                        foreach ($hub_kel as $row) :
                                            $data[$row['id_hub_kel'].','.$row['nama_hub_kel']] = $row['nama_hub_kel'];
                                        endforeach;
                                        echo form_dropdown('hub_kel', $data, '', ' id="id_hub_kel" class="form-control input-sm select2me "');
                                        ?>

                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Bantuan</label>
                                        <input id="id_bantuan"  class="form-control input-sm"
                                                type="text" name="bantuan"/>
                                    </div>
                                </div>
                            </div> -->



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
                                                    <!-- <input type="file" id="foto_ktp" name="foto_ktp" >  -->
                                            </span>
                                        </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </form>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <button type="button" class="btn blue" id="id_btnAddCpa"><i class="fa fa-plus"></i>&nbsp; Tambah </button>
                <button type="button" class="btn default" data-dismiss="modal" id="id_btnBatalCpa_"><i class="fa fa-times"></i>&nbsp;Close</button>
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
