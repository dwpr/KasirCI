//on document ready hampir sama dengan onlad
//for berita posting
$(document).ready(function(){
    $('#isiberita').Editor();//inisialisasi wysiwyg bagian posting berita
    $("button:submit").click(function(){
        $('.isi').text($('#isiberita').Editor("getText"));
    });
});

//for berita edit
$(document).ready(function(){
    $('#isiberita2').Editor();//inisialisasi wysiwyg bagian edit berita
    $("input:submit").click(function(){//button type button biar beda
        $('.isii2').text($('#isiberita2').Editor("getText"));
    });
    var is = $('.isii2').val();
    $('#isiberita2').Editor("setText",is);
});

/* tidak jadi karena instalasinya susah, tapi pluginnya keren :)
//for image magnify
$(document).ready(function(){
   $('button').magnificPopup({
    tClose: 'Close (Esc)',
    tLoading: 'Loading...',
    src: '#syu',
    items: {
      //src: '<div class="syu">Zoom</div>',
      type: 'inline'
    }
    //image:{
      //titleSrc: '<?php echo ',
      //tError: 'Gambar tidak dapat dimuat, silahkan reload'
    //}
   });
});
*/

//onload document
$(window).load(function(){
                  //slider utama
                  $('.flexslider').flexslider({
                          animation: "slide",
                                  start: function(slider){
                                }
                  });
                //small slider for photo
                  $('.flexs').flexslider({
                    animation: "slide",
                    animationLoop: true,
                    itemWidth: 180,
                    itemMargin: 5
                  });
      $('#tampilmapchange').hide();//hiden map onload

//bagian berita
    $('#tabelbuku').DataTable({
                responsive: true
        });//datatable view
});

//menu floating
$(document).scroll(function () {
  		//var scroll = $(window).scrollTop+90;
        var y = $(this).scrollTop();
        var tinggi1 = $('.bg-header').outerHeight();
        var tinggi2 = $('.sm-nav').outerHeight();
        var tinggi = tinggi1+tinggi2;
        if (y >tinggi) {
            $('.nav-bg').addClass( "navbar-fixed-top" );

        } else {
            $('.nav-bg').removeClass("navbar-fixed-top");          
        }

    });

//date and time
$(function(){
	var dat = new Date();
  	//$('.dntt').html(dat.toDateString());
  	var day = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    var hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu"];
  	var mon = ["January", "February","March","April","May","June","July","August","September","October","November","December"];
  	var bulan = ["Januari","FEbruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
    $('.dntt').html(hari[dat.getDay()]+", "+dat.getDate()+" "+bulan[dat.getMonth()]+" "+dat.getFullYear());
});

//loader select lokasi
  $(document.body).on('change',"#pilihlokasi",function(){
    loadlokasi();
    loadmap();
    //alert("Hello\nHow are you?"); buat uji coba saja kok :)s
  });


function loadlokasi(){
    var id = $('#pilihlokasi').val();
  $.ajax({
    //url: <?=base_URL();?>"lokasi/tampil",
    url: "lokasi/tampil",
    data:"idlokasi="+id,
    success: function(html){
         $('#tampillokasi').html(html);
       }
       });
}

function loadmap(){
  var id = $('#pilihlokasi').val();
  $.ajax({
    //url: <?=base_URL();?>"lokasi/tampil",
    url: "lokasi/tampilmaps",
    data:"idlokasi="+id,
    success: function(html){
      if(id==0){
        $('#tampilmapchange').hide();
        $('#tampilmap').show();
      }else{
        $('#tampilmapchange').show();
        $('#tampilmapchange').html(html);
        $('#tampilmap').hide();

      }
    }
});
}