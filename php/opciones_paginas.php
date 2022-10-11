<?php
// Initialize the session
//checar si hay alguna sesion abierta , en caso que no haya un usuario "logeado" se
//mandara a la apgina de inicio de sesion.
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["S_usuario_conectado"]) || $_SESSION["S_usuario_conectado"] !== true){
    header("location: ../index.html");
    exit;
}
?>


<!DOCTYPE html>
<html>
<title>SADS TUBACERO</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/pagina_principal.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<body>

<div class="bgimg w3-display-container w3-animate-opacity">
  <div class="w3-display-topleft w3-padding-large w3-xlarge">
    <img src="img/fenix.ico" style="width:10%; vertical-align: middle;">
  </div>

  <div class="w3-display-middle">
    <p class="w3-center"><img src="../img/logo-1.png" class="w3-animate-top" style="width:40%"></p>
    <h1 class="w3-xxlarge w3-animate-top w3-text-white w3-center">SADS</h1>
    <p class="w3-small w3-center">Sistema de Adquisición de Datos de Soldadura</p>
    <p class="w3-small w3-center">bienvenid@ <?php echo $_SESSION['S_usuario']; ?></p>
    <div class="w3-modal-content w3-card-4 w3-light-blue w3-text-white" style="max-width:400px">
      <header class="w3-container w3-light-gray">
        <p class="w3-text-black w3-large w3-center">OPCIONES</p>
      </header>
      
      <p class="w3-center"><button onclick="window.location.href='usuarios_busqueda.php'" class="w3-large w3-button w3-block  w3-center">BUSQUEDA DE TUBERIA</button></p>
      <?php 
        if($_SESSION['S_nivel']=='INTERMEDIO'||$_SESSION['S_nivel']=='AVANZADO' || $_SESSION['S_nivel']=='ADMIN'){
      ?>
        <?php 
            if($_SESSION['S_nivel']=='AVANZADO' || $_SESSION['S_nivel']=='ADMIN'){
        ?>
              <p class="w3-center"><button onclick="window.location.href='usuarios_tablas.php'" class="w3-large w3-button w3-block  w3-center">ADMINISTRAR DATOS DB</button></p>
        <?php 
            }
        ?>
        <?php 
            if($_SESSION['S_usuario']=='MTTO'|| $_SESSION['S_nivel']=='ADMIN'){
        ?>
              <p class="w3-center"><button onclick="window.location.href='../app_operador/publish.htm'" class="w3-large w3-button w3-block  w3-center">APP OPERADOR</button></p>
              <p class="w3-center"><button onclick="window.location.href='archivos_mtto.php'" class="w3-large w3-button w3-block  w3-center">ARCHIVOS MTTO</button></p>
              <p class="w3-center"><button onclick="window.location.href='../pruebas_api.html'" class="w3-large w3-button w3-block  w3-center">PRUEBAS API</button></p>
        <?php 
            }
          }  
        ?>
      <p class="w3-center"><button onclick="window.location.href='php/usuario_logout.php'" class="w3-large w3-button w3-block  w3-center">CERRAR SESION</button></p>
      <br>
    </div>
  </div>


  <!-- Footer -->
  <footer class="w3-display-bottomleft w3-padding-large">
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>
</div>
</body>
</html>
