<script>
var table;
    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        TableManaged.init();
        TableManaged2.init();
        TableManaged3.init();
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
                "ajax": "<?php echo base_url("/transaksi/trans_bantuan/getBantuanAll"); ?>",
                "columns": [
                    {"data": "no"},
                    {"data": "id_t_bantuan"},
                    {"data": "id_ktp"},
                    {"data": "id_jns_bantuan"},
                    {"data": "jns_bantuan"},
                    {"data": "nama_bantuan"},
                    {"data": "nama_ktp"},
                    {"data": "id_m_instansi"},
                    {"data": "idsession"},
                    {"data": "tgl_bantuan"},
                    {"data": "nama_instansi"},
                    {"data": "ket"}
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
                    },
                    {"targets": [1], "visible": false, "searchable": false},
                    {"targets": [3], "visible": false, "searchable": false},
                    {"targets": [7], "visible": false, "searchable": false},
                    {"targets": [8], "visible": false, "searchable": false},
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
                table.fnSetColumnVis(1, true);
                table.fnSetColumnVis(3, true);
                table.fnSetColumnVis(7, true);
                table.fnSetColumnVis(8, true);

                var idjnsbantuan = $(this).find("td").eq(3).html();
                var idSession = $(this).find("td").eq(8).html();
                var idinstansi = $(this).find("td").eq(7).html();
                var tglBantuan = $(this).find("td").eq(9).html();
                var iBantuan = $(this).find("td").eq(5).html();
                var iKet = $(this).find("td").eq(11).html();

                getDetailBantuan(idjnsbantuan,idSession,tglBantuan,idinstansi,iBantuan,iKet);
                 $("#navitab_2_2").trigger('click');
                //$('#').val();
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

$("#navitab_2_2").click(function(e){
    table.fnSetColumnVis(1, false);
    table.fnSetColumnVis(3, false);
    table.fnSetColumnVis(7, false);
    table.fnSetColumnVis(8, false);
});

    // getDetailBantuan(idSession,tglBantuan,idinstansi,iBantuan,iKet);

function getDetailBantuan(idjnsbantuan,a,tgl,idInstansi,iBantuan,iKet){
    $.ajax({
        url: "<?php echo base_url("transaksi/trans_bantuan/ajax_detail"); ?>", // json datasource
        type: "POST",
        dataType: "json",
        data: {sSes:a},
        success: function (e) {
            if (e.act == true) {
                iPID=e.iPid;
                $('#idGridPenerima').DataTable().ajax.reload();
                $('#id_jns_bantuan').select2('val',idjnsbantuan);
                $('#id_bantuan').val(iBantuan);
                $('#id_tgl_bantuan').val(tgl);
                $('#id_instansi').select2('val',idInstansi);
                $('#id_ket').val(iKet);
            }
        },
        complete:function(e){
        }
    });    
}

$("#navitab_2_2").click(function(){
    iPID="";
    $("#id_BantuanId").val('');    
    $("#id_tgl_bantuan").val('');    
    $("#id_instansi").select2('val','');    
    $("#id_bantuan").val('');    
    $("#id_ket").val('');    
    $('#idGridPenerima').DataTable().ajax.reload();
});
//Grid penerima bantuan
var TableManaged2 = function () {

var initTable2 = function () {

    var table2 = $('#idGridPenerima');

    // begin first table
    table2.dataTable({
        "ajax":{ 
            "url":"<?php echo base_url("/transaksi/trans_bantuan/getPenerima"); ?>",
            "type": "POST",
            "data": function (z) {
                    z.sPID = iPID;
                }
        },
        "columns": [
            {"data": "no"},
            {"data": "id_ktp"},
            {"data": "nama_ktp"},
            {"data": "jekel"},
            {"data": "tanggal_lahir"},
            {"data": "act"},
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

function del_temp(a){
    $.ajax({
        url: "<?php echo base_url("transaksi/trans_bantuan/ajax_delTemp"); ?>", // json datasource
        type: "POST",
        dataType: "json",
        data: {sId:a,sPID:iPID},
        success: function (e) {
            if (e.act == true) {
                    UIToastr.init(e.tipePesan, e.pesan);
                    iPID=e.iPid;
                    $('#idGridPenerima').DataTable().ajax.reload();
            }else{
                UIToastr.init(e.tipePesan, e.pesan);                    
                iPID="";
            }
        },
        complete:function(e){
        }
    });    
}

function tambahPeserta(){ 
    if($("#id_bantuan").val()==""||$("#id_tgl_bantuan").val()==""
    ||$("#id_instansi").val()==""||$("#id_ket").val()==""){
        alert("Data harus diisi semua.!")
    }else{
        $("#idDivSelectKTP").modal();
    }
}
//Grid penerima bantuan
var TableManaged3 = function () {
var initTable3 = function () {
    var table3 = $('#idGridSelectPenerima');
    // begin first table
    table3.dataTable({
        "ajax": "<?php echo base_url("/transaksi/trans_bantuan/getKTP"); ?>",
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

var iPID="";
function select(a){
    $("#id_btnBatalSelect").trigger("click");
    $.ajax({
        url: "<?php echo base_url("transaksi/trans_bantuan/ajax_saveSelect"); ?>", // json datasource
        type: "POST",
        dataType: "json",
        data: {sKtp:a,sjns_bantuan:$("#id_jns_bantuan").val(),sBantuan:$("#id_bantuan").val(),sInstansi:$("#id_instansi").val(),sTgl:$("#id_tgl_bantuan").val(),sKet:$("#id_ket").val(),sPID:iPID},
        success: function (e) {
            if (e.act == true) {
                    UIToastr.init(e.tipePesan, e.pesan);
                    iPID=e.iPid;
                    $('#idGridPenerima').DataTable().ajax.reload();
            }else{
                UIToastr.init(e.tipePesan, e.pesan);                    
                iPID="";
            }
        },
        complete:function(e){
        }
    });
}

function simpanBantuan(){
    var r = confirm('Anda yakin menyimpan data ini?');
        if (r == true) {
            $.ajax({
                url: "<?php echo base_url("transaksi/trans_bantuan/ajax_simpanBantuan"); ?>", // json datasource
                type: "POST",
                dataType: "json",
                data: {sPID:iPID,sBantuan:$("#id_bantuan").val(),sjns_bantuan:$("#id_jns_bantuan").val(),sInstansi:$("#id_instansi").val(),sTgl:$("#id_tgl_bantuan").val(),sKet:$("#id_ket").val()},
                success: function (e) {
                    if (e.act == true) {
                            UIToastr.init(e.tipePesan, e.pesan);
                            // $('#idGridPenerima').DataTable().ajax.reload();
                            $('#idTabelBantuan').DataTable().ajax.reload();
                            $("#navitab_2_1").trigger('click');
                    }else{
                        UIToastr.init(e.tipePesan, e.pesan);                    
                    }
                },
                complete:function(e){
                }
            });
        } else {
            return false;
        }
}










//end dipakai

    btnStart();
    $("#id_namaBantuan").focus();
    $('#id_btnBatal').click(function () {
        btnStart();
    });
    $("#id_BantuanId").focusout(function () {
        var id_t_bantuan = $(this).val();
        getDescBantuan(id_t_bantuan);
    });
    function getDescBantuan(id_t_bantuan) {
        ajaxModal();
        if (id_t_bantuan != '') {
            $.post("<?php echo site_url('/transaksi/trans_bantuan/getDescBantuan'); ?>",
                    {
                        'id_t_bantuan': id_t_bantuan
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_namaBantuan').val(data.nama_Bantuan);
                    $('#id_alamat').val(data.alamat);
                    $('#id_telp').val(data.telp);
                    $('#id_npwp').val(data.npwp);
                    /*
                     $('#').val(data.); */
                } else {
                    alert('Data tidak ditemukan!');
                    $('#id_btnBatal').trigger('click');
                }
            }, "json");
        }//if kd<>''
    }
    // function ajaxSubmit() {
    //     ajaxModal();
    //     $.ajax({
    //         type: "POST",
    //         dataType: "json",
    //         url: "<?php echo base_url(); ?>transaksi/trans_bantuan/simpan",
    //         data: dataString,
    //         success: function (data) {
    //             $('#id_Reload').trigger('click');
    //             $('#id_btnBatal').trigger('click');
    //             UIToastr.init(data.tipePesan, data.pesan);
    //         }

    //     });
    // }
    function ajaxUbah() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>transaksi/trans_bantuan/ubah",
            data: dataString,
            success: function (data) {
                $('#id_Reload').trigger('click');
                $('#id_btnBatal').trigger('click');
                UIToastr.init(data.tipePesan, data.pesan);
            }

        });
    }
    function ajaxHapus() {
        ajaxModal();
        var id_t_bantuan = $('#id_BantuanId').val();
        id_t_bantuan = id_t_bantuan.trim();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>transaksi/trans_bantuan/hapus",
            data: {id_t_bantuan: id_t_bantuan},
            success: function (data) {
                $('#id_Reload').trigger('click');
                $('#id_btnBatal').trigger('click');
                UIToastr.init(data.tipePesan, data.pesan);
            }

        });
        
    }
    $('#id_formBantuan').submit(function (event) {
        dataString = $("#id_formBantuan").serialize();
        
        var aksiBtn = $('#idTmpAksiBtn').val();
        if (aksiBtn == '1') {
            var r = confirm('Anda yakin menyimpan data ini?');
            if (r == true) {
                ajaxSubmit();
            } else {//if(r)
                return false;
            }
        } else if (aksiBtn == '2') {
            var r = confirm('Anda yakin merubah data ini?');
            if (r == true) {
                ajaxUbah();
            } else {//if(r)
                return false;
            }
        } else if (aksiBtn == '3') {
            var r = confirm('Anda yakin menghapus data ini?');
            if (r == true) {
                ajaxHapus();
            } else {//if(r)
                return false;
            }
        }
        event.preventDefault();
    });

</script>


<!-- END JAVASCRIPTS -->