<!-- BEGIN PAGE BREADCRUMB -->
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
                      action="<?php echo base_url('lap_rekap_stock/lap_rekap_stock/home'); ?>" id="id_formAdvance">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Data tanggal</label>

                                    <input id="id_tglAwalDataDaftar" required="required" placeholder="dd-mm-yyyy"
                                           class="form-control input-sm date-picker cls_tglbulanlalu" type="text"
                                           name="tglAwalDataDaftar" data-date-format="dd-mm-yyyy" value="<?php echo $this->session->userdata('tgl_d'); ?>"/>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-body">
                                <div class="form-group">
                                    <label >Sampai</label>

                                    <input id="id_tglAkhirDataDaftar" required="required" placeholder="dd-mm-yyyy"
                                           class="form-control input-sm date-picker cls_tglhariini" type="text"
                                           name="tglAkhirDataDaftar" data-date-format="dd-mm-yyyy" value="<?php echo $this->session->userdata('tgl_d'); ?>" />

                                </div>
                            </div>    
                        </div>    
                    </div>
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Suplier</label>
                                    <?php
                                    $data = array();
                                    $data[''] = '';
                                    foreach ($suplier as $row) :
                                        $data[$row['id_spl']] = $row['nama_spl'];
                                    endforeach;
                                    echo form_dropdown('suplier', $data, '', 'id="id_suplier" class="form-control input-sm select2me"');
                                    ?>
                                </div>   
                            </div>
                            <div class="col-md-4">

                            </div>
                        </div>
                        <!-- HIDDEN INPUT -->
                        <input type="text" id="idTmpAksiBtn" class="hidden">
                        <!-- END HIDDEN INPUT -->
                    </div>
                    <!--END ROW 1 -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions ">
                                <a href="javascript:;" class="btn blue" onclick="cetak();">
                                    <i class="fa fa-print"></i> Cetak </a>

                                <button id="id_btnBatal" type="button" class="btn default">Batal</button>

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
                                    jQuery(document).ready(function () {
                                        ComponentsDateTimePickers.init();
                                        ComponentsSelect2.init();

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
                                        resetForm();
                                        readyToStart();
                                        tglTransStart();
                                    });
                                    function cetak() {
                                        var tglAwal = $('#id_tglAwalDataDaftar').val();
                                        var tglAkhir = $('#id_tglAkhirDataDaftar').val();
                                        var suplier = $('#id_suplier').val();//select2('val');
                                        if (suplier==''){suplier='-';}
                                            window.open("<?php echo base_url('laporan/po/cetak/'); ?>/" + suplier +"/"+tglAwal+"/"+tglAkhir, '_blank');//+ idAdvance + masterId
                                        
                                    }
</script>


<!-- END JAVASCRIPTS -->