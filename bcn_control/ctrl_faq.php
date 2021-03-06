<?php
		$modulo = "Faq";
		$_modulo = strtolower($modulo);
		$tabla = "mdl_bcn_faq";	
		if($USUARIO->id){
			$accionBCN = formData("accion{$_modulo}","post","Mostrar{$modulo}s");

			if ($accionBCN=="Guardar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$id = formData("idfaq","post",0); 
				$pregunta = formData("pregunta","post","");
				$respuesta = formData("respuesta","post","");
				$estado = formData("estado","post",0);
				$orden = formData("orden","post",0);

				if (serialValido()){
					$campos = array(
							"id" => $id,
							"pregunta" => $pregunta,
							"respuesta" => $respuesta,
							"estado" => $estado,
							"orden" => $orden,					
						); 
					$duplicidad = array("pregunta" => $pregunta);
					if ($id==0){
						if (!$CONBCN->existe($tabla,$duplicidad)){
							if ($CONBCN->insertar($tabla,$campos)){
								mensajeHecho($modulo."s");	
							} else { 
								mensajeError($modulo."s"); 
							}
						} else {
							mensajeExiste($modulo."s");
						}
					} else {
						$where = array("id" => $id);
						if (!$CONBCN->existe($tabla,$duplicidad,$where)){
							if ($CONBCN->actualizar($tabla,$campos,$where)){
								mensajeHecho($modulo."s","actualizar");	
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
				$id = formData("idfaq","post",0);
				if (serialValido()){
					$where = array("id" => $id);
					//$where2 = array("department" => '$id');
					//$res = $CONBCN->seleccionar("mdl_user","*",$where2," limit 1 ");
					//if ($CONBCN->nro_filas == 0){/*
						if ($CONBCN->eliminar($tabla,$where)){
							mensajeHecho($modulo."s","eliminar");	
						} else {
							mensajeError($modulo."s","eliminar"); 
						}
				//} else {
						//mensajeError($modulo."s","eliminar","Est&aacute; siendo utilizado en una o m&aacute;s Usuarios"); 
					//}
				} else { mensajeDuplicidad(); }
			}
		}
?>