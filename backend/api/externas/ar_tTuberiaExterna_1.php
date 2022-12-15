<?php

require_once "../../api/clases/clase_soldadura_externa.php";
header("Content-Type: application/json");
switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
            
        $_POST=json_decode(file_get_contents('php://input'),true);
        echo json_encode($_POST);
         
        if($_POST != NULL) {
            if(soldadura_externa::crear_registro_tuberia_externa("tuberia_soldadura_externa_1",$_POST['Tex_ID_tubo'],$_POST['Tex_No_tubo'],$_POST['Tex_No_placa'],
                                        $_POST['Tex_ID_proyecto'],$_POST['Tex_Lote_alambre'],$_POST['Tex_Lote_fundente'],$_POST['Tex_FolioOperador']
                                        ,$_POST['Tex_Fecha'],$_POST['Tex_Hora'],$_POST['Tex_hora_db'],$_POST['Tex_Archivos_excel']
                                        ,$_POST['Tex_Observaciones'])){
                    
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

        if(isset($_GET['Tex_ID_tubo'])) {
            //echo "ID de tubo: " . $_GET['Tex_ID_tubo'];
            echo json_encode(soldadura_externa::Leer_tubo_externa("tuberia_soldadura_externa_1",$_GET['Tex_ID_tubo']));
        }//end if
        else {
            //echo "TODOS LOS REGISTROS DE TUBERIA EXTERNA 34";
            echo json_encode(soldadura_externa::Leer_tuberia_externa("tuberia_soldadura_externa_1"));
        }//end else

        break;

    case 'PUT':

        $_PUT=json_decode(file_get_contents('php://input'),true);
        //echo json_encode($_PUT);
        if($_PUT != NULL) {
            if(soldadura_externa::actualizar_tubo_externa("tuberia_soldadura_externa_1",$_GET['Tex_ID_tubo'],$_PUT['Tex_No_tubo'],$_PUT['Tex_No_placa'],
                                                          $_PUT['Tex_ID_proyecto'],$_PUT['Tex_Lote_alambre'],$_PUT['Tex_Lote_fundente'],
                                                          $_PUT['Tex_FolioOperador'],$_PUT['Tex_Fecha'],$_PUT['Tex_Hora'],$_PUT['Tex_hora_db'],
                                                          $_PUT['Tex_Archivos_excel'],$_PUT['Tex_Observaciones'])) {
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

        if(isset($_GET['Tex_ID_tubo'])){
            if(soldadura_externa::borrar_tubo_externa("tuberia_soldadura_externa_1",$_GET['Tex_ID_tubo'])) {
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