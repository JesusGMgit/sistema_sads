<?php
 
require_once "../../clases/clase_conexion.php";


class soldadura_externa{
    
    

    public static function crear_registro_tuberia_externa($tuberia_ex123,$Tex_ID_tubo,$Tex_No_tubo,$Tex_No_placa,
                                                          $Tex_ID_proyecto,$Tex_Lote_alambre,$Tex_Lote_fundente,
                                                          $Tex_FolioOperador,$Tex_Fecha,$Tex_Hora,$Tex_hora_db,
                                                          $Tex_Archivos_excel,$Tex_Observaciones) {
        $conexion_db =new Conexion();
        $query = "INSERT INTO " .$tuberia_ex123. " (Tex_ID_tubo,Tex_No_tubo,Tex_No_placa,Tex_ID_proyecto,Tex_Lote_alambre,
                                         Tex_Lote_fundente,Tex_FolioOperador,Tex_Fecha,Tex_Hora,Tex_hora_db,
                                         Tex_Archivos_excel,Tex_Observaciones)
        VALUES ('$Tex_ID_tubo', '$Tex_No_tubo', '$Tex_No_placa', '$Tex_ID_proyecto','$Tex_Lote_alambre',
                '$Tex_Lote_fundente','$Tex_FolioOperador','$Tex_Fecha','$Tex_Hora','$Tex_hora_db','$Tex_Archivos_excel',
                '$Tex_Observaciones')";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end create_usuario

    public static function Leer_tuberia_externa($tuberia_ex123){
        $conexion_db =new Conexion();
        $query = "SELECT *FROM ". $tuberia_ex123;
        //echo "request: " . $query;
        /*
        $resultado = $conexion_db->query($query);
        
        $datos = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos[]=[
                    'Tex_ID_tubo'=>$row['Tex_ID_tubo'],
                    'Tex_No_tubo'=>$row['Tex_No_tubo'],
                    'Tex_No_placa'=>$row['Tex_No_placa'],
                    'Tex_ID_proyecto'=>$row['Tex_ID_proyecto'],
                    'Tex_Lote_alambre'=>$row['Tex_Lote_alambre'],
                    'Tex_Lote_fundente'=>$row['Tex_Lote_fundente'],
                    'Tex_FolioOperador'=>$row['Tex_FolioOperador'],
                    'Tex_Fecha'=>$row['Tex_Fecha'],
                    'Tex_Hora'=>$row['Tex_Hora'],
                    'Tex_Hora_db'=>$row['Tex_Hora_db'],
                    'Tex_Archivos_excel'=>$row['Tex_Archivos_excel'],
                    'Tex_Observaciones'=>$row['Tex_Observaciones']
                ];
                
            }//end while
            return $datos;
            
        }//end if
        */
        return $query;
    }//end read_usuarios
    
    public static function Leer_tubo_externa($tuberia_ex123,$ID_tubo) {
        $conexion_db =new Conexion();
        $query = "SELECT *FROM ".  $tuberia_ex123." WHERE Tex_ID=$ID_tubo";
        $resultado = $conexion_db->query($query);
        $datos = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos[]=[
                    'Tex_ID_tubo'=>$row['Tex_ID_tubo'],
                    'Tex_No_tubo'=>$row['Tex_No_tubo'],
                    'Tex_No_placa'=>$row['Tex_No_placa'],
                    'Tex_ID_proyecto'=>$row['Tex_ID_proyecto'],
                    'Tex_Lote_alambre'=>$row['Tex_Lote_alambre'],
                    'Tex_Lote_fundente'=>$row['Tex_Lote_fundente'],
                    'Tex_FolioOperador'=>$row['Tex_FolioOperador'],
                    'Tex_Fecha'=>$row['Tex_Fecha'],
                    'Tex_Hora'=>$row['Tex_Hora'],
                    'Tex_Hora_db'=>$row['Tex_Hora_db'],
                    'Tex_Archivos_excel'=>$row['Tex_Archivos_excel'],
                    'Tex_Observaciones'=>$row['Tex_Observaciones']
                ];
            }//end while
            return $datos;
        }//end if
    }//end read_usuario

    public static function actualizar_tubo_externa($tuberia_ex123,$Tex_ID_tubo,$Tex_No_tubo,$Tex_No_placa,
                                               $Tex_ID_proyecto,$Tex_Lote_alambre,$Tex_Lote_fundente,
                                               $Tex_FolioOperador,$Tex_Fecha,$Tex_Hora,$Tex_hora_db,
                                               $Tex_Archivos_excel,$Tex_Observaciones) {
        $conexion_db = new Conexion();
        $query = "UPDATE " .$tuberia_ex123. " SET 
                      Tex_No_tubo='" . $Tex_No_tubo . "', Tex_No_placa='" . $Tex_No_placa . 
                  "', Tex_ID_proyecto='" . $Tex_ID_proyecto . "', Tex_Lote_alambre='" . $Tex_Lote_alambre . "',Tex_Lote_fundente='" . $Tex_Lote_fundente .
                  "', Tex_FolioOperador='" . $Tex_FolioOperador . "',Tex_Fecha='" . $Tex_Fecha . "'Tex_Hora='".$Tex_Hora .
                  "', Tex_hora_db='" . $Tex_hora_db . "',Tex_Archivos_excel='" . $Tex_Archivos_excel . "'Tex_Observaciones='" . $Tex_Observaciones .
                  "' WHERE Tex_ID_tubo=" . $Tex_ID_tubo;
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end update_usuario

    public static function borrar_tubo_externa($tuberia_ex123,$ID_tubo) {
        $conexion_db = new Conexion();
        $query = "DELETE FROM " . $tuberia_ex123 . " WHERE Pro_ID=$ID_tubo";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end delete_usuario

}
?>