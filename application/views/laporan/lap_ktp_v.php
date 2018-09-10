
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
                    <!-- <div class="row">
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
                    </div> -->
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <?php
                                    $data = array();
                                    $data[''] = '';
                                    foreach ($ktp as $row) :
                                        $data[$row['id_ktp']] = $row['id_ktp'].' - '.$row['nama_ktp'];
                                    endforeach;
                                    echo form_dropdown('ktp', $data, '', 'id="id_ktp" class="form-control input-sm select2me"');
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

<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('laporan/js/lap_ktp.js.php'); ?>

