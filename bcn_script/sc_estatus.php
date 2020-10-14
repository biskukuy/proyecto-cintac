<?php $CTRL->basicScript($modulo); ?>
<script type="text/javascript">
	function algo(id){
		alert(id);
	}

	$(document).ready(function() {
		  $( '#marcacion' ).on( 'change', function(e) {
     			//e.preventDefault();

     				alert($("#marcacion").val());
        		if( $(this).is(':checked') ){
            		// Hacer algo si el checkbox ha sido seleccionado
            		$('.caja-1').css('display', 'block');
           			 Oculto1 = false;
        		} else {
           			 // Hacer algo si el checkbox ha sido deseleccionado
           			 $('.caja-1').css('display', 'none');
           			 Oculto1 = true;
       			 }
    	  });

		});



</script>