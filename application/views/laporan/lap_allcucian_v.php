<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">

    table#idTabelPO td:nth-child(8) {
        text-align: right;
    }
    table#idTabelPO td:nth-child(9) {
        text-align: right;
    }
    table#idTabelPO td:nth-child(10) {
        text-align: right;
    }
    table#idTabelPO td:nth-child(11) {
        text-align: right;
    }
    table#idTabelPO td:nth-child(12) {
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


                <div class="row">
                    <div class="col-md-9">
                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label>Tgl Masuk</label>
                                    <input id="id_tglAwalDataDaftar"  placeholder="dd-mm-yyyy"
                                           class="form-control input-sm date-picker cls_3harilalu cls_tidakkosong" type="text"
                                           name="tglAwalDataDaftar" data-date-format="dd-mm-yyyy" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label>sampai</label>
                                    <input id="id_tglAkhirDataDaftar"  placeholder="dd-mm-yyyy"
                                           class="form-control input-sm date-picker cls_tglhariini_static cls_tidakkosong" type="text"
                                           name="tglAkhirDataDaftar" data-date-format="dd-mm-yyyy"  />
                                </div>
                            </div>
                            
                            <div class="form-group"> 
                                <div class="col-md-2">
                                    <label>Action</label>
                                    <a href="#" class='cls_Reload btn btn-sm btn-default' id='id_Reload'><i class='fa fa-refresh'></i> Reload</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover styleDataTabel" id="idTabelPO">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        No Cucian
                                    </th>
                                    <th>
                                        No Bon
                                    </th>
                                    <th>
                                        Customer
                                    </th>
                                    <th>
                                        Tgl Masuk
                                    </th>
                                    <th>
                                        Tgl Selesai
                                    </th>
                                    <th>
                                        Layanan
                                    </th>
                                    <th>
                                        Jml Satuan
                                    </th>
                                    
                                    <th>
                                        Jml Kiloan
                                    </th>
                                    
                                    <th>
                                        Outsource
                                    </th>
                                    <th>
                                        Pekerjaan
                                    </th>
                                    <th>
                                        Bayar
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
            <!-- end <div class="portlet green-meadow box"> -->
        </div>

    </div>
</div>
<!-- END PAGE CONTENT-->

<?php $this->load->view('app.min.inc.php'); ?>
<script>
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        UIBootbox.init();
        $("input[readonly='true']").focus(function () {
            $(this).next();
        });
        TableManaged.init();
    });

    //Ready Doc
    btnStart();
    readyToStart();
    tglTransStart();

    $('#id_btnBatal').click(function () {
        btnStart();
        resetForm();
        readyToStart();
        tglTransStart();
        $('#id_body_data').empty();
        $('#id_customer').select2('val', '');
        $('.cls_diskon_lgsbayar').hide();
    });
    var TableManaged = function () {

        var initTable1 = function () {
            var tglAwalDaftar = $('#id_tglAwalDataDaftar').val();
            var tglAkhirDaftar = $('#id_tglAkhirDataDaftar').val();
            var idKaryawan = $('#id_karyawan').val();

            // begin first table
            var table = $('#idTabelPO'),
                    t = table.dataTable({
                        "ajax": {
                            'type': 'POST',
                            'url': '<?php echo base_url("/laporan/lap_allcucian/getCucianAmbil"); ?>',
                            'data': function (d) {
                                d.tglAwalDaftar = $('#id_tglAwalDataDaftar').val();
                                d.tglAkhirDaftar = $('#id_tglAkhirDataDaftar').val();
                                d.idKaryawan = $('#id_karyawan').val();
                            }
                        },
                        "columns": [
                            {"data": "noSeq"},
                            {"data": "idMaster"},
                            {"data": "noBon"},
                            {"data": "nama_cust"},
                            {"data": "tgl_trans"},
                            {"data": "tgl_selesai"},
                            {"data": "layanan"},
                            {"data": "total_qty_satuan"},              
                            {"data": "total_qty_kg"},
                            {"data": "status_outsource"},
                            {"data": "status_selesai"},
                            {"data": "status_bayar"}
                        ],

                        /*
                         
                         'footerCallback': function (tfoot, data, start, end, display) {
                         var response = this.api().ajax.json();
                         if (response) {
                         var $th = $(tfoot).find('th');
                         $th.eq(0).html(response['ttl_harga']);
                         $th.eq(1).html(response['ttl_harga']);
                         }
                         },
                         */
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
                        "dom": "<'row' <'col-md-12'B> > <'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
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
                                title: "Laporan Piutang Agen \n Mega Jaya Laundry",
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
                        "columnDefs": [
                            {// set default column settings 
                                'orderable': true,
                                "searchable": true,
                                'targets': [0]
                            }
                        ],
                        "order": [
                            [0, "asc"]
                        ] // set first column as a default sort by asc
                    });
            $('#id_Reload').click(function () {
                table.api().ajax.reload();
            });
            $("#id_dataTableActions > li > a.tool-action").on("click", function () {
                var e = $(this).attr("data-action");
                t.DataTable().button(e).trigger();
            })

        }
        return {
            //main function to initiate the module
            init: function () {
                if (!jQuery().dataTable) {
                    return;
                }
                initTable1();
                // jQuery().dataTable && (a(), n())
            }
        };
    }();

</script>


<!-- END JAVASCRIPTS -->