<?php $CTRL->basicScript($modulo); ?>


<script type="text/javascript">
	$(document).ready(function(){
		recargarLista();

		$('#idplanta').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"bcn_cargos_code.php",
			data:{"idplanta": $('#idplanta').val(),
			    "idcargo": $('#idcargo').val()},
			success:function(r){
			    $('#select2lista').html(r);
			}
		});
	}
</script>
