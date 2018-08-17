<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">
    table#idTabelPO th{
        font-size: 13px;
    }
    table#idTabelPO td{
        font-size: 12px;
    }
    /*
    .styleDataTabel th:nth-child(12),th:nth-child(13),td:nth-child(12),td:nth-child(13){
        display: none;
    }
    */
    table#idTabelPO td:nth-child(6) {
        text-align: right;
    }
    table#idTabelPO td:nth-child(5) {
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
                    <div class="col-md-9">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-2" for="id_tglAwalDataDaftar">Data tanggal</label>
                                <div class="col-md-2">
                                    <input id="id_tglAwalDataDaftar" required="required" placeholder="dd-mm-yyyy"
                                           class="form-control input-sm date-picker cls_3harilalu" type="text"
                                           name="tglAwalDataDaftar" data-date-format="dd-mm-yyyy" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1" for="id_tglAkhirDataDaftar">sampai</label>
                                <div class="col-md-2">
                                    <input id="id_tglAkhirDataDaftar" required="required" placeholder="dd-mm-yyyy"
                                           class="form-control input-sm date-picker cls_3harikemudian" type="text"
                                           name="tglAkhirDataDaftar" data-date-format="dd-mm-yyyy"  />
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="id_noSO" id="id_noSO" class="hidden">
                                <input type="text" name="rowTabel" id="id_rowTabel" class="hidden">
                                <input type="text" name="jmlProduk" id="id_jmlProduk" class="hidden">
                                <!--                                                <label class="control-label col-md-1" for="id_Reload">&nbsp;  </label>-->
                                <div class="col-md-2">
                                    <a href="#" class='cls_Reload btn btn-sm btn-default' id='id_Reload'><i class='fa fa-refresh'></i> Reload</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover table-header-fixed " id="idTabelPO">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        No SO
                                    </th>

                                    <th>
                                        Tgl Kirim
                                    </th>
                                    <th>
                                        Customer
                                    </th>
                                    <th>
                                        No SJ
                                    </th>    
                                    <th>
                                        Produk
                                    </th>
                                    <th>
                                        Dok
                                    </th>
                                    <th>
                                        Jumlah
                                    </th>
                                    <th>
                                        No Batch
                                    </th>
<!--                                                <th>
                                        Kendaraan
                                    </th>
                                    <th>
                                        Supir
                                    </th>-->
                                    <th>
                                        Input No aju
                                    </th>
                                    <th>
                                        Input No Daftar
                                    </th>
                                    <th>
                                        No aju
                                    </th>
                                    <th>
                                        No Daftar
                                    </th>
<!--                                                <th>
                                        BA Penyegelan
                                    </th>
                                    <th>
                                        BA Buka Segel
                                    </th>-->
                                    <th>
                                        Keterangan
                                    </th>
                                    <th>
                                        Act
                                    </th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
<!--                            <tfoot>
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
                                        Tgl Order
                                    </th> 
                                    <th>
                                        Tgl Kirim
                                    </th> 
                                    <th>
                                        Jumlah
                                    </th>
                                    <th>
                                        No cukai
                                    </th>
                                    <th>
                                        No batch
                                    </th>
                                </tr>

                            </tfoot>-->
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end <div class="portlet green-meadow box"> -->
    </div>
</div>

<!-- END PAGE CONTENT-->

<!--  MODAL Data Karyawan -->

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

    jQuery(document).ready(function () {
        TableManaged.init();
        UIBootbox.init();
        ComponentsDateTimePickers.init();
    });
    //Ready Doc
    btnStart();
    readyToStart();
    tglTransStart();

    //window.open( baseurl+"master_rusun/selectedRusun/"+idroom, "_self");
    var TableManaged = function () {

        var initTable1 = function () {
            var tglAwalDaftar = $('#id_tglAwalDataDaftar').val();
            var tglAkhirDaftar = $('#id_tglAkhirDataDaftar').val();
            // begin first table
            var table = $('#idTabelPO'),
                    t = table.dataTable({
                        "ajax": {
                            'type': 'POST',
                            'url': '<?php echo base_url("/transaksi/ganocukai/getRencanaOutAll"); ?>',
                            'data': function (d) {
                                d.tglAwalDaftar = $('#id_tglAwalDataDaftar').val();
                                d.tglAkhirDaftar = $('#id_tglAkhirDataDaftar').val();
                            }
                        },
                        "columns": [
                            {"data": "noSeq"},
                            {"data": "idMaster"},
                            {"data": "tglKirim"},
                            {"data": "namaCust"},
                            {"data": "no_sj"},
                            {"data": "nama_produk"},
                            {"data": "no_jnsdoc"},
                            {"data": "totalQty"},
                            {"data": "no_batch"},
                            {"data": "input_no_aju"},
                            {"data": "input_no_cukai"},
                            {"data": "no_aju"},
                            {"data": "no_cukai"},
                            {"data": "keterangan_so"},
                            {"data": "act"}

                        ],
                        "rowId": 'idMaster',
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
                        "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                        "buttons": [
                            {
                                extend: "print",
                                orientation: "landscape",
                                pageSize: "A4",
                                className: "btn dark btn-outline",
                                exportOptions: {
                                    columns: ':visible'
                                },
                                customize: function (win) {
                                    $(win.document.body)
                                            .css('font-size', '9pt');

                                    $(win.document.body).find('table')
                                            .addClass('compact')
                                            //.addClass('styleDataTabel')
                                            .css('font-size', 'inherit');
                                },
                                header: true,
                                title: "<center><h4>Jadwal Pengiriman</h4></center> <center><h4>PT Sumber Kita Indah</h4></center>"
                            },
                            {
                                extend: "copy",
                                className: "btn red btn-outline",
                                header: true,
                                exportOptions: {
                                    columns: ':visible'
                                },
                            },
                            {
                                extend: "pdf",
                                orientation: "landscape",
                                pageSize: "A4",
                                className: "btn green btn-outline",
                                title: "Jadwal Pengiriman Barang \n PT. Sumber Kita Indah",
                                customize: function (doc) {
                                    doc.defaultStyle.fontSize = 11;

                                    //<-- set fontsize to 16 instead of 10 
                                }, exportOptions: {
                                    columns: ':visible'
                                },
                            },
                            {
                                extend: "excel",
                                className: "btn yellow btn-outline ",
                                exportOptions: {
                                    columns: ':visible'
                                },
                            },
                            {
                                extend: "csv",
                                className: "btn purple btn-outline ",
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: "colvis",
                                className: "btn green btn-outline ",
                                text: "Kolom"
                            }
                        ],
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

            table.on('click', 'tbody tr', function () {
                var noSO = $(this).find("td").eq(1).html();
                $('#id_noSO').val(noSO);
                var id_row = $(this).attr('id');
                $('#id_rowTabel').val(id_row);
                var jmlProduk = $(this).find("td").eq(7).html();
                $('#id_jmlProduk').val(jmlProduk);
                /*var baseurl = "<?php //echo base_url();              ?>";*/
                /*var noSO = $(this).find("td").eq(0).html();
                 var noCukai = $(this).find("td").eq(6).html();
                 if (noCukai == "") {
                 noCukai = 0;
                 } else {
                 noCukai = 1;
                 }*/
                //window.open(baseurl + "transaksi/ganocukai/selectedSO/" + noSO + "/" + noCukai, "_self");

            });

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
    function editBaris(noRow) {
        var idRow = $("#id_rowTabel").val();
        if (noRow != null) {
            bootbox.confirm("Anda yakin menyimpan data ini?", function (o) {
                if (o == true) {
                    var no = noRow;
                    var noCukai = $('#id_tempNoCukai' + no).val();
                    var noAju = $('#id_tempNoAju' + no).val();
                    var noSO = $('#id_noSO').val();
                    var jmlProduk = $('#id_jmlProduk').val();
                    //alert(noCukai+" "+noSO+" "+noAju);
                    ajaxModal();
                    if (noSO != '') {
                        $.post("<?php echo site_url('/transaksi/ganocukai/ubah'); ?>",
                                {
                                    'noSO': noSO,
                                    'noCukai': noCukai,
                                    'noAju': noAju,
                                    'jmlProduk':jmlProduk
                                }, function (data) {
                            if (data.baris == 1) {
                                $('#id_tempNoCukai' + no).val(data.no_cukai);
                                $('#id_tempNoAju' + no).val(data.no_aju);
                                $('#' + idRow).find("td").eq(12).html(data.no_cukai);
                                $('#' + idRow).find("td").eq(11).html(data.no_aju);
                                UIToastr.init(data.tipePesan, data.pesan);
                                /*
                                 $('#').val(data.); */
                            } else {
                                UIToastr.init(data.tipePesan, data.pesan);
                            }
                        }, "json");
                    }//if kd<>''
                }
            });

        }
    }

</script>


<!-- END JAVASCRIPTS -->