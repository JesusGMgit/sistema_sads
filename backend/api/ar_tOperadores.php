<?php

require_once "../clases/clase_operadores.php";
header("Content-Type: application/json");
switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
            
        $_POST=json_decode(file_get_contents('php://input'),true);
        echo json_encode($_POST);
            
        if($_POST != NULL) {
            if(Operador::crear_operador($_POST['Op_Folio'],$_POST['Op_Nombre'],$_POST['Op_Clave_soldador'],$_POST['Op_Puesto'])){
                    
                http_response_code(200);
            }//end if
            else {
                http_response_code(400);
            }//end else
        }//end if
        else {
            http_response_code(405);
        }//end else
            
        break;

    case 'GET':

        if(isset($_GET['Op_Folio'])) {
            echo json_encode(Operador::Leer_operador($_GET['Op_Folio']));
        }//end if
        else {
            echo json_encode(Operador::Leer_operadores());
        }//end else

        break;

    case 'PUT':

        $_PUT=json_decode(file_get_contents('php://input'),true);
        //echo "get: ". $_GET['Us_ID'];
        //echo json_encode($_PUT);
        if($_PUT != NULL) {
            if(Operador::actualizar_operador($_GET['Op_Folio'],$_PUT['Op_Nombre'],$_PUT['Op_Clave_soldador'],$_PUT['Op_Puesto'])) {
                http_response_code(200);
            }//end if
            else {
                http_response_code(400);
            }//end else
        }//end if
        else {
            http_response_code(405);
        }//end else
        
        break;

    case 'DELETE':

        if(isset($_GET['Op_Folio'])){
            if(Operador::borrar_operador($_GET['Op_Folio'])) {
                http_response_code(200);
            }//end if
            else {
                http_response_code(400);
            }//end else
        }//end if 
        else {
            http_response_code(405);
        }//end else

        break;

    default:

        http_response_code(405);

        break;

}//end while
?>