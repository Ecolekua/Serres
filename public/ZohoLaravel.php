<?php

ob_start();
include('enlace.php');

include('Classes/PHPExcel.php');
include('Classes/PHPExcel/Writer/Excel2007.php');

// 
// 

date_default_timezone_set('America/Santiago');

$objPHPExcel = new PHPExcel();

$c=0;
$f=1;


/* inicio while */

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$f,'Mandante');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,$f,'Id');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,$f,'Razón Social Mandante');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,$f,'Rut Mandante');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,$f,'Obra');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,$f,'Razón Social Contratista');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,$f,'Rut Contratista');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,$f,'Período CCOLP');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,$f,'Periodo a CCOLP Mes');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,$f,'N° de Trabajadores a Certificar');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10,$f,'N° Contrato o Servicio Prestado Informa Contratista');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11,$f,'Contacto Nombre');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12,$f,'Contacto Tel.');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13,$f,'Contacto Email');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14,$f,'Estado Certificación');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15,$f,'Fecha Recepción');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16,$f,'Fecha Emisión');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17,$f,'Ejecutivo Asignado');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18,$f,'N° Certificado');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19,$f,'N° Factura');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20,$f,'Pagado Si/No');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21,$f,'Días Hábiles');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(22,$f,'Observación');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(23,$f,'Tipo de Solicitud');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(24,$f,'Tipo de Documento');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(25,$f,'Observación');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(26,$f,'cantidad_reenvios');
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(27,$f,'updated_at');

// $f=2;

//         $certificado="SELECT * FROM zohos";

//         $sqlCertificado=$conex->query($certificado);
//         date_default_timezone_set('America/Santiago');
//         $sin=' ';


//         while($rr=$sqlCertificado->fetch_array()){


//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c,$f,$rr['mandante']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+1,$f,$rr['id_solicitud']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+2,$f,$rr['razon_mandante']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+3,$f,$rr['rut_mandante']); //razon mandante
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+4,$f,$rr['obra']);


//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+5,$f,$rr['razon_contratista']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+6,$f,$rr['rut_contratista']);


//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+7,$f,$rr['periodo_ccolp']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+8,$f,$rr['periodo_a_ccolp_mes']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+9,$f,$rr['n_trabajadores_certificar']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+10,$f,$rr['contrato']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+11,$f,$sin);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+12,$f,$sin);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+13,$f,$sin);

//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+14,$f,$rr['estado']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+15,$f,$rr['fecha_recepcion']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+16,$f,$rr['fecha_emision']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+17,$f,$rr['ejecutivo']);

//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+18,$f,$rr['n_certificado']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+19,$f,$sin);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+20,$f,$sin);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+21,$f,$sin);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+22,$f,$rr['observacion']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+23,$f,$rr['tipo_solicitud']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+24,$f,$rr['tipo_documento']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+25,$f,$rr['otraobservacion']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+26,$f,$rr['cantidad_reenvios']);
//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+27,$f,$rr['updated_at']);
//             $f++;
//     }

// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// 	header('Content-Disposition: attachment;filename="exce.xls"');
// 	header('Cache-Control: max-age=0');
// 	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	ob_end_clean();
	//$objWriter->save('php://output');

// header('Content-Type: application/vnd.ms-excel');
// header('Content-Disposition: attachment;filename="Planilla_Zoho.xls"');
// header('Cache-Control: max-age=0');

// $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');

// $objWriter->save('php://output');
// header('Content-Type: application/vnd.ms-excel'); 
// header('Content-Disposition: attachment;filename="results.xls"'); 
// header('Cache-Control: max-age=0'); 
// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
// //$objWriter->save('php://output');
// exit;
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Planilla_Zoho.xls"');

?>
