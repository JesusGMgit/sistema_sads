<?php
 
require_once "../conexiones/clase_conexion.php";

class Usuario{
    public static function getAll(){
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
    }//end getAll
    
    public static function getWhere($id_usuario) {
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
    }//end getWhere
}
?>