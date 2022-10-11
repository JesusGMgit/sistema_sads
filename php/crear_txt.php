<?php
$contenido = $_POST["contenido"]; 
$archivo = fopen('externas/archivo1.txt','a');
fputs($archivo,$contenido); 
fclose($archivo);
?>