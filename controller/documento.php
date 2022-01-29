<?php

    require_once(realpath(dirname(__FILE__) . "/../config/conexion.php"));
    require_once(realpath(dirname(__FILE__) . "/../models/Documento.php"));
    $documento = new Documento();

    switch($_GET["op"]){
        case "listar":
            $datos=$documento->get_documento_x_ticket($_POST["tick_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[]='<a href="/PERSONAL_HelpDesk/public/document/'.$_POST["tick_id"].'/'.$row["doc_nom"].'" target="_blank">'.$row["doc_nom"].'</a>';
                $sub_array[]='<a type="button" href="/PERSONAL_HelpDesk/public/document/'.$_POST["tick_id"].'/'.$row["doc_nom"].'" target="_blank" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></a>';
                $data[]= $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

    }

?>