<script src="assets/js/jquery.mask.min.js"></script>
<script src="assets/js/jquery.bootstrap-duallistbox.min.js"></script>
<?php $CTRL->basicScript($modulo,'[ 3, "asc" ], [ 0, "asc" ]'); ?>
<script>
    var listacursos = $('select[name="lista_cursos[]"]').bootstrapDualListbox({infoTextFiltered: '<span class="label label-purple label-lg">Filtrados</span>', moveOnSelect:false });
	var marco = listacursos.bootstrapDualListbox('getContainer');
	marco.find('.btn').addClass('btn-white btn-info btn-bold');

  	<?php 
  		if (isset($idBCN)){
	  		if ($idBCN>0){	
	  			$dis = 0;
	  			if ($accionBCN=="Ver{$modulo}"){ $dis = 1; }
	  		}  			
  		}
  	?>

  	$('.rut').mask('90000000-A', {reverse: true});
</script>