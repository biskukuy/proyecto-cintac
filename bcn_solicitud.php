<?php
	$idtabla = "id";

	if ($accionBCN!="Mostrar{$menu}"){
		$idBCN = formData("id{$_modulo}","post",0);
		$disabled = false;

		if ($idBCN>0){
			$form_titulo = "Editar curso";
			if ($accionBCN=="Ver{$modulo}"){ $form_titulo = "Ver {$modulo}"; $disabled = true; }
			$sql = " select * from mdl_course 	
			 WHERE id = {$idBCN} 
			
			ORDER BY id";
			$res = $CONBCN->consulta($sql);	
		
			foreach ($res as $rs) {
				$id = $rs->id;
				$category = $rs->category;
				$fullname = $rs->fullname;
				$shortname = $rs->shortname;
				$summary = $rs->summary;
				$visible = $rs->visible;
				
			}
		} else {
			$form_titulo = "Nuevo Curso";
				$id = "";
				$categoria =  "";
				$fullname =  "";
				$shortname =  "";
				$summary =  "";
				$visible =  "";
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
						
					
						?>
							
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="widget-title">Datos del Curso</h4>
								</div>

								<div class="widget-body">
									<div class="widget-main">
										<div class="col-sm-12" style="margin-bottom: 20px;">
											<div class="alert alert-info">
												<strong>Nota: </strong>

											Mensaje <?php echo $idBCN; ?>
												<br>
											</div>											
										</div>
										<div class="form-group">
										
											<?php $CTRL->inputText(array("ID"=>"id", "VALUE"=>$id, "LABEL"=>"ID", "PLACEHOLDER"=>"12345678", "COL_FIELD" => 3, "REQUIRED"=>true, "DISABLED"=>true )); ?>
										</div>
										<div class="form-group">
											<select  name="category" id="category">
													<?
														$sql = "SELECT cat.id,  cat.name as categoria
														        FROM mdl_course_categories AS cat 
														       ORDER BY cat.name desc
														        ";													
														$res = $CONBCN->consulta($sql);
														foreach ($res as $rs) {
														    if($rs->id== $category)
														    	echo '<option value="'.$rs->id.'"  selected="selected">'.utf8_encode($rs->categoria).'</option>';
														    else
														
																echo '<option value="'.$rs->id.'">'.utf8_encode($rs->categoria).'</option>';														
															
														}
													?>
												</select>
												
											<?php 
										
											$CTRL->select(array("ID"=>"visible", "VALUE"=>$visible, "LABEL"=>"Estado", "REQUIRED"=>true, "ITEMS"=>array("1"=>"Visible", "0"=>"Oculto"), "COL_FIELD" => 3, "DISABLED"=>$disabled )); ?>
										</div>
										<div class="form-group">
											<?php $CTRL->inputText(array("ID"=>"shortname", "VALUE"=>utf8_encode($shortname), "LABEL"=>"Nombre Corto", "PLACEHOLDER"=>"cursoXX", "REQUIRED"=>true, "COL_FIELD" => 2, "DISABLED"=>$disabled )); ?>
											<?php $CTRL->inputText(array("ID"=>"fullname", "VALUE"=>utf8_encode($fullname), "LABEL"=>"Nombre Largo", "PLACEHOLDER"=>"Nombre del Curso", "REQUIRED"=>true, "COL_FIELD" => 4, "DISABLED"=>$disabled )); ?>
										</div>
										
									
									
									</div>
								</div>
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
					Agregue un nuevo <?php echo $modulo; ?> o seleccione el que desee editar, eliminar
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
							<th width="5%">ID</th>
							<th width="10%">N.Corto</th>
							<th width="60%">Nombre Largo</th>
							<th width="10%">Visible</th>
							<th width="15%">Opc.</th>
						</tr>
					</thead>
					<tbody>
					<?
					$sql = "select * from mdl_course        ORDER BY id";
					$res = $CONBCN->consulta($sql);
					foreach ($res as $rs) {
					?>
						<tr>
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><?php echo  $rs->id; ?></td>
							<td><?php echo $rs->shortname; ?></td>
							
							<td><?php echo utf8_encode($rs->fullname); ?></td>
							<td>
								<?php if ($rs->visible==1){ ?>
									<span class="label label-sm label-success">Visible</span>
								<?php } else { ?>
									<span class="label label-sm label-warning">Oculto</span>
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