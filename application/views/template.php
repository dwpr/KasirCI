<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title;?> - Toko Buku ABC</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 50px;
      }
    </style>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url();?>assets/anoth_css/style.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/anoth_css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/anoth_css/editor.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/anoth_css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/anoth_css/jquery-ui.min.css') ?>" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Toko Buku ABC</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <div class="btn-group navbar-form pull-right">
                  <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                  <b><?=$this->session->userdata('nama')?></b>
                  <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <!--<li><a href="<?=base_URL()?>atur/profil">Edit Profil</a></li>-->
                    <li><a href="<?=base_URL()?>atur/logout">Logout</a></li>
                  </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar bg_side">
                <ul class="nav nav-sidebar">
                    <li class="nav-header menu_side">Menu</li>
                    <?php
        $l_val  = array("", "buku","transaksi","kasir");
          if(! empty($stokbuku)){
            $peringatan = "<blink><span class='fa fa-lg fa-spin fa-fw fa-info-circle pull-right'></span></blink>"; //print simbol info peringatan
          }else{
            $peringatan = "";//null object atau spasi biar tidak error karena tidak ada peringatan
          }
        $l_view = array("<span class='glyphicon glyphicon-home'> Beranda</span>", "<span class='glyphicon glyphicon-lock'> Inventori Buku</span>", "<span class='fa fa-dollar' style='margin-right:15px;'></span> Transaksi","<span class='glyphicon glyphicon-shopping-cart'> Kasir</span>");

        for ($i = 0; $i < sizeof($l_val); $i++) {
          if ($this->uri->segment(2) == $l_val[$i]) {
            echo "<li class='active menu_side aktif'><a href='".base_URL()."atur/".$l_val[$i]."'>".$l_view[$i]."</a></li>";
          } else {
            echo "<li class='menu_side'><a href='".base_URL()."atur/".$l_val[$i]."'>".$l_view[$i]."</a></li>";
          }
        }

      ?>
                </ul>
            </div>

<!-- section content -->
      <div id="content">
      <?php 
        $this->load->view($content);
      ?>
      </div>
<!-- end of section content -->

            </div>
      <footer>
      <hr>
        Loaded in : {elapsed_time}. &copy;
        <br>
        Build and Design by <a href="mailto:#">Me</a>
      </footer>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/editor.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.flexslider.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.tabletojson.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jsrpl.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="<?php echo base_url(); ?>assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
