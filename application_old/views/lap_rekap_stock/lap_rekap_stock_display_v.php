<!-- BEGIN PAGE BREADCRUMB -->
<!--

-->
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs  font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase"><?php echo $menu_header; ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="reload" id="id_tools_reload">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>

                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <span id="event_result">

                    </span>
                </div>

                <div class="row">
                    <div class="form-body">
                        <div class="col-md-12">

                            <?php
                            $seq = 1;
                            $nama_storage = '';
                            foreach ($datarusun as $data) {
                                ?>
                                <?php
                                if ($data['nama_storage'] <> $nama_storage) {
                                    ?>
                                    <div class="note note-success" style="height:70px;">
                                        <h4 class="block"><?php echo $data['nama_storage']; ?></h4>
                                    </div> 
                                    <?php
                                }
                                ?>

                                <table class="table table-bordered">
                                    <tr>
                                        <th>Produk</th>
                                        <th>Stok awal</th>
                                        <th>Masuk</th>
                                        <th>Masuk campuran</th>
                                        <th>Keluar</th>
                                        <th>Keluar campuran</th>
                                        <th>Stok akhir</th>
                                        <th>Act</th>
                                    </tr>
                                    <tr>
                                        <td align="right"><?php echo $data['nama_produk']; ?></td>
                                        <td align="right"><?php echo number_format($data['saldo_awal'], 2); ?></td>
                                        <td align="right"><?php echo number_format($data['masuk'], 2); ?></td>
                                        <td align="right"><?php echo number_format($data['masuk_campur'], 2); ?></td>
                                        <td align="right"><?php echo number_format($data['keluar'], 2); ?></td>
                                        <td align="right"><?php echo number_format($data['keluar_campur'], 2); ?></td>
                                        <td align="right"><?php echo number_format($data['stok_akhir'], 2); ?></td>
                                        <td align="center">
                                            <a href="#" class="btn blue btn-sm" data-target="#idDivDetail<?php echo $seq; ?>"
                                               id="id_btnModalTambah" data-toggle="modal">...</a>
                                        </td>
                                    </tr>

                                </table>

                                <!--  MODAL Data Karyawan -->
                                <div class="modal fade draggable-modal" id="idDivDetail<?php echo $seq; ?>" tabindex="-1"  role="basic" aria-hidden="true">
                                    <div class="modal-dialog  modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Data rincian masuk keluar produk </h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="scroller" style="height:250px; ">
                                                    <div class="row">
                                                        
                                                                <div class="col-md-12">
                                                                    <table class="table table-bordered">
                                                                        <th>No</th>
                                                                        <th>Produk</th>
                                                                        <th>Tanggal</th>
                                                                        <th>Masuk dr supplier</th>
                                                                        <th>Masuk dr campuran</th>
                                                                        <th>Keluar ke customer</th>
                                                                        <th>Keluar ke campuran</th>

                                                                        <?php echo lap($data['child']); ?>

                                                                    </table>
                                                                </div>   

                                                    </div>
                                                    <!-- END ROW-->
                                                </div>
                                                <!-- END SCROLLER-->
                                            </div>
                                            <!-- END MODAL BODY-->
                                            <div class="modal-footer">
                                                <button type="button" class="btn default" data-dismiss="modal" id="id_btnBatalCpa"><i class="fa fa-times"></i>&nbsp;Tutup</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!--  END  MODAL Data Karyawan -->


                                <?php
                                $nama_storage = $data['nama_storage'];
                                $seq++;
                            }
                            ?>                               
                        </div>
                    </div>
                </div>
                <!--END ROW 1 -->

            </div>
        </div>
        <!-- end <div class="portlet green-meadow box"> -->
    </div>

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
    jQuery(document).ready(function () {
    });
    //$(function () {
    var judul_menu = $('#id_a_menu_<?php echo $menu_id; ?>').text();
    $('#id_judul_menu').text(judul_menu);
    // MENU OPEN
    $(".menu_root").removeClass('start active open');
    $("#menu_root_<?php echo $menu_parent; ?>").addClass('start active open');
    // END MENU OPEN
    $('[data-toggle="popover"]').popover();
    btnStart();
    readyToStart()

    function OpenInNewTab(url)
    {
        var win = window.open(url, '_blank');
        win.focus();
    }

    $(".client-item").click(function () {
        var url = $(this).find("img").attr("href");
        window.open(url, "_self");
        return false;
    });



</script>


<!-- END JAVASCRIPTS -->