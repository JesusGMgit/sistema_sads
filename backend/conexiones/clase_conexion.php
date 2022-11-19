<?php

class Conexion extends mysqli {
    //private $servername = "localhost";
    //private $username = "u142007641_admin_test";
    //private $password = "Adminsads14";
    //private $db = "u142007641_sads_db";

    function __construct()
    {
        parent::__construct("localhost","u142007641_admin_test","Adminsads14","u142007641_sads_db");
        $this->set_charset('utf8');
        $this->connect_error==null ? 'conexion exitosa': die('conexion fallida');
    }//final de contructor
}//final de clase Conexion
?>