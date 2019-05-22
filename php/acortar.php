<?php
//Comprobamos que sea una peticion ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//Comprobamos que se ingrese la url
	if(isset($_POST["url-skrink"])){
	//Base para validar que sea una direccion web
    $base='|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i';
    //Realizamos la comprobación
    if(preg_match($base, $_POST["url-skrink"]) > 0){
    //abrimos la conexion y creamos las variables
    require("conexion.php");
    //Incluimos el archivo donde están algunas configuraciones
    require ("config.php");
    //Creamos la variable conecta
    $conecta=connect();
    //Variable de la url
    $url=$conecta->real_escape_string($_POST["url-skrink"]);
    //Variable que sirve como base para generar la nueva url acortada
    $base=md5($url."".date("s"));
    //Acortamos la $base de acuerdo a la variable $long que está declarada en el script config.php
    $url_short=substr($base,0, 6);
    //Variables del sistema
    $fecha=date("d/m/Y");
    $hora=date("H:i:s");
    $ip=$_SERVER["REMOTE_ADDR"];
    //Guardamos la url en la base de datos
    $inserta=$conecta->query("INSERT INTO url_acortadas (url_original,url_acortada,fecha_acortado,hora_acortado,ip) VALUES('$url','$url_short','$fecha','$hora','$ip')");
    //Comprobamos si se guardo
    if($inserta){
    	//Se guardo la url mostramos la url acortada usando $site (Declarada en config.php)
    	 echo'
	<script type="text/javascript">
	$("#url-skrink").val("");
	$(".skrink-result").html("Url acortada: '.$site.'/'.$url_short.'");
	</script>
	';
    }else{
    	//no se guardo
    echo'
	<script type="text/javascript">
	$(".skrink-result").html("Ops! ocurrio un error intentalo de nuevo.");
	</script>
	';
    }
    }else{
    	//No es una url mostramos el mensaje usando jquery
    echo'
	<script type="text/javascript">
	$(".skrink-result").html("Ingresa una dirección valida, chequea que contenga http:// o http<strong>s</strong>://");
	</script>
	';
    }
	}else{
//No se ingreso la url , mostramos el mensaje usando jquery
	echo'
	<script type="text/javascript">
	$(".skrink-result").html("Ingresa la url que deseas acortar.");
	</script>
	';	
	}
}else{
	//No es una peticion ajax mostramos un mensaje por defecto
	echo'El servicio solicitado no existe';
}
?>