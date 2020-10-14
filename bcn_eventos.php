<?php
	$idtabla = "id";
	if ($accionBCN!="Mostrar{$modulo}s"){
		$idBCN = formData("id{$_modulo}","post",0);
		$disabled = false;
		if ($idBCN>0){
			$form_titulo = "Editar Evento";
			if ($accionBCN=="Ver{$modulo}"){ $form_titulo = "Ver {$modulo}"; $disabled = true; }
			$where = array("id" => $idBCN);
			$res = $CONBCN->seleccionar($tabla,"*",$where);
			foreach ($res as $rs) {
				$nombre = $rs->nombre;
				$fecha = $rs->fecha;
				$descripcion = $rs->descripcion;
				$hora = $rs->hora;
				$foto = $rs->foto;
				$tipo = $rs->tipo;
			}
		} else {
			$form_titulo = "Nuevo Evento";
			$nombre ="";
			$fecha = "";
			$descripcion  ="";
			$hora = "";
			$foto ="";
			$tipo = 1;			
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
							$CTRL->inputHidden(array("ID"=>"imagen_relator_actual", "VALUE"=>$foto));
							?>
							
							<div class="form-group">
								<?php $CTRL->inputText(array("ID"=>"nombre", "VALUE"=>$nombre, "LABEL"=>"Nombre", "PLACEHOLDER"=>"Nombre del evento", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>

							<div class="form-group">
								<?php $CTRL->inputText(array("ID"=>"descripcion", "VALUE"=>$descripcion, "LABEL"=>"Contenido", "PLACEHOLDER"=>"Contenido del evento", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>

							<div class="form-group">
								<?php $CTRL->inputDate(array("ID"=>"fecha", "VALUE"=>$fecha, "LABEL"=>"Fecha del evento", "COL_FIELD" => 3, "DISABLED"=>$disabled )); ?>
							</div>

							<div class="form-group">
								<?php $CTRL->inputText(array("ID"=>"hora", "VALUE"=>$hora, "LABEL"=>"Hora", "PLACEHOLDER"=>"Hora del evento","COL_FIELD" => 3, "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>

							<div class="form-group">
								<?php $CTRL->inputFile(array("ID"=>"foto", "VALUE"=>$foto,"CSS"=>"file", "LABEL"=>"Imagen PNG o JPG", "PLACEHOLDER"=>"Imagen", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>


							<?php if ($foto!=""){ ?>

							<div class="form-group" style="margin-left: 200px";>

								<img src="images/img/<?php echo $foto; ?>" style="max-width:200px; border: solid 1px #ccc; padding: 5px 5px 5px 5px;">
							</div>
							<?php } ?>

							<div class="form-group">
								<?php $CTRL->select(array("ID"=>"tipo", "VALUE"=>$tipo, "LABEL"=>"Visible", "REQUIRED"=>true, "ITEMS"=>array("1"=>"SI", "0"=>"NO"),"DISABLED"=>$disabled )); ?>
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
							<th width="30%">Nombre</th>
							<th width="12%">Fecha</th>
							<th width="30%">Descripción</th>
							<th width="10%">Hora</th>
							<th height=50% width="50%">Foto</th>
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
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><?php echo $rs->nombre; ?></td>
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><?php echo $rs->fecha; ?></td>
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><?php echo $rs->descripcion; ?></td>
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><?php echo $rs->hora; ?></td>
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><img src="images/img/<?php echo $rs->foto; ?>" style="max-width:150px; border: solid 1px #ccc; padding: 5px 5px 5px 5px;"></td>

					
							<td>
								<?php if ($rs->tipo==1){ ?>
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