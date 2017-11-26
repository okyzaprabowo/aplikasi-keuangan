var x = 1;
function cek(){
    $.ajax({
        url: "../asset/cekpesan.php",
        cache: false,
        success: function(msg){
            $(".notifikasi").html(msg);
			 //$("#notifikasi_b").html(msg);
        }
    });
    var waktu = setTimeout("cek()",3000);
}

$(document).ready(function(){
    cek();
});


