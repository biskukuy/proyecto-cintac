<?php
	$salida = formData("tp_salida","request",0);
    $borde = "";
    $borde_simple = "";
    $arr_size = array("P" => "portrait", "L" => "landscape");
    if (!isset($orientacion)){ $orientacion = "P"; }
    if (!isset($nombre_reporte)){ $nombre_reporte = ""; }

	switch($salida){
		
		case "1":
            $borde = ' style="border:solid #999999;" ';
            $borde_simple = ' border:solid #999999; ';
            //header("Content-Type= text/html;charset=utf-8");
            header("Content-Type: application/vnd.ms-excel");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename={$nombre_reporte}".date("Y").date("m").date("d").".xls");
            echo "<html>";
            echo "<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">";
            echo "</head>";
            echo "<body>";			
		break;

		case "2":
			$diseno = $orientacion;
			$pagina = "LETTER";
			$izq = 10;
			$der = 10;
			$arr = 10;
			$aba = 10;
            if ($diseno=="L") $pagina = $pagina."-".$diseno;
			
			include_once('lib/php/mpdf57/mpdf.php');
			define('_MPDF_PATH','lib/php/mpdf57/');
			$mpdf=new mPDF('win-1252',$pagina,'9','',$izq,$der,$arr,$aba,10,10);
			$mpdf->useOnlyCoreFonts = true; 
			$mpdf->SetDisplayMode('fullpage');		
			
			ob_start();	
            crearEncabezado($titulo_reporte,$subtitulos_reporte);
		break;

        case "3":   
        ?>
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                
                <title><?php echo  $nombre_reporte; ?></title>
                <link rel="stylesheet" href="assets/css/bootstrap.min2.css" />
                <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
                <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
                <style type="text/css">
                    @page {size: letter <?php echo $arr_size[$orientacion]; ?>; }
                </style>
                <script type="text/javascript">
                    if (window.history) {
                        function noBack(){window.history.forward()}
                        noBack();
                        window.onload=noBack;
                        window.onpageshow=function(evt){if(evt.persisted)noBack()}
                        window.onunload=function(){void(0)}
                    }
                </script>
            </head>
            <body style="background-color:#FFF;">
                <?php crearEncabezado($titulo_reporte,$subtitulos_reporte); ?>
        <?php
        break;
		
	}

	function crearEncabezado($titulo,$subtitulos=""){
		?>
        	<table width="100%" cellpadding="4" cellspacing="0">
			<tr>
            	<td style="width:200px;text-align:center;vertical-align:middle;"><?php if (file_exists("assets/images/logo_reporte.png")){ ?><img src="assets/images/logo_reporte.png" /><?php } else { ?> LOGO <?php } ?></td>
            	<td><h3><?= $titulo; ?></h3></td>
            </tr>            
			<tr>
            	<td style="text-align:left;" colspan="2" class="subtitulo_reporte"><?= $subtitulos; ?></td>
            </tr>            
			<tr>
            	<td style="text-align:center;" colspan="2">&nbsp;</td>
            </tr>            
            </table>
        <?php
	}

?>