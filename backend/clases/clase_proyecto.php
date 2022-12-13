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
                    'Pro_ID'=>$row['Pro_ID'],
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
                    'Pro_ID'=>$row['Pro_ID'],
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

    public static function actualizar_proyecto($Pro_ID,$Pro_Nombre, $Pro_Diametro, $Pro_Espesor, $Pro_Alambre,
                                               $Pro_Fundente,$Pro_OrdenTrabajo,$Pro_Especificacion,$Pro_WPS) {
        $conexion_db = new Conexion();
        $query = "UPDATE proyectos SET 
                  Pro_Nombre='" . $Pro_Nombre . "', Pro_Diametro='" . $Pro_Diametro . "', Pro_Espesor='" . $Pro_Espesor . 
                  "', Pro_Alambre='" . $Pro_Alambre . "', Pro_Fundente='" . $Pro_Fundente . "',Pro_OrdenTrabajo='" . $Pro_OrdenTrabajo .
                  "', Pro_Especificacion='" . $Pro_Especificacion . "',Pro_WPS='" . $Pro_WPS .
                  "' WHERE Pro_ID=" . $Pro_ID;
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end update_usuario

    public static function borrar_proyecto($Pro_ID) {
        $conexion_db = new Conexion();
        $query = "DELETE FROM proyectos WHERE Pro_ID=$Pro_ID";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end delete_usuario

}
?>