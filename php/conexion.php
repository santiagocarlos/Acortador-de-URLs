<?php
function connect(){
$db_host="localhost";		    	//Host de Mysql
$db_user="";    				//Usuario
$db_pass="";    					//Contraseña
$db_dbase="";			   			//Nombre de la Base de datos
//Creamos la conexion
$conecta=mysqli_connect($db_host,$db_user,$db_pass,$db_dbase);
return $conecta;
}
?>