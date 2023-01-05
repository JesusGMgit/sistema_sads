<?php
 
require_once "../clases/clase_conexion.php";


class soldadura_interna{
    
    

    public static function crear_registro_tuberia_interna($tuberia_in123,$Tin_ID_tubo,$Tin_No_tubo,$Tin_No_placa,
                                                          $Tin_ID_proyecto,$Tin_Lote_alambre,$Tin_Lote_fundente,
                                                          $Tin_FolioOperador,$Tin_Fecha,$Tin_Hora,$Tin_hora_db,
                                                          $Tin_Archivos_excel,$Tin_Observaciones) {
        $conexion_db =new Conexion();
        $query = "INSERT INTO " . $tuberia_in123 . " (Tin_ID_tubo,Tin_No_tubo,Tin_No_placa,Tin_ID_proyecto,Tin_Lote_alambre,
                                                      Tin_Lote_fundente,Tin_FolioOperador,Tin_Fecha,Tin_Hora,Tin_hora_db,
                                                      Tin_Archivos_excel,Tin_Observaciones)
        VALUES ('$Tin_ID_tubo', '$Tin_No_tubo', '$Tin_No_placa', '$Tin_ID_proyecto','$Tin_Lote_alambre',
                '$Tin_Lote_fundente','$Tin_FolioOperador','$Tin_Fecha','$Tin_Hora','$Tin_hora_db','$Tin_Archivos_excel',
                '$Tin_Observaciones')";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end create_usuario

    public static function actualizar_RID_tubo($tuberia_in123,$ID, $RID){
        $conexion_db=new Conexion();
        $query="UPDATE " . $tuberia_in123 . " SET Tin_ID_Rtubo='".$RID."' WHERE Tin_ID_tubo=\"" . $ID . "\"";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;

    }

    //Funciones por busqueda para de registros

    public static function Leer_registros_interna_proyecto($tuberia_in123,$ID_proyecto,){
        
    }

    public static function Leer_tuberia_interna($tuberia_in123){
        $conexion_db =new Conexion();
        $query = "SELECT *FROM ". $tuberia_in123;
        //echo "request: " . $query;
        
        $resultado = $conexion_db->query($query);
        
        $datos_in = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos_in[]=[
                    'Tin_ID_tubo'=>$row['Tin_ID_tubo'],
                    'Tin_No_tubo'=>$row['Tin_No_tubo'],
                    'Tin_No_placa'=>$row['Tin_No_placa'],
                    'Tin_ID_proyecto'=>$row['Tin_ID_proyecto'],
                    'Tin_Lote_alambre'=>$row['Tin_Lote_alambre'],
                    'Tin_Lote_fundente'=>$row['Tin_Lote_fundente'],
                    'Tin_FolioOperador'=>$row['Tin_FolioOperador'],
                    'Tin_Fecha'=>$row['Tin_Fecha'],
                    'Tin_Hora'=>$row['Tin_Hora'],
                    'Tin_Hora_db'=>$row['Tin_Hora_db'],
                    'Tin_Archivos_excel'=>$row['Tin_Archivos_excel'],
                    'Tin_Observaciones'=>$row['Tin_Observaciones']
                ];
                
            }//end while
            return $datos_in;
            
        }//end if
        
    }//end read_usuarios
    
    public static function Leer_tubo_interna($tuberia_in123,$ID_tubo) {
        $conexion_db =new Conexion();
        $query = "SELECT *FROM ".  $tuberia_in123." WHERE Tin_ID_tubo=\"" . $ID_tubo . "\"";
        $resultado = $conexion_db->query($query);
        $datos_in = [];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos_in[]=[
                    'Tin_ID_tubo'=>$row['Tin_ID_tubo'],
                    'Tin_No_tubo'=>$row['Tin_No_tubo'],
                    'Tin_No_placa'=>$row['Tin_No_placa'],
                    'Tin_ID_proyecto'=>$row['Tin_ID_proyecto'],
                    'Tin_Lote_alambre'=>$row['Tin_Lote_alambre'],
                    'Tin_Lote_fundente'=>$row['Tin_Lote_fundente'],
                    'Tin_FolioOperador'=>$row['Tin_FolioOperador'],
                    'Tin_Fecha'=>$row['Tin_Fecha'],
                    'Tin_Hora'=>$row['Tin_Hora'],
                    'Tin_Hora_db'=>$row['Tin_Hora_db'],
                    'Tin_Archivos_excel'=>$row['Tin_Archivos_excel'],
                    'Tin_Observaciones'=>$row['Tin_Observaciones']
                ];
            }//end while
            return $datos_in;
        }//end if
    }//end read_usuario

    public static function actualizar_tubo_interna($tuberia_in123,$Tin_ID_tubo,$Tin_No_tubo,$Tin_No_placa,
                                               $Tin_ID_proyecto,$Tin_Lote_alambre,$Tin_Lote_fundente,
                                               $Tin_FolioOperador,$Tin_Fecha,$Tin_Hora,$Tin_Hora_db,
                                               $Tin_Archivos_excel,$Tin_Observaciones) {
        $conexion_db = new Conexion();
        $query = "UPDATE " .$tuberia_in123. " SET 
                    Tin_No_tubo='" . $Tin_No_tubo . "', Tin_No_placa='" . $Tin_No_placa . 
                    "', Tin_ID_proyecto='" . $Tin_ID_proyecto . "', Tin_Lote_alambre='" . $Tin_Lote_alambre . "', Tin_Lote_fundente='" . $Tin_Lote_fundente .
                    "', Tin_FolioOperador='" . $Tin_FolioOperador . "', Tin_Fecha='" . $Tin_Fecha . "', Tin_Hora='".$Tin_Hora .
                    "', Tin_Hora_db='" . $Tin_Hora_db . "', Tin_Archivos_excel='" . $Tin_Archivos_excel . "', Tin_Observaciones='" . $Tin_Observaciones .
                    "' WHERE Tin_ID_tubo=\"" . $Tin_ID_tubo . "\"";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end update_usuario

    public static function borrar_tubo_interna($tuberia_in123,$ID_tubo) {
        $conexion_db = new Conexion();
        $query = "DELETE FROM " . $tuberia_in123 . " WHERE Pro_ID=\"" . $ID_tubo . "\"";
        $conexion_db->query($query);
        if($conexion_db->affected_rows) {
            return TRUE;
        }//end if
        return FALSE;
    }//end delete_usuario

}
?>