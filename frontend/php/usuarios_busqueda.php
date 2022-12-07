<?php
//* Initialize the session
session_start();
 
//todo Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["S_usuario_conectado"]) || $_SESSION["S_usuario_conectado"] !== true){
    header("location: ../index.html");
    exit;
}
?>

<!DOCTYPE html>
<html>
<?php include('conexion_db_2.php');
      //include('conexion_db.php');?>

<head>
    <title>BUSQUEDA</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/busqueda/tabla_filtros_combos.js"></script>
    <script src="../js/busqueda/combo_seleccion.js"></script>
    <script src="../js/busqueda/input_busqueda.js"></script>
    <script src="../js/busqueda/descargar_reporte.js"></script>
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Raleway", Arial, Helvetica, sans-serif
        }

        .mySlides {
            display: none
        }
    </style>
</head>

<body class="w3-container w3-border-left w3-border-right">

    <!-- Sidebar/menu  para las opciones de busqueda
        cada que se presiona aguna opcion la tabla se actualiza-->
    <nav class="w3-sidebar w3-light-grey w3-collapse w3-top" style="z-index:3;width:300px" id="mySidebar">
        <div class="w3-container w3-display-container w3-padding-16">
            <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-transparent w3-display-topright"></i>
            <a href="../php/opciones_paginas.php" class="w3-center">
                <img src="../img/logo-1.png" class="w3-animate-top" style="width:20%">
            </a>
            <h3>BUSQUEDA <i class="fa fa-search w3-xlarge"></i></h3>
            <hr>
            <div>
                <p><label><i class="fa fa-book"></i> PROYECTO</label></p>
                <select onchange="combo_proyectos()" id="proyectos">
                    <option selected>SELECCIONE UNO</option>
                    <?php //esta parte fue en en php para cargar en la tabla la tuberia que coincida
                          //con el poroyecto seleccionado.
                      foreach ($conn->query('SELECT Pro_ID,Pro_OrdenTrabajo from proyectos') as $row) { ?>
                        <option><?php echo $row['Pro_ID'] ." ".$row['Pro_OrdenTrabajo']  ?></option>
                        <?php
                    }
                    ?>
                <!-- Cada una de las siguientes consultas se hacen en script con lenjuaje JS
                     , cada un ira cargando en las opciones de busqueda segun la opcion seleccionada-->
                </select>
                <p><label><i class="fa fa-object-group"></i> SOLDADURA</label></p>
                <select onchange="combo_soldadura()" id="soldadura">
                    <option selected>SELECCIONE UNO</option>
                    <option>INTERNA</option>
                    <option>EXTERNA</option>
                </select>
                <p><label><i class="fa fa-object-ungroup"></i> MAQUINA</label></p>
                <select onchange="combo_maquina()" id="maquina">
                    <option selected>SELECCIONE UNO</option>
                    <!-- aqui van las amquinas externas o internas despues de seleccionarlas -->
                </select>
            </div>
            <!-- Se mostraran la tuberia regitrrada en la fcha escrita en formato dd/MM/yyyy-->
            <p><label><i class="fa fa-calendar-check-o"></i> FECHA</label></p>
            <div class="w3-row">
                <div class="w3-col s9 w3-center"><input class="w3-input w3-border" type="text" placeholder="dd/MM/yyyy" id="fecha" name="fecha"></div>
                <div class="w3-col s3 w3-center"><button onclick="fecha_busqueda()" type="button" class="w3-button w3-white w3-border w3-border-blue">buscar</button></div>
            </div>
            
        </div>
        <div class="w3-container w3-display-container w3-padding-16 w3-border-top w3-border-bottom">
            <!-- Mostrara los datos de la tuberia con la ID escrita -->
            <p><label><i class="fa fa-sticky-note-o"></i> ID DE TUBO</label></p>
            <div class="w3-row">
                <div class="w3-col s9 w3-center"><input class="w3-input w3-border" type="text" placeholder="xxxxx" id="no_tubo" name="no_tubo"></div>
                <div class="w3-col s3 w3-center"><button onclick="no_tubo_busqueda()" type="button" class="w3-button w3-white w3-border w3-border-blue">buscar</button></div>
            </div>
        </div>
        <div class="w3-bar-block">
            <button class="w3-bar-item w3-button w3-padding-16" onclick="document.getElementById('mensaje').style.display='block'"><i class="fa fa-rss"></i> REPORTE</button>
            <a onclick="document.getElementById('info').style.display='block'" href="#" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-envelope"></i> INFORMACION</a>
        </div>
    </nav>

    <!-- Top menu on small screens -->
    <header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
        <span class="w3-bar-item">TUBERIA</span>
        <a href="javascript:void(0)" class="w3-right w3-bar-item w3-button" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main w3-white" style="margin-left:300px">

        <!-- Push down content on small screens -->
        <div class="w3-hide-large" style="margin-top:80px"></div>
        <div class="w3-container w3-border-top w3-border-bottom w3-padding">
            <br>
            <h4 class="w3-center"><b>TABLAS DE SOLDADURA INTERNA</b></h4>
            <br>
        </div>
        
        <section id="INTERNAS" class="w3-pa
        dding">
            <!--todo contenedor de tablas internas-->

        </section>

        <div class="w3-container w3-border-top w3-border-bottom w3-padding">
            <br>
            <h4 class="w3-center"><b>TABLAS DE SOLDADURA EXTERNA</b></h4>
            <br>
        </div>
        
        <section id="EXTERNAS" class="w3-padding">
            <!--todo contenedor de tablas exernas-->

        </section>

        <footer class="w3-container w3-padding-16" style="margin-top:32px">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></footer>

        <!-- End page content -->
    </div>

    <!-- Ventana Modal, esta ventana emergente sirve para descargar los reportes de tuberia
         , seleccionado de que area de soldadura y la ID del tubo-->
    <div id="mensaje" class="w3-modal">
        <div class="w3-modal-content w3-animate-zoom w3-padding-large">
            <div class="w3-container w3-white w3-center">
                <i onclick="document.getElementById('mensaje').style.display='none'" class="fa fa-remove w3-button w3-xlarge w3-right w3-transparent"></i>
                <h2 class="w3-wide">DESCARGAR REPORTE</h2>
                <p>SOLDADURA</p>
                <select id="reporte_soldadura">
                    <option selected>SELECCIONE UNO</option>
                    <option>INTERNA</option>
                    <option>EXTERNA</option>
                </select>
                <p>ESCRIBE ID DE TUBO</p>
                <p><input id="reporte_tubo" class="w3-input w3-border" type="text" placeholder="XXXXXXXXX"></p>
                <button type="button" class="w3-button w3-padding-large w3-green w3-margin-bottom" onclick="descarga()">BUSCAR</button>
            </div>
            <p id="link_descarga_reporte" class="w3-large w3-center"></p>
            <p id="link_descarga_reporte2" class="w3-large w3-center"></p>
        </div>
    </div>

     <!--ventana modal de Informacion de la pagina y sistema-->
    <div id="info" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
            <div class="w3-center"><br>
                <span onclick="document.getElementById('info').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">x</span>
            </div>
            <br>
            <div class="w3-contanier w3-center">
                <h2>INFORMACION</h2>
                <i class="fa fa-database" style="width:30px"></i> Sistema SADS<br>
                <i class="fa fa-folder-open" style="width:30px"></i>Pagina para busqueda de tuberia<br>
                <i class="fa fa-gear" style="width:30px"> </i> Version 1.2.0<br>
                <p>Detalles reportalos en el departamento de mantenimiento.</p>
            </div>
            <br>
        </div>
  </div>
</body>

<script>
        // Script to open and close sidebar when on tablets and phones
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("myOverlay").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("myOverlay").style.display = "none";
        }

        // Slideshow Apartment Images
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function currentDiv(n) {
            showDivs(slideIndex = n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            //var dots = document.getElementsByClassName("demo");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                //dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
            }
            x[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " w3-opacity-off";
        }
    </script>
</html>