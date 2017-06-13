<div class="col-sm-9 col-md-10 main">
<h2 class="alert alert-info" align="center" style="padding-bottom:15px;">Selamat Datang di Toko Buku ABC</h2>
<div class="col-sm-4 col-md-5">
	<img draggable="false" class="img-responsive img-thumbnail" src="<?php echo base_url('assets/img/abc_bookshop.PNG');?>">
</div>
<div class="col-sm-8 col-md-7">
    <table class="table table-striped table-bordered table-hover">
     <thead>
     	<tr>
     		<td colspan="2" class="bg-primary  text-uppercase" style="text-align: center;">Notifikasi</td>
     	</tr>
     </thead>
     <tbody>
     	<?php
     	if(empty($stokbuku)){
     		?>
     		<tr>
     			<td><span class="fa fa-check"> Tidak ada notifikasi</span></td>
     		</tr>
     		<?php
     	}else{
     		?>
     		<tr>
     		<td class="btn-warning">Buku</td>
     		<td class="btn-warning text-center">Status</td>
     		</tr>
     		<?php
     	foreach ($stokbuku as $sb) {
     	?>
	     	<tr>
	     		<td><?=$sb->judul?></td>
	     		<td class="text-center">Sisa <?=$sb->stock?></td>
	     	</tr>
     	<?php
     	}
     	}
     	?>
     </tbody>		
	</table>
			<!--pesan notifikasi setiap user jika stok menipis-->
			<?php
			if(! empty($stokbuku)){
            	if($this->session->userdata('level') == '1'){ ?>
      				<div class="alert alert-info"><button type="button" class="close" onclick="location.reload()" data-dismiss="alert" aria-hidden="true">&times;</button>Stock buku menipis, silahkan Kontak Penerbit untuk re-stock buku</div>
            	<?php 
        		}else{
        		?>
            		<div class="alert-info alert"><button type="button" class="close" onclick="location.reload()" data-dismiss="alert" aria-hidden="true">&times;</button>Stock buku menipis, silahkan Kontak Administrator untuk memperbarui dan memesan stock buku</div>
        		<?php
        		}
        	}else{
        	?>
        	<div class="alert-info alert"><button type="button" class="close" onclick="location.reload()" data-dismiss="alert" aria-hidden="true">&times;</button>Stock buku aman terkendali</div>
        	<?php
        	}
        	?>
</div>
</div>