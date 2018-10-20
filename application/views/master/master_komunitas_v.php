<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">
    /*    table#idTabelKel th:nth-child(2) {
            display:none;
        }
        table#idTabelKel td:nth-child(2) {
            display:none;
        }*/
</style>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Data Komunitas</span>
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
                            Data Komunitas </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form Komunitas</a>
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
                                 <br><br><br><br>

                                    <table class="table table-striped table-bordered table-hover text_kanan"
                                           id="idTabelKel">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Id Komunitas
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
                                                    Jns Komunitas
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
                        <form role="form" method="post" class=""
                              action="<?php echo base_url('master/master_komunitas/home'); ?>" id="id_formKel">

                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-6">
                                        <div class="form-group hidden">
                                            <!-- <label>NIK</label> -->
                                            <input id="id_komunitasId"  class="form-control input-sm"
                                                   type="text" name="komunitasId" />
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Komunitas</label>
                                            <input id="id_namaKomunitas" class="form-control input-sm"
                                                   type="text" name="namaKomunitas" />
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea rows="2" cols="" name="alamat" id="id_alamat"
                                                      class="form-control input-sm" placeholder="Alamat"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Kecamatan</label>
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($kec as $row) :
                                                        $data[$row['id_kec']] = $row['nama_kec'];
                                                    endforeach;
                                                    echo form_dropdown('kec', $data, '', 'required id="id_kec" class="form-control input-sm select2me "');
                                                    ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Kelurahan</label>
                                                    <select name="kel" id="id_kel" class="form-control input-sm select2me "></select>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Nama Koordinator</label>
                                                    <input id="id_namaKoordinator" class="form-control input-sm"
                                                           type="text" name="namaKoordinator" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>No telp</label>
                                                    <input id="id_noTelp" class="form-control input-sm"
                                                           type="text" name="noTelp" />

                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Komunitas</label>
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($jeniskomunitas as $row) :
                                                $data[$row['id_jeniskomunitas']] = $row['nama_jeniskomunitas'];
                                            endforeach;
                                            echo form_dropdown('jeniskomunitas', $data, '', 'required id="id_jeniskomunitas" class="form-control input-sm select2me "');
                                            ?>
                                        </div>

                                    </div>
                                    <!--end <div class="col-md-6"> 1 -->
                                    <div class="col-md-6"></div>
                                    <div class="col-md-12">
                                        <button id="idAddPeserta" onclick="tambahPeserta()" class="btn blue">Tambah Anggota</button>
                                    </div>
                                    <div class="col-md-12">
                                    <br>
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

                                        <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                            <!--<i class="fa fa-check"></i>--> Simpan
                                        </button>
                                        <button name="btnUbah" onclick="" class="btn yellow" id="id_btnUbah">
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
                        </form>
                    </div>    
                </div>    

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


<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!-- End MODAL Input Data Pengambilan Cucian -->
<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('master/js/master_komunitas.js.php'); ?>
