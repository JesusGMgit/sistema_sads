<?php

require_once "../clases/clase_soldadura_interna.php";
//header("Content-Type: application/json");
switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
            
        $_POST=json_decode(file_get_contents('php://input'),true);
        echo json_encode($_POST);

        if($_POST != NULL) {
            if(isset($_POST['Tin_AID'])){
                echo json_encode(soldadura_interna::actualizar_RID_tubo("tuberia_soldadura_interna_3",$_POST['Tin_AID'],$_POST['Tin_ARID']));
                http_response_code(200);
            }elseif(isset($_POST['Tin_ID_tubo'])){
                soldadura_interna::crear_registro_tuberia_interna("tuberia_soldadura_interna_3",$_POST['Tin_ID_tubo'],$_POST['Tin_No_tubo'],$_POST['Tin_No_placa'],
                                        $_POST['Tin_ID_proyecto'],$_POST['Tin_Lote_alambre'],$_POST['Tin_Lote_fundente'],$_POST['Tin_FolioOperador']
                                        ,$_POST['Tin_Fecha'],$_POST['Tin_Hora'],$_POST['Tin_hora_db'],$_POST['Tin_Archivos_excel']
                                        ,$_POST['Tin_Observaciones']);
                    
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
        if(isset($_GET['fecha'])){
            //echo "fecha: " . $_GET['fecha'] . " :";
            echo json_encode(soldadura_interna::obtener_registros_fecha("tuberia_soldadura_interna_3",$_GET['fecha']));
        }elseif(isset($_GET['Tin_ID_tubo'])) {
            //echo "ID de tubo: " . $_GET['Tin_ID_tubo'];
            echo json_encode(soldadura_interna::Leer_tubo_interna("tuberia_soldadura_interna_3",$_GET['Tin_ID_tubo']));
        }//end if
        else {
            //echo "TODOS LOS REGISTROS DE TUBERIA EXTERNA 34";
            echo json_encode(soldadura_interna::Leer_tuberia_interna("tuberia_soldadura_interna_3"));
        }//end else

        break;

    case 'PUT':

        $_PUT=json_decode(file_get_contents('php://input'),true);
        //echo json_encode($_PUT);
        if($_PUT != NULL) {
            if(soldadura_interna::actualizar_tubo_interna("tuberia_soldadura_interna_3",$_GET['Tin_ID_tubo'],$_PUT['Tin_No_tubo'],$_PUT['Tin_No_placa'],
                                                          $_PUT['Tin_ID_proyecto'],$_PUT['Tin_Lote_alambre'],$_PUT['Tin_Lote_fundente'],
                                                          $_PUT['Tin_FolioOperador'],$_PUT['Tin_Fecha'],$_PUT['Tin_Hora'],$_PUT['Tin_hora_db'],
                                                          $_PUT['Tin_Archivos_excel'],$_PUT['Tin_Observaciones'])) {
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

        if(isset($_GET['Tin_ID_tubo'])){
            if(soldadura_interna::borrar_tubo_interna("tuberia_soldadura_interna_3",$_GET['Tin_ID_tubo'])) {
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