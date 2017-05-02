$(document).ready(function(){
    var ll = $(window).width(); //;ebar layar
        if(ll<768){
            $(".GProduk").elevateZoom({
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 500,
                lensFadeIn: 500,
                lensFadeOut: 500,
                responsive: "true",
                borderSize: 4,
                zoomLens : false,
                zoomWindowOffetx: 15,
                zoomWindowPosition: 6,
                //gallery: 'ZProduk',
                //imageCrossfade: true,
                //galleryActiveClass: 'active',
                cursor: 'pointer'
            });
        }else{
            $(".GProduk").elevateZoom({
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 500,
                lensFadeIn: 500,
                lensFadeOut: 500,
                responsive: "true",
                borderSize: 4,
                zoomLens : false,
                zoomWindowOffetx: 15,
                //gallery: 'ZProduk',
                //imageCrossfade: true,
                //galleryActiveClass: 'active',
                cursor: 'pointer'
            });
        }
            
	/*
            $("#ZProduk").elevateZoom({
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 500,
                lensFadeIn: 500,
                lensFadeOut: 500,
                responsive: "true",
                borderSize: 4,
                zoomLens : false,
                zoomWindowOffetx: 15,
                //gallery: 'ZProduk',
                //imageCrossfade: true,
                //galleryActiveClass: 'active',
                cursor: 'pointer'
            });*/
/*
//masih ngebug gan fancyboxnya :(
		//pass the images to Fancybox
		$("#ZProduk").bind("click", function(e) {  
		  var ez =   $('#ZProduk').data('elevateZoom');	
		  ez.closeAll(); //NEW: This function force hides the lens, tint and window	
			$.fancybox(ez.getGalleryList());
		  return false;
		});
*/
});

//$(document).on('show.bs.modal', '#modal1' ,function(){ 
//$(document.body).on('change',"#pilihlokasi",function(){
$('.GProduk').click(function(){   
  var idp = $(this).attr('data-id');
  //var idp = $('.GProduk').data('id');
  //var idp = $('.GProduk').data().id;
  $.ajax({
    //url: <?=base_URL();?>"lokasi/tampil",
    url: "getproduk",
    data:"idproduk="+idp,
    success: function(html){
         $('#tampilproduk').html(html);
    }
  });
});
$('.KlikProduk').click(function(){   
  var idp = $(this).attr('data-id');
  //var idp = $('.GProduk').data('id');
  //var idp = $('.GProduk').data().id;
  $.ajax({
    //url: <?=base_URL();?>"lokasi/tampil",
    url: "getproduk",
    data:"idproduk="+idp,
    success: function(html){
         $('#tampilproduk').html(html);
    }
  });
});