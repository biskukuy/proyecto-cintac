		<div class="page-header">
			<h1>
				<?php echo formatTitle($menu); ?>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<div class="row">
					<div id="div_left" class="col-sm-12">
						<?php 
							$CTRL->basicForm($modulo); 
							$CTRL->inputHidden(array("ID"=>"menu", "VALUE"=>$menu));
							$CTRL->inputHidden(array("ID"=>"accionclave", "VALUE"=>"GuardarClave"));
						?>
							<div class="form-group">
								<?php $CTRL->inputText(array("ID"=>"usuario", "VALUE"=>$USUARIO->login, "LABEL"=>"Login (Usuario)", "PLACEHOLDER"=>"pperez", "READONLY"=>true)); ?>
							</div>
							<div class="form-group">
								<?php $CTRL->inputPassword(array("ID"=>"password", "LABEL"=>"Clave Actual", "PLACEHOLDER"=>"*****", "REQUIRED"=>true)); ?>
							</div>
							<div class="form-group">
								<?php $CTRL->inputPassword(array("ID"=>"password_new", "LABEL"=>"Nueva Clave", "PLACEHOLDER"=>"*****", "REQUIRED"=>true)); ?>
							</div>
						<?php 
							$CTRL->basicButtons($modulo);
							$CTRL->endForm(); 
						?>					
					</div>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->