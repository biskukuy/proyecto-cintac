<?php
	$idcargo = formData("id{$_modulo}","post",0);//"id";
	if ($accionBCN!="Mostrar{$menu}"){
		$idBCN = formData("id{$_modulo}","post",0);
		$disabled = false;
		if ($idBCN>0){
			$form_titulo = "Editar Cargo";
			if ($accionBCN=="Ver{$modulo}"){ $form_titulo = "Ver {$modulo}"; $disabled = true; }
			$where = array("idcargo" => $idBCN);
			$res = $CONBCN->seleccionar($tabla,"*",$where);
			foreach ($res as $rs) {
                
				$nombre = $rs->nombre;
				$idunidad = $rs->idunidad;
				$idplanta = $rs->idplanta;
				$objetivo = $rs->objetivo;
				$visible = $rs->visible;
			}
		} else {
			$form_titulo = "Nuevo Cargo";
			$name = "";
			$idunidad = "";
			$idplanta = "";
			$objetivo = "";
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
						<?php
						//echo " ($idplanta)";
							$CTRL->initForm($modulo,$idBCN);
							$CTRL->inputHidden(array("ID"=>"descrip", "VALUE"=>$nombre));
							$CTRL->inputHidden(array("ID"=>"idcargo", "VALUE"=>$idcargo));

						?>

							<div class="form-group">
								<?php $CTRL->inputText(array("ID"=>"nombre", "VALUE"=>$nombre, "LABEL"=>"Nombre Cargo", "PLACEHOLDER"=>"Gerente", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>
							
							<div class="form-group">
								<?php
								$arr_tipo3 = traerDatosTipoArray("mdl_user_cat_planta","idplanta","name",array("visible" => 1));
								$CTRL->select(array("ID"=>"idplanta", "VALUE"=>$idplanta, "LABEL"=>"Planta", "REQUIRED"=>true, "ITEMS"=>$arr_tipo3, "COL_FIELD" => 3, "DISABLED"=>$disabled ));?>
							</div>
							
							<div class="form-group">
							        <div id="select2lista"></div>
                            </div>
							
							 <div class="form-group">
								<?php $CTRL->textArea(array("ID"=>"objetivo", "LABEL"=>"Objetivo del Cargo", "VALUE" => utf8_encode($objetivo), "ROWS"=>3, "COL_FIELD" => 8));  ?>
							</div>
							
							<div class="form-group">
							    
								<?php $CTRL->select(array("ID"=>"visible", "VALUE"=>$visible, "LABEL"=>"Visible", "REQUIRED"=>true, "ITEMS"=>array("1"=>"SI", "0"=>"NO"),"DISABLED"=>$disabled )); ?>
							</div>

						<?php
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
				<?php echo formatTitle($descriptor); ?>
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					Agregue un nuevo Cargo o seleccione el que desee editar, eliminar
				</small>
				<?php $CTRL->newButton($modulo); ?>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<?php $CTRL->initForm($modulo,0,true); ?>
				<table id="dynamic-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th width="10%">ID</th>
							<th width="35%">Cargo</th>
							<th width="35%">Unidad</th>
							<th width="10%">Visible</th>
							<th>Opc.</th>
						</tr>
					</thead>
					<tbody>
					<?
					$res = $CONBCN->seleccionar($tabla,"*","");
					foreach ($res as $rs) {
					?>
						<tr>
						    <td ><?php echo $rs->idcargo; ?></td>
							<td id="<?php echo $_modulo."_".$rs->idcargo; ?>"><?php echo $rs->nombre; ?></td>
							
							<?php
					        $tabla= "bcn_unidad_negocio";
					        $where = array("idunidad" => $rs->idunidad);
			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
			                $unidad ="";
			                foreach ($res2 as $rs2) {
                			    $unidad = $rs2->nombre;
                			}
					        ?>
					        <td ><?php echo $unidad; ?></td>
							
							<td>
								<?php if ($rs->visible==1){ ?>
									<span class="label label-sm label-success">SI</span>
								<?php } else { ?>
									<span class="label label-sm label-warning">NO</span>
								<?php } ?>
							</td>
							<td><?php $CTRL->panelButtons($modulo,$rs->idcargo); ?></td>
						</tr>
					<?php
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
<?php
}
?>
