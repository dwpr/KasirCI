<div class="col-sm-9 col-md-10 main">
      <legend>Pembelian Buku</legend>
      <!--
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
                -->
      <div>
          <!--<a style="margin-bottom: 15px;" class="btn btn-default" href="#modalbeli" data-toggle="modal"><i class="glyphicon glyphicon-plus-sign"></i> Beli</a>-->

            <div class="form-group">
            <form id="formbeli" action="">
              <label>Kode Buku</label>
              <input style="width: 40%;" name="bookcode" id="bookcode" type="text" class="form-control" autocomplete="off" placeholder="Kode Buku" autofocus="autofocus" required>
              <label>Jumlah Beli</label>
              <input style="width: 40%;" name="quantity" id="quantity" type="text" class="form-control" autocomplete="off" placeholder="Jumlah Beli Buku" autofocus="autofocus">
            <button id="beli" class="btn btn-primary">Beli</button>
            </div>
        </form>
                <?php echo $this->session->flashdata("pesan");?>
                
                <?="<pre>". print_r((array)$this->session, true) ."</pre>"?>
                
                
      </div>
      <div class="panel panel-default" style="margin-top: 10px;">
                            <div class="panel-heading">
                                Daftar Buku yang ada dibeli oleh konsumen
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                <!--if--> 
                                    <table class="table table-striped table-bordered table-hover" id="tabel_transaksi">
                                        <thead>
                                            <tr>
                                                <th width="10%">Kode Buku</th>
                                                <th width="35%">Judul</th>
                                                <th width="15%">Harga Satuan</th>
                                                <th>Jumlah</th>
                                                <th width="15%">Harga Bayar</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tampilgan">
                                            <?php
                                            if(empty($this->cart->contents())){ //jika tidak ada content
                                            ?>
                                            <tr>
                                            <td colspan="6">Belum ada barang yang dibeli</td>
                                            </tr>
                                            <?php
                                            }else{
                                                foreach ($this->cart->contents() as $items){ ?>
                                                <tr>
                                                    <td><?= $items['id'] ?></td>     
                                                    <td><?= $items['name'] ?></td> 
                                                    <td><?= uangRP($items['price']) ?></td>
                                                    <td><?= $items['qty'] ?></td>
                                                    <td><?= uangRP($total = $items['price']*$items['qty']) ?></td>
                                                    <td width="100%" class="btn btn-danger" onClick='delete_row("<?= $items['rowid'] ?>")'>Hapus</td>            
                                                </tr>
                                            <?php
                                                }
                                            }
                                            if($this->cart->total_items()==''){
                                                //nothing to show gan karena tidak ada item, total item null / empty / kosong
                                            }else{
                                            ?> 
                                                <tr>
                                                <td colspan="3"><b>TOTAL</b></td>
                                                <td><?=$this->cart->total_items()?></td>
                                                <td id="belinya"><?=uangRP($this->cart->total())?></td>
                                                <td class="belinya2 hidden"><?=$this->cart->total()?></td>
                                                <td width="100%" class="btn btn-danger" onclick="deleteAll()">Hapus Semua</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>

        <p style="padding:10px;" id="uve"></p>
      <div class="input-group ig" style="width:35%">
                <input id="bayaruang" style="border-radius: 0px;" type="text" name="bayaruang" placeholder="Nominal pembayaran" autofocus required class="form-control">
                <button style="border-radius: 0px;position: absolute;" id="checkoutgan" class="btn btn-primary disabled" name="checkout">Checkout</button>
      </div>
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
 <script src="<?php echo base_url(); ?>assets/js/jquery.autocomplete.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.tabletojson.min.js"></script>
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
    function convertToRupiah(angka){
        var rupiah = '';    
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) 
          if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return rupiah.split('',rupiah.length-1).reverse().join('');
    }

    function cekvalidtidak(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('atur/cekvalid');?>",
            data: "name="+$("#bayaruang").val(),//ambil name dari id
            success: function(msg){
                if(msg=="true")
                {
                    $("#uve").html(<?php echo validation_errors('<p class="error">'); ?>);
                }
                else
                {
                    $("#uve").html(<?php echo validation_errors('<p class="error">'); ?>);
                }
            }
        });
    }
 </script>

 <script type="text/javascript">
    $(document).ready(function(){
    $('#bayaruang').keyup(function(){
        //cekvalidtidak();
        var value = $(this).val();
        var nomin = $('.belinya2').html();
        var kembaliuang = value-nomin;
        if(value<nomin){
            if(kembaliuang>0){
            //untuk mengatasi bug tidak menampilkan kembalian jika nominal ditambah 1 digit
            //misal bayar 300 maka status kurang bayar 
            //dan ditambah satu nol lagi jadi 30000, intinya mencegah bug output
            $( "#uve" ).html('Kembalian uang anda <b>Rp. '+convertToRupiah(kembaliuang)+'</b>'); //atau gunakan text (return string)
            $("#uve").addClass('bg-success');
            $("#uve").removeClass('bg-danger bg-info');
            $("#checkoutgan").removeClass('disabled');
            }else{
            $( "#uve" ).html('Maaf uang anda kurang <b>Rp. '+convertToRupiah(Math.abs(kembaliuang))+'</b>');//atau gunakan text (return string) di absolutkan biar tidak negatif
            $("#uve").addClass('bg-danger');
            $("#uve").removeClass('bg-success bg-info');
            $("#checkoutgan").addClass('disabled');
            }            
        }else if(value==nomin){
            $( "#uve" ).text('Uang anda pas'); 
            $("#uve").addClass('bg-info');
            $("#uve").removeClass('bg-danger bg-success');
            $("#checkoutgan").removeClass('disabled');  
        }else{
            if(kembaliuang<1){
            //untuk menghindari angka negative, kenapa ? karena deteksi value hanya pada angka digit pertama. Jika kurang tetap dianggap berhasil dan hasilnya negative. Coba saja hilangkan if else bagian ini (bagian if else di dalam else)
            //intinya untuk mencegah bug output
            $( "#uve" ).html('Maaf uang anda kurang <b>Rp. '+convertToRupiah(Math.abs(kembaliuang))+'</b>');//atau gunakan text (return string) di absolutkan biar tidak negatif
            $("#uve").addClass('bg-danger');
            $("#uve").removeClass('bg-success bg-info');
            $("#checkoutgan").addClass('disabled');
            }else{
            $( "#uve" ).html('Kembalian uang anda <b>Rp. '+convertToRupiah(kembaliuang)+'</b>'); //atau gunakan text (return string)
            $("#uve").addClass('bg-success');
            $("#uve").removeClass('bg-danger bg-info');
            $("#checkoutgan").removeClass('disabled'); 
            }
        }
    });
    })
 </script>

<script type="text/javascript">
    $('#checkoutgan').click(function() {
      //$('#modalkasir').modal('show'); // show bootstrap modal furthur feature
      cekout();  
    });

    function openInNewTab() {
        var url = "<?php echo base_URL('atur/doprint')?>";
        $("<a>").attr("href", url).attr("target", "_blank")[0].click();
    }

    function cekout(){
        var operator = "<?=$this->session->userdata('nama')?>";
        var uang = $('#bayaruang').val();
        var datadaritabel = $('#tabel_transaksi').tableToJSON({
                                ignoreColumns: [5,4,2,1],
                                ignoreEmptyRows: true,
                            });    /*
    $.post('<?=base_URL('atur/addtransaksi')?>'+'?operator='+operator, function(data) {
                deleteAll();
                location.reload();
    });*/

        $.ajax({
            url : "<?php echo base_URL('atur/addtransaksi')?>",
            //type: "post", //this not type method, if use type method please use in method
            //method: "POST",
            //data : +datadaritabel
            data: "operator="+operator+"&uang="+uang,
            dataType: "text",
            success: function(data){
                openInNewTab();
                //deleteAll(); saya pindah di controller
                location.reload();
            }
        });
    }
</script>

 <script type="text/javascript">
    $('#uangbayar').keyup(function() {
        var uangk = $('#uangbayar').val();
        var uangb = $('#totalbayar').val();
        var kembali = uangb-uangk;
        if(uangk<uangb){
            $('#keterangan').html('Maaf uang anda kurang gan');
            $('#cnp').addClass('disabled');
        }else if(uangk=uangb){
            $('#keterangan').html('Uang anda pas gan');
        }else{
            $('#keterangan').html('Kembaliannya <b>'+kembali+'</b>');
        }
    });
 </script>

 <script type="text/javascript">
 /*
 var qt = $('#quantity').val();
 var bk = $('#bookcode').val();
 if(qt||bk == ''){
    $('#beli').addClass("disabled");
 }else{
    $('#beli').removeClass( "disabled" );
 }*/
    $('#beli').click(function() {
        beli();
    });
 </script>

<script type="text/javascript">
    function beli(){
        $.ajax({
            url : "<?php echo base_URL('atur/keranjang')?>",
            type: "POST",
            dataType: "JSON",
            data: $('#formbeli').serialize(),
            success: function(data){
                //$('#beli').addClass("disabled");
                location.reload();
                //tampil(); //opsional tampilan tapi masih ngebug
            }
        });
    }

    function tampil(){
        $.ajax({
            url : "<?php echo base_URL('atur/daftarkeranjang')?>",
            success: function(data){
                $('#tampilgan').html(html);
                //$("#tampilgan").html(data);
            }
        });
    }

    function delete_row(id){
    $.get('<?=base_URL('atur/deleteCart/')?>'+id, function(data) {
        location.reload();
    });
    }

    function deleteAll(){
    $.get('<?=base_URL('atur/deleteAllCart/')?>', function(data) {
        location.reload();
    });
    }
</script>