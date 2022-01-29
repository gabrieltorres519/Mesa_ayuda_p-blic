var tabla;

function init(){
    $("#usuario_form").on("submit",function(e){
        guardaryeditar(e);
    });
}


function guardaryeditar(e){
    e.preventDefault();
	var formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "../../controller/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){    
            console.log(datos);
            $('#usuario_form')[0].reset();
            $("#modalmantenimiento").modal('hide');
            $('#usuario_data').DataTable().ajax.reload();

             swal({
                 title: "HelpDesk!",
                 text: "Completado.",
                 type: "success",
                 confirmButtonClass: "btn-success"
             });
        }
    }); 
}






$(document).ready(function() {

        tabla=$('#usuario_data').dataTable({
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
                url: '../../controller/usuario.php?op=listar',
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

});

function editar(usu_id){
    console.log(usu_id);
    $('#mdltitulo').html('Editar Registro');

    $.post("/PERSONAL_HelpDesk/controller/usuario.php?op=mostrar", { usu_id : usu_id}, function(data){
        data = JSON.parse(data);
        $('#usu_id').val(data.usu_id); 
        $('#usu_nom').val(data.usu_nom);        
        $('#usu_ape').val(data.usu_ape);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_pass').val(data.usu_pass);
        $('#rol_id').val(data.rol_id).trigger('change');
                
    });

    $('#modalmantenimiento').modal('show');
}


function eliminar(usu_id){
    swal({
        title: "Está seguro de eliminar el registro?",
        text: "Se eliminará el usuario!",
        type: "error", // Mediante revisar la documentación de sweetalert resultó que tipo danger no existe y por eso daba errores
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false,
        //closeOnCancel: false //para que se cierre el alert si se cancela
    },

    function(isConfirm) {
        if (isConfirm) {

            // var tick_id = getUrlParameter('ID');
            // var usu_id = $('#usu_idx').val();

             $.post("/PERSONAL_HelpDesk/controller/usuario.php?op=eliminar", { usu_id : usu_id}, function(data){
                
             });

             $('#usuario_data').DataTable().ajax.reload();


            swal({
                title: "HelpDesk!",
                text: "Registro eliminado",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        } else {
         
           
        }
    });
}

$(document).on("click","#btnnuevo", function(){
    $('#mdltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();
    $('#modalmantenimiento').modal('show');
});


init();