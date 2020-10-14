<?php

	switch($salida){
		
		case "1":
		?>
                </body>
            </html>
        <?php
		break;

		case "2":
			?>
            <?php
			$footer = '<div align="right"  style="font-family: Arial;font-size: 8px;">{DATE j-m-Y}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pag.{PAGENO}/{nbpg} </div>';
			$mpdf->SetHTMLFooter(utf8_encode($footer));
		
			$html=ob_get_contents();
			ob_end_clean();

			$stylesheet = file_get_contents('assets/css/bootstrap.min.css');
			$mpdf->WriteHTML($stylesheet,1);
		
			$mpdf->WriteHTML(utf8_encode($html));
			if ( strstr( strtoupper( $_SERVER['HTTP_USER_AGENT'] ) ,"MSIE" )!==true ) {
				$mpdf->Output($nombre_reporte . date("YmdHis") .'.pdf','I');
			} else {
				$mpdf->Output();
			}
		break;

		case "3":	
			?>
                </body>
            </html>
            <script>window.print();</script>
            <?php
		break;
		
	}
?>