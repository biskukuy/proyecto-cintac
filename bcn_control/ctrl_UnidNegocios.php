<?php
		$modulo = "UnidNegocio";
		$_modulo = strtolower($modulo);
		$tabla = "bcn_unidad_negocio";
		if($USUARIO->id){
			$accionBCN = formData("accion{$_modulo}","post","Mostrar{$modulo}s");

			if ($accionBCN=="Guardar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$idunidad = formData("idunidad","post",0);
				$nombre = formData("nombre","post",0);
				$idplanta = formData("idplanta","post",0);

				$visible = formData("visible","post",0);

				if (serialValido()){
					$campos = array(
							"idunidad" => $idunidad,
							"nombre" => $nombre,
							"idplanta" => $idplanta,
							"visible" => $visible,

						);
					$duplicidad = array("nombre" => $nombre);
					if ($idunidad==0){
						if (!$CONBCN->existe($tabla,$duplicidad)){
							if ($CONBCN->insertar($tabla,$campos)){
								mensajeHecho($modulo."s");
							} else {
								mensajeError($modulo."s");
							}
						} else {
							if ($CONBCN->insertar($tabla,$campos)){
								mensajeHecho($modulo."s");
							} else {
								mensajeError($modulo."s");
							}
						}
					} else {
						$where = array("idunidad" => $idunidad);
						if (!$CONBCN->existe($tabla,$duplicidad,$where)){
							if ($CONBCN->actualizar($tabla,$campos,$where)){
								mensajeHecho($modulo."s","actualizar");
							} else {
								mensajeError($modulo."s","actualizar");
							}
						} else {
							if ($CONBCN->actualizar($tabla,$campos,$where)){
								mensajeHecho($modulo."s","actualizar");
							} else {
								mensajeError($modulo."s","actualizar");
							}
						}
					}
				} else { mensajeDuplicidad(); }
			}
			if ($accionBCN=="Eliminar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$idunidad = formData("idunidad","post",0);
				if (serialValido()){
					$where = array("idunidad" => $idunidad);
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