<?php
		$modulo = "Cargo";
		$_modulo = strtolower($modulo);
		$tabla = "bcn_cargo";
		if($USUARIO->id){
			$accionBCN = formData("accion{$_modulo}","post","Mostrar{$modulo}s");

			if ($accionBCN=="Guardar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$idcargo = formData("idcargo","post",0);
				$idunidad = formData("idunidad","post",0);
				$idplanta = formData("idplanta","post",0);
				$nombre = formData("nombre","post",0);
				$objetivo = formData("objetivo","post",0);

				$visible = formData("visible","post",0);

				if (serialValido()){
					$campos = array(
							"idcargo" => $idcargo,
							"idunidad" => $idunidad,
							"idplanta" => $idplanta,
							"nombre" => $nombre,
							"objetivo" => $objetivo,
							"visible" => $visible,

						);
					$duplicidad = array("nombre" => $nombre);
					if ($idcargo==0){
						if ($CONBCN->insertar($tabla,$campos)){
							mensajeHecho($modulo."s");
						} else {
							mensajeError($modulo."s");
						}
					} else {
						$where = array("idcargo" => $idcargo);
						if (!$CONBCN->existe($tabla,$duplicidad,$where)){
							if ($CONBCN->actualizar($tabla,$campos,$where)){
								mensajeHecho($modulo."s","actualizar");
							} else {
								mensajeError($modulo."s","actualizar");
							}
						} else {
							if ($CONBCN->actualizar($tabla,$campos,$where)){
								mensajeHecho($modulo."s","actualizar");
							} else {
								mensajeError($modulo."s","actualizar");
							}
						}
					}
				} else { mensajeDuplicidad(); }
			}
			if ($accionBCN=="Eliminar{$modulo}"){
				$accionBCN="Mostrar{$modulo}s";
				$idcargo = formData("idcargo","post",0);
				if (serialValido()){
					$where = array("idcargo" => $idcargo);
					$where2 = array("department" => '$idcargo');
					$res = $CONBCN->seleccionar("mdl_user","*",$where2," limit 1 ");
					if ($CONBCN->nro_filas == 0){
						if ($CONBCN->eliminar($tabla,$where)){
							mensajeHecho($modulo."s","eliminar");
						} else {
							mensajeError($modulo."s","eliminar");
						}
					} else {
						mensajeError($modulo."s","eliminar","Est&aacute; siendo utilizado en una o m&aacute;s Usuarios");
					}
				} else { mensajeDuplicidad(); }
			}
			//fin del if de eliminar

		}
/*
$idplanta2=$_POST['idplanta'];
$idcargo=$_POST['idcargo'];
if($idplanta2){
    include_once("../../config.php");
	include_once("../lib/includes.php"); 

    $where = array("idcargo" => $idcargo);
	$res3 = $CONBCN->seleccionar($tabla,"*",$where);
	foreach ($res3 as $rs3) {
		$idunidad = $rs3->idunidad;
	}
	
    $arr_tipo4 = traerDatosTipoArray("bcn_unidad_negocio","idunidad","nombre",array("visible" => 1,"idplanta" => $idplanta2));
    $CTRL->select(array("ID"=>"idunidad", "VALUE"=>$idunidad, "LABEL"=>"Unidad", "REQUIRED"=>true, "ITEMS"=>$arr_tipo4, "COL_FIELD" => 3, "DISABLED"=>$disabled ));
}
*/
	
?>