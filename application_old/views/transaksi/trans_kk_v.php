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
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form Input Kartu Keluarga </a>
                    </li>

                </ul>
                <form role="form" method="post"
                      action="<?php echo base_url('transaksi/trans_kk/home'); ?>" id="id_formAdvance">
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
                                            <h2>Kepala keluarga</h2>

                                        </div>
                                        <div class="form-group">
                                            <label>No KK</label>
                                            <input id="id_kelId" required="required" class="form-control input-sm"
                                                   type="text" name="kelId" />
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>NIK</label>
                                                    <input id="id_kelId" required="required" class="form-control input-sm"
                                                           type="text" name="kelId" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nama</label>
                                                    <input id="id_namaKec" class="form-control input-sm"
                                                           type="text" name="namaKec" />
                                                </div>

                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Tempat lahir</label>
                                                    <input id="id_telp"  class="form-control input-sm"
                                                           type="text" name="telp"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Tanggal Lahir</label>
                                                    <input id="id_tglLahir"  placeholder="dd-mm-yyyy"
                                                           class="form-control input-sm date-picker" type="text"
                                                           name="tglLahir" data-date-format="dd-mm-yyyy" />

                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Jenis kelamin</label>
                                                    <select name="jekel" id="id_jekel" class="select2me">
                                                        <option value="0">Pria</option>
                                                        <option value="1">Wanita</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Golongan darah</label>
                                                    <select name="gol_darah" id="id_golDarah" class="select2me">
                                                        <option value="0">O</option>
                                                        <option value="1">A</option>
                                                        <option value="2">B</option>
                                                        <option value="3">AB</option>

                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea rows="2" cols="" name="alamat" id="id_alamat"
                                                      class="form-control input-sm" placeholder="Alamat"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>RT</label>
                                                    <input id="id_telp"  class="form-control input-sm"
                                                           type="text" name="telp"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>RW</label>
                                                    <input id="id_npwp"  class="form-control input-sm"
                                                           type="text" name="npwp"/>
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
                                                    echo form_dropdown('kecamatan', $data, '', 'required id="id_kec" class="form-control input-sm select2me "');
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
                                                    echo form_dropdown('kelurahan', $data, '', 'required id="id_kel" class="form-control input-sm select2me "');
                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!--end <div class="col-md-6"> 1 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <h2>&nbsp;</h2>
                                        </div>
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 225px; height: 170px;">
                                                    <img src="<?= site_url('metronic/img/user.png'); ?>" id="gambarnya" alt="" />    

                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail hidden" style="max-width: 250px; max-height: 200px;"> </div>

                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <h1>&nbsp;</h1>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Agama</label>
                                                    <select name="agama" id="id_agama" class="select2me">
                                                        <option value="3">Hindu</option>
                                                        <option value="0">Islam</option>
                                                        <option value="1">Khatolik</option>
                                                        <option value="2">Kristen</option>
                                                        <option value="4">Budha</option>
                                                        <option value="5">Lain-lain</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Status Kawin</label>
                                                    <select name="agama" id="id_agama" class="select2me">
                                                        <option value="0">Tdk/Blm Kawin</option>
                                                        <option value="1">Kawin</option>
                                                        <option value="2">Duda</option>
                                                        <option value="3">Janda</option>

                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Warga Negara</label>
                                                    <select name="agama" id="id_agama" class="select2me">
                                                        <option value="0">WNI</option>
                                                        <option value="1">WNA</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Pendidikan</label>
                                                    <select name="pendidikan" id="id_agama" class="select2me">
                                                        <option value="0">SD</option>
                                                        <option value="1">SLTP</option>
                                                        <option value="2">SLTA</option>
                                                        <option value="3">D3</option>
                                                        <option value="4">D4/S1</option>
                                                        <option value="5">S2</option>
                                                        <option value="6">S3</option>
                                                        <option value="7">Profesor</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Pekerjaan</label>
                                                    <input id="id_telp"  class="form-control input-sm"
                                                           type="text" name="telp"/>
                                                </div>
                                            </div>
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
                                    <div class="form-body">
                                        <table class="table table-striped table-hover table-bordered" id="id_tabelPerkCflow">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        NIK
                                                    </th>
                                                    <th>
                                                        Nama
                                                    </th>
                                                    <th>
                                                        TTL
                                                    </th>
                                                    <th>
                                                        Agama
                                                    </th>
                                                    <th>
                                                        Pendidikan
                                                    </th>
                                                    <th>
                                                        Pekerjaan
                                                    </th>
                                                    <th width="5%">
                                                        Act
                                                    </th>

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
                                        <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                            <!--<i class="fa fa-check"></i>--> Simpan
                                        </button>
                                        <button type="button" name="btnCetak" class="btn yellow" id="id_btnCetakStruk">Cetak
                                        </button>
                                        <button id="id_btnBatal" type="button" class="btn default">Clear</button>
                                    </div>
                                </div>
                            </div>

                        </div>    
                        <!--<div class="tab-pane fade" id="tab_2_3">-->
                        <!--  MODAL Data CPA -->

                        <!-- END ROW-->

                        <!--                        </div>-->

                        <!--                    </div>-->

                </form>
            </div>
        </div>
        <!-- end <div class="portlet green-meadow box"> -->
    </div>
    <!-- end <div class="col-md-6"> -->
    <!--
    <div class="col-md-6">
    </div>
    -->
    <!-- end <div class="col-md-6"> -->
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
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIK</label>
                                <input id="id_telp"  class="form-control input-sm"
                                       type="text" name="telp"/>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input id="id_npwp"  class="form-control input-sm"
                                       type="text" name="npwp"/>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Tempat lahir</label>
                                        <input id="id_telp"  class="form-control input-sm"
                                               type="text" name="telp"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tanggal Lahir</label>
                                        <input id="id_npwp"  class="form-control input-sm"
                                               type="text" name="npwp"/>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Jenis kelamin</label>
                                        <select name="jekel" id="id_jekel" class="select2me">
                                            <option value="0">Pria</option>
                                            <option value="1">Wanita</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Golongan darah</label>
                                        <select name="gol_darah" id="id_golDarah" class="select2me">
                                            <option value="0">O</option>
                                            <option value="1">A</option>
                                            <option value="2">B</option>
                                            <option value="3">AB</option>

                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Agama</label>
                                        <select name="agama" id="id_agama" class="select2me">
                                            <option value="3">Hindu</option>
                                            <option value="0">Islam</option>
                                            <option value="1">Khatolik</option>
                                            <option value="2">Kristen</option>
                                            <option value="4">Budha</option>
                                            <option value="5">Lain-lain</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Status Kawin</label>
                                        <select name="agama" id="id_agama" class="select2me">
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
                                        <input id="id_telp"  class="form-control input-sm"
                                               type="text" name="telp"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Pendidikan</label>
                                        <select name="pendidikan" id="id_agama" class="select2me">
                                            <option value="0">SD</option>
                                            <option value="1">SLTP</option>
                                            <option value="2">SLTA</option>
                                            <option value="3">D3</option>
                                            <option value="4">D4/S1</option>
                                            <option value="5">S2</option>
                                            <option value="6">S3</option>
                                            <option value="7">Profesor</option>
                                        </select>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <!--end <div class="col-md-6"> 1 -->
                        <div class="col-md-6">

                        </div>


                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <button type="button" class="btn blue" id="id_btnAddCpa"><i class="fa fa-plus"></i>&nbsp; Tambah </button>
                <button type="button" class="btn default" data-dismiss="modal" id="id_btnBatalCpa"><i class="fa fa-times"></i>&nbsp;Selesai</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- End MODAL Input Data Cucian Masuk -->

<?php $this->load->view('app.min.inc.php'); ?>
<script>
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        UIBootbox.init();
        $("input[readonly='true']").focus(function () {
            $(this).next();
        });
        TableManaged.init();
    });
    $(document).keyup(function (e) {
        if (e.which === 36) {
            $('#id_btnModalTambah').trigger('click');
            //$('#id_produk').focus();
        } else if (e.which == 35) {
            $('#id_btnAddCpa').trigger('click');
        }
    });
    //Ready Doc
    btnStart();
    readyToStart();
    tglTransStart();

    $('.cls_diskon_lgsbayar').hide();
    $('#id_spanHargaSatuan').text('0');
    $('#id_hargaTotal').text('0');
    $("#id_tgltrans").focus();
    $('#id_customer').change(function () {
        var idcust = $('#id_customer').select2('data');
        var nama_cust = idcust[0].text;
        //alert(nama_cust);
        $('#id_nama_cust').val(nama_cust);
    });
    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
    });
    $('#id_status_bayar').change(function () {
        var st_bayar = $(this).val();
        if (st_bayar == 0) {
            $('.cls_diskon_lgsbayar').hide();
        } else {
            $('.cls_diskon_lgsbayar').show();
            $('#id_diskon_lgsbayar').focus();
        }
    });
    $('#id_btnBatal').click(function () {
        btnStart();
        resetForm();
        readyToStart();
        tglTransStart();
        $('#id_body_data').empty();
        $('#id_status_bayar').val('0');
        $('#id_customer').select2('val', '');
        $('.cls_diskon_lgsbayar').hide();
    });
    function finishing(obj) {
        var idMaster = $(obj).closest('tr').find("td").eq(1).html();
        $('#id_idMaster').val(idMaster);
        getCMDetail(idMaster.trim(), 1);
    }
    function ambil(obj) {
        //var rowID = $(obj).attr('id');
        //var idMaster = $(obj).closest('tr').find('td:first').html();
        var idMaster = $(obj).closest('tr').find("td").eq(1).html();
        $('#id_idMaster').val(idMaster);
        var nama_cust = $(obj).closest('tr').find("td").eq(3).html();
        $('#id_nama_cust').val(nama_cust);

        getCMDetail(idMaster.trim(), 3);
    }
    function outsource(obj) {
        var idMaster = $(obj).closest('tr').find("td").eq(1).html();
        $('#id_idMaster').val(idMaster);
        getCMDetail(idMaster.trim(), 2);
        $('#id_inputIdTransOutsource').val('');
    }

    function getDescProduk(idProduk) {
        ajaxModal();
        if (idProduk != '') {
            $.post("<?php echo site_url('/master/master_produk/getDescProduk'); ?>",
                    {
                        'idProduk': idProduk
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_harga1').val(data.harga1);
                    $('#id_harga2').val(data.harga2);
                    $('#id_harga3').val(data.harga3);
                    $('#id_harga4').val(data.harga4);
                    $('#id_harga5').val(data.harga5);
                    $('#id_harga6').val(data.harga6);
                    $('#id_harga7').val(data.harga7);
                    /*
                     $('#').val(data.); */
                } else {
                    alert('Data tidak ditemukan!');
                    $('#id_btnBatal').trigger('click');
                }
            }, "json");
        }//if kd<>''
    }
    function kosongDetail() {
        $('.kosongTextDetail').text('');
        $('.kosongTextDetail2').text('0');
        $('.kosongDetail').select2("val", "");
        $('.kosongNomorDetail').val('0.00');
        $('.kosongNomor1Detail').val('0');
        $('#id_layanan').select2("val", "");
    }
    function hitungTotalHarga() {
        var idProduk = parseFloat(CleanNumber($('#id_produk').val()));
        var layanan = parseFloat(CleanNumber($('#id_layanan').val()));

        var jmlCucian = parseFloat(CleanNumber($('#id_jmlCucian').val()));
        jmlCucian = jmlCucian.toFixed(2);

        var cucisetrikabiasa = parseFloat(CleanNumber($('#id_harga1').val()));
        var cucisetrikaexpress = parseFloat(CleanNumber($('#id_harga2').val()));
        var setrikabiasa = parseFloat(CleanNumber($('#id_harga3').val()));
        var setrikaexpress = parseFloat(CleanNumber($('#id_harga4').val()));
        var cuciajabiasa = parseFloat(CleanNumber($('#id_harga5').val()));
        var cuciajaexpress = parseFloat(CleanNumber($('#id_harga6').val()));
        var dryclean = parseFloat(CleanNumber($('#id_harga7').val()));

        if (layanan == 1) {
            $('#id_hargaSatuan').val(number_format(cucisetrikabiasa, 0));
        } else if (layanan == 2) {
            $('#id_hargaSatuan').val(number_format(cucisetrikaexpress, 0));
        } else if (layanan == 3) {
            $('#id_hargaSatuan').val(number_format(setrikabiasa, 0));
        } else if (layanan == 4) {
            $('#id_hargaSatuan').val(number_format(setrikaexpress, 0));
        } else if (layanan == 5) {
            $('#id_hargaSatuan').val(number_format(cuciajabiasa, 0));
        } else if (layanan == 6) {
            $('#id_hargaSatuan').val(number_format(cuciajaexpress, 0));
        } else if (layanan == 7) {
            $('#id_hargaSatuan').val(number_format(dryclean, 0));
        } else {
            $('#id_hargaSatuan').val(number_format(0, 0));
        }

        var hargaSatuan = parseFloat(CleanNumber($('#id_hargaSatuan').val()));
        var hargaTotal = jmlCucian * hargaSatuan;
        $('#id_spanHargaSatuan').text('    ' + number_format(hargaSatuan, 0));
        $('#id_hargaTotal').text('    ' + number_format(hargaTotal, 0));
    }

    $(".cls_hitungTotalHarga").change(function () {
        hitungTotalHarga();
    });

    $("#id_produk").change(function () {
        var idProduk = $(this).val();
        if (idProduk == '') {

        } else {
            getDescProduk(idProduk);
        }
    });

    $('#id_btnAddCpa').click(function () {
        var i = $('#idTxtTempLoop').val();
        if ($('#id_produk').val() == '' || $('#id_layanan').val() == '') {
            alert("Produk atau layanan tidak boleh kosong.");
        } else {
            var i = parseInt($('#idTxtTempLoop').val());
            i = i + 1;
            var kdProduk = $('#id_produk').val();
            var txtProduk = $('#id_produk option:selected').text();
            var kdLayanan = $('#id_layanan').val();
            var txtLayanan = $('#id_layanan option:selected').text();
            var kg = $('#id_jmlCucian').val();
            var hargaSatuan = $('#id_hargaSatuan').val();
            var hargaTotal = $('#id_hargaTotal').text();
            hargaTotal.trim();
            tr = '<tr class="listdata" id="tr' + i + '">';
            tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdProduk' + i + '" name="tempKdProduk' + i + '" readonly="true" value="' + kdProduk + '"></td>';
            tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdLayanan' + i + '" name="tempKdLayanan' + i + '" readonly="true" value="' + kdLayanan + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtProduk' + i + '" name="tempTxtProduk' + i + '" readonly="true" value="' + txtProduk + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtLayanan' + i + '" name="tempTxtLayanan' + i + '" readonly="true" value="' + txtLayanan + '" ></td>';
            tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempKg' + i + '" name="tempKg' + i + '" readonly="true" value="' + kg + '" ></td>';
            tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempHargasatuan' + i + '" name="tempHargaSatuan' + i + '" readonly="true" value="' + hargaSatuan + '" ></td>';
            tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempTotalHarga' + i + '" name="tempTotalHarga' + i + '" readonly="true" value="' + hargaTotal + '" ></td>';
            tr += '<td><a href="#" class="btn red btn-sm" onclick="hapusBaris(\'tr' + i + '\')"><i class="fa fa-minus fa-fw"/></i></a></td>';
            tr += '</tr>';

            jmlKg = parseFloat(CleanNumber(kg));
            jmlLt = parseFloat(CleanNumber(hargaSatuan));
            jmlDrum = parseFloat(CleanNumber(hargaTotal));

            var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));
            var totalLt = parseFloat(CleanNumber($('#id_totalHargaSatuan').val()));
            var totalDrum = parseFloat(CleanNumber($('#id_totalHargaAll').val()));

            var total_kg = jmlKg + totalKg;
            var total_lt = jmlLt + totalLt;
            var total_drum = jmlDrum + totalDrum;

            $('#id_totalKg').val(number_format(total_kg, 2));
            $('#id_totalHargaSatuan').val(number_format(total_lt, 2));
            $('#id_totalHargaAll').val(number_format(total_drum, 2));

            $('#id_body_data').append(tr);
            $('#idTxtTempLoop').val(i);
            kosongDetail();
        }
    });
    function hapusBaris(noRow) {
        if (document.getElementById(noRow) != null) {

            var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));
            var totalLt = parseFloat(CleanNumber($('#id_totalHargaSatuan').val()));
            var totalDrum = parseFloat(CleanNumber($('#id_totalHargaAll').val()));
            var jmlKgOld = $('#' + noRow).find("td input").eq(4).val();
            jmlKgOld = parseFloat(CleanNumber(jmlKgOld));
            var jmlLtOld = $('#' + noRow).find("td input").eq(5).val();
            jmlLtOld = parseFloat(CleanNumber(jmlLtOld));
            var jmlDrumOld = $('#' + noRow).find("td input").eq(6).val();
            jmlDrumOld = parseFloat(CleanNumber(jmlDrumOld));
            totalKg = totalKg - jmlKgOld;
            totalLt = totalLt - jmlLtOld;
            totalDrum = totalDrum - jmlDrumOld;
            $('#id_totalKg').val(number_format(totalKg, 2));
            $('#id_totalHargaSatuan').val(number_format(totalLt, 2));
            $('#id_totalHargaAll').val(number_format(totalDrum, 2));
            $('#' + noRow).remove();
        }
    }

    $('#id_btnBatalCpa').click(function () {
        kosongDetail();
    });
    function ajaxSubmitAdvance() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>transaksi/trans_kk/simpan",
            data: dataString,
            success: function (data) {
                $('#id_btnSimpan').attr("disabled", true);
                UIToastr.init(data.tipePesan, data.pesan);
                $('#id_idMaster').val(data.idMaster);
                $('#id_Reload').trigger('click');
            }
        });
    }

    $('#id_formAdvance').submit(function (event) {
        dataString = $("#id_formAdvance").serialize();
        var jmlCpa = $('#idTxtTempLoop').val();
        if (jmlCpa == 0) {
            alert("Masukkan produk!");
            $('.linav').removeClass("active");
            $('#linav2').addClass("active in");
            $('.anavitab').attr("aria-expanded", "false");
            $('#navitab_2_2').attr("aria-expanded", "true");
            $('.tab-pane').removeClass("active in");
            $('#tab_2_2').addClass("active in");
            return false;
        }
        var aksiBtn = $('#idTmpAksiBtn').val();
        if (aksiBtn == '1') {
            var r = confirm('Anda yakin menyimpan data ini?');
            if (r == true) {
                ajaxSubmitAdvance();
                event.preventDefault();
            } else {//if(r)
                return false;
            }
        }
    });
    function cetak() {
        var masterId = $('#id_idMaster').val();
        if (masterId == '') {
            alert('Master id kosong.');
        } else {
            window.open("<?php echo base_url('transaksi/trans_kk/cetakPO/'); ?>/" + masterId, '_blank'); //+ idAdvance + masterId
        }
    }

    var TableManaged = function () {

        var initTable1 = function () {

            var table = $('#idTabelPO');

            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/transaksi/trans_kk/getKKAll"); ?>",
                "columns": [
                    {"data": "no"},
                    {"data": "idKK"},
                    {"data": "idKtp"},
                    {"data": "namaKtp"},
                    {"data": "kec"},
                    {"data": "kel"},
                    {"data": "rw"},
                    {"data": "rt"},
                    {"data": "jmlAgt"}

                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "No entries found",
                    "infoFiltered": "(filtered1 from _MAX_ total entries)",
                    "lengthMenu": "Show _MENU_ entries",
                    "search": "Search:",
                    "zeroRecords": "No matching records found"
                },
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.


                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,
                "pagingType": "bootstrap_full_number",
                "language": {
                    "search": "Cari: ",
                    "lengthMenu": "  _MENU_ records",
                    "paginate": {
                        "previous": "Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },
                "aaSorting": [[0, 'asc']/*, [5,'desc']*/],
                "columnDefs": [{// set default column settings
                        'orderable': true,
                        "searchable": true,
                        'targets': [0]
                    }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            });
            $('#id_Reload').click(function () {
                table.api().ajax.reload();
            });

            var tableWrapper = jQuery('#example_wrapper');

            table.find('.group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                        $(this).parents('tr').addClass("active");
                    } else {
                        $(this).attr("checked", false);
                        $(this).parents('tr').removeClass("active");
                    }
                });
                jQuery.uniform.update(set);
            });

            table.on('change', 'tbody tr .checkboxes', function () {
                $(this).parents('tr').toggleClass("active");
            });
            table.on('click', 'tbody tr', function () {
                var idKel = $(this).find("td").eq(0).html();

                $('#id_kelId').val(idKel);
                getDescKel(idKel);
                $("#navitab_2_2").trigger('click');
                //$('#').val();
                $('#btnCloseModalDataUser').trigger('click');
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);
                $('#id_namaKel').focus();

            });

            tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
        }


        return {
            //main function to initiate the module
            init: function () {
                if (!jQuery().dataTable) {
                    return;
                }
                initTable1();
            }
        };
    }();
    function kosongAmbil() {
        $('#id_bayarAmbil').prop("checked", true);
        $('#id_bonAmbil').prop("checked", true);
        $('#id_diskon').val('0.00');
        $('#id_uangBayarAmbil').val('0.00');
        $('#id_spanUangKembalian').text('-');
        $('#id_keteranganAmbil').val('');
    }
//    var e = $("#id_tabelCucianOutsource");
    $(".group-checkable").change(function () {
        var e = $(this).attr("data-set");
        var t = $(this).is(":checked");
        var id_trans = '';
        jQuery(e).each(function () {//i
            t ? ($(this).prop("checked", !0), $(this).parents("tr").addClass("active")) : ($(this).prop("checked", !1), $(this).parents("tr").removeClass("active"));

            if (t) {
                var val = [];
                val[i] = $(this).val();
                id_trans = id_trans + val[i] + ',';
                $('#id_inputIdTransOutsource').val(id_trans);
            } else {
                $('#id_inputIdTransOutsource').val('');
            }
        })
    }), $("#id_tabelCucianOutsource").on("change", "tbody tr .checkboxes", function () {
        $(this).parents("tr").toggleClass("active");

        $(this).each(function (i) {
            var k = $(this).is(":checked");
            var val = [];
            var idtrans = $('#id_inputIdTransOutsource').val();
            val[i] = $(this).val() + ',';

            if (k) {// jika checked
                idtrans = idtrans + val[i];
                $('#id_inputIdTransOutsource').val(idtrans);
            } else {// jika unchecked
                var str = $('#id_inputIdTransOutsource').val();
                var res = str.replace(val[i], '');
                $('#id_inputIdTransOutsource').val(res);
            }
        });
        $('#id_btnTestOutsource').click(function () {

        });
        //alert(val[i]);
    });


    function getCMDetail(idMaster, act) {
        kosongAmbil();
        ajaxModal();
        //cls_body_detail_cucian
        $('.cls_body_detail_cucian').empty();
        if (idMaster != '') {
            $.post("<?php echo site_url('transaksi/trans_kk/getCMDetail'); ?>",
                    {
                        'idMaster': idMaster
                    }, function (data) {
                if (data.data_cpa.length > 0) {
                    $('.cls_spanNamaCust').text(data.data_cpa[0].nama_cust);
                    var nama_agen = '';
                    if (data.data_cpa[0].id_agen.trim() == '' || data.data_cpa[0].id_agen.trim() == null) {
                        nama_agen = "Sendiri";
                    } else {
                        nama_agen = data.data_cpa[0].nama_agen;
                    }

                    $('.cls_spanNamaAgen').text(nama_agen);

                    for (i = 0; i < data.data_cpa.length; i++) {
                        var x = i + 1;
                        var kdProduk = data.data_cpa[i].id_produk;
                        var txtProduk = data.data_cpa[i].nama_produk;
                        var kdLayanan = data.data_cpa[i].id_layanan;
                        var txtLayanan = data.data_cpa[i].nama_layanan;
                        var kg = data.data_cpa[i].qty;
                        var hargaSatuan = data.data_cpa[i].harga_satuan;
                        var hargaTotal = parseFloat(CleanNumber(kg)) * parseFloat(CleanNumber(hargaSatuan));
                        var id_trans = data.data_cpa[i].id_trans.trim();
                        tr = '<tr class="listdata" id="tr' + x + '">';
                        tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdProduk' + x + '" name="tempKdProduk' + x + '" readonly="true" value="' + kdProduk + '"></td>';
                        tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdLayanan' + x + '" name="tempKdLayanan' + x + '" readonly="true" value="' + kdLayanan + '" ></td>';
                        tr += '<td>' + txtProduk + '</td>';
                        tr += '<td>' + txtLayanan + '</td>';
                        tr += '<td align ="right">' + kg + '</td>';
                        tr += '<td align ="right">' + number_format(hargaSatuan, 0) + '</td>';
                        tr += '<td align ="right">' + number_format(hargaTotal, 0) + '</td>';
                        if (act == 2) {//jika out source
                            if (data.data_cpa[i].status_outsource_trans == 1) {
                                tr += '<td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">';
                                tr += '<input checked disabled id="id_tempIdTrans' + x + '" name="tempIdTrans' + x + '" class="checkboxes" value="' + id_trans + '" type="checkbox"><span></span></label></td>';
                                //$("#tr" + x).addClass("active");
                            } else {
                                tr += '<td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">';
                                tr += '<input id="id_tempIdTrans' + x + '" name="tempIdTrans' + x + '" class="checkboxes" value="' + id_trans + '" type="checkbox"><span></span></label></td>';
                            }
                        }

                        tr += '</tr>';
                        var jmlKg = parseFloat(CleanNumber(kg));
                        var jmlHS = parseFloat(CleanNumber(hargaSatuan));
                        var jmlHT = hargaTotal;
                        var total_kg = jmlKg + total_kg;
                        var total_hs = jmlHS + total_hs;
                        var total_ht = jmlHT + total_ht;
                        $('#id_totalKgAmbil').val(number_format(total_kg, 2));
                        $('#id_totalHargaSatuanAmbil').val(number_format(total_hs, 2));
                        $('#id_totalHargaAllAmbil').val(number_format(total_ht, 2));
                        $('.cls_body_detail_cucian').append(tr);
                    }
                    if (act == 1) {//finish
                        $('#id_spanTotalSatuanFinish').text(number_format(data.data_cpa[0].total_qty_satuan, 0));
                        $('#id_spanTotalKiloanFinish').text(number_format(data.data_cpa[0].total_qty_kg, 2));
                        $('#id_setrikaSatuanFinish').val(number_format(data.data_cpa[0].total_qty_satuan, 0));
                        $('#id_setrikaKiloanFinish').val(number_format(data.data_cpa[0].total_qty_kg, 2));

                        $('#id_karyawan').val(data.data_cpa[0].id_kyw.trim());
                        if (data.data_cpa[0].status_selesai == 0) {
                            $('#id_btnFinishing').show();
                        } else {
                            $('#id_btnFinishing').hide();
                        }
                        if (data.data_cpa[0].tgl_selesai == '00-00-0000') {
                            var tgltrans = $('#id_sessTgltrans').text();
                            $('#id_tglFinishing').val(tgltrans);
                        } else {
                            $('#id_tglFinishing').val(data.data_cpa[0].tgl_selesai);
                        }

                    } else if (act == 2) {//oursource
                        if (data.data_cpa[0].tgl_os_kel == '00-00-0000') {
                            $('#id_spanTglKelKeOutsource').text("-");
                            //$('#id_tglKelKeOutsource').val("");
                        } else {
                            $('#id_spanTglKelKeOutsource').text(data.data_cpa[0].tgl_os_kel);
                            $('#id_tglKelKeOutsource').val(data.data_cpa[0].tgl_os_kel);
                            //$('#id_tglKelKeOutsource').hide();
                        }
                        if (data.data_cpa[0].tgl_os_msk == '00-00-0000') {
                            $('#id_spanTglMskDrOutsource').text("-");
                            //$('#id_tglMskDrOutsource').val("");

                        } else {
                            $('#id_spanTglMskDrOutsource').text(data.data_cpa[0].tgl_os_msk);
                            $('#id_tglMskDrOutsource').val(data.data_cpa[0].tgl_os_msk);
                            //$('#id_tglMskDrOutsource').hide();
                        }
                        if (data.data_cpa[0].status_outsource == 0) {
                            $('#id_spanStatusOutsource').text("Tidak outsource.");
                            $('#id_tglMskDrOutsource').hide();
                            $('#id_btnOutsource').show();
                            $('#id_btnOutsourceMsk').hide();
                            $('#id_tglKelKeOutsource').show();
                            $('#id_tglMskDrOutsource').hide();
                        } else if (data.data_cpa[0].status_outsource == 1) {
                            $('#id_spanStatusOutsource').text("Sedang di Outsource.");
                            $('#id_btnOutsource').hide();
                            $('#id_btnOutsourceMsk').show();
                            $('#id_tglKelKeOutsource').hide();
                            $('#id_tglMskDrOutsource').show();
                        } else {
                            $('#id_spanStatusOutsource').text("Sudah kembali di laundry.");
                            $('#id_btnOutsource').hide();
                            $('#id_btnOutsourceMsk').hide();
                            $('#id_tglKelKeOutsource').hide();
                            $('#id_tglMskDrOutsource').hide();
                        }
                        $('#id_outsource').val(data.data_cpa[0].id_outsource.trim());


                    } else if (act == 3) {//ambil
                        var total_kg = 0;
                        var total_hs = 0;
                        var total_ht = 0;
                        $('#id_spanHargaTotalAmbil').text(number_format(data.data_cpa[0].total_harga, 0));
                        //$('#id_hargaYgDibayar').val(number_format(data.data_cpa[0].total_harga, 0));
                        if (data.data_cpa[0].status_bayar == 1) {
                            $('#id_spanHargaYgDibayar').text('LUNAS');
                            $('#id_bayarAmbil').attr("disabled", true);
                            $('#id_diskon').attr("disabled", true);
                            $('#id_uangBayarAmbil').attr("disabled", true);
                        } else {
                            $('#id_spanHargaYgDibayar').text(number_format(data.data_cpa[0].total_harga, 0));
                            $('#id_bayarAmbil').attr("disabled", false);
                            $('#id_diskon').attr("disabled", false);
                            $('#id_uangBayarAmbil').attr("disabled", false);
                        }

                    }

                } else {
                    //alert('Data tidak ditemukan!');
                    //$('#id_btnBatal').trigger('click');
                }
            }, "json");
        }//if kd<>''
    }
    $('#id_diskon').focusout(function () {
        var hargaTotal = parseFloat(CleanNumber($('#id_spanHargaTotalAmbil').text().trim()));
        var diskon = parseFloat(CleanNumber($(this).val()));
        var ygharusdibayar = hargaTotal - diskon;
        $('#id_spanHargaYgDibayar').text(number_format(ygharusdibayar, 0));
    });
    $('#id_uangBayarAmbil').focusout(function () {
        var uangBayar = parseFloat(CleanNumber($(this).val()));
        var ygharusdibayar = parseFloat(CleanNumber($('#id_spanHargaYgDibayar').text().trim()));

        var kembalian = uangBayar - ygharusdibayar;
        $('#id_spanUangKembalian').text(number_format(kembalian, 0));
    });
    $('#id_btnAmbil').click(function () {
        submitAmbil();
    });
    $('#id_btnFinishing').click(function () {
        submitFinish();
    });
    $('#id_btnOutsource').click(function () {
        submitOutsource();
    });
    $('#id_btnOutsourceMsk').click(function () {
        submitOutsourceMsk();
    });
    $('#id_btnCetakStruk').click(function () {
        submitCetakStruk();
    });
    function submitCetakStruk() {
        var tglTrans = $('#id_tgltrans').val();
        var tglSelesai = $('#id_etglSelesai').val();
        var idMaster = $('#id_idMaster').val();
        var statusBayar = $('#id_status_bayar').val();
        var namaCustomer = $('#id_customer').select2('data')[0].text;
        var totalHarga = $('#id_totalHargaAll').val();
        if (idMaster.trim() != '') {
            ajaxModal();
            $.post("<?php echo site_url('/transaksi/trans_kk/cetakStruk'); ?>",
                    {
                        'idMaster': idMaster,
                        'tglTrans': tglTrans,
                        'tglSelesai': tglSelesai,
                        'namaCustomer': namaCustomer,
                        'statusBayar': statusBayar,
                        'totalHarga': totalHarga
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_btnBatalOutsource').trigger('click');
                    UIToastr.init(data.tipePesan, data.pesan);
                } else {
                    UIToastr.init(data.tipePesan, data.pesan);
                }
            }, "json");

        } else {
            alert("Master tidak boleh kosong.");
        }


    }
    function submitOutsource() {
        var idOutsource = $('#id_outsource').val();
        var inputIdTransOutsource = $('#id_inputIdTransOutsource').val();
        var tglKelOutsource = $('#id_tglKelKeOutsource').val();
        if (idOutsource.trim() != '' && inputIdTransOutsource.trim() != '') {
            bootbox.confirm("Anda yakin menyimpan data ini?", function (o) {
                if (o == true) {
                    var idMaster = $('#id_idMaster').val();
                    ajaxModal();
                    $.post("<?php echo site_url('/transaksi/trans_kk/simpanOutsource'); ?>",
                            {
                                'idMaster': idMaster,
                                'idOutsource': idOutsource,
                                'inputIdTransOutsource': inputIdTransOutsource,
                                'tglKelOutsource': tglKelOutsource
                            }, function (data) {
                        if (data.baris == 1) {
                            $('#id_btnBatalOutsource').trigger('click');
                            UIToastr.init(data.tipePesan, data.pesan);
                            $('#id_Reload').trigger('click');
                        } else {
                            UIToastr.init(data.tipePesan, data.pesan);
                        }
                    }, "json");
                }
            });
        } else {
            alert("Outsource tidak boleh kosong.");
            $('#id_outsource').focus();
        }
    }
    function submitOutsourceMsk() {
        var idOutsource = $('#id_outsource').val();
        var tglMskDrOutsource = $('#id_tglMskDrOutsource').val();
        if (idOutsource != '') {
            bootbox.confirm("Anda yakin menyimpan data ini?", function (o) {
                if (o == true) {
                    var idMaster = $('#id_idMaster').val();

                    ajaxModal();

                    $.post("<?php echo site_url('/transaksi/trans_kk/simpanOutsourceMsk'); ?>",
                            {
                                'idMaster': idMaster,
                                'tglMskDrOutsource': tglMskDrOutsource
                            }, function (data) {
                        if (data.baris == 1) {
                            $('#id_btnBatalOutsource').trigger('click');
                            UIToastr.init(data.tipePesan, data.pesan);
                            $('#id_Reload').trigger('click');
                        } else {
                            UIToastr.init(data.tipePesan, data.pesan);
                        }
                    }, "json");
                }
            });
        } else {
            alert("Outsource tidak boleh kosong.");
            $('#id_outsource').focus();
        }

    }
    function submitAmbil() {
        bootbox.confirm("Anda yakin menyimpan data ini?", function (o) {
            if (o == true) {
                var idMaster = $('#id_idMaster').val();
                var namaCust = $('#id_nama_cust').val();
                var stsBayar = $("#id_bayarAmbil").is(":checked") ? 1 : 0;
                var stsBon = $("#id_bonAmbil").is(":checked") ? 1 : 0;
                var diskon = $('#id_diskon').val();
                var jmlBayar = $('#id_spanHargaYgDibayar').text().trim();
                var ketAmbil = $('#id_keteranganAmbil').val().trim();
                var tglAmbil = $('#id_tglAmbil').val();
                ajaxModal();

                $.post("<?php echo site_url('/transaksi/trans_kk/simpanAmbil'); ?>",
                        {
                            'idMaster': idMaster,
                            'namaCust': namaCust,
                            'stsBayar': stsBayar,
                            'stsBon': stsBon,
                            'diskon': diskon,
                            'jmlBayar': jmlBayar,
                            'ketAmbil': ketAmbil,
                            'tglAmbil': tglAmbil
                        }, function (data) {
                    if (data.baris == 1) {
                        $('#id_btnBatalAmbil').trigger('click');
                        UIToastr.init(data.tipePesan, data.pesan);
                        $('#id_Reload').trigger('click');
                    } else {
                        UIToastr.init(data.tipePesan, data.pesan);
                    }
                }, "json");
            }
        });
    }
    function submitFinish() {
        var totalSatuan = parseFloat(CleanNumber($('#id_spanTotalSatuanFinish').text().trim()));
        var totalKiloan = parseFloat(CleanNumber($('#id_spanTotalKiloanFinish').text().trim()));
        var jmlSetrikaSatuan = parseFloat(CleanNumber($('#id_setrikaSatuanFinish').val().trim()));
        var jmlSetrikaKiloan = parseFloat(CleanNumber($('#id_setrikaKiloanFinish').val().trim()));
        var idKaryawan = $('#id_karyawan').val();
        if (jmlSetrikaSatuan > totalSatuan) {
            alert("Jumlah setrikaan satuan tidak boleh lebih besar dari total cucian satuan yang masuk.");
        } else if (jmlSetrikaKiloan > totalKiloan) {
            alert("Jumlah setrikaan kiloan tidak boleh lebih besar dari total cucian kiloan yang masuk.");
        } else {
            //if (idKaryawan != '') {
            bootbox.confirm("Anda yakin menyimpan data ini?", function (o) {
                if (o == true) {
                    var idMaster = $('#id_idMaster').val();
                    var tglFinishing = $('#id_tglFinishing').val();
                    ajaxModal();

                    $.post("<?php echo site_url('/transaksi/trans_kk/simpanFinish'); ?>",
                            {
                                'idMaster': idMaster,
                                'idKaryawan': idKaryawan,
                                'jmlSetrikaSatuan': jmlSetrikaSatuan,
                                'jmlSetrikaKiloan': jmlSetrikaKiloan,
                                'tglFinishing': tglFinishing
                            }, function (data) {
                        if (data.baris == 1) {
                            $('#id_btnBatalFinish').trigger('click');
                            UIToastr.init(data.tipePesan, data.pesan);
                            $('#id_Reload').trigger('click');
                        } else {
                            UIToastr.init(data.tipePesan, data.pesan);
                        }
                    }, "json");
                }
            });
            /*    
             } else {
             alert("Karyawan tidak boleh kosong!");
             $('#id_karyawan').focus();
             }
             */

        }
    }
</script>


<!-- END JAVASCRIPTS -->