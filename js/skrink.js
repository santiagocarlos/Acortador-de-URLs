$(document).ready(function(){
	$("#url-skrink").keyup(function(){
			   var urlskrink = $("#url-skrink").val();
			   var quita = " "+urlskrink;
			   if(urlskrink ==+quita){
				   /*Vacio el campo*/
				   $("#url-skrink").val("");
				   }
			   });
	$("#btn-skrink").click(function(){
	$(".skrink-result").empty();
	if($("#url-skrink").val()==""){
		$(".skrink-result").html("Ingresa la url que deseas acortar");
		$("#url-skrink").focus();
	}else{
	var url = $('#url-skrink').val();
	var re = /(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/
	if (re.test(url)) {
	 $.ajax({
            url: 'skrink/url',  
            type: 'POST',
            data: $("#form-skrink").serialize(),
            cache: false,
            beforeSend: function(){
               $(".skrink-result").empty();
               $(".skrink-result").html('<p><small>Procesando, espera unos segundos...</small></p>');       
            },
            success: function(data){
             $(".skrink-result").empty();
             $(".skrink-result").html(data);
            },
            error: function(){
            	$(".skrink-result").empty();
            	$(".skrink-result").html('<small>Ocurrio un error, el servicio no está disponible.</ssmall>');
            }
        });
	}else{
	$(".skrink-result").html("La url ingresada no es valida.");
	$("#url-skrink").focus();	
	}
	}
	});
});