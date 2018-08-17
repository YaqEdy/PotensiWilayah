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


                <form class="" role="form" method="post"
                      action="<?php echo base_url('transaksi/ganocukai/home'); ?>" id="id_formAdvance">
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
                                <label>ETD : </label>
                                <span class="help-block"><strong><?php echo date('d-m-Y', strtotime($info_so[0]->etd)); ?> </strong></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ETA : </label>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No cukai : </label>
                                <input id="id_noCukai" required="required"
                                       class="form-control input-lg" type="text"
                                       name="noCukai" value="<?php echo $info_so[0]->no_cukai; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                                       <div class="form-group">
                                            Kuota :
                                            <h2><strong id="id_kuota" class="kosongTextDetail"><?php echo number_format($kuota,2); ?></strong></h2><span></span>
                                            
                                        </div>     
                                    </div>

                    </div>
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
                                            <tr class="listdata">
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
                                                    <?php echo $tr->nama_produk; ?>
                                                </td>
                                                <td width="10%">
                                                    <?php echo $tr->nama_storage; ?>
                                                </td>
                                                <td width="10%" align="right">
                                                    <?php echo number_format($tr->qty_rencana, 2); ?>
                                                </td>
                                                <td width="14%">
                                                    <?php echo $tr->keterangan; ?>
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
                                            <td colspan="2" ><strong>Total</strong></td>
                                            <td align="right"><?php echo number_format($totqty, 2); ?></td>
                                            <td colspan="1"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- HIDDEN INPUT -->
                    <input type="text" id="idTmpAksiBtn" class="hidden">
                    <input type="text" id="idTmpBtnKyw" class="hidden">
                    <!-- END HIDDEN INPUT -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions ">
                                <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                    <!--<i class="fa fa-check"></i>--> Simpan
                                </button>
                                <button name="btnUbah" class="btn yellow" id="id_btnUbah">
                                    <!--<i class="fa fa-check"></i>--> Ubah
                                </button>
                                <a href="<?php echo base_url('transaksi/ganocukai/home'); ?>" id="id_btnBatal"  class="btn default">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>  

        </div>
    </div>
    <!-- end <div class="portlet green-meadow box"> -->
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
<script src="<?php echo base_url('metronic/global/plugins/bootbox/bootbox.min.js'); ?>" type="text/javascript"></script>
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
                        var ComponentsSelect2 = function () {
                            var e = function () {
                            };
                            return{init: function () {
                                    e();
                                }};
                        }();
                        var ComponentsDateTimePickers = function () {
                            var t = function () {
                                jQuery().datepicker && $(".date-picker").datepicker({rtl: App.isRTL(), orientation: "left", autoclose: !0}), $(document).scroll(function () {
                                    //$("#form_modal2 .date-picker").datepicker("place")
                                });
                            };
                            return{init: function () {
                                    t();
                                }};
                        }();

                        App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
                            var noCukai = "<?php echo $no_cukai; ?>";
                            if (noCukai == 0){
                                $('#id_btnSimpan').attr('disabled', false);
                                $('#id_btnUbah').attr("disabled", true);
                            }else{
                                $('#id_btnSimpan').attr('disabled', true);
                                $('#id_btnUbah').attr("disabled", false);
                            }
                            UIBootbox.init();
                            ComponentsDateTimePickers.init();
                            ComponentsSelect2.init();
                            $("input[readonly='true']").focus(function () {
                                $(this).next();
                            });
                        });
                        //$(function () {
                        var judul_menu = $('#id_a_menu_<?php echo $menu_id; ?>').text();
                        $('#id_judul_menu').text(judul_menu);
                        // MENU OPEN
                        $(".menu_root").removeClass('start active open');
                        $("#menu_root_<?php echo $menu_parent; ?>").addClass('start active open');
                        // END MENU OPEN

                        //Ready Doc
                        btnStart();
                        readyToStart();
                        tglTransStart();
                        $("#id_tgltrans").focus();

                        $('#id_btnBatal').click(function () {
                        });

                        function ajaxSubmit() {
                            ajaxModal();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "<?php echo base_url(); ?>transaksi/ganocukai/simpan",
                                data: dataString,
                                success: function (data) {
                                    //$('#id_btnBatal').trigger('click');
                                    $('#id_btnSimpan').attr('disabled',true);
                                    $('#id_btnUbah').attr('disabled',false);
                                    //readyToStart();
                                    UIToastr.init(data.tipePesan, data.pesan);
                                }

                            });

                        }
                        function ajaxUbah() {
                            ajaxModal();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "<?php echo base_url(); ?>transaksi/ganocukai/ubah",
                                data: dataString,
                                success: function (data) {
                                    $('#id_btnSimpan').attr('disabled',true);
                                    $('#id_btnUbah').attr('disabled',false);
                                    //readyToStart();
                                    UIToastr.init(data.tipePesan, data.pesan);
                                }

                            });

                        }

                        $('#id_formAdvance').submit(function (event) {
                            dataString = $("#id_formAdvance").serialize();
                            var aksiBtn = $('#idTmpAksiBtn').val();
                            if (aksiBtn == '1') {
                                bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
                                    if (o == true) {
                                        ajaxSubmit();
                                    }
                                });
                            } else if (aksiBtn == '2') {
                                bootbox.confirm("Apakah anda yakin ubah data ini?", function (o) {
                                    if (o == true) {
                                        ajaxUbah();
                                    }
                                });
                            }
                            event.preventDefault();


                        });


</script>


<!-- END JAVASCRIPTS -->