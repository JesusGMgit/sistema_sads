<?php

require_once "../clases/clase_usuario.php";
header("Content-Type: application/json");
switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
            
        $_POST=json_decode(file_get_contents('php://input'),true);
        echo json_encode($_POST);
            
        if($_POST != NULL) {
            if(Usuario::create_usuario($_POST['Us_Usuario'],$_POST['Us_Nivel'],$_POST['Us_Contra'],$_POST['Us_Descripcion'])){
                    
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

        if(isset($_GET['Us_ID'])) {
            echo json_encode(Usuario::read_usuario($_GET['Us_ID']));
        }//end if
        else {
            echo json_encode(Usuario::read_usuarios());
        }//end else

        break;

    case 'PUT':

        $_PUT=json_decode(file_get_contents('php://input'),true);
        //echo "get: ". $_GET['Us_ID'];
        //echo json_encode($_PUT);
        if($_PUT != NULL) {
            if(Usuario::update_usuario($_GET['Us_ID'],$_PUT['Us_Usuario'],$_PUT['Us_Nivel'],$_PUT['Us_Contra'],$_PUT['Us_Descripcion'])) {
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
            if(Usuario::delete_usuario($_GET['Us_ID'])) {
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