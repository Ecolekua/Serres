<?php
require_once('dato.php');
$conex = new mysqli($server,$usuario_db,$clave,$db);
if ($conex->connect_errno){
	printf("Conexión Fallida",$conex->connect_errno);
	exit();
}
?>