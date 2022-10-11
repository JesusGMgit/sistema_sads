<?php
//*Conectar con el servidor
//include('../../php/conexion_db2.php');
include('../php/conexion_db.php');

//Opciones de consultas 
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        // obtener datos de la tabla operadores
        if (!empty($_GET["id"])) {
            $id = addslashes($_GET["id"]);
            get_operador($id);
        } else {
            get_operadores();
        }
        break;

    case 'POST':
        if (!empty($_POST["DI_A"])){
            $id=(int)addslashes($_POST["DI_A"]);
            update_operador($id);
        }elseif (!empty($_POST["DI_B"])){
            $id = intval($_POST["DI_B"]);
            delete_operador($id);
        }else {
             // agregar un registro en la tabla
            insert_operador();
        }
        break;
    
    case 'DELETE':
            // borrar un registro en la tabla
            echo "entro aqui";
            $id = intval($_GET["DI"]);
            delete_operador($id);
        break;

    case 'PUT':
        // actualizar un registro en la tabla
        //$id = (int)addslashes($_GET["id"]);
        //update_operador($id);
        break;

    

    default:
        // opcion no valida
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

//funciones de la api para los dirferentes consultas para la tabala operadores
function get_operadores()
{
    $sql = "SELECT * FROM operadores";
    global $conn;
    $query = $conn->query($sql);
    $data = array();
    while ($r = $query->fetch_assoc()) {
        $data[] = $r;
    }
    echo json_encode($data);
}

function get_operador($id = 0)
{
    $sql = "SELECT Op_Folio, Op_Nombre, Op_Clave_soldador, Op_Puesto FROM operadores WHERE 	Op_Folio=" . $id . "";
    global $conn;
    $query = $conn->query($sql);
    $data = array();
    while ($r = $query->fetch_assoc()) {
        $data[] = $r;
    }
    echo json_encode($data);
}

function insert_operador()
{
    @$folio = (int)addslashes($_POST['Op_folio']);
    @$clave_soldador = (int)addslashes($_POST['Op_clave_soldador']);
    @$puesto_op = addslashes($_POST['Op_puesto']);
    @$nombre = addslashes($_POST['Op_nombre']);
    global $conn;

    $sql = "INSERT INTO operadores (Op_Folio, Op_Nombre, Op_Clave_soldador, Op_Puesto)
    VALUES ('$folio', '$nombre', '$clave_soldador','$puesto_op')";

    if ($conn->query($sql) === TRUE) {
        echo "El operador fue registrado, FOLIO: ". $folio;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function update_operador($id)
{

    @$folio=(int)$id;
    @$clave_sold = (int)addslashes($_POST['Op_clave_soldador']);
    @$puesto_op = addslashes($_POST['Op_puesto']);
    @$nombre = addslashes($_POST['Op_nombre']);
    global $conn;
    $sql = "UPDATE operadores SET Op_Nombre='" . $nombre . "', Op_Clave_soldador='" . $clave_sold . "', Op_Puesto='" . $puesto_op . "' WHERE Op_Folio=" . $folio;
    if ($conn->query($sql) === TRUE) {
        echo "Se actualizaron los datos del operador";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  
}

function delete_operador($id)
{
    
    global $conn;
    $sql = "DELETE FROM operadores WHERE Op_Folio=" . $id;

    if ($conn->query($sql) === TRUE) {
        echo "Se borraron los datos del operador";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>