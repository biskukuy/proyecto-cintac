<?php
	$idunidad = formData("id{$_modulo}","post",0);//"id";
	if ($accionBCN!="Mostrar{$menu}"){
		$idBCN = formData("id{$_modulo}","post",0);
		$disabled = false;
		if ($idBCN>0){
			$form_titulo = "Editar Unidad";
			if ($accionBCN=="Ver{$modulo}"){ $form_titulo = "Ver {$modulo}"; $disabled = true; }
			$where = array("idunidad" => $idBCN);
			$res = $CONBCN->seleccionar($tabla,"*",$where);
			foreach ($res as $rs) {

				$nombre = $rs->nombre;
				$visible = $rs->visible;
				$idplanta = $rs->idplanta;	
			}
		} else {
			$form_titulo = "Nuevo Unidad";
			$name = "";
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
							$CTRL->inputHidden(array("ID"=>"idunidad", "VALUE"=>$idunidad));

						?>

							<div class="form-group">
								<?php $CTRL->inputText(array("ID"=>"nombre", "VALUE"=>$nombre, "LABEL"=>"Nombre Unidad", "PLACEHOLDER"=>"Gerente", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>
							<div class="form-group">
								<?php $arr_tipo3 = traerDatosTipoArray("mdl_user_cat_planta","idplanta","name",array("visible" => 1));
									$CTRL->select(array("ID"=>"idplanta", "VALUE"=>$idplanta, "LABEL"=>"Planta", "REQUIRED"=>true, "ITEMS"=>$arr_tipo3, "COL_FIELD" => 3, "DISABLED"=>$disabled ));?>
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
					Agregue un nueva Unidad o seleccione el que desee editar, eliminar
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
							<th width="35%">Unidad</th>
							<th width="35%">Planta</th>
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
						    <td ><?php echo $rs->idunidad; ?></td>
							<td ><?php echo $rs->nombre; ?></td>
							<?php
					        $tabla= "mdl_user_cat_planta";
					        $where = array("idplanta" => $rs->idplanta);
			                $res2 = $CONBCN->seleccionar($tabla,"*",$where);
			                $planta ="";
			                foreach ($res2 as $rs2) {
                			    $planta = $rs2->name;
                			}
					        ?>
					        <td ><?php echo $planta; ?></td>
							<td>
								<?php if ($rs->visible==1){ ?>
									<span class="label label-sm label-success">SI</span>
								<?php } else { ?>
									<span class="label label-sm label-warning">NO</span>
								<?php } ?>
							</td>
							<td><?php $CTRL->panelButtons($modulo,$rs->idunidad); ?></td>
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