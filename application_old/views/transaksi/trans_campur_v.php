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
                <!--                <ul class="nav nav-pills">
                                    <li class="linav active" id="linav1">
                                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                                            Data customer </a>
                                    </li>
                                    
                                    <li class="linav" id="linav3">
                                        <a href="#tab_2_3" data-toggle="tab" id="navitab_2_3" class="anavitab">
                                            Rincian pengeluaran </a>
                                    </li>
                
                                </ul>-->
                <form role="form" method="post"
                      action="<?php echo base_url('transaksi/trans_campur/home'); ?>" id="id_formAdvance">
                    <!--                    <div class="tab-content">
                                            <div class="tab-pane fade active in" id="tab_2_1">-->
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <label>Tanggal</label> 
                                            <input id="id_tgltrans" required="required"
                                                   class="form-control input-sm date-picker" type="text"
                                                   name="tglTrans" data-date-format="dd-mm-yyyy" />
                                        </div>    
                                    </div>    
                                </div>
                            </div>
                            <!--end <div class="col-md-6"> 1 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Produk jadi</label>
                                    <?php
                                    $data = array();
                                    $data[''] = '';
                                    foreach ($produk as $row) :
                                        $data[$row['id_master_isi_camp']] = $row['nama_produk_jadi'];
                                    endforeach;
                                    echo form_dropdown('produk_jadi', $data, '', 'id="id_produk_jadi" class="form-control input-sm select2me" required');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Storage produk jadi</label>
                                    <?php
                                    $data = array();
                                    $data[''] = '';
                                    foreach ($storage as $row) :
                                        $data[$row['id_storage']] = $row['nama_storage'];
                                    endforeach;
                                    echo form_dropdown('storage_produk_jadi', $data, '', 'id="id_storage_produk_jadi" class="form-control input-sm " required disabled');
                                    ?>
                                </div>   
                            </div>
                        </div>
                        <!-- HIDDEN INPUT -->
                        <input type="text" id="idTmpAksiBtn" class="hidden">
                        <!-- END HIDDEN INPUT -->
                    </div>
                    <!--END ROW 1 -->

                    <!--                        </div>
                                            
                                            <div class="tab-pane fade" id="tab_2_3">-->
                    <!--  MODAL Data CPA -->

                    <!-- END ROW-->
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group" >
                                <input type="text" id="idTxtTempLoop" name="txtTempLoop" class="form-control nomor1 hidden">
                                <input type="text" id="idSatuanLt" name="" class="form-control hidden ">
                                <input type="text" id="idSatuanMl" name="" class="form-control hidden ">
                                <input type="text" id="idSatuanGr" name="" class="form-control hidden ">
                                <input type="text" id="idSatuanDrum" name="" class="form-control hidden">
                                <a href="#" class="btn green-haze btn-sm " data-target="#idDivInputProduk"
                                   id="id_btnModalTambah" data-toggle="modal">
                                    <i class="fa fa-plus fa-fw"/></i>&nbsp;Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-hover table-bordered" id="id_tabelPerkCflow">
                                    <thead>
                                        <tr>
                                            <th width="7%" style="display:none;">
                                                Kd Produk
                                            </th>
                                            <th width="7%"  style="display:none;">
                                                Kd Storage
                                            </th>
                                            <th width="10%">
                                                Produk
                                            </th>
                                            <th width="10%">
                                                Storage
                                            </th>
                                            <th width="10%">
                                                Jml (Packsize 1)
                                            </th>

                                            <th width="31%">
                                                Keterangan
                                            </th>
                                            <th width="5%">
                                                Act
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="id_body_data">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" style="display:none;"></td>
                                            <td colspan="2"><strong>Total</strong></td>
                                            <td ><input type="text" readonly class="form-control input-sm nomor" id="id_totalKg" name="totalKg"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--  END  MODAL Data CPA -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions ">
                                <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                    <!--<i class="fa fa-check"></i>--> Simpan
                                </button>

                                <button id="id_btnBatal" type="button" class="btn default">Batal</button>

                            </div>
                        </div>
                    </div>
                    <!--                        </div>
                    
                                        </div>-->

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
<div class="row">
    <div class="col-md-6">

    </div>
</div>

<!-- END PAGE CONTENT-->

<!--  MODAL Data Karyawan -->
<div class="modal fade draggable-modal" id="idDivInputProduk"  role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data produk yang dicampur</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:250px; ">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Produk</label>
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($produk_katalis as $row) :
                                                $data[$row['id_produk']] = $row['nama_produk'];
                                            endforeach;
                                            echo form_dropdown('produk', $data, '', 'id="id_produk" class="form-control select2me kosongDetail"');
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
                                            echo form_dropdown('storage', $data, '', 'id="id_storage" class="form-control select2me kosongDetail" disabled');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!--                                        <div class="form-group">
                                                                                    <label>Jenis storage</label>
                                                                                    <input id="id_jnsStorage" readonly="true" class="form-control input-sm kosongTextDetail"
                                                                                           type="text" name="jnsStorage" placeholder=""/>
                                                                                </div>-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Jumlah produk (Packsize 1)</label>
                                                    <input id="id_produkKg" class="form-control input-sm nomor kosongNomorDetail cls_hitungTotalHarga"
                                                           type="text" name="produkKg" placeholder=""/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea rows="2" cols="" name="keteranganCPA"  id="id_keteranganCPA" class="form-control input-sm kosongDetail"></textarea>
                                                </div>

                                            </div>
                                            <div class="col-md-4">

                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <button type="button" class="btn blue" data-dismiss="modal" id="id_btnAddCpa"><i class="fa fa-plus"></i>&nbsp; Tambah</button>
                <button type="button" class="btn default" data-dismiss="modal" id="id_btnBatalCpa"><i class="fa fa-times"></i>&nbsp;Batal</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--  END  MODAL Data Karyawan -->
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
<script src="<?php echo base_url('metronic/global/plugins/bootbox/bootbox.min.js'); ?>" type="text/javascript"></script>
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

                        App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
                            UIBootbox.init();
                            //ComponentsDateTimePickers.init();
                            ComponentsSelect2.init();
                            $("input[readonly='true']").focus(function () {
                                $(this).next();
                            });
                        });
                        $(document).keyup(function (e) {
                            if (e.which == 36) {
                                $('#id_btnModalTambah').trigger('click');
                            } else if (e.which == 35) {
                                $('#id_btnAddCpa').trigger('click');
                            }
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
                            btnStart();
                            resetForm();
                            readyToStart();
                            tglTransStart();
                            kosongDetail();
                            $('#id_produk_jadi').select2('val', '');
                            $('#id_body_data').empty();

                        });

                        function hitungBeratMdl() {
                            var kg = parseFloat(CleanNumber($('#id_produkKg').val()));
                            if (kg > 0) {
                                var fkLt = parseFloat(CleanNumber($('#idSatuanLt').val()));
                                var fkDrum = parseFloat(CleanNumber($('#idSatuanDrum').val()));

                                var lt = kg * fkLt;
                                $('#id_produkLt').val(number_format(lt, 2));

                                var drum = kg * fkDrum;
                                $('#id_produkDrum').val(number_format(drum, 2));
                            }

                        }
                        function kosongDetail() {
                            //$('#id_produk_jadi').select2('val','');
                            $('.kosongDetail').val('');
                            $('.kosongNomorDetail').val('0.00');
                            $('.kosongNomor1Detail').val('0');
                        }


                        $(".cls_hitungBeratMdl").focusout(function () {
                            hitungBeratMdl();
                        });

                        $("#id_produk").change(function () {
                            var idProduk = $(this).val();
                            getDescProduk(idProduk);
                            //getDescProdukStorage(idProduk);
                        });
                        function getDescProduk(idProduk) {
                            ajaxModal();
                            if (idProduk != '') {
                                $.post("<?php echo site_url('transaksi/sales_order/getDescProduk'); ?>",
                                        {
                                            'idProduk': idProduk
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_storage').select2("val", data.id_storage);
                                        $('#idSatuanLt').val(data.satuan_lt);
                                        $('#idSatuanMl').val(data.satuan_ml);
                                        $('#idSatuanGr').val(data.satuan_gr);
                                        $('#idSatuanDrum').val(data.satuan_drum);
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        alert('Data tidak ditemukan!');
                                        $('#id_btnBatal').trigger('click');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        function getDescProdukStorage(idProduk) {
                            ajaxModal();
                            if (idProduk != '') {
                                $.post("<?php echo site_url('transaksi/trans_keluar/getDescProdukStorage'); ?>",
                                        {
                                            'idProduk': idProduk
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_storage').val(data.id_storage);
                                        getDescStorage(data.id_storage);
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        alert('Data tidak ditemukan!');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        $("#id_storage").change(function () {
                            var idStorage = $(this).val();
                            getDescStorage(idStorage);
                        });
                        function getDescStorage(idStorage) {
                            ajaxModal();
                            if (idStorage != '') {
                                $.post("<?php echo site_url('transaksi/trans_campur/getDescStorage'); ?>",
                                        {
                                            'idStorage': idStorage
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_jnsStorage').val(data.nama_jns_storage);
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        alert('Data tidak ditemukan!');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        $('#id_keterangan').focusout(function () {
                            var keterangan = $(this).val();
                            $('#id_keteranganCPA').val(keterangan);
                        });
                        
                        function getDescProdukJadi(idProduk) {
                            ajaxModal();
                            if (idProduk != '') {
                                $.post("<?php echo site_url('transaksi/trans_campur/getDescProdukJadi'); ?>",
                                        {
                                            'idProduk': idProduk
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_storage_produk_jadi').val(data.id_storage);//select2("val",data.id_storage);
                                    } else {
                                        alert('Data tidak ditemukan!');
                                        $('#id_btnBatal').trigger('click');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        $("#id_produk_jadi").change(function () {
                            var idProdukJadi = $(this).val();
                            getIsiCamp(idProdukJadi);
                            cekStokAkhir(idProdukJadi);
                           getDescProdukJadi(idProdukJadi);
                            //alert(idProdukJadi);
                        });
                        //id_master_isi_camp
                        function getIsiCamp(idProdukJadi) {
                            $('#id_body_data').empty();
                            $('#id_totalKg').val(number_format(0, 2));
                            ajaxModal();
                            if (idProdukJadi != '') {
                                $.post("<?php echo site_url('/transaksi/trans_campur/getIsiCamp'); ?>",
                                        {
                                            'idProdukJadi': idProdukJadi
                                        }, function (data) {
                                    if (data.data_cpa.length > 0) {
                                        $('#idTxtTempLoop').val(data.data_cpa.length);
                                        for (i = 0; i < data.data_cpa.length; i++) {
                                            var x = i + 1;
                                            //var idCpa           = data.data_cpa[i].id_cpa;
                                            var kodePerk = data.data_cpa[i].kode_perk;
                                            var kodeCflow = data.data_cpa[i].kode_cflow;
                                            var ket = data.data_cpa[i].keterangan;
                                            var jumlah = data.data_cpa[i].jumlah;

                                            var kdProduk = data.data_cpa[i].id_produk_isi;
                                            var txtProduk = data.data_cpa[i].nama_produk;
                                            var kdStorage = data.data_cpa[i].id_storage;
                                            var txtStorage = data.data_cpa[i].nama_storage;
                                            var kg = data.data_cpa[i].packsize1;
                                            var ket = '';

                                            tr = '<tr class="listdata" id="tr' + i + '">';
                                            tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdProduk' + i + '" name="tempKdProduk' + i + '" readonly="true" value="' + kdProduk + '"></td>';
                                            tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdStorage' + i + '" name="tempKdStorage' + i + '" readonly="true" value="' + kdStorage + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtProduk' + i + '" name="tempTxtProduk' + i + '" readonly="true" value="' + txtProduk + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtStorage' + i + '" name="tempTxtStorage' + i + '" readonly="true" value="' + txtStorage + '" ></td>';
                                            tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempKg' + i + '" name="tempKg' + i + '" readonly="true" value="' + kg + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempKet' + i + '" name="tempKet' + i + '" readonly="true" value="' + ket + '"></td>';
                                            tr += '<td><a href="#" class="btn green btn-sm" <i class="fa fa-submit fa-fw"/></i></a></td>';
                                            tr += '</tr>';
                                            /*
                                             jmlKg = parseFloat(CleanNumber(kg));
                                             
                                             var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));
                                             
                                             var total_kg = jmlKg + totalKg;
                                             
                                             $('#id_totalKg').val(number_format(total_kg, 2));
                                             */
                                            $('#id_body_data').append(tr);
                                            $('#idTxtTempLoop').val(i);


                                        }
                                        $('#id_totalKg').val(number_format(data.data_cpa[0].total_isi, 2));
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        //alert('Data tidak ditemukan!');
                                        //$('#id_btnBatal').trigger('click');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        function cekStokAkhir(idProdukJadi) {
                            $('#event_result').empty();
                            $('#id_btnSimpan').attr("disabled", false);
                            ajaxModal();
                            if (idProdukJadi != '') {
                                $.post("<?php echo site_url('/transaksi/trans_campur/cekStokAkhir'); ?>",
                                        {
                                            'idProdukJadi': idProdukJadi
                                        }, function (data) {
                                    if (data.length > 0) {
                                        $('#id_btnSimpan').attr("disabled", "true");
                                        for (i = 0; i < data.length; i++) {
                                            $('#event_result').append(data[i]);
                                        }
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        //alert('Data tidak ditemukan!');
                                        //$('#id_btnBatal').trigger('click');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        $('#id_btnAddCpa').click(function () {
                            var i = $('#idTxtTempLoop').val();
                            if ($('#id_produk').val() == '' || $('#id_storage').val() == '') {
                                alert("Produk atau storage tidak boleh kosong.");
                            } else {
                                var i = parseInt($('#idTxtTempLoop').val());
                                i = i + 1;
                                var kdProduk = $('#id_produk').val();
                                var txtProduk = $('#id_produk option:selected').text();
                                var kdStorage = $('#id_storage').val();
                                var txtStorage = $('#id_storage option:selected').text();
                                var kg = $('#id_produkKg').val();
                                var lt = $('#id_produkLt').val();
                                var drum = $('#id_produkDrum').val();
                                var ket = $('#id_keteranganCPA').val().trim();
                                tr = '<tr class="listdata" id="tr' + i + '">';
                                tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdProduk' + i + '" name="tempKdProduk' + i + '" readonly="true" value="' + kdProduk + '"></td>';
                                tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdStorage' + i + '" name="tempKdStorage' + i + '" readonly="true" value="' + kdStorage + '" ></td>';
                                tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtProduk' + i + '" name="tempTxtProduk' + i + '" readonly="true" value="' + txtProduk + '" ></td>';
                                tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtStorage' + i + '" name="tempTxtStorage' + i + '" readonly="true" value="' + txtStorage + '" ></td>';
                                tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempKg' + i + '" name="tempKg' + i + '" readonly="true" value="' + kg + '" ></td>';
                                tr += '<td><input type="text" class="form-control input-sm" id="id_tempKet' + i + '" name="tempKet' + i + '" readonly="true" value="' + ket + '"></td>';
                                tr += '<td><a href="#" class="btn red btn-sm" onclick="hapusBaris(\'tr' + i + '\')"><i class="fa fa-minus fa-fw"/></i></a></td>';
                                tr += '</tr>';


                                var id_produk_pencampur = kdProduk;//$("#id_produk_pencampur").val();
                                //alert(id_produk_pencampur);
                                if (id_produk_pencampur == '000041' || id_produk_pencampur == '000042') {// jika bitrex
                                    /*
                                    var jmlProdMurni = $("#id_jmlProdMurni").val();

                                    jmlProdMurni = parseFloat(CleanNumber(jmlProdMurni));
                                    var jmlProdJadi = jmlProdMurni;

                                    $("#id_jmlProdJadi").val(number_format(jmlProdJadi, 2));
                                    */

                                } else {//selain bitrex
                                    jmlKg = parseFloat(CleanNumber(kg));

                                    var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));

                                    var total_kg = jmlKg + totalKg;

                                    $('#id_totalKg').val(number_format(total_kg, 2));
                                }



                                $('#id_body_data').append(tr);
                                $('#idTxtTempLoop').val(i);
                                kosongDetail();
                            }
                        });
                        function hapusBaris(noRow) {
                            if (document.getElementById(noRow) != null) {

                                var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));

                                var jmlKgOld = $('#' + noRow).find("td input").eq(4).val();
                                jmlKgOld = parseFloat(CleanNumber(jmlKgOld));

                                totalKg = totalKg - jmlKgOld;

                                $('#id_totalKg').val(number_format(totalKg, 2));

                                $('#' + noRow).remove();
                            }
                        }
                        $('#id_btnRemoveCpa').click(function () {
                            var noRow = $('#idTempUbahCPA').val();
                            $('#tr' + noRow).remove();
                            var i = $('#idTxtTempLoop').val();
                            i = parseInt(i);
                            i = i - 1;
                            $('#idTxtTempLoop').val(i);

                            var totalP = parseFloat(CleanNumber($('#idTotalCPA').val()));
                            var jumlahOld = parseFloat(CleanNumber($('#idTempJumlahCPA').val()));
                            totalP = totalP - jumlahOld;
                            $('#idTotalCPA').val(number_format(totalP, 2));
                            kosongCPA();
                            btnCpaStart();
                        });
                        $('#id_btnBatalCpa').click(function () {
                            $('#id_produk').select2('val','');
                            $('#id_storage').select2('val','');
                            $('#id_produkKg').val('0.00');
                            $('#id_keteranganCPA').val('');
                        });
                        function ajaxSubmitAdvance() {
                            ajaxModal();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "<?php echo base_url(); ?>transaksi/trans_campur/simpan",
                                data: dataString,
                                success: function (data) {
                                    $('#id_btnBatal').trigger('click');
                                    //readyToStart();
                                    UIToastr.init(data.tipePesan, data.pesan);
                                    $('#id_storage_produk_jadi').attr("disabled",true);
                                }

                            });
                            event.preventDefault();
                        }

                        $('#id_formAdvance').submit(function (event) {
                            
                            var aksiBtn = $('#idTmpAksiBtn').val();
                            if (aksiBtn == '1') {
                                var r = confirm('Anda yakin menyimpan data ini?');
                                if (r == true) {
                                    $('#id_storage_produk_jadi').attr("disabled",false);
                                    dataString = $("#id_formAdvance").serialize();
                                    ajaxSubmitAdvance();
                                } else {//if(r)
                                    return false;
                                }
                            }


                        });


</script>


<!-- END JAVASCRIPTS -->