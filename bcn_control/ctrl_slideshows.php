<?php
        include_once("lib/php/upload/class.upload.php");
		$modulo = "Slideshow";
		$_modulo = strtolower($modulo);
		$tabla = "mdl_bcn_slide";
		$dir_dest = "images/img/";	
		if($USUARIO->id){
			$accionBCN = formData("accion{$_modulo}","post","Mostrar{$modulo}s");

			if ($accionBCN=="Guardar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$id = formData("idslideshow","post",0);
				$image = "";
				$titulo = formData("titulo","post","");
				$subtitulo = formData("subtitulo","post","");
				$fecha = formData("fecha","post",date("Y-m-d"));
				$pix = "";
				$orden = formData("orden","post",0);
				$estado = formData("estado","post",0);
				$imagen_relator_actual = formData("imagen_relator_actual","post","");
				$imagen_relator_actual2 = formData("imagen_relator_actual2","post","");

				if (serialValido()){
					if (!empty($_FILES['image']['tmp_name'])){   //
						$subir = new Upload($_FILES['image'],'es_ES'); //
						if ($subir->uploaded){
					        $subir->Process($dir_dest);
					        if ($subir->processed){
					        	$image = $subir->file_dst_name;
					        	sleep(2);
					        } else {
								$_SESSION["BCN_MENSAJE"]["NOTA"] = "Error en Subida: ".$subir->error;
							}
						} else {
							$_SESSION["BCN_MENSAJE"]["NOTA"] = "Error en Subida: ".$subir->error;
						}
					}
					if ($image==""){ $image = $imagen_relator_actual;	}

					// Segunda imagen
					
					if (!empty($_FILES['pix']['tmp_name'])){   //
						$subir2 = new Upload($_FILES['pix'],'es_ES'); //
						if ($subir2->uploaded){
					        $subir2->Process($dir_dest);
					        if ($subir2->processed){
					        	$pix = $subir2->file_dst_name;
					        } else {
								$_SESSION["BCN_MENSAJE"]["NOTA"] = "Error en Subida: ".$subir2->error;
							}
						} else {
							$_SESSION["BCN_MENSAJE"]["NOTA"] = "Error en Subida: ".$subir2->error;
						}
					}

					if ($pix==""){ $pix = $imagen_relator_actual2;	}
				
					$campos = array(
							"id" => $id,
							"image" => $image,
							"titulo" => $titulo,
							"subtitulo" => $subtitulo,
							"fecha" => $fecha,
							"pix" => $pix,
							"orden" => $orden,
							"estado" => $estado,		
						); 
					$duplicidad = array("titulo" => $titulo);
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
				$id = formData("idslideshow","post",0);
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