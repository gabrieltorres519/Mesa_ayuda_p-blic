var tabla;
var usu_id = $('#usu_idx').val();
var rol_id = $('#rol_idx').val();

//var tick_id = $('#tick_id').val();

function init(){
    $("#ticket_form").on("submit",function(e){
        guardar(e);
    });
}

$(document).ready(function() {

    $.post("/PERSONAL_HelpDesk/controller/usuario.php?op=combo", function(data){
        $('#usu_asig').html(data);
    });

    if(rol_id == 1){
        tabla=$('#ticket_data').dataTable({
            "aProcessing": true,
            "aServerSide": true,
            dom: 'Bfrtip',
            "searching": true,
            lengthChange: false,
            colReorder: true,
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "ajax":{
                url: '../../controller/ticket.php?op=listar_x_usu',
                type: "post",
                dataType: "json",
                data:{ usu_id : usu_id },
                error: function(e){
                    console.log(e.responseText);
                }
            },
            "bDestroy":true,
            "responsive":true,
            "bInfo":true,
            "iDisplayLength":10,
            "autoWidth": false,
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
            }
        }).DataTable();
    }else{
        tabla=$('#ticket_data').dataTable({
            "aProcessing": true,
            "aServerSide": true,
            dom: 'Bfrtip',
            "searching": true,
            lengthChange: false,
            colReorder: true,
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "ajax":{
                url: '../../controller/ticket.php?op=listar',
                type: "post",
                dataType: "json",
                error: function(e){
                    console.log(e.responseText);
                }
            },
            "bDestroy":true,
            "responsive":true,
            "bInfo":true,
            "iDisplayLength":10,
            "autoWidth": false,
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
            }
        }).DataTable();
    }


});

function ver(tick_id){
    console.log(tick_id);
    window.open('http://localhost:80/PERSONAL_HelpDesk/view/DetalleTicket/?ID='+tick_id+'');// Abrir una ventana para el ticket seleccionado cn el botón para ver la historia de usuario

}


function asignar(tick_id){
    $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=mostrar", {tick_id : tick_id}, function(data){
            data = JSON.parse(data);
            $('#tick_id').val(data.tick_id);

            $('#mdltitulo').html('Asignar agente');
            $("#modalasignar").modal('show');
    });

    
}


function guardar(e){
    e.preventDefault();
	var formData = new FormData($("#ticket_form")[0]);
    if(!formData){
        

    }else{
        $.ajax({
            url: "../../controller/ticket.php?op=asignar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos){
                
                 //data = JSON.parse(data);
                // console.log(data[0].tick_id);
                var tick_id = $('#tick_id').val();
                //$.post("/PERSONAL_HelpDesk/SendEmail/sendEmail_4.php", { tick_id : data[0].tick_id}, function(data){
                             
                //});
                $.post("/PERSONAL_HelpDesk/SendEmail/sendEmail_4.php", { tick_id : tick_id}, function(data){
                             
                });

                 
                $("#modalasignar").modal('hide');
                $('#ticket_data').DataTable().ajax.reload();
                swal("Correcto!", "Asignado Correctamente", "success");                
            }
        });
    }
   
}


function CambiarEstado(tick_id){
    swal({
        title: "Está seguro de reabrir el Ticket?",
        text: "Así podrá seguir dando seguimiento",
        type: "warning", // Mediante revisar la documentación de sweetalert resultó que tipo danger no existe y por eso daba errores
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false,
        //closeOnCancel: false //para que se cierre el alert si se cancela
    },

    function(isConfirm) {
        if (isConfirm) {

            // var tick_id = getUrlParameter('ID');
            // var usu_id = $('#usu_idx').val();

              $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=reabrir", { tick_id:tick_id,usu_id : usu_id}, function(data){
                
              });

             $('#ticket_data').DataTable().ajax.reload();


            swal({
                title: "HelpDesk!",
                text: "Ticket reabierto",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        } else {
         
           
        }
    });
    
    console.log(tick_id);

}


init();