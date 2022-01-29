// En este documento está lo necesario para ver el detalle del ticket seleccionado (historia de usuario)
function init(){

}

$(document).ready(function() {
    var tick_id = getUrlParameter('ID');

    listardetalle(tick_id); 

    $('#tickd_descrip').summernote({
        height:480,
        callbacks: {
            onImageUpload: function(image){
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function(r){
                console.log("Text detect...");
            }
        },
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $('#tickd_descripusu').summernote({
        height:480,
    });

    $('#tickd_descripusu').summernote('disable');

    tabla=$('#documentos_data').dataTable({
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
            url: '../../controller/documento.php?op=listar',
            type : "post",
            data : {tick_id:tick_id},
            dataType : "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }).DataTable();

    
});

  function listardetalle(tick_id){
      $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=listardetalle", { tick_id : tick_id }, function (data) {
          $('#lbldetalle').html(data);
      }); 

      $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=mostrar", { tick_id : tick_id }, function (data) {
          data = JSON.parse(data);
          $('#lblestado').html(data.tick_estado);
          $('#lblnomusuario').html(data.usu_nom +' '+data.usu_ape);
          $('#lblfechcrea').html(data.fech_crea);
        
          $('#lblnomidticket').html("Detalle Ticket - "+data.tick_id);

          $('#cat_nom').val(data.cat_nom);
          $('#tick_titulo').val(data.tick_titulo);
          $('#tickd_descripusu').summernote ('code',data.tick_descrip);

         console.log( data.tick_estado_texto);
         if (data.tick_estado_texto == "Cerrado"){
             $('#pnldetalle').hide();
         }
     }); 
 }

var getUrlParameter = function getUrlParameter(sParam){  // Función para capturar el id del ticket clickeado
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for(i=0; i < sURLVariables.length; i++){
        sParameterName = sURLVariables[i].split('=');

        if(sParameterName[0] === sParam){
                return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }    
}


 //Seccion 13_38_1
  $(document).on("click","#btnenviar", function(){
      var tick_id = getUrlParameter('ID');
      var usu_id = $('#usu_idx').val();
      var tickd_descrip = $('#tickd_descrip').val();

      if ( $('#tickd_descrip').summernote('isEmpty') ){

        swal("Advertencia!", "Contenido vacio", "warning");

      }else{

        $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=insertdetalle", { tick_id : tick_id, usu_id:usu_id, tickd_descrip:tickd_descrip }, function(data){
            listardetalle(tick_id);
            $('#tickd_descrip').summernote('reset');
           // swal("Correcto!", "Registrado correctamente: ", "success");   
          });
      }
  
 
 });
 //Final Seccion 13_38_1
 
 //Seccion 13_38_2
    $(document).on("click","#btncerrarticket", function(){
        console.log("TEST_btncerrarticket");
        
        swal({
            title: "Está seguro de cerrar el ticket?",
            text: "Este ticket no podrá ser reabierto!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: false,
            //closeOnCancel: false //para que se cierre el alert si se cancela
        },

        function(isConfirm) {
            if (isConfirm) {

                var tick_id = getUrlParameter('ID');
                var usu_id = $('#usu_idx').val();
 
                $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=update", { tick_id : tick_id , usu_id : usu_id}, function(data){
                    
                });

  
                
                    console.log(tick_id);
                      $.post("/PERSONAL_HelpDesk/SendEmail/sendEmail_3.php", { tick_id : tick_id}, function(data){
                         
                     });
                     
                 
           
                //Termina Obteniendo id del ticket que se cierra


                listardetalle(tick_id);


                swal({
                    title: "Ticket!",
                    text: "Ticket cerrado correctamente",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            } else {
             
                //Si se cancela no hace nada
            }
        });
  
     });
 //Final Seccion 13_38_2


 //Sección 13_38_3
function ListarDetalle(){
    //Sección 13_38_5 se pegó aquí la llamada a listar detalle del controller
    $.post("/PERSONAL_HelpDesk/controller/ticket.php?op=listardetalle", { tick_id : tick_id }, function(data){
        $('#lbldetalle').html(data);
    });
}


init();