
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Kecamatan</label>
                                        <?php
                                        $data = array();
                                        $data['%'] = 'All';
                                        foreach ($kec as $row) :
                                            $data[$row['id_kec']] = $row['nama_kec'];
                                        endforeach;
                                        echo form_dropdown('kec', $data, '', 'required id="id_kec" class="form-control input-sm select2me "');
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Kelurahan</label>
                                        <select name="kel" id="id_kel" class="form-control input-sm select2me "></select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Banjar</label>
                                        <select name="banjar" id="id_banjar" class="form-control input-sm select2me "></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <br><br><br><br><br>
                            <table class="table table-striped table-bordered table-hover text_kanan" id="idGridSelectPenerima">
                                <thead>
                                    <tr>
                                        <th>
                                            Action
                                        </th>
                                        <th>
                                            No KK
                                        </th>
                                        <th>
                                            NIK
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Kecamatan
                                        </th>
                                        <th>
                                            Kelurahan
                                        </th>
                                        <th>
                                            Rw
                                        </th>
                                        <th>
                                            Rt
                                        </th>
                                        <th>
                                            Jml Keluarga
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>

                        </div>


                        <!-- <div class="form-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="hidden" id="id_ktp">                                    
                                    <input type="text" id="id_nama" class="form-control input-sm" onclick="onModal()">                                    
                                </div>   
                            </div>
                            <div class="col-md-4">

                            </div>
                        </div> -->
                        <!-- HIDDEN INPUT -->
                        <input type="text" id="idTmpAksiBtn" class="hidden">
                        <!-- END HIDDEN INPUT -->
                    </div>
                    <!--END ROW 1 -->

                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions ">
                                <a href="javascript:;" class="btn blue" onclick="cetak();">
                                    <i class="fa fa-print"></i> Cetak </a>

                                <button id="id_btnBatal" type="button" class="btn default">Batal</button>

                            </div>
                        </div>
                    </div> -->

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
<?php $this->load->view('laporan/js/lap_kk.js.php'); ?>

