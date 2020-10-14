<?php

	$arr_modulos = array(
							"Gesti&oacute;n",
							"Reportes"
						);

	$DIRECTORIO = array (
		'CerrarSesion' => array(
								'controlador' => 'cerrar_sesion.php',
								'menu' => false
							 ),
		'Cambio_de_Clave' => array(
								'controlador' => 'ctrl_cambio_clave.php',
								'vista' => 'bcn_cambio_clave.php',
								'script' => 'sc_cancel.php',
								'menu' => false
							 ),
		'Panel' => array(
								'vista' => 'bcn_panel.php',
								'script' => 'sc_panel.php',
								'menu' => false
							 ),
		'Matriculas' => array(
								'descriptor' => 'Matriculas',
								'controlador' => 'ctrl_matriculas.php',
								'vista' => 'bcn_matriculas.php',
								'script' => 'sc_matriculas.php',
								'perfiles' => array(1),
								'modulo' => $arr_modulos[0],
								'menu' => true
							 ),
		'Cursos' => array(
					 		     'descriptor' => 'Cursos',
					 			 'controlador' => 'ctrl_cursos.php',
					 			 'vista' => 'bcn_cursos.php',
					 			 'script' => 'sc_basic.php',
					 			 'perfiles' => array(1),
					 			 'modulo' => $arr_modulos[0],
					 			 'menu' => true
					 				),
		'Cintacs' => array(
								'descriptor' => 'Solicitudes',
								'controlador' => 'ctrl_cintacs.php',
								'vista' => 'bcn_cintacs.php',
								'script' => 'sc_cintacs.php',
								'perfiles' => array(1,2),
								'modulo' => $arr_modulos[0],
								'menu' => true
							 ),
		'Estatus' => array(
								'descriptor' => 'Cambiar Solicitudes',
								'controlador' => 'ctrl_estatus.php',
								'vista' => 'bcn_estatus.php',
								'script' => 'sc_estatus.php',
								'perfiles' => array(1,2),
								'modulo' => $arr_modulos[0],
								'menu' => true
							 ),


		'Plantas' => array(
					 		     'descriptor' => 'Plantas',
					 			 'controlador' => 'ctrl_plantas.php',
					 			 'vista' => 'bcn_plantas.php',
					 			 'script' => 'sc_basic.php',
					 			 'perfiles' => array(1),
					 			 'modulo' => $arr_modulos[0],
					 			 'menu' => false
					 				),
		'Cargos' => array(
					 		     'descriptor' => 'Cargos',
					 			 'controlador' => 'ctrl_cargos.php',
					 			 'vista' => 'bcn_cargos.php',
					 			 'script' => 'sc_cargos.php',
					 			 'perfiles' => array(1),
					 			 'modulo' => $arr_modulos[0],
					 			 'menu' => true
					 				),
        'UnidNegocios' => array(
					 		     'descriptor' => 'Unidad de Negocios',
					 			 'controlador' => 'ctrl_UnidNegocios.php',
					 			 'vista' => 'bcn_UnidNegocios.php',
					 			 'script' => 'sc_basic.php',
					 			 'perfiles' => array(1),
					 			 'modulo' => $arr_modulos[0],
					 			 'menu' => true
					 				),

		'Tiendas' => array(
					 		     'descriptor' => 'Plantas',
					 			 'controlador' => 'ctrl_tiendas.php',
					 			 'vista' => 'bcn_tiendas.php',
					 			 'script' => 'sc_basic.php',
					 			 'perfiles' => array(1),
					 			 'modulo' => $arr_modulos[0],
					 			 'menu' => true
					 				),




		'Tipos' => array(
					 		     'descriptor' => 'Tipo Contratacion',
					 			 'controlador' => 'ctrl_tipos.php',
					 			 'vista' => 'bcn_tipos.php',
					 			 'script' => 'sc_basic.php',
					 			 'perfiles' => array(1),
					 			 'modulo' => $arr_modulos[0],
					 			 'menu' => true
					 				),
		'Faqs' => array(
					 		     'descriptor' => 'Faqs',
					 			 'controlador' => 'ctrl_faq.php',
					 			 'vista' => 'bcn_faq.php',
					 			 'script' => 'sc_faqs.php',
					 			 'perfiles' => array(1),
					 			 'modulo' => $arr_modulos[0],
					 			 'menu' => false
					 				),
		'Videos' => array(
					 		     'descriptor' => 'Videos',
					 			 'controlador' => 'ctrl_videos.php',
					 			 'vista' => 'bcn_videos.php',
					 			 'script' => 'sc_basic.php',
					 			 'perfiles' => array(1),
					 			 'modulo' => $arr_modulos[0],
					 			 'menu' => false
					 				),
		'Noticias' => array(
					 		     'descriptor' => 'Noticias',
					 			 'controlador' => 'ctrl_noticias.php',
					 			 'vista' => 'bcn_noticias.php',
					 			 'script' => 'sc_faqs.php',
					 			 'perfiles' => array(1),
					 			 'modulo' => $arr_modulos[0],
					 			 'menu' => false
					 				),
		'Slideshows' => array(
					 		     'descriptor' => 'Slideshows',
					 			 'controlador' => 'ctrl_slideshows.php',
					 			 'vista' => 'bcn_slideshows.php',
					 			 'script' => 'sc_basic.php',
					 			 'perfiles' => array(1),
					 			 'modulo' => $arr_modulos[0],
					 			 'menu' => false
					 				),
		'Eventos' => array(
					 		     'descriptor' => 'Eventos',
					 			 'controlador' => 'ctrl_eventos.php',
					 			 'vista' => 'bcn_eventos.php',
					 			 'script' => 'sc_basic.php',
					 			 'perfiles' => array(1),
					 			 'modulo' => $arr_modulos[0],
					 			 'menu' => false
					 				),
		'Recursos' => array(
					 		     'descriptor' => 'Recursos',
					 			 'controlador' => 'ctrl_recursos.php',
					 			 'vista' => 'bcn_recursos.php',
					 			 'script' => 'sc_basic.php',
					 			 'perfiles' => array(1),
					 			 'modulo' => $arr_modulos[0],
					 			 'menu' => false
					 				),
		'Galerias' => array(
					 		     'descriptor' => 'Galerias',
					 			 'controlador' => 'ctrl_galerias.php',
					 			 'vista' => 'bcn_galerias.php',
					 			 'script' => 'sc_basic.php',
					 			 'perfiles' => array(1),
					 			 'modulo' => $arr_modulos[0],
					 			 'menu' => false
					 				),





	);
?>
