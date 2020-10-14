<?php
		$modulo = "Clave";
		$_modulo = strtolower($modulo);
		$tabla = "lms_usuarios";	
		if($USUARIO->id){
			$accionBCN = formData("accion{$_modulo}","post","");

			if ($accionBCN=="Guardar{$modulo}"){
				$idusuario = $USUARIO->id;
				$usuario = formData("usuario","post","");
				$password = formData("password","post","");
				$password_new = formData("password_new","post","");

				if (serialValido()){
					$password = crypt($password,$GLOBALES["char_crypt"]);
					$password_new = crypt($password_new,$GLOBALES["char_crypt"]);
					
					$duplicidad = array("usuario" => $usuario, "password" => $password);
					$campos = array("password" => $password_new);
					$where = array("idusuario" => $idusuario);
					
					if ($CONBCN->existe($tabla,$duplicidad)){
						if ($CONBCN->actualizar($tabla,$campos,$where)){
							mensajePersonalizado("HECHO","Clave actualizada exitosamente");	
						} else {
							mensajeError($modulo,"actualizar"); 
						}
					} else {
						mensajePersonalizado("ERROR","Clave actual incorrecta."," Por favor intente de nuevo");
					}
				} else { mensajeDuplicidad(); }
			}
		}
?>