// En este documento está lo necesario para ver el detalle del ticket seleccionado (historia de usuario)
function init(){

}

$(document).ready(function() {
    var usu_id = $('#usu_idx').val();

  

    if($('#rol_idx').val() == 1){

        $.post("/PERSONAL_HelpDesk/controller/usuario.php?op=total", { usu_id:usu_id }, function(data){
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
        });
        
        $.post("/PERSONAL_HelpDesk/controller/usuario.php?op=totalabierto", { usu_id:usu_id }, function(data){
            data = JSON.parse(data);
            $('#lbltotalabierto').html(data.TOTAL);
        });
    
        $.post("/PERSONAL_HelpDesk/controller/usuario.php?op=totalcerrado", { usu_id:usu_id }, function(data){
            data = JSON.parse(data);
            $('#lbltotalcerrado').html(data.TOTAL);
        });


        //Comienza prueba de sustitución de gráfica del usuario común
        
        $.post("/PERSONAL_HelpDesk/controller/usuario.php?op=totalhardware", { usu_id:usu_id }, function(data){
            data = JSON.parse(data);
            $('#lbltotalhardware').html(data.TOTAL);
        });

        $.post("/PERSONAL_HelpDesk/controller/usuario.php?op=totalsoftware", { usu_id:usu_id }, function(data){
            data = JSON.parse(data);
            $('#lbltotalsoftware').html(data.TOTAL);
        });
        
        $.post("/PERSONAL_HelpDesk/controller/usuario.php?op=totalincidencia", { usu_id:usu_id }, function(data){
            data = JSON.parse(data);
            $('#lbltotalincidencia').html(data.TOTAL);
        });

        $.post("/PERSONAL_HelpDesk/controller/usuario.php?op=totalservicio", { usu_id:usu_id }, function(data){
            data = JSON.parse(data);
            $('#lbltotalservicio').html(data.TOTAL);
        });

         //Termian prueba de sustitución de gráfica  del usuario común

    }else{

        $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=total", function(data){
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
        });
        
        $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=totalabierto", function(data){
            data = JSON.parse(data);
            $('#lbltotalabierto').html(data.TOTAL);
        });
    
        $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=totalcerrado", function(data){
            data = JSON.parse(data);
            $('#lbltotalcerrado').html(data.TOTAL);
        });

        //Comienza prueba de sustitución de gráfica el usuario de soporte
        $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=totalhardware", function(data){
            data = JSON.parse(data);
            $('#lbltotalhardware').html(data.TOTAL);
        });

        $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=totalsoftware", function(data){
            data = JSON.parse(data);
            $('#lbltotalsoftware').html(data.TOTAL);
        });

        $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=totalincidencia", function(data){
            data = JSON.parse(data);
            $('#lbltotalincidencia').html(data.TOTAL);
        });

        $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=totalservicio", function(data){
            data = JSON.parse(data);
            $('#lbltotalservicio').html(data.TOTAL);
        });

         //Termian prueba de sustitución de gráfica el usuario de soporte


    }

   

});

init();