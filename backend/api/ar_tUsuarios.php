<?php

require_once "../clases/clase_usuario.php";
header("Content-Type: application/json");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['id'])) {
            //echo "entro aqui";
            echo json_encode(Usuario::getWhere($_GET['id']));
        }//end if
        else {
            //echo "entro en todos";
            echo json_encode(Usuario::getAll());
        }//end else
        break;

        case 'POST':
            
            $_POST=json_decode(file_get_contents('php://input'),true);
            echo json_encode($_POST['Us_Usuario']);
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

        default:

        http_response_code(405);
        break;
}//end while
?>