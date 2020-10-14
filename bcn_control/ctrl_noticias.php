<?php
		include_once("lib/php/upload/class.upload.php");
		$modulo = "Noticia";
		$_modulo = strtolower($modulo);
		$tabla = "mdl_bcn_noticias";
		$dir_dest = "images/img/";	
		if($USUARIO->id){
			$accionBCN = formData("accion{$_modulo}","post","Mostrar{$modulo}s");

			if ($accionBCN=="Guardar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";

				$id = formData("idnoticia","post",0);
				$titulo = formData("titulo","post","");
				$descripcion = formData("descripcion","post","");
				$fecha = formData("fecha","post",date("Y-m-d"));
				$foto = formData("foto","post","");
				$estado = formData("estado","post",0);
				$orden = formData("orden","post",0);
				$imagen_relator_actual = formData("imagen_relator_actual","post","");


				if (serialValido()){
					if (!empty($_FILES['foto']['tmp_name'])){   //
						$subir = new Upload($_FILES['foto'],'es_ES'); //
						if ($subir->uploaded){
					        $subir->Process($dir_dest);
					        if ($subir->processed){
					        	$foto = $subir->file_dst_name;
					        	sleep(2);
					        } else {
								$_SESSION["BCN_MENSAJE"]["NOTA"] = "Error en Subida: ".$subir->error;
							}
						} else {
							$_SESSION["BCN_MENSAJE"]["NOTA"] = "Error en Subida: ".$subir->error;
						}
					}
					if ($foto==""){ $foto = $imagen_relator_actual;	}
					
					$campos = array(
							"id" => $id,
							"titulo" => $titulo,
							"descripcion" => $descripcion,
							"fecha" => $fecha,
							"foto" => $foto,
							"estado" => $estado,
							"orden" => $orden,

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
				$id = formData("idnoticia","post",0);
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