<?php
//Comprobamos que venga una url acortada de lo contrario mostramos el index.php
if(isset($_GET["url"])){
//Abrimos la conexion y cargamos
require("php/conexion.php");
$conecta=connect();
$destino=$conecta->real_escape_string($_GET["url"]);
//Buscamos la url en la base de datos
$carga=$conecta->query("SELECT url_original FROM url_acortadas WHERE url_acortada='$destino'");
//Comprobamos si existe
if($link=$carga->fetch_assoc()){
//Mandamos a la url original	
header("Location: ".$link["url_original"]."");
}else{
	//NO hay url almacenada mostramos el index
	require("index.php");
}
}else{
	//No viene una url mostramos por defecto el index
	require("index.php");
}
?>