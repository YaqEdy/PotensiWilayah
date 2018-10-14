<!-- BEGIN PAGE BREADCRUMB -->

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
                    <span class="caption-subject font-red-sunglo bold uppercase">Data Bantuan</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
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
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Data Bantuan </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form Bantuan</a>
                    </li>

                </ul>
                <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_2_1">
                            
                            <div class="scroller" style="height:400px; ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="id_Reload" style="display: none;"></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                            <table class="table table-striped table-bordered table-hover text_kanan"
                                                   id="idTabelBantuan">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            No
                                                        </th>
                                                        <th>
                                                            Id Bantuan
                                                        </th>
                                                        <th>
                                                            id KTP
                                                        </th>
                                                        <th>
                                                            id jns bantuan
                                                        </th>
                                                        <th>
                                                            Jenis Bantuan
                                                        </th>
                                                        <th>
                                                            Nama Bantuan
                                                        </th>
                                                        <th>
                                                            Nama
                                                        </th>
                                                        <th>
                                                            Id M Instansi
                                                        </th>
                                                        <th>
                                                            Id session
                                                        </th>
                                                        <th>
                                                            tgl bantuan
                                                        </th>
                                                        <th>
                                                        nama_instansi
                                                        </th>
                                                        <th>
                                                            Keterangan
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>

                                                </tfoot>
                                            </table>
                                    </div>
                                    <!-- end col-12 -->
                                </div>
                                <!-- END ROW-->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_2_2">
                            <!-- <form role="form" method="post" class="" id="id_formBantuan"> -->
                    
                            <div class="row">
                                <div class="form-body">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Bantuan</label>
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($jns_bantuan as $row) :
                                                $data[$row['id_jns_bantuan']] = $row['jns_bantuan'];
                                            endforeach;
                                            echo form_dropdown('jns_bantuan', $data, '', ' id="id_jns_bantuan" class="form-control input-sm select2me "');
                                            ?>
                                        </div>
                                    </div>
                                </div>  
                            </div>
    
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-6">
                                        <div class="form-group hidden">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Id Bantuan </label>
                                                    <div class="input-group">
                                                        <input id="id_BantuanId" required="required" class="form-control input-sm"
                                                               type="text" name="BantuanId" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Bantuan</label>
                                            <input id="id_bantuan" class="form-control" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label>Instansi</label>
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($instansi as $row) :
                                                $data[$row['id_instansi']] = $row['nama_instansi'];
                                            endforeach;
                                            echo form_dropdown('instansi', $data, '', ' id="id_instansi" class="form-control input-sm select2me "');
                                            ?>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Bantuan</label>
                                            <input id="id_tgl_bantuan" class="form-control input-sm date-picker" data-date-format="dd-mm-yyyy" type="text">
                                        </div>                                    
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input id="id_ket" class="form-control" type="text">
                                        </div>                                    
                                    </div>
                                    <!--end <div class="col-md-6"> 1 -->
                                    <div class="col-md-6"></div>
                                    <div class="col-md-12">
                                    <button id="idAddPeserta" onclick="tambahPeserta()" class="btn blue">Tambah Peserta</button>
                                        <table class="table table-striped table-bordered table-hover text_kanan" id="idGridPenerima">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        No
                                                    </th>
                                                    <th>
                                                        id KTP
                                                    </th>
                                                    <th>
                                                        Nama
                                                    </th>
                                                    <th>
                                                        Jenis Kelamin
                                                    </th>
                                                    <th>
                                                        Tanggal Lahir
                                                    </th>
                                                    <th>
                                                        Act
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>
                                    </div>
                                    
                                </div>
                                <!-- HIDDEN INPUT -->
                                <input type="text" id="idTmpAksiBtn" class="hidden">
                                <!-- END HIDDEN INPUT -->

                            </div>
                            <!--END ROW 1 -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-actions">

                                        <button onclick="simpanBantuan()" name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                            <!--<i class="fa fa-check"></i>--> Simpan
                                        </button>
                                        <button name="btnUbah" onclick="simpanBantuan()" class="btn yellow" id="id_btnUbah">
                                            <!--<i class="fa fa-edit"></i>--> Ubah
                                        </button>
                                        <button name="btnHapus" class="btn red" id="id_btnHapus">
                                            <!--<i class="fa fa-trash"></i>-->
                                            Hapus
                                        </button>
                                        <button id="id_btnBatal" type="reset" class="btn default">Batal</button>
                                    </div>
                                </div>

                            </div>
                            <!-- </form> -->
                        </div>    
                    </div>    

            </div>
        </div>
        <!-- end <div class="portlet green-meadow box"> -->
    </div>
    <!-- end <div class="col-md-6"> -->
</div>
<!-- END PAGE CONTENT-->

<!--  MODAL -->
<div class="modal fade draggable-modal" id="idDivSelectKTP"  role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data Masyarakat</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover text_kanan" id="idGridSelectPenerima">
                    <thead>
                        <tr>
                            <th>
                                Select
                            </th>
                            <th>
                                id KTP
                            </th>
                            <th>
                                Nama
                            </th>
                            <th>
                                Jenis Kelamin
                            </th>
                            <th>
                                Tgl Lahir
                            </th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>

            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal" id="id_btnBatalSelect"><i class="fa fa-times"></i>&nbsp;Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- End MODAL Input Data Cucian Masuk -->

<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('transaksi/js/trans_bantuan.js.php'); ?>

