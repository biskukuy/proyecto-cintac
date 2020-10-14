<?php
	$idtabla = "id";
	if ($accionBCN!="Mostrar{$modulo}s"){
		$idBCN = formData("id{$_modulo}","post",0);
		$disabled = false;
		if ($idBCN>0){
			$form_titulo = "Editar Slideshow";
			if ($accionBCN=="Ver{$modulo}"){ $form_titulo = "Ver {$modulo}"; $disabled = true; }
			$where = array("id" => $idBCN);
			$res = $CONBCN->seleccionar($tabla,"*",$where);
			foreach ($res as $rs) {
				$image = $rs->image;
				$titulo = $rs->titulo;
				$subtitulo = $rs->subtitulo;
				$fecha = $rs->fecha;
				$pix = $rs->pix;
				$orden = $rs->orden;
				$estado = $rs->estado;
			}
		} else {
			$form_titulo = "Nuevo Slideshows";
			$image = "";
			$titulo = "";
			$subtitulo = "";
			$fecha = "";
			$pix = "";
			$estado = 0;
			$orden = 0;	
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
							$CTRL->inputHidden(array("ID"=>"descrip", "VALUE"=>$titulo));
							$CTRL->inputHidden(array("ID"=>"imagen_relator_actual", "VALUE"=>$image));
							$CTRL->inputHidden(array("ID"=>"imagen_relator_actual2", "VALUE"=>$pix));
						?>
												
							<div class="form-group">
								<?php $CTRL->inputText(array("ID"=>"titulo", "VALUE"=>$titulo, "LABEL"=>"Nombre", "PLACEHOLDER"=>"Nombre slideshows", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>

							<div class="form-group">
								<?php $CTRL->inputText(array("ID"=>"subtitulo", "VALUE"=>$subtitulo, "LABEL"=>"Contenido", "PLACEHOLDER"=>"Contenido", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>
								
							<div class="form-group">
								
								<?php $CTRL->inputFile(array("ID"=>"image", "VALUE"=>$image,"CSS"=>"file", "LABEL"=>"Imagen Principal  formatos:PNG o JPG", "PLACEHOLDER"=>"Imagen", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>

							<?php if ($image!=""){ ?>

							<div class="form-group" style="margin-left: 200px;">
								<img src="images/img/<?php echo $image; ?>" style="max-width:200px; border: solid 1px #ccc; padding: 5px 5px 5px 5px;">
							</div>
							
							<?php } ?>
						
							<div class="form-group">
								
								<?php $CTRL->inputFile(array("ID"=>"pix", "VALUE"=>$pix,"CSS"=>"file", "LABEL"=>"Imagen Principal  formatos:PNG o JPG", "PLACEHOLDER"=>"pixn", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>

								<?php if ($pix!=""){ ?>

							<div  class="form-group" style="margin-left: 200px;">
									
								<img src="images/img/<?php echo $pix; ?>" style="max-width:200px; border: solid 1px #ccc; padding: 5px 5px 5px 5px;">
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
							<th width="25%">Titulo</th>
							<th width="25%">Subtitulo</th>
							<th width="20%">Imagen Principal</th>
							<th width="20%">Fondo</th>
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
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><?php echo $rs->titulo; ?></td>
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><?php echo $rs->subtitulo; ?></td>
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><img src="images/img/<?php echo $rs->image; ?>" style="max-width:200px; border: solid 1px #ccc; padding: 5px 5px 5px 5px;"></td>
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><img src="images/img/<?php echo $rs->pix; ?>" style="max-width:200px; border: solid 1px #ccc; padding: 5px 5px 5px 5px;"></td>

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