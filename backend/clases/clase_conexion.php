<?php
//parent::__construct("localhost","u142007641_admin_test","Adminsads14","u142007641_sads_db");
class Conexion extends mysqli {
        
    function __construct()
    {
        parent::__construct("localhost","u142007641_admin_test","Adminsads14","u142007641_sads_db"); 
        $this->set_charset('utf8');
        $this->connect_error==null ? 'conexion exitosa': die('conexion fallida');
    }//final de contructor
}//final de clase Conexion
?>