<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">
    table#idTabelPO th{
        font-size: 13px;
    }
    table#idTabelPO td{
        font-size: 12px;
    }
    /*
    table#idTabelPO th:nth-child(2) td:nth-child(2){
        display: none;

    }
    .styleDataTabel th:nth-child(2),td:nth-child(2){
        display: none;
    }
    */

    table#idTabelPO tfoot {
        display:table-header-group;
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
                <div class="tools"> </div>
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
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Data cucian masuk
                        </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form Data cucian masuk </a>
                    </li>

                </ul>
                <form role="form" method="post"
                      action="<?php echo base_url('transaksi/sales_order/home'); ?>" id="id_formAdvance">
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_2_1">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="id_tglAwalDataDaftar">Data tanggal</label>
                                            <div class="col-md-2">
                                                <input id="id_tglAwalDataDaftar"  placeholder="dd-mm-yyyy"
                                                       class="form-control input-sm date-picker cls_3harilalu cls_tidakkosong" type="text"
                                                       name="tglAwalDataDaftar" data-date-format="dd-mm-yyyy" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-1" for="id_tglAkhirDataDaftar">sampai</label>
                                            <div class="col-md-2">
                                                <input id="id_tglAkhirDataDaftar"  placeholder="dd-mm-yyyy"
                                                       class="form-control input-sm date-picker cls_tglhariini_static cls_tidakkosong" type="text"
                                                       name="tglAkhirDataDaftar" data-date-format="dd-mm-yyyy"  />
                                            </div>
                                        </div>
                                        <div class="form-group">
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
                                    <table class="table table-striped table-bordered table-hover styleDataTabel" id="idTabelPO">
                                        <thead>
                                            <tr>
                                                <th>
                                                    No
                                                </th>
                                                <th>
                                                    No SO
                                                </th>

                                                <th>
                                                    Tanggal Kirim
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
<!--                                                <th>
                                                    Act
                                                </th>-->
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
                        <div class="tab-pane fade" id="tab_2_2">
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Customer</label>
                                            <select id="select2-button-addons-single-input-group-sm" class="form-control js-data-example-ajax">
<!--                                                    <option value="2126244" selected="selected">twbs/bootstrap</option>-->
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label>No PO Customer</label>
                                            <input id="id_poCust" required="required"
                                                   class="form-control input-sm " type="text"
                                                   name="poCust" />
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis dokumen</label>
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($jnsdoc as $row) :
                                                $data[$row['id_jnsdoc']] = $row['nama_jnsdoc'];
                                            endforeach;
                                            echo form_dropdown('jnsdoc', $data, '', 'id="id_jnsdoc" class="form-control input-sm kosongDetail select2me"');
                                            ?>
                                        </div>
                                    </div>
                                    <!--end <div class="col-md-6"> 1 -->
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            Sisa Kuota :
                                            <h2><strong id="id_kuota" class="kosongTextDetail"></strong></h2><span></span>

                                        </div>     
                                    </div>
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            No Skep :
                                            <h2><strong id="id_noskep" class="kosongTextDetail"></strong></h2><span></span>
                                            <input type="text" name="noSkep" id="id_noSkep" class="kosongTextDetail hidden">

                                        </div>     
                                    </div>
                                </div>
                                <!-- HIDDEN INPUT -->
                                <input type="text" id="idTmpAksiBtn" class="hidden">
                            </div>
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input id="id_SoId" 
                                                   class="form-control input-sm hidden" type="text"
                                                   name="SoId" />
                                            <input id="id_produkKgSbl" 
                                                   class="form-control input-sm hidden" type="text"
                                                   name="produkKgSbl" />
                                            <input id="id_produkSbl" 
                                                   class="form-control input-sm hidden" type="text"
                                                   name="produkSbl" />
                                            <label>Tanggal Pesanan</label> 
                                            <input id="id_tgltrans" required="required"
                                                   class="form-control input-sm date-picker cls_tglhariini" type="text"
                                                   name="tglTrans" data-date-format="dd-mm-yyyy" />    
                                        </div>
                                    </div>
                                    <div class="col-md-4">    
                                        <div class="form-group">
                                            <label>Tangga Pengiriman (ETD)</label>
                                            <input id="id_etd" required="required"
                                                   class="form-control input-sm date-picker cls_tglhariini" type="text"
                                                   name="etd" data-date-format="dd-mm-yyyy" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tangga Kedatangan ke Customer (ETA)</label>
                                            <input id="id_eta" required="required"
                                                   class="form-control input-sm date-picker cls_tglhariini" type="text"
                                                   name="eta" data-date-format="dd-mm-yyyy" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <input type="text" id="idTxtTempLoop" name="txtTempLoop" class="form-control nomor1 hidden">
                                        <input type="text" id="idSatuanLt" name="" class="form-control hidden ">
                                        <input type="text" id="idSatuanMl" name="" class="form-control hidden ">
                                        <input type="text" id="idSatuanGr" name="" class="form-control hidden ">
                                        <input type="text" id="idSatuanDrum" name="" class="form-control hidden">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Produk</label>
                                                    <!-- -->
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($produk as $row) :
                                                        $data[$row['id_produk']] = $row['nama_produk'];
                                                    endforeach;
                                                    echo form_dropdown('produk', $data, '', 'id="id_produk" class="form-control select2me kosongDetail"');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Stok Pengiriman</label>
                                                    <input id="id_stokAvl" readonly="true" class="form-control input-sm kosongTextDetail nomor"
                                                           type="text" name="stokAvl" placeholder=""/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group hidden">
                                                    <label>Storage</label>
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($storage as $row) :
                                                        $data[$row['id_storage']] = $row['nama_storage'];
                                                    endforeach;
                                                    echo form_dropdown('storage', $data, '', 'id="id_storage" class="form-control select2me kosongDetail"');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <!--                                                    <label>Jenis storage</label>-->
                                                    <input id="id_jnsStorage" readonly="true" class="form-control input-sm kosongTextDetail hidden"
                                                           type="text" name="jnsStorage" placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Jumlah produk (Packsize 1)</label>
                                                            <input id="id_produkKg" class="form-control input-sm nomor kosongNomorDetail cls_hitungTotalHarga"
                                                                   type="text" name="produkKg" placeholder=""/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Keterangan</label>
                                                            <textarea rows="2" cols="" name="keteranganCPA"  id="id_keteranganCPA" class="form-control input-sm kosongDetail"></textarea>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--  END  MODAL Data CPA -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-actions ">
                                        <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                            <!--<i class="fa fa-check"></i>--> Simpan
                                        </button>
                                        <button name="btnUbah" onclick="" class="btn yellow" id="id_btnUbah">
                                            <!--<i class="fa fa-edit"></i>--> Ubah
                                        </button>

                                        <button id="id_btnBatal" type="button" class="btn default">Kosongkan Form</button>
                                        <button name="btnHapus" onclick="" class="btn red" id="id_btnHapus">
                                            <!--<i class="fa fa-edit"></i>--> Batal Pengiriman
                                        </button>    
                                    </div>
                                </div>
                            </div>
                        </div>    


                    </div>

                </form>
            </div>
        </div>
        <!-- end <div class="portlet green-meadow box"> -->
    </div>
    <!-- end <div class="col-md-6"> -->
    <!--
    <div class="col-md-6">
    </div>
    -->
    <!-- end <div class="col-md-6"> -->
</div>

<!-- END PAGE CONTENT-->

<!--  END  MODAL Data Supplier -->
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
    /*
     var TableDatatablesButtons = function () {
     var e = function () {
     var e = $("#sample_1");
     e.dataTable({
     language: {
     aria: {
     sortAscending: ": activate to sort column ascending", 
     sortDescending: ": activate to sort column descending"}, 
     emptyTable: "No data available in table", 
     info: "Showing _START_ to _END_ of _TOTAL_ entries", 
     infoEmpty: "No entries found", 
     infoFiltered: "(filtered1 from _MAX_ total entries)", 
     lengthMenu: "_MENU_ entries", search: "Search:", 
     zeroRecords: "No matching records found"}, 
     buttons: [
     {
     extend: "print", className: "btn dark btn-outline"
     }, 
     {
     extend: "copy", className: "btn red btn-outline"
     }, 
     {
     extend: "pdf", className: "btn green btn-outline"
     }, 
     {
     extend: "excel", className: "btn yellow btn-outline "
     }, 
     {
     extend: "csv", className: "btn purple btn-outline "
     }, 
     {
     extend: "colvis", className: "btn dark btn-outline", text: "Columns"
     }
     ], 
     responsive: !0, 
     order: [[0, "asc"]], 
     lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]], 
     pageLength: 10, 
     dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
     })
     };
     return{init: function () {
     jQuery().dataTable && (e()
     }}
     }();
     */

    jQuery(document).ready(function () {
        UIBootbox.init();
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        TableManaged.init();

    });
    var ComponentsSelect2 = function() {
	var e = function() {
		function e(e) {
			if (e.loading) ;
			var t = "<div class='select2-result-repository clearfix'><div class='select2-result-repository__meta'>(" + e.nama_cust + ")";
			return e.alamat && (t += "<div class='select2-result-repository__description'>" + e.alamat + "</div>"), t += "</div></div>"
		}

		function t(e) {
			return e.nama_cust 
		}
		$.fn.select2.defaults.set("theme", "bootstrap");
		var s = "Select a State";
		$(".select2, .select2-multiple").select2({
			placeholder: s,
			width: null
		}), $(".select2-allow-clear").select2({
			allowClear: !0,
			placeholder: s,
			width: null
		}), $(".js-data-example-ajax").select2({
			width: "off",
			ajax: {
				url: "<?php echo site_url('/master/master_cust/getSearchCust'); ?>",
				dataType: "json",
				delay: 250,
				data: function(e) {
					return {
						q: e.term
					}
				},
				processResults: function(e, t) {
					return {
						results: e.items
					}
				},
				cache: !0
			},
			escapeMarkup: function(e) {
				return e
			},
			minimumInputLength: 1,
			templateResult: e,
			templateSelection: t
		}), $("button[data-select2-open]").click(function() {
			$("#" + $(this).data("select2-open")).select2("open")
		}), $(":checkbox").on("click", function() {
			$(this).parent().nextAll("select").prop("disabled", !this.checked)
		}), $(".select2, .select2-multiple, .select2-allow-clear, .js-data-example-ajax").on("select2:open", function() {
			if ($(this).parents("[class*='has-']").length)
				for (var e = $(this).parents("[class*='has-']")[0].className.split(/\s+/), t = 0; t < e.length; ++t) e[t].match("has-") && $("body > .select2-container").addClass(e[t])
		}), $(".js-btn-set-scaling-classes").on("click", function() {
			$("#select2-multiple-input-sm, #select2-single-input-sm").next(".select2-container--bootstrap").addClass("input-sm"), $("#select2-multiple-input-lg, #select2-single-input-lg").next(".select2-container--bootstrap").addClass("input-lg"), $(this).removeClass("btn-primary btn-outline").prop("disabled", !0)
		})
	};
	return {
		init: function() {
			e()
		}
	}
}();
    
    var TableManaged = function () {

        var initTable1 = function () {
            var tglAwalDaftar = $('#id_tglAwalDataDaftar').val();
            var tglAkhirDaftar = $('#id_tglAkhirDataDaftar').val();
            // begin first table
            var table = $('#idTabelPO'),
                    t = table.dataTable({
                        "ajax": {
                            'type': 'POST',
                            'url': '<?php echo base_url("/transaksi/sales_order/getRencanaOutAll"); ?>',
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
                            {"data": "no_aju"},
                            {"data": "no_cukai"},
                            {"data": "keterangan_so"},
                            //{"data": "act"}

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
            table.on('click', 'tbody tr', function () {
                var idSo = $(this).find("td").eq(1).html();
                $('#id_SoId').val(idSo);
                getDescSo(idSo);
                $("#navitab_2_2").trigger('click');
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);

            });

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


    //Ready Doc
    btnStart();
    readyToStart();
    tglTransStart();
    $("#id_tgltrans").focus();

    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
    });

    $('#id_btnBatal').click(function () {
        btnStart();
        resetForm();
        readyToStart();
        //tglTransStart();
        var tgltrans = $('#id_sessTgltrans').text();
        tgltrans = tgltrans.trim();
        $('.cls_tglhariini').val(tgltrans.trim());
        $('#id_body_data').empty();
        kosongDetail();
    });
    function getDescSo(idSo) {
        ajaxModal();
        if (idSo != '') {
            $.post("<?php echo site_url('/transaksi/sales_order/getDescSo'); ?>",
                    {
                        'idSo': idSo
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_tgltrans').val(data.tgl_trans);
                    $('#id_customer').select2("val", data.id_cust);
                    $('#id_poCust').val(data.no_po_cust);
                    $('#id_jnsdoc').select2("val", data.id_jnsdoc);
                    $('#id_etd').val(data.etd);
                    $('#id_eta').val(data.eta);
                    $('#id_produk').select2("val", data.id_produk);
                    $('#id_produkSbl').val(data.id_produk);
                    $('#id_storage').select2("val", data.id_storage);
                    $('#id_produkKg').val(data.qty_rencana);
                    $('#id_produkKgSbl').val(data.qty_rencana);
                    $('#id_keteranganCPA').val(data.keterangan_so);

                    getKuota(data.id_cust);
                    //$('#').val(data.);
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
        $('.kosongDetail').select2("val", "");
        $('#id_jnsdoc').select2("val", "");
        $('.kosongNomorDetail').val('0.00');
        $('.kosongNomor1Detail').val('0');
    }

    $("#id_customer").change(function () {
        var idCustomer = $(this).val();
        var idSo = $('#id_SoId').val();
        idSo.trim();
        //alert(idSo);
        if (idSo == '') {
            if (idCustomer == '') {
                $('#id_produk').select2("val", "");
                $('#id_jnsStorage').val('');
            } else {
                getDescCustomer(idCustomer);
                getKuota(idCustomer);
            }
        } else {
        }


    });
    $("#id_produk").change(function () {
        var idProduk = $(this).val();
        if (idProduk == '') {
            $('#id_storage').select2("val", "");
            $('#id_jnsStorage').val('');
        } else {
            getDescProduk(idProduk);
            getStockAvl(idProduk);
        }

    });

    function getDescCustomer(idCust) {
        ajaxModal();
        if (idCust != '') {
            $.post("<?php echo site_url('transaksi/sales_order/getDescCust'); ?>",
                    {
                        'idCust': idCust
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_produk').select2("val", data.id_produk);
                    getDescProduk(data.id_produk);
                    /*
                     $('#').val(data.); */
                } else {
                    alert('Data tidak ditemukan!');
                    $('#id_btnBatal').trigger('click');
                }
            }, "json");
        }//if kd<>''
    }
    function getKuota(idCust) {
        ajaxModal();
        if (idCust != '') {
            $.post("<?php echo site_url('globalc/getKuotaCust'); ?>",
                    {
                        'idCust': idCust
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_kuota').text(number_format(data.kuota_saldo_akhir, 2));
                    $('#id_noskep').text(data.no_skep);
                    $('#id_noSkep').val(data.no_skep);
                    /*
                     $('#').val(data.); */
                } else {
                    $('#id_kuota').text('0.00');
                    alert('Data kuota tidak ditemukan!');
                    // $('#id_btnBatal').trigger('click');
                }
            }, "json");
        }//if kd<>''
    }

    function getDescProduk(idProduk) {
        ajaxModal();
        if (idProduk != '') {
            $.post("<?php echo site_url('transaksi/sales_order/getDescProduk'); ?>",
                    {
                        'idProduk': idProduk
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_storage').select2("val", data.id_storage);
                    $('#idSatuanLt').val(data.satuan_lt);
                    $('#idSatuanMl').val(data.satuan_ml);
                    $('#idSatuanGr').val(data.satuan_gr);
                    $('#idSatuanDrum').val(data.satuan_drum);
                    //getDescStorage(data.id_storage);
                    /*
                     $('#').val(data.); */
                } else {
                    alert('Data tidak ditemukan!');
                    $('#id_btnBatal').trigger('click');
                }
            }, "json");
        }//if kd<>''
    }
    $("#id_storage").change(function () {
        var idStorage = $(this).val();
        //getDescStorage(idStorage);
    });
    $("#id_etd").change(function () {
        var etd = $(this).val();
        $("#id_eta").val(etd);
    });

    function getDescStorage(idStorage) {
        ajaxModal();
        if (idStorage != '') {
            $.post("<?php echo site_url('transaksi/sales_order/getDescStorage'); ?>",
                    {
                        'idStorage': idStorage
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_jnsStorage').val(data.nama_jns_storage);
                    /*
                     $('#').val(data.); */
                } else {
                    alert('Data tidak ditemukan!');
                }
            }, "json");
        }//if kd<>''
    }
    function getStockAvl(idProduk) {
        ajaxModal();
        if (idProduk != '') {
            $.post("<?php echo site_url('globalc/getStockAvl'); ?>",
                    {
                        'idProduk': idProduk
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_stokAvl').val(number_format(data.stok_avl, 2));
                } else {
                    alert('Data tidak ditemukan!');
                }
            }, "json");
        }//if kd<>''

    }
    $('#id_btnNext1').click(function () {
        $('.linav').removeClass("active");
        $('#linav2').addClass("active in");
        $('.anavitab').attr("aria-expanded", "false");
        $('#navitab_2_2').attr("aria-expanded", "true");
        $('.tab-pane').removeClass("active in");
        $('#tab_2_2').addClass("active in");
    });
    $('#id_btnNext2').click(function () {
        $('.linav').removeClass("active");
        $('#linav3').addClass("active in");
        $('.anavitab').attr("aria-expanded", "false");
        $('#navitab_2_3').attr("aria-expanded", "true");
        $('.tab-pane').removeClass("active in");
        $('#tab_2_3').addClass("active in");
    });


    $('#id_btnBatalCpa').click(function () {
        kosongDetail();
    });
    function ajaxSubmitAdvance() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>transaksi/sales_order/simpan",
            data: dataString,
            success: function (data) {
                $('#id_btnBatal').trigger('click');
                $('#id_Reload').trigger('click');
                //readyToStart();
                UIToastr.init(data.tipePesan, data.pesan);
                $('#id_customer').focus();
                /*
                 $('.linav').removeClass("active");
                 $('#linav1').addClass("active in");
                 $('.anavitab').attr("aria-expanded", "false");
                 $('#navitab_2_1').attr("aria-expanded", "true");
                 $('.tab-pane').removeClass("active in");
                 $('#tab_2_1').addClass("active in");
                 */
            }

        });
    }
    function ajaxUbah() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>transaksi/sales_order/ubah",
            data: dataString,
            success: function (data) {
                $('#id_btnBatal').trigger('click');
                $('#id_Reload').trigger('click');
                //readyToStart();
                UIToastr.init(data.tipePesan, data.pesan);
                $('#id_customer').focus();
            }

        });
    }
    function ajaxHapus() {
        ajaxModal();
        var idSo = $('#id_SoId').val();
        idSo = idSo.trim();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>transaksi/sales_order/hapus",
            data: {idSo: idSo},
            success: function (data) {
                $('#id_Reload').trigger('click');
                $('#id_btnBatal').trigger('click');
                UIToastr.init(data.tipePesan, data.pesan);
            }

        });
        event.preventDefault();
    }

    $('#id_formAdvance').submit(function (event) {

        dataString = $("#id_formAdvance").serialize();
        event.preventDefault();
        var aksiBtn = $('#idTmpAksiBtn').val();
        if (aksiBtn == '1') {
            var stokavl = $('#id_stokAvl').val();
            stokavl = parseFloat(CleanNumber(stokavl));
            if (stokavl <= 0) {
                bootbox.confirm("Stok anda tidak mencukupi untuk membuat sales order, apakah anda yakin menyimpan data ini?", function (o) {
                    if (o == true) {
                        ajaxSubmitAdvance();
                    }
                });
            } else {
                bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
                    if (o == true) {
                        ajaxSubmitAdvance();
                    }
                });

            }
        } else if (aksiBtn == '2') {
            var stokavl = $('#id_stokAvl').val();
            stokavl = parseFloat(CleanNumber(stokavl));
            if (stokavl <= 0) {
                bootbox.confirm("Stok anda tidak mencukupi untuk membuat sales order, apakah anda yakin menyimpan data ini?", function (o) {
                    if (o == true) {
                        ajaxUbah();
                    }
                });
            } else {
                bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
                    if (o == true) {
                        ajaxUbah();
                    }
                });

            }
        }
    });
//                                bootbox.confirm("Are you sure?", function (o) {
//                                        //alert("Confirm result: " + stokavl)
//                                        if (o == true){
//                                           // ajaxSubmitAdvance();
//                                        }else{
//                                            return false;
//                                        }
//                                    });

    /*
     * 
     $(".cls_hitungBerat").focusout(function () {
     hitungBerat();
     });
     $(".cls_hitungBeratMdl").focusout(function () {
     hitungBeratMdl();
     });
     function hitungBerat() {
     var beratMolindo = parseFloat(CleanNumber($('#id_beratMolindo').val()));
     var bruto = parseFloat(CleanNumber($('#id_bruto').val()));
     var tarra = parseFloat(CleanNumber($('#id_tarra').val()));
     var netto = bruto - tarra;
     var selisih = beratMolindo - netto;
     $('#id_netto').val(number_format(netto, 2));
     $('#id_selisihKg').val(number_format(selisih, 2));
     var fkLt = parseFloat(CleanNumber($('#idSatuanLt').val()));
     var selisihLt = selisih * fkLt;
     $('#id_selisihLt').val(number_format(selisihLt, 2));
     var selisihPersen = selisih / beratMolindo * 100;
     $('#id_selisihPersen').val(number_format(selisihPersen, 2));
     
     $('#id_produkKg').val(number_format(netto, 2));
     hitungBeratMdl();
     }
     function hitungBeratMdl() {
     var kg = parseFloat(CleanNumber($('#id_produkKg').val()));
     var fkLt = parseFloat(CleanNumber($('#idSatuanLt').val()));
     var fkDrum = parseFloat(CleanNumber($('#idSatuanDrum').val()));
     
     var lt = kg * fkLt;
     $('#id_produkLt').val(number_format(lt, 2));
     
     var drum = kg * fkDrum;
     $('#id_produkDrum').val(number_format(drum, 2));
     
     }
     $('#id_btnAddCpa').click(function () {
     var i = $('#idTxtTempLoop').val();
     if ($('#id_produk').val() == '' || $('#id_storage').val() == '') {
     alert("Produk atau storage tidak boleh kosong.");
     } else {
     var i = parseInt($('#idTxtTempLoop').val());
     i = i + 1;
     var kdProduk = $('#id_produk').val();
     var txtProduk = $('#id_produk option:selected').text();
     var kdStorage = $('#id_storage').val();
     var txtStorage = $('#id_storage option:selected').text();
     var kg = $('#id_produkKg').val();
     var hargaSatuan = $('#id_hargaSatuan').val();
     var hargaTotal = $('#id_hargaTotal').text();
     hargaTotal.trim();
     var ket = $('#id_keteranganCPA').val().trim();
     tr = '<tr class="listdata" id="tr' + i + '">';
     tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdProduk' + i + '" name="tempKdProduk' + i + '" readonly="true" value="' + kdProduk + '"></td>';
     tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdStorage' + i + '" name="tempKdStorage' + i + '" readonly="true" value="' + kdStorage + '" ></td>';
     tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtProduk' + i + '" name="tempTxtProduk' + i + '" readonly="true" value="' + txtProduk + '" ></td>';
     tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtStorage' + i + '" name="tempTxtStorage' + i + '" readonly="true" value="' + txtStorage + '" ></td>';
     tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempKg' + i + '" name="tempKg' + i + '" readonly="true" value="' + kg + '" ></td>';
     tr += '<td><input type="text" class="form-control input-sm" id="id_tempKet' + i + '" name="tempKet' + i + '" readonly="true" value="' + ket + '"></td>';
     tr += '<td><a href="#" class="btn red btn-sm" onclick="hapusBaris(\'tr' + i + '\')"><i class="fa fa-minus fa-fw"/></i></a></td>';
     tr += '</tr>';
     
     jmlKg = parseFloat(CleanNumber(kg));
     
     var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));
     
     var total_kg = jmlKg + totalKg;
     
     $('#id_totalKg').val(number_format(total_kg, 2));
     
     $('#id_body_data').append(tr);
     $('#idTxtTempLoop').val(i);
     kosongDetail();
     }
     });
     function hapusBaris(noRow) {
     if (document.getElementById(noRow) != null) {
     
     var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));
     
     var jmlKgOld = $('#' + noRow).find("td input").eq(4).val();
     jmlKgOld = parseFloat(CleanNumber(jmlKgOld));
     
     totalKg = totalKg - jmlKgOld;
     
     $('#id_totalKg').val(number_format(totalKg, 2));
     
     $('#' + noRow).remove();
     }
     }
     */


</script>


<!-- END JAVASCRIPTS -->