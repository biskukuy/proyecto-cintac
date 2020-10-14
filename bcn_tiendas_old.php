<?php
	$idtabla = "id";
	if ($accionBCN!="Mostrar{$menu}"){
		$idBCN = formData("id{$_modulo}","post",0);
		$disabled = false;
		if ($idBCN>0){
			$form_titulo = "Editar Tienda";
			if ($accionBCN=="Ver{$modulo}"){ $form_titulo = "Ver {$modulo}"; $disabled = true; }
			$where = array("idtienda" => $idBCN);
			$res = $CONBCN->seleccionar($tabla,"*",$where);
			foreach ($res as $rs) {
				$idcat = $rs->idcat;
				$idzone = $rs->idzone;
				$name = $rs->name;
				$visible = $rs->visible;
			}
		} else {
			$form_titulo = "Nueva Tienda";
			$idcat = 0;
			$idzone = 0;
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
						<?php 
							$CTRL->initForm($modulo,$idBCN); 
							$CTRL->inputHidden(array("ID"=>"descrip", "VALUE"=>$name));
						?>
							<div class="form-group">
								<?php 
									$arr_tipo = array("1" => "Cat 1", "2" => "Cat 2");
									$CTRL->select(array("ID"=>"idcat", "VALUE"=>$idcat, "LABEL"=>"Categor&iacute;a", "ITEMS"=>$arr_tipo, "PLACEHOLDER" => ".:Seleccione:.", "DISABLED"=>$disabled )); 
								?>
							</div>
							<div class="form-group">
								<?php 
									$arr_tipo = array("1" => "Zona 1", "2" => "Zona 2");
									$CTRL->select(array("ID"=>"idzone", "VALUE"=>$idzone, "LABEL"=>"Zona", "ITEMS"=>$arr_tipo, "PLACEHOLDER" => ".:Seleccione:.", "DISABLED"=>$disabled )); 
								?>
							</div>
							<div class="form-group">
								<?php $CTRL->inputText(array("ID"=>"name", "VALUE"=>$name, "LABEL"=>"Nombre Tienda", "PLACEHOLDER"=>"Tienda 1", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
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
					Agregue un nuevo Tienda o seleccione el que desee editar, eliminar
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
							<th width="60%">Tienda</th>
							<th width="20%">Visible</th>
							<th>Opc.</th>
						</tr>
					</thead>
					<tbody>
					<?
					$res = $CONBCN->seleccionar($tabla,"*","");
					foreach ($res as $rs) {
					?>
						<tr>
							<td id="<?php echo $_modulo."_".$rs->idtienda; ?>"><?php echo $rs->name; ?></td>
							<td>
								<?php if ($rs->visible==1){ ?>
									<span class="label label-sm label-success">SI</span>
								<?php } else { ?>
									<span class="label label-sm label-warning">NO</span>
								<?php } ?>
							</td>
							<td><?php $CTRL->panelButtons($modulo,$rs->idtienda); ?></td>
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