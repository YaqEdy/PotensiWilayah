<script>
var table,table2;
var iLength=0;
var iEdit=0;
$("#id_btnBatalCpa").hide();
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        UIBootbox.init();
        $("input[readonly='true']").focus(function () {
            $(this).next();
        });
        TableManaged.init();
        loadGridAnggotaKel();
        loadGridRumah();
    });
    $(document).keyup(function (e) {
        if (e.which === 36) {
            $('#id_btnModalTambah').trigger('click');
            //$('#id_produk').focus();
        } else if (e.which == 35) {
            $('#id_btnAddCpa').trigger('click');
        }
    });
    //Ready Doc
    btnStart();
    readyToStart();
    tglTransStart();

    $('#id_btnBatal').click(function () {
        formClear('id_formKK');
    });

// ini yang dipakai
var TableManaged = function () {

var initTable1 = function () {

     table = $('#idGridKK');

    // begin first table
    table.dataTable({
        "ajax": "<?php echo base_url("/transaksi/trans_kk/getKKAll"); ?>",
        "columns": [
            {"data": "no"},
            {"data": "idsession"},
            {"data": "idKK"},
            {"data": "idKtp"},
            {"data": "namaKtp"},
            {"data": "kec"},
            {"data": "kel"},
            {"data": "rw"},
            {"data": "rt"},
            {"data": "jmlAgt"}

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
        "columnDefs": [
            {"targets": [0],"orderable": true,"searchable": true},
            {"targets":[1],"visible":false,"searchable":false}
 
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
        // iEdit=1;
        table.fnSetColumnVis(1, true);
        table2.fnSetColumnVis(14, false);
        var idSes = $(this).find("td").eq(1).html();
        // console.log(idSes);
        // var idKtp = $(this).find("td").eq(2).html();
        iPID=idSes;
        getDetailKK(idSes);
        // $('#id_kelId').val(idKel);
        // getDescKel(idKel);
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

$("#navitab_2_2").click(function(e){
    table.fnSetColumnVis(1, false);
});
function getDetailKK(iSes){
    $.ajax({
        url: "<?php echo base_url("transaksi/trans_kk/ajax_getDetailKK"); ?>", // json datasource
        type: "POST",
        dataType: "json",
        data: {sSes:iSes},
        success: function (e) {
            console.log(e);
            console.log(e.alamat);
            $("#id_noKK").val(e.id_master_kk);
            $("#id_alamat_").val(e.alamat);
            $("#id_rt_").val(e.rt);
            $("#id_rw_").val(e.rw);
            $("#id_kec_").select2('val',e.id_kec);
            getKelAll2(e.id_kec,e.id_kel);
            getBanjarAll2(e.id_kel,e.id_banjar);
            $("#gambar_foto_rumah").attr('src','<?php echo base_url(); ?>'+ e.rumah_path);
        },
        complete:function(e){
            iPID=iSes;
            $('#idGridAnggotaKel').DataTable().ajax.reload();
            loadGridRumah();
        }
    });
}

function onFotoRmh(){
    $('#idDivInputProduk').find('.modal-title').text('Foto Rumah');
    $("#divftRumah").show();
    $("#divktp").hide();

    $('#id_All').hide();
    $('#id_btnBatalCpa').show();
    $('#id_btnEditCpa').hide();

    $("#idDivInputProduk").modal();
}

$("#id_foto_rmh").change(function(ev){
    ev.preventDefault();
    var fileInput = $('#id_foto_rmh')[0];
        if( fileInput.files.length > 0 ){
            var form_data = new FormData();
            $.each(fileInput.files, function(k,file){
                form_data.append('sNoKK', $("#id_noKK").val());
                form_data.append('foto_rmh[]', file);
            });

            $.ajax({
                url: "<?php echo base_url("transaksi/trans_kk/ajax_UploadRumah"); ?>?sPID="+iPID, // json datasource
                type: 'POST',
                data: form_data,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (e) {
                    if(e.act){
                        UIToastr.init(e.tipePesan, e.pesan);
                        iPID=e.iPid;
                        // $("#id_btnBatalCpa").trigger('click');
                    }else{
                        UIToastr.init(e.tipePesan, e.pesan);
                    }
                },
                complete:function(e){
                    $('#idGridFotoRumah').DataTable().ajax.reload();
                }
            });
    }
});
function loadGridRumah(){
    var table2 = $('#idGridFotoRumah');
    table2.dataTable({
        'destroy': true,
        "ajax":{ 
            "url":"<?php echo base_url("transaksi/trans_kk/getRumah"); ?>",
            "type": "POST",
            "data": function (z) {
                    z.sPID = iPID;
                }
        },
        "columns": [
            {"data": "no"},
            {"data": "rumah_path"},
            {"data": "act"}
            // {"data": "idsession"}
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
}
function onDelRumah(a){
    $.ajax({
        url: "<?php echo base_url("transaksi/trans_kk/ajax_delRumahTemp"); ?>", // json datasource
        type: "POST",
        dataType: "json",
        data: {sId:a,sPID:iPID},
        success: function (e) {
            if (e.act == true) {
                    UIToastr.init(e.tipePesan, e.pesan);
                    iPID=e.iPid;
                    $('#idGridFotoRumah').DataTable().ajax.reload();
            }else{
                UIToastr.init(e.tipePesan, e.pesan);                    
                iPID="";
            }
        },
        complete:function(e){
        }
    });    
}

function formClear(e){
// $(this).closest('form').find("input[type=text], textarea").val("");
    $("#"+e).find("input[type=text], textarea, select").val("");
    $("#"+e).find("img").attr("src","");
    $('#id_body_data').empty();    
    $('#id_btnSimpan').attr('disabled', false);
    $('#id_btnUbah').attr("disabled", true);
    iPID="";

    btnStart();
    resetForm();
    readyToStart();
    tglTransStart();
    $('#id_body_data').empty();
    $('#id_status_bayar').val('0');
    $('#id_kec_').select2('val', '');
    $('#id_kel_').select2('val', '');
    $('.cls_diskon_lgsbayar').hide();
}

$('#id_btnModalTambah').click(function(){
    $('#idDivInputProduk').find('.modal-title').text('Data Anggota Keluarga');
    $("#divftRumah").hide();
    $("#divktp").show();

    $('#id_All').show();
    $('#id_btnBatalCpa').show();
    $('#id_btnEditCpa').hide();

    $("#id_nik").val('');
    $("#id_nama").val('');
    $("#id_tmpt_lahir").val('');
    $("#id_tgl_lahir").val('');
    $("#id_jekel").select2('val','');
    $("#id_gol_darah").select2('val','');
    $("#id_agama").select2('val','');
    $("#id_status").select2('val','');
    $("#id_pekerjaan").select2('val','');
    $("#id_difabel").select2('val','');
    $("#id_pendidikan").select2('val','');
    $("#id_hub_kel").select2('val','');
    $("#gambar_foto_ktp").attr('src','');
});

function readURL(input,sparam) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#gambar_'+sparam).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#foto_ktp").change(function () {
readURL(this,'foto_ktp');
});

$("#foto_rumah").change(function () {
readURL(this,'foto_rumah');
});

    $('#id_formKK').submit(function (event) {
        // console.log($("#id_pendidikan").val());
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url("transaksi/trans_kk/ajax_Tambah"); ?>?sPID="+iPID, // json datasource
            type: 'POST',
            data: new FormData(this),
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (e) {
                if(e.act){
                    UIToastr.init(e.tipePesan, e.pesan);
                    iPID=e.iPid;
                    $("#id_btnBatalCpa").trigger('click');
                }else{
                    UIToastr.init(e.tipePesan, e.pesan);
                }
            },
            complete:function(e){
                $('#idGridAnggotaKel').DataTable().ajax.reload();
            }
        });       
    });
    var iPID="";
    $('#id_btnAddCpa').click(function () {
        $("#id_All").trigger('click');
    });

function loadGridAnggotaKel(){
    table2 = $('#idGridAnggotaKel');
    table2.dataTable({
        "ajax":{ 
            "url":"<?php echo base_url("transaksi/trans_kk/getAnggotaKel"); ?>",
            "type": "POST",
            "data": function (z) {
                    z.sPID = iPID;
                }
        },
        "columns": [
            {"data": "no"},
            {"data": "id_ktp"},
            {"data": "nama_ktp"},
            {"data": "tempat_lahir"},
            {"data": "tanggal_lahir"},
            {"data": "jekel"},
            {"data": "gol_darah"},
            {"data": "agama"},
            {"data": "status_kawin"},
            {"data": "pekerjaan"},
            {"data": "nama_difabel"},
            {"data": "nama_pend"},
            {"data": "hub_keluarga"},
            {"data": "act"},
            {"data": "nama_kemiskinan"},
            // {"data": "idsession"},
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
        "columnDefs": [
            {// set default column settings
                'orderable': true,
                "searchable": true,
                'targets': [0]
            },
            // {"targets":[15],"visible":false,"searchable":false}
            ],
        "order": [
            [0, "asc"]
        ] // set first column as a default sort by asc
    });
}

function edit_temp(a){
    $('#idDivInputProduk').find('.modal-title').text('Update Data Anggota Keluarga');
    $("#divftRumah").hide();
    $("#divktp").show();

    $('#id_btnBatalCpa').show();
    $("#id_btnEditCpa").show();
    $("#id_All").hide();
    $.ajax({
        url: "<?php echo base_url("transaksi/trans_kk/ajax_getAngKel"); ?>", // json datasource
        type: "POST",
        dataType: "json",
        data: {sKtp:a,sPID:iPID},
        success: function (e) {
            console.log(e);
            $("#id_nik").val(e.ktp.id_ktp);
            $("#id_nama").val(e.ktp.nama_ktp);
            $("#id_tmpt_lahir").val(e.ktp.tempat_lahir);
            $("#id_tgl_lahir").val(e.ktp.tanggal_lahir);
            $("#id_jekel").select2('val',e.ktp.jekel);
            $("#id_gol_darah").select2('val',e.ktp.gol_darah);
            $("#id_agama").select2('val',e.ktp.agama);
            $("#id_status").select2('val',e.ktp.status_kawin);
            $("#id_pekerjaan").select2('val',e.ktp.pekerjaan);
            $("#id_difabel").select2('val',e.ktp.id_difabel);
            $("#id_pendidikan").select2('val',e.ktp.id_pend);
            $("#id_hub_kel").select2('val',e.ktp.hub_keluarga);
            $("#id_kemiskinan").select2('val',e.ktp.id_kemiskinan);
            $("#gambar_foto_ktp").attr('src','<?php echo base_url(); ?>'+ e.ktp.link_gambar);

        },
        complete:function(e){
            $("#idDivInputProduk").modal();
        }
    });    

}
function del_temp(a,b){
    $.ajax({
        url: "<?php echo base_url("transaksi/trans_kk/ajax_delTemp"); ?>", // json datasource
        type: "POST",
        dataType: "json",
        data: {sId:a,sPID:iPID,sKtp:b},
        success: function (e) {
            if (e.act == true) {
                    UIToastr.init(e.tipePesan, e.pesan);
                    iPID=e.iPid;
                    $('#idGridAnggotaKel').DataTable().ajax.reload();
            }else{
                UIToastr.init(e.tipePesan, e.pesan);                    
                iPID="";
            }
        },
        complete:function(e){
        }
    });    
}

    $("#id_btnSimpan").click(function () {
        save();
    });

    $("#id_btnUbah").click(function () {
        save();
    });

function save(){
    $.ajax({
        url: "<?php echo base_url("transaksi/trans_kk/ajax_Simpan"); ?>", // json datasource
        dataType: "JSON", // what to expect back from the PHP script, if anything
        type: 'post',
        cache: false,
        data: {sPID: iPID},
        success: function (e) {
            // console.log(e)
            if (e.istatus == true) {
                UIToastr.init(e.itype, e.iremarks);
                $('#idGridKK').DataTable().ajax.reload();
            }else{
                UIToastr.init('error', e.iremarks);                    
            }

        },
        complete: function (e) {
            $("#navitab_2_1").trigger('click');
        }
    });
}


function delAnggotaKK(iid,itr,iKTP){
    if(iid==2){
        $.ajax({
            url: "<?php echo base_url("transaksi/trans_kk/ajax_delAnggotaKK"); ?>?sKTP="+iKTP, // json datasource
            type: "POST",
            dataType: "json",
            // data: sKK=iKK,sKTP=iKTP,
            success: function (e) {
                if(e.istatus){
                    alert(e.iremarks);
                    UIToastr.init(e.itype, e.iremarks);
                    $('#tr' + itr).remove();
                }else{
                    UIToastr.init(e.itype, e.iremarks);
                }
            },
            complete:function(e){
                
            }
        });
    }else{
        $('#tr' + itr).remove();        
    }
}

    $("#id_kec_").change(function () {
        var idKec = $(this).val();
        getKelAll1(idKec);
    });
    function getKelAll1(idKec) {
        $.ajax({
            url: "<?php echo base_url("/globalc/getKelAll"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            data: {idMaster: idKec},
            success: function (e) {
                // console.log(e.data_cpa.length)
                if (e.data_cpa.length > 0) {
                    $('#id_kel_').empty();
                    for (i = 0; i < e.data_cpa.length; i++) {
                        var idKel = e.data_cpa[i].id_kel;
                        var namakel = e.data_cpa[i].nama_kel;
                        opt = '<option value="' + idKel + '">' + namakel + '</option>';
                        $('#id_kel_').append(opt);
                    }
                }

            },
        });
    }
    function getKelAll2(idKec,idKel_) {
        $.ajax({
            url: "<?php echo base_url("/globalc/getKelAll"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            data: {idMaster: idKec},
            success: function (e) {
                // console.log(e.data_cpa.length)
                if (e.data_cpa.length > 0) {
                    for (i = 0; i < e.data_cpa.length; i++) {
                        var idKel = e.data_cpa[i].id_kel;
                        var namakel = e.data_cpa[i].nama_kel;
                        opt = '<option value="' + idKel + '">' + namakel + '</option>';
                        $('#id_kel_').append(opt);
                    }
                }

            },
            complete: function (e) {
            $("#id_kel_").select2('val',idKel_);
            }
        });
    }

    $("#id_kel_").change(function () {
        var idKel = $(this).val();
        getBanjarAll(idKel);
    });
    function getBanjarAll(idKel) {
        $.ajax({
            url: "<?php echo base_url("/globalc/getBanjarAll"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            data: {idKel: idKel},
            success: function (e) {
                // console.log("tes- ",e.data_cpa.length)
                if (e.data_cpa.length > 0) {
                    $('#id_banjar').empty();
                    for (i = 0; i < e.data_cpa.length; i++) {
                        var id = e.data_cpa[i].id_banjar;
                        var nama = e.data_cpa[i].nama_banjar;
                        opt = '<option value="' + id + '">' + nama + '</option>';
                        $('#id_banjar').append(opt);
                    }
                }

            },
        });
    }
    function getBanjarAll2(idKel,idBanjar) {
        $.ajax({
            url: "<?php echo base_url("/globalc/getBanjarAll"); ?>", // json datasource
            dataType: "JSON", // what to expect back from the PHP script, if anything
            type: 'post',
            cache: false,
            data: {idKel: idKel},
            success: function (e) {
                // console.log(e.data_cpa.length)
                if (e.data_cpa.length > 0) {
                    $('#id_banjar').empty();
                    for (i = 0; i < e.data_cpa.length; i++) {
                        var id = e.data_cpa[i].id_banjar;
                        var nama = e.data_cpa[i].nama_banjar;
                        opt = '<option value="' + id + '">' + nama + '</option>';
                        $('#id_banjar').append(opt);
                    }
                }

            },
            complete: function (e) {
            $("#id_banjar").select2('val',idBanjar);
            }
        });
    }

    var ChartsAmcharts = function () {
        t = function () {
            var chart = AmCharts.makeChart("chart_pekerjaan", {
                "type": "pie",
                "theme": "light",
                "fontFamily": 'Open Sans',
                "color":    '#888',
                "dataProvider": [
                    <?php

                        foreach($pie_pekerjaan as $row) :
                            echo '{';
                            echo '"nama_pekerjaan":'.'"'.$row['nm_pekerjaan'].'",';
                            echo '"jumlah":'.'"'.$row['jml'].'",';
                            echo '},';
                           // echo $row['target'];
                        endforeach;
                    ?>
                ],
                "valueField": "jumlah",
                "titleField": "nama_pekerjaan",
                "outlineAlpha": 0.4,
                "depth3D": 15,
                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                "angle": 30,
                "exportConfig": {
                    menuItems: [{
                        icon: '/lib/3/images/export.png',
                        format: 'png'
                    }]
                }
            });

            jQuery('.chart_pekerjaan_chart_input').off().on('input change', function() {
                var property = jQuery(this).data('property');
                var target = chart;
                var value = Number(this.value);
                chart.startDuration = 0;

                if (property == 'innerRadius') {
                    value += "%";
                }

                target[property] = value;
                chart.validateNow();
            });

            $('#chart_pekerjaan').closest('.portlet').find('.fullscreen').click(function() {
                chart.invalidateSize();
            });
        };// end t = function()
        u = function () {
            var chart = AmCharts.makeChart("chart_difabel", {
                "type": "pie",
                "theme": "light",
                "fontFamily": 'Open Sans',
                "color":    '#888',
                "dataProvider": [
                    <?php

                        foreach($pie_difabel as $row) :
                            echo '{';
                            echo '"nama_difabel":'.'"'.$row['nama_difabel'].'",';
                            echo '"jumlah":'.'"'.$row['jml'].'",';
                            echo '},';
                           // echo $row['target'];
                        endforeach;
                    ?>
                ],
                "valueField": "jumlah",
                "titleField": "nama_difabel",
                
                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                "exportConfig": {
                    menuItems: [{
                        icon: App.getGlobalPluginsPath() + "amcharts/amcharts/images/export.png",
                        format: 'png'
                    }]
                }
            });

            
            $('#chart_difabel').closest('.portlet').find('.fullscreen').click(function() {
                chart.invalidateSize();
            });
        };// end t = function()
        
        return {
            init: function () {
                t(),u()
            }
        }
    }();
    jQuery(document).ready(function () {
        ChartsAmcharts.init()
    });

// end ini yg dipakai
</script>

