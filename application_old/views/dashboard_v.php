<!-- BEGIN PAGE BREADCRUMB -->

<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <!-- KONTEN DI SINI YA -->
       <!--<img id="id_imgCR" src="<?php /* //echo base_url('metronic/img/rusun05.jpg'); */ ?>" alt=""/>-->
        <h3 class="font-grey-cascade">Dashboard <small>Statistik per Kecamatan</small></h3>
    </div>

</div>
<!-- BEGIN ROW -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue-madison" href="#">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?php echo $db_total[0]->jumlah; ?>"><?php echo $db_total[0]->jumlah; ?></span>
                        </div>
                        <div class="desc"> Sentra Usaha </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 yellow-lemon" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?php echo $db_total[1]->jumlah; ?>"><?php echo $db_total[1]->jumlah; ?></span> </div>
                        <div class="desc"> Komunitas </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green-haze" href="#">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?php echo $db_total[2]->jumlah; ?>"><?php echo $db_total[2]->jumlah; ?></span>
                        </div>
                        <div class="desc"> Pasar </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red-flamingo" href="#">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number"> 
                            <span data-counter="counterup" data-value="<?php echo $db_total[3]->jumlah; ?>"><?php echo $db_total[3]->jumlah; ?></span> </div>
                        <div class="desc"> Lembaga Keuangan </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green-turquoise" href="#">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?php echo $db_total[4]->jumlah; ?>"><?php echo $db_total[4]->jumlah; ?></span>
                        </div>
                        <div class="desc"> Jumlah KK </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple-plum" href="#">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?php echo $db_total[5]->jumlah; ?>"><?php echo $db_total[5]->jumlah; ?></span>
                        </div>
                        <div class="desc"> Jumlah Penduduk </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">



        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->


    </div>
</div>
<div class="row">
    <div class="col-md-6">

        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Statistik Kecamatan Nusapenida
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>

                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    
                </div>

                <div class="table-toolbar">
                    <table class="table table-striped table-bordered table-hover text_kanan" id="id_TabelNusapenida">
                        <thead>
                            <tr>
                                <th>
                                    Kelurahan
                                </th>
                                <th>
                                    Jml Sentra Usaha
                                </th>
                                <th>
                                    Jml Komunitas
                                </th>
                                <th>
                                    Jml Pasar
                                </th>
                                <th>
                                    Jml LK
                                </th>
                                <th>
                                    Jml KK
                                </th>
                                <th>
                                    Jml Penduduk
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
        <!-- END SAMPLE TABLE PORTLET-->


    </div>
    <div class="col-md-6">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Statistik Kecamatan Bajangkaran
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>

                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <table class="table table-striped table-bordered table-hover text_kanan" id="id_TabelBajangkaran">
                        <thead>
                            <tr>
                                <th>
                                    Kelurahan
                                </th>
                                <th>
                                    Jml Sentra Usaha
                                </th>
                                <th>
                                    Jml Komunitas
                                </th>
                                <th>
                                    Jml Pasar
                                </th>
                                <th>
                                    Jml LK
                                </th>
                                <th>
                                    Jml KK
                                </th>
                                <th>
                                    Jml Penduduk
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
        <!-- END SAMPLE TABLE PORTLET-->

    </div>
</div>
<div class="row">
    <div class="col-md-6">

        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Statistik Kecamatan Klungkung
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>

                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    
                </div>

                <div class="table-toolbar">
                    <table class="table table-striped table-bordered table-hover text_kanan" id="id_TabelKlungkung">
                        <thead>
                            <tr>
                                <th>
                                    Kelurahan
                                </th>
                                <th>
                                    Jml Sentra Usaha
                                </th>
                                <th>
                                    Jml Komunitas
                                </th>
                                <th>
                                    Jml Pasar
                                </th>
                                <th>
                                    Jml LK
                                </th>
                                <th>
                                    Jml KK
                                </th>
                                <th>
                                    Jml Penduduk
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
        <!-- END SAMPLE TABLE PORTLET-->


    </div>
    <div class="col-md-6">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Statistik Kecamatan Dawan
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>

                </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <table class="table table-striped table-bordered table-hover text_kanan" id="id_TabelDawan">
                        <thead>
                            <tr>
                                <th>
                                    Kelurahan
                                </th>
                                <th>
                                    Jml Sentra Usaha
                                </th>
                                <th>
                                    Jml Komunitas
                                </th>
                                <th>
                                    Jml Pasar
                                </th>
                                <th>
                                    Jml LK
                                </th>
                                <th>
                                    Jml KK
                                </th>
                                <th>
                                    Jml Penduduk
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
        <!-- END SAMPLE TABLE PORTLET-->

    </div>
</div>
<!-- END ROW -->

<!-- END PAGE CONTENT-->

<!-- BEGIN CORE PLUGINS -->
<?php $this->load->view('app.min.inc.php'); ?>
<script>
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        
        TableManaged.init();
    });
    var TableManaged = function () {

        var initTable1 = function () {

            var table = $('#id_TabelNusapenida');

            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/main/getDbSuNusapenida"); ?>",
                "columns": [
                    {"data": "nama_kel"},
                    {"data": "jml_su"},
                    {"data": "jml_komunitas"},
                    {"data": "jml_pasar"},
                    {"data": "jml_lkm"},
                    {"data": "jml_kk"},
                    {"data": "jml_warga"},

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
                var idKel = $(this).find("td").eq(0).html();

                $('#id_kelId').val(idKel);
                getDescKel(idKel);
                $("#navitab_2_2").trigger('click');
                //$('#').val();
                $('#btnCloseModalDataUser').trigger('click');
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);
                $('#id_namaKel').focus();

            });

            tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
        }
        var initTable2 = function () {

            var table = $('#id_TabelBajangkaran');

            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/main/getDbBajangkaran"); ?>",
                "columns": [
                    {"data": "nama_kel"},
                    {"data": "jml_su"},
                    {"data": "jml_komunitas"},
                    {"data": "jml_pasar"},
                    {"data": "jml_lkm"},
                    {"data": "jml_kk"},
                    {"data": "jml_warga"},

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
                var idKel = $(this).find("td").eq(0).html();

                $('#id_kelId').val(idKel);
                getDescKel(idKel);
                $("#navitab_2_2").trigger('click');
                //$('#').val();
                $('#btnCloseModalDataUser').trigger('click');
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);
                $('#id_namaKel').focus();

            });

            tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
        }
        var initTable3 = function () {

            var table = $('#id_TabelKlungkung');

            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/main/getDbKlungkung"); ?>",
                "columns": [
                    {"data": "nama_kel"},
                    {"data": "jml_su"},
                    {"data": "jml_komunitas"},
                    {"data": "jml_pasar"},
                    {"data": "jml_lkm"},
                    {"data": "jml_kk"},
                    {"data": "jml_warga"},

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
                var idKel = $(this).find("td").eq(0).html();

                $('#id_kelId').val(idKel);
                getDescKel(idKel);
                $("#navitab_2_2").trigger('click');
                //$('#').val();
                $('#btnCloseModalDataUser').trigger('click');
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);
                $('#id_namaKel').focus();

            });

            tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
        }
        var initTable4 = function () {

            var table = $('#id_TabelDawan');

            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/main/getDbDawan"); ?>",
                "columns": [
                    {"data": "nama_kel"},
                    {"data": "jml_su"},
                    {"data": "jml_komunitas"},
                    {"data": "jml_pasar"},
                    {"data": "jml_lkm"},
                    {"data": "jml_kk"},
                    {"data": "jml_warga"},

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
                var idKel = $(this).find("td").eq(0).html();

                $('#id_kelId').val(idKel);
                getDescKel(idKel);
                $("#navitab_2_2").trigger('click');
                //$('#').val();
                $('#btnCloseModalDataUser').trigger('click');
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);
                $('#id_namaKel').focus();

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
                initTable2();
                initTable3();
                initTable4();
            }
        };
    }();
   //id_TabelBajangkaran
</script>