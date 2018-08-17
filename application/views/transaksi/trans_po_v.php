<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">
    table#idTabelAdv td:nth-child(3) {
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
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Data Cucian Masuk </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form Input Data Cucian </a>
                    </li>

                </ul>
                <form role="form" method="post"
                      action="<?php echo base_url('transaksi/trans_po/home'); ?>" id="id_formAdvance">
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
                                                    Est Selesai
                                                </th>
                                                <th>
                                                    Layanan
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
                                                <th  width="7%" >
                                                    Aksi
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
                        <div class="tab-pane fade" id="tab_2_2">

                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input id="id_idMaster" 
                                                           class="form-control input-sm hidden" type="text"
                                                           name="idMaster" />
                                                    <label>Tanggal Masuk</label> 
                                                    <input id="id_tgltrans" required="required"
                                                           class="form-control input-sm date-picker" type="text"
                                                           name="tglTrans" data-date-format="dd-mm-yyyy" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Estimasi Selesai</label> 
                                                    <input id="id_etglSelesai" required="required"
                                                           class="cls_3harikemudian form-control input-sm date-picker" type="text"
                                                           name="etglSelesai" data-date-format="dd-mm-yyyy" />
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label>Customer</label>
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($cust as $row) :
                                                        $data[$row['id_cust']] = $row['nama_cust'] . " - " . $row['telp'];
                                                    endforeach;
                                                    echo form_dropdown('customer', $data, '', 'required id="id_customer" class="form-control input-sm select2me "');
                                                    ?>
                                                    <input type="text" name="nama_cust" id="id_nama_cust" class="hidden">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Layanan</label>
                                                    <select name="prioritas" id="id_prioritas" class="form-control input-sm" required>
                                                        <option value=""></option>
                                                        <option value="0">Biasa</option>
                                                        <option value="1">Express</option>
                                                    </select>
                                                </div>
                                            </div>    

                                        </div>

                                    </div>
                                    <!--end <div class="col-md-6"> 1 -->
                                    <div  class="hidden">
                                        <div class="form-group">
                                            <label>Harga Cuci Setrika Biasa</label>
                                            <input id="id_harga1" required="required" class="form-control input-sm kanan nomor1"
                                                   type="text" name="harga1"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Cuci Setrika Express</label>
                                            <input id="id_harga2" required="required" class="form-control input-sm kanan nomor1"
                                                   type="text" name="harga2"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Setrika Biasa</label>
                                            <input id="id_harga3" required="required" class="form-control input-sm kanan nomor1"
                                                   type="text" name="harga3"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Setrika Express</label>
                                            <input id="id_harga4" required="required" class="form-control input-sm kanan nomor1"
                                                   type="text" name="harga4"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Cuci Aja Biasa</label>
                                            <input id="id_harga5" required="required" class="form-control input-sm kanan nomor1"
                                                   type="text" name="harga5"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Cuci Aja Express</label>
                                            <input id="id_harga6" required="required" class="form-control input-sm kanan nomor1"
                                                   type="text" name="harga6"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Dry Clean</label>
                                            <input id="id_harga7" required="required" class="form-control input-sm kanan nomor1"
                                                   type="text" name="harga7"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Agen</label>
                                            <?php
                                            $data = array();
                                            $data[''] = 'Sendiri';
                                            foreach ($agen as $row) :
                                                $data[$row['id_agen']] = $row['nama_agen'] . " | " . $row['telp'];
                                            endforeach;
                                            echo form_dropdown('agen', $data, '', ' id="id_agen" class="form-control input-sm "');
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label>No Bon</label>
                                            <input id="id_bonManual" class="form-control input-sm"
                                                   type="text" name="bonManual"/>
                                        </div>            
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Pembayaran</label>
                                                    <select class="form-control input-sm" name="status_bayar" id="id_status_bayar">
                                                        <option value="0">Belum bayar</option>
                                                        <option value="1">Sudah bayar</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="cls_diskon_lgsbayar">Diskon</label>
                                                    <input type="text" class="form-control nomor1 cls_diskon_lgsbayar" name="diskon_lgsbayar" id="id_diskon_lgsbayar">  
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" name="keterangan_cm" id="id_keterangan_cm" rows="2"></textarea>
                                        </div>    
                                    </div>
                                </div>
                                <!-- HIDDEN INPUT -->
                                <input type="text" id="idTmpAksiBtn" class="hidden">
                                <!-- END HIDDEN INPUT -->
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <input type="text" id="idTxtTempLoop" name="txtTempLoop" class="form-control nomor1 hidden">
                                        <a href="#" class="btn green-haze btn-sm" data-target="#idDivInputProduk"
                                           id="id_btnModalTambah" data-toggle="modal">
                                            <i class="fa fa-plus fa-fw"/></i>&nbsp;Tambah
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-body">
                                        <table class="table table-striped table-hover table-bordered" id="id_tabelPerkCflow">
                                            <thead>
                                                <tr>
                                                    <th width="7%" style="display:none;"><!--style="display:none;"-->
                                                        Kd Jasa
                                                    </th>
                                                    <th width="7%" style="display:none;">
                                                        Kd Layanan
                                                    </th>
                                                    <th width="15%">
                                                        Jasa
                                                    </th>
                                                    <th width="16%">
                                                        Layanan
                                                    </th>
                                                    <th width="10%">
                                                        Jumlah
                                                    </th>
                                                    <th width="15%">
                                                        Harga Satuan
                                                    </th>
                                                    <th width="15%">
                                                        Total Harga
                                                    </th>
                                                    <th width="5%">
                                                        Act
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="id_body_data">

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2" style="display:none;"></td>
                                                    <td colspan="2"><strong>Total</strong></td>
                                                    <td ><input type="text" readonly="true" class="form-control input-sm nomor" id="id_totalKg" name="totalKg"></td>
                                                    <td ><input type="text" readonly="true" class="form-control input-sm nomor" id="id_totalHargaSatuan" name="totalHargaSatuan"></td>
                                                    <td ><input type="text" readonly="true" class="form-control input-sm nomor" id="id_totalHargaAll" name="totalHargaAll"></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
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
                                        <button type="button" name="btnCetak" class="btn yellow" id="id_btnCetakStruk">Cetak
                                        </button>
                                        <button id="id_btnBatal" type="button" class="btn default">Clear</button>
                                    </div>
                                </div>
                            </div>

                        </div>    
                        <!--<div class="tab-pane fade" id="tab_2_3">-->
                        <!--  MODAL Data CPA -->

                        <!-- END ROW-->

                        <!--                        </div>-->

                        <!--                    </div>-->

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

<!--  MODAL Input Data Cucian Masuk -->
<div class="modal fade draggable-modal" id="idDivInputProduk"  role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data cucian masuk</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:200px; ">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Produk</label>
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($produk as $row) :
                                                $data[$row['id_produk']] = $row['nama_produk'];
                                            endforeach;
                                            echo form_dropdown('produk', $data, '', 'id="id_produk" class="form-control select2me kosongDetail cls_hitungTotalHarga"');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis layanan</label>
                                            <select class="form-control select2me cls_hitungTotalHarga kosongDetail" name="layanan" id="id_layanan">
                                                <option value=""></option>
                                                <option value="1">Cuci Setrika Biasa</option>
                                                <option value="2">Cuci Setrika Express</option>
                                                <option value="3">Setrika Aja Biasa</option>
                                                <option value="4">Setrika Aja Express</option>
                                                <option value="5">Cuci Aja Biasa</option>
                                                <option value="6">Cuci Aja Express</option>
                                                <option value="7">Dry Clean</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Harga satuan</label>
                                        <input id="id_hargaSatuan"  class="hidden form-control input-sm nomor kosongNomorDetail cls_hitungTotalHarga"
                                               type="text" name="hargaSatuan" placeholder=""/>
                                        <strong><p id="id_spanHargaSatuan" class="kosongTextDetail2 help-block"></p></strong>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Jumlah cucian</label>
                                                    <input id="id_jmlCucian" class="form-control input-sm nomor kosongNomorDetail cls_hitungTotalHarga"
                                                           type="text" name="jmlCucian" placeholder=""/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">

                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="">Harga Total</label>
                                                        </div>
                                                        <div class="col-md-6 kanan">
                                                            <p id="id_hargaTotal" class="kosongTextDetail2" style=" font-size: 30px; color: red;"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <!--<div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea rows="2" cols="" name="keteranganCPA"  id="id_keteranganCPA" class="form-control input-sm kosongDetail"></textarea>
                                                </div>-->
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <button type="button" class="btn blue" id="id_btnAddCpa"><i class="fa fa-plus"></i>&nbsp; Tambah</button>
                <button type="button" class="btn default" data-dismiss="modal" id="id_btnBatalCpa"><i class="fa fa-times"></i>&nbsp;Selesai</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- End MODAL Input Data Cucian Masuk -->
<!--  MODAL Input Data Pengambilan Cucian -->
<div class="modal fade draggable-modal" id="idDivAmbilProduk"  role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data cucian yang akan diambil</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nama customer</label>
                                            <strong><p id="id_spanNamaCustAmbil" class="help-block cls_spanNamaCust"></p></strong>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Agen</label>
                                            <strong><p id="id_spanNamaAgenAmbil" class="help-block cls_spanNamaAgen"></p></strong>    
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Harga total</label>
                                        <strong><p id="id_spanHargaTotalAmbil" class=" help-block" style=" font-size: 30px; color: blue;"></p></strong>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Jumlah yg harus dibayar</label>
                                        <strong><p id="id_spanHargaYgDibayar" class="help-block" style=" font-size: 30px; color: red;"></p></strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Pembayaran</label>
                                                    <div class="mt-checkbox-list">
                                                        <label class="mt-checkbox mt-checkbox-outline">
                                                            <input type="checkbox" value="1" name="statusBayarAmbil" id="id_bayarAmbil">
                                                            Bayar<span></span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="">Bon</label>
                                                            <div class="mt-checkbox-list">
                                                                <label class="mt-checkbox mt-checkbox-outline">
                                                                    <input type="checkbox" value="1" name="statusBonAmbil" id="id_bonAmbil">
                                                                    Bawa<span></span></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 kanan">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Diskon</label>
                                                    <input id="id_diskon" class="form-control input-sm nomor"
                                                           type="text" name="diskon" placeholder=""/>
                                                </div>
                                                <!---->
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Uang Pembayaran</label>
                                                    <input id="id_uangBayarAmbil" class="form-control input-sm nomor"
                                                           type="text" name="uangBayarAmbil" placeholder=""/>
<!--                                                    <span class="help-block" id=""> A block of help text. </span>-->
                                                </div>
                                                <!---->
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea rows="2" cols="" name="keteranganAmbil"  id="id_keteranganAmbil" class="form-control input-sm"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tanggal ambil</label>
                                            <input type="text" id="id_tglAmbil" class="cls_tglhariini_static form-control input-sm date-picker cls_tglhariini_static" data-date-format="dd-mm-yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Uang kembalian</label>
                                            <strong><p id="id_spanUangKembalian" class="help-block" style=" font-size: 30px; color: green;">-</p></strong>
                                        </div>
                                    </div>

                                </div>    
                                <div class="row">
                                    <div class="col-md-12">

                                        <table class="table table-striped table-hover table-bordered" id="id_tabelCucianAmbil">
                                            <thead>
                                                <tr>
                                                    <th width="7%" style="display:none;"><!--style="display:none;"-->
                                                        Kd Jasa
                                                    </th>
                                                    <th width="7%" style="display:none;">
                                                        Kd Layanan
                                                    </th>
                                                    <th width="15%">
                                                        Jasa
                                                    </th>
                                                    <th width="16%">
                                                        Layanan
                                                    </th>
                                                    <th width="10%">
                                                        Jumlah
                                                    </th>
                                                    <th width="15%">
                                                        Harga Satuan
                                                    </th>
                                                    <th width="15%">
                                                        Total Harga
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody id="id_body_data_detail" class="cls_body_detail_cucian">

                                            </tbody>
                                            <!--<tfoot>
                                                <tr>
                                                    <td colspan="2" style="display:none;"></td>
                                                    <td colspan="2"><strong>Total</strong></td>
                                                    <td ><input type="text" readonly="true" class="form-control input-sm nomor" id="id_totalKgAmbil" ></td>
                                                    <td ><input type="text" readonly="true" class="form-control input-sm nomor" id="id_totalHargaSatuanAmbil" ></td>
                                                    <td ><input type="text" readonly="true" class="form-control input-sm nomor" id="id_totalHargaAllAmbil" ></td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>-->
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <button type="button" class="btn blue" id="id_btnAmbil"><i class="fa fa-plus"></i>&nbsp; Ambil</button>
                <button type="button" class="btn default" data-dismiss="modal" id="id_btnBatalAmbil"><i class="fa fa-times"></i>&nbsp;Selesai</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- End MODAL Input Data Pengambilan Cucian -->
<!--  MODAL Input Data Finishing Cucian -->
<div class="modal fade draggable-modal" id="idDivFinishingCucian"  role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data cucian yang telah selesai</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nama customer</label>
                                            <strong><p id="id_spanNamaCustFinish" class="help-block cls_spanNamaCust"></p></strong>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Agen</label>
                                            <strong><p id="id_spanNamaAgenFinish" class="help-block cls_spanNamaAgen"></p></strong>    
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Total Satuan</label>
                                        <strong><p id="id_spanTotalSatuanFinish" class=" help-block" style=" font-size: 30px; color: blue;"></p></strong>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Total Kiloan</label>
                                        <strong><p id="id_spanTotalKiloanFinish" class="help-block" style=" font-size: 30px; color: red;"></p></strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Karyawan Setrika</label>
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($karyawan as $k) :
                                                        $data[$k->id_kyw] = $k->nama_kyw;
                                                    endforeach;
                                                    echo form_dropdown('karyawan', $data, '', 'id="id_karyawan" class="form-control"');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Tanggal selesai</label>
                                                    <input type="text" id="id_tglFinishing" class="cls_tglhariini_static form-control input-sm date-picker " data-date-format="dd-mm-yyyy">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Setrika Satuan</label>
                                                    <input id="id_setrikaSatuanFinish" class="form-control input-sm nomor"
                                                           type="text" name="setrikaSatuanFinish" placeholder=""/>
                                                </div>
                                                <!---->
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Setrika Kiloan</label>
                                                    <input id="id_setrikaKiloanFinish" class="form-control input-sm nomor"
                                                           type="text" name="setrikaKiloanFinish" placeholder=""/>
<!--                                                    <span class="help-block" id=""> A block of help text. </span>-->
                                                </div>
                                                <!---->
                                            </div>
                                        </div>  
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                        <table class="table table-striped table-hover table-bordered" id="id_tabelCucianFinish">
                                            <thead>
                                                <tr>
                                                    <th width="7%" style="display:none;"><!--style="display:none;"-->
                                                        Kd Jasa
                                                    </th>
                                                    <th width="7%" style="display:none;">
                                                        Kd Layanan
                                                    </th>
                                                    <th width="15%">
                                                        Jasa
                                                    </th>
                                                    <th width="16%">
                                                        Layanan
                                                    </th>
                                                    <th width="10%">
                                                        Jumlah
                                                    </th>
                                                    <th width="15%">
                                                        Harga Satuan
                                                    </th>
                                                    <th width="15%">
                                                        Total Harga
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody id="id_body_data_finishing" class="cls_body_detail_cucian">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <button type="button" class="btn blue" id="id_btnFinishing"><i class="fa fa-plus"></i>&nbsp; Finishing</button>
                <button type="button" class="btn default" data-dismiss="modal" id="id_btnBatalFinish"><i class="fa fa-times"></i>&nbsp;Selesai</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- End MODAL Input Data Pengambilan Cucian -->

<!--  MODAL Input Data Outsourching -->
<div class="modal fade draggable-modal" id="idDivOutsourceCucian"  role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data cucian yang akan dioutsource</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nama customer</label>
                                            <strong><p id="id_spanNamaCustFinish" class="help-block cls_spanNamaCust"></p></strong>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Agen</label>
                                            <strong><p id="id_spanNamaAgenFinish" class="help-block cls_spanNamaAgen"></p></strong>    
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tgl Keluar ke outsource</label>
                                        <input type="text" id="id_tglKelKeOutsource" class="cls_tglhariini_static form-control input-sm date-picker cls_tglhariini_static" data-date-format="dd-mm-yyyy">
                                        <strong><p id="id_spanTglKelKeOutsource" class=" help-block" style=" font-size: 20px; color: blue;"></p></strong>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tgl Kembali ke laundry</label>
                                        <input type="text" id="id_tglMskDrOutsource" class="cls_tglhariini_static form-control input-sm date-picker " data-date-format="dd-mm-yyyy">
                                        <strong><p id="id_spanTglMskDrOutsource" class="help-block" style=" font-size: 20px; color: red;"></p></strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Outsource ke</label>
                                                    <?php
                                                    $dat = array();
                                                    $dat[''] = '';
                                                    foreach ($osource as $ki) :
                                                        $dat[$ki->id_outsource] = $ki->nama_outsource;
                                                    endforeach;

                                                    echo form_dropdown('outsource', $dat, '', 'id="id_outsource" class="form-control"');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <strong><p id="id_spanStatusOutsource" class="help-block" style=" font-size: 20px; color: GREEN;"></p></strong>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                        <table class="table table-striped table-hover table-bordered" id="id_tabelCucianOutsource">
                                            <thead>
                                                <tr>

                                                    <th width="7%" style="display:none;"><!--style="display:none;"-->
                                                        Kd Jasa
                                                    </th>
                                                    <th width="7%" style="display:none;">
                                                        Kd Layanan
                                                    </th>
                                                    <th width="15%">
                                                        Jasa
                                                    </th>
                                                    <th width="16%">
                                                        Layanan
                                                    </th>
                                                    <th width="10%">
                                                        Jumlah
                                                    </th>
                                                    <th width="15%">
                                                        Harga Satuan
                                                    </th>
                                                    <th width="15%">
                                                        Total Harga
                                                    </th>
                                                    <th width="3%"><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input class="group-checkable" data-set="#id_tabelCucianOutsource .checkboxes" type="checkbox"><span></span></label>
                                                    </th>    
                                                </tr>
                                            </thead>
                                            <tbody id="id_body_data_outsource" class="cls_body_detail_cucian">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <input type="text" name="inputIdTransOutsource" id="id_inputIdTransOutsource" class="form-control hidden">
                <button type="button" class="btn blue" id="id_btnOutsource"><i class="fa fa-plus"></i>&nbsp; Outsource</button>
                <button type="button" class="btn red" id="id_btnOutsourceMsk"><i class="fa fa-plus"></i>&nbsp; Kembali ke laundry</button>
                <button type="button" class="btn default" data-dismiss="modal" id="id_btnBatalOutsource"><i class="fa fa-times"></i>&nbsp;Selesai</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- End MODAL Input Data Pengambilan Cucian -->
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

    $('#id_btnAddCpa').click(function () {
        var i = $('#idTxtTempLoop').val();
        if ($('#id_produk').val() == '' || $('#id_layanan').val() == '') {
            alert("Produk atau layanan tidak boleh kosong.");
        } else {
            var i = parseInt($('#idTxtTempLoop').val());
            i = i + 1;
            var kdProduk = $('#id_produk').val();
            var txtProduk = $('#id_produk option:selected').text();
            var kdLayanan = $('#id_layanan').val();
            var txtLayanan = $('#id_layanan option:selected').text();
            var kg = $('#id_jmlCucian').val();
            var hargaSatuan = $('#id_hargaSatuan').val();
            var hargaTotal = $('#id_hargaTotal').text();
            hargaTotal.trim();
            tr = '<tr class="listdata" id="tr' + i + '">';
            tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdProduk' + i + '" name="tempKdProduk' + i + '" readonly="true" value="' + kdProduk + '"></td>';
            tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdLayanan' + i + '" name="tempKdLayanan' + i + '" readonly="true" value="' + kdLayanan + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtProduk' + i + '" name="tempTxtProduk' + i + '" readonly="true" value="' + txtProduk + '" ></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtLayanan' + i + '" name="tempTxtLayanan' + i + '" readonly="true" value="' + txtLayanan + '" ></td>';
            tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempKg' + i + '" name="tempKg' + i + '" readonly="true" value="' + kg + '" ></td>';
            tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempHargasatuan' + i + '" name="tempHargaSatuan' + i + '" readonly="true" value="' + hargaSatuan + '" ></td>';
            tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempTotalHarga' + i + '" name="tempTotalHarga' + i + '" readonly="true" value="' + hargaTotal + '" ></td>';
            tr += '<td><a href="#" class="btn red btn-sm" onclick="hapusBaris(\'tr' + i + '\')"><i class="fa fa-minus fa-fw"/></i></a></td>';
            tr += '</tr>';

            jmlKg = parseFloat(CleanNumber(kg));
            jmlLt = parseFloat(CleanNumber(hargaSatuan));
            jmlDrum = parseFloat(CleanNumber(hargaTotal));

            var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));
            var totalLt = parseFloat(CleanNumber($('#id_totalHargaSatuan').val()));
            var totalDrum = parseFloat(CleanNumber($('#id_totalHargaAll').val()));

            var total_kg = jmlKg + totalKg;
            var total_lt = jmlLt + totalLt;
            var total_drum = jmlDrum + totalDrum;

            $('#id_totalKg').val(number_format(total_kg, 2));
            $('#id_totalHargaSatuan').val(number_format(total_lt, 2));
            $('#id_totalHargaAll').val(number_format(total_drum, 2));

            $('#id_body_data').append(tr);
            $('#idTxtTempLoop').val(i);
            kosongDetail();
        }
    });
    function hapusBaris(noRow) {
        if (document.getElementById(noRow) != null) {

            var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));
            var totalLt = parseFloat(CleanNumber($('#id_totalHargaSatuan').val()));
            var totalDrum = parseFloat(CleanNumber($('#id_totalHargaAll').val()));
            var jmlKgOld = $('#' + noRow).find("td input").eq(4).val();
            jmlKgOld = parseFloat(CleanNumber(jmlKgOld));
            var jmlLtOld = $('#' + noRow).find("td input").eq(5).val();
            jmlLtOld = parseFloat(CleanNumber(jmlLtOld));
            var jmlDrumOld = $('#' + noRow).find("td input").eq(6).val();
            jmlDrumOld = parseFloat(CleanNumber(jmlDrumOld));
            totalKg = totalKg - jmlKgOld;
            totalLt = totalLt - jmlLtOld;
            totalDrum = totalDrum - jmlDrumOld;
            $('#id_totalKg').val(number_format(totalKg, 2));
            $('#id_totalHargaSatuan').val(number_format(totalLt, 2));
            $('#id_totalHargaAll').val(number_format(totalDrum, 2));
            $('#' + noRow).remove();
        }
    }

    $('#id_btnBatalCpa').click(function () {
        kosongDetail();
    });
    function ajaxSubmitAdvance() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>transaksi/trans_po/simpan",
            data: dataString,
            success: function (data) {
                $('#id_btnSimpan').attr("disabled", true);
                UIToastr.init(data.tipePesan, data.pesan);
                $('#id_idMaster').val(data.idMaster);
                $('#id_Reload').trigger('click');
            }
        });
    }

    $('#id_formAdvance').submit(function (event) {
        dataString = $("#id_formAdvance").serialize();
        var jmlCpa = $('#idTxtTempLoop').val();
        if (jmlCpa == 0) {
            alert("Masukkan produk!");
            $('.linav').removeClass("active");
            $('#linav2').addClass("active in");
            $('.anavitab').attr("aria-expanded", "false");
            $('#navitab_2_2').attr("aria-expanded", "true");
            $('.tab-pane').removeClass("active in");
            $('#tab_2_2').addClass("active in");
            return false;
        }
        var aksiBtn = $('#idTmpAksiBtn').val();
        if (aksiBtn == '1') {
            var r = confirm('Anda yakin menyimpan data ini?');
            if (r == true) {
                ajaxSubmitAdvance();
                event.preventDefault();
            } else {//if(r)
                return false;
            }
        }
    });
    function cetak() {
        var masterId = $('#id_idMaster').val();
        if (masterId == '') {
            alert('Master id kosong.');
        } else {
            window.open("<?php echo base_url('transaksi/trans_po/cetakPO/'); ?>/" + masterId, '_blank'); //+ idAdvance + masterId
        }
    }

    var TableManaged = function () {

        var initTable1 = function () {
            var tglAwalDaftar = $('#id_tglAwalDataDaftar').val();
            var tglAkhirDaftar = $('#id_tglAkhirDataDaftar').val();
            // begin first table
            var table = $('#idTabelPO'),
                    t = table.dataTable({
                        "ajax": {
                            'type': 'POST',
                            'url': '<?php echo base_url("/transaksi/trans_po/getCucianMasuk"); ?>',
                            'data': function (d) {
                                d.tglAwalDaftar = $('#id_tglAwalDataDaftar').val();
                                d.tglAkhirDaftar = $('#id_tglAkhirDataDaftar').val();
                            }
                        },
                        "columns": [
                            {"data": "noSeq"},
                            {"data": "idMaster"},
                            {"data": "noBon"},
                            {"data": "nama_cust"},
                            {"data": "tgl_trans"},
                            {"data": "e_tgl_selesai"},
                            {"data": "layanan"},
                            {"data": "status_outsource"},
                            {"data": "status_selesai"},
                            {"data": "status_bayar"},
                            {
                                "data": null,
                                "render": function (data, type, row) {
                                    //var x= '<button id="' + row.id + '" class="dodo" onclick="deleteClick(this)">Delete</button>';
                                    var act_btn = '<div class="btn-group">';
                                    act_btn += '<a aria-expanded="false" class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;"> Act<i class="fa fa-angle-down"></i></a>';
                                    act_btn += '<ul class="dropdown-menu">';
                                    act_btn += '<li><a class="btn btn-info" href="javascript:;" data-target="#idDivFinishingCucian" id="id_btnModalFinish" data-toggle="modal" onclick="finishing(this)"> Finishing </a></li>';
                                    act_btn += '<li><a class="btn btn-warning" href="javascript:;" data-target="#idDivOutsourceCucian" id="id_btnModalOutsource" data-toggle="modal" onclick="outsource(this)"> Outsource </a></li>';
                                    act_btn += '<li><a class="btn btn-danger cls_btnAmbil" href="javascript:;" data-target="#idDivAmbilProduk" id="id_btnModalAmbil" data-toggle="modal" onclick="ambil(this)"> Ambil </a></li>';
                                    act_btn += '<li><a class="btn btn-success" href="javascript:;"> Cetak</a></li>';
                                    act_btn += '</ul></div>';
                                    return act_btn
                                }

                            }
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
            $.post("<?php echo site_url('transaksi/trans_po/getCMDetail'); ?>",
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
            $.post("<?php echo site_url('/transaksi/trans_po/cetakStruk'); ?>",
                    {
                        'idMaster': idMaster,
                        'tglTrans': tglTrans,
                        'tglSelesai':tglSelesai,
                        'namaCustomer':namaCustomer,
                        'statusBayar':statusBayar,
                        'totalHarga':totalHarga
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
                    $.post("<?php echo site_url('/transaksi/trans_po/simpanOutsource'); ?>",
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

                    $.post("<?php echo site_url('/transaksi/trans_po/simpanOutsourceMsk'); ?>",
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

                $.post("<?php echo site_url('/transaksi/trans_po/simpanAmbil'); ?>",
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

                    $.post("<?php echo site_url('/transaksi/trans_po/simpanFinish'); ?>",
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