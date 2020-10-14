<?php
// Sesion de Mensaje
if (empty($_SESSION["BCN_MENSAJE"])){	
	$_SESSION["BCN_MENSAJE"] = array ("TEXTO" => "", "TEXTO2" => "", "NOTA" => "", "TIPO" => "INFO", "DURACION" => "4000");
} 

$MENSAJE = new stdClass();
$MENSAJE->texto = $_SESSION["BCN_MENSAJE"]["TEXTO"];
$MENSAJE->texto_2 = $_SESSION["BCN_MENSAJE"]["TEXTO2"];
$MENSAJE->nota = $_SESSION["BCN_MENSAJE"]["NOTA"];
$MENSAJE->clase = tipoMensaje($_SESSION["BCN_MENSAJE"]["TIPO"]);
$MENSAJE->duracion = $_SESSION["BCN_MENSAJE"]["DURACION"];

?>