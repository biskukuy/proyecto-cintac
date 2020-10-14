<?php
	$idtabla = "id";
	if ($accionBCN!="Mostrar{$menu}"){
		$idBCN = formData("id{$_modulo}","post",0);
		$disabled = false;
		if ($idBCN>0){
			$form_titulo = "Editar Videos";
			if ($accionBCN=="Ver{$modulo}"){ $form_titulo = "Ver {$modulo}"; $disabled = true; }
			$where = array("id" => $idBCN);
			$res = $CONBCN->seleccionar($tabla,"*",$where);
			foreach ($res as $rs) {
				$nombre = $rs->nombre;
				$link = $rs->link;
				$fecha = $rs->fecha;
				$estado = $rs->estado;
				$orden = $rs->orden;
			}
		} else {
			$form_titulo = "Nuevo Video";
			$nombre = $nombre;
			$link = $link;
			$fecha = date("Y-m-d");
			$estado = 0;
			$orden = 1;	
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
							$CTRL->inputHidden(array("ID"=>"descrip", "VALUE"=>$nombre));
						?>	

							<div class="form-group">
								<p class="alert alert-info"> El código es el que aparece después del signo = . Ej:
                                      https://www.youtube.com/watch?v=<b>QjjkStofi3Q</b></p>
                            <div class="col-md-12">
							
							<div class="form-group">
								<?php $CTRL->inputText(array("ID"=>"nombre", "VALUE"=>$nombre, "LABEL"=>"Titulo", "PLACEHOLDER"=>"Titulo del Video", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>

							<div class="form-group">

								<?php $CTRL->inputText(array("ID"=>"link", "VALUE"=>$link, "LABEL"=>"Código de Youtube", "PLACEHOLDER"=>"QjjkStofi3Q", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>

							<?php

							if ($link!=""){
							?>

							<div class="form-group" style="margin-left: 190px">

								<td id="<?php echo $_modulo."_".$rs->id; ?>"><iframe width="30%" height="200" src="https://www.youtube.com/embed/<?php echo $rs->link;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></td>
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
					Agregue un nuevo Video o seleccione el que desee editar, eliminar
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
							<th width="30%">Título</th>
							<th width="40%">video</th>
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
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><iframe width="100%" height="180" src="https://www.youtube.com/embed/<?php echo $rs->link;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></td>

							

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