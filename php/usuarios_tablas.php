

<!DOCTYPE html>
<html>
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["S_usuario_conectado"]) || $_SESSION["S_usuario_conectado"] !== true){
    header("location: index.html");
    exit;
}
?>
<head>
    <title>TABLAS DE DATOS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <script src="../js/tablas/operadores_tabla.js"></script>
    <script src="../js/tablas/proyectos_tabla.js"></script>
    <script src="../js/tablas/externas_tabla.js"></script>
    <script src="../js/tablas/internas_tabla.js"></script>
    <script src="../js/tablas/usuarios_tabla.js"></script>
    <script src="../js/tablas/reiniciar_ventanas_modales.js"></script>
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: "Raleway", sans-serif
        }

        .w3-quarter img {
            margin-bottom: -6px;
            cursor: pointer
        }

        .w3-quarter img:hover {
            opacity: 0.6;
            transition: 0.3s
        }
    </style>  
</head>

<body class="w3-light-grey">
    
    <!-- Sidebar/menu , Menu para escoger que tabla de la base de datos sera mostrada-->
    <nav class="w3-sidebar w3-bar-block w3-black w3-animate-right w3-top w3-text-light-grey w3-large"
        style="z-index:3;width:250px;font-weight:bold;display:none;right:0;" id="mySidebar">
        <a href="javascript:void()" onclick="w3_close()" class="w3-bar-item w3-button w3-center w3-padding-32">CLOSE</a>
        <a href="#" onclick="Cargar_plantilla_proyectos()" class="w3-bar-item w3-button w3-center w3-padding-16">PROYECTO</a>
        <a href="#" onclick="Cargar_plantilla_operadores()" class="w3-bar-item w3-button w3-center w3-padding-16">OPERADORES</a>
        <a href="#" onclick="Cargar_plantilla_usuarios()" class="w3-bar-item w3-button w3-center w3-padding-16">USUARIOS</a>
        <a href="#" onclick="Cargar_plantilla_soldadura_externa()" class="w3-bar-item w3-button w3-center w3-padding-16">TUBERIA EXTERNA</a>
        <a href="#" onclick="Cargar_plantilla_soldadura_interna()" class="w3-bar-item w3-button w3-center w3-padding-16">TUBERIA INTERNA</a>
        <p id="usuario_activo" class="w3-small w3-center">bienvenid@ <?php echo $_SESSION['S_usuario']; ?></p>
        <p id="usuario_nivel" class="w3-small w3-center"><?php echo $_SESSION['S_nivel']; ?></p>
    </nav>

    <!-- Top menu on small screens -->
    <header class="w3-container w3-top w3-white w3-xlarge w3-padding">
        <a href="../php/opciones_paginas.php" class="w3-center w3-button">
            <img src="../img/logo-1.png" class="w3-animate-top" style="width:20%">
        </a>
        <span class="w3-center">BASE DE DATOS</span>
        <a href="javascript:void(0)" class="w3-right w3-button w3-white" onclick="w3_open()">☰</a>
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu"
        id="myOverlay">
    </div>

     <!-- !PAGE CONTENT! -->
     <div class="w3-main w3-content" style="max-width:1600px;margin-top:83px">
        
        <div class="w3-container w3-light-grey w3-padding-32 w3-padding-large" id="Contenido">
            <div class="w3-content" id="area_tabla">
                <h4 id="titulo" class="w3-center"><b>TABLA</b></h4>
                <!-- Esta sera la etiqueta donde se desplegara la tabla-->
                <table class="w3-table-all ">
                    <thead id="cabeceras">
                        
                    </thead>
                    <tbody id="datos_tabla">
                        <!--datos de la tabla buscados-->
                    </tbody>
                    <tbody id="datos_tabla1">

                    </tbody>
                </table>
                <hr>
                <!-- Opciones de para editar la tabla segun el nivel de usurio-->
                <button onclick="document.getElementById('m_op1').style.display='block'" class="w3-bar-item w3-button w3-padding" style="width:32% !important">AGREGAR</button>
                <?php
                    if($_SESSION['S_nivel']=='AVANZADO' || $_SESSION['S_nivel']=='ADMIN'){ 
                ?>
                <button onclick="document.getElementById('m_op2').style.display='block'" class="w3-bar-item w3-button w3-padding" style="width:33% !important">ACTUALIZAR</button>
                <?php
                        if($_SESSION['S_nivel']=='ADMIN'){ 
                ?>
                <button onclick="document.getElementById('m_op3').style.display='block'"class="w3-bar-item w3-button w3-padding" style="width:32% !important">ELIMINAR</button>
                <?php
                        } 
                    }
                ?>
            </div>
        </div>
        
        <!--Agregar nuevo registro a la tabla-->
        <div id="m_op1" class="w3-modal">
            <div class="w3-modal-content w3-animate-zoom">
                <div class="w3-container w3-black">
                    <span id="xa" onclick="reiniciar('xa')" class="w3-button w3-display-topright w3-large">x</span>
                    <p>AGREGAR NUEVO REGISTRO</p>
                </div>
                <div id="formulario_agregar" class="w3-container">
                    
                </div>
            </div>
        </div>
        <!--Actualizar algun registro en la tabla-->
        <div id="m_op2" class="w3-modal">
            <div class="w3-modal-content w3-animate-zoom">
                <div class="w3-container w3-black">
                    <span id="xr" onclick="reiniciar('xr')" class="w3-button w3-display-topright w3-large">x</span>
                    <p>ACTUALIZAR REGISTRO</p>
                    
                    <div id="busqueda_id" class="w3-section">
                        
                    </div>
                    <div id="formulario_actualizar" class="w3-container">
                    
                    </div>
                
                </div>
                
            </div>
        </div>
        <!--Eliminar algun registro en la tabla-->
        <div id="m_op3" class="w3-modal">
            <div class="w3-modal-content w3-animate-zoom">
                <div class="w3-container w3-black">
                    <span id="xe" onclick="reiniciar('xe')" class="w3-button w3-display-topright w3-large">x</span>
                    <p>ELIMINAR REGISTRO</p>
                    
                    <div id="b_borrar_id" class="w3-section">
                        
                    </div>
                    <p id="mensaje_eliminar"></p>
                
                </div>
                
            </div>
        </div>
        <hr>
     <!-- Footer -->
    <footer class="w3-black w3-center w3-padding-24">
        <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp"
        title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a>
        </p>
    </footer>
</body>
<script>
        // Script to open and close sidebar
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("myOverlay").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("myOverlay").style.display = "none";
        }

        // Modal Image Gallery
        function onClick(element) {
            document.getElementById("img01").src = element.src;
            document.getElementById("modal01").style.display = "block";
            var captionText = document.getElementById("caption");
            captionText.innerHTML = element.alt;
        }

    </script>
</html>