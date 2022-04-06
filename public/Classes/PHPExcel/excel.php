<?php
error_reporting(5);

$p = $_GET["emp"];
															
$n_proyecto = $_GET["proy"];

$n_subc = $_GET["subcon2"];
$n_nomsubc = $_GET["nomsubc"];


$mes_t = $_GET["mesdocumento"];
$ano_t = $_GET["anodocumento"];
echo $n_subc;
$a=$_GET["fecha1"];
																		
$ano = substr($a, 6, 4);
$mes = substr($a, 3, 2);
$dia = substr($a, 0, 2);
																		
$fecha= $ano. '-' . $mes . '-' . $dia;
echo $fecha;

$a2=$_GET["fecha2"];
																		
$ano2 = substr($a2, 6, 4);
$mes2 = substr($a2, 3, 2);
$dia2 = substr($a2, 0, 2);
																		
$fecha2= $ano2. '-' . $mes2 . '-' . $dia2;
echo $fecha2;	


include('conexion.php');
$rem="SELECT * FROM centro_trabajador WHERE id_proy_cen='$n_proyecto' AND id_subc_cen='$n_subc' AND fecha_ingreso BETWEEN '$fecha'  AND '$fecha2'";/**/
$q=mysql_query($rem,$conexion);
$mq=mysql_fetch_array($q);






include 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Serres Verificadora LTDA.");
$objPHPExcel->getProperties()->setTitle("Reporte Según Rangos de Fecha");
$objPHPExcel->setActiveSheetIndex(0); //Elegimos la hoja 0

$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,1,'Rut');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,2,'Nombre');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,3,'Fecha Nacimiento');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,4,'Fecha de Ingreso');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,5,'Cargo');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,6,'Status');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,7,'Total Imponible');
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,8,'Total Haberes');


$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('tuarchivo.xlsx');

/*header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');*/
 
$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
$objWriter->save('php://output');
exit;



?>




