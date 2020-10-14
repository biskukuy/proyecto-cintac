<?php
	 error_reporting(-1);
	 $mensaje = "";
	 $tipo = 1;
	 if(isset($_POST["username"])){
		$usuario = formData("username","post");
		$password = formData("passuser","post");
		if ($usuario!="" && $password!=""){
			$rs = validarUsuario($usuario, $password);
			if ($rs["ID"] > 0){
				$_SESSION["BCN_MENSAJE"] = array ("TEXTO" => "", "TEXTO2" => "", "NOTA" => "", "TIPO" => "INFO", "DURACION" => "4000");
				header("location:".$GLOBALES["path"]);
			} else {
				$mensaje[0] = $rs["MENSAJE_1"];
				$mensaje[1] = $rs["MENSAJE_2"];;				
			}
		} else {
			$mensaje[0] = "Error en Usuario y/o Password";
			$mensaje[1] = "Por favor verifique sus credenciales";				
		}
	 }

	 if(isset($_POST["correo_recupera"])){
		$correo_recupera = formData("correo_recupera","post");
		if ($correo_recupera!=""){
			$rs = validarCorreo($correo_recupera);
			if ($rs["ID"] > 0){
				$nueva_clave = genererClaveAleatoria();
				if (actualizarClave($rs["ID"],$nueva_clave)){
					$mensaje_email = '<p style="font-size:14px; font-family:Arial, Helvetica, sans-serif;">El sistema LMS Encuesta ha generado su nueva clave.</p><br><p style="font-size:14px; font-family:Arial, Helvetica, sans-serif;">Su nueva clave es: <span style="font-size:18px; font-weight:bold;">'.$nueva_clave.'</span></p><br>';
					$mensaje2 = enviarCorreo("Recuperar Clave / LMS Encuesta",$correo_recupera,$mensaje_email);
					$mensaje[0] = "Fue enviado un correo con los datos";
					$mensaje[1] = "Revise su bandeja de entrada o su carpeta de spam";	
					 $tipo = 2;			
				} else {
					$mensaje[0] = "No se puedo enviar su clave";
					$mensaje[1] = "Por favor intente de nuevo";				
				}
			} else {
				$mensaje[0] = $rs["MENSAJE_1"];
				$mensaje[1] = $rs["MENSAJE_2"];;				
			}
		} else {
			$mensaje[0] = "Debe Ingresar un correo";
			$mensaje[1] = "Por favor verifique los datos";				
		}
	 }

?>