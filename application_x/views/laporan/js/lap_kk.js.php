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
            window.open("<?php echo base_url('laporan/lap_kk/cetak/'); ?>/" + ktp , '_blank');//+ idAdvance + masterId        
    }


//Grid penerima bantuan
var TableManaged3 = function () {
var initTable3 = function () {
    var table3 = $('#idGridSelectPenerima');
    // begin first table
    table3.dataTable({
        "ajax": "<?php echo base_url("/laporan/lap_kk/getKK"); ?>",
        "columns": [
            {"data": "select"},
            {"data": "idKK"},
            {"data": "idKtp"},
            {"data": "namaKtp"},
            {"data": "kec"},
            {"data": "kel"},
            {"data": "rw"},
            {"data": "rt"},
            {"data": "jmlAgt"},
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
