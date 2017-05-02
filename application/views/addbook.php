<div class="col-sm-9 col-md-10 main">
      <legend>Buku</legend>
      <!--<a href="#modalbuku" data-toggle="modal" style="margin: 5px;" class="btn btn-primary">Tambah Buku</a>-->   
    <?php 
    if($this->session->userdata('level') == '1'){ ?>
      <button style="margin-bottom: 10px;" class="btn btn-primary" onclick="tambah()">Tambah Buku</button>
    <?php } ?>
      <div class="panel panel-default">
                            <div class="panel-heading">
                                Daftar Buku yang ada di toko
                            </div>
                <?php echo $this->session->flashdata("k");?>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="tabelbuku">
                                        <thead>
                                            <tr>
                                                <th>Kode Buku</th>
                                                <th>Judul</th>
                                                <th>Pengarang</th>
                                                <th>Harga</th>
                                                <th>Stock</th>
                                                <?php 
                                                if($this->session->userdata('level') == '1'){ ?>                                     
                                                <th>Action</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($buku as $b) {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $b->kdbuku;?></td>
                                                <td><?php echo $b->judul;?></td>
                                                <td><?php echo $b->pengarang;?></td>
                                                <td><?php echo UangRP($b->harga);?></td>
                                                <td><?php echo $b->stock;?></td>
                                                <?php 
                                                if($this->session->userdata('level') == '1'){ ?> 
                                                <td>
                                                    <button class="btn btn-warning" onclick="editbuku(<?php echo $b->kdbuku;?>)">Edit</button> <a class="btn btn-danger" onclick="return confirm('Anda YAKIN menghapus data buku dengan judul \n <?=$b->judul?> ... ?');" href="<?php echo base_URL('atur/buku/delete/'.$b->kdbuku) ;?>">Delete</a>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $('#tabelbuku').DataTable({
                responsive: true
    });//datatable view
</script>
<script type="text/javascript">
    var tipe; //untuk menyimpan string

function tambah(){
      tipe = 'tambah';
      $('#form')[0].reset(); // reset form on modals
      $('#modalbuku').modal('show'); // show bootstrap modal
}

//graber data buku dengan ajax untuk modal
function editbuku(id){
    tipe = 'edit';
      $('#form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_URL('atur/buku/getbukubyid')?>/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('[name="kdbuku"]').val(data.kdbuku);
            $('[name="judul"]').val(data.judul);
            $('[name="pengarang"]').val(data.pengarang);
            $('[name="harga"]').val(data.harga);
            $('[name="stock"]').val(data.stock);
            $('[name="idedit"]').val(data.kdbuku);

            $('#modalbuku').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Buku'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

//save from modal untuk database dengan pilihan tambah atau edit
function save(){
      var url;
      if(tipe == 'tambah'){
          url = "<?php echo base_URL('atur/buku/tambah')?>";
      }else{
        url = "<?php echo base_URL('atur/buku/edit')?>";
      }
      // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modalbuku').modal('hide');
              location.reload();// for reload a page
            }/*,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }*/
        });
}

</script>

                <div class="modal fade pg-show-modal" id="modalbuku" tabindex="-1" role="dialog" aria-hidden="true"> 
                    <div class="modal-dialog"> 
                        <div class="modal-content"> 
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Tambah Buku</h4> 
                            </div>
                            <div class="modal-body" id="tampil buku">
                                <!--<form action="<?=base_URL()?>atur/buku/tambah" id="form" method="POST" enctype="multipart/form-data">-->
                                <form id="form" action="#" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Kode Buku</label>
                                        <input name="kdbuku" type="text" class="form-control" autofocus="autofocus" required>
                                        <label>Judul Buku</label>
                                        <input name="judul" type="text" class="form-control" required>
                                        <label>Pengarang Buku</label>
                                        <input name="pengarang" type="text" class="form-control" required>
                                        <label>Harga Barang (dalam angka, contoh 50000)</label>
                                        <input name="harga" type="text" class="form-control" required>
                                        <label>Stock</label>
                                        <input name="stock" type="text" class="form-control" required>
                                        <input type="hidden" name="idedit">
                                    </div>
                                    <button name="simpan" type="submit" onclick="save()" class="btn btn-primary">Simpan</button> <!--| <button type="reset" class="btn btn-danger">Reset</button>-->
                                </form>
                            </div>
                        </div>         
                    </div>     
                </div>
</div>