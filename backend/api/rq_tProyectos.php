<?php
//*Conectar con el servidor
try{
    include('../php/conexion_db_2.php');
    //include('../php/conexion_db.php');
} catch(Exception $e){
    echo "Excepcion capturada: ",  $e->getMessage(), "\\n";
}

//Opciones de consultas 
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        // obtener datos de la tabla operadores
        if (!empty($_GET["id"])) {
            $P_ID =(int)addslashes($_GET["id"]);
            get_proyecto($P_ID);
        } else {
            get_proyectos();
        }
        break;

    case 'POST':
        if (!empty($_POST["DI_A"])){
            $id=(int)addslashes($_POST["DI_A"]);
            update_proyecto($id);
        }elseif (!empty($_POST["DI_B"])){
            $id = intval($_POST["DI_B"]);
            delete_proyecto($id);
        }else {
             // agregar un registro en la tabla
            insert_proyecto();
        }
        break;

    case 'PUT':
        // actualizar un registro en la tabla
        $P_nombre = intval($_GET["nombre"]);
        update_proyecto($P_nombre);
        break;

    case 'DELETE':
        // borrar un registro en la tabla
        //$P_nombre = intval($_GET["nombre"]);
        delete_proyecto($P_nombre);
        break;

    default:
        // opcion no valida
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

//funciones de la api para los dirferentes consultas para la tabala operadores
function get_proyectos()
{
    $sql = "SELECT * FROM proyectos";
    global $conn;
    $query = $conn->query($sql);
    $data = array();
    while ($r = $query->fetch_assoc()) {
        $data[] = $r;
    }
    echo json_encode($data);
}

function get_proyecto($P_ID)
{
    $sql = "SELECT * FROM proyectos WHERE Pro_ID=\"" . $P_ID . "\"";
    global $conn;
    $query = $conn->query($sql);
    $data = array();
    while ($r = $query->fetch_assoc()) {
        $data[] = $r;
    }
    echo json_encode($data);
}

function insert_proyecto()
{
    @$pro_nombre =addslashes($_POST['Pro_nombre']);
    @$pro_diametro = (int)addslashes($_POST['Pro_diametro']);
    @$pro_espesor = (int)addslashes($_POST['Pro_espesor']);
    @$pro_alambre = addslashes($_POST['Pro_alambre']);
    @$pro_fundente = addslashes($_POST['Pro_fundente']);
    @$pro_ordentrabajo = addslashes($_POST['Pro_ordentrabajo']);
    @$pro_especificacion = addslashes($_POST['Pro_especificacion']);
    @$pro_wps = addslashes($_POST['Pro_wps']);
    global $conn;

    $sql = "INSERT INTO proyectos (Pro_Nombre,Pro_Diametro,Pro_Espesor,Pro_Alambre,Pro_Fundente,Pro_OrdenTrabajo,Pro_Especificacion,Pro_wps)
    VALUES ('$pro_nombre', '$pro_diametro', '$pro_espesor','$pro_alambre','$pro_fundente','$pro_ordentrabajo','$pro_especificacion','$pro_wps')";

    if ($conn->query($sql) === TRUE) {
        echo "El proyecto fue registrado";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function update_proyecto($pro_id)
{

    @$pro_nombre =addslashes($_POST['Pro_nombre']);
    @$pro_diametro = (int)addslashes($_POST['Pro_diametro']);
    @$pro_espesor = (int)addslashes($_POST['Pro_espesor']);
    @$pro_alambre = addslashes($_POST['Pro_alambre']);
    @$pro_fundente = addslashes($_POST['Pro_fundente']);
    @$pro_ordentrabajo = addslashes($_POST['Pro_ordentrabajo']);
    @$pro_especificacion = addslashes($_POST['Pro_especificacion']);
    @$pro_wps = addslashes($_POST['Pro_wps']);
    global $conn;
    //echo "1 ".$pro_nombre." ".$pro_diametro." ".$pro_espesor." ".$pro_alambre. " ".$pro_fundente.
       // " ".$pro_ordentrabajo." ".$pro_especificacion."1 ";

    $sql = "UPDATE proyectos SET Pro_Nombre='" . $pro_nombre . "', Pro_Diametro='" . $pro_diametro . 
            "', Pro_Espesor='" . $pro_espesor. "', Pro_Alambre='" . $pro_alambre . "', Pro_Fundente='".$pro_fundente.
            "', Pro_OrdenTrabajo='".$pro_ordentrabajo."', Pro_Especificacion='".$pro_especificacion."', Pro_WPS='".$pro_wps."' WHERE Pro_ID=" . $pro_id;
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo " Se actualizaron los datos del proyecto";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

function delete_proyecto($P_id)
{
    global $conn;

    $sql = "DELETE FROM proyectos WHERE Pro_ID=" . $P_id;

    if ($conn->query($sql) === TRUE) {
        echo "Se borraron los datos del proyecto";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>