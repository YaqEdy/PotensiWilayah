<!-- BEGIN PAGE BREADCRUMB -->

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <!-- KONTEN DI SINI YA -->
       <!--<img id="id_imgCR" src="<?php /* //echo base_url('metronic/img/rusun05.jpg'); */ ?>" alt=""/>-->
        <h3 class="font-grey-cascade">Dashboard <small>statistics & reports</small></h3>
    </div>

</div>
<!-- BEGIN ROW -->
<div class="row">
    <div class="col-md-12">
       
        <div class="row margin-top-10">
            
            <?php
            //$data['nama_storage'];
            foreach ($stok as $data) {
                ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat2">
                        <div class="display">
                            <div class="number">
                                <h3 class="font-red-sunglo"><?php echo number_format($data['stok_akhir'],2); ?><small class="font-green-sharp"></small></h3>
                                <small class="font-blue-chambray"><?php echo $data['nama_produk']; ?></small><br>
                                <small><?php echo $data['nama_storage']; ?></small>
                            </div>
                            <div class="icon">
                                <i class="icon-pie-chart"></i>
                            </div>
                        </div>
                        <div class="progress-info">
                            <div class="progress">
                                <span style="width: <?php echo $data['progress'] ?>%;" class="progress-bar progress-bar-success green-sharp">
                                    <span class="sr-only"><?php echo $data['progress'] ?>% progress</span>
                                </span>
                            </div>
                            <div class="status">
                                <div class="status-title font-blue-soft">
                                    capacity
                                </div>
                                <div class="status-number">
                                    <?php echo number_format($data['progress'],2) ?>%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?> 

        </div>
        <!-- BEGIN CHART PORTLET-->
<!--        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-green-haze"></i>
                    <span class="caption-subject bold uppercase font-grey-cascade"> Dashboard stok opname </span>
                    <span class="caption-helper">Rusun yang sudah disewa</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                 BEGIN PAGE CONTENT INNER 

                <div class="row">


                </div>


                 END PAGE CONTENT INNER 

            </div>
        </div>-->
        <!-- END CHART PORTLET-->
    </div>
</div>
<!-- END ROW -->

<!-- END PAGE CONTENT-->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url('metronic/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('metronic/global/plugins/excanvas.min.js'); ?>"></script> 
<![endif]-->
<script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('metronic/global/plugins/jquery-ui/jquery-ui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/uniform/jquery.uniform.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url('metronic/global/plugins/amcharts/amcharts/amcharts.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/amcharts/amcharts/serial.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/amcharts/amcharts/pie.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/amcharts/amcharts/radar.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/amcharts/amcharts/themes/light.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/amcharts/amcharts/themes/patterns.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/amcharts/amcharts/themes/chalk.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/amcharts/ammap/ammap.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/amcharts/ammap/maps/js/indonesiaHigh.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/amcharts/amstockcharts/amstock.js'); ?>" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url('metronic/global/scripts/metronic.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout4/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/admin/layout4/scripts/demo.js'); ?>" type="text/javascript"></script>
<script src="<?php //echo base_url('metronic/admin/pages/scripts/charts-amcharts.js');    ?>" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        ChartsAmcharts.init();

    });
// MENU OPEN
    var judul_menu = $('#id_a_menu_<?php echo $menu_id; ?>').text();
    $('#id_judul_menu').text(judul_menu);
    $(".menu_root").removeClass('start active open');
    $("#menu_root_<?php echo $menu_id; ?>").addClass('start active open');
    // END MENU OPEN


</script>
<!-- END JAVASCRIPTS -->

