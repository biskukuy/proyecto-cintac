<?php
		$modulo = "Matricula";
		$_modulo = strtolower($modulo);
		$tabla = "mdl_user";
		$contextlevel = 50;	
		if($USUARIO->id){
			$accionBCN = formData("accion{$_modulo}","post","Mostrar{$modulo}s");

			if ($accionBCN=="Guardar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";

				$id = formData("idmatricula","post",0);
				$username = formData("username","post","");
				$password = formData("password","post","");
				$password_act = formData("password_act","post","");
				$idnumber = formData("idnumber","post","");
				$firstname = utf8_decode(formData("firstname","post",""));
				$lastname = utf8_decode(formData("lastname","post",""));
				$direccion = utf8_decode(formData("direccion","post",""));
				$phone1 = formData("phone1","post","");
				$email = formData("email","post","");
				$institution = formData("institution","post","");
				$sucursal = utf8_decode(formData("sucursal","post",""));
				$city = utf8_decode(formData("city","post",""));
				$skype  = formData("skype","post","");
				$cargo = formData("cargo","post","");
				$suspended = formData("suspended","post",0);
				$lista_cursos = formData("lista_cursos","post");
				//print_r($lista_cursos);

				if ($id>0){
					if ($password!=$password_act){
						$password = password_hash($password, PASSWORD_DEFAULT);						
					}
				} else {
					$password = password_hash($password, PASSWORD_DEFAULT);											
				}

				if (serialValido()){
					$time = time();

					$campos = array(
						"id" => $id,
						"username" => $username,
						"password" => $password,
						"idnumber" => $idnumber,
						"firstname" => $firstname,
						"lastname" => $lastname,
						"address" => $direccion,
						"phone1" => $phone1,
						"email" => $email,
						"institution" => $institution,
						"city" => $city,
						"suspended" => $suspended,
						'lang' => 'es', 
						'timecreated' => $time, 
						'confirmed' => 1, 
						'mnethostid' => 1						
                    ); 
					$duplicidad = array("username" => $username);
					if ($id==0){
						//Se comprueba si existe un usuario con el mismo username
						if (!$CONBCN->existe($tabla,$duplicidad)){
							//Se inserta los datos del Usuario
							if ($CONBCN->insertar($tabla,$campos)){
								$id = $CONBCN->ultimo_id;

								// Se guardan los datos adicionales del usuario
								$profile_sucursal = array("userid" => $id, "fieldid" => 3, "data" => $sucursal);
								$CONBCN->insertar("mdl_user_info_data",$profile_sucursal);

								$profile_cargo = array("userid" => $id, "fieldid" => 2, "data" => $cargo);
								$CONBCN->insertar("mdl_user_info_data",$profile_cargo);
								
								//Se matricula en los cursos seleccionados
								if (is_array($lista_cursos)){
									foreach ($lista_cursos as $curso) {
										$enrolid = traerValor("mdl_enrol","id",array("courseid" => $curso, "enrol" => "manual"));
										if ($enrolid>0){
											$time = time();
											$enrolment =  array('status' => 0,
									                            'enrolid' => $enrolid,
									                            'userid' => $id,
									                            'timestart' => $time,
									                            'timeend' => 0,
									                            'modifierid' => 0,
									                            'timecreated' => $time,
									                            'timemodified' => $time 
									                        );
											$CONBCN->insertar("mdl_user_enrolments",$enrolment);

											$context = traerValor("mdl_context","id",array("instanceid" => $curso, "contextlevel" => $contextlevel));
											$enrolment2 =  array('roleid' => 5,
									                            'contextid' => $context,
									                            'userid' => $id,
									                            'timemodified' => $time,
									                            'modifierid' => 0,
									                            'component' => 0,
									                            'itemid' => 0,
									                            'sortorder' => 0 
									                        );

											$CONBCN->insertar("mdl_role_assignments",$enrolment2);
										}
									}
								}

								mensajeHecho($modulo."s","","a");	
							} else { 
								mensajeError($modulo."s"); 
							}
						} else {
							mensajeExiste($modulo."s");
						}
					} else {
						$where = array("id" => $id);
						if (!$CONBCN->existe($tabla,$duplicidad,$where)){
							//Se actualizan los datos del usuario
							if ($CONBCN->actualizar($tabla,$campos,$where)){

								//Se actualizan los datos adicionales del usuario
								$profile_sucursal = array("data" => $sucursal);
								$w_profile_sucursal = array("userid" => $id, "fieldid" => 3);
								$CONBCN->actualizar("mdl_user_info_data",$profile_sucursal,$w_profile_sucursal);

								$profile_cargo = array("data" => $cargo);
								$w_profile_cargo = array("userid" => $id, "fieldid" => 2);
								$CONBCN->actualizar("mdl_user_info_data",$profile_cargo,$w_profile_cargo);

								$arr_cursos = array();
								if (is_array($lista_cursos)){
									foreach ($lista_cursos as $curso) {
										$arr_cursos[$curso] = 1;
									}
								}

								// Se recorren los cursos en lo que se encuentra asignado y se borran lo que fueron quitados
								$sql = "SELECT uenrol.*, enrol.courseid 
										FROM mdl_user_enrolments uenrol 
										INNER JOIN mdl_enrol enrol ON uenrol.enrolid = enrol.id 
										WHERE uenrol.userid = {$id}";
								$res = $CONBCN->consulta($sql);
								foreach ($res as $rs) {

									$borrar = true;

									if (is_array($lista_cursos)){
										if (in_array($rs->courseid, $lista_cursos)){
											$borrar = false;
											$arr_cursos[$rs->courseid] = 0;	
										} 
									}

									if ($borrar){
										$context = traerValor("mdl_context","id",array("instanceid" => $rs->courseid, "contextlevel" => $contextlevel));

										$CONBCN->eliminar("mdl_course_modules_completion",array("userid" => $id, "courseid" => $rs->courseid));
										$CONBCN->eliminar("mdl_role_assignments",array("userid" => $id, "contextid" => $context));
										$CONBCN->eliminar("mdl_user_enrolments",array("id" => $rs->id));
									}
								}

								// Se agregan los nuevos cursos a los que fue asigando.

								//print_r($arr_cursos);
								if (is_array($arr_cursos)){
									foreach ($arr_cursos as $curso => $nuevo) {
										if ($nuevo==1){
											$enrolid = traerValor("mdl_enrol","id",array("courseid" => $curso, "enrol" => "manual"));
											if ($enrolid>0){
												$time = time();
												$enrolment =  array('status' => 0,
										                            'enrolid' => $enrolid,
										                            'userid' => $id,
										                            'timestart' => $time,
										                            'timeend' => 0,
										                            'modifierid' => 2,
										                            'timecreated' => $time,
										                            'timemodified' => $time 
										                        );
												$CONBCN->insertar("mdl_user_enrolments",$enrolment);

												$context = traerValor("mdl_context","id",array("instanceid" => $curso, "contextlevel" => $contextlevel));
												$enrolment2 =  array('roleid' => 5,
										                            'contextid' => $context,
										                            'userid' => $id,
										                            'timemodified' => $time,
										                            'modifierid' => 2,
										                            'component' => 0,
										                            'itemid' => 0,
										                            'sortorder' => 0 
										                        );

												$CONBCN->insertar("mdl_role_assignments",$enrolment2);
											}
										}
									}
								}

								mensajeHecho($modulo."s","actualizar","a");	
							} else {
								mensajeError($modulo."s","actualizar"); 
							}
						} else {
							mensajeExiste($modulo."s");
						}
					}
				} else { mensajeDuplicidad(); }
			}
			if ($accionBCN=="Eliminar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$id = formData("idmatricula","post",0);
				if (serialValido()){
					$where = array("id" => $id);

					// Se eliminan las transacciones y matriculas del usuario
					$CONBCN->eliminar("mdl_course_modules_completion",array("userid" => $id));
					$CONBCN->eliminar("mdl_user_enrolments",array("userid" => $id));

					// Se eleimina el usuario
					if ($CONBCN->eliminar($tabla,$where)){
						mensajeHecho($modulo."s","eliminar","a");	
					} else {
						mensajeError($modulo."s","eliminar"); 
					}

				} else { mensajeDuplicidad(); }
			}
		}
?>