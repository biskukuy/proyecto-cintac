<?php $CTRL->reportScript($idRep,$destinoRep,$validacion); ?>
<script type="text/javascript">
	$("#userid").chosen({
	    no_results_text: "Sin resultados"
  	});

	$("#btn_limpiar").click(function(){
  		$("#userid").trigger("chosen:updated");

	})
</script>