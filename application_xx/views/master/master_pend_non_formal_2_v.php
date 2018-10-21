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
                    <span class="caption-subject font-red-sunglo bold uppercase">Data pendidikan non formal</span>
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
                            Data pendidikan non formal </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form pendidikan non formal</a>
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
                            <div class="col-md-3">
                                <label>Nik</label>
                                <input id="idNIK" class="form-control input-sm" type="text" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Nama </label>
                                <input id="idNama" class="form-control input-sm" type="text" disabled>
                            </div>
                            <!-- <div class="col-md-6">&nbsp;</div> -->
                            <div class="col-md-12">&nbsp;</div>
                            <div class="col-md-12"><hr></div>

                            <div>
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idGridbantuan">
                                    <thead>
                                        <tr>
                                            <th>
                                                no
                                            </th>
                                            <th>
                                                jenis bantuan
                                            </th>
                                            <th>
                                                nama bantuan
                                            </th>
                                            <th>
                                                instansi
                                            </th>
                                            <th>
                                                Tanggal
                                            </th>
                                            <th>
                                                keterangan
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                            
                            <hr>

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
                                            <label>Nama Pendidikan</label>
                                            <input id="id_nama_pend" class="form-control input-sm" type="text">
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
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input id="id_ket" class="form-control input-sm" type="text">
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Pendidikan</label>
                                            <input id="id_jns_pend" class="form-control input-sm" type="text">
                                        </div>                                    
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input id="id_tahun" class="form-control input-sm date-picker" data-date-format="yyyy" type="text">
                                        </div>                                    
                                    </div>
                                    <!--end <div class="col-md-6"> 1 -->
                                    <div class="col-md-6"></div>
                                    <div class="col-md-12">
                                        <button id="idSave" onclick="save()" class="btn blue"> Simpan</button>
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
                                                        nama pendidikan
                                                    </th>
                                                    <th>
                                                        jenis pendidikan
                                                    </th>
                                                    <th>
                                                        tahun
                                                    </th>
                                                    <th>
                                                        nama instansi
                                                    </th>
                                                    <th>
                                                        Ket
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

<?php $this->load->view('app.min.inc.php'); ?>
<?php $this->load->view('master/js/master_pend_non_formal_2.js.php'); ?>

