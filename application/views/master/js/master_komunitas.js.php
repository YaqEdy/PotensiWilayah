<script>
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        UIBootbox.init();
        $("input[readonly='true']").focus(function () {
            $(this).next();
        });
        TableManaged.init();

        TableManaged2.init();
        TableManaged3.init();

    });
    var TableManaged = function () {

        var initTable1 = function () {

            var table = $('#idTabelKel');

            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/master/master_komunitas/getKomunitasAll"); ?>",
                "columns": [
                    {"data": "idKomunitas"},
                    {"data": "namaKomunitas"},
                    {"data": "kec"},
                    {"data": "kel"},
                    {"data": "jeniskomunitas"}
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
                var id = $(this).find("td").eq(0).html();

                $('#id_kelId').val(id);
                getDetail(id);
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
            }
        };
    }();
    btnStart();
    $("#id_namaKel").focus();
    $('#id_btnBatal').click(function () {
        btnStart();
        $('#id_kec').select2('val','');
        $('#id_jeniskomunitas').select2('val','');
        $('#id_kel').select2('val','');

    });

    $("#id_kec").change(function () {
        var idKec = $(this).val();
        getKelAll(idKec,'');
    });
    $("#id_kelId").focusout(function () {
        var idKel = $(this).select2('val');
        getDetail(idKel);
    });
    function getKelAll(idKec,id_kel) {
        ajaxModal();
        //cls_body_detail_cucian
        $('#id_kel').empty();
        if (idKec != '') {
            $.post("<?php echo site_url('globalc/getKelAll'); ?>",
                    {
                        'idMaster': idKec
                    }, function (data) {
                if (data.data_cpa.length > 0) {
                    //var opt;

                    for (i = 0; i < data.data_cpa.length; i++) {
                        var idKel = data.data_cpa[i].id_kel;
                        var namakel = data.data_cpa[i].nama_kel;
                        opt = '<option value="' + idKel + '">' + namakel + '</option>';
                        $('#id_kel').append(opt);
                    }

                    if(id_kel!=''){
                        $('#id_kel').select2('val',id_kel);
                        $('#idGridPenerima').DataTable().ajax.reload();
                    }
                } else {
                    //alert('Data tidak ditemukan!');
                    //$('#id_btnBatal').trigger('click');
                }
            }, "json");
        }//if kd<>''
    }
    function getDetail(a){
    $.ajax({
        url: "<?php echo base_url("master/master_komunitas/getDetail"); ?>", // json datasource
        type: "POST",
        dataType: "json",
        data: {sid:a},
        success: function (data) {
            if (data.baris == 1) {
                    $('#id_komunitasId').val(data.id_komunitas);
                    $('#id_namaKomunitas').val(data.nama_komunitas);
                    $('#id_alamat').val(data.alamat);
                    $('#id_kec').select2('val',data.id_kec);
                    $('#id_namaKoordinator').val(data.nama_koordinator);
                    $('#id_noTelp').val(data.no_telp);
                    $('#id_jeniskomunitas').select2('val',data.id_jeniskomunitas);
                    getKelAll(data.id_kec,data.id_kel);
                    iPID=data.iPid;
            }
        },
        complete:function(e){
            $('#idGridPenerima').DataTable().ajax.reload();
        }
    });    
}

    function ajaxSubmit() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>master/master_komunitas/simpan?sPID="+iPID,
            data: dataString,
            success: function (data) {
                $('#id_Reload').trigger('click');
                $('#id_btnBatal').trigger('click');
                UIToastr.init(data.tipePesan, data.pesan);
                $('#id_kec').select2("val", "");
                $('#id_kel').select2("val", "");
                $('#id_jeniskomunitas').select2("val", "");

                $("#navitab_2_1").trigger("click");
            }

        });
    }
    function ajaxUbah() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>master/master_komunitas/ubah?sPID="+iPID,
            data: dataString,
            success: function (data) {
                $('#id_Reload').trigger('click');
                $('#id_btnBatal').trigger('click');
                UIToastr.init(data.tipePesan, data.pesan);
                iPID="";
                $("#navitab_2_1").trigger("click");
            }

        });
    }
    function ajaxHapus() {
        ajaxModal();
        var id = $('#id_komunitasId').val().trim();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>master/master_komunitas/hapus",
            data: {sid: id},
            success: function (data) {
                $('#id_Reload').trigger('click');
                $('#id_btnBatal').trigger('click');
                UIToastr.init(data.tipePesan, data.pesan);
                iPID="";
                $("#navitab_2_1").trigger("click");
            }

        });

    }
    $('#id_formKel').submit(function (event) {
        dataString = $("#id_formKel").serialize();

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



// ========add anggota komunitas
//Grid penerima bantuan
var TableManaged2 = function () {

var initTable2 = function () {

    var table2 = $('#idGridPenerima');

    // begin first table
    table2.dataTable({
        "ajax":{ 
            "url":"<?php echo base_url("/master/master_komunitas/getPenerima"); ?>",
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
        url: "<?php echo base_url("master/master_komunitas/ajax_delTemp"); ?>", // json datasource
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
    // if($("#id_bantuan").val()==""||$("#id_tgl_bantuan").val()==""
    // ||$("#id_instansi").val()==""||$("#id_ket").val()==""){
    //     alert("Data harus diisi semua.!")
    // }else{
        $("#idDivSelectKTP").modal();
    // }
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
        url: "<?php echo base_url("master/master_komunitas/ajax_saveSelect"); ?>", // json datasource
        type: "POST",
        dataType: "json",
        data: {sKtp:a,sPID:iPID},
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

</script>


<!-- END JAVASCRIPTS -->