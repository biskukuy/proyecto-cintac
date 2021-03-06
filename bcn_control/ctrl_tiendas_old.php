<?php
		$modulo = "Tienda";
		$_modulo = strtolower($modulo);
		$tabla = "mdl_user_cat_tienda";	
		if($USUARIO->id){
			$accionBCN = formData("accion{$_modulo}","post","Mostrar{$modulo}s");

			if ($accionBCN=="Guardar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$idtienda = formData("idtienda","post",0);
				$idcat = formData("idcat","post",0);
				$idzone = formData("idzone","post",0);
				$name = formData("name","post","");
				$visible = formData("visible","post",0);

				if (serialValido()){
					$campos = array(
							"idtienda" => $idtienda,
							"idcat" => $idcat,
							"idzone" => $idzone,
							"name" => $name,
							"visible" => $visible,
							"type" => 1
						); 
					$duplicidad = array("name" => $name);
					if ($idtienda==0){
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
						$where = array("idtienda" => $idtienda);
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
				$idtienda = formData("idtienda","post",0);
				if (serialValido()){
					$where = array("idtienda" => $idtienda);
					$where2 = array("department" => '$idtienda');
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
		}
?>