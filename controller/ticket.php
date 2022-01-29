<?php

    require_once(realpath(dirname(__FILE__) . "/../config/conexion.php"));
    require_once(realpath(dirname(__FILE__) . "/../models/Ticket.php"));
    $ticket = new Ticket();

    require_once(realpath(dirname(__FILE__) . "/../models/Usuario.php"));
    $usuario = new Usuario();

    require_once(realpath(dirname(__FILE__) . "/../models/Documento.php"));
    $documento = new Documento();

    switch($_GET["op"]){


        case "insert": 
             $datos= $ticket->insert_ticket($_POST["usu_id"],$_POST["cat_id"],$_POST["tick_titulo"],$_POST["tick_descrip"]);
              
              if(is_array($datos)==true and count($datos)>0){
                 foreach($datos as $row){
                     $output["tick_id"] = $row["tick_id"];

                     if($_FILES["files"]["name"]==0){

                     }else{
                         $countfiles = count($_FILES["files"]["name"]);
                         $ruta = "/opt/lampp/htdocs/PERSONAL_HelpDesk/public/document/".$output["tick_id"]."/";
                         $files_arr = array();

                          if(!file_exists($ruta)){
                              mkdir($ruta,0777, true);  
                              //$old = umask(0);   
                              //mkdir("/opt/lampp/htdocs/PERSONAL_HelpDesk/public/document/prueba", 0777, true); 
                              //umask($old);  
                          }  
  
                         for($index = 0; $index < $countfiles; $index++){
                             $doc1 = $_FILES["files"]["tmp_name"][$index];
                             $destino = $ruta.$_FILES["files"]["name"][$index];

                             $documento->insert_documento( $output["tick_id"], $_FILES["files"]["name"][$index]);
 
                             move_uploaded_file($doc1,$destino); 
   
                         }
                     }

                 }
              }
             echo json_encode($datos);
        break;

        case "listar_x_usu": 
            $datos=$ticket->listar_ticket_x_usu($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tick_id"];
                $sub_array[] = $row["cat_nom"];
                $sub_array[] = $row["tick_titulo"];
                
                if($row["tick_estado"] == "Abierto"){
                    $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
                }else{
                    $sub_array[] = '<a onClick="CambiarEstado('.$row["tick_id"].')" ><span class="label label-pill label-danger">Cerrado</span></a>';
                }
                
                $sub_array[] = date("d/m/Y H:i:s",strtotime($row["fech_crea"]));

                if($row["fech_asig"]==null){
                    $sub_array[] = '<span class="label label-pill label-default">Sin asignar</span>';
                }else{
                    $sub_array[] = date("d/m/Y H:i:s",strtotime($row["fech_asig"]));
                }


                if($row["usu_asig"]==null){
                    $sub_array[] = '<span class="label label-pill label-warning">Sin asignar</span>';
                }else{
                    $datos1=$usuario->get_usuario_x_id($row["usu_asig"]);
                    foreach($datos1 as $row1){
                        $sub_array[] = '<span class="label label-pill label-success">'.$row1["usu_nom"].'</span>';
                    }
                }


                $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');" id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><div><i class="fa fa-eye"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data
            );
            echo json_encode($results);
        break;


        case "listar": 
            $datos=$ticket->listar_ticket();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tick_id"];
                $sub_array[] = $row["cat_nom"];
                $sub_array[] = $row["tick_titulo"];

                if($row["tick_estado"] == "Abierto"){
                    $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
                }else{
                    $sub_array[] = '<a onClick="CambiarEstado('.$row["tick_id"].')" ><span class="label label-pill label-danger">Cerrado</span></a>';
                }
              

               // $sub_array[] = $row["tick_estado"];
                $sub_array[] = date("d/m/Y H:i:s",strtotime($row["fech_crea"]));

                if($row["fech_asig"]==null){
                    $sub_array[] = '<span class="label label-pill label-default">Sin asignar</span>';
                }else{
                    $sub_array[] = date("d/m/Y H:i:s",strtotime($row["fech_asig"]));
                }

                if($row["usu_asig"]==null){
                    $sub_array[] = '<a onClick="asignar('.$row["tick_id"].');"><span class="label label-pill label-warning">Sin asignar</span></a>';
                }else{
                    $datos1=$usuario->get_usuario_x_id($row["usu_asig"]);
                    foreach($datos1 as $row1){
                        $sub_array[] = '<span class="label label-pill label-success">'.$row1["usu_nom"].'</span>';
                    }
                }


                $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');" id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><div><i class="fa fa-eye"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data
            );
            echo json_encode($results);
        break;

        case "listardetalle": 
            $datos=$ticket->listar_ticketdetalle_x_ticket($_POST["tick_id"]);
            ?> 
                <?php
                    foreach($datos as $row){
                        ?>
                              <article class="activity-line-item box-typical">
                                    <div class="activity-line-date">
                                       <?php echo date("d/m/Y",strtotime($row["fech_crea"]));?>   <!-- para ver la fecha de creación de cada ticket -->
                                    </div>

                                    <header class="activity-line-item-header">
                                        <div class="activity-line-item-user">
                                            <div class="activity-line-item-user-photo">
                                                <a href="#">
                                                    <img src="/PERSONAL_HelpDesk/public/<?php echo $row['rol_id'] ?>.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="activity-line-item-user-name"><?php echo $row['usu_nom'].' '.$row['usu_ape']; ?></div> 
                                            <div class="activity-line-item-user-status"> <!--Decidir si mostrar Usuario o Soporte basado en el rol del cada quien-->
                                                <?php 
                                                    if($row['rol_id']==1){
                                                        echo 'Usuario';
                                                    }else{
                                                        echo 'Soporte';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </header>

                                    <div class="activity-line-action-list">
                                        <section class="activity-line-action">
                                            <div class="time"> <?php echo date("H:i:s",strtotime($row["fech_crea"]));?>  </div>
                                            <div class="cont">
                                            <div class="cont-in"> <!--Contenido tomado desde la base de datos-->
                                                    <p><?php echo $row['tickd_descrip'];?></p>
                                                
                                                </div>
                                            </div>
                                        </section><!--.activity-line-action-->
                                
                                    </div><!--.activity-line-action-list-->

                            </article><!--.activity-line-item-->
                        <?php
                    }
                ?>
            <?php
        break;

        case "mostrar";
            $datos=$ticket->listar_ticket_x_id($_POST["tick_id"]);  
                if(is_array($datos)==true and count($datos)>0){
                    foreach($datos as $row)
                    {
                        $output["tick_id"] = $row["tick_id"];
                        $output["usu_id"] = $row["usu_id"];
                        $output["cat_id"] = $row["cat_id"];

                        $output["tick_titulo"] = $row["tick_titulo"];
                        $output["tick_descrip"] = $row["tick_descrip"];

                        if ($row["tick_estado"]=="Abierto"){
                            $output["tick_estado"] = '<span class="label label-pill label-success">Abierto</span>';
                        }else{
                            $output["tick_estado"] = '<span class="label label-pill label-danger">Cerrado</span>';
                        }

                            // Todas las variables creadas en el controlador son globales para los js de las vistas

                        $output["tick_estado_texto"] = $row["tick_estado"]; //Se creó aquí en lugar de usarla en detalleticket.js op=mostrar

                        $output["fech_crea"] = date("d/m/Y",strtotime($row["fech_crea"]));
                        $output["usu_nom"] = $row["usu_nom"];
                        $output["usu_ape"] = $row["usu_ape"];
                        $output["cat_nom"] = $row["cat_nom"];
                    }
                    echo json_encode($output);
                }  
        break;

            //Sección 13_37_2
          case "insertdetalle": 
              $ticket->insert_ticketdetalle($_POST["tick_id"],$_POST["usu_id"],$_POST["tickd_descrip"]);
          break;
            //Final Sección 13_37


          case "update": 
                $ticket->update_ticket($_POST["tick_id"]);
                $ticket->insert_ticketdetalle_cerrar($_POST["tick_id"],$_POST["usu_id"]);
          break;

          case "reabrir": 
            $ticket->reabrir_ticket($_POST["tick_id"]);
            $ticket->insert_ticketdetalle_reabrir($_POST["tick_id"],$_POST["usu_id"]);
          break;

          case "asignar": 
            $ticket->update_ticket_asignacion($_POST["tick_id"],$_POST["usu_asig"]);
          break;


        case "total";
            $datos=$ticket->get_ticket_total();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;


        case "totalabierto";
            $datos=$ticket->get_ticket_totalabierto();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        
        case "totalcerrado";
            $datos=$ticket->get_ticket_totalcerrado();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;


        // Inicia prueba de sustitución de gráfico para el usuario de soporte

        case "totalhardware";
        $datos=$ticket->get_ticket_totalhardware();  
         if(is_array($datos)==true and count($datos)>0){
             foreach($datos as $row)
             {
                 $output["TOTAL"] = $row["TOTAL"];
             }
            echo json_encode($output);
         }
        break;


         case "totalsoftware";
             $datos=$ticket->get_ticket_totalsoftware();  
             if(is_array($datos)==true and count($datos)>0){
                 foreach($datos as $row)
                 {
                     $output["TOTAL"] = $row["TOTAL"];
                 }
                 echo json_encode($output);
             }
         break;

        
         case "totalincidencia";
         $datos=$ticket->get_ticket_totalincidencia();  
         if(is_array($datos)==true and count($datos)>0){
             foreach($datos as $row)
             {
                 $output["TOTAL"] = $row["TOTAL"];
             }
             echo json_encode($output);
         }
         break;


         case "totalservicio";
         $datos=$ticket->get_ticket_totalservicio();  
         if(is_array($datos)==true and count($datos)>0){
             foreach($datos as $row)
             {
                 $output["TOTAL"] = $row["TOTAL"];
             }
             echo json_encode($output);
         }
         break;


        // Termina prueba de sustitución de gráfico el usuario de soporte


    }

?>