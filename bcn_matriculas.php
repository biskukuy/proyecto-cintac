<?php
	$idtabla = "id";
		echo "(	$accionBCN ) y $menu" ;
	if ($accionBCN!="Mostrar{$menu}"){
		$idBCN = formData("id{$_modulo}","post",0);
		$disabled = false;
		echo "(id:	$idBCN )" ;
		if ($idBCN>0){
			$form_titulo = "Editar Matricula";
			if ($accionBCN=="Ver{$modulo}"){ $form_titulo = "Ver {$modulo}"; $disabled = true; }
			$sql = "SELECT distinct user.*, fi.data as cargo, co.data as sucursal
			        FROM mdl_user AS user
			        LEFT OUTER JOIN mdl_user_info_data fi ON user.id = fi.userid and fi.fieldid = 2 
			        LEFT OUTER JOIN mdl_user_info_data co ON user.id = co.userid and co.fieldid = 3 
			        WHERE user.id = {$idBCN} 
			        ORDER BY user.idnumber";
			$res = $CONBCN->consulta($sql);			
			foreach ($res as $rs) {
				$username = $rs->username;
				$password = $rs->password;
				$idnumber = $rs->idnumber;
				$firstname = $rs->firstname;
				$lastname = $rs->lastname;
				$direccion = $rs->address;
				$phone1 = $rs->phone1;
				$email = $rs->email;
				$skype = $rs->skype;
				$institution = $rs->institution;
				$city = $rs->city;
				$sucursal = $rs->sucursal;
				$cargo = $rs->cargo;
				$suspended = $rs->suspended;
			}
		} else {
			$form_titulo = "Nueva Matricula";
			$username = "";
			$password = "";
			$idnumber = "";
			$firstname = "";
			$lastname = "";
			$direccion = "";		
			$phone1 = 	"";	
			$email = 	"";
			$skype = "";
			$institution = "";
			$city = "";
			$sucursal = ""; 		
			$cargo = "";
			$clave_sence = "";
			$suspended = 0;
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
							$CTRL->inputHidden(array("ID"=>"descrip", "VALUE"=>$username));
							$CTRL->inputHidden(array("ID"=>"password_act", "VALUE"=>$password));
						?>
							
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="widget-title">Datos del Usuario</h4>
								</div>

								<div class="widget-body">
									<div class="widget-main">
										<div class="col-sm-12" style="margin-bottom: 20px;">
											<div class="alert alert-info">
												<strong>Nota: </strong>

												El Usuario y Pasword deber&iacute;a ser el rut sin punto, sin guion ni d&iacute;gito verificador, para conservar la uniformidad de las matriculaciones.
												<br>
											</div>											
										</div>
										<div class="form-group">
											<?php $CTRL->inputText(array("ID"=>"username", "VALUE"=>$username, "LABEL"=>"Usuario", "PLACEHOLDER"=>"12345678", "COL_FIELD" => 3, "REQUIRED"=>true, "DISABLED"=>$disabled )); ?>
											<?php $CTRL->inputPassword(array("ID"=>"password", "VALUE"=>$password, "LABEL"=>"Password", "PLACEHOLDER"=>"******", "REQUIRED"=>true, "COL_FIELD" => 3, "DISABLED"=>$disabled )); ?>
										</div>
										<div class="form-group">
											<?php $CTRL->inputText(array("ID"=>"idnumber", "VALUE"=>$idnumber, "LABEL"=>"Rut", "PLACEHOLDER"=>"12345678-9", "REQUIRED"=>true, "CSS"=> "rut", "COL_FIELD" => 3, "DISABLED"=>$disabled )); ?>
											<?php $CTRL->select(array("ID"=>"suspended", "VALUE"=>$suspended, "LABEL"=>"Estado", "REQUIRED"=>true, "ITEMS"=>array("1"=>"Inactivo", "0"=>"Activo"), "COL_FIELD" => 3, "DISABLED"=>$disabled )); ?>
										</div>
										<div class="form-group">
											<?php $CTRL->inputText(array("ID"=>"firstname", "VALUE"=>utf8_encode($firstname), "LABEL"=>"Nombres", "PLACEHOLDER"=>"Juan", "REQUIRED"=>true, "COL_FIELD" => 3, "DISABLED"=>$disabled )); ?>
											<?php $CTRL->inputText(array("ID"=>"lastname", "VALUE"=>utf8_encode($lastname), "LABEL"=>"Apellidos", "PLACEHOLDER"=>"Cisterna", "REQUIRED"=>true, "COL_FIELD" => 3, "DISABLED"=>$disabled )); ?>
										</div>
										<div class="form-group">
											<?php $CTRL->inputEmail(array("ID"=>"email", "VALUE"=>$email, "LABEL"=>"Email", "PLACEHOLDER"=>"capacitacion@correo.cl", "REQUIRED"=>true, "COL_FIELD" => 3, "DISABLED"=>$disabled )); ?>
											<?php $CTRL->inputText(array("ID"=>"phone1", "VALUE"=>$phone1, "LABEL"=>"Tel&eacute;fono", "PLACEHOLDER"=>"9 9999 9999", "COL_FIELD" => 3, "DISABLED"=>$disabled )); ?>
										</div>
										<div class="form-group">
											<!--<?php $CTRL->inputText(array("ID"=>"sucursal", "VALUE"=>utf8_encode($sucursal), "LABEL"=>"Sucursal", "PLACEHOLDER"=>"Santiago", "COL_FIELD" => 3, "DISABLED"=>$disabled )); ?> -->
											<?php $CTRL->inputText(array("ID"=>"city", "VALUE"=>utf8_encode($city), "LABEL"=>"Ciudad", "PLACEHOLDER"=>"Santiago", "COL_FIELD" => 3, "DISABLED"=>$disabled )); ?>
										</div>
										<div class="form-group">
											<?php $CTRL->textArea(array("ID"=>"direccion", "LABEL"=>"Direcci&oacute;n", "VALUE" => utf8_encode($direccion), "ROWS"=>2, "COL_FIELD" => 8));  ?>
										</div>
										<div class="form-group">
											<!--<?php $CTRL->inputText(array("ID"=>"cargo", "VALUE"=>$cargo, "LABEL"=>"Cargo", "COL_FIELD" => 3, "DISABLED"=>$disabled )); ?>-->
										</div>
									</div>
								</div>
							</div>		
							<div class="form-group">
								<div class="col-sm-12">
									<div class="widget-box">
										<div class="widget-header">
											<h4 class="widget-title">Datos de Cursos</h4>
										</div>
										<div class="widget-body">
											<div class="row">
												<div class="col-sm-6"><h3 class="sutitulo_select_multiple">&nbsp;&nbsp;Cursos Disponibles</h3></div>
												<div class="col-sm-6"><h3 class="sutitulo_select_multiple">Cursos Asignados</h3></div>
											</div>
											<div class="widget-main">
												<select multiple="multiple" size="10" name="lista_cursos[]" id="lista_cursos">
													<?
														$sql = "SELECT distinct cur.id, cur.fullname as curso, cat.name as categoria, u_enrol.id as matriculado
														        FROM mdl_course AS cur
														        INNER JOIN mdl_course_categories AS cat ON cur.category = cat.id 
														        INNER JOIN mdl_enrol AS enrol ON cur.id = enrol.courseid
														        LEFT OUTER JOIN mdl_user_enrolments AS u_enrol ON enrol.id = u_enrol.enrolid and u_enrol.userid = {$idBCN}
														        WHERE cur.visible = 1 and cur.id > 1 and enrol.enrol = 'manual' 
														        ORDER BY cat.name desc, cur.fullname
														        ";													
														$res = $CONBCN->consulta($sql);
														foreach ($res as $rs) {
															if (intval($rs->matriculado)>0){
																echo '<option value="'.$rs->id.'" selected="selected">'.utf8_encode($rs->categoria." | ".$rs->curso).'</option>';
															} else { 
																echo '<option value="'.$rs->id.'">'.utf8_encode($rs->categoria." | ".$rs->curso).'</option>';														
															}
														}
													?>
												</select>												
											</div>
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
					Agregue un nuevo Usuario o seleccione el que desee editar, eliminar
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
							<th width="25%">Rut</th>
							<th width="55%">Nombres y Apellidos</th>
							<th width="10%">Estado</th>
							<th>Opc.2</th>
						</tr>
					</thead>
					<tbody>
					<?
					$sql = "SELECT user.id, user.idnumber, user.firstname, user.lastname,
                        	user.institution, user.suspended
					        FROM mdl_user AS user
					        WHERE not user.icq = '1' and user.id > 4 and user.deleted<>1 and user.suspended<>1 
					        ORDER BY user.id, user.idnumber";
					$res = $CONBCN->consulta($sql);
					foreach ($res as $rs) {
					?>
						<tr>
							<td id="<?php echo $_modulo."_".$rs->id; ?>"><?php echo $rs->idnumber; ?></td>
							<td><?php echo utf8_encode($rs->firstname." ".$rs->lastname); ?></td>
							<td>
								<?php if ($rs->suspended==0){ ?>
									<span class="label label-sm label-success">Activo</span>
								<?php } else { ?>
									<span class="label label-sm label-warning">Inactivo</span>
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