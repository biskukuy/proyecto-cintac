<?php
  //$id_usuario=$USER->id;
	//$idtabla = "id";

	if ($accionBCN!="Mostrar{$menu}"){
		$idBCN = formData("id{$_modulo}","post",0);
		$disabled = false;

		if ($idBCN>0){
			$form_titulo = "Editar Solicitud";
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
				$estatus_solicitud = $rs->estatus_solicitud;

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
				$id_usuario = $USER->id;
				if($rs->id_usuario == $USER->id ||  $USER->id =='2')
					$disabled = false;
				else
					$disabled = true;


			}
		} else {
			$form_titulo = "Nueva Solicitud";
			 $idcintac = "";
				$numero = "";
				$id_tipo_contratacion ="";
				$area_solicitante = "";
				$id_cargo = "";
				$id_planta = "";
				$aspectos_observaciones = "";
				$fecha_solicitud = date('Y-m-d H:i:s');
				$marcacion = 1;
				$horario = "";
				$id_usuario = $USER->id;
				$estatus_1=  $estatus_2 = $estatus_3 = $estatus_4 = -1;
				$marcacion = 0;

		}
?>
<style>
	.caja-1{display:none;}
	</style>
		<div class="page-header">
			<h1>
				<?php echo $form_titulo;


				 ?>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<div class="row">
					<div id="div_left" class="col-sm-12">
						<div class="widget-box">
    						<div class="widget-header">
    							<h4 class="widget-title">Datos de la Solicitud</h4>
    						</div>
    						<div class="widget-body"><br>
						<?php

							$CTRL->initForm($modulo,$idBCN);
							$CTRL->inputHidden(array("ID"=>"id_usuario", "VALUE"=>$id_usuario));
							?>
							<div class="form-group">

									<?php $CTRL->inputText(array("ID"=>"numero", "VALUE"=>$numero, "LABEL"=>"numero de solicitud", "PLACEHOLDER"=>"000111", "REQUIRED"=>true, "COL_FIELD" => 3,"DISABLED"=>$disabled )); ?>

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
									<?php $CTRL->inputText(array("ID"=>"horario", "VALUE"=>$horario, "LABEL"=>"Horario", "PLACEHOLDER"=>"Lunes a Viernes 8:00 a 13:00", "REQUIRED"=>false, "COL_FIELD" => 3,"READONLY"=>false )); ?>
									</div>
							</div>


						    <div class="form-group">
								<?php $CTRL->textArea(array("ID"=>"aspectos_observaciones", "LABEL"=>"Observaciones", "VALUE" => utf8_encode($aspectos_observaciones), "ROWS"=>3, "COL_FIELD" => 8,"READONLY"=>$disabled));  ?>
							</div>
							 <div class="form-group">
								<?php $CTRL->textArea(array("ID"=>"estructura_renta", "LABEL"=>"Estructura renta", "VALUE" => utf8_encode($estructura_renta), "ROWS"=>3, "COL_FIELD" => 8,"READONLY"=>$disabled));  ?>
							</div>
							 <div class="form-group">
								<?php $CTRL->textArea(array("ID"=>"solicitudes_especiales", "LABEL"=>"Solicitudes especiales", "VALUE" => utf8_encode($solicitudes_especiales), "ROWS"=>3, "COL_FIELD" => 8,"READONLY"=>$disabled));  ?>
							</div>


							<div class="form-group">
										<?php $CTRL->select(array("ID"=>"estatus_1", "VALUE"=>$estatus_1, "LABEL"=>"Estatus Jefe","COL_FIELD" => 3, "REQUIRED"=>true,"DISABLED"=>true,
										"ITEMS"=>array("-1"=>"Elige una opcion","1"=>"Aprobado", "0"=>"Rechazado") )); ?>


										<?php $CTRL->inputText(array("ID"=>"fecha_1", "VALUE"=>$fecha_1, "LABEL"=>"Fecha", "PLACEHOLDER"=>"0000-00-00", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
                                        						
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

										<?php $CTRL->inputText(array("ID"=>"fecha_2", "VALUE"=>$fecha_2, "LABEL"=>"Fecha", "PLACEHOLDER"=>"0000-00-00", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
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
										<?php $CTRL->inputText(array("ID"=>"fecha_3", "VALUE"=>$fecha_3, "LABEL"=>"Fecha", "PLACEHOLDER"=>"0000-00-00", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
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

										<?php $CTRL->inputText(array("ID"=>"fecha_4", "VALUE"=>$fecha_4, "LABEL"=>"Fecha", "PLACEHOLDER"=>"0000-00-00", "REQUIRED"=>true, "COL_FIELD" => 3,"READONLY"=>true )); ?>
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


							$CTRL->groupButtons($modulo,$accionBCN);
							$CTRL->endForm();
						?>
						    </div>
						</div>
					</div>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->
<?php } else {  ?>

		<div class="page-header">
			<h1>
				<?php echo formatTitle($descriptor); ?>
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					Agregue una nueva solicitud o seleccione la que desee editar o eliminar
				</small>
				<?php
				//	function genericButton($id, $value, $function, $icon = ""){
				//$CTRL->genericButton("boton","Apro/Desapro","algo('$id_usuario')");
				 ?>
				<?php $CTRL->newButton($modulo); ?>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<?php $CTRL->initForm($modulo,0,true); ?>
				<table id="dynamic-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th width="5%">Id</th>
							<th width="19%">Nombre<br>Creador</th>
							<th width="5%">Numero</th>
							<th width="19%">Tipo<br>Contratacion</th>
							<th width="15%">Area Cintac</th>
							<th width="10%">Cargo</th>
							<th width="12%">Planta</th>
							<th width="10%">Estatus</th>
							<th>Opc.</th>
						</tr>
					</thead>
					<tbody>
					<?

					$res = $CONBCN->seleccionar($tabla,"*","");
					foreach ($res as $rs) {
						//if($rs->id_usuario == $USER->id ||  $USER->id =='2')
						{
					?>
						<tr>
							<td id="<?php echo $_modulo."_".$rs->idcintac; ?>"><?php echo $rs->idcintac; ?></td>
							
							<?php
						    $tabla= "mdl_user";
					        $where = array("id" => $rs->id_usuario);
			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
			                $UserName="";
			                foreach ($res2 as $rs2) {
                			    $UserName = $rs2-> firstname." ".$rs2-> lastname;
                			}
					        ?>
							<td id="<?php echo $_modulo."_".$rs->id_usuario; ?>"><?php echo $UserName; ?></td>
							
							<td ><?php echo $rs->numero; ?></td>

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
					         		$mensaje=  "Ver Jefatura";$clase = "label-success";	         		break;
					         	case '2':
					         		$mensaje=  "Ver Subgerente Area";  $clase = "label-info";	       		break;
					         	case '3':
					         		$mensaje=  "Ver Gerente General";  $clase = "label-warning";	       		break;
					         	case '4':
					         		$mensaje=  "Ver Subgerente de Personas";  $clase = "label-primary";	       		break;
					         	default:
					         	$mensaje="Revision Completada"; $clase = "label-secundary";
					         }
				           ?>
				           <span class="label label-sm <?php echo $clase; ?>"> <?php echo $mensaje; ?>     </span>
				       </td>

							<td><?php $CTRL->panelButtons($modulo,$rs->idcintac); ?></td>
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
}
?>