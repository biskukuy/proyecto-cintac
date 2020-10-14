/*!
 * BCN functions
 */

jQuery(function($) {
	setTimeout(cerrarMensaje, bcn_duracion);
});

 function cerrarMensaje(){
 	$("#bcn_mensaje").fadeOut(1000,function(){ $("#bcn_mensaje").remove(); } );
 }

 function loadProgram(program){
 	if (program==undefined) program = "Calendario";
 	$("#menup").val(program);
 	$("#mainform").submit();
 }

function fechaMayor(fechaInicial,fechaFinal){
    valuesStart=fechaInicial.split("-");
    valuesEnd=fechaFinal.split("-");

    var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
    var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);
    //alert(dateStart+ " / "+dateEnd);
    if(dateStart>dateEnd) return 1;

    return 0;
}

function copiarLink(texto){
  $("body").append("<input type='text' id='paracopiar'>"); 
  $("#paracopiar").val(texto);
  $("#paracopiar").select();
  document.execCommand("copy");
  $("#paracopiar").remove(); 
}

function cargando(opc){
  if (opc){
      $("#div_datos_tabla").html('<p style="text-align:center;" id="div_cargando"><img src="assets/images/loader.gif"></p>');
  } else {
      $("#div_cargando").html("");
  }
}
    