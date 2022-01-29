 $(document).on("click","#btnactualizar", function(){
    var pass = $(txtpass).val();
    var newpass = $(txtpassnew).val();

    if(pass.length == 0 || newpass.length == 0){
        swal("Error!", "Campos vacios ", "error");
    }else{
        if(pass==newpass){


            var usu_id = $('#usu_idx').val();
            $.post("/PERSONAL_HelpDesk/controller/usuario.php?op=password",{usu_id:usu_id,usu_pass:newpass},function(data){ 
                swal("Correcto!", "Actualizado correctamente", "success");
            });
        }else{
            swal("Error!", "Campos vacios ", "error");
        }
    }


 });