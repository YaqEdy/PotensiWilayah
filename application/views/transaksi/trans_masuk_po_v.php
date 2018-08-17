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
                            Data supplier </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Data timbangan</a>
                    </li>
                    <li class="linav" id="linav3">
                        <a href="#tab_2_3" data-toggle="tab" id="navitab_2_3" class="anavitab">
                            Rincian data storage </a>
                    </li>

                </ul>

                <form class="" role="form" method="post"
                      action="<?php echo base_url('transaksi/trans_masuk_po/home'); ?>" id="id_formAdvance">
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_2_1">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input id="id_idMaster" 
                                               class="form-control input-sm hidden" type="text"
                                               name="idMaster" />
                                        <label>Tanggal kedatangan :</label> 
                                        <input id="id_tgltrans" required="required"
                                               class="form-control input-sm date-picker" type="text"
                                               name="tglTrans" data-date-format="dd-mm-yyyy" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>No PO : </label>
                                        <label><strong><?php echo $info_po[0]->no_po; ?></strong></label>
                                        <input id="id_idMaster"
                                               class="form-control input-sm hidden" type="text"
                                               name="idMaster" value="<?php echo $info_po[0]->id_master_in; ?>" />
                                        <input id="id_noPO"
                                               class="form-control input-sm hidden" type="text"
                                               name="noPO" value="<?php echo $info_po[0]->no_po; ?>" />
                                    </div>
                                </div>
                                <!--end <div class="col-md-6"> 1 -->

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Supplier : </label>
                                        <label><strong><?php echo $info_po[0]->nama_spl; ?></strong></label>
                                    </div>     
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>ETD : </label>
                                        <label><strong><?php echo date('d-m-Y', strtotime($info_po[0]->etd)); ?></strong></label>
                                    </div>     
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>ETA : </label>
                                        <label><strong><?php echo date('d-m-Y', strtotime($info_po[0]->eta)); ?></strong></label>
                                    </div>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No batch</label> 
                                        <input id="id_noBatch" class="form-control input-sm"
                                               type="text" name="noBatch" />    
                                    </div>
                                </div>
                                <!--end <div class="col-md-6"> 1 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No cukai</label>
                                        <input id="id_noCukai" required="required" class="form-control input-sm"
                                               type="text" name="noCukai" />
                                    </div>     
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama driver mobil</label> 
                                        <input id="id_namaPengirim" required="required" class="form-control input-sm"
                                               type="text" name="namaPengirim" />    
                                    </div>
                                </div>
                                <!--end <div class="col-md-6"> 1 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No Mobil</label>
                                        <input id="id_noMobil" required="required" class="form-control input-sm"
                                               type="text" name="noMobil" />
                                    </div>     
                                </div>
                                <!-- HIDDEN INPUT -->
                                <input type="text" value="<?php echo $jml_rincian_po['jml']; ?>" id="idTxtTempLoop" name="txtTempLoop" class="form-control  hidden">
                                <input type="text" id="idTmpAksiBtn" class="hidden">
                                <input type="text" id="idTmpBtnKyw" class="hidden">
                                <!-- END HIDDEN INPUT -->
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Waktu mulai bongkar</label> 
                                        <input id="id_waktuMulaiBongkar" required="required" class="form-control input-sm"
                                               type="text" name="waktuMulaiBongkar" />    
                                    </div>
                                </div>
                                <!--end <div class="col-md-6"> 1 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Waktu selesai bongkar</label>
                                        <input id="id_waktuSelesaiBongkar" required="required" class="form-control input-sm"
                                               type="text" name="waktuSelesaiBongkar" />
                                    </div>     
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="javascript:;" class="btn green-haze button-next" id="id_btnNext1">
                                        Continue <i class="m-icon-swapright m-icon-white"></i>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_2_2">
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-4">    
                                        <div class="form-group">
                                            <label>Berat suplier (kg)</label>
                                            <input id="id_beratMolindo" required="required" class="nomor form-control input-sm cls_hitungBerat"
                                                   type="text" name="beratMolindo" />
                                        </div>
                                        <div class="form-group">
                                            <label>Bruto (kg)</label>
                                            <input id="id_bruto" required="required" class="nomor form-control input-sm cls_hitungBerat"
                                                   type="text" name="bruto" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tarra (kg)</label>
                                            <input id="id_tarra" required="required" class="nomor form-control input-sm cls_hitungBerat"
                                                   type="text" name="tarra" />
                                        </div>
                                        <div class="form-group">
                                            <label>Netto (kg)</label>
                                            <input id="id_netto" required="required" class="nomor form-control input-sm cls_hitungBerat"
                                                   type="text" name="netto" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Selisih (kg)</label>
                                            <input id="id_selisihKg" required="required" class="nomor form-control input-sm"
                                                   type="text" name="selisihKg" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label>Selisih (%)</label>
                                            <input id="id_selisihPersen" required="required" class="nomor form-control input-sm"
                                                   type="text" name="selisihPersen" readonly />
                                        </div>                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea rows="3" cols="" name="keterangan" id="id_keterangan"
                                                      class="form-control input-sm"></textarea>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="javascript:;" class="btn green-haze button-next" id="id_btnNext2">
                                        Continue <i class="m-icon-swapright m-icon-white"></i>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_2_3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-body">
                                        <table class="table table-striped table-hover table-bordered" id="id_tabelPerkCflow">
                                            <thead>
                                                <tr>
                                                    <th width="7%" style="display:none;">
                                                        Kd Trans
                                                    </th>
                                                    <th width="7%" style="display:none;">
                                                        Kd Produk
                                                    </th>
                                                    <th width="7%"  style="display:none;">
                                                        Kd Storage
                                                    </th>
                                                    <th width="10%">
                                                        Produk
                                                    </th>
                                                    <th width="10%">
                                                        Storage
                                                    </th>
                                                    <th width="10%">
                                                        Jumlah
                                                    </th>
                                                    <th width="15%">
                                                        Harga Satuan
                                                    </th>
                                                    <th width="15%">
                                                        Total Harga
                                                    </th>
                                                    <th width="14%">
                                                        Keterangan
                                                    </th>
                                                    <th width="5%">
                                                        Act
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="id_body_data">
                                                <?php
                                                $i = 1;
                                                $totqty = 0;
                                                $tothargasatuan = 0;
                                                $tothargaall = 0;
                                                foreach ($rincian_po as $tr) {
                                                    $hargaAll = $tr->qty_rencana * $tr->harga_satuan;
                                                    ?> 
                                                    <tr class="listdata" id="tr<?php echo $i; ?>">
                                                        <td width="7%" style="display:none;">
                                                            <input type="text" class="form-control input-sm" id="id_tempKdTrans<?php echo $i; ?>" name="tempKdTrans<?php echo $i; ?>" readonly="true" value="<?php echo $tr->id_trans_in; ?>">
                                                        </td>
                                                        <td width="7%" style="display:none;">
                                                            <input type="text" class="form-control input-sm" id="id_tempKdProduk<?php echo $i; ?>" name="tempKdProduk<?php echo $i; ?>" readonly="true" value="<?php echo $tr->id_produk; ?>">
                                                        </td>
                                                        <td width="7%"  style="display:none;">
                                                            <input type="text" class="form-control input-sm" id="id_tempKdStorage<?php echo $i; ?>" name="tempKdStorage<?php echo $i; ?>" readonly="true" value="<?php echo $tr->id_storage; ?>">
                                                        </td>
                                                        <td width="10%">
                                                            <input type="text" class="form-control input-sm" id="id_tempProduk<?php echo $i; ?>" name="tempProduk<?php echo $i; ?>" readonly="true" value="<?php echo $tr->nama_produk; ?>">
                                                        </td>
                                                        <td width="10%">
                                                            <input type="text" class="form-control input-sm" id="id_tempStorage<?php echo $i; ?>" name="tempStorage<?php echo $i; ?>" readonly="true" value="<?php echo $tr->nama_storage; ?>">
                                                        </td>
                                                        <td width="10%">
                                                            <input type="text" class="form-control input-sm kanan" id="id_tempQty<?php echo $i; ?>" name="tempQty<?php echo $i; ?>" readonly="true" value="<?php echo number_format($tr->qty_rencana, 2); ?>">
                                                        </td>
                                                        <td width="15%">
                                                            <input type="text" class="form-control input-sm kanan" id="id_tempHargaSatuan<?php echo $i; ?>" name="tempHargaSatuan<?php echo $i; ?>" readonly="true" value="<?php echo number_format($tr->harga_satuan, 2); ?>">
                                                        </td>
                                                        <td width="15%">
                                                            <input type="text" class="form-control input-sm kanan" id="id_tempHargaAll<?php echo $i; ?>" name="tempHargaAll<?php echo $i; ?>" readonly="true" value="<?php echo number_format($hargaAll, 2); ?>">
                                                        </td>
                                                        <td width="14%">
                                                            <input type="text" class="form-control input-sm" id="id_tempKet<?php echo $i; ?>" name="tempKet<?php echo $i; ?>" readonly="true" value="<?php echo $tr->keterangan; ?>">
                                                        </td>
                                                        <td width="5%">
                                                            <a href="#" class="btn red btn-sm" onclick="hapusBaris('tr<?php echo $i; ?>')"><i class="fa fa-minus fa-fw"/></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                    $totqty = $totqty + $tr->qty_rencana;
                                                    $tothargasatuan = $tothargasatuan + $tr->harga_satuan;
                                                    $tothargaall = $tothargaall + $hargaAll;
                                                }
                                                ?>    
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2" style="display:none;"></td>
                                                    <td colspan="2"><strong>Total</strong></td>
                                                    <td ><input value="<?php echo number_format($totqty, 2); ?>" type="text" readonly="true" class="form-control input-sm kanan" id="id_totalKg" name="totalKg"></td>
                                                    <td ><input value="<?php echo number_format($tothargasatuan, 2); ?>" type="text" readonly="true" class="form-control input-sm kanan" id="id_totalHargaSatuan" name="totalHargaSatuan"></td>
                                                    <td ><input value="<?php echo number_format($tothargaall, 2); ?>" type="text" readonly="true" class="form-control input-sm kanan" id="id_totalHargaAll" name="totalHargaAll"></td>
                                                    <td colspan="2"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-actions ">
                                        <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                            <!--<i class="fa fa-check"></i>--> Simpan
                                        </button>
                                        <button id="id_btnBatal" type="button" class="btn default hidden">Batal</button>
                                        <a href="<?php echo base_url('transaksi/trans_masuk_po/home/'); ?>" id="" type="button" class="btn default ">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    

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
<div class="row">
    <div class="col-md-6">

    </div>
</div>

<!-- END PAGE CONTENT-->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url('metronic/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('metronic/global/plugins/excanvas.min.js'); ?>"></script> 
<![endif]-->
<script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/js.cookie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/bootstrap-toastr/toastr.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/scripts/datatable.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/datatables/datatables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'); ?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<?php include "app.min.inc.php"; ?>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url('metronic/layouts/layout4/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/layouts/layout4/scripts/demo.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/layouts/global/scripts/quick-sidebar.min.js'); ?>" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url('metronic/additional/start.js'); ?>" type="text/javascript"></script>
<script>
                                                            
                                                            App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
                                                                ComponentsDateTimePickers.init();
                                                                ComponentsSelect2.init();
                                                                $("input[readonly='true']").focus(function () {
                                                                    $(this).next();
                                                                });
                                                            });
                                                            $(document).keyup(function (e) {
                                                                if (e.which === 36) {
                                                                    $('#id_btnModalTambah').trigger('click');
                                                                } else if (e.which == 35) {
                                                                    $('#id_btnAddCpa').trigger('click');
                                                                }
                                                            });
                                                           
                                                            //Ready Doc
                                                            btnStart();
                                                            readyToStart();
                                                            tglTransStart();
                                                            $("#id_tgltrans").focus();

                                                            $("#id_btnSimpan").click(function () {
                                                                $('#idTmpAksiBtn').val('1');
                                                            });

                                                            $('#id_btnBatal').click(function () {
                                                                btnStart();
                                                                resetForm();
                                                                readyToStart();
                                                                tglTransStart();
                                                                $('#id_body_data').empty();
                                                            });
                                                            function hitungBerat() {
                                                                var beratMolindo = parseFloat(CleanNumber($('#id_beratMolindo').val()));
                                                                var bruto = parseFloat(CleanNumber($('#id_bruto').val()));
                                                                var tarra = parseFloat(CleanNumber($('#id_tarra').val()));
                                                                var netto = bruto - tarra;
                                                                var selisih = netto  - beratMolindo;
                                                                $('#id_netto').val(number_format(netto, 2));
                                                                $('#id_selisihKg').val(number_format(selisih, 2));
                                                                //var fkLt = parseFloat(CleanNumber($('#idSatuanLt').val()));
                                                                //var selisihLt = selisih * fkLt;
                                                                //$('#id_selisihLt').val(number_format(selisihLt, 2));
                                                                var selisihPersen = selisih / beratMolindo * 100;
                                                                $('#id_selisihPersen').val(number_format(selisihPersen, 2));

                                                                $('#id_produkKg').val(number_format(netto, 2));
                                                                //hitungBeratMdl();
                                                            }
                                                            function hitungBeratMdl() {
                                                                var kg = parseFloat(CleanNumber($('#id_produkKg').val()));
                                                                var fkLt = parseFloat(CleanNumber($('#idSatuanLt').val()));
                                                                var fkDrum = parseFloat(CleanNumber($('#idSatuanDrum').val()));

                                                                var lt = kg * fkLt;
                                                                $('#id_produkLt').val(number_format(lt, 2));

                                                                var drum = kg * fkDrum;
                                                                $('#id_produkDrum').val(number_format(drum, 2));

                                                            }
                                                            function kosongDetail() {
                                                                $('.kosongTextDetail').text('');
                                                                $('.kosongDetail').select2("val", "");
                                                                $('.kosongNomorDetail').val('0.00');
                                                                $('.kosongNomor1Detail').val('0');
                                                            }
                                                            function hitungTotalHarga() {
                                                                var jmlUnit = parseFloat(CleanNumber($('#id_produkKg').val()));
                                                                var hargaSatuan = parseFloat(CleanNumber($('#id_hargaSatuan').val()));
                                                                var hargaTotal = jmlUnit * hargaSatuan;
                                                                //alert(hargaTotal);
                                                                $('#id_hargaTotal').text('    ' + number_format(hargaTotal, 2));
                                                            }

                                                            $(".cls_hitungBerat").focusout(function () {
                                                                hitungBerat();
                                                            });
                                                            $(".cls_hitungBeratMdl").focusout(function () {
                                                                hitungBeratMdl();
                                                            });
                                                            $(".cls_hitungTotalHarga").focusout(function () {
                                                                hitungTotalHarga();
                                                            });

                                                            $("#id_produk").change(function () {
                                                                var idProduk = $(this).val();
                                                                getDescProduk(idProduk);
                                                            });
                                                            function getDescProduk(idProduk) {
                                                                ajaxModal();
                                                                if (idProduk != '') {
                                                                    $.post("<?php echo site_url('transaksi/trans_masuk_po/getDescProduk'); ?>",
                                                                            {
                                                                                'idProduk': idProduk
                                                                            }, function (data) {
                                                                        if (data.baris == 1) {
                                                                            $('#id_storage').select2("val", data.id_storage);
                                                                            $('#idSatuanLt').val(data.satuan_lt);
                                                                            $('#idSatuanMl').val(data.satuan_ml);
                                                                            $('#idSatuanGr').val(data.satuan_gr);
                                                                            $('#idSatuanDrum').val(data.satuan_drum);
                                                                            getDescStorage(data.id_storage);
                                                                            /*
                                                                             $('#').val(data.); */
                                                                        } else {
                                                                            alert('Data tidak ditemukan!');
                                                                            $('#id_btnBatal').trigger('click');
                                                                        }
                                                                    }, "json");
                                                                }//if kd<>''
                                                            }
                                                            $("#id_storage").change(function () {
                                                                var idStorage = $(this).val();
                                                                getDescStorage(idStorage);
                                                            });
                                                            function getDescStorage(idStorage) {
                                                                ajaxModal();
                                                                if (idStorage != '') {
                                                                    $.post("<?php echo site_url('transaksi/trans_masuk_po/getDescStorage'); ?>",
                                                                            {
                                                                                'idStorage': idStorage
                                                                            }, function (data) {
                                                                        if (data.baris == 1) {
                                                                            $('#id_jnsStorage').val(data.nama_jns_storage);
                                                                            /*
                                                                             $('#').val(data.); */
                                                                        } else {
                                                                            alert('Data tidak ditemukan!');
                                                                        }
                                                                    }, "json");
                                                                }//if kd<>''
                                                            }
                                                            $('#id_btnNext1').click(function () {
                                                                $('.linav').removeClass("active");
                                                                $('#linav2').addClass("active in");
                                                                $('.anavitab').attr("aria-expanded", "false");
                                                                $('#navitab_2_2').attr("aria-expanded", "true");
                                                                $('.tab-pane').removeClass("active in");
                                                                $('#tab_2_2').addClass("active in");
                                                            });
                                                            $('#id_btnNext2').click(function () {
                                                                $('.linav').removeClass("active");
                                                                $('#linav3').addClass("active in");
                                                                $('.anavitab').attr("aria-expanded", "false");
                                                                $('#navitab_2_3').attr("aria-expanded", "true");
                                                                $('.tab-pane').removeClass("active in");
                                                                $('#tab_2_3').addClass("active in");
                                                            });

                                                            function hapusBaris(noRow) {
                                                                if (document.getElementById(noRow) != null) {

                                                                    var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));
                                                                    var totalLt = parseFloat(CleanNumber($('#id_totalHargaSatuan').val()));
                                                                    var totalDrum = parseFloat(CleanNumber($('#id_totalHargaAll').val()));

                                                                    var jmlKgOld = $('#' + noRow).find("td input").eq(5).val();
                                                                    jmlKgOld = parseFloat(CleanNumber(jmlKgOld));
                                                                    var jmlLtOld = $('#' + noRow).find("td input").eq(6).val();
                                                                    jmlLtOld = parseFloat(CleanNumber(jmlLtOld));
                                                                    var jmlDrumOld = $('#' + noRow).find("td input").eq(7).val();
                                                                    jmlDrumOld = parseFloat(CleanNumber(jmlDrumOld));

                                                                    totalKg = totalKg - jmlKgOld;
                                                                    totalLt = totalLt - jmlLtOld;
                                                                    totalDrum = totalDrum - jmlDrumOld;

                                                                    $('#id_totalKg').val(number_format(totalKg, 2));
                                                                    $('#id_totalHargaSatuan').val(number_format(totalLt, 2));
                                                                    $('#id_totalHargaAll').val(number_format(totalDrum, 2));

                                                                    $('#' + noRow).remove();

                                                                    var i = $('#idTxtTempLoop').val();
                                                                    i = parseInt(i);
                                                                    i = i - 1;
                                                                    $('#idTxtTempLoop').val(i);
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
                                                                    url: "<?php echo base_url(); ?>transaksi/trans_masuk_po/simpan",
                                                                    data: dataString,
                                                                    success: function (data) {
                                                                        $('#id_btnSimpan').attr("disabled", true);
                                                                        //$('#id_btnBatal').trigger('click');
                                                                        //readyToStart();
                                                                        UIToastr.init(data.tipePesan, data.pesan);
                                                                        /*
                                                                         $('.linav').removeClass("active");
                                                                         $('#linav1').addClass("active in");
                                                                         $('.anavitab').attr("aria-expanded", "false");
                                                                         $('#navitab_2_1').attr("aria-expanded", "true");
                                                                         $('.tab-pane').removeClass("active in");
                                                                         $('#tab_2_1').addClass("active in");
                                                                         */
                                                                        $('#id_idMaster').val(data.idMaster);
                                                                    }

                                                                });
                                                                event.preventDefault();
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
                                                                    window.open("<?php echo base_url('transaksi/trans_masuk_po/cetakSTB/'); ?>/" + masterId, '_blank');//+ idAdvance + masterId
                                                                }
                                                            }


</script>


<!-- END JAVASCRIPTS -->