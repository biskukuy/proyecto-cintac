<?php
		include_once("lib/php/upload/class.upload.php");
		$modulo = "Recurso";
		$_modulo = strtolower($modulo);
		$tabla = "mdl_bcn_biblioteca";
		$dir_dest = "recursos/";
		if($USUARIO->id){
			$accionBCN = formData("accion{$_modulo}","post","Mostrar{$modulo}s");

			if ($accionBCN=="Guardar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$id = formData("idrecurso","post",0);
				$nombre = formData("nombre","post","");
				$categoria = formData("categoria","post","");
				$ruta = formData("ruta","post","");
				$orden = formData("orden","post","");
				$estado = formData("estado","post","");
				$imagen_relator_actual = formData("imagen_relator_actual","post","");

				if (serialValido()){
					if (!empty($_FILES['ruta']['tmp_name'])){   //
						$subir = new Upload($_FILES['ruta'],'es_ES'); //
						if ($subir->uploaded){
					        $subir->Process($dir_dest);
					        if ($subir->processed){
					        	$ruta = $subir->file_dst_name;
					        	sleep(2);
					        } else {
								$_SESSION["BCN_MENSAJE"]["NOTA"] = "Error en Subida: ".$subir->error;
							}
						} else {
							$_SESSION["BCN_MENSAJE"]["NOTA"] = "Error en Subida: ".$subir->error;
						}
					}
					if ($ruta==""){ $ruta = $imagen_relator_actual;	}

					$campos = array(
							"id" => $id,
							"nombre" => $nombre,
							"categoria" => $categoria,
							"ruta" => $ruta,
							"orden" => $orden,	
							"estado" => $estado,					
						); 
					$duplicidad = array("nombre" => $nombre);
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
				$id = formData("idrecurso","post",0);
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