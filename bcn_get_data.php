<?php 
    include_once("../config.php");
    include_once("lib/includes.php"); 

    $opc = formData("opc","post",1);
    $id = formData("id","post",0);

    if ($opc=="getCategorias"){
        $categoriaid = formData("categoriaid","post",0);
        $disabled = formData("disabled","post",0);
        $disabled = ($disabled==0) ? false : true;
        $sql = "select cat.id, cat.nombre_cat, secc.nombre_sec as grupo
                from cer_categoria cat
                inner join cer_secciones secc on cat.seccionid = secc.id  
                where secc.certificaid = $id and cat.estado = 1 
                order by secc.orden, cat.orden";

        $arr_tipo = traerGrupoTipoArray($sql,"id","nombre_cat");
        $CTRL->selectGroup(array("ID"=>"categoriaid", "VALUE"=>$categoriaid, "LABEL"=>"Categor&iacute;a", "ITEMS"=>$arr_tipo, "PLACEHOLDER" => "Seleccione", "DISABLED"=>$disabled )); 
    }
?>