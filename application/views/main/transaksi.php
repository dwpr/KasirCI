<div class="col-sm-9 col-md-10 main">
      <legend>Transaksi Pembelian Buku</legend>
<div>
<!--
<div class="input-group ig" style="width:35%">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                <input id="tanggal" style="border-radius: 0px;" type="text" name="tanggal" class="form-control">
                <button style="border-radius: 0px;position: absolute;" id="checkoutgan" class="btn btn-primary disabled" name="checkout">Cari Data</button>
</div>
-->
      <div class="panel panel-default" style="margin-top: 10px;">
                            <div class="panel-heading">
                                Daftar Transaksi Toko Buku ABC
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                <!--if--> 
                                    <table class="table table-striped table-bordered table-hover" id="tabeltransaksi" >
                                        <thead>
                                            <tr>
                                                <th>Transaksi ID</th>
                                                <th>Tanggal</th>
                                                <th>Pemasukan</th>
                                                <th>Operator</th>
                                                <!--<th>Action</th>-->
                                            </tr>
                                        </thead>
                                        <tbody id="tampilgan">
                                            <?php
                                                foreach ($transaksi as $t){ ?>
                                                <tr>
                                                    <td><?= $t->transaksi_id;?></td>     
                                                    <td><?= $t->tgl;?></td> 
                                                    <td><?= uangRP($t->uang) ?></td>
                                                    <td><?= $t->operator ?></td>
                                                    <!--<td width="100%" class="btn btn-primary" onClick='delete_row("<?= $items['rowid'] ?>")'>Detail</td>  -->          
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>

                <div class="modal fade pg-show-modal" id="modalkasir" tabindex="-1" role="dialog" aria-hidden="true"> 
                    <div class="modal-dialog"> 
                        <div class="modal-content"> 
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Kalkulator Uang</h4> 
                            </div>
                            <div class="modal-body" id="tampil buku">
                                <form id="form" action="#" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Total Buku</label>
                                        <input name="toalbeli" type="text" class="form-control" value="<?=$this->cart->total_items()?>" disabled>
                                        <label>Total Bayar</label>
                                        <input name="totalbayar" type="text" class="form-control" value="<?=$this->cart->total()?>" disabled>
                                        <label>Konsumen Bayar</label>
                                        <input id="uangbayar" name="uang" type="text" class="form-control" autofocus="autofocus" placeholder="Uang Konsumen" required>
                                        <div id="keterangan"></div>
                                    </div>
                                    <button id="cnp" name="simpan" type="submit" class="btn btn-primary">Checkout and Print</button>
                                </form>
                            </div>
                        </div>         
                    </div>     
                </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $('#tabeltransaksi').DataTable({
                responsive: true
    });//datatable view
</script>
<script type="text/javascript">
        $('#tanggal').datetimepicker(
        'setHoursDisabled',
        'setMinutesDisabled'
        //{
        //    format: 'yyyy-mm-dd'
        //}
        );
</script>