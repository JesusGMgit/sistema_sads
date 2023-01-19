<?php
//*Conectar con el servidor
try{
    include('../../php/conexion_db_2.php');
    //include('../../php/conexion_db.php');
} catch(Exception $e){
    echo "Excepcion capturada: ",  $e->getMessage(), "\\n";
}

//Opciones de consultas 
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        // obtener datos de la tabla operadores
        if (!empty($_GET["tubo"])) {
            $T_ID_tubo = (int)addslashes($_GET["tubo"]);
            get_tubo($T_ID_tubo);
        } elseif(!empty($_GET["fecha"])) {
            $T_fecha= addslashes($_GET["fecha"]);
            $T_maquina=addslashes($_GET["maquina"]);
            get_tubos_fecha($T_fecha,$T_maquina);
        }elseif(!empty($_GET["proyecto"])){
            $T_proyecto=(int)(addslashes($_GET["proyecto"]));
            $T_maquina=(addslashes($_GET["maquina"]));
            get_tubos_proyecto($T_proyecto,$T_maquina);
        }
        else {
            get_tubos();
        }
        break;

    case 'POST':
        // agregar un registro en la tabla
        if (!empty($_POST["A_nombre_reporte"])) {
            //echo "aqui entro actualizar";
            update_reporte();      
        }
        elseif (!empty($_POST["A_ID_tubo"])) {
            //echo "aqui entro actualizar";
            update_tubo();      
        }
        elseif (!empty($_POST["A_data_tubo"])) {
            //echo "aqui entro actualizar";
            update_tuberia();      
        }
        elseif (!empty($_POST["H_ID_tubo"])) {
            //actualiza los todos los datos de un tubo que se consulto por medio de la pagina web;
            update_hora_db();      
        }
        else {
            //echo "aqui entro agregar";
            insert_tubo();
        }
       
        break;

    case 'PUT':
        // actualizar un registro en la tabla
        //$id_tubo = intval($_GET["id_tubo"]);
        //update_tubo($id_tubo);
        update_tubo();
        break;

    case 'DELETE':
        // borrar un registro en la tabla
        $T_no_tubo = intval($_GET["tubo"]);
        delete_tubo($T_no_tubo);
        break;

    default:
        // opcion no valida
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

//funciones de la api para los diferentes consultas para la tabla operadores
function get_tubos()
{
    $sql = "SELECT * FROM tuberia_soldadura_interna_extra";
    global $conn;
    $query = $conn->query($sql);
    $data = array();
    while ($r = $query->fetch_assoc()) {
        $data[] = $r;
    }
    echo json_encode($data);
}

function get_tubo($T_ID_tubo= 0)
{
    $sql = "SELECT * FROM tuberia_soldadura_interna_extra WHERE Tin_ID_tubo=" . $T_ID_tubo . "";
    global $conn;
    $query = $conn->query($sql);
    $data = array();
    while ($r = $query->fetch_assoc()) {
        $data[] = $r;
    }
    echo json_encode($data);
}

function get_tubos_fecha($T_fecha= "",$T_maquina="")
{
    if($T_maquina!=""){
        $sql = "SELECT * FROM tuberia_soldadura_interna_extra WHERE Tin_Fecha=\"" . $T_fecha . "\" AND Tin_Maquina=\"".$T_maquina."\"";
    }else{
        $sql = "SELECT * FROM tuberia_soldadura_interna_extra WHERE Tin_Fecha=\"" . $T_fecha . "\"";
    }
    global $conn;
    $query = $conn->query($sql);
    $data = array();
    while ($r = $query->fetch_assoc()) {
        $data[] = $r;
    }
    echo json_encode($data);
}

function get_tubos_proyecto($T_proyecto=0,$T_maquina="")
{
    //echo $T_proyecto." ".$T_maquina."";
    if($T_maquina!=""){
        $sql = "SELECT * FROM tuberia_soldadura_interna_extra WHERE Tin_ID_proyecto=\"". $T_proyecto."\" AND Tin_Maquina=\"".$T_maquina."\"";
    }else{
        $sql = "SELECT * FROM tuberia_soldadura_interna_extra WHERE Tin_ID_proyecto=\"". $T_proyecto."\"";
    }
    global $conn;
    //echo $sql;
    $query = $conn->query($sql);
    $data = array();
    while ($r = $query->fetch_assoc()) {
        $data[] = $r;
    }
    echo json_encode($data);
}

function insert_tubo()
{
    @$id_tubo =(int)addslashes($_POST['T_id_tubo']);
    @$T_no_tubo =(int)addslashes($_POST['T_no_tubo']);
    @$T_no_placa = (int)addslashes($_POST['T_no_placa']);
    @$T_ID_proyecto = addslashes($_POST['T_ID_proyecto']);
    @$T_lote_alambre = addslashes($_POST['T_lote_alambre']);
    @$T_lote_fundente = addslashes($_POST['T_lote_fundente']);
    @$T_maquina=addslashes($_POST['T_maquina']);
    @$T_foliooperador=addslashes($_POST['T_foliooperador']);
    @$T_fecha=addslashes($_POST['T_fecha']);
    @$T_hora=addslashes($_POST['T_hora']);
    @$T_hora_db=addslashes($_POST['T_hora_db']);
    @$Archivos_excel=addslashes($_POST['Archivos_excel']);
    @$T_observaciones=addslashes($_POST['T_observaciones']);

    global $conn;

    $sql = "INSERT INTO tuberia_soldadura_interna_extra (Tin_ID_Tubo,Tin_No_tubo,Tin_No_placa,Tin_ID_proyecto,Tin_Lote_alambre,Tin_Lote_fundente,Tin_Maquina,Tin_FolioOperador,Tin_Fecha,Tin_Hora,Tin_Hora_db,Tin_Archivos_excel,Tin_Observaciones)
    VALUES ('$id_tubo','$T_no_tubo','$T_no_placa','$T_ID_proyecto','$T_lote_alambre','$T_lote_fundente','$T_maquina','$T_foliooperador','$T_fecha','$T_hora','$T_hora_db','$Archivos_excel','$T_observaciones' )";

    if ($conn->query($sql) === TRUE) {
        echo "El tubo fue registrado";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function update_tubo()
{
    //actualizar la columna archivos_excel de  la tabla
    @$id_tubo =(int)addslashes($_POST['A_ID_tubo']);
    @$T_Archivos_excel=addslashes($_POST['Archivos_excel']);
    
    global $conn;
    $sql="UPDATE tuberia_soldadura_interna_extra SET Tin_Archivos_excel='".$T_Archivos_excel."' WHERE Tin_ID_tubo=".$id_tubo;
    
    if ($conn->query($sql) === TRUE) {
        echo "Se actualizaron/registraron los nombres de los archivos excel";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

function  update_reporte()
{
    //actualizar la columna archivos_excel de  la tabla
    @$id_tubo =(int)addslashes($_POST['A_id_tubo']);
    @$T_nombre_reporte =addslashes($_POST['A_nombre_reporte']);
    
    global $conn;
    $sql="UPDATE tuberia_soldadura_interna_extra SET Tin_Archivo_Fexcel='".$T_nombre_reporte."' WHERE Tin_ID_tubo=".$id_tubo;
 
    
    if ($conn->query($sql) === TRUE) {
        echo "Se registro nombre del archivo excel del reporte";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

function update_tuberia(){

    //actualizar datos de tuberia
    @$id_tubo =(int)addslashes($_POST['A_data_tubo']);
    @$T_no_tubo =(int)addslashes($_POST['T_no_tubo']);
    @$T_no_placa = (int)addslashes($_POST['T_no_placa']);
    @$T_ID_proyecto = addslashes($_POST['T_ID_proyecto']);
    @$T_lote_alambre = addslashes($_POST['T_lote_alambre']);
    @$T_lote_fundente = addslashes($_POST['T_lote_fundente']);
    @$T_maquina=addslashes($_POST['T_maquina']);
    @$T_foliooperador=addslashes($_POST['T_foliooperador']);
    @$T_fecha=addslashes($_POST['T_fecha']);
    @$T_hora=addslashes($_POST['T_hora']);
    //@$Archivos_excel=addslashes($_POST['Archivos_excel']);
    @$T_observaciones=addslashes($_POST['T_observaciones']);
    
    //echo " " . $id_tubo ." ". $T_Archivos_excel;
    global $conn;
    $sql = "UPDATE tuberia_soldadura_interna_extra SET Tin_No_tubo='" . $T_no_tubo . "', Tin_No_placa='" . $T_no_placa . "', Tin_ID_proyecto='" . $T_ID_proyecto. "', 
    Tin_Lote_alambre='" . $T_lote_alambre . "', Tin_Lote_fundente='".$T_lote_fundente."',Tin_Maquina='".$T_maquina."',Tin_FolioOperador='".$T_foliooperador."',
    Tin_Fecha='".$T_fecha."',Tin_Hora='".$T_hora."', Tin_Observaciones='".$T_observaciones."' WHERE Tin_ID_tubo=" . $id_tubo;
    
    if ($conn->query($sql) === TRUE) {
        echo "Se actualizaron los datos del tubo";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function update_hora_db()
{
    //actualizar la columna archivos_excel de  la tabla
    @$id_tubo =(int)addslashes($_POST['H_ID_tubo']);
    @$T_hora_db=addslashes($_POST['H_hora_db']);

    global $conn;
    $sql="UPDATE tuberia_soldadura_interna_1 SET Tin_Hora_db='".$T_hora_db."' WHERE Tin_ID_tubo=".$id_tubo;
    
    if ($conn->query($sql) === TRUE) {
        echo "Se registro/actualizo fecha tipo dato datetime";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

function delete_tubo($T_no_tubo)
{
    global $conn;

    $sql = "DELETE FROM tuberia_soldadura_interna_extra WHERE Tin_No_tubo=" . $T_no_tubo;

    if ($conn->query($sql) === TRUE) {
        echo "Se borraron los datos del proyecto";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?> 