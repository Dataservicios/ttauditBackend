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
$query_detalle_puntos = "call sp_consulta_reporte_company_23";
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

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12  + 2 , 2), utf8_encode('1. Indicar Rubro (id = 260)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18  + 2 , 2), '2. ¿Se encuentra abierto el agente? (id = 261)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23  + 2 , 2), '3. Al llegar al establecimiento el cliente incógnito deberá preguntar directamente por el agente de Kasnet. Ejemplo: Buenos días/tardes, ¿hay agente de Kasnet aquí? (id = 259)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2 , 2), '4. ¿El letrero de Agente Kasnet  era visible desde fuera?  (id = 262)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34  + 2 , 2), '5. ¿El Agente Kasnet es visible estando dentro del establecimiento? (id = 263)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39  + 2 , 2), '6. ¿Existe algún otro Agente / corresponsal bancario? (id = 264)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2 , 2), '7. El CI deberá preguntar, ¿Puedo pagar una tarjeta de crédito de Kasnet acá? (id = 265)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43  + 2 , 2), '8. En el caso de que exista más de un agente en el comercio, preguntar, ¿acá puedo pagar mi teléfono? (id = 266)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44  + 2 , 2), '9. Si responde que si en la P8, preguntar ¿Y en cuál agente me conviene pagar mi teléfono? (id = 267)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48  + 2 , 2), '10. Si me envían dinero del exterior ¿Lo puedo cobrar acá? (id = 268)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49  + 2 , 2), '11. Al preguntar si se podía hacer la operación correspondiente, ¿el dependiente aceptó realizar la operación? (id = 269)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50  + 2 , 2), '12. ¿Su solicitud fue atendido de inmediato? (id = 270)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51  + 2 , 2), '13. Su solicitud no fue atendida de inmediato porque (id = 271)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54  + 2 , 2), '14. Mientras esperaba. ¿La persona que lo atendió se preocupó por su tiempo? (id = 272)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57  + 2 , 2), '15. Después de esperar (id = 273)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59  + 2 , 2), '16. ¿La transacción se llegó a realizar de manera exitosa? (Se considera exitosa cuando se entrega el voucher) (id = 274)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60  + 2 , 2), '17. ¿Cuántos MINUTOS transcurrieron entre que solicitó la transacción y la persona terminó (le entregá el voucher)? (id = 275)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61  + 2 , 2), '18. ¿La persona que lo atendió tuvo que solicitar ayuda de alguna otra persona o hacer alguna consulta al respecto? (id = 276)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62  + 2 , 2), '19. ¿Le entregaron ESPONTÁ?NEAMENTE un comprobante luego de la transacción? (Si no le entregaron espontáneamente el voucher deben solicitarlo y adjuntarlo al formulario) (id = 277)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64  + 2 , 2), '20. (SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Por qué no se pudo realizar la transacción? (id = 278)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70  + 2 , 2), '21. (SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Le dieron alguna solución para poder realizar la transacción? (id = 279)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74  + 2 , 2), '22. Escoger tipo de Transacción (id = 280)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78  + 2 , 2), '23. ¿El agente hizo algún cobro fuera del voucher? (id = 281)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79  + 2 , 2), '24. En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la amabilidad de la persona que te atendió? (id = 282)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86  + 2 , 2), '25. En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías el conocimiento de la persona que lo atendió? (id = 283)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90  + 2 , 2), '26. En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la disposición de la persona que lo atendió? (id = 284)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94  + 2 , 2), '27. El CI deberá mostrar interés: Voy a abrir un negocio, ¿usted me recomendaría tener un agente Kasnet? (id = 285)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 + 2  , 2), '28. ¿Sabe si tienen alguna página web para conseguir información (id = 286)') ;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103 + 2  , 2), '29. ¿La persona encargada le proporcionó dicha información (id = 287)' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 + 2  , 2), '30. Otras apreciaciones a comentar (id = 288)') ;



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

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2, 3), utf8_encode('Respuesta') );//262
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26  + 2, 3), utf8_encode('BBVA') );//262
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27  + 2, 3), utf8_encode('Scotiabank') );//262
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28  + 2, 3), 'Banco de la Nación' );//262
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29  + 2, 3), utf8_encode('Caja Trujillo') );//262
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30  + 2, 3), utf8_encode('Caja Huancayo') );//262
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31  + 2, 3), utf8_encode('Caja Arequipa') );//262
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32  + 2, 3), utf8_encode('Otros') );//262
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33  + 2, 3), utf8_encode('Foto') );//262

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34  + 2, 3), utf8_encode('Respuesta') );//263
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35  + 2, 3), utf8_encode('Colgante') );//263
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36  + 2, 3), utf8_encode('Mostrador') );//263
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37  + 2, 3), utf8_encode('Banner') );//263
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38  + 2, 3), utf8_encode('Foto') );//263

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39  + 2, 3), utf8_encode('Respuesta') );//264
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40  + 2, 3), utf8_encode('Comentario') );//264

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2, 3), utf8_encode('Respuesta') );//265
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42  + 2, 3), utf8_encode('Comentario') );//265

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43  + 2, 3), utf8_encode('Respuesta') );//266

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44  + 2, 3), utf8_encode('BBVV') );//267
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45  + 2, 3), utf8_encode('Scotiabank') );//267
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46  + 2, 3), 'Banco de la Nación' );//267
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47  + 2, 3), utf8_encode('Otro') );//267

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48  + 2, 3), utf8_encode('Respuesta') );//268

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49  + 2, 3), utf8_encode('Respuesta') );//269

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50  + 2, 3), utf8_encode('Respuesta') );//270

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51  + 2, 3), utf8_encode('El encargado estaba ocupado	') );//271
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52  + 2, 3), utf8_encode('Porque me indicó que no había sistema') );//271
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53  + 2, 3), utf8_encode('Otro') );//271

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54  + 2, 3), 'Pidiéndole que por favor espere mientras terminaba de atender a otro cliente') ;//272
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55  + 2, 3), 'Preguntándole desde que llegá, qué operación iba a realizar, para saber cómo atenderlo cuando se desocupe') ;//272
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56  + 2, 3), utf8_encode('Otro') );//272

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57  + 2, 3), utf8_encode('Me atendieron ') );//273
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58  + 2, 3), utf8_encode('No me atendieron') );//273

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59  + 2, 3), utf8_encode('Respuesta') );//274

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60  + 2, 3), utf8_encode('Opcion') );//275

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61  + 2, 3), utf8_encode('Respuesta') );//276

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62  + 2, 3), utf8_encode('Respuesta') );//277
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63  + 2, 3), utf8_encode('Foto') );//277

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64  + 2, 3), 'No había sistema' );//278
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65  + 2, 3), 'La línea estaba copada para el depósito') ;//278
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66  + 2, 3), utf8_encode('La persona que atiende (operador) no estaba disponible') );//278
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67  + 2, 3), utf8_encode('POS no operativo') );//278
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68  + 2, 3), 'No había efectivo disponible para el retiro');//278
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69  + 2, 3), utf8_encode('Otro') );//278

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70  + 2, 3), 'Le pidió regrese más tarde');//279
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71  + 2, 3), utf8_encode('Lo guio hacia otro Agente') );//279
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72  + 2, 3), utf8_encode('Le dijo como llegar a alguna Tienda Kasnet') );//279
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73  + 2, 3), utf8_encode('Otros') );//279

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74  + 2, 3), utf8_encode('Pago de TC') );//280
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75  + 2, 3), utf8_encode('Retiro') );//280
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76  + 2, 3), utf8_encode('Deposito') );//280
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77  + 2, 3), utf8_encode('Pago de Servicios (indicar que servicio se paga)') );//280

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78  + 2, 3), utf8_encode('Respuesta') );//281

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79  + 2, 3), utf8_encode('Saluda ') );//282
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80  + 2, 3), utf8_encode('Usa el por favor') );//282
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81  + 2, 3), utf8_encode('Da las gracias') );//282
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82  + 2, 3), utf8_encode('Sonrie ') );//282
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83  + 2, 3), utf8_encode('Mira a los ojos') );//282
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84  + 2, 3), utf8_encode('No interrumpe') );//282
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85  + 2, 3), utf8_encode('Despedida') );//282

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86  + 2, 3), utf8_encode('Conoce las operaciones que se puede realizar en agente ') );//283
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87  + 2, 3), 'Sabe cómo operar el pos al realizar la operación') ;//283
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88  + 2, 3), 'No solicita ayuda para realizar la operación') ;//283
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89  + 2, 3), 'Conoce la página web para conseguir información' );//283

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90  + 2, 3), 'Pendiente de  usted durante la atención');//284
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91  + 2, 3), 'Concentrado en la operación mientras atendía ');//284
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92  + 2, 3), 'Le ofreció un producto o servicio adicional' );//284
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93  + 2, 3), 'Estándar' );//284

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94  + 2, 3), utf8_encode('Respuesta') );//285
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95  + 2, 3), utf8_encode('Incremento clientes') );//285
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96  + 2, 3), 'Más ventas' );//285
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97  + 2, 3), utf8_encode('Comisiones') );//285
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98  + 2, 3), utf8_encode('Mejora de imagen') );//285
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99 + 2 , 3), utf8_encode('Diferencia competencia') );//285
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100 + 2 , 3), utf8_encode('Porque los clientes lo solicitan') );//285
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 + 2 , 3), utf8_encode('Otros') );//285

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 + 2 , 3), utf8_encode('Respuesta') );//286
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103 + 2 , 3), utf8_encode('Respuesta') );//287
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 + 2 , 3), utf8_encode('Comentario') );//288

/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B2:C2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('D2:K2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('L2:N2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('O2:T2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('U2:Y2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Z2:AA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AB2:AJ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AK2:AO2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AP2:AQ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AR2:AS2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AU2:AX2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BB2:BD2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BE2:BG2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BH2:BI2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BM2:BN2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BO2:BT2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BU2:BX2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BY2:CB2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CD2:CJ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CK2:CN2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CO2:CR2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CS2:CZ2');


/* Aplica estilo a las cabeceras */
$objPHPExcel->setActiveSheetIndex(1)->getStyle('B2:DC2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('B3:DC3')->applyFromArray($style_1);


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
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12 + 2, $contador_1), utf8_encode($rowEmp['260_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 + 2, $contador_1), utf8_encode($rowEmp['260_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14 + 2, $contador_1), utf8_encode($rowEmp['260_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15 + 2, $contador_1), utf8_encode($rowEmp['260_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 + 2, $contador_1), utf8_encode($rowEmp['260_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 + 2, $contador_1), utf8_encode($rowEmp['260_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 + 2, $contador_1), utf8_encode($rowEmp['261_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 + 2, $contador_1), utf8_encode($rowEmp['261_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 + 2, $contador_1), utf8_encode($rowEmp['261_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 + 2, $contador_1), utf8_encode($rowEmp['261_c'] ));

    if (utf8_encode($rowEmp['261_Foto']) == null || utf8_encode($rowEmp['261_Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 + 2, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 + 2, $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['261_Foto']) .'"  , "Foto" )' );
    }

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23  + 2, $contador_1), utf8_encode($rowEmp['259_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24  + 2, $contador_1), utf8_encode($rowEmp['259_Comentario'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2, $contador_1), utf8_encode($rowEmp['262_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26  + 2, $contador_1), utf8_encode($rowEmp['262_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27  + 2, $contador_1), utf8_encode($rowEmp['262_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28  + 2, $contador_1), utf8_encode($rowEmp['262_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29  + 2, $contador_1), utf8_encode($rowEmp['262_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30  + 2, $contador_1), utf8_encode($rowEmp['262_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31  + 2, $contador_1), utf8_encode($rowEmp['262_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32  + 2, $contador_1), utf8_encode($rowEmp['262_g_otro'] ));
    if (utf8_encode($rowEmp['262_Foto']) == null || utf8_encode($rowEmp['262_Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33  + 2, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33 + 2 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['262_Foto']) .'"  , "Foto" )' );
    }

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34  + 2, $contador_1), utf8_encode($rowEmp['263_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35  + 2, $contador_1), utf8_encode($rowEmp['263_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36  + 2, $contador_1), utf8_encode($rowEmp['263_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37  + 2, $contador_1), utf8_encode($rowEmp['263_c'] ) );
    if (utf8_encode($rowEmp['263_Foto']) == null || utf8_encode($rowEmp['263_Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38  + 2, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38  + 2, $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['263_Foto']) .'"  , "Foto" )' );
    }

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39  + 2, $contador_1), utf8_encode($rowEmp['264_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40  + 2, $contador_1), utf8_encode($rowEmp['264_comentario'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2, $contador_1), utf8_encode($rowEmp['265_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42  + 2, $contador_1), utf8_encode($rowEmp['265_comentario'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43  + 2, $contador_1), utf8_encode($rowEmp['266_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44  + 2, $contador_1), utf8_encode($rowEmp['267_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45  + 2, $contador_1), utf8_encode($rowEmp['267_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46  + 2, $contador_1), utf8_encode($rowEmp['267_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47  + 2, $contador_1), utf8_encode($rowEmp['267_d'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48  + 2, $contador_1), utf8_encode($rowEmp['268_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49  + 2, $contador_1), utf8_encode($rowEmp['269_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50  + 2, $contador_1), utf8_encode($rowEmp['270_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51  + 2, $contador_1), utf8_encode($rowEmp['271_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52  + 2, $contador_1), utf8_encode($rowEmp['271_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53  + 2, $contador_1), utf8_encode($rowEmp['271_c'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54  + 2, $contador_1), utf8_encode($rowEmp['272_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55  + 2, $contador_1), utf8_encode($rowEmp['272_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56  + 2, $contador_1), utf8_encode($rowEmp['272_c'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57  + 2, $contador_1), utf8_encode($rowEmp['273_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58  + 2, $contador_1), utf8_encode($rowEmp['273_b'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59  + 2, $contador_1), utf8_encode($rowEmp['274_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60  + 2, $contador_1), utf8_encode($rowEmp['275_Opcion'] ));
    
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61  + 2, $contador_1), utf8_encode($rowEmp['276_Respuesta'] ));
    
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62  + 2, $contador_1), utf8_encode($rowEmp['277_Respuesta'] ));
    if (utf8_encode($rowEmp['277_Foto']) == null || utf8_encode($rowEmp['277_Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63  + 2, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63  + 2, $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['277_Foto']) .'"  , "Foto" )' );
    }

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64  + 2, $contador_1), utf8_encode($rowEmp['278_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65  + 2, $contador_1), utf8_encode($rowEmp['278_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66  + 2, $contador_1), utf8_encode($rowEmp['278_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67  + 2, $contador_1), utf8_encode($rowEmp['278_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68  + 2, $contador_1), utf8_encode($rowEmp['278_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69  + 2, $contador_1), utf8_encode($rowEmp['278_f'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70  + 2, $contador_1), utf8_encode($rowEmp['279_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71  + 2, $contador_1), utf8_encode($rowEmp['279_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72  + 2, $contador_1), utf8_encode($rowEmp['279_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73  + 2, $contador_1), utf8_encode($rowEmp['279_d'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74  + 2, $contador_1), utf8_encode($rowEmp['280_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75  + 2, $contador_1), utf8_encode($rowEmp['280_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76  + 2, $contador_1), utf8_encode($rowEmp['280_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77  + 2, $contador_1), utf8_encode($rowEmp['280_d'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78  + 2, $contador_1), utf8_encode($rowEmp['281_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79  + 2, $contador_1), utf8_encode($rowEmp['282_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80  + 2, $contador_1), utf8_encode($rowEmp['282_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81  + 2, $contador_1), utf8_encode($rowEmp['282_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82  + 2, $contador_1), utf8_encode($rowEmp['282_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83  + 2, $contador_1), utf8_encode($rowEmp['282_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84  + 2, $contador_1), utf8_encode($rowEmp['282_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85  + 2, $contador_1), utf8_encode($rowEmp['282_g'] ));
    
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86  + 2, $contador_1), utf8_encode($rowEmp['283_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87  + 2, $contador_1), utf8_encode($rowEmp['283_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88  + 2, $contador_1), utf8_encode($rowEmp['283_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89  + 2, $contador_1), utf8_encode($rowEmp['283_d'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90  + 2, $contador_1), utf8_encode($rowEmp['284_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91  + 2, $contador_1), utf8_encode($rowEmp['284_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92  + 2, $contador_1), utf8_encode($rowEmp['284_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93  + 2, $contador_1), $rowEmp['284_Opcion']);


    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94  + 2, $contador_1), utf8_encode($rowEmp['285_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95  + 2, $contador_1), utf8_encode($rowEmp['285_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96  + 2, $contador_1), utf8_encode($rowEmp['285_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97  + 2, $contador_1), utf8_encode($rowEmp['285_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98  + 2, $contador_1), utf8_encode($rowEmp['285_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99  + 2, $contador_1), utf8_encode($rowEmp['285_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100  + 2, $contador_1), utf8_encode($rowEmp['285_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101  + 2, $contador_1), utf8_encode($rowEmp['285_g'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102  + 2, $contador_1), utf8_encode($rowEmp['286_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103  + 2, $contador_1), utf8_encode($rowEmp['287_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104  + 2, $contador_1), utf8_encode($rowEmp['288_comentario'] ));

    $objPHPExcel->setActiveSheetIndex(1)->getStyle('B'.$contador_1.':C'.$contador_1)->applyFromArray($style_2);
    $objPHPExcel->setActiveSheetIndex(1)->getStyle('D'.$contador_1.':DC'.$contador_1)->applyFromArray($style_3);
}

$objPHPExcel->getActiveSheet()->setTitle('resumen');

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("REPORTE KASNET")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");


// Redirect output to a clients web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Content-Disposition: attachment;filename="REPORTE_KASNET_23.xlsx"');
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