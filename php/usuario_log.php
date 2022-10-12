<?php
//se agrega el archivo con la configuracion para hacxe conexion
//con la base  de datos.
//include('conexion_db.php');
include('conexion_db2.php');

//cuando se da iniciar sesion se checa que no esten vacios los valores 
//del formuario
$usuario = addslashes($_POST['usuario']);
$contra = addslashes($_POST['contra']);

if(empty($usuario) || empty($contra)){
    header("Location:../index.php");
    exit();
}

//se busca que el usuario exista en el base de datos
$result = "SELECT * from usuarios where Us_usuario='" . $usuario . "'";
Global $conn;
$query = $conn->query($result);
$data=$query->fetch_assoc();
//se inicializan las variables globales de inicio de sesion.
$_SESSION['S_usuario_conectado']=false;
$_SESSION['S_usuario']='NO EXISTE USUARIO';
//si el usuario esta dado de alta en el sistema
//se enviaran datos de la base de datos
if(!empty($data)){
    //se compara la contraseña que el usuario escribio en el formulario
    //con la que esta registrada en la base de datos
    if($contra==$data['Us_Contra']){
        //se iniciara sesion y se declaran varaibles globales 
        //con los datos del usuario.
        session_start();
        $_SESSION['S_usuario_conectado']=true;
        $_SESSION['S_usuario'] = $data['Us_Usuario'];
        $_SESSION['S_nivel']=$data['Us_Nivel'];
        header("Location: opciones_paginas.php");
    }else{
        //si la contraseña esta equivocada se regresa de nuevo a la pagina de inicio.
        $_SESSION['S_usuario']='CONTRASEÑA NO VALIDA';
        header("Location:../index.php");
        exit;
    }
}else{
    //si no hay datos del usuario en la base de datos se regresa a la pagina de inicio.
    header("Location:../index.php");
    exit;
}


?>