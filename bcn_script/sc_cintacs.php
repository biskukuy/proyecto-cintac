<?php $CTRL->basicScript($modulo); ?>
<script type="text/javascript">
	function algo(id){
		alert(id);
	}

	$(document).ready(function() {
		  $( '#marcacion' ).on( 'change', function(e) {
     			//e.preventDefault();
          var x= $("#marcacion").val();


        		if( x==1 ){
            		// Hacer algo si el checkbox ha sido seleccionado
            		$('.caja-1').css('display', 'block');
           			// Oculto1 = false;
        		} else {
           			 // Hacer algo si el checkbox ha sido deseleccionado
           			 $('.caja-1').css('display', 'none');
           			// Oculto1 = true;
       			 }
    	  });

		});



</script>