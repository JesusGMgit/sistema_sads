<?php
 
require_once "../clases/clase_conexion.php";


class Operador{
    
    

    public static function crear_operador($Op_Folio,$Op_Nombre,$Op_Clave_soldador,$Op_Puesto) {
        $conexion_db =new Conexion();
        $query = "INSERT INTO operadores (Op_Folio,Op_Nombre,Op_Clave_soldador,Op_Puesto)
        VALUES ('$Op_Folio', '$Op_Nombre', '$Op_Clave_soldador', '$Op_Puesto')";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end create_usuario

    public static function Leer_operadores(){
        $conexion_db =new Conexion();
        $query = "SELECT *FROM  operadores";
        $resultado = $conexion_db->query($query);
        $datos = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos[]=[
                    'Op_Folio'=>$row['Op_Folio'],
                    'Op_Nombre'=>$row['Op_Nombre'],
                    'Op_Clave_soldador'=>$row['Op_Clave_soldador'],
                    'Op_Puesto'=>$row['Op_puesto']
                ];
            }//end while
            return $datos;
        }//end if
    }//end read_usuarios
    
    public static function Leer_operador($id_operador) {
        $conexion_db =new Conexion();
        $query = "SELECT *FROM  operadores WHERE Op_Folio=$id_operador";
        $resultado = $conexion_db->query($query);
        $datos = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos[]=[
                    'Op_Folio'=>$row['Op_Folio'],
                    'Op_Nombre'=>$row['Op_Nombre'],
                    'Op_Clave_soldador'=>$row['Op_Clave_soldador'],
                    'Op_Puesto'=>$row['Op_puesto']
                ];
            }//end while
            return $datos;
        }//end if
    }//end read_usuario

    public static function actualizar_operador($Op_Folio,$Op_Nombre,$Op_Clave_soldador,$Op_Puesto) {
        $conexion_db = new Conexion();
        $query = "UPDATE operadores SET 
                  Op_Folio='" . $Op_Folio . "', Op_Nombre='" . $Op_Nombre . "', Op_Clave_soldador='" . $Op_Clave_soldador . 
                  "', Op_Puesto='" . $Op_Puesto . 
                  "' WHERE Op_Folio=" . $Op_Folio;
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end update_usuario

    public static function borrar_operador($Op_Folio) {
        $conexion_db = new Conexion();
        $query = "DELETE FROM operadores WHERE Po_Folio=$Op_Folio";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end delete_usuario

}
?>