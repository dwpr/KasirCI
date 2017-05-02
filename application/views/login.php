<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login POS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 400px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .ig {
        margin: 15px;
      }
      .img{
        width: 120px;
        max-width: 130px;
      }

    </style>
    <link href="<?=base_URL()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


  </head>
  <body>

    <div class="container">
    <h2>
      <form class="form-signin" action="<?php echo base_URL()?>atur/proseslogin" method="POST">
      <center><img draggable="false" src="<?php echo base_url('assets/img/abc_bookshop.PNG');?>" class="img-responsive img"></center>
      <?php echo $this->session->flashdata("k"); ?>
      <div class="input-group ig">
                <input type="text" name="username" required="" placeholder="Username" autofocus class="form-control">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
      </div>
      <div class="input-group ig">
                  <input type="password" name="password" placeholder="Password" required="" class="form-control">
                  <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
      </div>
        <center><button class="btn btn-large btn-primary" type="submit">LOGIN</button></center>
      </form>

    </div> <!-- /container -->

      <hr>
      <p align="center">Point Of Sales <a style="text-decoration:none" href="<?php echo base_url();?>">Toko Buku ABC</a></p>

  </body>
</html>