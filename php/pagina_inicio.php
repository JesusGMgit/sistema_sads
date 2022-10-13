
<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION['S_usuario_conectado'])|| !isset($_SESSION['S_usuario'])){
  $_SESSION['S_usuario']='u1';
}elseif($_SESSION['S_usuario']!=""){
  $_SESSION['S_usuario']='u2';
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>SADS TUBACERO</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/pagina_principal.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
</head>
<body>

<div class="bgimg w3-display-container w3-animate-opacity">
  <div class="w3-display-topleft w3-padding-large w3-xlarge">
    <img src="img/fenix.ico" style="width:10%; vertical-align: middle;">
  </div>

  <div class="w3-display-middle">
    <p class="w3-center"><img src="../img/logo-1.png" class="w3-animate-top" style="width:30%"></p>
    <h1 class="w3-xxlarge w3-animate-top w3-text-white w3-center">SADS</h1>
    <p class="w3-large w3-center">Sistema de Adquisición de Datos de Soldadura</p>
   
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <form class="w3-container" action="/php/usuario_log.php" method="post">
        <div class="w3-section">
          <label><b>Usuario</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Ingresa tu Usuario" name="usuario" required>
          <label><b>Contraseña</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Ingresa tu contraseña" name="contra" required>
          <button class="w3-button w3-block  w3-blue w3-section w3-padding" type="submit">Acceder</button>
        </div>
      </form>

      <div class="w3-container w3-border-top w3-light-grey">
        <span class="w3-left w3-padding w3-hide-small"><?php echo $_SESSION['S_usuario']; ?></span>
        <span class="w3-right w3-padding w3-hide-small"><button onclick="document.getElementById('id01').style.display='block'">¿Olvidaste tu contraseña?</button></span>
      </div>

    </div>
    
  </div>
</div>
  <!-- Footer -->
  <footer class="w3-display-bottomleft w3-padding-large">
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>
  <!--ventana modal de contarseña-->
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">x</span>
      </div>
      <br>
      <div class="w3-contanier w3-center">
        <p>
          La contraseña para usuarios de nivel basico es su numero de folio,
          para otro nivel de usuarios contacte con el departemento de mantenimiento.
        </p>
      </div>
      <br>
    </div>
  </div>

 




</div>
</body>
</html>
