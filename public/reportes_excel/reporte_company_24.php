<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
//ini_set('max_execution_time', 900);
//ini_set('memory_limit', '256M');
//set_time_limit(0);
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

//$query_detalle_puntos = "call sp_consulta_reporte_company_20_prueba";
$query_detalle_puntos = "call sp_consulta_reporte_company_24";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B3', 'ID');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C3', 'Comercio');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D3', 'Dirección');
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

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D2', 'Dirección');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L2', 'Día de Visita');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12  + 2 , 2), utf8_encode('1. Indicar Rubro (id = 290)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18  + 2 , 2), '2. ¿Se encuentra abierto el agente? (id = 291)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23  + 2 , 2), '3. Al llegar al establecimiento el cliente incógnito deberá preguntar directamente por el agente de Full Carga. Ejemplo: Buenos días/tardes, ¿hay agente de Full Carga aquí? (id = 259)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2 , 2), '4. ¿El letrero de Agente Full Carga  era visible desde fuera?  (id = 292)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34  + 2 , 2), '5. ¿El Agente Full Carga es visible estando dentro del establecimiento? (id = 263)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36  + 2 , 2), '6. ¿Existe algún otro Agente / corresponsal bancario? (id = 264)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38  + 2 , 2), '7. El CI deberá preguntar, ¿Puedo pagar una tarjeta de crédito de Full Carga acá? (id = 265)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40  + 2 , 2), '8. En el caso de que exista más de un agente en el comercio, preguntar, ¿acá puedo pagar mi teléfono? (id = 296)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2 , 2), '9. Si responde que si en la P8, preguntar ¿Y en cuál agente me conviene pagar mi teléfono? (id = 297)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45  + 2 , 2), '10. Si me envían dinero del exterior ¿Lo puedo cobrar acá? (id = 298)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46  + 2 , 2), '11. Al preguntar si se podía hacer la operación correspondiente, ¿el dependiente aceptó realizar la operación? (id = 299)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47  + 2 , 2), '12. ¿Su solicitud fue atendido de inmediato? (id = 300)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48  + 2 , 2), '13. Su solicitud no fue atendida de inmediato porque (id = 271)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51  + 2 , 2), '14. Mientras esperaba. ¿La persona que lo atendió se preocupó por su tiempo? (id = 272)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54  + 2 , 2), '15. Después de esperar (id = 273)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56  + 2 , 2), '16. ¿La transacción se llegó a realizar de manera exitosa? (Se considera exitosa cuando se entrega el voucher) (id = 304)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57  + 2 , 2), '17. ¿Cuántos MINUTOS transcurrieron entre que solicitó la transacción y la persona terminó (le entregá el voucher)? (id = 305)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58  + 2 , 2), '18. ¿La persona que lo atendió tuvo que solicitar ayuda de alguna otra persona o hacer alguna consulta al respecto? (id = 306)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59  + 2 , 2), '19. ¿Le entregaron ESPONTÁ?NEAMENTE un comprobante luego de la transacción? (Si no le entregaron espontáneamente el voucher deben solicitarlo y adjuntarlo al formulario) (id = 307)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61  + 2 , 2), '20. (SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Por qué no se pudo realizar la transacción? (id = 308)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67  + 2 , 2), '21. (SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Le dieron alguna solución para poder realizar la transacción? (id = 309)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71  + 2 , 2), '22. Escoger tipo de Transacción (id = 310)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75  + 2 , 2), '23. ¿El agente hizo algún cobro fuera del voucher? (id = 281)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76  + 2 , 2), '24. En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la amabilidad de la persona que te atendió? (id = 312)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83  + 2 , 2), '25. En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías el conocimiento de la persona que lo atendió? (id = 313)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87  + 2 , 2), '26. En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la disposición de la persona que lo atendió? (id = 314)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91  + 2 , 2), '27. El CI deberá mostrar interés: Voy a abrir un negocio, ¿usted me recomendaría tener un agente Full Carga? (id = 315)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99 + 2  , 2), '28. ¿Sabe si tienen alguna página web para conseguir información (id = 316)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100 + 2  , 2), '29. ¿La persona encargada le proporcionó dicha información (id = 317)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 + 2  , 2), '30. Otras apreciaciones a comentar (id = 318)') ;



$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12  + 2, 3), utf8_encode('Bodega') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13  + 2, 3), utf8_encode('Farmacia') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14  + 2, 3), utf8_encode('Locutorio') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15  + 2, 3), utf8_encode('Librerias') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16  + 2, 3), utf8_encode('Tiendas Com') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17  + 2, 3), utf8_encode('Otro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19  + 2, 3), utf8_encode('Local Cerrado') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20  + 2, 3), utf8_encode('Ya no es Agente') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21  + 2, 3), 'Existe señalización pero pidio retiro' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22  + 2, 3), utf8_encode('Foto') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23  + 2, 3), utf8_encode('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24  + 2, 3), utf8_encode('Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2, 3), utf8_encode('Respuesta') );//292
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26  + 2, 3), utf8_encode('BBVA') );//292
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27  + 2, 3), utf8_encode('Scotiabank') );//292
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28  + 2, 3), 'Banco de la Nación' );//292
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29  + 2, 3), utf8_encode('Caja Trujillo') );//292
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30  + 2, 3), utf8_encode('Caja Huancayo') );//292
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31  + 2, 3), utf8_encode('Caja Arequipa') );//292
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32  + 2, 3), utf8_encode('Otros') );//292
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33  + 2, 3), utf8_encode('Foto') );//292

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34  + 2, 3), utf8_encode('Respuesta') );//263
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35  + 2, 3), utf8_encode('Foto') );//263

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36  + 2, 3), utf8_encode('Respuesta') );//264
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37  + 2, 3), utf8_encode('Comentario') );//264

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38  + 2, 3), utf8_encode('Respuesta') );//265
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39  + 2, 3), utf8_encode('Comentario') );//265

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40  + 2, 3), utf8_encode('Respuesta') );//296

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2, 3), utf8_encode('BBVV') );//297
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42  + 2, 3), utf8_encode('Scotiabank') );//297
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43  + 2, 3), 'Banco de la Nación' );//297
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44  + 2, 3), utf8_encode('Otro') );//297

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45  + 2, 3), utf8_encode('Respuesta') );//298

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46  + 2, 3), utf8_encode('Respuesta') );//299

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47  + 2, 3), utf8_encode('Respuesta') );//300

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48  + 2, 3), utf8_encode('El encargado estaba ocupado	') );//301
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49  + 2, 3), utf8_encode('Porque me indicó que no había sistema') );//301
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50  + 2, 3), utf8_encode('Otro') );//301

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51  + 2, 3), 'Pidiéndole que por favor espere mientras terminaba de atender a otro cliente') ;//272
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52  + 2, 3), 'Preguntándole desde que llegá, qué operación iba a realizar, para saber cómo atenderlo cuando se desocupe') ;//272
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53  + 2, 3), utf8_encode('Otro') );//272

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54  + 2, 3), utf8_encode('Me atendieron ') );//273
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55  + 2, 3), utf8_encode('No me atendieron') );//273

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56  + 2, 3), utf8_encode('Respuesta') );//304

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57  + 2, 3), utf8_encode('Opcion') );//305

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58  + 2, 3), utf8_encode('Respuesta') );//306

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59  + 2, 3), utf8_encode('Respuesta') );//307
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60  + 2, 3), utf8_encode('Foto') );//307

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61  + 2, 3), 'No había sistema' );//308
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62  + 2, 3), 'La línea estaba copada para el depósito') ;//308
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63  + 2, 3), utf8_encode('La persona que atiende (operador) no estaba disponible') );//308
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64  + 2, 3), utf8_encode('POS no operativo') );//308
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65  + 2, 3), 'No había efectivo disponible para el retiro');//308
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66  + 2, 3), utf8_encode('Otro') );//308

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67  + 2, 3), 'Le pidió regrese más tarde');//309
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68  + 2, 3), utf8_encode('Lo guio hacia otro Agente') );//309
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69  + 2, 3), utf8_encode('Le dijo como llegar a alguna Tienda Full Carga') );//309
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70  + 2, 3), utf8_encode('Otros') );//309

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71  + 2, 3), utf8_encode('Pago de TC') );//310
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72  + 2, 3), utf8_encode('Retiro') );//310
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73  + 2, 3), utf8_encode('Deposito') );//310
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74  + 2, 3), utf8_encode('Pago de Servicios (indicar que servicio se paga)') );//310

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75  + 2, 3), utf8_encode('Respuesta') );//281

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76  + 2, 3), utf8_encode('Saluda ') );//312
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77  + 2, 3), utf8_encode('Usa el por favor') );//312
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78  + 2, 3), utf8_encode('Da las gracias') );//312
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79  + 2, 3), utf8_encode('Sonrie ') );//312
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80  + 2, 3), utf8_encode('Mira a los ojos') );//312
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81  + 2, 3), utf8_encode('No interrumpe') );//312
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82  + 2, 3), utf8_encode('Despedida') );//312

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83  + 2, 3), utf8_encode('Conoce las operaciones que se puede realizar en agente ') );//313
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84  + 2, 3), 'Sabe cómo operar el pos al realizar la operación') ;//313
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85  + 2, 3), 'No solicita ayuda para realizar la operación') ;//313
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86  + 2, 3), 'Conoce la página web para conseguir información' );//313

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87  + 2, 3), 'Pendiente de  usted durante la atención');//314
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88  + 2, 3), 'Concentrado en la operación mientras atendía ');//314
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89  + 2, 3), 'Le ofreció un producto o servicio adicional' );//314
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90  + 2, 3), 'Estándar' );//314

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91  + 2, 3), utf8_encode('Respuesta') );//315
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92  + 2, 3), utf8_encode('Incremento clientes') );//315
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93  + 2, 3), 'Más ventas' );//315
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94  + 2, 3), utf8_encode('Comisiones') );//315
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95  + 2, 3), utf8_encode('Mejora de imagen') );//315
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96 + 2 , 3), utf8_encode('Diferencia competencia') );//315
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97 + 2 , 3), utf8_encode('Porque los clientes lo solicitan') );//315
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98 + 2 , 3), utf8_encode('Otros') );//315

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99 + 2 , 3), utf8_encode('Respuesta') );//316
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100 + 2 , 3), utf8_encode('Respuesta') );//317
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 + 2 , 3), utf8_encode('Comentario') );//318

/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B2:C2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('D2:K2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('L2:N2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('O2:T2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('U2:Y2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Z2:AA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AB2:AJ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AK2:AL2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AM2:AN2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AO2:AP2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AR2:AU2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AY2:BA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BB2:BD2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BE2:BF2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BJ2:BK2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BL2:BQ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BR2:BU2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BV2:BY2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CA2:CG2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CH2:CK2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CL2:CO2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CP2:CW2');


/* Aplica estilo a las cabeceras */
$objPHPExcel->setActiveSheetIndex(1)->getStyle('B2:CZ2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('B3:CZ3')->applyFromArray($style_1);


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
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(1 , $contador_1), utf8_encode($rowEmp['store_id'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(2 , $contador_1), $rowEmp['fullname'] );
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(3 , $contador_1), $rowEmp['address'] );
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
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12 + 2, $contador_1), utf8_encode($rowEmp['290_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 + 2, $contador_1), utf8_encode($rowEmp['290_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14 + 2, $contador_1), utf8_encode($rowEmp['290_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15 + 2, $contador_1), utf8_encode($rowEmp['290_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 + 2, $contador_1), utf8_encode($rowEmp['290_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 + 2, $contador_1), utf8_encode($rowEmp['290_f_otro'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 + 2, $contador_1), utf8_encode($rowEmp['291_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 + 2, $contador_1), utf8_encode($rowEmp['291_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 + 2, $contador_1), utf8_encode($rowEmp['291_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 + 2, $contador_1), utf8_encode($rowEmp['291_c'] ));

    if (utf8_encode($rowEmp['291_Foto']) == null || utf8_encode($rowEmp['291_Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 + 2, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 + 2, $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['291_Foto']) .'"  , "Foto" )' );
    }

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23  + 2, $contador_1), utf8_encode($rowEmp['289_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24  + 2, $contador_1), utf8_encode($rowEmp['289_Comentario'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2, $contador_1), utf8_encode($rowEmp['292_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26  + 2, $contador_1), utf8_encode($rowEmp['292_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27  + 2, $contador_1), utf8_encode($rowEmp['292_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28  + 2, $contador_1), utf8_encode($rowEmp['292_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29  + 2, $contador_1), utf8_encode($rowEmp['292_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30  + 2, $contador_1), utf8_encode($rowEmp['292_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31  + 2, $contador_1), utf8_encode($rowEmp['292_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32  + 2, $contador_1), utf8_encode($rowEmp['292_g_otro'] ));
    if (utf8_encode($rowEmp['292_Foto']) == null || utf8_encode($rowEmp['292_Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33  + 2, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33 + 2 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['292_Foto']) .'"  , "Foto" )' );
    }

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34  + 2, $contador_1), utf8_encode($rowEmp['293_Respuesta'] ));
    if (utf8_encode($rowEmp['293_Foto']) == null || utf8_encode($rowEmp['293_Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35  + 2, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35  + 2, $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['293_Foto']) .'"  , "Foto" )' );
    }

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36  + 2, $contador_1), utf8_encode($rowEmp['294_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37  + 2, $contador_1), utf8_encode($rowEmp['294_comentario'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38  + 2, $contador_1), utf8_encode($rowEmp['295_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39  + 2, $contador_1), utf8_encode($rowEmp['295_comentario'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40  + 2, $contador_1), utf8_encode($rowEmp['296_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2, $contador_1), utf8_encode($rowEmp['297_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42  + 2, $contador_1), utf8_encode($rowEmp['297_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43  + 2, $contador_1), utf8_encode($rowEmp['297_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44  + 2, $contador_1), $rowEmp['297_comentario']);

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45  + 2, $contador_1), utf8_encode($rowEmp['298_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46  + 2, $contador_1), utf8_encode($rowEmp['299_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47  + 2, $contador_1), utf8_encode($rowEmp['300_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48  + 2, $contador_1), utf8_encode($rowEmp['301_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49  + 2, $contador_1), utf8_encode($rowEmp['301_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50  + 2, $contador_1), utf8_encode($rowEmp['301_c_otro'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51  + 2, $contador_1), utf8_encode($rowEmp['302_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52  + 2, $contador_1), utf8_encode($rowEmp['302_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53  + 2, $contador_1), utf8_encode($rowEmp['302_c'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54  + 2, $contador_1), utf8_encode($rowEmp['303_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55  + 2, $contador_1), utf8_encode($rowEmp['303_b'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56  + 2, $contador_1), utf8_encode($rowEmp['304_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57  + 2, $contador_1), utf8_encode($rowEmp['305_Opcion'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58  + 2, $contador_1), utf8_encode($rowEmp['306_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59  + 2, $contador_1), utf8_encode($rowEmp['307_Respuesta'] ));
    if (utf8_encode($rowEmp['307_Foto']) == null || utf8_encode($rowEmp['307_Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60  + 2, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60  + 2, $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['307_Foto']) .'"  , "Foto" )' );
    }

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61  + 2, $contador_1), utf8_encode($rowEmp['308_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62  + 2, $contador_1), utf8_encode($rowEmp['308_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63  + 2, $contador_1), utf8_encode($rowEmp['308_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64  + 2, $contador_1), utf8_encode($rowEmp['308_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65  + 2, $contador_1), utf8_encode($rowEmp['308_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66  + 2, $contador_1), utf8_encode($rowEmp['308_f_otro'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67  + 2, $contador_1), utf8_encode($rowEmp['309_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68  + 2, $contador_1), utf8_encode($rowEmp['309_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69  + 2, $contador_1), utf8_encode($rowEmp['309_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70  + 2, $contador_1), utf8_encode($rowEmp['309_d_otro'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71  + 2, $contador_1), utf8_encode($rowEmp['310_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72  + 2, $contador_1), utf8_encode($rowEmp['310_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73  + 2, $contador_1), utf8_encode($rowEmp['310_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74  + 2, $contador_1), utf8_encode($rowEmp['310_d'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75  + 2, $contador_1), utf8_encode($rowEmp['311_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76  + 2, $contador_1), utf8_encode($rowEmp['312_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77  + 2, $contador_1), utf8_encode($rowEmp['312_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78  + 2, $contador_1), utf8_encode($rowEmp['312_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79  + 2, $contador_1), utf8_encode($rowEmp['312_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80  + 2, $contador_1), utf8_encode($rowEmp['312_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81  + 2, $contador_1), utf8_encode($rowEmp['312_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82  + 2, $contador_1), utf8_encode($rowEmp['312_g'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83  + 2, $contador_1), utf8_encode($rowEmp['313_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84  + 2, $contador_1), utf8_encode($rowEmp['313_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85  + 2, $contador_1), utf8_encode($rowEmp['313_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86  + 2, $contador_1), utf8_encode($rowEmp['313_d'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87  + 2, $contador_1), utf8_encode($rowEmp['314_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88  + 2, $contador_1), utf8_encode($rowEmp['314_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89  + 2, $contador_1), utf8_encode($rowEmp['314_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90  + 2, $contador_1), $rowEmp['314_Opcion']);


    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91  + 2, $contador_1), utf8_encode($rowEmp['315_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92  + 2, $contador_1), utf8_encode($rowEmp['315_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93  + 2, $contador_1), utf8_encode($rowEmp['315_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94  + 2, $contador_1), utf8_encode($rowEmp['315_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95  + 2, $contador_1), utf8_encode($rowEmp['315_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96  + 2, $contador_1), utf8_encode($rowEmp['315_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97  + 2, $contador_1), utf8_encode($rowEmp['315_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98  + 2, $contador_1), utf8_encode($rowEmp['315_g_otro'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99  + 2, $contador_1), utf8_encode($rowEmp['316_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100  + 2, $contador_1), utf8_encode($rowEmp['317_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101  + 2, $contador_1), utf8_encode($rowEmp['318_comentario'] ));

    $objPHPExcel->setActiveSheetIndex(1)->getStyle('B'.$contador_1.':C'.$contador_1)->applyFromArray($style_2);
    $objPHPExcel->setActiveSheetIndex(1)->getStyle('D'.$contador_1.':CZ'.$contador_1)->applyFromArray($style_3);
}

$objPHPExcel->getActiveSheet()->setTitle('resumen');

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("REPORTE Full Carga")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");


// Redirect output to a clients web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Content-Disposition: attachment;filename="REPORTE_Full_Carga_24.xlsx"');
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