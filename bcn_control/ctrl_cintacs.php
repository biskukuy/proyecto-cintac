<?php
		$modulo = "Cintac";
		$_modulo = strtolower($modulo);
		$tabla = "bcn_solicitud_contratacion";
		//	echo "- $accionBCN)";



		if($USUARIO->id){
			$accionBCN = formData("accion{$_modulo}","post","Mostrar{$modulo}s");
			//mensajeError($modulo."s","mensaje","($accionBCN)");


			if ($accionBCN=="Guardar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$idcintac = formData("idcintac","post",0);
				$numero = formData("numero","post",0);
				$id_tipo_contratacion = formData("id_tipo_contratacion","post",0);
				$area_solicitante = formData("area_solicitante","post","");
				$id_cargo = formData("id_cargo","post",0);
				$id_planta = formData("id_planta","post",0);
				$aspectos_observaciones = formData("aspectos_observaciones","post",0);
				$estructura_renta = formData("estructura_renta","post",0);
				$solicitudes_especiales = formData("solicitudes_especiales","post",0);
				$fecha_solicitud = formData("fecha_solicitud","post",0);
				$id_usuario = formData("id_usuario","post",0);
				$marcacion = formData("marcacion","post",0);
				$horario = formData("horario","post",0);
				//mensajeError($modulo."s","mensaje"," guardar ($accionBCN)");

				if (serialValido()){
					$campos = array(
							"idcintac" => $idcintac,
							"numero" => $numero,
							"id_tipo_contratacion" => $id_tipo_contratacion,
							"area_solicitante" => $area_solicitante,
							"id_cargo" => $id_cargo,
							"id_planta" => $id_planta,
							"aspectos_observaciones" => $aspectos_observaciones,
							"estructura_renta" => $estructura_renta,
							"solicitudes_especiales" => $solicitudes_especiales,
							"fecha_solicitud" => $fecha_solicitud,
							"estatus_solicitud" => 1,
							"id_usuario" => $id_usuario,
							"marcacion" => $marcacion,
							"horario" => $horario,

						);
					$duplicidad = array("numero" => $numero);
					if ($idcintac==0){
					    //se comprueba si existe una solicitud con el mismo numero
						if (!$CONBCN->existe($tabla,$duplicidad)){
						    //se inserta la solicitud
							if ($CONBCN->insertar($tabla,$campos)){
								mensajeHecho($modulo."s");
							} else {
								mensajeError($modulo."s");
							}
						} else {
							mensajeExiste($modulo."s");
						}
					} else {
						$where = array("idcintac" => $idcintac);
						if (!$CONBCN->existe($tabla,$duplicidad,$where)){
						    //se actualizan los datos de la solicitud
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
			}//fin del caso de guardar
			if ($accionBCN=="Eliminar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$id = formData("idcintac","post",0);
				if (serialValido()){
					$where = array("idcintac" => $id);


					// Se eleimina el usuario
					if ($CONBCN->eliminar($tabla,$where)){
						mensajeHecho($modulo."s","eliminar");
					} else {
						mensajeError($modulo."s","eliminar");
					}

				} else { mensajeDuplicidad(); }
			}
			//fin del if eliminar

		}
?>