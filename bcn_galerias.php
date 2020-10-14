<?php
	$idtabla = "id";
	if ($accionBCN!="Mostrar{$menu}"){
		$idBCN = formData("id{$_modulo}","post",0);
		$disabled = false;
		if ($idBCN>0){
			$form_titulo = "Editar imagen";
			if ($accionBCN=="Ver{$modulo}"){ $form_titulo = "Ver {$modulo}"; $disabled = true; }
			$where = array("id" => $idBCN);
			$res = $CONBCN->seleccionar($tabla,"*",$where);
			foreach ($res as $rs) {
				$ruta = $rs->ruta;
				$estado = $rs->estado;
				$id_noticia = $rs->id_noticia;
				$titulo = $rs->titulo;
				$descripcion = $rs->descripcion;
				$video = $rs->video;
				$tipo = $rs->tipo;

			}
		} else {
			$form_titulo = "Nueva Imagen";
			$ruta ="";
			$estado = "";
			$id_noticia  ="";
			$titulo = "";
			$descripcion ="";
			$video = "";
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
							$CTRL->inputHidden(array("ID"=>"imagen_relator_actual", "VALUE"=>$ruta));
							?>

							<div class="form-group">
								<?php $CTRL->inputFile(array("ID"=>"ruta", "VALUE"=>$ruta,"CSS"=>"file", "LABEL"=>"Imagen PNG o JPG", "PLACEHOLDER"=>"Imagen", "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
							</div>
							
							<?php if ($ruta!=""){ ?>

							<div class="form-group" style="margin-left: 200px";>

								<img src="images/galeria/<?php echo $ruta; ?>" style="max-width:200px; border: solid 1px #ccc; padding: 5px 5px 5px 5px;">
							</div>

							<?php } ?>

							<div class="form-group">

								<select class="form-control" name="id_noticia" >
								
								    <?php 

									$sql = "SELECT * from mdl_bcn_noticias where estado ='1'";									
									
									$res = $CONBCN->consulta($sql);
																
									foreach ($res as $rs) {
																	
										echo '<option value="'.$rs->id.'" selected="selected">'.($rs->titulo).'</option>';
																												
									}
									?>								
							
							     </select>

						    </div>
						
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
							<th height=50% width="50%">imagen</th>
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
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><img src="images/galeria/<?php echo $rs->ruta; ?>" style="max-width:200px; border: solid 1px #ccc; padding: 5px 5px 5px 5px;">

					
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