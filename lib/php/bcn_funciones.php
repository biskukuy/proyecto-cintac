<?php
	function formData($field, $method="", $default=""){
		$valor = $default;
		if ($method=="post"){
			if (!empty($_POST[$field])){ $valor = $_POST[$field]; } 
		} else if ($method=="get"){
			if (!empty($_GET[$field])){ $valor = $_GET[$field]; } 
		} else {
			if (!empty($_REQUEST[$field])){ $valor = $_REQUEST[$field]; } 
		}

		return $valor;
	}

	function gFecha($fecha,$sep = "-"){
		if ($fecha!=""){
			$arr = explode($sep,$fecha);
			$nfecha = $arr[2]."-".$arr[1]."-".$arr[0];
			return $nfecha;			
		}
		return $fecha;
	}

	function mFecha($fecha,$sep="-",$nsep="-"){
		if ($fecha!=""){
			$arr = explode($sep,$fecha);
			$nfecha = $arr[2].$nsep.$arr[1].$nsep.$arr[0];
			return $nfecha;
		}
		return $fecha;
	}

	function formatoGuardar($valor){
		$valor = base64_encode($valor);
		return $valor;
	}

	function formatoMostrar($valor){
		$valor = base64_decode($valor);
		return $valor;
	}

	function getUltimoDiaMes($anio,$mes){
	  return date("d",(mktime(0,0,0,$mes+1,1,$anio)-1));
	}

	function validarUsuario($usuario, $password){
		global $CONBCN, $GLOBALES;
		$password = crypt($password,$GLOBALES["char_crypt"]);
		$usuario = $CONBCN->real_escape($usuario);
		$where = array("usuario" => $usuario, "password" => $password);
		$res = $CONBCN->seleccionar("lms_usuarios","*",$where);
		if ($CONBCN->nro_filas > 0){
			foreach($res as $rs){
				if ($rs->estatus == 1){
					$_SESSION["BCN_USUARIO"] = array ("ID" => $rs->idusuario, "NOMBRE_USUARIO" => $rs->nombre_usuario, "LOGIN" => $rs->usuario, "PERFIL" => $rs->perfil, "CORREO" => $rs->email);
					return array ("ID" => $rs->idusuario, "MENSAJE_1" => "", "MENSAJE_2" => "");
				} else {
					return array ("ID" => 0, "MENSAJE_1" => "Usuario Bloqueado","MENSAJE_2" => "Por favor contacte al Administrador del Sistema");
				}
			}
		} else {
			return array ("ID" => 0, "MENSAJE_1" => "Error en Usuario y/o Password","MENSAJE_2" => "Por favor verifique sus credenciales");
		}
	}

	function actualizarClave($idusuario, $password){
		global $CONBCN, $GLOBALES;
		$password = crypt($password,$GLOBALES["char_crypt"]);
		$campos = array( "password" => $password);
		$where = array("idusuario" => $idusuario);
		return $CONBCN->actualizar("lms_usuarios",$campos,$where);
	}

	function validarCorreo($correo){
		global $CONBCN;
		$where = array("email" => $correo);
		$res = $CONBCN->seleccionar("lms_usuarios","*",$where," limit 1 ");
		if ($CONBCN->nro_filas > 0){
			foreach($res as $rs){
				return array ("ID" => $rs->idusuario, "nombre_usuario" => $rs->nombre_usuario);
			}
		} else {
			return array ("ID" => 0, "MENSAJE_1" => "Correo no existe", "MENSAJE_2" => "Por favor contacte al Administrador del Sistema");
		}
	}

	function usuarioValidado(){
		/*
		global $USUARIO, $GLOBALES;
		if ($USUARIO->id == 0){
			header("location:".$GLOBALES["path"]."/login.php");
		}
		*/
	}

	function tipoMensaje($tipo=""){
		if ($tipo=="HECHO"){
			$class = "alert-success";
		} else if ($tipo=="ERROR"){
			$class = "alert-danger";
		} else {
			$class = "alert-info";
		}
		return $class;
	}

	function listaCorreos($ids=0){
		global $CONBCN;
		$lst_correos = "";
		$sql = "select email from bcn_usuarios where idusuario in ({$ids})";
		$res = $CONBCN->consulta($sql);
		foreach($res as $rs){
			if ($lst_correos!="") $lst_correos .= ",";
			$lst_correos .= $rs->email;
		}
		return $lst_correos;
	}

	function listaNombres($ids=0){
		global $CONBCN;
		$lst_nombres = "";
		$sql = "select nombre_usuario from bcn_usuarios where idusuario in ({$ids})";
		$res = $CONBCN->consulta($sql);
		foreach($res as $rs){
			if ($lst_nombres!="") $lst_nombres .= ",";
			$lst_nombres .= $rs->nombre_usuario;
		}
		return $lst_nombres;
	}

	function traerValor($tabla,$campo,$where){
		global $CONBCN;
		$nValor = "";
		$res = $CONBCN->seleccionar($tabla,$campo,$where," limit 1 ");
		foreach($res as $rs){
			$nValor = $rs->$campo;
		}

		return $nValor;
	}

	function traerGrupoTipoArray($sql,$id,$texto,$vacio=false){
		global $CONBCN;
		$arr = array();
		if (is_array($texto)){
			$campos = $texto["campos"];
			$alias = $texto["alias"];
		} else {
			$campos = $texto;
			$alias = $texto;
		}

		if ($vacio){ $arr[0]="Seleccione"; }
		$res = $CONBCN->consulta($sql);
		foreach($res as $rs){
			$arr[$rs->$id]=array("valor" => $rs->$alias, "grupo" => $rs->grupo);
		}

		return $arr;
	}

	function traerDatosTipoArray($tabla,$id,$texto,$where="",$vacio=false){
		global $CONBCN;
		$arr = array();
		$where = (array) $where;
		if (is_array($texto)){
			$campos = $texto["campos"];
			$alias = $texto["alias"];
		} else {
			$campos = $texto;
			$alias = $texto;
		}

		if ($vacio){ $arr[0]="Seleccione"; }
		$res = $CONBCN->seleccionar($tabla,"{$id}, {$campos}",$where," order by {$texto}");
		foreach($res as $rs){
			$arr[$rs->$id]=$rs->$alias;
		}

		return $arr;
	}

	function traerDatosTipoArraySql($sql,$id,$texto,$where="",$vacio=false){
		global $CONBCN;
		$arr = array();
		$where = (array) $where;
		if (is_array($texto)){
			$campos = $texto["campos"];
			$alias = $texto["alias"];
		} else {
			$campos = $texto;
			$alias = $texto;
		}

		if ($vacio){ $arr[0]="Seleccione"; }
		$res = $CONBCN->consulta($sql);
		foreach($res as $rs){
			$arr[$rs->$id]=$rs->$alias;
		}

		return $arr;
	}

	function serialValido(){
		$bcn_serial = formData("bcn_serial","post","");
		if ($_SESSION["BCN_SERIAL"]!=$bcn_serial){
			$_SESSION["BCN_SERIAL"]=$bcn_serial;
			return true;
		}

		return false;
	}

	function genererClaveAleatoria(){
		$cadena = "abcdefghijklmnopqrstuvwxyz*/#()&ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$cad_session = "";
		for ($i=0; $i<=6;$i++){
			$pos = rand(1,strlen($cadena));
			$cad_session .= substr($cadena,$pos,1);
		}

		return $cad_session;
	}

	function nombreMes($numero){
		$mes = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$numero = intval($numero);
		return $mes[$numero];
	}

	function maxValor($array){
		$max = 0;
		if (is_array($array)){
			foreach($array as $val){
				if ($max<$val) $max=$val;
			}
		}
		return $max;
	}

	function obtenerColor($porcentaje){
		$color = "";
		if ($porcentaje >=0 && $porcentaje <= 40) $color = "#DA5430"; 
		if ($porcentaje >=41 && $porcentaje <= 60) $color = "#ECCB71"; 
		if ($porcentaje >=61 && $porcentaje <= 100) $color = "#68BC31"; 
		return $color;
	}

	function formatTitle($title){
		$title = str_replace("_"," ",$title);
		return $title;
	}

	function mensajeDuplicidad(){
		$_SESSION["BCN_MENSAJE"]["TEXTO"] = "La duplicidad de transaccion no esta permitida";
		$_SESSION["BCN_MENSAJE"]["TEXTO2"] = " Por favor intente de nuevo";
		$_SESSION["BCN_MENSAJE"]["TIPO"] = "ERROR";							
	}

	function mensajeError($modulo, $tipo="crear",$adicional=""){
		if ($tipo=="crear"){
			$_SESSION["BCN_MENSAJE"]["TEXTO"] = "No se pudo crear {$modulo}. {$adicional}";
			$_SESSION["BCN_MENSAJE"]["TEXTO2"] = " Por favor intente de nuevo";
			$_SESSION["BCN_MENSAJE"]["TIPO"] = "ERROR";
		} else if ($tipo=="actualizar"){
			$_SESSION["BCN_MENSAJE"]["TEXTO"] = "No se pudo actualizar {$modulo}. {$adicional}";
			$_SESSION["BCN_MENSAJE"]["TEXTO2"] = " Por favor intente de nuevo";
			$_SESSION["BCN_MENSAJE"]["TIPO"] = "ERROR";
		} else if ($tipo=="eliminar"){
			$_SESSION["BCN_MENSAJE"]["TEXTO"] = "No se pudo eliminar {$modulo}. {$adicional}";
			$_SESSION["BCN_MENSAJE"]["TEXTO2"] = " Por favor intente de nuevo";
			$_SESSION["BCN_MENSAJE"]["TIPO"] = "ERROR";			
		} else {
			$_SESSION["BCN_MENSAJE"]["TEXTO"] = "{$adicional}";
			$_SESSION["BCN_MENSAJE"]["TEXTO2"] = "";
			$_SESSION["BCN_MENSAJE"]["TIPO"] = "ERROR";			
		}
	}

	function mensajeHecho($modulo, $tipo="crear", $sufijo="o"){
		$_SESSION["BCN_MENSAJE"]["TIPO"] = "HECHO";
		$_SESSION["BCN_MENSAJE"]["TEXTO2"] = "";
		if ($tipo=="eliminar"){
			$_SESSION["BCN_MENSAJE"]["TEXTO"] = "{$modulo} eliminad{$sufijo} con &eacute;xito";
		} else if ($tipo=="actualizar"){
			$_SESSION["BCN_MENSAJE"]["TEXTO"] = "{$modulo} actualizad{$sufijo} con &eacute;xito";
		} else {
			$_SESSION["BCN_MENSAJE"]["TEXTO"] = "{$modulo} cread{$sufijo} con &eacute;xito";
		}
	}

	function mensajeExiste($modulo){
		$_SESSION["BCN_MENSAJE"]["TEXTO"] = "Ya existe un registro de {$modulo}.";
		$_SESSION["BCN_MENSAJE"]["TEXTO2"] = " Por favor intente de nuevo";
		$_SESSION["BCN_MENSAJE"]["TIPO"] = "ERROR";
	}

	function mensajePersonalizado($tipo,$texto,$texto2=""){
		$_SESSION["BCN_MENSAJE"]["TEXTO"] = $texto;
		$_SESSION["BCN_MENSAJE"]["TEXTO2"] = $texto2;
		$_SESSION["BCN_MENSAJE"]["TIPO"] = $tipo;
	}

	function enviarCorreo($asunto,$destinatarios,$mensaje){
		include_once('lib/php/PHPMailer/class.phpmailer.php');
		include_once('lib/php/PHPMailer/class.smtp.php');
		$enviados = 0;		
		$arr_destinatarios = explode(",",$destinatarios);
		$correo = "bcnschoolweb@gmail.com";
		$mail = new PHPMailer();
		//$mail->IsSMTP();
		$mail->CharSet = 'UTF-8';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );		
		$mail->Username = $correo;	
		$mail->Password = "Bcnschool_2016";						
		$mail->AddReplyTo($correo, $asunto);
		$mail->SetFrom($correo, $asunto);
		$mail->Subject = $asunto;
		foreach ($arr_destinatarios as $correo){
            $mail->MsgHTML($mensaje); 
            $mail->AddAddress($correo);
			if($mail->Send()){ $enviados++; }
            $mail->ClearAddresses();                    
		}
		if($enviados>0){
			$_SESSION["BCN_MENSAJE"]["TEXTO2"] = "Correos Enviados";
		} else {
			$_SESSION["BCN_MENSAJE"]["TEXTO2"] = "No se puedo enviar los correos";
		}
	}

	function textoParaExcel($texto, $excel=0){
		if ($excel==1 || $excel==2){
			$texto = utf8_decode($texto);
		} 
		return $texto;
	}

?>