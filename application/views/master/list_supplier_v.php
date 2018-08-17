<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">
    table#idTabelPO td:nth-child(4) {
        text-align: right;
    }
    table#idTabelPO td:nth-child(5) {
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

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover text_kanan"
                               id="idTabelSpl">
                            <thead>
                                <tr>
                                    <th>
                                        Id Supplier
                                    </th>
                                    <th>
                                        Nama Supplier
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
        </div>
        <!-- end <div class="portlet green-meadow box"> -->
    </div>
</div>



<!-- END JAVASCRIPTS -->