<?php

require_once "../clases/clase_usuario.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['id'])) {
            echo "entro aqui";
            //echo json_encode(Usuario::getWhere($_GET['id']));
        }//end if
        else {
            echo json_encode(Usuario::getAll());
        }//end else
        break;

        default:

        http_response_code(405);
        break;
}//end while
?>