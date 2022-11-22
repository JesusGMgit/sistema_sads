<?php

require_once "../clases/clase_usuario.php";

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
            $datos = json_decode(file_get_contents('php://input'));
           
            if($datos != NULL) {
                if(Usuario::insert($datos->$Us_Usuario, $datos->$Us_Nivel, $datos->$Us_Contra, $datos->$Us_Descripcion)) {
                    echo $datos->$Us_Usuario;
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