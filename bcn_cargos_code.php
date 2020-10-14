<?php
include_once("../config.php");
include_once("lib/includes.php"); 
$idplanta2=$_POST['idplanta'];
$idcargo=$_POST['idcargo'];

if($idplanta2){
    $tabla = "bcn_cargo";
    $where = array("idcargo" => $idcargo);
	$res3 = $CONBCN->seleccionar($tabla,"*",$where);
	foreach ($res3 as $rs3) {
		$idunidad = $rs3->idunidad;
	}
	
    $arr_tipo4 = traerDatosTipoArray("bcn_unidad_negocio","idunidad","nombre",array("visible" => 1,"idplanta" => $idplanta2));
    $CTRL->select(array("ID"=>"idunidad", "VALUE"=>$idunidad, "LABEL"=>"Unidad", "REQUIRED"=>true, "ITEMS"=>$arr_tipo4, "COL_FIELD" => 3, "DISABLED"=>$disabled ));
}

?>