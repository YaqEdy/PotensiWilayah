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
                        <?php
                        foreach ($notif as $tr) {
                            echo $tr;
                        }
                        ?>

                    </span>
                </div>
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Data customer </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Rincian barang</a>
                    </li>
                    <li class="linav" id="linav3">
                        <a href="#tab_2_3" data-toggle="tab" id="navitab_2_3" class="anavitab">
                            Rincian data packaging</a>
                    </li>
                    <li class="linav" id="linav4">
                        <a href="#tab_2_4" data-toggle="tab" id="navitab_2_4" class="anavitab">
                            Rincian data distribusi</a>
                    </li>
                </ul>

                <form class="" role="form" method="post"
                      action="<?php echo base_url('transaksi/trans_app_kirim/home'); ?>" id="id_formAdvance">
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_2_1">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal</label> 
                                        <input id="id_tgltrans" required="required"
                                               class="form-control input-sm date-picker" type="text"
                                               name="tglTrans" data-date-format="dd-mm-yyyy" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>No SO : </label>
                                        <span class="help-block"><strong><?php echo $info_so[0]->id_master_out; ?> </strong></span>
                                        <input id="id_idMaster"
                                               class="form-control input-sm hidden" type="text"
                                               name="idMaster" value="<?php echo $info_so[0]->id_master_out; ?>" />
                                    </div>
                                </div>
                                <!--end <div class="col-md-6"> 1 -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Customer : </label>
                                        <span class="help-block"><strong><?php echo $info_so[0]->nama_cust; ?> </strong></span>
                                    </div>     
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>No PO Customer : </label>
                                        <span class="help-block"><strong><?php echo $info_so[0]->no_po_cust; ?> </strong></span>
                                    </div>     
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal Order : </label>
                                        <span class="help-block"><strong><?php echo date('d-m-Y', strtotime($info_so[0]->tgl_trans)); ?> </strong></span>
                                    </div>     
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal Kirim : </label>
                                        <span class="help-block"><strong><?php echo date('d-m-Y', strtotime($info_so[0]->etd)); ?> </strong></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tgl Jatuh Tempo : </label>
                                        <span class="help-block"><strong><?php echo date('d-m-Y', strtotime($info_so[0]->eta)); ?> </strong></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Jenis doc : </label>
                                        <span class="help-block"><strong><?php echo $info_so[0]->nama_jnsdoc; ?> </strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>No Cukai : </label>
                                        <span class="help-block"><strong><?php echo $info_so[0]->no_cukai; ?> </strong></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>No batch : </label>
                                        <span class="help-block"><strong><?php echo $info_so[0]->no_batch; ?> </strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        No surat jalan :
                                        <h2><strong id="id_noSuratJalan" class="kosongTextDetail"></strong></h2><span></span>

                                    </div>     
                                </div>

                            </div>    
                            <div class="row">
                                <!-- HIDDEN INPUT -->
                                <input type="text" id="idTmpAksiBtn" class="hidden">
                                <input type="text" id="idTmpBtnKyw" class="hidden">
                                <!-- END HIDDEN INPUT -->
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
                            <!-- HIDDEN INPUT -->
                            <input type="text" value="<?php echo $jml_rincian_pack['jml']; ?>" id="idTxtTempLoop" name="txtTempLoop" class="form-control hidden ">
                            <input type="text" id="idTmpAksiBtn" class="hidden">
                            <input type="text" id="idTmpBtnKyw" class="hidden">
                            <!-- END HIDDEN INPUT -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-body">
                                        <table class="table table-striped table-hover table-bordered" id="id_tabelRincianSO">
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
                                                    <th width="14%">
                                                        Keterangan
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $totqty = 0;
                                                foreach ($rincian_so as $tr) {
                                                    ?> 
                                                    <tr class="listdata" id="tr<?php echo $i; ?>">
                                                        <td width="7%" style="display:none;">
                                                            <input type="text" class="form-control input-sm"  readonly="true" value="<?php echo $tr->id_trans_out; ?>">
                                                        </td>
                                                        <td width="7%" style="display:none;">
                                                            <input type="text" name="tempKdProduk<?php echo $i; ?>" class="form-control input-sm"  readonly="true" value="<?php echo $tr->id_produk; ?>">
                                                        </td>
                                                        <td width="7%"  style="display:none;">
                                                            <input type="text" name="tempKdStorage" class="form-control input-sm"  readonly="true" value="<?php echo $tr->id_storage; ?>">
                                                        </td>
                                                        <td width="10%">
                                                            <input type="text" class="form-control input-sm"  readonly="true" value="<?php echo $tr->nama_produk; ?>">
                                                        </td>
                                                        <td width="10%">
                                                            <input type="text" class="form-control input-sm" readonly="true" value="<?php echo $tr->nama_storage; ?>">
                                                        </td>
                                                        <td width="10%">
                                                            <input type="text" name="tempQty<?php echo $i; ?>" class="form-control input-sm kanan" readonly="true" value="<?php echo number_format($tr->qty_rencana, 2); ?>">
                                                        </td>
                                                        <td width="14%">
                                                            <input type="text" class="form-control input-sm" readonly="true" value="<?php echo $tr->keterangan; ?>">
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                    $totqty = $totqty + $tr->qty_rencana;
                                                }
                                                ?>    
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2" style="display:none;"></td>
                                                    <td colspan="2"><strong>Total</strong></td>
                                                    <td ><input value="<?php echo number_format($totqty, 2); ?>" type="text" readonly="true" class="form-control input-sm kanan" id="id_totalKg" name="totalKg"></td>
                                                    <td colspan="1"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
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
                                                        Pack
                                                    </th>
                                                    <th width="10%">
                                                        Storage
                                                    </th>
                                                    <th width="10%">
                                                        Jumlah
                                                    </th>
                                                    <th width="14%">
                                                        Keterangan
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="id_body_data">
                                                <?php
                                                $i = 1;
                                                $totqty = 0;
                                                if ($rincian_pack <> 0) {
                                                    foreach ($rincian_pack as $tr) {
                                                        ?> 
                                                        <tr class="listdata" id="tr<?php echo $i; ?>">
                                                            <td width="7%" style="display:none;">
                                                                <input type="text" class="form-control input-sm"  readonly="true" value="<?php echo $tr->id_trans_out; ?>">
                                                            </td>
                                                            <td width="7%" style="display:none;">
                                                                <input type="text" class="form-control input-sm"  readonly="true" value="<?php echo $tr->id_produk; ?>">
                                                            </td>
                                                            <td width="7%"  style="display:none;">
                                                                <input type="text" class="form-control input-sm"  readonly="true" value="<?php echo $tr->id_storage; ?>">
                                                            </td>
                                                            <td width="10%">
                                                                <input type="text" class="form-control input-sm"  readonly="true" value="<?php echo $tr->nama_produk; ?>">
                                                            </td>
                                                            <td width="10%">
                                                                <input type="text" class="form-control input-sm" readonly="true" value="<?php echo $tr->nama_storage; ?>">
                                                            </td>
                                                            <td width="10%">
                                                                <input type="text" class="form-control input-sm kanan" readonly="true" value="<?php echo number_format($tr->qty, 2); ?>">
                                                            </td>
                                                            <td width="14%">
                                                                <input type="text" class="form-control input-sm" readonly="true" value="<?php echo $tr->keterangan; ?>">
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                        $totqty = $totqty + $tr->qty;
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2" style="display:none;"></td>
                                                    <td colspan="2"><strong>Total</strong></td>
                                                    <td ><input value="<?php echo number_format($totqty, 2); ?>" type="text" readonly="true" class="form-control input-sm kanan" id="id_totalKg" name="totalKg"></td>
                                                    <td colspan="1"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="tab_2_4">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-hover table-bordered" id="id_tabelRincianPack">
                                        <thead>
                                            <tr>
                                                <th width="10%">
                                                    Driver
                                                </th>
                                                <th width="10%">
                                                    Mobil
                                                </th>

                                                <th width="10%">
                                                    Jenis Mobil
                                                </th>

                                                <th width="10%">
                                                    Jenis Segel
                                                </th>

                                                <th width="10%">
                                                    Kepemilikan
                                                </th>
                                                <th width="5%">
                                                    Keterangan
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody id="id_body_data_dis">

                                        </tbody>

                                    </table>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-actions ">
                                        <?php
                                        if (sizeof($notif) > 0) {
                                            
                                        } else {
                                            ?>
                                            <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                                <i class="fa fa-check"></i> Approve
                                            </button>
                                        <?php } ?>
                                        <a href="<?php echo base_url('transaksi/trans_app_kirim/home'); ?>" class="btn default">Batal</a>
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
<!-- END THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url('metronic/additional/start.js'); ?>" type="text/javascript"></script>

<script>

                        App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
                            ComponentsDateTimePickers.init();
                            ComponentsSelect2.init();
                            $("input[readonly='true']").focus(function () {
                                $(this).next();
                            });
                            var status = "<?php echo $status; ?>";
                            var noSO = "<?php echo $noSO; ?>";
                            getDataDistribusi(noSO);
                            if (status == 1) {
                                $('#id_btnSimpan').attr('disabled', true);
                                $('#id_btnUbah').attr("disabled", false);
                            } else {
                                $('#id_btnSimpan').attr('disabled', false);
                                $('#id_btnUbah').attr("disabled", true);
                            }

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

                        function getDataDistribusi(noSO) {
                            ajaxModal();
                            if (noSO != '') {
                                $.post("<?php echo site_url('/transaksi/distribusi/getDataDistribusi'); ?>",
                                        {
                                            'noSO': noSO
                                        }, function (data) {
                                    if (data.data_cpa.length > 0) {
                                        //$('#idTxtTempLoop').val(data.data_cpa.length);
                                        for (i = 0; i < data.data_cpa.length; i++) {
                                            var x = i + 1;
                                            //var idCpa           = data.data_cpa[i].id_cpa;
                                            var driver = data.data_cpa[i].nama_pengirim;
                                            var noMobil = data.data_cpa[i].no_mobil;
                                            var jnsMobil = data.data_cpa[i].id_jnsmobil;
                                            var txtJnsMobil = data.data_cpa[i].nama_jnsmobil;
                                            var jnsSegel = data.data_cpa[i].id_jnssegel;
                                            var txtJnsSegel = data.data_cpa[i].nama_jnssegel;
                                            var jnsMobilSw = data.data_cpa[i].id_jnsmobilsewa;
                                            //var txtJnsMobilSw = "";//data.data_cpa[i].nama_jnsmobilsw;
                                            if (jnsMobilSw == '0') {
                                                var txtJnsMobilSw = "Milik Sendiri";
                                            } else {
                                                var txtJnsMobilSw = "Sewa";
                                            }
                                            var ket = data.data_cpa[i].keterangan;

                                            tr = '<tr class="listdata" id="tr' + i + '">';
                                            tr += '<td ><input type="text" class="form-control input-sm" id="id_tempDriver' + i + '" name="tempDriver' + i + '" readonly="true" value="' + driver + '"></td>';
                                            tr += '<td ><input type="text" class="form-control input-sm" id="id_tempNoMobil' + i + '" name="tempNoMobil' + i + '" readonly="true" value="' + noMobil + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtJnsMobil' + i + '" name="tempTxtJnsMobil' + i + '" readonly="true" value="' + txtJnsMobil + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtJnsSegel' + i + '" name="tempTxtJnsSegel' + i + '" readonly="true" value="' + txtJnsSegel + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtJnsMobilSw' + i + '" name="tempTxtJnsMobilSw' + i + '" readonly="true" value="' + txtJnsMobilSw + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempKet' + i + '" name="tempKet' + i + '" readonly="true" value="' + ket + '"></td>';
                                            tr += '</tr>';

                                            $('#id_body_data_dis').append(tr);
                                        }
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        //alert('Data tidak ditemukan!');
                                        //$('#id_btnBatal').trigger('click');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        function ajaxSubmitAdvance() {
                            ajaxModal();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "<?php echo base_url(); ?>transaksi/trans_app_kirim/simpan",
                                data: dataString,
                                success: function (data) {
                                    $('#id_btnSimpan').attr('disabled', true);
                                    $('#id_noSuratJalan').text(data.noSuratJalan);
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
                                }

                            });
                        }

                        $('#id_formAdvance').submit(function (event) {
                            dataString = $("#id_formAdvance").serialize();
                            /*var jmlCpa = $('#idTxtTempLoop').val();
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
                            */
                            var aksiBtn = $('#idTmpAksiBtn').val();
                            if (aksiBtn == '1') {
                                var r = confirm('Anda yakin menyimpan data ini?');
                                if (r == true) {
                                    ajaxSubmitAdvance();
                                } else {//if(r)
                                    return false;
                                }
                            }


                            event.preventDefault();
                        });
                        function cetak() {
                            var masterId = $('#id_idMaster').val();
                            if (masterId == '') {
                                alert('Master id kosong.');
                            } else {
                                window.open("<?php echo base_url('transaksi/trans_app_kirim/cetakSuratJalan/'); ?>/" + masterId, '_blank');//+ idAdvance + masterId
                            }
                        }

</script>


<!-- END JAVASCRIPTS -->