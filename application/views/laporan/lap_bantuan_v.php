
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
                    <!-- <a href="javascript:;" class="btn btn-default btn-sm" onclick="download_excel();">
                        <i class="fa fa-file-excel-o"></i> Download Excel </a>
                    <a href="javascript:;" class="btn btn-default btn-sm" onclick="cetakall();">
                        <i class="fa fa-print"></i> Cetak All </a> -->
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
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tgl Mulai</label>
                                <input type="text" id="id_tgl_mulai" name="tgl_mulai" class="form-control input-sm date-picker" data-date-format="dd-mm-yyyy" require>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tgl Selesai</label>
                                <input type="text" id="id_tgl_selesai" name="tgl_selesai" class="form-control input-sm date-picker" data-date-format="dd-mm-yyyy" require>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="cetak()"><i class="fa fa-print"></i> Cetak</button>
                    <!--END ROW 1 -->
            </div>
        </div>
        <!-- end <div class="portlet green-meadow box"> -->
    </div>
    <!-- end <div class="col-md-6"> -->
    <!-- end <div class="col-md-6"> -->
</div>


<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('laporan/js/lap_bantuan.js.php'); ?>

