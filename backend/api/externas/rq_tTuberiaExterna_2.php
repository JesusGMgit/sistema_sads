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
            get_tubos_fecha($T_fecha);
        }elseif(!empty($_GET["proyecto"])){
            $T_proyecto=((int)addslashes($_GET["proyecto"]));
            get_tubos_proyecto($T_proyecto);
        }
        else {
            get_tubos();
        }
        break;

    case 'POST':
        // agregar un registro en la tabla
        if (!empty($_POST["A_nombre_reporte"])) {
            //actualiza en el registro el nombre del Reporte;
            update_reporte();      
        }
        elseif (!empty($_POST["A_ID_tubo"])) {
            //actualiza en el registro los nombres de los archivos excel;
            update_tubo();      
        }
        elseif (!empty($_POST["A_data_tubo"])) {
            //actualiza los todos los datos de un tubo que se consulto por medio de la pagina web;
            update_tuberia();      
        }
        elseif (!empty($_POST["H_ID_tubo"])) {
            //actualiza los todos los datos de un tubo que se consulto por medio de la pagina web;
            update_hora_db();      
        }
        else {
            //agrega un nuevo registro de tuberia;
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
        $T_ID_tubo = intval($_GET["tubo"]);
        delete_tubo($T_ID_tubo);
        break;

    default:
        // opcion no valida
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

//funciones de la api para los diferentes consultas para la tabla operadores
function get_tubos()
{
    $sql = "SELECT * FROM tuberia_soldadura_externa_2";
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
    $sql = "SELECT * FROM tuberia_soldadura_externa_2 WHERE Tex_ID_tubo=" . $T_ID_tubo . "";
    global $conn;
    $query = $conn->query($sql);
    $data = array();
    while ($r = $query->fetch_assoc()) {
        $data[] = $r;
    }
    echo json_encode($data);
}

function get_tubos_fecha($T_fecha= "")
{
    
    $sql = "SELECT * FROM tuberia_soldadura_externa_2 WHERE Tex_Fecha=\"" . $T_fecha . "\"";
    
    global $conn;
    $query = $conn->query($sql);
    $data = array();
    while ($r = $query->fetch_assoc()) {
        $data[] = $r;
    }
    echo json_encode($data);
}

function get_tubos_proyecto($T_proyecto=0)
{
    
    $sql = "SELECT * FROM tuberia_soldadura_externa_2 WHERE Tex_ID_proyecto=\"". $T_proyecto."\"";

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
    //@$T_maquina=addslashes($_POST['T_maquina']);
    @$T_foliooperador=addslashes($_POST['T_foliooperador']);
    @$T_fecha=addslashes($_POST['T_fecha']);
    @$T_hora=addslashes($_POST['T_hora']);
    @$T_hora_db=addslashes($_POST['T_hora_db']);
    @$Archivos_excel=addslashes($_POST['Archivos_excel']);
    @$T_observaciones=addslashes($_POST['T_observaciones']);

    global $conn;

    $sql = "INSERT INTO tuberia_soldadura_externa_2 (Tex_ID_tubo,Tex_No_tubo,Tex_No_placa,Tex_ID_proyecto,Tex_Lote_alambre,Tex_Lote_fundente,Tex_FolioOperador,Tex_Fecha,Tex_Hora,Tex_hora_db,Tex_Archivos_excel,Tex_Observaciones)
    VALUES ('$id_tubo','$T_no_tubo','$T_no_placa','$T_ID_proyecto','$T_lote_alambre','$T_lote_fundente','$T_foliooperador','$T_fecha','$T_hora','$T_hora_db','$Archivos_excel', '$T_observaciones')";

    if ($conn->query($sql) === TRUE) {
        echo "El tubo ".$id_tubo." fue registrado";
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
    $sql="UPDATE tuberia_soldadura_externa_2 SET Tex_Archivos_excel='".$T_Archivos_excel."' WHERE Tex_ID_tubo=".$id_tubo;
    
    if ($conn->query($sql) === TRUE) {
        echo "Se actualizaron/registraron los nombres de los archivos excel";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

function update_reporte()
{
    //actualizar la columna archivos_excel de  la tabla
    @$id_tubo =(int)addslashes($_POST['A_id_tubo']);
    @$T_nombre_reporte =addslashes($_POST['A_nombre_reporte']);
    
    global $conn;
    $sql="UPDATE tuberia_soldadura_externa_2 SET Tex_Reporte_excel='".$T_nombre_reporte."' WHERE Tex_ID_tubo=".$id_tubo;
    
    if ($conn->query($sql) === TRUE) {
        echo "El nombre del reporte fue agregado al registrado del tubo.";
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
    //@$T_maquina=addslashes($_POST['T_maquina']);
    @$T_foliooperador=addslashes($_POST['T_foliooperador']);
    @$T_fecha=addslashes($_POST['T_fecha']);
    @$T_hora=addslashes($_POST['T_hora']);
    //@$Archivos_excel=addslashes($_POST['Archivos_excel']);
    @$T_observaciones=addslashes($_POST['T_observaciones']);
    
    global $conn;
    $sql = "UPDATE tuberia_soldadura_externa_2 SET Tex_No_tubo='" . $T_no_tubo . "', Tex_No_placa='" . $T_no_placa . "', Tex_ID_proyecto='" . $T_ID_proyecto. "', 
    Tex_Lote_alambre='" . $T_lote_alambre . "', Tex_Lote_fundente='".$T_lote_fundente."',Tex_FolioOperador='".$T_foliooperador."',
    Tex_Fecha='".$T_fecha."',Tex_Hora='".$T_hora."', Tex_Observaciones='".$T_observaciones."' WHERE Tex_ID_tubo=" . $id_tubo;
    
    if ($conn->query($sql) === TRUE) {
        echo "Se actualizaron los datos del tubo: ". $id_tubo;
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
    $sql="UPDATE tuberia_soldadura_externa_2 SET Tex_Hora_db='".$T_hora_db."' WHERE Tex_ID_tubo=".$id_tubo;
    
    if ($conn->query($sql) === TRUE) {
        echo "Se registro/actualizo fecha tipo dato datetime";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

function delete_tubo($T_ID_tubo)
{
    global $conn;

    $sql = "DELETE FROM tuberia_soldadura_externa_2 WHERE Tex_ID_tubo=" . $T_ID_tubo;

    if ($conn->query($sql) === TRUE) {
        echo "Se borraron los datos del tubo: ". $T_ID_tubo;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?> 