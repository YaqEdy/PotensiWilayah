<script>
var iLength=0;
$("#id_btnBatalCpa").hide();
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        UIBootbox.init();
        $("input[readonly='true']").focus(function () {
            $(this).next();
        });
        TableManaged.init();

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

    $('.cls_diskon_lgsbayar').hide();
    $('#id_spanHargaSatuan').text('0');
    $('#id_hargaTotal').text('0');
    $("#id_tgltrans").focus();
    $('#id_customer').change(function () {
        var idcust = $('#id_customer').select2('data');
        var nama_cust = idcust[0].text;
        //alert(nama_cust);
        $('#id_nama_cust').val(nama_cust);
    });
    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
    });
    $('#id_status_bayar').change(function () {
        var st_bayar = $(this).val();
        if (st_bayar == 0) {
            $('.cls_diskon_lgsbayar').hide();
        } else {
            $('.cls_diskon_lgsbayar').show();
            $('#id_diskon_lgsbayar').focus();
        }
    });
    $('#id_btnBatal').click(function () {
        btnStart();
        resetForm();
        readyToStart();
        tglTransStart();
        $('#id_body_data').empty();
        $('#id_status_bayar').val('0');
        $('#id_customer').select2('val', '');
        $('.cls_diskon_lgsbayar').hide();
    });
    function finishing(obj) {
        var idMaster = $(obj).closest('tr').find("td").eq(1).html();
        $('#id_idMaster').val(idMaster);
        getCMDetail(idMaster.trim(), 1);
    }
    function ambil(obj) {
        //var rowID = $(obj).attr('id');
        //var idMaster = $(obj).closest('tr').find('td:first').html();
        var idMaster = $(obj).closest('tr').find("td").eq(1).html();
        $('#id_idMaster').val(idMaster);
        var nama_cust = $(obj).closest('tr').find("td").eq(3).html();
        $('#id_nama_cust').val(nama_cust);

        getCMDetail(idMaster.trim(), 3);
    }
    function outsource(obj) {
        var idMaster = $(obj).closest('tr').find("td").eq(1).html();
        $('#id_idMaster').val(idMaster);
        getCMDetail(idMaster.trim(), 2);
        $('#id_inputIdTransOutsource').val('');
    }

    function getDescProduk(idProduk) {
        ajaxModal();
        if (idProduk != '') {
            $.post("<?php echo site_url('/master/master_produk/getDescProduk'); ?>",
                    {
                        'idProduk': idProduk
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_harga1').val(data.harga1);
                    $('#id_harga2').val(data.harga2);
                    $('#id_harga3').val(data.harga3);
                    $('#id_harga4').val(data.harga4);
                    $('#id_harga5').val(data.harga5);
                    $('#id_harga6').val(data.harga6);
                    $('#id_harga7').val(data.harga7);
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
        $('.kosongTextDetail2').text('0');
        $('.kosongDetail').select2("val", "");
        $('.kosongNomorDetail').val('0.00');
        $('.kosongNomor1Detail').val('0');
        $('#id_layanan').select2("val", "");
    }
    function hitungTotalHarga() {
        var idProduk = parseFloat(CleanNumber($('#id_produk').val()));
        var layanan = parseFloat(CleanNumber($('#id_layanan').val()));

        var jmlCucian = parseFloat(CleanNumber($('#id_jmlCucian').val()));
        jmlCucian = jmlCucian.toFixed(2);

        var cucisetrikabiasa = parseFloat(CleanNumber($('#id_harga1').val()));
        var cucisetrikaexpress = parseFloat(CleanNumber($('#id_harga2').val()));
        var setrikabiasa = parseFloat(CleanNumber($('#id_harga3').val()));
        var setrikaexpress = parseFloat(CleanNumber($('#id_harga4').val()));
        var cuciajabiasa = parseFloat(CleanNumber($('#id_harga5').val()));
        var cuciajaexpress = parseFloat(CleanNumber($('#id_harga6').val()));
        var dryclean = parseFloat(CleanNumber($('#id_harga7').val()));

        if (layanan == 1) {
            $('#id_hargaSatuan').val(number_format(cucisetrikabiasa, 0));
        } else if (layanan == 2) {
            $('#id_hargaSatuan').val(number_format(cucisetrikaexpress, 0));
        } else if (layanan == 3) {
            $('#id_hargaSatuan').val(number_format(setrikabiasa, 0));
        } else if (layanan == 4) {
            $('#id_hargaSatuan').val(number_format(setrikaexpress, 0));
        } else if (layanan == 5) {
            $('#id_hargaSatuan').val(number_format(cuciajabiasa, 0));
        } else if (layanan == 6) {
            $('#id_hargaSatuan').val(number_format(cuciajaexpress, 0));
        } else if (layanan == 7) {
            $('#id_hargaSatuan').val(number_format(dryclean, 0));
        } else {
            $('#id_hargaSatuan').val(number_format(0, 0));
        }

        var hargaSatuan = parseFloat(CleanNumber($('#id_hargaSatuan').val()));
        var hargaTotal = jmlCucian * hargaSatuan;
        $('#id_spanHargaSatuan').text('    ' + number_format(hargaSatuan, 0));
        $('#id_hargaTotal').text('    ' + number_format(hargaTotal, 0));
    }

    $(".cls_hitungTotalHarga").change(function () {
        hitungTotalHarga();
    });

    $("#id_produk").change(function () {
        var idProduk = $(this).val();
        if (idProduk == '') {

        } else {
            getDescProduk(idProduk);
        }
    });

    // $('#id_btnBatalCpa').click(function () {
    //     kosongDetail();
    // });
    function ajaxSubmitAdvance() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>transaksi/trans_kk/simpan",
            data: dataString,
            success: function (data) {
                $('#id_btnSimpan').attr("disabled", true);
                UIToastr.init(data.tipePesan, data.pesan);
                $('#id_idMaster').val(data.idMaster);
                $('#id_Reload').trigger('click');
            }
        });
    }

// ini yang dipakai
var TableManaged = function () {

var initTable1 = function () {

    var table = $('#idTabelPO');

    // begin first table
    table.dataTable({
        "ajax": "<?php echo base_url("/transaksi/trans_kk/getKKAll"); ?>",
        "columns": [
            {"data": "no"},
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
        var idKK = $(this).find("td").eq(1).html();
        var idKtp = $(this).find("td").eq(2).html();
        getDetailKK(idKK,idKtp);
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

function formClear(e){
// $(this).closest('form').find("input[type=text], textarea").val("");
    $("#"+e).find("input[type=text], textarea, select").val("");
    $("#"+e).find("img").attr("src","");
    $('#id_body_data').empty();    
    $('#id_btnSimpan').attr('disabled', false);
    $('#id_btnUbah').attr("disabled", true);
}
function getDetailKK(iKK,iKTP){
    $.ajax({
        url: "<?php echo base_url("transaksi/trans_kk/ajax_getDetailKK"); ?>?sKK="+iKK+"&sKTP="+iKTP, // json datasource
        type: "POST",
        dataType: "json",
        // data: sKK=iKK,sKTP=iKTP,
        success: function (e) {
            console.log(e.KK[0]);
            $("#id_noKK").val(e.KK[0].id_master_kk);
            $("#id_nik_").val(e.KK[0].id_ktp);
            // $("#id_nama_").val(e.KK[0].nama_ktp);
            // $("#id_tmpt_lahir_").val(e.KK[0].tempat_lahir);
            // $("#id_tglLahir_").val(e.KK[0].tanggal_lahir);
            // $("#jekel_").val(e.KK[0].jekel);
            // $("#gol_darah_").val(e.KK[0].gol_darah);
            $("#id_alamat_").val(e.KK[0].alamat);
            $("#id_rt_").val(e.KK[0].rt);
            $("#id_rw_").val(e.KK[0].rw);
            $("#id_kec_").val(e.KK[0].id_kec);
            $("#id_kel_").val(e.KK[0].id_kel);
            // $("#gambar_foto_ktp").attr('src','<?php echo base_url(); ?>'+ e.KK[0].link_gambar);
            $("#gambar_foto_rumah").attr('src','<?php echo base_url(); ?>'+ e.KK[0].rumah_path);
            // $("#id_agama_").val(e.KK[0].agama);
            // $("#id_status_").val(e.KK[0].status_kawin);
            // $("#id_warga_negara_").val(e.KK[0].warga_negara);
            // $("#id_pendidikan_").val(e.KK[0].pendidikan);
            // $("#id_pekerjaan_").val(e.KK[0].pekerjaan);
            // $("#id_difabel_").val(e.KK[0].id_t_difabel);
            // $("#id_bantuan_").val(e.KK[0].bantuan_desc);

            $('#id_body_data').append(e.anggotaKK);
        },
        complete:function(e){
            // tampilan gambar 
            var iCount=document.getElementById("id_tabelAnggotaKel").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
            for(var i=0;i<iCount;i++){
                var iImg=$("#id_link_gambar"+i).val();
                $("#gambar_foto_ktp"+i).attr('src','<?php echo base_url(); ?>'+iImg);
                $('.foto_ktp'+(i-1)).hide();
                $('#fileFoto').append('<input type="file" id="foto_ktp'+i+'" name="foto_ktp'+i+'" class="foto_ktp'+i+'" >');
            }
        }
    });
}
// var iCount;
$('#id_btnModalTambah').click(function(){
    // document.getElementById("fmKtp").reset();
    var iCount=document.getElementById("id_tabelAnggotaKel").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
    if(iCount>0){
        iCount = iCount + 1;
    }else{
        iCount = 1;        
    }
    $('.foto_ktp'+(iCount-1)).hide();
    $('#fileFoto').append('<input type="file" id="foto_ktp'+iCount+'" name="foto_ktp'+iCount+'" class="foto_ktp'+iCount+'" >');
    $('.gambar_foto_ktp'+(iCount-1)).hide();
    $('#imgKTP').append('<img src="" id="gambar_foto_ktp'+iCount+'" class="gambar_foto_ktp'+iCount+'" alt="" />');
    
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
        var iLength1=document.getElementById("id_tabelAnggotaKel").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
            iLength=iLength+iLength1;
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url("transaksi/trans_kk/ajax_simpan_kk"); ?>?sLength="+iLength, // json datasource
            type: 'POST',
            data: new FormData(this),
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (e) {
                console.log(e);
                if (e.istatus == true) {
                    alert(e.iremarks);
                    // $("#btnCloseUpload").trigger("click");
                    // $('#table_gridOutRequest').DataTable().ajax.reload();
                }
                iLength=0;
            }
        });

    });

    $('#id_btnAddCpa').click(function () {
        var i = $('#idTxtTempLoop').val();
        if ($('#id_nik').val() == '' || $('#id_nama').val() == ''
        || $('#id_tmpt_lahir').val() == '' || $('#id_tgl_lahir').val() == ''
        || $('#id_jekel').val() == '' || $('#id_gol_darah').val() == ''
        || $('#id_agama').val() == '' || $('#id_status').val() == ''
        || $('#id_pekerjaan').val() == '' || $('#id_pendidikan').val() == '') {
            alert("Data harus diisi semua.");
        } else {
            // var i = parseInt($('#idTxtTempLoop').val());
            var i = 0;
            var iLength1=document.getElementById("id_tabelAnggotaKel").getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
            if(iLength1>0){
                i = iLength1 + 1;
            }else{
                i = i + 1;
            }

            tr = '<tr class="listdata" id="tr' + i + '">';
            tr += '<td><input type="text" class="form-control input-sm" id="id_nik' + i + '" name="nik' + i + '" readonly="true" value="' + $('#id_nik').val() + '"></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_nama' + i + '" name="nama' + i + '" readonly="true" value="' + $('#id_nama').val() + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_tmpt_lahir' + i + '" name="tmpt_lahir' + i + '" readonly="true" value="' + $('#id_tmpt_lahir').val() + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_tgl_lahir' + i + '" name="tgl_lahir' + i + '" readonly="true" value="' + $('#id_tgl_lahir').val() + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_jekel' + i + '" name="jekel' + i + '" readonly="true" value="' + $('#id_jekel').val().split(',')[1] + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_gol_darah' + i + '" name="gol_darah' + i + '" readonly="true" value="' + $('#id_gol_darah').val() + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_agama' + i + '" name="agama' + i + '" readonly="true" value="' + $('#id_agama').val().split(',')[1] + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_status' + i + '" name="status' + i + '" readonly="true" value="' + $('#id_status').val().split(',')[1] + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_pendidikan' + i + '" name="pendidikan' + i + '" readonly="true" value="' + $('#id_pendidikan').val().split(',')[1] + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_pekerjaan' + i + '" name="pekerjaan' + i + '" readonly="true" value="' + $('#id_pekerjaan').val() + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_warga_negara' + i + '" name="warga_negara' + i + '" readonly="true" value="' + $('#id_warga_negara').val().split(',')[1] + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_hub_kel' + i + '" name="hub_kel' + i + '" readonly="true" value="' + $('#id_hub_kel').val().split(',')[1] + '" ></td>';

            tr += '<td><a href="#" class="btn red btn-sm" onclick="hapusBaris(\'tr' + i + '\')"><i class="fa fa-minus fa-fw"/></i></a></td>';
            
            tr += '<td hidden><input type="text" class="form-control input-sm" id="id_jekel_' + i + '" name="jekel_' + i + '" readonly="true" value="' + $('#id_jekel').val().split(',')[0] + '" ></td>';
            tr += '<td hidden><input type="text" class="form-control input-sm" id="id_agama_' + i + '" name="agama_' + i + '" readonly="true" value="' + $('#id_agama').val().split(',')[0] + '" ></td>';
            tr += '<td hidden><input type="text" class="form-control input-sm" id="id_status_' + i + '" name="status_' + i + '" readonly="true" value="' + $('#id_status').val().split(',')[0] + '" ></td>';
            tr += '<td hidden><input type="text" class="form-control input-sm" id="id_pendidikan_' + i + '" name="pendidikan_' + i + '" readonly="true" value="' + $('#id_pendidikan').val().split(',')[0] + '" ></td>';
            tr += '<td hidden><input type="text" class="form-control input-sm" id="id_hub_kel_' + i + '" name="hub_kel_' + i + '" readonly="true" value="' + $('#id_hub_kel').val().split(',')[0] + '" ></td>';
            tr += '<td hidden><input type="text" class="form-control input-sm" id="id_warga_negara_' + i + '" name="warga_negara_' + i + '" readonly="true" value="' + $('#id_warga_negara').val().split(',')[0] + '" ></td>';
            
            tr += '</tr>';

            $('#id_body_data').append(tr);
            $('#idTxtTempLoop').val(i);
            // kosongDetail();
            // iLength=i;

            $('#id_btnBatalCpa').trigger('click');
            }
    });
    function hapusBaris(noRow) {
        if (document.getElementById(noRow) != null) {
            $('#' + noRow).remove();
            if(iDel==""){
                iDel = noRow.substring(noRow.lastIndexOf('r') + 1);
            }else{
                iDel =iDel+","+ noRow.substring(noRow.lastIndexOf('r') + 1);
            }
            console.log(iDel);
        }
    }

// end ini yg dipakai



    function cetak() {
        var masterId = $('#id_idMaster').val();
        if (masterId == '') {
            alert('Master id kosong.');
        } else {
            window.open("<?php echo base_url('transaksi/trans_kk/cetakPO/'); ?>/" + masterId, '_blank'); //+ idAdvance + masterId
        }
    }

    function kosongAmbil() {
        $('#id_bayarAmbil').prop("checked", true);
        $('#id_bonAmbil').prop("checked", true);
        $('#id_diskon').val('0.00');
        $('#id_uangBayarAmbil').val('0.00');
        $('#id_spanUangKembalian').text('-');
        $('#id_keteranganAmbil').val('');
    }
//    var e = $("#id_tabelCucianOutsource");
    $(".group-checkable").change(function () {
        var e = $(this).attr("data-set");
        var t = $(this).is(":checked");
        var id_trans = '';
        jQuery(e).each(function () {//i
            t ? ($(this).prop("checked", !0), $(this).parents("tr").addClass("active")) : ($(this).prop("checked", !1), $(this).parents("tr").removeClass("active"));

            if (t) {
                var val = [];
                val[i] = $(this).val();
                id_trans = id_trans + val[i] + ',';
                $('#id_inputIdTransOutsource').val(id_trans);
            } else {
                $('#id_inputIdTransOutsource').val('');
            }
        })
    }), $("#id_tabelCucianOutsource").on("change", "tbody tr .checkboxes", function () {
        $(this).parents("tr").toggleClass("active");

        $(this).each(function (i) {
            var k = $(this).is(":checked");
            var val = [];
            var idtrans = $('#id_inputIdTransOutsource').val();
            val[i] = $(this).val() + ',';

            if (k) {// jika checked
                idtrans = idtrans + val[i];
                $('#id_inputIdTransOutsource').val(idtrans);
            } else {// jika unchecked
                var str = $('#id_inputIdTransOutsource').val();
                var res = str.replace(val[i], '');
                $('#id_inputIdTransOutsource').val(res);
            }
        });
        $('#id_btnTestOutsource').click(function () {

        });
        //alert(val[i]);
    });


    function getCMDetail(idMaster, act) {
        kosongAmbil();
        ajaxModal();
        //cls_body_detail_cucian
        $('.cls_body_detail_cucian').empty();
        if (idMaster != '') {
            $.post("<?php echo site_url('transaksi/trans_kk/getCMDetail'); ?>",
                    {
                        'idMaster': idMaster
                    }, function (data) {
                if (data.data_cpa.length > 0) {
                    $('.cls_spanNamaCust').text(data.data_cpa[0].nama_cust);
                    var nama_agen = '';
                    if (data.data_cpa[0].id_agen.trim() == '' || data.data_cpa[0].id_agen.trim() == null) {
                        nama_agen = "Sendiri";
                    } else {
                        nama_agen = data.data_cpa[0].nama_agen;
                    }

                    $('.cls_spanNamaAgen').text(nama_agen);

                    for (i = 0; i < data.data_cpa.length; i++) {
                        var x = i + 1;
                        var kdProduk = data.data_cpa[i].id_produk;
                        var txtProduk = data.data_cpa[i].nama_produk;
                        var kdLayanan = data.data_cpa[i].id_layanan;
                        var txtLayanan = data.data_cpa[i].nama_layanan;
                        var kg = data.data_cpa[i].qty;
                        var hargaSatuan = data.data_cpa[i].harga_satuan;
                        var hargaTotal = parseFloat(CleanNumber(kg)) * parseFloat(CleanNumber(hargaSatuan));
                        var id_trans = data.data_cpa[i].id_trans.trim();
                        tr = '<tr class="listdata" id="tr' + x + '">';
                        tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdProduk' + x + '" name="tempKdProduk' + x + '" readonly="true" value="' + kdProduk + '"></td>';
                        tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdLayanan' + x + '" name="tempKdLayanan' + x + '" readonly="true" value="' + kdLayanan + '" ></td>';
                        tr += '<td>' + txtProduk + '</td>';
                        tr += '<td>' + txtLayanan + '</td>';
                        tr += '<td align ="right">' + kg + '</td>';
                        tr += '<td align ="right">' + number_format(hargaSatuan, 0) + '</td>';
                        tr += '<td align ="right">' + number_format(hargaTotal, 0) + '</td>';
                        if (act == 2) {//jika out source
                            if (data.data_cpa[i].status_outsource_trans == 1) {
                                tr += '<td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">';
                                tr += '<input checked disabled id="id_tempIdTrans' + x + '" name="tempIdTrans' + x + '" class="checkboxes" value="' + id_trans + '" type="checkbox"><span></span></label></td>';
                                //$("#tr" + x).addClass("active");
                            } else {
                                tr += '<td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">';
                                tr += '<input id="id_tempIdTrans' + x + '" name="tempIdTrans' + x + '" class="checkboxes" value="' + id_trans + '" type="checkbox"><span></span></label></td>';
                            }
                        }

                        tr += '</tr>';
                        var jmlKg = parseFloat(CleanNumber(kg));
                        var jmlHS = parseFloat(CleanNumber(hargaSatuan));
                        var jmlHT = hargaTotal;
                        var total_kg = jmlKg + total_kg;
                        var total_hs = jmlHS + total_hs;
                        var total_ht = jmlHT + total_ht;
                        $('#id_totalKgAmbil').val(number_format(total_kg, 2));
                        $('#id_totalHargaSatuanAmbil').val(number_format(total_hs, 2));
                        $('#id_totalHargaAllAmbil').val(number_format(total_ht, 2));
                        $('.cls_body_detail_cucian').append(tr);
                    }
                    if (act == 1) {//finish
                        $('#id_spanTotalSatuanFinish').text(number_format(data.data_cpa[0].total_qty_satuan, 0));
                        $('#id_spanTotalKiloanFinish').text(number_format(data.data_cpa[0].total_qty_kg, 2));
                        $('#id_setrikaSatuanFinish').val(number_format(data.data_cpa[0].total_qty_satuan, 0));
                        $('#id_setrikaKiloanFinish').val(number_format(data.data_cpa[0].total_qty_kg, 2));

                        $('#id_karyawan').val(data.data_cpa[0].id_kyw.trim());
                        if (data.data_cpa[0].status_selesai == 0) {
                            $('#id_btnFinishing').show();
                        } else {
                            $('#id_btnFinishing').hide();
                        }
                        if (data.data_cpa[0].tgl_selesai == '00-00-0000') {
                            var tgltrans = $('#id_sessTgltrans').text();
                            $('#id_tglFinishing').val(tgltrans);
                        } else {
                            $('#id_tglFinishing').val(data.data_cpa[0].tgl_selesai);
                        }

                    } else if (act == 2) {//oursource
                        if (data.data_cpa[0].tgl_os_kel == '00-00-0000') {
                            $('#id_spanTglKelKeOutsource').text("-");
                            //$('#id_tglKelKeOutsource').val("");
                        } else {
                            $('#id_spanTglKelKeOutsource').text(data.data_cpa[0].tgl_os_kel);
                            $('#id_tglKelKeOutsource').val(data.data_cpa[0].tgl_os_kel);
                            //$('#id_tglKelKeOutsource').hide();
                        }
                        if (data.data_cpa[0].tgl_os_msk == '00-00-0000') {
                            $('#id_spanTglMskDrOutsource').text("-");
                            //$('#id_tglMskDrOutsource').val("");

                        } else {
                            $('#id_spanTglMskDrOutsource').text(data.data_cpa[0].tgl_os_msk);
                            $('#id_tglMskDrOutsource').val(data.data_cpa[0].tgl_os_msk);
                            //$('#id_tglMskDrOutsource').hide();
                        }
                        if (data.data_cpa[0].status_outsource == 0) {
                            $('#id_spanStatusOutsource').text("Tidak outsource.");
                            $('#id_tglMskDrOutsource').hide();
                            $('#id_btnOutsource').show();
                            $('#id_btnOutsourceMsk').hide();
                            $('#id_tglKelKeOutsource').show();
                            $('#id_tglMskDrOutsource').hide();
                        } else if (data.data_cpa[0].status_outsource == 1) {
                            $('#id_spanStatusOutsource').text("Sedang di Outsource.");
                            $('#id_btnOutsource').hide();
                            $('#id_btnOutsourceMsk').show();
                            $('#id_tglKelKeOutsource').hide();
                            $('#id_tglMskDrOutsource').show();
                        } else {
                            $('#id_spanStatusOutsource').text("Sudah kembali di laundry.");
                            $('#id_btnOutsource').hide();
                            $('#id_btnOutsourceMsk').hide();
                            $('#id_tglKelKeOutsource').hide();
                            $('#id_tglMskDrOutsource').hide();
                        }
                        $('#id_outsource').val(data.data_cpa[0].id_outsource.trim());


                    } else if (act == 3) {//ambil
                        var total_kg = 0;
                        var total_hs = 0;
                        var total_ht = 0;
                        $('#id_spanHargaTotalAmbil').text(number_format(data.data_cpa[0].total_harga, 0));
                        //$('#id_hargaYgDibayar').val(number_format(data.data_cpa[0].total_harga, 0));
                        if (data.data_cpa[0].status_bayar == 1) {
                            $('#id_spanHargaYgDibayar').text('LUNAS');
                            $('#id_bayarAmbil').attr("disabled", true);
                            $('#id_diskon').attr("disabled", true);
                            $('#id_uangBayarAmbil').attr("disabled", true);
                        } else {
                            $('#id_spanHargaYgDibayar').text(number_format(data.data_cpa[0].total_harga, 0));
                            $('#id_bayarAmbil').attr("disabled", false);
                            $('#id_diskon').attr("disabled", false);
                            $('#id_uangBayarAmbil').attr("disabled", false);
                        }

                    }

                } else {
                    //alert('Data tidak ditemukan!');
                    //$('#id_btnBatal').trigger('click');
                }
            }, "json");
        }//if kd<>''
    }
    $('#id_diskon').focusout(function () {
        var hargaTotal = parseFloat(CleanNumber($('#id_spanHargaTotalAmbil').text().trim()));
        var diskon = parseFloat(CleanNumber($(this).val()));
        var ygharusdibayar = hargaTotal - diskon;
        $('#id_spanHargaYgDibayar').text(number_format(ygharusdibayar, 0));
    });
    $('#id_uangBayarAmbil').focusout(function () {
        var uangBayar = parseFloat(CleanNumber($(this).val()));
        var ygharusdibayar = parseFloat(CleanNumber($('#id_spanHargaYgDibayar').text().trim()));

        var kembalian = uangBayar - ygharusdibayar;
        $('#id_spanUangKembalian').text(number_format(kembalian, 0));
    });
    $('#id_btnAmbil').click(function () {
        submitAmbil();
    });
    $('#id_btnFinishing').click(function () {
        submitFinish();
    });
    $('#id_btnOutsource').click(function () {
        submitOutsource();
    });
    $('#id_btnOutsourceMsk').click(function () {
        submitOutsourceMsk();
    });
    $('#id_btnCetakStruk').click(function () {
        submitCetakStruk();
    });
    function submitCetakStruk() {
        var tglTrans = $('#id_tgltrans').val();
        var tglSelesai = $('#id_etglSelesai').val();
        var idMaster = $('#id_idMaster').val();
        var statusBayar = $('#id_status_bayar').val();
        var namaCustomer = $('#id_customer').select2('data')[0].text;
        var totalHarga = $('#id_totalHargaAll').val();
        if (idMaster.trim() != '') {
            ajaxModal();
            $.post("<?php echo site_url('/transaksi/trans_kk/cetakStruk'); ?>",
                    {
                        'idMaster': idMaster,
                        'tglTrans': tglTrans,
                        'tglSelesai': tglSelesai,
                        'namaCustomer': namaCustomer,
                        'statusBayar': statusBayar,
                        'totalHarga': totalHarga
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_btnBatalOutsource').trigger('click');
                    UIToastr.init(data.tipePesan, data.pesan);
                } else {
                    UIToastr.init(data.tipePesan, data.pesan);
                }
            }, "json");

        } else {
            alert("Master tidak boleh kosong.");
        }


    }
    function submitOutsource() {
        var idOutsource = $('#id_outsource').val();
        var inputIdTransOutsource = $('#id_inputIdTransOutsource').val();
        var tglKelOutsource = $('#id_tglKelKeOutsource').val();
        if (idOutsource.trim() != '' && inputIdTransOutsource.trim() != '') {
            bootbox.confirm("Anda yakin menyimpan data ini?", function (o) {
                if (o == true) {
                    var idMaster = $('#id_idMaster').val();
                    ajaxModal();
                    $.post("<?php echo site_url('/transaksi/trans_kk/simpanOutsource'); ?>",
                            {
                                'idMaster': idMaster,
                                'idOutsource': idOutsource,
                                'inputIdTransOutsource': inputIdTransOutsource,
                                'tglKelOutsource': tglKelOutsource
                            }, function (data) {
                        if (data.baris == 1) {
                            $('#id_btnBatalOutsource').trigger('click');
                            UIToastr.init(data.tipePesan, data.pesan);
                            $('#id_Reload').trigger('click');
                        } else {
                            UIToastr.init(data.tipePesan, data.pesan);
                        }
                    }, "json");
                }
            });
        } else {
            alert("Outsource tidak boleh kosong.");
            $('#id_outsource').focus();
        }
    }
    function submitOutsourceMsk() {
        var idOutsource = $('#id_outsource').val();
        var tglMskDrOutsource = $('#id_tglMskDrOutsource').val();
        if (idOutsource != '') {
            bootbox.confirm("Anda yakin menyimpan data ini?", function (o) {
                if (o == true) {
                    var idMaster = $('#id_idMaster').val();

                    ajaxModal();

                    $.post("<?php echo site_url('/transaksi/trans_kk/simpanOutsourceMsk'); ?>",
                            {
                                'idMaster': idMaster,
                                'tglMskDrOutsource': tglMskDrOutsource
                            }, function (data) {
                        if (data.baris == 1) {
                            $('#id_btnBatalOutsource').trigger('click');
                            UIToastr.init(data.tipePesan, data.pesan);
                            $('#id_Reload').trigger('click');
                        } else {
                            UIToastr.init(data.tipePesan, data.pesan);
                        }
                    }, "json");
                }
            });
        } else {
            alert("Outsource tidak boleh kosong.");
            $('#id_outsource').focus();
        }

    }
    function submitAmbil() {
        bootbox.confirm("Anda yakin menyimpan data ini?", function (o) {
            if (o == true) {
                var idMaster = $('#id_idMaster').val();
                var namaCust = $('#id_nama_cust').val();
                var stsBayar = $("#id_bayarAmbil").is(":checked") ? 1 : 0;
                var stsBon = $("#id_bonAmbil").is(":checked") ? 1 : 0;
                var diskon = $('#id_diskon').val();
                var jmlBayar = $('#id_spanHargaYgDibayar').text().trim();
                var ketAmbil = $('#id_keteranganAmbil').val().trim();
                var tglAmbil = $('#id_tglAmbil').val();
                ajaxModal();

                $.post("<?php echo site_url('/transaksi/trans_kk/simpanAmbil'); ?>",
                        {
                            'idMaster': idMaster,
                            'namaCust': namaCust,
                            'stsBayar': stsBayar,
                            'stsBon': stsBon,
                            'diskon': diskon,
                            'jmlBayar': jmlBayar,
                            'ketAmbil': ketAmbil,
                            'tglAmbil': tglAmbil
                        }, function (data) {
                    if (data.baris == 1) {
                        $('#id_btnBatalAmbil').trigger('click');
                        UIToastr.init(data.tipePesan, data.pesan);
                        $('#id_Reload').trigger('click');
                    } else {
                        UIToastr.init(data.tipePesan, data.pesan);
                    }
                }, "json");
            }
        });
    }
    function submitFinish() {
        var totalSatuan = parseFloat(CleanNumber($('#id_spanTotalSatuanFinish').text().trim()));
        var totalKiloan = parseFloat(CleanNumber($('#id_spanTotalKiloanFinish').text().trim()));
        var jmlSetrikaSatuan = parseFloat(CleanNumber($('#id_setrikaSatuanFinish').val().trim()));
        var jmlSetrikaKiloan = parseFloat(CleanNumber($('#id_setrikaKiloanFinish').val().trim()));
        var idKaryawan = $('#id_karyawan').val();
        if (jmlSetrikaSatuan > totalSatuan) {
            alert("Jumlah setrikaan satuan tidak boleh lebih besar dari total cucian satuan yang masuk.");
        } else if (jmlSetrikaKiloan > totalKiloan) {
            alert("Jumlah setrikaan kiloan tidak boleh lebih besar dari total cucian kiloan yang masuk.");
        } else {
            //if (idKaryawan != '') {
            bootbox.confirm("Anda yakin menyimpan data ini?", function (o) {
                if (o == true) {
                    var idMaster = $('#id_idMaster').val();
                    var tglFinishing = $('#id_tglFinishing').val();
                    ajaxModal();

                    $.post("<?php echo site_url('/transaksi/trans_kk/simpanFinish'); ?>",
                            {
                                'idMaster': idMaster,
                                'idKaryawan': idKaryawan,
                                'jmlSetrikaSatuan': jmlSetrikaSatuan,
                                'jmlSetrikaKiloan': jmlSetrikaKiloan,
                                'tglFinishing': tglFinishing
                            }, function (data) {
                        if (data.baris == 1) {
                            $('#id_btnBatalFinish').trigger('click');
                            UIToastr.init(data.tipePesan, data.pesan);
                            $('#id_Reload').trigger('click');
                        } else {
                            UIToastr.init(data.tipePesan, data.pesan);
                        }
                    }, "json");
                }
            });
            /*    
             } else {
             alert("Karyawan tidak boleh kosong!");
             $('#id_karyawan').focus();
             }
             */

        }
    }
</script>


<!-- END JAVASCRIPTS -->