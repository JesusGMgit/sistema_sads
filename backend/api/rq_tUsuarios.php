<?php
//*Conectar con el servidor
try{
    include('../conexiones/conexion_db_2.php');
    //include('../conexion_db.php');
} catch(Exception $e){
    echo "Excepcion capturada: ",  $e->getMessage(), "\\n";
}

//Opciones de consultas 
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        // obtener datos de la tabla usuarios
        if (!empty($_GET["usuario"])) {
            $usuario = $_GET["usuario"];
            echo "variable: " . $usuario . " ";
            get_usuario($usuario);
        } else {
            get_usuarios();
        }
        break;

    case 'POST':
        if (!empty($_POST["US_A"])){
            $Ausuario=(int)addslashes($_POST["US_A"]);
            update_usuario($Ausuario);
        }elseif (!empty($_POST["US_B"])){
            $Busuario = intval($_POST["US_B"]);
            delete_usuario($Busuario);
        }else {
             // agregar un registro en la tabla
            insert_usuario();
        }
        break;

    case 'PUT':
        // actualizar un registro en la tabla
        $id = (int)addslashes($_GET["id"]);
        update_usuario($id);
        break;

    case 'DELETE':
        // borrar un registro en la tabla
        $id = intval($_GET["id"]);
        delete_usuario($id);
        break;

    default:
        // opcion no valida
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

//funciones de la api para los dirferentes consultas para la tabala operadores
function get_usuarios()
{
    $sql = "SELECT * FROM usuarios";
    global $conn;
    $query = $conn->query($sql);
    $data = array();
    while ($r = $query->fetch_assoc()) {
        $data[] = $r;
    }
    echo json_encode($data);
}

function get_usuario($usuario)
{
    $sql = "SELECT * FROM usuarios WHERE Us_Usuario=\"" . $usuario . "\"";
    echo "query sql: " . $sql . " ";
    global $conn;
    $query = $conn->query($sql);
    $data = array();
    while ($r = $query->fetch_assoc()) {
        $data[] = $r;
    }
    echo json_encode($data);
}

function insert_usuario()
{
    @$usuario = addslashes($_GET['Us_usuario']);
    @$contraseña = addslashes($_GET['Us_contraseña']);
    @$nivel=addslashes($_GET['Us_nivel']);
    @$descripcion = addslashes($_GET['Us_descripcion']);
    global $conn;

    $sql = "INSERT INTO usuarios (Us_Usuario, Us_Contra, Us_Nivel,Us_Descripcion)
    VALUES ( '$usuario', '$contraseña','$nivel','$descripcion')";
    echo "sql request: " . $sql ." ";
    if ($conn->query($sql) === TRUE) {
        echo "El usuario fue registrado";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function update_usuario($Pusuario=0)
{
    @$usuario = addslashes($_POST['Us_usuario']);
    @$contraseña = addslashes($_POST['Us_contraseña']);
    @$nivel=addslashes($_POST['Us_nivel']);
    @$descripcion = addslashes($_POST['Us_descripcion']);
    global $conn;
    
    $sql = "UPDATE usuarios SET Us_Usuario='" . $usuario . "', Us_Contra='" . $contraseña . "', Us_Nivel='" . $nivel . "', Us_Descripcion='" . $descripcion . "' WHERE Us_ID=" . $Pusuario;
    echo "sql request: " . $sql ." ";
    if ($conn->query($sql) === TRUE) {
        echo "Se actualizaron los datos del usuario";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

function delete_usuario($Pusuario=0)
{
    global $conn;

    $sql = "DELETE FROM usuarios WHERE Us_ID=" . $Pusuario;

    if ($conn->query($sql) === TRUE) {
        echo "Se borraron los datos del operador";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>