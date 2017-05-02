
$(document).ready(function(){
    $("#vm").Editor();//inisialisasi wysiwygnya bagian perusahaan vismissejarah
    $("button:submit").click(function(){
        $('.vmedit').text($('#vm').Editor("getText"));
    });
    var isi = $('.vmedit').val();//manipulation data from textarea 
    $("#vm").Editor("setText",isi); //ambil text dari db ke wysiwyg
});