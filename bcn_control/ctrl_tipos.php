<?php
		$modulo = "Tipo";
		$_modulo = strtolower($modulo);
		$tabla = "bcn_tipo_contratacion";
		if($USUARIO->id){
			$accionBCN = formData("accion{$_modulo}","post","Mostrar{$modulo}s");

			if ($accionBCN=="Guardar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$idtipo = formData("idtipo","post",0);
				$nombre = formData("nombre","post",0);
				$visible = formData("visible","post",0);

				if (serialValido()){
					$campos = array(
							"idtipo" => $idtipo,
							"nombre" => $nombre,
							"visible" => $visible,

						);
					$duplicidad = array("nombre" => $nombre);
					if ($idtipo==0){
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
						$where = array("idtipo" => $idtipo);
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
				$idcargo = formData("idtipo","post",0);
				if (serialValido()){
					$where = array("idtipo" => $idcargo);
					$where2 = array("department" => '$idtipo');
					$res = $CONBCN->seleccionar("mdl_user","*",$where2," limit 1 ");
					if ($CONBCN->nro_filas == 0){
						if ($CONBCN->eliminar($tabla,$where)){
							mensajeHecho($modulo."s","eliminar");
						} else {
							mensajeError($modulo."s","eliminar");
						}
					} else {
						mensajeError($modulo."s","eliminar","Est&aacute; siendo utilizado en una o m&aacute;s Usuarios");
					}
				} else { mensajeDuplicidad(); }
			}
			//fin del if de eliminar

		}
?>