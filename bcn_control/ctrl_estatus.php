<?php
		$modulo = "Estatu";
		$_modulo = strtolower($modulo);
		$tabla = "bcn_solicitud_contratacion";
		if($USUARIO->id){
			$accionBCN = formData("accion{$_modulo}","post","Mostrar{$modulo}s");

			if ($accionBCN=="Guardar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$idcintac = formData("idcintac","post",0);
				$estatus_1 = formData("estatus_1","post",0);
				$estatus_2 = formData("estatus_2","post",0);
				$estatus_3 = formData("estatus_3","post",0);
				$estatus_4 = formData("estatus_4","post",0);
				$fecha_1 = formData("fecha_1","post",0);
				$fecha_2 = formData("fecha_2","post",0);
				$fecha_3 = formData("fecha_3","post",0);
				$fecha_4 = formData("fecha_4","post",0);

				$estatus_solicitud = formData("estatus_solicitud","post",0);
				$id_jefe_x = formData("id_usuario","post",0);






				if (serialValido()){
					$campos = array(

							"estatus_1" => $estatus_1,
							"estatus_2" => $estatus_2,
							"estatus_3" => $estatus_3,
							"estatus_4" => $estatus_4,

							"fecha_1" => $fecha_1,
							"fecha_2" => $fecha_2,
							"fecha_3" => $fecha_3,
							"fecha_4" => $fecha_4,

							"fecha_1" => $fecha_1,
							"fecha_2" => $fecha_2,
							"fecha_3" => $fecha_3,
							"fecha_4" => $fecha_4,

							"id_jefe" => $id_jefe_x,
							"id_subgerente_area" => $id_jefe_x,
							"id_gerente" => $id_jefe_x,
							"id_subgerente_persona" => $id_jefe_x,
							"estatus_solicitud" => $estatus_solicitud
						);
			//dependiendo del tipo de usuario se debe verificar que haya escogido una opcion entre
			//		0: reprobar y
			//		1: aprobar
					if(($estatus_1==-1 && $estatus_solicitud==1) || ($estatus_2==-1 && $estatus_solicitud==2)|| ($estatus_3==-1 && $estatus_solicitud==3) || ($estatus_4==-1 && $estatus_solicitud==4))
					  mensajeError($modulo."s","Error","Debe Aprobar o Rechazar la solicitud $id_jefe_x");
					// mensajeError($modulo."s","Error","esta: $estatus_solicitud  1:$estatus_1 2:$estatus_2 3:$estatus_3 4:$estatus_4 ");
					else {

						if($estatus_1!=-1 && $estatus_solicitud==1){
							$where = array("idcintac" => $idcintac);
							$campos["estatus_solicitud"]=2;
							unset($campos["fecha_2"]);
							unset($campos["fecha_3"]);
							unset($campos["fecha_4"]);
							unset($campos["id_subgerente_area"]);
							unset($campos["id_gerente"]);
							unset($campos["id_subgerente_persona"]);

							unset($campos["estatus_2"]);
							unset($campos["estatus_3"]);
							unset($campos["estatus_4"]);



							if ($CONBCN->actualizar($tabla,$campos,$where)){
									mensajeHecho($modulo."s","actualizar");
								} else {
									mensajeError($modulo."s","actualizar");
								}

						}//fin del si de estatus 1
						if($estatus_2!=-1 && $estatus_solicitud==2){
							$where = array("idcintac" => $idcintac);
							$campos["estatus_solicitud"]=3;
							unset($campos["fecha_1"]);
							unset($campos["fecha_3"]);
							unset($campos["fecha_4"]);
							unset($campos["estatus_1"]);
							unset($campos["estatus_3"]);
							unset($campos["estatus_4"]);
							unset($campos["id_jefe"]);
							unset($campos["id_gerente"]);
							unset($campos["id_subgerente_persona"]);


							if ($CONBCN->actualizar($tabla,$campos,$where)){
									mensajeHecho($modulo."s","actualizar");
								} else {
									mensajeError($modulo."s","actualizar");
								}

						}//fin del si de estatus 2
						if($estatus_3!=-1 && $estatus_solicitud==3){
							$where = array("idcintac" => $idcintac);
							$campos["estatus_solicitud"]=4;
							unset($campos["fecha_1"]);
							unset($campos["fecha_2"]);
							unset($campos["fecha_4"]);
							unset($campos["estatus_1"]);
							unset($campos["estatus_2"]);
							unset($campos["estatus_4"]);
							unset($campos["id_jefe"]);
							unset($campos["id_subgerente_area"]);
							unset($campos["id_subgerente_persona"]);


							if ($CONBCN->actualizar($tabla,$campos,$where)){
									mensajeHecho($modulo."s","actualizar");
								} else {
									mensajeError($modulo."s","actualizar");
								}

						}//fin del si de estatus 3
						if($estatus_4!=-1 && $estatus_solicitud==4){
							$where = array("idcintac" => $idcintac);
							$campos["estatus_solicitud"]=5;
							unset($campos["fecha_1"]);
							unset($campos["fecha_2"]);
							unset($campos["fecha_3"]);
							unset($campos["estatus_1"]);
							unset($campos["estatus_2"]);
							unset($campos["estatus_3"]);
							unset($campos["id_jefe"]);
							unset($campos["id_gerente"]);
							unset($campos["id_subgerente_area"]);


							if ($CONBCN->actualizar($tabla,$campos,$where)){
									mensajeHecho($modulo."s","actualizar");
								} else {
									mensajeError($modulo."s","actualizar");
								}

						}//fin del si de estatus 3


					}



				} // el if del serial
			}//el fin de guardar



		}//fin del id usuario
?>