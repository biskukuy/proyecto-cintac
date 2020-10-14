<?php
	include_once("../config.php");
	if ($USER->id==2 || $USER->skype =='1'){
		//COMPARACION PARA
		//echo "$USER->msn -> ";
		if(intval($USER->msn) == 1  ){
			 $USUARIO->perfil=2;
		} else
		  $USUARIO->perfil=3;

		//echo $USUARIO->perfil;
		include_once("lib/includes.php");
			//Validar Usuario Validado
			usuarioValidado();

			$menu = formData("menu","post","Panel");

			//Se determina los archivos que utilizara la opcion de menu
			$archivos=$DIRECTORIO[$menu];
			$descriptor = "";
			//Se incluye los archivos de transacciones
			if (is_array($archivos)){
				if (array_key_exists("descriptor",$archivos)){
					$descriptor = $archivos["descriptor"];
				}
				if (array_key_exists("controlador",$archivos)){
					include_once("bcn_control/".$archivos["controlador"]);
				}
			}

			include_once("lib/include_mensajes.php");
		?>
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
				<meta charset="utf-8" />
				<title>Admin KDM</title>

				<meta name="description" content="with draggable and editable events" />
				<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

				<!--<link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">-->
				<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

				<!-- bootstrap & fontawesome -->
				<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
				<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

				<!-- page specific plugin styles -->
				<link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
				<link rel="stylesheet" href="assets/css/chosen.min.css" />

				<!-- inline styles customized -->
				<?php
					if (is_array($archivos)){
						if (array_key_exists("css",$archivos)){
							echo $archivos["css"];
						}
					}
				?>

				<!-- Editor -->
				<link rel="stylesheet" href="assets/js/summernote/summernote.css" />
				<!-- text fonts -->
				<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

				<!-- ace styles -->
				<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

				<!--[if lte IE 9]>
					<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
				<![endif]-->
				<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
				<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

				<!--[if lte IE 9]>
				  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
				<![endif]-->


				<!-- ace settings handler -->
				<script src="assets/js/ace-extra.min.js"></script>
				<link rel="stylesheet" href="assets/css/jquery-confirm.min.css" />
				<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

				<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

				<!--[if lte IE 8]>
				<script src="assets/js/html5shiv.min.js"></script>
				<script src="assets/js/respond.min.js"></script>
				<![endif]-->
				<style>
					.fc-event .fc-content{ cursor: pointer; }
					.tooltipevent{ width:200px; background:#ECF2F7; color:#333; border: solid 1px #999; position:absolute; z-index:10001; padding: 2px; }
				</style>
			</head>

			<body class="no-skin">
				<div id="page-loader"><span class="preloader-interior"></span></div>
				<div id="navbar" class="navbar navbar-default ace-save-state">
					<div class="navbar-container ace-save-state" id="navbar-container">
						<?php
							if ($USUARIO->id > 0){
						?>
						<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
							<span class="sr-only">Toggle sidebar</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<?php
						}
						?>
						<div class="navbar-header pull-left">
							<a href="<?php echo $GLOBALES["path"]; ?>" class="navbar-brand">
								<small style="vertical-align: middle;">
									<div class="bcnicon_2">A</div>
									&nbsp;&nbsp;Admin KDM
								</small>
							</a>
						</div>

						<div class="navbar-buttons navbar-header pull-right" role="navigation">
							<ul class="nav ace-nav">
								<li class="light-blue">
									<a href="<?php echo $CFG->wwwroot; ?>"><i class="fa fa-hand-o-left"></i> Volver al Campus</a>
								</li>

								<li class="light-blue dropdown-modal">
									<a data-toggle="dropdown" href="#" class="dropdown-toggle">
										<img class="nav-user-photo" src="assets/images/avatars/avatar2.png" alt="<?php echo $USUARIO->nombre_usuario; ?>" />
										<span class="user-info">
											<?php echo $USUARIO->nombre_usuario; ?>
										</span>
										<i class="ace-icon fa fa-caret-down"></i>
									</a>
									<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
									<?php
										if ($USUARIO->id > 0){
									?>
										<li onclick="loadProgram('CerrarSesion');">
											<a href="#">
												<i class="ace-icon fa fa-power-off"></i>
												Cerrar Sesi&oacute;n
											</a>
										</li>
									<?php
									} else {
									?>
										<li>
											<a href="login.php">
												<i class="ace-icon fa fa-plug"></i>
												Iniciar Sesi&oacute;n
											</a>
										</li>
									<?php
									}
									?>
									</ul>
								</li>
							</ul>
						</div>
					</div><!-- /.navbar-container -->
				</div>

				<div class="main-container ace-save-state" id="main-container">
					<script type="text/javascript">
						try{ace.settings.loadState('main-container')}catch(e){}
					</script>

					<?php
						if ($USUARIO->id > 0){
					?>
					<div id="sidebar" class="sidebar responsive ace-save-state">
						<script type="text/javascript">
							try{ace.settings.loadState('sidebar')}catch(e){}
						</script>

						<ul class="nav nav-list">
							<li class="">
								<a href="<?php echo $GLOBALES["path"]; ?>">
									<i class="menu-icon fa fa-tachometer"></i>
									<span class="menu-text"> Dashboard </span>
								</a>

								<b class="arrow"></b>
							</li>

							<?php
								$temp_mod = "";
								if(intval($USER->msn) >= 1 and  intval($USER->msn) <=4  ){
									 $USUARIO->perfil=2;
								}  // else						 $USUARIO->perfil=3;

								//echo "perfil:  $USUARIO->perfil msn:$USER->msn";

								foreach($DIRECTORIO as $key => $opc){
									if ($opc["menu"] && in_array($USUARIO->perfil,$opc["perfiles"])){
										if ($temp_mod!=$opc["modulo"]){
											if ($temp_mod!=""){
											?>
											</ul>
										</li>
											<?php
											}
										?>
										<li class="open">
											<a href="#" class="dropdown-toggle">
												<i class="menu-icon fa fa-arrow-circle-o-right"></i>
												<span class="menu-text"> <?php echo $opc["modulo"]; ?> </span>
												<b class="arrow fa fa-angle-down"></b>
											</a>
											<b class="arrow"></b>
											<ul class="submenu">
										<?php
											$temp_mod=$opc["modulo"];
										}
									?>
												<li class="" onclick="loadProgram('<?php echo $key; ?>');">
													<a href="#">
														<i class="menu-icon fa fa-caret-right"></i>
														<?php echo $opc["descriptor"]; ?>
													</a>
													<b class="arrow"></b>
												</li>
									<?php
									}
								}
								if ($temp_mod!=""){
								?>
											</ul>
										</li>
								<?php
								}
							?>
						</ul><!-- /.nav-list -->

						<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
							<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
						</div>
					</div>
					<?php } ?>

					<div class="main-content">
						<form id="mainform" name="mainform" method="post">
						<input type="hidden" name="menu" id="menup" value="Calendario">
						</form>
						<div class="main-content-inner">
							<div class="breadcrumbs ace-save-state" id="breadcrumbs">
								<ul class="breadcrumb">
									<li>
										<i class="ace-icon fa fa-home home-icon"></i>
										<a href=".">Home</a>
									</li>
									<li class="active"><?php echo formatTitle($descriptor); ?></li>
								</ul><!-- /.breadcrumb -->
							</div>

							<div class="page-content">

								<?php
									if ($MENSAJE->texto!=""){
								?>
									<div id="bcn_mensaje" class="alert <?php echo $MENSAJE->clase; ?>">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>
										<p>
											<strong>
												<i class="ace-icon fa fa-check"></i>
												<?php echo $MENSAJE->texto; ?>
											</strong>
											<?php echo $MENSAJE->texto_2; ?>
											<?php
												if ($MENSAJE->nota!=""){
													echo "<br><b>Nota:</b> ".$MENSAJE->nota;
												}
											?>
										</p>
									</div>
								<?php
										$_SESSION["BCN_MENSAJE"] = array ("TEXTO" => "", "TEXTO2" => "", "NOTA" => "", "TIPO" => "INFO", "DURACION" => "4000");
									}

									//Se incluye los archivos de Vista
									if (is_array($archivos)){
										if (array_key_exists("vista",$archivos)){
											include_once($archivos["vista"]);
										}
									}
								?>
							</div><!-- /.page-content -->

						</div>
					</div><!-- /.main-content -->

					<div class="footer">
						<div class="footer-inner">
							<div class="footer-content">
								<span class="bigger-120">
									<span class="bolder">Admin</span>
									KDM &copy; <?php echo date("Y"); ?>
								</span>
							</div>
						</div>
					</div>

					<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
						<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
					</a>
				</div><!-- /.main-container -->
				<!-- basic scripts -->



				<!--[if !IE]> -->
				<script src="assets/js/jquery-2.1.4.min.js"></script>
				<!-- <![endif]-->

				<!--[if IE]>
				<script src="assets/js/jquery-1.11.3.min.js"></script>
				<![endif]-->
				<script type="text/javascript">
					var bcn_duracion = <?php echo $MENSAJE->duracion; ?>;
					if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
				</script>
				<script src="assets/js/bootstrap.min.js"></script>

				<!-- page specific plugin scripts -->
				<script src="assets/js/jquery-ui.custom.min.js"></script>
				<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
				<script src="assets/js/chosen.jquery.min.js"></script>
				<script src="assets/js/moment.min.js"></script>
				<script src="assets/js/bootstrap-datepicker.min.js"></script>
				<script src="assets/js/bootbox.js"></script>
				<script src="assets/js/jquery-confirm.min.js"></script>

				<!-- ace scripts -->
				<script src="assets/js/ace-elements.min.js"></script>
				<script src="assets/js/ace.min.js"></script>
				<script src="assets/js/bcn.js"></script>

				<?php
					//Se incluye los archivos Script
					if (is_array($archivos)){
						if (array_key_exists("script",$archivos)){
							include_once("bcn_script/".$archivos["script"]);
						}
					}
				?>
				<script> $(window).load(function(){ $('#page-loader').fadeOut(500);	});	</script>
			</body>
		</html>
	<?php
	} else {
		header('Location: '.$CFG->wwwroot);
	}
	?>