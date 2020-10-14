<?php
		$modulo = "Solicitude";
		$_modulo = strtolower($modulo);
		$tabla = "mdl_course";
		$contextlevel = 50;	
		if($USUARIO->id){
			$accionBCN = formData("accion{$_modulo}","post","Mostrar{$modulo}s");

			if ($accionBCN=="Guardar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";

				$id = formData("idcurso","post",0);
				$category = formData("category","post","");
				$fullname = utf8_decode(formData("fullname","post",""));
				$shortname = formData("shortname","post","");
				
				$summary = formData("summary","post","");
				$visible = formData("visible","post","");
			
			
				if (serialValido()){
					$time = time();

					$campos = array(

						"id" => $id,
						"category" => $category,
						"fullname" => $fullname,
						"shortname" => $shortname,
						"summary" => $summary,
						"visible" => $visible,
											
                    ); 
					$duplicidad = array("shortname" => $shortname);
					if ($id==0){
						//Se comprueba si existe un usuario con el mismo username
						if (!$CONBCN->existe($tabla,$duplicidad)){
							//Se inserta los datos del Usuario
							if ($CONBCN->insertar($tabla,$campos)){
								$id = $CONBCN->ultimo_id;
								
								mensajeHecho($modulo."s","","a");	
							} else { 
								mensajeError($modulo."s"); 
							}
						} else {
							mensajeExiste($modulo."s");
						}
					} else {
						$where = array("id" => $id);
						if (!$CONBCN->existe($tabla,$duplicidad,$where)){
							//Se actualizan los datos del usuario
							if ($CONBCN->actualizar($tabla,$campos,$where)){

								mensajeHecho($modulo."s","actualizar","a");	
							} else {
								mensajeError($modulo."s","actualizar"); 
							}
						} else {
							mensajeExiste($modulo."s");
						}
					}
				} else { mensajeDuplicidad(); }
			}
			if ($accionBCN=="Eliminar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$id = formData("idmatricula","post",0);
				if (serialValido()){
					$where = array("id" => $id);

				
					// Se eleimina el usuario
					if ($CONBCN->eliminar($tabla,$where)){
						mensajeHecho($modulo."s","eliminar","a");	
					} else {
						mensajeError($modulo."s","eliminar"); 
					}

				} else { mensajeDuplicidad(); }
			}
		}
?>