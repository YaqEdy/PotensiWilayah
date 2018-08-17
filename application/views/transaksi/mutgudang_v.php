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

                <form role="form" method="post"
                      action="<?php echo base_url('transaksi/trans_po/home'); ?>" id="id_formAdvance">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-2">
                                <div class="form-group">

                                    <input id="id_idMaster" 
                                           class="form-control input-sm hidden" type="text"
                                           name="idMaster" />
                                    <label>Tanggal mutasi</label> 
                                    <input id="id_tgltrans" required="required"
                                           class="form-control input-sm date-picker" type="text"
                                           name="tglTrans" data-date-format="dd-mm-yyyy" />

                                </div>

                            </div>
                            <!--end <div class="col-md-6"> 1 -->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jumlah produk (Packsize 1)</label>
                                    <input id="id_produkKg" class="form-control input-sm nomor kosongNomorDetail"
                                           type="text" name="produkKg" placeholder=""/>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea rows="2" cols="" name="keteranganCPA"  id="id_keteranganCPA" class="form-control input-sm kosongTextDetail"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">


                            </div>
                        </div>
                        <!-- HIDDEN INPUT -->
                        <input type="text" id="idTmpAksiBtn" class="hidden">
                        <!-- END HIDDEN INPUT -->
                    </div>
                    <h3>Dari</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Produk</label>
                                <?php
                                $data = array();
                                $data[''] = '';
                                foreach ($produk as $row) :
                                    $data[$row['id_produk']] = $row['nama_produk'];
                                endforeach;
                                echo form_dropdown('produk', $data, '', 'id="id_produk" class="form-control select2me " ');
                                ?>
                            </div>    
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Storage</label>
                                <?php
                                $data = array();
                                $data[''] = '';
                                foreach ($storage as $row) :
                                    $data[$row['id_storage']] = $row['nama_storage'];
                                endforeach;
                                echo form_dropdown('storage_from', $data, '', 'id="id_storage_from" class="form-control select2me " disabled');
                                ?>
                            </div>
                        </div>
                        

                        <div class="col-md-4">

                        </div>
                    </div>
                    <h3>Ke</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Produk</label>
                                <?php
                                $data = array();
                                $data[''] = '';
                                foreach ($produk as $row) :
                                    $data[$row['id_produk']] = $row['nama_produk'];
                                endforeach;
                                echo form_dropdown('produk_to', $data, '', 'id="id_produk_to" class="form-control select2me "');
                                ?>
                            </div>      
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Storage</label>
                                <?php
                                $data = array();
                                $data[''] = '';
                                foreach ($storage as $row) :
                                    $data[$row['id_storage']] = $row['nama_storage'];
                                endforeach;
                                echo form_dropdown('storage_to', $data, '', 'id="id_storage_to" class="form-control select2me " disabled');
                                ?>
                            </div>
                        </div>
                        
                        <div class="col-md-4">

                        </div>
                    </div>

                    <!-- END ROW-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions ">
                                <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                    <!--<i class="fa fa-check"></i>--> Simpan
                                </button>
                                <button id="id_btnBatal" type="button" class="btn default">Clear</button>
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

<!--  END  MODAL Data Supplier -->
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
                        var ComponentsSelect2 = function () {
                            var e = function () {

                            };
                            return{init: function () {
                                    e();
                                }};
                        }();
                        var ComponentsDateTimePickers = function () {
                            var t = function () {
                                jQuery().datepicker && $(".date-picker").datepicker({rtl: App.isRTL(), orientation: "bottom", autoclose: !0}), $(document).scroll(function () {
                                    //$("#form_modal2 .date-picker").datepicker("place")
                                });
                            };
                            return{init: function () {
                                    t();
                                }};
                        }();

                        App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
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

                        $("#id_btnSimpan").click(function () {
                            $('#idTmpAksiBtn').val('1');
                        });

                        $('#id_btnBatal').click(function () {
                            btnStart();
                            resetForm();
                            readyToStart();
                            tglTransStart();
                            kosongDetail();

                        });

                        function kosongDetail() {
                            $('.kosongTextDetail').text('');
                            $('#id_storage_from').select2("val", "");
                            $('#id_storage_to').select2("val", "");
                            $('#id_produk').select2("val", "");
                            $('#id_produk_to').select2("val", "");
                            $('.kosongNomorDetail').val('0.00');
                            $('.kosongNomor1Detail').val('0');
                        }
                        
                        /*
                         $("#id_produk").change(function () {
                         var idProduk = $(this).val();
                         if (idProduk != '') {
                         $('#id_produk_to').select2("val", idProduk);
                         } 
                         });
                         */
                        function ajaxSubmitAdvance() {
                            ajaxModal();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "<?php echo base_url(); ?>transaksi/mutgudang/simpan",
                                data: dataString,
                                success: function (data) {
                                    $('#id_btnSimpan').attr("disabled", true);
                                    UIToastr.init(data.tipePesan, data.pesan);
                                    $('#id_idMaster').val(data.idMaster);
                                    $('#id_btnBatal').trigger('click');
                                    $('#id_storage_from').attr('disabled',true);
                                    $('#id_storage_to').attr('disabled',true);
                                }
                            });
                        }

                        $('#id_formAdvance').submit(function (event) {
                            var aksiBtn = $('#idTmpAksiBtn').val();
                            if (aksiBtn == '1') {
                                var r = confirm('Anda yakin menyimpan data ini?');
                                if (r == true) {
                                    $('#id_storage_from').attr('disabled',false);
                                    $('#id_storage_to').attr('disabled',false);
                                    dataString = $("#id_formAdvance").serialize();
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
                                window.open("<?php echo base_url('transaksi/trans_po/cetakPO/'); ?>/" + masterId, '_blank');//+ idAdvance + masterId
                            }
                        }
                        $("#id_produk").change(function () {
                            var idProduk = $(this).val();
                            if(idProduk == ''){
                                $('#id_storage_from').select2("val", "");
                            }else{
                                getDescProduk(idProduk);
                            }
                        });
                        function getDescProduk(idProduk) {
                            ajaxModal();
                            if (idProduk != '') {
                                $.post("<?php echo site_url('transaksi/trans_po/getDescProduk'); ?>",
                                        {
                                            'idProduk': idProduk
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_storage_from').select2("val",data.id_storage);
                                    } else {
                                        alert('Data tidak ditemukan!');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        $("#id_produk_to").change(function () {
                            var idProduk = $(this).val();
                            if(idProduk == ''){
                                $('#id_storage_to').select2("val", "");
                            }else{
                                getDescProdukTo(idProduk);
                            }
                            
                        });
                        function getDescProdukTo(idProduk) {
                            ajaxModal();
                            if (idProduk != '') {
                                $.post("<?php echo site_url('transaksi/trans_po/getDescProduk'); ?>",
                                        {
                                            'idProduk': idProduk
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_storage_to').select2("val",data.id_storage);
                                    } else {
                                        alert('Data tidak ditemukan!');
                                    }
                                }, "json");
                            }//if kd<>''
                        }


</script>


<!-- END JAVASCRIPTS -->