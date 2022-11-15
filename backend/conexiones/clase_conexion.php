<?php

class Conexion extends mysqli {
    private $servername;
    private $username;
    private $password;
    private $db;

    function __construct()
    {
        parent::__construct($this->servername,$this->username,$this->password,$this->db);
        $this->set_charset('utf8');
        $this->connect_error==null ? 'conexion exitosa': die('conexion fallida');
    }//final de contructor
}//final de clase Conexion
?>