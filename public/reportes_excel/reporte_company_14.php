<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Lima');
include("includes/configure.php");


if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */

require_once dirname(__FILE__) . '/includes/Classes/PHPExcel.php';

$columna_inicial = 1;

//generar_hoja_excel(calcular_query_sino_sin_comment(27));


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objWorksheet = $objPHPExcel->getActiveSheet();

// Negrita con Fondo Gris
$style =  array(
	'font'    => array(
		'size' => '11',
		'color'     => array(
			'rgb' => '000000'
		)
	),
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array(
				'rgb' => '000000'
			)
		)
	),
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'startcolor' => array(
			'argb' => '7A8B8B',
		)
	)
);

// Negrita con Fondo Verde y Letra Blanca

$style_1 =  array(
	'font'    => array(
		'size' => '9',
		'bold'      => true,
		'color'     => array(
			'argb' => 'F5FFFA'
		)
	),
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array(
				'rgb' => '000000'
			)
		)
	),
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'startcolor' => array(
			'argb' => '00C957',
		)
	)
);

// Negrita con Letra Verde
$style_2 =  array(
	'font'    => array(
		'size' => '9',
		'bold'      => true,
		'color'     => array(
			'argb' => '00C957'
		)
	),
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array(
				'rgb' => '000000'
			)
		)
	)
);

// Letra Normal
$style_3 =  array(
	'font'    => array(
		'size' => '9'
	),
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array(
				'rgb' => '000000'
			)
		)
	)
);

// Negrita con Letra Negra
$style_4 =  array(
	'font'    => array(
		'size' => '9',
		'bold'      => true
	),
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array(
				'rgb' => '000000'
			)
		)
	)
);

$objPHPExcel->createSheet(NULL, 1);

/* Ejecuta el Store Procedure que tiene el resumen del reporte */
//mysql_query("call sp_reporte_dia_company_8", $conexion_db) or die(mysql_error());

$query_detalle_puntos = "call sp_consulta_reporte_company_14";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B3', 'PSE');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C3', 'Comercio');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D3', utf8_encode('Direcci�n'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('E3', 'Distrito');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F3', 'Provincia');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G3', 'Departamento');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H3', 'Latitud');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I3', 'Longitud');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J3', 'Ejecutivo');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K3', 'Coordinador');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L3', 'Fecha');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('M3', 'Hora');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('N3', 'Auditor');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B2', 'Nombre Agente');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D2', utf8_encode('Direcci�n'));

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L2', utf8_encode('D�a de Visita'));

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12  + 2 , 2), utf8_encode('1. Indicar Rubro (id = 164)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18  + 2 , 2), utf8_encode('2. �Se encuentra abierto el agente? (id = 165)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23  + 2 , 2), utf8_encode('3. Al llegar al establecimiento el cliente inc�gnito deber� preguntar directamente por el agente de Interbank. Ejemplo: Buenos d�as/tardes, �hay agente de Interbank aqu�? (id = 163)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2 , 2), utf8_encode('4. �El letrero de IBK Agente era visible desde fuera? (id = 166)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32  + 2 , 2), utf8_encode('5. �El Interbank Agente es visible estando dentro del establecimiento? (id = 167)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37  + 2 , 2), utf8_encode('6. �Existe alg�n otro Agente / corresponsal bancario? (id = 168)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39  + 2 , 2), utf8_encode('7. El CI deber� preguntar, �Puedo pagar una tarjeta de cr�dito de Interbank ac�? (id = 169)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2 , 2), utf8_encode('8. En el caso de que exista m�s de un agente en el comercio, preguntar, �ac� puedo pagar mi tel�fono? (id = 170)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42  + 2 , 2), utf8_encode('9. Si responde que si en la P8, preguntar �Y en cu�l agente me conviene pagar mi tel�fono? (id = 171)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46  + 2 , 2), utf8_encode('10. Si me env�an dinero del exterior �Lo puedo cobrar ac�? (id = 172)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47  + 2 , 2), utf8_encode('11. Escoger tipo de Transacci�n (id = 184)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51  + 2 , 2), utf8_encode('12. Al preguntar si se pod�a hacer la operaci�n correspondiente, �el dependiente acept� realizar la operaci�n? (id = 173)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52  + 2 , 2), utf8_encode('13. �Su solicitud fue atendido de inmediato? (id = 174)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53  + 2 , 2), utf8_encode('14. Su solicitud no fue atendida de inmediato porque (id = 175)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56  + 2 , 2), utf8_encode('15. Mientras esperaba. �La persona que lo atendi� se preocup� por su tiempo? (id = 176)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59  + 2 , 2), utf8_encode('16. Despu�s de esperar (id = 177)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61  + 2 , 2), utf8_encode('17. �La transacci�n se lleg� a realizar de manera exitosa? (Se considera exitosa cuando se entrega el voucher) (id = 178)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62  + 2 , 2), utf8_encode('18. �El agente hizo alg�n cobro fuera del voucher? (id = 185)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63  + 2 , 2), utf8_encode('19. �Cu�ntos MINUTOS transcurrieron entre que solicit� la transacci�n y la persona termin� (le entreg� el voucher)? (id = 179)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64  + 2 , 2), utf8_encode('20. �La persona que lo atendi� tuvo que solicitar ayuda de alguna otra persona o hacer alguna consulta al respecto? (id = 180)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65  + 2 , 2), utf8_encode('21. �Le entregaron ESPONT�?NEAMENTE un comprobante luego de la transacci�n? (Si no le entregaron espont�neamente el voucher deben solicitarlo y adjuntarlo al formulario) (id = 181)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67  + 2 , 2), utf8_encode('22. (S�LO SI NO SE REALIZ� LA TRANSACCI�N) �Por qu� no se pudo realizar la transacci�n? (id = 182)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74  + 2 , 2), utf8_encode('23. (S�LO SI NO SE REALIZ� LA TRANSACCI�N) �Le dieron alguna soluci�n para poder realizar la transacci�n? (id = 183)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78  + 2 , 2), utf8_encode('24. En una escala del 0 al 3 donde 0 significa Debajo del est�ndar, 2 Est�ndar y 3 Superior, �c�mo calificar�as la amabilidad de la persona que te atendi�? (id = 186)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86  + 2 , 2), utf8_encode('25. En una escala del 0 al 3 donde 0 significa Debajo del est�ndar, 2 Est�ndar y 3 Superior, �c�mo calificar�as el conocimiento de la persona que lo atendi�? (id = 187)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91  + 2 , 2), utf8_encode('26. En una escala del 0 al 3 donde 0 significa Debajo del est�ndar, 2 Est�ndar y 3 Superior, �c�mo calificar�as la disposici�n de la persona que lo atendi�? (id = 188)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95  + 2 , 2), utf8_encode('27. El CI deber� mostrar inter�s: Voy a abrir un negocio, �usted me recomendar�a tener un agente Interbank? (id = 189)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 + 2  , 2), utf8_encode('28. �Sabe si tienen alguna p�gina web para conseguir informaci�n (id = 190)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106 + 2  , 2), utf8_encode('29. �La persona encargada le proporcion� dicha informaci�n (id = 191)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107 + 2  , 2), utf8_encode('30. Otras apreciaciones a comentar (id = 192)') );



$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12  + 2, 3), utf8_encode('Bodega') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13  + 2, 3), utf8_encode('Farmacia') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14  + 2, 3), utf8_encode('Locutorio') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15  + 2, 3), utf8_encode('Librerias') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16  + 2, 3), utf8_encode('Tiendas Com') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17  + 2, 3), utf8_encode('Otro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19  + 2, 3), utf8_encode('Local Cerrado') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20  + 2, 3), utf8_encode('Ya no es Agente') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21  + 2, 3), utf8_encode('Existe se�alizaci�n pero pidio retiro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22  + 2, 3), utf8_encode('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24  + 2, 3), utf8_encode('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26  + 2, 3), utf8_encode('Letrero de metal o madera') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27  + 2, 3), utf8_encode('Rompe tr�fico') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28  + 2, 3), utf8_encode('Letrero luminoso') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29  + 2, 3), utf8_encode('Letrero luminoso Bandera') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30  + 2, 3), utf8_encode('Letrero compartido') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31  + 2, 3), utf8_encode('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33  + 2, 3), utf8_encode('Colgante') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34  + 2, 3), utf8_encode('Mostrador') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35  + 2, 3), utf8_encode('Banner') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36  + 2, 3), utf8_encode('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38  + 2, 3), utf8_encode('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40  + 2, 3), utf8_encode('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42  + 2, 3), utf8_encode('Interbank') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43  + 2, 3), utf8_encode('Otro Agente') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44  + 2, 3), utf8_encode('En cualquiera/En el que usted decida/En los dos') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45  + 2, 3), utf8_encode('No Precisa') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47  + 2, 3), utf8_encode('Pago de TC') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48  + 2, 3), utf8_encode('Retiro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49  + 2, 3), utf8_encode('Deposito') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50  + 2, 3), utf8_encode('Pago de Servicios') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53  + 2, 3), utf8_encode('El encargado estaba ocupado	') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54  + 2, 3), utf8_encode('Porque me indic� que no hab�a sistema') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55  + 2, 3), utf8_encode('Otro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56  + 2, 3), utf8_encode('Pidi�ndole que por favor espere mientras terminaba de atender a otro cliente') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57  + 2, 3), utf8_encode('Pregunt�ndole desde que lleg�, qu� operaci�n iba a realizar, para saber c�mo atenderlo cuando se desocupe') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58  + 2, 3), utf8_encode('Otro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59  + 2, 3), utf8_encode('Me atendieron ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60  + 2, 3), utf8_encode('No me atendieron') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63  + 2, 3), utf8_encode('Opcion') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66  + 2, 3), utf8_encode('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67  + 2, 3), utf8_encode('No hab�a sistema') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68  + 2, 3), utf8_encode('La l�nea estaba copada para el dep�sito') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69  + 2, 3), utf8_encode('La persona que atiende (operador) no estaba disponible') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70  + 2, 3), utf8_encode('POS no operativo') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71  + 2, 3), utf8_encode('No hab�a efectivo disponible para el retiro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72  + 2, 3), utf8_encode('Otro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73  + 2, 3), utf8_encode('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74  + 2, 3), utf8_encode('Le pidi� regrese m�s tarde') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75  + 2, 3), utf8_encode('Lo guio hacia otro Agente') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76  + 2, 3), utf8_encode('Le dijo como llegar a alguna Tienda Interbank') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77  + 2, 3), utf8_encode('Otros Indicar Cual') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78  + 2, 3), utf8_encode('Saluda ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79  + 2, 3), utf8_encode('Usa el por favor') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80  + 2, 3), utf8_encode('Da las gracias') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81  + 2, 3), utf8_encode('Sonr�e') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82  + 2, 3), utf8_encode('Mira a los ojos') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83  + 2, 3), utf8_encode('No interrumpe') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84  + 2, 3), utf8_encode('Despedida') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85  + 2, 3), utf8_encode('Estandar') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86  + 2, 3), utf8_encode('Conoce las operaciones que se puede realizar en agente ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87  + 2, 3), utf8_encode('Sabe c�mo operar el pos al realizar la operaci�n') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88  + 2, 3), utf8_encode('No solicita ayuda para realizar la operaci�n') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89  + 2, 3), utf8_encode('Conoce la p�gina web para conseguir informaci�n') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90  + 2, 3), utf8_encode('Estandar') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91  + 2, 3), utf8_encode('Pendiente de  usted durante la atenci�n') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92  + 2, 3), utf8_encode('Concentrado en la operaci�n mientras atend�a ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93  + 2, 3), utf8_encode('Le ofreci� un producto o servicio adicional') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94  + 2, 3), utf8_encode('Estandar') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95  + 2, 3), utf8_encode('Respuesta') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96  + 2, 3), utf8_encode('Incremento clientes') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97  + 2, 3), utf8_encode('M�s ventas') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98  + 2, 3), utf8_encode('Comisiones') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99  + 2, 3), utf8_encode('Mejora de imagen') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100 + 2 , 3), utf8_encode('Diferencia competencia') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 + 2 , 3), utf8_encode('Porque los clientes lo solicitan') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 + 2 , 3), utf8_encode('Seguridad') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103 + 2 , 3), utf8_encode('P�rdida de tiempo') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 + 2 , 3), utf8_encode('Comisiones bajas') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 + 2 , 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106 + 2 , 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107 + 2 , 3), utf8_encode('Comentario') );

/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B2:C2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('D2:K2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('L2:N2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('O2:T2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('U2:Y2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Z2:AA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AB2:AH2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AI2:AM2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AN2:AO2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AP2:AQ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AS2:AV2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AX2:BA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BD2:BF2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BG2:BI2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BJ2:BK2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BP2:BQ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BR2:BX2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BY2:CB2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CC2:CJ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CK2:CO2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CP2:CS2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CT2:DC2');


/* Aplica estilo a las cabeceras */
$objPHPExcel->setActiveSheetIndex(1)->getStyle('B2:DF2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('B3:DF3')->applyFromArray($style_1);


/* Define el Ancho de las Celdas */
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);




$contador_1 = 3;


/* Llenamos el detalle del reporte */
while ($rowEmp = mysql_fetch_assoc($resEmp)) {

	$contador_1 ++;
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(1 , $contador_1), utf8_encode($rowEmp['codclient'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(2 , $contador_1), utf8_encode($rowEmp['fullname'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(3 , $contador_1), utf8_encode($rowEmp['address'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(4 , $contador_1), utf8_encode($rowEmp['district'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(5 , $contador_1), utf8_encode($rowEmp['region'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(6 , $contador_1), utf8_encode($rowEmp['ubigeo'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(5 + 2, $contador_1), utf8_encode($rowEmp['latitude'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(6 + 2, $contador_1), utf8_encode($rowEmp['longitude'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(7 + 2, $contador_1), utf8_encode($rowEmp['ejecutivo'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(8 + 2, $contador_1), utf8_encode($rowEmp['coordinador'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(9 + 2, $contador_1), utf8_encode($rowEmp['fecha'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(10 + 2, $contador_1), utf8_encode($rowEmp['hora'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(11 + 2, $contador_1), utf8_encode($rowEmp['auditor'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12 + 2, $contador_1), utf8_encode($rowEmp['164_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 + 2, $contador_1), utf8_encode($rowEmp['164_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14 + 2, $contador_1), utf8_encode($rowEmp['164_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15 + 2, $contador_1), utf8_encode($rowEmp['164_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 + 2, $contador_1), utf8_encode($rowEmp['164_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 + 2, $contador_1), utf8_encode($rowEmp['164_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 + 2, $contador_1), utf8_encode($rowEmp['165_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 + 2, $contador_1), utf8_encode($rowEmp['165_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 + 2, $contador_1), utf8_encode($rowEmp['165_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 + 2, $contador_1), utf8_encode($rowEmp['165_c'] ));

	if (utf8_encode($rowEmp['165_Foto']) == null || utf8_encode($rowEmp['165_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 + 2, $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 + 2, $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['165_Foto']) .'"  , "Foto" )' );
	}
	//$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['165_Foto']) .'"  , "Foto" )' );
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23  + 2, $contador_1), utf8_encode($rowEmp['163_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24  + 2, $contador_1), utf8_encode($rowEmp['163_Comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2, $contador_1), utf8_encode($rowEmp['166_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26  + 2, $contador_1), utf8_encode($rowEmp['166_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27  + 2, $contador_1), utf8_encode($rowEmp['166_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28  + 2, $contador_1), utf8_encode($rowEmp['166_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29  + 2, $contador_1), utf8_encode($rowEmp['166_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30  + 2, $contador_1), utf8_encode($rowEmp['166_e'] ));

	if (utf8_encode($rowEmp['166_Foto']) == null || utf8_encode($rowEmp['166_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31  + 2, $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 + 2 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['166_Foto']) .'"  , "Foto" )' );
	}
	
	//$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 , $contador_1), utf8_encode($rowEmp['166_Foto'] ));
	
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32  + 2, $contador_1), utf8_encode($rowEmp['167_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33  + 2, $contador_1), utf8_encode($rowEmp['167_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34  + 2, $contador_1), utf8_encode($rowEmp['167_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35  + 2, $contador_1), utf8_encode($rowEmp['167_c'] ));

	if (utf8_encode($rowEmp['167_Foto']) == null || utf8_encode($rowEmp['167_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36  + 2, $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36  + 2, $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['167_Foto']) .'"  , "Foto" )' );
	}
	
	//$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36 , $contador_1), utf8_encode($rowEmp['167_Foto'] ));
	
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37  + 2, $contador_1), utf8_encode($rowEmp['168_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38  + 2, $contador_1), utf8_encode($rowEmp['168_comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39  + 2, $contador_1), utf8_encode($rowEmp['169_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40  + 2, $contador_1), utf8_encode($rowEmp['169_comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2, $contador_1), utf8_encode($rowEmp['170_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42  + 2, $contador_1), utf8_encode($rowEmp['171_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43  + 2, $contador_1), utf8_encode($rowEmp['171_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44  + 2, $contador_1), utf8_encode($rowEmp['171_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45  + 2, $contador_1), utf8_encode($rowEmp['171_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46  + 2, $contador_1), utf8_encode($rowEmp['172_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47  + 2, $contador_1), utf8_encode($rowEmp['184_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48  + 2, $contador_1), utf8_encode($rowEmp['184_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49  + 2, $contador_1), utf8_encode($rowEmp['184_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50  + 2, $contador_1), utf8_encode($rowEmp['184_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51  + 2, $contador_1), utf8_encode($rowEmp['173_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52  + 2, $contador_1), utf8_encode($rowEmp['174_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53  + 2, $contador_1), utf8_encode($rowEmp['175_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54  + 2, $contador_1), utf8_encode($rowEmp['175_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55  + 2, $contador_1), utf8_encode($rowEmp['175_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56  + 2, $contador_1), utf8_encode($rowEmp['176_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57  + 2, $contador_1), utf8_encode($rowEmp['176_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58  + 2, $contador_1), utf8_encode($rowEmp['176_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59  + 2, $contador_1), utf8_encode($rowEmp['177_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60  + 2, $contador_1), utf8_encode($rowEmp['177_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61  + 2, $contador_1), utf8_encode($rowEmp['178_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62  + 2, $contador_1), utf8_encode($rowEmp['185_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63  + 2, $contador_1), utf8_encode($rowEmp['179_Opcion'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64  + 2, $contador_1), utf8_encode($rowEmp['180_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65  + 2, $contador_1), utf8_encode($rowEmp['181_Respuesta'] ));
	
	if (utf8_encode($rowEmp['181_Foto']) == null || utf8_encode($rowEmp['181_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66  + 2, $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66  + 2, $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['181_Foto']) .'"  , "Foto" )' );
	}

	//$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66 , $contador_1), utf8_encode($rowEmp['181_Foto'] ));
	
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67  + 2, $contador_1), utf8_encode($rowEmp['182_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68  + 2, $contador_1), utf8_encode($rowEmp['182_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69  + 2, $contador_1), utf8_encode($rowEmp['182_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70  + 2, $contador_1), utf8_encode($rowEmp['182_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71  + 2, $contador_1), utf8_encode($rowEmp['182_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72  + 2, $contador_1), utf8_encode($rowEmp['182_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73  + 2, $contador_1), utf8_encode($rowEmp['182_Comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74  + 2, $contador_1), utf8_encode($rowEmp['183_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75  + 2, $contador_1), utf8_encode($rowEmp['183_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76  + 2, $contador_1), utf8_encode($rowEmp['183_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77  + 2, $contador_1), utf8_encode($rowEmp['183_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78  + 2, $contador_1), utf8_encode($rowEmp['186_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79  + 2, $contador_1), utf8_encode($rowEmp['186_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80  + 2, $contador_1), utf8_encode($rowEmp['186_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81  + 2, $contador_1), utf8_encode($rowEmp['186_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82  + 2, $contador_1), utf8_encode($rowEmp['186_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83  + 2, $contador_1), utf8_encode($rowEmp['186_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84  + 2, $contador_1), utf8_encode($rowEmp['186_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85  + 2, $contador_1), utf8_encode($rowEmp['186_Opcion'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86  + 2, $contador_1), utf8_encode($rowEmp['187_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87  + 2, $contador_1), utf8_encode($rowEmp['187_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88  + 2, $contador_1), utf8_encode($rowEmp['187_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89  + 2, $contador_1), utf8_encode($rowEmp['187_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90  + 2, $contador_1), utf8_encode($rowEmp['187_Opcion'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91  + 2, $contador_1), utf8_encode($rowEmp['188_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92  + 2, $contador_1), utf8_encode($rowEmp['188_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93  + 2, $contador_1), utf8_encode($rowEmp['188_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94  + 2, $contador_1), utf8_encode($rowEmp['188_Opcion'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95  + 2, $contador_1), utf8_encode($rowEmp['189_Respuesta'] ));

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96  + 2, $contador_1), utf8_encode($rowEmp['189_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97  + 2, $contador_1), utf8_encode($rowEmp['189_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98  + 2, $contador_1), utf8_encode($rowEmp['189_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99  + 2, $contador_1), utf8_encode($rowEmp['189_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100  + 2, $contador_1), utf8_encode($rowEmp['189_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101  + 2, $contador_1), utf8_encode($rowEmp['189_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102  + 2, $contador_1), utf8_encode($rowEmp['189_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103  + 2, $contador_1), utf8_encode($rowEmp['189_h'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104  + 2, $contador_1), utf8_encode($rowEmp['189_i'] ));

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105  + 2, $contador_1), utf8_encode($rowEmp['190_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106  + 2, $contador_1), utf8_encode($rowEmp['191_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107  + 2, $contador_1), utf8_encode($rowEmp['192_comentario'] ));
 
	$objPHPExcel->setActiveSheetIndex(1)->getStyle('B'.$contador_1.':C'.$contador_1)->applyFromArray($style_2);
	$objPHPExcel->setActiveSheetIndex(1)->getStyle('D'.$contador_1.':DF'.$contador_1)->applyFromArray($style_3);
}

$objPHPExcel->getActiveSheet()->setTitle('resumen');

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
	->setLastModifiedBy("Maarten Balliauw")
	->setTitle("REPORTE1")
	->setSubject("Office 2007 XLSX Test Document")
	->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
	->setKeywords("office 2007 openxml php")
	->setCategory("Test result file");


// Redirect output to a client�s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Content-Disposition: attachment;filename="REPORTE_FINAL_14.xlsx"');
header('Cache-Control: max-age=0');

// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;


function coordinates($x,$y){
	return PHPExcel_Cell::stringFromColumnIndex($x).$y;
}


?>