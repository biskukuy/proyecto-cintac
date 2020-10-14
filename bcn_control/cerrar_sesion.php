<?php
	$_SESSION["BCN_USUARIO"] = array ("ID" => 0, "NOMBRE_USUARIO" => "INVITADO", "LOGIN" => "", "PERFIL" => "", "CORREO" => "");
	$_SESSION["BCN_MENSAJE"] = array ("TEXTO" => "", "TEXTO2" => "", "NOTA" => "", "TIPO" => "INFO", "DURACION" => "4000");
	header("Location: ".$CFG->wwwroot."/login/logout.php");
?>