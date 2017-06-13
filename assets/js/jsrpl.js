/*
  $("#keranjang").click(function(){
    loadbeli();
  });


$("#kdbk").keyup(function(){
  loaddatabuku();
});

function loaddatabuku(){
  var kdbk = $('#kdbk').val();
  $.ajax({
    url: "databuku",
    data:"kdbook="+kdbk,
    success: function(html){
         $('#tampilbukugan').html(html);
       }
  });
}
*/
/*
$("#beligan").click(function(){
  loadbeli();
});

function loadbeli(){
  var jml = $('#quantity').val();
  var kdbk = $('#bookcode').val();
  $.ajax({
    url: "keranjang",
    data:"kdbuku"+kdbk+"&jumlah"+jml,
    success: function(html){
         $('#tampilgan').html(html);
    },
    error: function (jqXHR, textStatus, errorThrown){
         alert('Error adding / update data');
    }
  });

}
*/
/*
function loadbeli(){
    var jml = $('#jml').val();
    var kdbk = $('#kdbk').val();
  $.ajax({
    url: "keranjang",
    type:"POST",
    data:"kdbuku"+kdbk+"&jumlah"+jml,
            //data: $('#form').serialize(),
            //dataType: "JSON",
            success: function(data)
            {
               $('#modalbeli').modal('hide');
              location.reload();//reload page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
       });
}*/