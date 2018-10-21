<script>
    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        TableManaged3.init();

    });

    btnStart();
    readyToStart();
    
    function cetak(ktp) {
        if (ktp==''){ktp='-';}
            window.open("<?php echo base_url('laporan/lap_ktp/cetak/'); ?>/" + ktp , '_blank');//+ idAdvance + masterId        
    }

    function cetakall() {
            window.open("<?php echo base_url('laporan/lap_ktp/cetakall/'); ?>", '_blank');//+ idAdvance + masterId        
    }

//Filter
var iKec="";
var iKel="";
var iBanjar="";
$("#id_kec").change(function () {
        iKec = $(this).val();
        getKelAll();
    });
    function getKelAll() {
        $.ajax({
            url: "<?php echo base_url("/globalc/getKelAll"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            data: {idMaster: iKec},
            success: function (e) {
                // console.log(e.data_cpa.length)
                if (e.data_cpa.length > 0) {
                    $('#id_kel_').empty();
                    for (i = 0; i < e.data_cpa.length; i++) {
                        var idKel = e.data_cpa[i].id_kel;
                        var namakel = e.data_cpa[i].nama_kel;
                        opt = '<option value="' + idKel + '">' + namakel + '</option>';
                        $('#id_kel').append(opt);
                    }
                }

            },
        });
    }
    $("#id_kel").change(function () {
        iKel = $(this).val();
        getBanjarAll(iKel);
    });
    function getBanjarAll() {
        $.ajax({
            url: "<?php echo base_url("/globalc/getBanjarAll"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            data: {idKel: iKel},
            success: function (e) {
                // console.log(e.data_cpa.length)
                if (e.data_cpa.length > 0) {
                    $('#id_kel_').empty();
                    for (i = 0; i < e.data_cpa.length; i++) {
                        var idBanjar = e.data_cpa[i].id_banjar;
                        var namaBanjar = e.data_cpa[i].nama_banjar;
                        opt = '<option value="' + idBanjar + '">' + namaBanjar + '</option>';
                        $('#id_banjar').append(opt);
                    }
                }

            },
        });
    }
    $("#id_banjar").change(function () {
        iBanjar = $(this).val();
        $('#idGridSelectPenerima').DataTable().ajax.reload();
    });


//Grid penerima bantuan
var TableManaged3 = function () {
var initTable3 = function () {
    var table3 = $('#idGridSelectPenerima');
    // begin first table
    table3.dataTable({
        "ajax":{ 
            "url":"<?php echo base_url("laporan/lap_ktp/getKTP"); ?>",
            "type": "POST",
            "data": function (z) {
                    z.sKec = iKec;
                    z.sKel = iKel;
                    z.sBanjar = iBanjar;
                }
        },
        // "ajax": "<?php echo base_url("/laporan/lap_ktp/getKTP"); ?>",
        "columns": [
            {"data": "select"},
            {"data": "id_ktp"},
            {"data": "nama_ktp"},
            {"data": "jekel"},
            {"data": "tanggal_lahir"},
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
        "dom": "<'rows' <'col-md-12'B> > <'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
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
        table3.api().ajax.reload();
    });

    var tableWrapper = jQuery('#example_wrapper');

    table3.find('.group-checkable').change(function () {
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

    table3.on('change', 'tbody tr .checkboxes', function () {
        $(this).parents('tr').toggleClass("active");
    });

    tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
}


return {
    //main function to initiate the module
    init: function () {
        if (!jQuery().dataTable) {
            return;
        }
        initTable3();
    }
};
}();

</script>
