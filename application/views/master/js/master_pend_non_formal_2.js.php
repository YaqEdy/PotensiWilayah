<script>
var table;
    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        TableManaged.init();
        TableManaged2.init();
        TableManaged3.init();
    });
    $('#id_tahun').datepicker({
        orientation: "left",
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true
    });
    //$(function () {
    var judul_menu = $('#id_a_menu_<?php echo $menu_id; ?>').text();
    $('#id_judul_menu').text(judul_menu);
    // MENU OPEN
    $(".menu_root").removeClass('start active open');
    $("#menu_root_<?php echo $menu_parent; ?>").addClass('start active open');
    // END MENU OPEN
    var TableManaged = function () {

        var initTable1 = function () {

            table = $('#idTabelBantuan');

            // begin first table
            table.dataTable({
        "ajax": "<?php echo base_url("/master/master_pend_non_formal_2/getKTP"); ?>",
        "columns": [
            {"data": "no"},
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
                    },
                    // {"targets": [6], "visible": false, "searchable": false},
                    // {"targets": [7], "visible": false, "searchable": false},
                    // {"targets": [8], "visible": false, "searchable": false},
                    ],
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

                // getDetailBantuan(idSession,itahun,idinstansi,iNamaPend,iJnsPend,iKet);
                 $("#navitab_2_2").trigger('click');
                 var idKtp = $(this).find("td").eq(1).html();
                 var nama = $(this).find("td").eq(2).html();
                 $('#idNIK').val(idKtp);
                 $('#idNama').val(nama);
                iPID=idKtp;

                $('#idGridPenerima').DataTable().ajax.reload();
                $('#idGridbantuan').DataTable().ajax.reload();
                $('#idSave').attr('disabled', false);

                $('#btnCloseModalDataUser').trigger('click');
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);
                $('#id_namaBantuan').focus();

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

    // getDetailBantuan(idSession,tglBantuan,idinstansi,iBantuan,iKet);

// function getDetailBantuan(a,itahun,idinstansi,iNamaPend,iJnsPend,iKet){
// // console.log(itahun,'-',idinstansi,'-',iNamaPend,'-',iJnsPend,'-',iKet)
//     $.ajax({
//         url: "<?php echo base_url("master/master_pend_non_formal_2/ajax_detail"); ?>", // json datasource
//         type: "POST",
//         dataType: "json",
//         data: {sSes:a},
//         success: function (e) {
//             if (e.act == true) {
//                 iPID=e.iPid;
//                 $('#idGridPenerima').DataTable().ajax.reload();
//                 $('#id_nama_pend').val(iNamaPend);
//                 $('#id_jns_pend').val(iJnsPend);
//                 $('#id_tahun').val(itahun);
//                 $('#id_instansi').select2('val',idinstansi);
//                 $('#id_ket').val(iKet);
//             }
//         },
//         complete:function(e){
//         }
//     });    
// }

$("#navitab_2_2").click(function(){
    iPID="0";
    $('#idSave').attr('disabled', true);
    $('#idGridbantuan').DataTable().ajax.reload();
    $('#idGridPenerima').DataTable().ajax.reload();

    $('#idNIK').val('');
    $('#idNama').val('');

    $('#id_nama_pend').val('');
    $('#id_jns_pend').val('');
    $('#id_tahun').val('');
    $('#id_instansi').select2('val','');
    $('#id_ket').val('');
});
//Grid penerima bantuan
var TableManaged2 = function () {

var initTable2 = function () {

    var table2 = $('#idGridPenerima');

    // begin first table
    table2.dataTable({
        "ajax":{ 
            "url":"<?php echo base_url("master/master_pend_non_formal_2/getBantuanAll"); ?>",
            "type": "POST",
            "data": function (z) {
                    z.sPID = iPID;
                }
        },
        "columns": [
            {"data": "no"},
            {"data": "nama_pend"},
            {"data": "jenis_pend"},
            {"data": "tahun"},
            {"data": "nama_instansi"},
            {"data": "ket"},
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
        table2.api().ajax.reload();
    });

    var tableWrapper = jQuery('#example_wrapper');

    table2.find('.group-checkable').change(function () {
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

    table2.on('change', 'tbody tr .checkboxes', function () {
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
        initTable2();
    }
};
}();

// function del_temp(a){
//     $.ajax({
//         url: "<?php echo base_url("master/master_pend_non_formal_2/ajax_delTemp"); ?>", // json datasource
//         type: "POST",
//         dataType: "json",
//         data: {sId:a,sPID:iPID},
//         success: function (e) {
//             if (e.act == true) {
//                     UIToastr.init(e.tipePesan, e.pesan);
//                     iPID=e.iPid;
//                     $('#idGridPenerima').DataTable().ajax.reload();
//             }else{
//                 UIToastr.init(e.tipePesan, e.pesan);                    
//                 iPID="";
//             }
//         },
//         complete:function(e){
//         }
//     });    
// }

function save(){ 
    $.ajax({
        url: "<?php echo base_url("master/master_pend_non_formal_2/ajax_save"); ?>", // json datasource
        type: "POST",
        dataType: "json",
        data: {sKtp:iPID,sNamaPend:$("#id_nama_pend").val(),sInstansi:$("#id_instansi").val(),sJnsPend:$("#id_jns_pend").val(),sKet:$("#id_ket").val(),sTahun:$("#id_tahun").val()},
        success: function (e) {
            if (e.act == true) {
                    UIToastr.init(e.tipePesan, e.pesan);
                    $('#idGridPenerima').DataTable().ajax.reload();
                    $('#id_nama_pend').val('');
                    $('#id_jns_pend').val('');
                    $('#id_tahun').val('');
                    $('#id_instansi').select2('val','');
                    $('#id_ket').val('');
            }else{
                UIToastr.init(e.tipePesan, e.pesan);                    
            }
        },
        complete:function(e){
        }
    });    
    
}
//Grid penerima bantuan
var TableManaged3 = function () {
var initTable3 = function () {
    var table3 = $('#idGridbantuan');
    // begin first table
    table3.dataTable({
        "ajax":{ 
            "url":"<?php echo base_url("master/master_pend_non_formal_2/getBantuan"); ?>",
            "type": "POST",
            "data": function (z) {
                    z.sPID = iPID;
                }
        },
        "columns": [
            {"data": "no"},
            {"data": "jns_bantuan"},
            {"data": "nama_bantuan"},
            {"data": "nama_instansi"},
            {"data": "tgl_bantuan"},
            {"data": "ket"},
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

var iPID="0";
// function select(a){
//     $('#idAddPeserta').attr('disabled', true);
//     $("#id_btnBatalSelect").trigger("click");
//     $.ajax({
//         url: "<?php echo base_url("master/master_pend_non_formal_2/ajax_saveSelect"); ?>", // json datasource
//         type: "POST",
//         dataType: "json",
//         data: {sKtp:a,sNamaPend:$("#id_nama_pend").val(),sInstansi:$("#id_instansi").val(),sJnsPend:$("#id_jns_pend").val(),sKet:$("#id_ket").val(),sTahun:$("#id_tahun").val(),sPID:iPID},
//         success: function (e) {
//             if (e.act == true) {
//                     UIToastr.init(e.tipePesan, e.pesan);
//                     iPID=e.iPid;
//                     $('#idGridPenerima').DataTable().ajax.reload();
//             }else{
//                 UIToastr.init(e.tipePesan, e.pesan);                    
//                 iPID="";
//             }
//         },
//         complete:function(e){
//         }
//     });
// }

// function simpanBantuan(){
//     var r = confirm('Anda yakin menyimpan data ini?');
//         if (r == true) {
//             $.ajax({
//                 url: "<?php echo base_url("master/master_pend_non_formal_2/ajax_simpanBantuan"); ?>", // json datasource
//                 type: "POST",
//                 dataType: "json",
//                 data: {sPID:iPID,sNamaPend:$("#id_nama_pend").val(),sInstansi:$("#id_instansi").val(),sJnsPend:$("#id_jns_pend").val(),sKet:$("#id_ket").val(),sTahun:$("#id_tahun").val()},
//                 success: function (e) {
//                     if (e.act == true) {
//                             UIToastr.init(e.tipePesan, e.pesan);
//                             // $('#idGridPenerima').DataTable().ajax.reload();
//                             $('#idTabelBantuan').DataTable().ajax.reload();
//                             $("#navitab_2_1").trigger('click');
//                     }else{
//                         UIToastr.init(e.tipePesan, e.pesan);                    
//                     }
//                 },
//                 complete:function(e){
//                 }
//             });
//         } else {
//             return false;
//         }
// }










//end dipakai

    btnStart();

</script>


<!-- END JAVASCRIPTS -->