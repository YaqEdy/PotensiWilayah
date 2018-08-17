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
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Data sales order
                        </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form Data sales order </a>
                    </li>

                </ul>
                <form role="form" method="post"
                      action="<?php echo base_url('cukai/trans_keluar/home'); ?>" id="id_formAdvance">
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_2_1">
                                <button id="id_Reload" style="display: none;"></button>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelPO">
                                        <thead>
                                            <tr>
                                                <th>
                                                    No SO
                                                </th>
                                                <th>
                                                    No PO Cust
                                                </th>
                                                <th>
                                                    Customer
                                                </th>
                                                <th>
                                                    Tanggal Order
                                                </th> 
                                                <th>
                                                    Tanggal Kirim
                                                </th> 
                                                <th>
                                                    Jumlah Order
                                                </th>
                                                <th>
                                                    No cukai
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
                        </div>
                        <div class="tab-pane fade" id="tab_2_2">
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input id="id_SoId" 
                                                           class="form-control input-sm hidden" type="text"
                                                           name="SoId" />
                                                    <input id="id_produkKgSbl" 
                                                           class="form-control input-sm hidden" type="text"
                                                           name="produkKgSbl" />
                                                    <input id="id_produkSbl" 
                                                           class="form-control input-sm hidden" type="text"
                                                           name="produkSbl" />
                                                    <label>Tanggal</label> 
                                                    <input id="id_tgltrans" required="required"
                                                           class="form-control input-sm date-picker" type="text"
                                                           name="tglTrans" data-date-format="dd-mm-yyyy" />
                                                </div>    
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <label>Customer</label>
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($cust as $row) :
                                                $data[$row['id_cust']] = $row['nama_cust'];
                                            endforeach;
                                            echo form_dropdown('customer', $data, '', 'id="id_customer" disabled="disabled" class="form-control input-sm select2me kosongDetail"');
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label>No PO Customer</label>
                                            <input id="id_poCust" readonly="readonly"
                                                   class="form-control input-sm " type="text"
                                                   name="poCust" />
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis dokumen</label>
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($jnsdoc as $row) :
                                                $data[$row['id_jnsdoc']] = $row['nama_jnsdoc'];
                                            endforeach;
                                            echo form_dropdown('jnsdoc', $data, '', 'id="id_jnsdoc" disabled="disabled" class="form-control input-sm kosongDetail select2me"');
                                            ?>
                                        </div>
                                    </div>
                                    <!--end <div class="col-md-6"> 1 -->
                                    <div class="col-md-2">
                                        
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                            Kuota :
                                            <h2><strong id="id_kuota" class="kosongTextDetail"></strong></h2><span></span>
                                            
                                        </div>     
                                    </div>
                                </div>
                                <!-- HIDDEN INPUT -->
                                <input type="text" id="idTmpAksiBtn" class="hidden">
                                <!-- END HIDDEN INPUT -->
                            </div>
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-4">    
                                        <div class="form-group">
                                            <label>ETD (Pengiriman)</label>
                                            <input id="id_etd" required="required"
                                                   class="form-control input-sm " readonly="true" type="text"
                                                   name="etd" data-date-format="dd-mm-yyyy" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>ETA (Kedatangan ke Customer)</label>
                                            <input id="id_eta" required="required"
                                                   class="form-control input-sm " type="text" readonly="true"
                                                   name="eta" data-date-format="dd-mm-yyyy" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <input type="text" id="idTxtTempLoop" name="txtTempLoop" class="form-control nomor1 hidden">
                                        <input type="text" id="idSatuanLt" name="" class="form-control hidden ">
                                        <input type="text" id="idSatuanMl" name="" class="form-control hidden ">
                                        <input type="text" id="idSatuanGr" name="" class="form-control hidden ">
                                        <input type="text" id="idSatuanDrum" name="" class="form-control hidden">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Produk</label>
                                                    <!-- -->
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($produk as $row) :
                                                        $data[$row['id_produk']] = $row['nama_produk'];
                                                    endforeach;
                                                    echo form_dropdown('produk', $data, '', 'id="id_produk" disabled="disabled" class="form-control select2me kosongDetail"');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Stok Pengiriman</label>
                                                    <input id="id_stokAvl" readonly="true" class="form-control input-sm kosongTextDetail nomor"
                                                           type="text" name="stokAvl" placeholder=""/>
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
                                                    echo form_dropdown('storage', $data, '', 'id="id_storage" disabled="disabled" class="form-control select2me kosongDetail"');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
<!--                                                    <label>Jenis storage</label>-->
                                                    <input id="id_jnsStorage" readonly="true" class="form-control input-sm kosongTextDetail hidden"
                                                           type="text" name="jnsStorage" placeholder=""/>
                                                </div>
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
                                                            <textarea rows="2" cols="" name="keteranganCPA" readonly="readonly" id="id_keteranganCPA" class="form-control input-sm kosongDetail"></textarea>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
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
                                        <!--<button name="btnUbah" onclick="" class="btn yellow" id="id_btnUbah">
                                            <!--<i class="fa fa-edit"></i> Ubah
                                        </button>-->

                                        <button id="id_btnBatal" type="button" class="btn default">Batal</button>

                                    </div>
                                </div>
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

<!--  MODAL Data Karyawan -->
<div class="modal fade draggable-modal" id="idDivInputProduk" tabindex="-1"  role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data produk yang diorder</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:250px; ">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-12">

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
<script src="<?php echo base_url('metronic/layouts/global/scripts/quick-sidebar.min.js'); ?>" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url('metronic/additional/start.js'); ?>" type="text/javascript"></script>
<script>

                        var ComponentsSelect2 = function () {
                            var e = function () {

                            };
                            return{init: function () {
                                    e();
                                }};
                        }();
                        var ComponentsDateTimePickers = function () {
                            var t = function () {
                                jQuery().datepicker && $(".date-picker").datepicker({rtl: App.isRTL(), orientation: "bottom", autoclose: !0}), $(document).scroll(function () {
                                    //$("#form_modal2 .date-picker").datepicker("place")
                                });
                            };
                            return{init: function () {
                                    t();
                                }};
                        }();

                        jQuery(document).ready(function () {
                            UIBootbox.init();
                            ComponentsDateTimePickers.init();
                            ComponentsSelect2.init();
                            TableManaged.init();
                            $("input[readonly='true']").focus(function () {
                                $(this).next();
                            });
                        });
                        var TableManaged = function () {

                            var initTable1 = function () {
                                var table = $('#idTabelPO');
                                // begin first table
                                table.dataTable({
                                    "ajax": "<?php echo base_url("/cukai/trans_keluar/getRencanaOutAll"); ?>",
                                    "columns": [
                                        {"data": "idMaster"},
                                        {"data": "poCust"},
                                        {"data": "namaCust"},
                                        {"data": "tglOrder"},
                                        {"data": "tglKirim"},
                                        {"data": "totalQty"},
                                        {"data": "noCukai"}
                                    ],
                                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                                    "language": {
                                        "aria": {
                                            "sortAscending": ": activate to sort column ascending",
                                            "sortDescending": ": activate to sort column descending"
                                        },
                                        "emptyTable": "No data available in table",
                                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                                        "infoEmpty": "No entries found",
                                        "infoFiltered": "(filtered1 from _MAX_ total entries)",
                                        "lengthMenu": "Show _MENU_ entries",
                                        "search": "Search:",
                                        "zeroRecords": "No matching records found"
                                    },
                                    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.


                                    "lengthMenu": [
                                        [5, 10, 15, 20, -1],
                                        [5, 10, 15, 20, "All"] // change per page values here
                                    ],
                                    // set the initial value
                                    "pageLength": 5,
                                    "pagingType": "bootstrap_full_number",
                                    "language": {
                                        "search": "Cari: ",
                                        "lengthMenu": "  _MENU_ records",
                                        "paginate": {
                                            "previous": "Prev",
                                            "next": "Next",
                                            "last": "Last",
                                            "first": "First"
                                        }
                                    },
                                    "aaSorting": [[0, 'asc']/*, [5,'desc']*/],
                                    "columnDefs": [{// set default column settings
                                            'orderable': true,
                                            "searchable": true,
                                            'targets': [0]
                                        }],
                                    "order": [
                                        [0, "asc"]
                                    ] // set first column as a default sort by asc
                                });
                                $('#id_Reload').click(function () {
                                    table.api().ajax.reload();
                                });

                                var tableWrapper = jQuery('#example_wrapper');

                                table.find('.group-checkable').change(function () {
                                    var set = jQuery(this).attr("data-set");
                                    var checked = jQuery(this).is(":checked");
                                    jQuery(set).each(function () {
                                        if (checked) {
                                            $(this).attr("checked", true);
                                            $(this).parents('tr').addClass("active");
                                        } else {
                                            $(this).attr("checked", false);
                                            $(this).parents('tr').removeClass("active");
                                        }
                                    });
                                    jQuery.uniform.update(set);
                                });

                                table.on('change', 'tbody tr .checkboxes', function () {
                                    $(this).parents('tr').toggleClass("active");
                                });
                                table.on('click', 'tbody tr', function () {
                                    var idSo = $(this).find("td").eq(0).html();
                                    $('#id_SoId').val(idSo);
                                    getDescSo(idSo);
                                    $("#navitab_2_2").trigger('click');
                                    //$('#').val();
                                    //$('#btnCloseModalDataUser').trigger('click');
                                    $('#id_btnSimpan').attr('disabled', false);
                                    $('#id_btnUbah').attr("disabled", false);
                                    $('#id_btnHapus').attr("disabled", false);
                                    //$('#id_namaSpl').focus();

                                });

                                tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
                            }


                            return {
                                //main function to initiate the module
                                init: function () {
                                    if (!jQuery().dataTable) {
                                        return;
                                    }
                                    initTable1();
                                }
                            };
                        }();
                        $(document).keyup(function (e) {
                            if (e.which === 36) {
                                $('#id_btnModalTambah').trigger('click');
                            } else if (e.which == 35) {
                                $('#id_btnAddCpa').trigger('click');
                            }
                        });
                        //$(function () {
                        var judul_menu = $('#id_a_menu_<?php echo $menu_id; ?>').text();
                        $('#id_judul_menu').text(judul_menu);
                        // MENU OPEN
                        $(".menu_root").removeClass('start active open');
                        $("#menu_root_<?php echo $menu_parent; ?>").addClass('start active open');
                        // END MENU OPEN

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
                            $('#id_body_data').empty();
                            kosongDetail();
                        });
                        function getDescSo(idSo) {
                            ajaxModal();
                            if (idSo != '') {
                                $.post("<?php echo site_url('/cukai/trans_keluar/getDescSo'); ?>",
                                        {
                                            'idSo': idSo
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_tgltrans').val(data.tgl_trans);
                                        $('#id_customer').select2("val",data.id_cust);
                                        $('#id_poCust').val(data.no_po_cust);
                                        $('#id_jnsdoc').select2("val",data.id_jnsdoc);
                                        $('#id_etd').val(data.etd);
                                        $('#id_eta').val(data.eta);
                                        $('#id_produk').select2("val",data.id_produk);
                                        $('#id_produkSbl').val(data.id_produk);
                                        $('#id_storage').select2("val",data.id_storage); 
                                        $('#id_produkKg').val(data.qty_rencana);
                                        $('#id_produkKgSbl').val(data.qty_rencana);
                                        $('#id_keteranganCPA').val(data.keterangan_so);
                                        getKuota(data.id_cust);
                                        //$('#').val(data.);
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        alert('Data tidak ditemukan!');
                                        $('#id_btnBatal').trigger('click');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        
                        function kosongDetail() {
                            $('.kosongTextDetail').text('');
                            $('.kosongDetail').select2("val", "");
                            $('#id_jnsdoc').select2("val", "");
                            $('.kosongNomorDetail').val('0.00');
                            $('.kosongNomor1Detail').val('0');
                        }

                        $("#id_customer").change(function () {
                            var idCustomer = $(this).val();
                            if (idCustomer == '') {
                                $('#id_produk').select2("val", "");
                                $('#id_jnsStorage').val('');
                            } else {
                                getDescCustomer(idCustomer);
                                getKuota(idCustomer);
                            }

                        });
                        $("#id_produk").change(function () {
                            var idProduk = $(this).val();
                            if (idProduk == '') {
                                $('#id_storage').select2("val", "");
                                $('#id_jnsStorage').val('');
                            } else {
                                getDescProduk(idProduk);
                                getStockAvl(idProduk);
                            }

                        });

                        function getDescCustomer(idCust) {
                            ajaxModal();
                            if (idCust != '') {
                                $.post("<?php echo site_url('cukai/trans_keluar/getDescCust'); ?>",
                                        {
                                            'idCust': idCust
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_produk').select2("val", data.id_produk);
                                        getDescProduk(data.id_produk);
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        alert('Data tidak ditemukan!');
                                        $('#id_btnBatal').trigger('click');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        function getKuota(idCust) {
                            ajaxModal();
                            if (idCust != '') {
                                $.post("<?php echo site_url('globalc/getKuotaCust'); ?>",
                                        {
                                            'idCust': idCust
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_kuota').text(number_format(data.kuota_saldo_akhir,3));
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        $('#id_kuota').text('0.000');
                                        alert('Data kuota tidak ditemukan!');
                                       // $('#id_btnBatal').trigger('click');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        
                        function getDescProduk(idProduk) {
                            ajaxModal();
                            if (idProduk != '') {
                                $.post("<?php echo site_url('cukai/trans_keluar/getDescProduk'); ?>",
                                        {
                                            'idProduk': idProduk
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_storage').select2("val", data.id_storage);
                                        $('#idSatuanLt').val(data.satuan_lt);
                                        $('#idSatuanMl').val(data.satuan_ml);
                                        $('#idSatuanGr').val(data.satuan_gr);
                                        $('#idSatuanDrum').val(data.satuan_drum);
                                        getDescStorage(data.id_storage);
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        alert('Data tidak ditemukan!');
                                        $('#id_btnBatal').trigger('click');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        $("#id_storage").change(function () {
                            var idStorage = $(this).val();
                            getDescStorage(idStorage);
                        });
                        $("#id_etd").change(function () {
                            var etd = $(this).val();
                            $("#id_eta").val(etd);
                        });

                        function getDescStorage(idStorage) {
                            ajaxModal();
                            if (idStorage != '') {
                                $.post("<?php echo site_url('cukai/trans_keluar/getDescStorage'); ?>",
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
                        function getStockAvl(idProduk) {
                            ajaxModal();
                            if (idProduk != '') {
                                $.post("<?php echo site_url('globalc/getStockAvl'); ?>",
                                        {
                                            'idProduk': idProduk
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_stokAvl').val(number_format(data.stok_avl,2));
                                    } else {
                                        alert('Data tidak ditemukan!');
                                    }
                                }, "json");
                            }//if kd<>''

                        }
                        $('#id_btnNext1').click(function () {
                            $('.linav').removeClass("active");
                            $('#linav2').addClass("active in");
                            $('.anavitab').attr("aria-expanded", "false");
                            $('#navitab_2_2').attr("aria-expanded", "true");
                            $('.tab-pane').removeClass("active in");
                            $('#tab_2_2').addClass("active in");
                        });
                        $('#id_btnNext2').click(function () {
                            $('.linav').removeClass("active");
                            $('#linav3').addClass("active in");
                            $('.anavitab').attr("aria-expanded", "false");
                            $('#navitab_2_3').attr("aria-expanded", "true");
                            $('.tab-pane').removeClass("active in");
                            $('#tab_2_3').addClass("active in");
                        });
                        

                        $('#id_btnBatalCpa').click(function () {
                            kosongDetail();
                        });
                        function ajaxSubmitAdvance() {
                            ajaxModal();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "<?php echo base_url(); ?>cukai/trans_keluar/simpan",
                                data: dataString,
                                success: function (data) {
                                    $('#id_btnBatal').trigger('click');
                                    $('#id_Reload').trigger('click');
                                    //readyToStart();
                                    UIToastr.init(data.tipePesan, data.pesan);

                                    $('.linav').removeClass("active");
                                    $('#linav1').addClass("active in");
                                    $('.anavitab').attr("aria-expanded", "false");
                                    $('#navitab_2_1').attr("aria-expanded", "true");
                                    $('.tab-pane').removeClass("active in");
                                    $('#tab_2_1').addClass("active in");
                                }

                            });
                        }
                        function ajaxUbah() {
                            ajaxModal();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "<?php echo base_url(); ?>cukai/trans_keluar/ubah",
                                data: dataString,
                                success: function (data) {
                                    $('#id_btnBatal').trigger('click');
                                    $('#id_Reload').trigger('click');
                                    //readyToStart();
                                    UIToastr.init(data.tipePesan, data.pesan);

                                    $('.linav').removeClass("active");
                                    $('#linav1').addClass("active in");
                                    $('.anavitab').attr("aria-expanded", "false");
                                    $('#navitab_2_1').attr("aria-expanded", "true");
                                    $('.tab-pane').removeClass("active in");
                                    $('#tab_2_1').addClass("active in");
                                }

                            });
                        }

                        $('#id_formAdvance').submit(function (event) {

                            dataString = $("#id_formAdvance").serialize();
                            event.preventDefault();
                            var aksiBtn = $('#idTmpAksiBtn').val();
                            if (aksiBtn == '1') {
                                var stokavl = $('#id_stokAvl').val();
                                stokavl = parseFloat(CleanNumber(stokavl));
                                if (stokavl <= 0) {
                                    bootbox.confirm("Stok anda tidak mencukupi untuk membuat sales order, apakah anda yakin menyimpan data ini?", function (o) {
                                        if (o == true) {
                                            ajaxSubmitAdvance();
                                        }
                                    });
                                } else {
                                    bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
                                        if (o == true) {
                                            ajaxSubmitAdvance();
                                        }
                                    });

                                }
                            }else if(aksiBtn == '2'){
                                var stokavl = $('#id_stokAvl').val();
                                stokavl = parseFloat(CleanNumber(stokavl));
                                if (stokavl <= 0) {
                                    bootbox.confirm("Stok anda tidak mencukupi untuk membuat sales order, apakah anda yakin menyimpan data ini?", function (o) {
                                        if (o == true) {
                                            ajaxUbah();
                                        }
                                    });
                                } else {
                                    bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
                                        if (o == true) {
                                            ajaxUbah();
                                        }
                                    });

                                }
                            }


                        });
//                                bootbox.confirm("Are you sure?", function (o) {
//                                        //alert("Confirm result: " + stokavl)
//                                        if (o == true){
//                                           // ajaxSubmitAdvance();
//                                        }else{
//                                            return false;
//                                        }
//                                    });

/*
* 
 $(".cls_hitungBerat").focusout(function () {
                            hitungBerat();
                        });
                        $(".cls_hitungBeratMdl").focusout(function () {
                            hitungBeratMdl();
                        });
 function hitungBerat() {
                            var beratMolindo = parseFloat(CleanNumber($('#id_beratMolindo').val()));
                            var bruto = parseFloat(CleanNumber($('#id_bruto').val()));
                            var tarra = parseFloat(CleanNumber($('#id_tarra').val()));
                            var netto = bruto - tarra;
                            var selisih = beratMolindo - netto;
                            $('#id_netto').val(number_format(netto, 2));
                            $('#id_selisihKg').val(number_format(selisih, 2));
                            var fkLt = parseFloat(CleanNumber($('#idSatuanLt').val()));
                            var selisihLt = selisih * fkLt;
                            $('#id_selisihLt').val(number_format(selisihLt, 2));
                            var selisihPersen = selisih / beratMolindo * 100;
                            $('#id_selisihPersen').val(number_format(selisihPersen, 2));

                            $('#id_produkKg').val(number_format(netto, 2));
                            hitungBeratMdl();
                        }
                        function hitungBeratMdl() {
                            var kg = parseFloat(CleanNumber($('#id_produkKg').val()));
                            var fkLt = parseFloat(CleanNumber($('#idSatuanLt').val()));
                            var fkDrum = parseFloat(CleanNumber($('#idSatuanDrum').val()));

                            var lt = kg * fkLt;
                            $('#id_produkLt').val(number_format(lt, 2));

                            var drum = kg * fkDrum;
                            $('#id_produkDrum').val(number_format(drum, 2));

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
                                var hargaSatuan = $('#id_hargaSatuan').val();
                                var hargaTotal = $('#id_hargaTotal').text();
                                hargaTotal.trim();
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

                                jmlKg = parseFloat(CleanNumber(kg));

                                var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));

                                var total_kg = jmlKg + totalKg;

                                $('#id_totalKg').val(number_format(total_kg, 2));

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
 */


</script>


<!-- END JAVASCRIPTS -->