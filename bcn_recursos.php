<?php
	$idtabla = "id";
	if ($accionBCN!="Mostrar{$menu}"){
		$idBCN = formData("id{$_modulo}","post",0);
		$disabled = false;
		if ($idBCN>0){
			$form_titulo = "Editar Recurso";
			if ($accionBCN=="Ver{$modulo}"){ $form_titulo = "Ver {$modulo}"; $disabled = true; }
			$where = array("id" => $idBCN);
			$res = $CONBCN->seleccionar($tabla,"*",$where);
			foreach ($res as $rs) {
				$nombre = $rs->nombre;
				$categoria = $rs->categoria;
				$ruta = $rs->ruta;
				$orden = $rs->orden;
				$estado = $rs->estado;
			}
		} else {
			$form_titulo = "Nuevo Recurso";
			$nombre = "";
			$categoria = "";
			$ruta = "";
			$orden = 1;
			$estado = 1;	
							
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
							$CTRL->initForm($modulo,$idBCN,false,"s",true); 
							$CTRL->inputHidden(array("ID"=>"descrip", "VALUE"=>$nombre));
							$CTRL->inputHidden(array("ID"=>"imagen_relator_actual", "VALUE"=>$ruta));
						?>	
							
							<div class="form-group">
								<?php $CTRL->inputText(array("ID"=>"nombre", "VALUE"=>$nombre, "LABEL"=>"Nombre", "PLACEHOLDER"=>"Nueva Biblioteca", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>

							<div class="form-group">

								<select class="form-group" name="categoria" style="margin-left: 210px";>
						
								    <?php 

									$sql = "SELECT * from mdl_bcn_biblioteca_cat where estado ='1'";									
									
									$res = $CONBCN->consulta($sql);
																
									foreach ($res as $rs) {
																										
										echo

										 '<option value="'.$rs->id.'" selected="selected">'.utf8_encode($rs->nombre).'</option>';
									}
									?>
															
								</select>

							</div>

							<div class="form-group">
								<?php $CTRL->inputFile(array("ID"=>"ruta", "VALUE"=>$ruta,"CSS"=>"file", "LABEL"=>"Recurso PNG, JPG o PDF", "PLACEHOLDER"=>"Recursos", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>
							
							<?php  if ($ruta!=""){ ?>
							<div class="form-group" style="margin-left: 200px";>

								<img src="recursos/<?php echo $ruta; ?>" style="max-width:200px; border: solid 1px #ccc; padding: 5px 5px 5px 5px;">
							</div>
							<?php } ?>

							<div class="form-group">
								<?php $CTRL->select(array("ID"=>"estado", "VALUE"=>$estado, "LABEL"=>"Visible", "REQUIRED"=>true, "ITEMS"=>array("1"=>"SI", "0"=>"NO"),"DISABLED"=>$disabled )); ?>
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
							<th width="60%">Recursos</th>
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
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><?php echo $rs->nombre; ?></td>
							<td>
								<?php if ($rs->estado==1){ ?>
									<span class="label label-sm label-success">SI</span>
								<?php } else { ?>
									<span class="label label-sm label-warning">NO</span>
								<?php } ?>
							</td>
							<td><?php $CTRL->panelButtons($modulo,$rs->id); ?></td>
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