<?php
 
require_once "../clases/clase_conexion.php";

class Proyecto{
    

    public static function crear_proyecto($Pro_Nombre,$Pro_Diametro,$Pro_Espesor,$Pro_Alambre,
                                          $Pro_Fundente,$Pro_OrdenTrabajo,$Pro_Especificacion,$Pro_wps) {
        $conexion_db =new Conexion();
        $query = "INSERT INTO proyectos (Pro_Nombre,Pro_Diametro,Pro_Espesor,Pro_Alambre,
                                        Pro_Fundente,Pro_OrdenTrabajo,Pro_Especificacion,Pro_WPS)
        VALUES ('$Pro_Nombre', '$Pro_Diametro', '$Pro_Espesor', '$Pro_Alambre','$Pro_Fundente',
                '$Pro_OrdenTrabajo','$Pro_Especificacion','$Pro_wps')";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end create_usuario

    public static function Leer_proyectos(){
        $conexion_db =new Conexion();
        $query = "SELECT *FROM  proyectos";
        $resultado = $conexion_db->query($query);
        $datos = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos[]=[
                    'Pro_Nombre'=>$row['Pro_Nombre'],
                    'Pro_Diametro'=>$row['Pro_Diametro'],
                    'Pro_Espesor'=>$row['Pro_Espesor'],
                    'Pro_Alambre'=>$row['Pro_Alambre'],
                    'Pro_Fundente'=>$row['Pro_Fundente'],
                    'Pro_OrdenTrabajo'=>$row['Pro_OrdenTrabajo'],
                    'Pro_Especificacion'=>$row['Pro_Especificacion'],
                    'Pro_wps'=>$row['Pro_WPS']
                ];
            }//end while
            return $datos;
        }//end if
    }//end read_usuarios
    
    public static function Leer_proyecto($id_proyecto) {
        $conexion_db =new Conexion();
        $query = "SELECT *FROM  proyectos WHERE Pro_ID=$id_proyecto";
        $resultado = $conexion_db->query($query);
        $datos = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos[]=[
                    'Pro_Nombre'=>$row['Pro_Nombre'],
                    'Pro_Diametro'=>$row['Pro_Diametro'],
                    'Pro_Espesor'=>$row['Pro_Espesor'],
                    'Pro_Alambre'=>$row['Pro_Alambre'],
                    'Pro_Fundente'=>$row['Pro_Fundente'],
                    'Pro_OrdenTrabajo'=>$row['Pro_OrdenTrabajo'],
                    'Pro_Especificacion'=>$row['Pro_Especificacion'],
                    'Pro_WPS'=>$row['Pro_WPS']
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