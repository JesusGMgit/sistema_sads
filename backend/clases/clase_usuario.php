<?php
 
require_once "../clases/clase_conexion.php";

class Usuario{
    

    public static function create_usuario($Us_Usuario, $Us_Nivel, $Us_Contra, $Us_Descripcion) {
        $conexion_db =new Conexion();
        $query = "INSERT INTO usuarios (Us_Usuario, Us_Nivel, Us_Contra, Us_Descripcion)
        VALUES ('$Us_Usuario', '$Us_Nivel', '$Us_Contra', '$Us_Descripcion')";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end create_usuario

    public static function read_usuarios(){
        $conexion_db =new Conexion();
        $query = "SELECT *FROM  usuarios";
        $resultado = $conexion_db->query($query);
        $datos = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos[]=[
                    'Us_ID'=>$row['Us_ID'],
                    'Us_Usuario'=>$row['Us_Usuario'],
                    'Us_Nivel'=>$row['Us_Nivel'],
                    'Us_Contra'=>$row['Us_Contra'],
                    'Us_Descripcion'=>$row['Us_Descripcion'],
                ];
            }//end while
            return $datos;
        }//end if
    }//end read_usuarios
    
    public static function read_usuario($id_usuario) {
        $conexion_db =new Conexion();
        $query = "SELECT *FROM  usuarios WHERE Us_ID=$id_usuario";
        $resultado = $conexion_db->query($query);
        $datos = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos[]=[
                    'Us_ID'=>$row['Us_ID'],
                    'Us_Usuario'=>$row['Us_Usuario'],
                    'Us_Nivel'=>$row['Us_Nivel'],
                    'Us_Contra'=>$row['Us_Contra'],
                    'Us_Descripcion'=>$row['Us_Descripcion'],
                ];
            }//end while
            return $datos;
        }//end if
    }//end read_usuario

    public static function update_usuario($Us_ID,$Us_Usuario, $Us_Nivel, $Us_Contra, $Us_Descripcion) {
        $db = new Conexion();
        $query = "UPDATE usuarios SET 
                  Us_Usuario='" . $Us_Usuario . "', Us_Contra='" . $Us_Contra . "', Us_Nivel='" . $Us_Nivel . "', Us_Descripcion='" . $Us_Descripcion . 
                  "' WHERE Us_ID=" . $Us_ID;
        $db->query($query);
        if($db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end update_usuario

    public static function delete_usuario($Us_ID) {
        $db = new Conexion();
        $query = "DELETE FROM usuarios WHERE Us_ID=$Us_ID";
        $db->query($query);
        if($db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end delete_usuario

}
?>