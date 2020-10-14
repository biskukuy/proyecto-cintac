<?php
	$idcargo = formData("id{$_modulo}","post",0);//"id";
	if ($accionBCN!="Mostrar{$menu}"){
		$idBCN = formData("id{$_modulo}","post",0);
		$disabled = true;
		if ($idBCN>0){
			$form_titulo = "Editar Estatus";
			if ($accionBCN=="Ver{$modulo}"){ $form_titulo = "Ver {$modulo}"; $disabled = true; }
			$where = array("idcintac" => $idBCN);
			$res = $CONBCN->seleccionar($tabla,"*",$where);
			foreach ($res as $rs) {

			 	$idcintac = $rs->idcintac;
				$numero = $rs->numero;
				$id_tipo_contratacion =$rs->id_tipo_contratacion;
				$area_solicitante = $rs->area_solicitante;
				$id_cargo = $rs->id_cargo;
				$id_planta = $rs->id_planta;
				$aspectos_observaciones = $rs->aspectos_observaciones;
				$fecha_solicitud = $rs->fecha_solicitud;
				$marcacion = $rs->marcacion;
				$horario = $rs->horario;

				$estructura_renta = $rs->estructura_renta;
				$solicitudes_especiales = $rs->solicitudes_especiales;
				$estatus_solicitud = $rs->estatus_solicitud;//muestra el nivel en que se encuentra una solicitud
				$id_jefe = $rs->id_jefe;
				$fecha_1 = $rs->fecha_1;
				$estatus_1 = $rs->estatus_1;
				$id_subgerente_area = $rs->id_subgerente_area;
				$fecha_2 = $rs->fecha_2;
				$estatus_2 = $rs->estatus_2;
				$id_gerente = $rs->id_gerente;
				$fecha_3 = $rs->fecha_3;
				$estatus_3 = $rs->estatus_3;
				$id_subgerente_persona = $rs->id_subgerente_persona;
				$fecha_4 = $rs->fecha_4;
				$estatus_4 = $rs->estatus_4;
				//VErificar el tipo de usuario para activar el cambio de estatus correspondiente
				// si el estatus esta sin asignar (-1) entonces se habilita el cambio
				// de lo contrario no podrá hacer cambio.
				switch ($estatus_solicitud) {
					case '1':
						if($estatus_1==-1 ){
							$deshabilitar=false;
							$fecha_1 = date('Y-m-d H:i:s');
						  }else{
						  $deshabilitar=true;
						}//fin del estatus 1
						break;
					case '2':
						if($estatus_2==-1 ){
							$deshabilitar=false;
							$fecha_2 = date('Y-m-d H:i:s');
						}
							else{
							$deshabilitar=true;
						}//fin del estatus 1
					break;
					case '3':
						if($estatus_3==-1 ){
							$deshabilitar=false;
							$fecha_3 = date('Y-m-d H:i:s');
						}
							else{
							$deshabilitar=true;
						}//fin del estatus 1
					break;
					case '4':
						if($estatus_4==-1 ){
							$deshabilitar=false;
							$fecha_4 = date('Y-m-d H:i:s');
						}
							else{
							$deshabilitar=true;
						}//fin del estatus 1
					break;


				}









			}
		} else {
			$form_titulo = "Nuevo Estatus";
			$name = "";
			$visible = 1;
		}
?>
		<div class="page-header">
			<h1>
				<?php echo $form_titulo; ?>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<div class="row">
					<div id="div_left" class="col-sm-12">
						<?php		$CTRL->initForm($modulo,$idBCN);
							$CTRL->inputHidden(array("ID"=>"idcintac", "VALUE"=>$idcintac));
							$CTRL->inputHidden(array("ID"=>"id_usuario", "VALUE"=>$USER->id));
							$CTRL->inputHidden(array("ID"=>"estatus_solicitud", "VALUE"=>$estatus_solicitud));


							?>

<div class="form-group">

									<?php $CTRL->inputText(array("ID"=>"numero", "VALUE"=>$numero, "LABEL"=>"numero de solicitud", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>

									<?php $CTRL->inputText(array("ID"=>"fecha_solicitud", "VALUE"=>$fecha_solicitud, "LABEL"=>"Fecha de solicitud", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>

							</div>


							<div class="form-group">
							   <?php $arr_tipo = traerDatosTipoArray("bcn_tipo_contratacion","idtipo","nombre",array("visible" => 1));
									$CTRL->select(array("ID"=>"id_tipo_contratacion", "VALUE"=>$id_tipo_contratacion, "LABEL"=>"Tipo de Contratacion", "REQUIRED"=>true, "ITEMS"=>$arr_tipo, "COL_FIELD" => 3, "DISABLED"=>$disabled ));
								?>
							   <?php $CTRL->inputText(array("ID"=>"area_solicitante", "VALUE"=>$area_solicitante, "LABEL"=>"Area Solicitante", "PLACEHOLDER"=>"Nombre del Area", "COL_FIELD" => 3, "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>

							<div class="form-group">
							 <?php $arr_tipo2 = traerDatosTipoArray("bcn_cargo","idcargo","nombre",array("visible" => 1));
									$CTRL->select(array("ID"=>"id_cargo", "VALUE"=>$id_cargo, "LABEL"=>"Tipo Cargo", "REQUIRED"=>true, "ITEMS"=>$arr_tipo2, "COL_FIELD" => 3, "DISABLED"=>$disabled ));
								?>
						        <?php $arr_tipo3 = traerDatosTipoArray("mdl_user_cat_planta","idplanta","name",array("visible" => 1));
									$CTRL->select(array("ID"=>"id_planta", "VALUE"=>$id_planta, "LABEL"=>"Planta", "REQUIRED"=>true, "ITEMS"=>$arr_tipo3, "COL_FIELD" => 3, "DISABLED"=>$disabled ));
								?>
						    </div>
						    <div class="form-group">

									<?php $CTRL->select(array("ID"=>"marcacion", "VALUE"=>$marcacion, "LABEL"=>"Marcación", "REQUIRED"=>true, "ITEMS"=>array("1"=>"SI", "0"=>"NO"),"DISABLED"=>$disabled, "COL_FIELD" => 3)); ?>
									<div class="caja-1">
									<?php $CTRL->inputText(array("ID"=>"horario", "VALUE"=>$horario, "LABEL"=>"Horario", "PLACEHOLDER"=>"Lunes a Viernes 8:00 a 13:00", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>false,"DISABLED"=>$disabled )); ?>
									</div>
							</div>





						    <div class="form-group">
								<?php $CTRL->textArea(array("ID"=>"aspectos_observaciones", "LABEL"=>"Observaciones", "VALUE" => utf8_encode($aspectos_observaciones), "ROWS"=>3, "COL_FIELD" => 8,"DISABLED"=>$disabled));  ?>
							</div>

							<?php
					         	$mensaje = "";

					         switch ($rs->estatus_solicitud) {
					         	case '1':?>
					         		<div class="form-group">
										<?php $CTRL->select(array("ID"=>"estatus_1", "VALUE"=>$estatus_1, "LABEL"=>"Estatus Jefe","COL_FIELD" => 3, "REQUIRED"=>true,"DISABLED"=>$deshabilitar,
										"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>


										<?php $CTRL->inputText(array("ID"=>"fecha_1", "VALUE"=>$fecha_1, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_jefe=="0")
                                            $Jefe="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_jefe);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $Jefe= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_jefe", "VALUE"=>$Jefe, "LABEL"=>"Jefe de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">
										<?php $CTRL->select(array("ID"=>"estatus_2", "VALUE"=>$estatus_2, "LABEL"=>"Estatus Subgerente", "COL_FIELD" => 3,"DISABLED"=>true, "ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>

										<?php $CTRL->inputText(array("ID"=>"fecha_2", "VALUE"=>$fecha_2, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_subgerente_area=="0")
                                            $SubJefe="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_subgerente_area);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $SubJefe= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_subgerente_area", "VALUE"=>$SubJefe, "LABEL"=>"Subgerente de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">


										<?php $CTRL->select(array("ID"=>"estatus_3", "VALUE"=>$estatus_3, "LABEL"=>"Estatus Gerente", "COL_FIELD" => 3, "DISABLED"=>true,"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>
										<?php $CTRL->inputText(array("ID"=>"fecha_3", "VALUE"=>$fecha_3, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
										</div>
										
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_gerente=="0")
                                            $Gerente="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_gerente);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $Gerente= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_gerente", "VALUE"=>$Gerente, "LABEL"=>"Gerente de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">

										<?php $CTRL->select(array("ID"=>"estatus_4", "VALUE"=>$estatus_4, "LABEL"=>"Estatus Subgerente Personal", "COL_FIELD" => 3, "DISABLED"=>true,"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>
										<?php $CTRL->inputText(array("ID"=>"fecha_4", "VALUE"=>$fecha_4, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_subgerente_persona=="0")
                                            $SubgerenteP="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_subgerente_persona);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $SubgerenteP= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_subgerente_persona", "VALUE"=>$SubgerenteP, "LABEL"=>"Subgerente Personal: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									</div>


					         	<?php

					         		break;

					         	case '2':?>
					         		<div class="form-group">
										<?php $CTRL->select(array("ID"=>"estatus_1", "VALUE"=>$estatus_1, "LABEL"=>"Estatus Jefe","COL_FIELD" => 3, "REQUIRED"=>true,"DISABLED"=>true,
										"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>


										<?php $CTRL->inputText(array("ID"=>"fecha_1", "VALUE"=>$fecha_1, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_jefe=="0")
                                            $Jefe="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_jefe);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $Jefe= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_jefe", "VALUE"=>$Jefe, "LABEL"=>"Jefe de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">
										<?php $CTRL->select(array("ID"=>"estatus_2", "VALUE"=>$estatus_2, "LABEL"=>"Estatus Subgerente", "COL_FIELD" => 3,"DISABLED"=>$deshabilitar, "ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>

										<?php $CTRL->inputText(array("ID"=>"fecha_2", "VALUE"=>$fecha_2, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_subgerente_area=="0")
                                            $SubJefe="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_subgerente_area);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $SubJefe= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_subgerente_area", "VALUE"=>$SubJefe, "LABEL"=>"Subgerente de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">


										<?php $CTRL->select(array("ID"=>"estatus_3", "VALUE"=>$estatus_3, "LABEL"=>"Estatus Gerente", "COL_FIELD" => 3, "DISABLED"=>true,"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>
										<?php $CTRL->inputText(array("ID"=>"fecha_3", "VALUE"=>$fecha_3, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
										</div>
										
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_gerente=="0")
                                            $Gerente="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_gerente);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $Gerente= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_gerente", "VALUE"=>$Gerente, "LABEL"=>"Gerente de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">

										<?php $CTRL->select(array("ID"=>"estatus_4", "VALUE"=>$estatus_4, "LABEL"=>"Estatus Subgerente Personal", "COL_FIELD" => 3, "DISABLED"=>true,"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>

										<?php $CTRL->inputText(array("ID"=>"fecha_4", "VALUE"=>$fecha_4, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_subgerente_persona=="0")
                                            $SubgerenteP="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_subgerente_persona);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $SubgerenteP= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_subgerente_persona", "VALUE"=>$SubgerenteP, "LABEL"=>"Subgerente Personal: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									</div>


					         	<?php
					         		break;

					         	case '3':?>
					         		<div class="form-group">
										<?php $CTRL->select(array("ID"=>"estatus_1", "VALUE"=>$estatus_1, "LABEL"=>"Estatus Jefe","COL_FIELD" => 3, "REQUIRED"=>true,"DISABLED"=>true,
										"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>


										<?php $CTRL->inputText(array("ID"=>"fecha_1", "VALUE"=>$fecha_1, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_jefe=="0")
                                            $Jefe="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_jefe);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $Jefe= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_jefe", "VALUE"=>$Jefe, "LABEL"=>"Jefe de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">
										<?php $CTRL->select(array("ID"=>"estatus_2", "VALUE"=>$estatus_2, "LABEL"=>"Estatus Subgerente", "COL_FIELD" => 3,"DISABLED"=>true, "ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>

										<?php $CTRL->inputText(array("ID"=>"fecha_2", "VALUE"=>$fecha_2, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_subgerente_area=="0")
                                            $SubJefe="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_subgerente_area);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $SubJefe= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_subgerente_area", "VALUE"=>$SubJefe, "LABEL"=>"Subgerente de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">


										<?php $CTRL->select(array("ID"=>"estatus_3", "VALUE"=>$estatus_3, "LABEL"=>"Estatus Gerente", "COL_FIELD" => 3, "DISABLED"=>$deshabilitar,"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>
										<?php $CTRL->inputText(array("ID"=>"fecha_3", "VALUE"=>$fecha_3, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
										</div>
										
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_gerente=="0")
                                            $Gerente="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_gerente);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $Gerente= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_gerente", "VALUE"=>$Gerente, "LABEL"=>"Gerente de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">

										<?php $CTRL->select(array("ID"=>"estatus_4", "VALUE"=>$estatus_4, "LABEL"=>"Estatus Subgerente Personal", "COL_FIELD" => 3, "DISABLED"=>true,"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>

										<?php $CTRL->inputText(array("ID"=>"fecha_4", "VALUE"=>$fecha_4, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_subgerente_persona=="0")
                                            $SubgerenteP="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_subgerente_persona);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $SubgerenteP= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_subgerente_persona", "VALUE"=>$SubgerenteP, "LABEL"=>"Subgerente Personal: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									</div>


					         	<?php
					         		break;

					         	case '4':?>
					         		<div class="form-group">
										<?php $CTRL->select(array("ID"=>"estatus_1", "VALUE"=>$estatus_1, "LABEL"=>"Estatus Jefe","COL_FIELD" => 3, "REQUIRED"=>true,"DISABLED"=>true,
										"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>


										<?php $CTRL->inputText(array("ID"=>"fecha_1", "VALUE"=>$fecha_1, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_jefe=="0")
                                            $Jefe="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_jefe);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $Jefe= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_jefe", "VALUE"=>$Jefe, "LABEL"=>"Jefe de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">
										<?php $CTRL->select(array("ID"=>"estatus_2", "VALUE"=>$estatus_2, "LABEL"=>"Estatus Subgerente", "COL_FIELD" => 3,"DISABLED"=>true, "ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>

										<?php $CTRL->inputText(array("ID"=>"fecha_2", "VALUE"=>$fecha_2, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_subgerente_area=="0")
                                            $SubJefe="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_subgerente_area);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $SubJefe= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_subgerente_area", "VALUE"=>$SubJefe, "LABEL"=>"Subgerente de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">


										<?php $CTRL->select(array("ID"=>"estatus_3", "VALUE"=>$estatus_3, "LABEL"=>"Estatus Gerente", "COL_FIELD" => 3, "DISABLED"=>true,"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>
										<?php $CTRL->inputText(array("ID"=>"fecha_3", "VALUE"=>$fecha_3, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
										</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_gerente=="0")
                                            $Gerente="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_gerente);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $Gerente= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_gerente", "VALUE"=>$Gerente, "LABEL"=>"Gerente de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>
    
									<div class="form-group">

										<?php $CTRL->select(array("ID"=>"estatus_4", "VALUE"=>$estatus_4, "LABEL"=>"Estatus Subgerente Personal", "COL_FIELD" => 3, "DISABLED"=>$deshabilitar,"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>

										<?php $CTRL->inputText(array("ID"=>"fecha_4", "VALUE"=>$fecha_4, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_subgerente_persona=="0")
                                            $SubgerenteP="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_subgerente_persona);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $SubgerenteP= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_subgerente_persona", "VALUE"=>$SubgerenteP, "LABEL"=>"Subgerente Personal: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									</div>


					         	<?php
					         		break;
							case '5':?>
					         		<div class="form-group">
										<?php $CTRL->select(array("ID"=>"estatus_1", "VALUE"=>$estatus_1, "LABEL"=>"Estatus Jefe","COL_FIELD" => 3, "REQUIRED"=>true,"DISABLED"=>true,
										"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>


										<?php $CTRL->inputText(array("ID"=>"fecha_1", "VALUE"=>$fecha_1, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_jefe=="0")
                                            $Jefe="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_jefe);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $Jefe= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_jefe", "VALUE"=>$Jefe, "LABEL"=>"Jefe de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">
										<?php $CTRL->select(array("ID"=>"estatus_2", "VALUE"=>$estatus_2, "LABEL"=>"Estatus Subgerente", "COL_FIELD" => 3,"DISABLED"=>true, "ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>

										<?php $CTRL->inputText(array("ID"=>"fecha_2", "VALUE"=>$fecha_2, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_subgerente_area=="0")
                                            $SubJefe="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_subgerente_area);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $SubJefe= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_subgerente_area", "VALUE"=>$SubJefe, "LABEL"=>"Subgerente de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">


										<?php $CTRL->select(array("ID"=>"estatus_3", "VALUE"=>$estatus_3, "LABEL"=>"Estatus Gerente", "COL_FIELD" => 3, "DISABLED"=>true,"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>
										<?php $CTRL->inputText(array("ID"=>"fecha_3", "VALUE"=>$fecha_3, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
										
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_gerente=="0")
                                            $Gerente="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_gerente);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $Gerente= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_gerente", "VALUE"=>$Gerente, "LABEL"=>"Gerente de Area: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									    <br><br><br>
									</div>

									<div class="form-group">

										<?php $CTRL->select(array("ID"=>"estatus_4", "VALUE"=>$estatus_4, "LABEL"=>"Estatus Subgerente Personal", "COL_FIELD" => 3, "DISABLED"=>true,"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>

										<?php $CTRL->inputText(array("ID"=>"fecha_4", "VALUE"=>$fecha_4, "LABEL"=>"Fecha", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
									</div>
									
									<div class="form-group">
										<?php 
                                        //prueba 
                                        if($id_subgerente_persona=="0")
                                            $SubgerenteP="Primero debe aprobar/rechazar";
                                        else{
                                            $tabla= "mdl_user";
                					        $where = array("id" => $id_subgerente_persona);
                			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
                			                foreach ($res2 as $rs2) {
                                			    $SubgerenteP= $rs2-> firstname." ".$rs2-> lastname;
                                			}  
                                        }
                                        $CTRL->inputText(array("ID"=>"id_subgerente_persona", "VALUE"=>$SubgerenteP, "LABEL"=>"Subgerente Personal: ", "PLACEHOLDER"=>"Primero debe aprobar/rechazar", "COL_FIELD" => 8,"READONLY"=>true )); ?>
									</div>


					         	<?php
					         		break;


					         	}
					         ?>




						<?php
						//echo "$modulo $accionBCN ";
 							$CTRL->groupButtons($modulo,$accionBCN);
							$CTRL->endForm();
						?>
					</div>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->
<?php } else {  ?>

		<div class="page-header">
			<h1>
				<?php echo formatTitle($descriptor);

				 ?>
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					Listado de Solicitudes en General
				</small>

			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<?php $CTRL->initForm($modulo,0,true); ?>
				<table id="dynamic-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>

							<th width="10%">Numero</th>
							<th >Tipo<br>Contratacion</th>
							<th width="10%">Area </th>
							<th width="10%">Cargo</th>
							<th width="15%">Planta</th>
							<th width="10%">Estatus</th>
							<th width="5%" >Opc.</th>
						</tr>
					</thead>
					<tbody>
					<?
					//validacion para mostrar solo los necesarios
					$where = array("estatus_solicitud" => $USER->msn );
					$res = $CONBCN->seleccionar($tabla,"*",$where);
					foreach ($res as $rs) {

						if($rs->estatus_solicitud ==  $USER->msn || ($USER->msn=='5') || $USER->skype=='1')
						 {
						?>
						<tr>
							<td id="<?php echo $_modulo."_".$rs->idcintac; ?>"><?php echo $rs->numero; ?></td>


					        <?php
					        $tabla= "bcn_tipo_contratacion";
					        $where = array("idtipo" => $rs->id_tipo_contratacion);
			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
			                foreach ($res2 as $rs2) {
                			    $Contratacion = $rs2-> nombre;
                			}
					        ?>
							<td ><?php echo $Contratacion; ?></td>
					        <td ><?php echo $rs->area_solicitante; ?></td>

					        <?php
					        $tabla= "bcn_cargo";
					        $where = array("idcargo" => $rs->id_cargo);
			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
			                foreach ($res2 as $rs2) {
                			    $Cargo = $rs2-> nombre;
                			}
					        ?>
					        <td><?php echo $Cargo; ?></td>

					        <?php
					        $tabla= "mdl_user_cat_planta";
					        $where = array("idplanta" => $rs->id_planta);
			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
			                foreach ($res2 as $rs2) {
                			    $planta = $rs2->name;
                			}
					        ?>
					        <td ><?php echo $planta; ?></td>
					         <td >


					         	<?php
					         	$mensaje = "";

					         switch ($rs->estatus_solicitud) {
					         	case '1':
					         		$mensaje=  "Revision  Jefatura";$clase = "label-success";	         		break;
					         	case '2':
					         		$mensaje=  "Ver Subgerente Area";  $clase = "label-info";	       		break;
					         	case '3':
					         		$mensaje=  "Ver Gerente General";  $clase = "label-warning";	       		break;
					         	case '4':
					         		$mensaje=  "Ver Subgerente de Personas";  $clase = "label-primary";	       		break;
					         	default:
					         	$mensaje="Revision Completa"; $clase = "label-secundary";
					         }
				           ?>
				           <span class="label label-sm <?php echo $clase; ?>"> <?php echo $mensaje; ?>     </span>
				       </td>

							<td><?php
							// $CTRL->genericButton("btn_ver","Ver","algo('$rs->idcintac')");
							$funcion = "op".$modulo."('Editar".$modulo."',".$rs->idcintac.");";
							 $CTRL->genericButton("btn_ver","Ver",$funcion);
							?></td>
						</tr>
					<?php
					}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
<?php
//genericButton($id, $value, $function, $icon = ""){
}
?>