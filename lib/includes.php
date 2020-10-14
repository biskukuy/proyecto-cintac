<?php
session_start();
error_reporting(-1);
// Inclusion de Clases y Funciones
include_once("php/config.php");
include_once("php/class_conexion.php");
include_once("php/class_controles.php");
include_once("php/bcn_funciones.php");
include_once("php/bcn_directorio.php");

// Datos del Usuario Disponibles en una variable $USUARIO
if (empty($_SESSION["BCN_USUARIO"])){	
	$_SESSION["BCN_USUARIO"] = array ("ID" => 0, "NOMBRE_USUARIO" => "INVITADO", "LOGIN" => "", "PERFIL" => "", "CORREO" => "");
} 

if (empty($_SESSION["BCN_SERIAL"])){	
	$_SESSION["BCN_SERIAL"] = 0;
} 

$_SESSION["BCN_USUARIO"] = array ("ID" => 1, "NOMBRE_USUARIO" => "ADMINISTRADOR", "LOGIN" => "admin", "PERFIL" => 1, "CORREO" => "");

$USUARIO = new stdClass();
$USUARIO->id = $_SESSION["BCN_USUARIO"]["ID"];
$USUARIO->nombre_usuario = $_SESSION["BCN_USUARIO"]["NOMBRE_USUARIO"];
$USUARIO->login = $_SESSION["BCN_USUARIO"]["LOGIN"];
$USUARIO->perfil = $_SESSION["BCN_USUARIO"]["PERFIL"];
$USUARIO->correo = $_SESSION["BCN_USUARIO"]["CORREO"];

// Inicializacion del Objeto de Conexion a la BD
$CONBCN = new ConexionBCN();
$CTRL = new controlesBCN();
?>