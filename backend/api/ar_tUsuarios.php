<?php

require_once "../clases/clase_usuario.php";
header("Content-Type: application/json");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['Us_ID'])) {
            //echo "entro aqui";
            echo json_encode(Usuario::getWhere($_GET['Us_ID']));
        }//end if
        else {
            //echo "entro en todos";
            echo json_encode(Usuario::getAll());
        }//end else
        break;

    case 'POST':
            
        $_POST=json_decode(file_get_contents('php://input'),true);
        echo json_encode($_POST);
        //$datos = json_decode(file_get_contents('php://input'));
            
        if($_POST != NULL) {
                
            if(Usuario::insert($_POST['Us_Usuario'],$_POST['Us_Nivel'],$_POST['Us_Contra'],$_POST['Us_Descripcion'])){
                    
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

    case 'PUT':
        $_PUT=json_decode(file_get_contents('php://input'),true);
        echo json_encode($_PUT);
        if($_PUT != NULL) {
            if(Usuario::update($_GET['Us_ID'],$_PUT['Us_Usuario'],$_PUT['Us_Nivel'],$_PUT['Us_Contra'],$_PUT['Us_Descripcion'])) {
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
        if(isset($_GET['Us_ID'])){
            if(Usuario::delete($_GET['Us_ID'])) {
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