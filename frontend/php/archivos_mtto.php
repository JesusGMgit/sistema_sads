<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["S_usuario_conectado"]) || $_SESSION["S_usuario_conectado"] !== true){
    header("location: index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Archivos MTTO</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style> 
        html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
        .w3-sidebar{
            z-index: 3;
            width:250px;
            top:43px;
            bottom: 0;
            height: inherit;

        }
    </style> 
</head>
<body>
    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
            <a href="../opciones_paginas.php"  class="w3-bar-item w3-button w3-theme-l1">
                <img src="../img/logo-1.png" class="w3-animate-top" style="width:20%">
            </a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">opcion1</a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">opcion2</a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">opcion3</a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">opcion4</a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">opcion5</a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">opcion6</a>
        </div>
    </div>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
    
    <!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
    <div class="w3-main" style="margin-left:250px">

        <div class="w3-row w3-padding-64">
            <div class="w3-twothird w3-container">
                <h1 class="w3-text-teal">Heading</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum
                    dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="w3-third w3-container">
                <p class="w3-border w3-padding-large w3-padding-32 w3-center">AD</p>
                <p class="w3-border w3-padding-large w3-padding-64 w3-center">AD</p>
            </div>
        </div>

        <div class="w3-row">
            <div class="w3-twothird w3-container">
                <h1 class="w3-text-teal">Heading</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum
                    dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="w3-third w3-container">
                <p class="w3-border w3-padding-large w3-padding-32 w3-center">AD</p>
                <p class="w3-border w3-padding-large w3-padding-64 w3-center">AD</p>
            </div>
        </div>

        <div class="w3-row w3-padding-64">
            <div class="w3-twothird w3-container">
                <h1 class="w3-text-teal">Heading</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum
                dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="w3-third w3-container">
                <p class="w3-border w3-padding-large w3-padding-32 w3-center">AD</p>
                <p class="w3-border w3-padding-large w3-padding-64 w3-center">AD</p>
            </div>
        </div>
    
        <footer id="myFooter">
            <div class="w3-container w3-theme-l2 w3-padding-32">
                <h4>Footer</h4>
            </div>

            <div class="w3-container w3-theme-l1">
                <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
            </div>
        </footer>
    </div>
<!-- END MAIN -->
</body>
</html>