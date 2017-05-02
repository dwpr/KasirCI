<div class="col-sm-9 col-md-10 main">
      <legend>Pembelian Buku</legend>
                <div class="modal fade pg-show-modal" id="modalbeli" tabindex="-1" role="dialog" aria-hidden="true"> 
                    <div class="modal-dialog"> 
                        <div class="modal-content"> 
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Produk yang mau dibeli</h4> 
                            </div>
                            <div class="modal-body" id="tampil buku">
                                <form action="#" id="form">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Jumlah Beli</td>
                                            <td> <input style="width: 50%;" placeholder="Jumlah Beli Buku" name="jumlahbukugan" id="jml" type="text" class="form-control" autofocus required></td>
                                        </tr>     
                                        <tr>
                                            <td>Kode Buku</td>
                                            <td> <input style="width: 50%;" placeholder="Kode Buku" name="kodebukugan" id="kdbk" type="text" class="form-control" autofocus required></td>
                                        </tr>
                                        <tr id="tampilbukugan">
                                        </tr>                                        
                                    </tbody>
                                </table>
                                </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" onclick="loadbeligan()" data-dismiss="modal" id="keranjang">OK</button>
                            </div>
                        </div>         
                    </div>     
                </div>
      <div>
          <!--<a style="margin-bottom: 15px;" class="btn btn-default" href="#modalbeli" data-toggle="modal"><i class="glyphicon glyphicon-plus-sign"></i> Beli</a>-->

        <form id="form" action="<?=base_URL('atur/keranjang2');?>">
            <div class="form-group">
              <label>Jumlah Beli</label>
              <input style="width: 40%;" name="quantity" id="quantity" type="text" class="form-control" autocomplete="off" placeholder="Jumlah Beli Buku" autofocus="autofocus">
              <label>Kode Buku</label>
              <input style="width: 40%;" name="bookcode" id="bookcode" type="text" class="form-control" autocomplete="off" placeholder="Kode Buku" autofocus="autofocus">
            </div>

          <button name="loadbeli" type="submit" class="btn btn-primary">Beli</button>
        <!-- Masih Error gan 
          <button name="loadbeli" type="submit" onclick="loadbeli()" class="btn btn-primary">Beli</button>
          -->
        </form>
      </div>
      <div class="panel panel-default" style="margin-top: 10px;">
                            <div class="panel-heading">
                                Daftar Buku yang ada dibeli oleh konsumen
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                <!--if--> 
                                    <table class="table table-striped table-bordered table-hover" >
                                        <thead>
                                            <tr>
                                                <th width="10%">Kode Buku</th>
                                                <th width="35%">Judul</th>
                                                <th width="10%">Jumlah</th>
                                                <th width="15%">Harga Satuan</th>
                                                <th width="15%">Harga Bayar</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tampilgan">
                                        <?php
                                            foreach ($this->cart->contents() as $items){
                                        ?>
                                                <tr>
                                                    <td><?php echo $items['kodebuku'];?></td>  
                                                    <td><?php echo $items['judul'];?></td> 
                                                    <td><?php echo $items['qty'];?></td>
                                                    <td><?php echo $items['harga'];?></td>
                                                    <td>Totalnya</td>";
                                                    <td>Hapus</td>";          
                                                </tr>;
                                        <?php
                                            }
                                        ?>
                                        <!--
                                            <?php
                                            foreach ($beli as $b) {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $b->kdbuku;?></td>
                                                <td><?php echo $b->judul;?></td>
                                                <td><?php echo $b->pengarang;?></td>
                                                <td><?php echo UangRP($b->harga);?></td>
                                                <td><?php echo UangRP($b->bayar);?></td>
                                                <td>Hapus</td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        -->
                                        </tbody>
                                    </table>
                                    <button style="float: right;" class="btn btn-primary" name="checkout">Checkout and Print</button>
                                </div>
                            </div>
                            </div>
</div>
 <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/jquery.autocomplete.js"></script>
 <script type="text/javascript">
    var availableTags = [
      <?php foreach ($cari as $row): ?>
        "<?= $row->kdbuku ?>",
      <?php endforeach ?>
    ];
    $("#bookcode").autocomplete({
      source: availableTags
    });
 </script>

<script type="text/javascript">

function loadbeli(){
    var id = $("#bookcode").val('');
    var qty = $("#quantity").val('');
/*    $.get(<?php echo base_URL('/atur/keranjang/')?>+id, function() {
        tampil();
    });
*/
    $.ajax({
        url : "<?php echo base_URL('atur/keranjang')?>/"+id+'&'+qty,
        success: function(data){
            tampil();
        }
    });
}

function tampil(){
  /*$.get(<?php echo base_URL('/atur/daftarkeranjang')?>, function(data) {
            $("#tampilgan").html(data);
  });*/
  $.ajax({
        url : "<?php echo base_URL('atur/daftarkeranjang')?>",
        success: function(data){
            $("#tampilgan").html(data);
        }
    });
}
</script>