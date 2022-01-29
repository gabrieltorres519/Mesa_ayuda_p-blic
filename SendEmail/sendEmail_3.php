<?php

    require_once(realpath(dirname(__FILE__) . '/../config/conexion.php'));
    require_once(realpath(dirname(__FILE__) . '/../models/Ticket.php'));
    
    use PHPMailer\PHPMailer\PHPMailer;

    
  

             $ticket = new Ticket();

             $datos = $ticket->listar_ticket_x_id($_POST["tick_id"]);
             foreach ($datos as $row){
                 $id = $row["tick_id"];
                 $usu = $row["usu_nom"];
                 $usu_ape = $row["usu_ape"];
                 $titulo = $row["tick_titulo"];
                 $categoria = $row["cat_nom"];
                 $correo = $row["usu_correo"];
             }
            
             $body = file_get_contents(__DIR__ . '/../../public/NuevoTicket.html');
        
            $body = str_replace("xnroticket", $id,  $body );
             $body = str_replace("lblNomUsu", $usu,  $body );
             $body = str_replace("lblTitu", $titulo,  $body );
             $body = str_replace("lblCate", $categoria,  $body );

                $name = "SICAP HelpDesk";
                $email = "prueba@mail.com";
                //$subject = "Ticket abierto... ";
                //$body = "cuerpo..";
                

                require_once "PHPMailer/PHPMailer.php";
                require_once "PHPMailer/SMTP.php";
                require_once "PHPMailer/Exception.php";

                $mail = new PHPMailer();

                //SMTP Settings
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "sicaphelpdeskmailer@gmail.com";
                $mail->Password = 'ChessNoobButLover';
                $mail->Port = 465; //587
                $mail->SMTPSecure = "ssl"; //tls

                //Email Settings
                $mail->isHTML(true);
                //$mail->setFrom($email, $name);
                $mail->setFrom($email, $name);
                $mail->addAddress($correo);
                //$mail->Subject = $subject;
                $mail->Subject = "Ticket Cerrado";
                $mail->Body = 'Hola '.$usu.' '.$usu_ape.'!!. 
                Tu ticket número '.$id.' con los datos... 
                Titulo: "'.$titulo.'" 
                Categoría: "'.$categoria.'" 
                fue cerrado, verifica si es la acción que requerías con soporte.';
                //$mail->Body = $body;

                

                if ($mail->send()) {
                    $status = "success";
                    $response = "Email is sent!";
                } else {
                    $status = "failed";
                    $response = "Something is wrong in sendEmail_2: <br><br>" . $mail->ErrorInfo;
                }

                exit(json_encode(array("status" => $status, "response" => $response)));
   

            
   
?>
