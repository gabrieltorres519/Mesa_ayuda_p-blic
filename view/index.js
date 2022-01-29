
function init(){
      
}


$(document).ready(function() {

});


$(document).on("click","#btnsoporte",function() {
    if($('#rol_id').val()=='1'){
        $('#lbltitulo').html("Acceso Soporte");
        $('#btnsoporte').html("Acceso Usuario");
        $('#rol_id').val(2);
        $('#imgtipo').attr("src","/PERSONAL_HelpDesk/public/2.jpg"); // se muestra el avatar de soporte al dar click soporte 
    }else{
        $('#lbltitulo').html("Acceso Usuario");
        $('#btnsoporte').html("Acceso Soporte");
        $('#rol_id').val(1);
        $('#imgtipo').attr("src","/PERSONAL_HelpDesk/public/1.jpg"); // 
    }

});



init();