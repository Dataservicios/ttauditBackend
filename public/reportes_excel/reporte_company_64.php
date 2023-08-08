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
$query_detalle_puntos = "call sp_consulta_reporte_company_64";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A3', 'ID');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B3', 'PSE');
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

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12  + 2 , 2), ('1. Indicar Rubro (id = 903)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18  + 2 , 2), ('2. ¿Se encuentra abierto el agente? (id = 904)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23  + 2 , 2), ('3. Al llegar al establecimiento el cliente incógnito deberá preguntar directamente por el agente de Interbank. Ejemplo: Buenos días/tardes, ¿hay agente de Interbank aquí? (id = 902)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2 , 2), ('4. ¿El letrero de IBK Agente era visible desde fuera? (id = 905)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32  + 2 , 2), ('5. ¿El Interbank Agente es visible estando dentro del establecimiento? (id = 906)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37  + 2 , 2), ('6. ¿Existe algún otro Agente / corresponsal bancario? (id = 907)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39  + 2 , 2), ('7. El CI deberá preguntar, ¿Puedo pagar una tarjeta de crédito de Interbank acá? (id = 908)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2 , 2), ('8. En el caso de que exista más de un agente en el comercio, preguntar, ¿acá puedo pagar mi teléfono? (id = 909)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42  + 2 , 2), ('9. Si responde que si en la P8, preguntar ¿Y en cuál agente me conviene pagar mi teléfono? (id = 910)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46  + 2 , 2), ('10. Si me envían dinero del exterior ¿Lo puedo cobrar acá? (id = 911)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47  + 2 , 2), ('11. Escoger tipo de Transacción (id = 923)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51  + 2 , 2), ('12. Al preguntar si se podía hacer la operación correspondiente, ¿el dependiente aceptó realizar la operación? (id = 912)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52  + 2 , 2), ('13. ¿Su solicitud fue atendido de inmediato? (id = 913)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53  + 2 , 2), ('14. Su solicitud no fue atendida de inmediato porque (id = 914)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56  + 2 , 2), ('15. Mientras esperaba. ¿La persona que lo atendió se preocupó por su tiempo? (id = 915)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59  + 2 , 2), ('16. Después de esperar (id = 916)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61  + 2 , 2), ('17. ¿La transacción se llegó a realizar de manera exitosa? (Se considera exitosa cuando se entrega el voucher) (id = 917)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62  + 2 , 2), ('18. ¿El agente hizo algún cobro fuera del voucher? (id = 924)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63  + 2 , 2), ('19. ¿Cuántos MINUTOS transcurrieron entre que solicitó la transacción y la persona terminó (le entregá el voucher)? (id = 918)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64  + 2 , 2), ('20. ¿La persona que lo atendió tuvo que solicitar ayuda de alguna otra persona o hacer alguna consulta al respecto? (id = 919)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65  + 2 , 2), ('21. ¿Le entregaron ESPONTÁ?NEAMENTE un comprobante luego de la transacción? (Si no le entregaron espontáneamente el voucher deben solicitarlo y adjuntarlo al formulario) (id = 920)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67  + 2 , 2), ('22. (SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Por qué no se pudo realizar la transacción? (id = 921)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74  + 2 , 2), ('23. (SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Le dieron alguna solución para poder realizar la transacción? (id = 922)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78  + 2 , 2), ('24. En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la amabilidad de la persona que te atendió? (id = 925)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86  + 2 , 2), ('25. En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías el conocimiento de la persona que lo atendió? (id = 926)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90  + 2 , 2), ('26. En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la disposición de la persona que lo atendió? (id = 927)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94  + 2 , 2), '27. El CI deberá mostrar interés: Voy a abrir un negocio, ¿usted me recomendaría tener un agente Interbank? (id = 928)' );
//$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 + 2  , 2), ('28. ¿Sabe si tienen alguna página web para conseguir información (id = 744)') );
//$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 + 2  , 2), ('29. ¿La persona encargada le proporcionó dicha información (id = 745)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 + 2  , 2), ('30. Otras apreciaciones a comentar (id = 929)') );

// -----------------Bim ------------------------------------------
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 + 2  , 2), ('31. ¿El letrero de Agente BIM era visible desde fuera? (id = 930)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107 + 2  , 2), ('32. ¿Al preguntar si se podía hacer la operación, ¿el dependiente aceptó realizar la operación?? (id = 931)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(108 + 2  , 2), ('33. ¿¿Su solicitud fue atendido de inmediato? (id = 932)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(109 + 2  , 2), ('34. ¿ Su solicitud no fue atendida de inmediato porque? (id = 933)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(111 + 2  , 2), ('35. Después de esperar (id = 934)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(112 + 2  , 2), ('36. ¿La transacción se llegó a realizar de manera exitosa?  (Ojo esta tipo de transacciones no generan voucher, la confirmación es a través de un SMS) (id = 935)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(113 + 2  , 2), ('37. (SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Por qué no se pudo realizar la transacción? (id = 936)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(115 + 2  , 2), ('38. (SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Le dieron alguna solución para poder realizar la transacción? (id = 937)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(117 + 2  , 2), ('39. Otras apreciaciones a comentar (id = 938)') );




$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12  + 2, 3), ('Bodega') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13  + 2, 3), ('Farmacia') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14  + 2, 3), ('Locutorio') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15  + 2, 3), ('Librerias') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16  + 2, 3), ('Tiendas Com') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17  + 2, 3), ('Otro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19  + 2, 3), ('Local Cerrado') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20  + 2, 3), ('Ya no es Agente') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21  + 2, 3), ('Existe señalización pero pidio retiro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22  + 2, 3), ('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24  + 2, 3), ('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26  + 2, 3), ('Letrero de metal o madera') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27  + 2, 3), ('Rompe tráfico') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28  + 2, 3), ('Letrero luminoso') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29  + 2, 3), ('Letrero luminoso Bandera') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30  + 2, 3), ('Letrero compartido') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31  + 2, 3), ('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33  + 2, 3), ('Colgante') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34  + 2, 3), ('Mostrador') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35  + 2, 3), ('Banner') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36  + 2, 3), ('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38  + 2, 3), ('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40  + 2, 3), ('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42  + 2, 3), ('Interbank') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43  + 2, 3), ('Otro Agente') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44  + 2, 3), ('En cualquiera/En el que usted decida/En los dos') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45  + 2, 3), ('No Precisa') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47  + 2, 3), ('Pago de TC') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48  + 2, 3), ('Retiro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49  + 2, 3), ('Deposito') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50  + 2, 3), ('Pago de Servicios') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53  + 2, 3), ('El encargado estaba ocupado	') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54  + 2, 3), ('Porque me indicó que no había sistema') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55  + 2, 3), ('Otro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56  + 2, 3), 'Pidiéndole que por favor espere mientras terminaba de atender a otro cliente');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57  + 2, 3), 'Preguntándole desde que llegá, qué operación iba a realizar, para saber cómo atenderlo cuando se desocupe');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58  + 2, 3), ('Otro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59  + 2, 3), ('Me atendieron ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60  + 2, 3), ('No me atendieron') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63  + 2, 3), ('Opcion') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66  + 2, 3), ('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67  + 2, 3), 'No había sistema' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68  + 2, 3), ('La línea estaba copada para el depósito') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69  + 2, 3), ('La persona que atiende (operador) no estaba disponible') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70  + 2, 3), ('POS no operativo') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71  + 2, 3), 'No había efectivo disponible para el retiro' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72  + 2, 3), 'Falta de conocimiento de la operativa / capacitación' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73  + 2, 3), ('Otro') );
/*$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73  + 2, 3), ('Comentario') );*/
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74  + 2, 3), 'Le pidió regrese más tarde' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75  + 2, 3), ('Lo guio hacia otro Agente') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76  + 2, 3), ('Le dijo como llegar a alguna Tienda Interbank') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77  + 2, 3), ('Otros Indicar Cual') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78  + 2, 3), ('Saluda ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79  + 2, 3), ('Usa el por favor') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80  + 2, 3), ('Da las gracias') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81  + 2, 3), ('Sonríe') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82  + 2, 3), ('Mira a los ojos') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83  + 2, 3), ('No interrumpe') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84  + 2, 3), ('Despedida') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85  + 2, 3), ('Estandar') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86  + 2, 3), ('Conoce las operaciones que se puede realizar en agente ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87  + 2, 3), ('Sabe cómo operar el pos al realizar la operación') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88  + 2, 3), ('No solicita ayuda para realizar la operación') );
//$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88  + 2, 3), ('Conoce la página web para conseguir información') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89  + 2, 3), ('Estandar') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90  + 2, 3), ('Pendiente de  usted durante la atención') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91  + 2, 3), 'Concentrado en la operación mientras atendía ' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92  + 2, 3), ('Le ofreció un producto o servicio adicional') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93  + 2, 3), ('Estandar') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94  + 2, 3), ('Respuesta') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95  + 2, 3), ('Incremento clientes') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96  + 2, 3), 'Más ventas' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97  + 2, 3), ('Comisiones') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98  + 2, 3), ('Mejora de imagen') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99 + 2 , 3), ('Diferencia competencia') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100 + 2 , 3), ('Porque los clientes lo solicitan') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 + 2 , 3), ('Seguridad') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 + 2 , 3), ('Pérdida de tiempo') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103 + 2 , 3), ('Comisiones bajas') );

//$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 + 2 , 3), ('Respuesta') );
//$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 + 2 , 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 + 2 , 3), ('Comentario') );


// -----------------Bim ------------------------------------------
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 + 2  , 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106 + 2  , 3), ('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107 + 2  , 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(108 + 2  , 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(109 + 2  , 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(110 + 2  , 3), ('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(111 + 2  , 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(112 + 2  , 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(113 + 2  , 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(114 + 2  , 3), ('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(115 + 2  , 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(116 + 2  , 3), ('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(117 + 2  , 3), ('Comentario') );

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
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CK2:CN2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CO2:CR2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CS2:DB2');


/* Aplica estilo a las cabeceras */
$objPHPExcel->setActiveSheetIndex(1)->getStyle('B2:DP2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:DP3')->applyFromArray($style_1);


/* Define el Ancho de las Celdas */
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
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
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(0 , $contador_1), ($rowEmp['store_id'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(1 , $contador_1), ($rowEmp['codclient'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(2 , $contador_1), utf8_encode($rowEmp['fullname'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(3 , $contador_1), utf8_encode($rowEmp['address']));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(4 , $contador_1), utf8_encode($rowEmp['district'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(5 , $contador_1), utf8_encode($rowEmp['region'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(6 , $contador_1), utf8_encode($rowEmp['ubigeo'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(5 + 2, $contador_1), ($rowEmp['latitude'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(6 + 2, $contador_1), ($rowEmp['longitude'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(7 + 2, $contador_1), utf8_encode($rowEmp['ejecutivo'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(8 + 2, $contador_1), utf8_encode($rowEmp['coordinador'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(9 + 2, $contador_1), ($rowEmp['fecha'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(10 + 2, $contador_1), ($rowEmp['hora'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(11 + 2, $contador_1), utf8_encode($rowEmp['auditor'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12 + 2, $contador_1), ($rowEmp['903_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 + 2, $contador_1), ($rowEmp['903_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14 + 2, $contador_1), ($rowEmp['903_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15 + 2, $contador_1), ($rowEmp['903_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 + 2, $contador_1), ($rowEmp['903_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 + 2, $contador_1), utf8_encode($rowEmp['903_f_otro'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 + 2, $contador_1), utf8_encode($rowEmp['904_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 + 2, $contador_1), ($rowEmp['904_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 + 2, $contador_1), ($rowEmp['904_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 + 2, $contador_1), ($rowEmp['904_c'] ));

    if (($rowEmp['904_Foto']) == null || ($rowEmp['904_Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 + 2, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 + 2, $contador_1), '=HYPERLINK( "'. ($rowEmp['904_Foto']) .'"  , "Foto" )' );
    }
    //$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , $contador_1), '=HYPERLINK( "'. ($rowEmp['904_Foto']) .'"  , "Foto" )' );
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23  + 2, $contador_1), utf8_encode($rowEmp['902_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24  + 2, $contador_1), utf8_encode($rowEmp['902_Comentario'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2, $contador_1), ($rowEmp['905_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26  + 2, $contador_1), ($rowEmp['905_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27  + 2, $contador_1), ($rowEmp['905_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28  + 2, $contador_1), ($rowEmp['905_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29  + 2, $contador_1), ($rowEmp['905_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30  + 2, $contador_1), ($rowEmp['905_e'] ));

    if (($rowEmp['905_Foto']) == null || ($rowEmp['905_Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31  + 2, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 + 2 , $contador_1), '=HYPERLINK( "'. ($rowEmp['905_Foto']) .'"  , "Foto" )' );
    }

    //$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 , $contador_1), ($rowEmp['905_Foto'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32  + 2, $contador_1), utf8_encode($rowEmp['906_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33  + 2, $contador_1), ($rowEmp['906_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34  + 2, $contador_1), ($rowEmp['906_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35  + 2, $contador_1), ($rowEmp['906_c'] ));

    if (($rowEmp['906_Foto']) == null || ($rowEmp['906_Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36  + 2, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36  + 2, $contador_1), '=HYPERLINK( "'. ($rowEmp['906_Foto']) .'"  , "Foto" )' );
    }

    //$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36 , $contador_1), ($rowEmp['906_Foto'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37  + 2, $contador_1), utf8_encode($rowEmp['907_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38  + 2, $contador_1), utf8_encode($rowEmp['907_comentario'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39  + 2, $contador_1), ($rowEmp['908_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40  + 2, $contador_1), utf8_encode($rowEmp['908_comentario'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2, $contador_1), utf8_encode($rowEmp['909_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42  + 2, $contador_1), ($rowEmp['910_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43  + 2, $contador_1), ($rowEmp['910_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44  + 2, $contador_1), ($rowEmp['910_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45  + 2, $contador_1), ($rowEmp['910_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46  + 2, $contador_1), utf8_encode($rowEmp['911_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47  + 2, $contador_1), ($rowEmp['923_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48  + 2, $contador_1), ($rowEmp['923_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49  + 2, $contador_1), ($rowEmp['923_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50  + 2, $contador_1), ($rowEmp['923_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51  + 2, $contador_1), utf8_encode($rowEmp['912_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52  + 2, $contador_1), utf8_encode($rowEmp['913_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53  + 2, $contador_1), ($rowEmp['914_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54  + 2, $contador_1), ($rowEmp['914_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55  + 2, $contador_1), ($rowEmp['914_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56  + 2, $contador_1), ($rowEmp['915_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57  + 2, $contador_1), ($rowEmp['915_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58  + 2, $contador_1), ($rowEmp['915_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59  + 2, $contador_1), ($rowEmp['916_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60  + 2, $contador_1), ($rowEmp['916_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61  + 2, $contador_1), utf8_encode($rowEmp['917_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62  + 2, $contador_1), utf8_encode($rowEmp['924_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63  + 2, $contador_1), ($rowEmp['918_Opcion'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64  + 2, $contador_1), utf8_encode($rowEmp['919_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65  + 2, $contador_1), utf8_encode($rowEmp['920_Respuesta'] ));

    if (($rowEmp['920_Foto']) == null || ($rowEmp['920_Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66  + 2, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66  + 2, $contador_1), '=HYPERLINK( "'. ($rowEmp['920_Foto']) .'"  , "Foto" )' );
    }

    //$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66 , $contador_1), ($rowEmp['920_Foto'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67  + 2, $contador_1), ($rowEmp['921_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68  + 2, $contador_1), ($rowEmp['921_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69  + 2, $contador_1), ($rowEmp['921_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70  + 2, $contador_1), ($rowEmp['921_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71  + 2, $contador_1), ($rowEmp['921_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72  + 2, $contador_1), ($rowEmp['921_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73  + 2, $contador_1), utf8_encode($rowEmp['921_g_otro'] ));
    /*$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73  + 2, $contador_1), ($rowEmp['921_Comentario'] ));*/
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74  + 2, $contador_1), ($rowEmp['922_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75  + 2, $contador_1), ($rowEmp['922_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76  + 2, $contador_1), ($rowEmp['922_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77  + 2, $contador_1), utf8_encode($rowEmp['922_d_otro'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78  + 2, $contador_1), ($rowEmp['925_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79  + 2, $contador_1), ($rowEmp['925_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80  + 2, $contador_1), ($rowEmp['925_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81  + 2, $contador_1), ($rowEmp['925_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82  + 2, $contador_1), ($rowEmp['925_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83  + 2, $contador_1), ($rowEmp['925_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84  + 2, $contador_1), ($rowEmp['925_g'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85  + 2, $contador_1), utf8_encode($rowEmp['925_Opcion'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86  + 2, $contador_1), ($rowEmp['926_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87  + 2, $contador_1), ($rowEmp['926_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88  + 2, $contador_1), ($rowEmp['926_c'] ));
    //$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88  + 2, $contador_1), ($rowEmp['926_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89  + 2, $contador_1), utf8_encode($rowEmp['926_Opcion'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90  + 2, $contador_1), ($rowEmp['927_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91  + 2, $contador_1), ($rowEmp['927_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92  + 2, $contador_1), ($rowEmp['927_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93  + 2, $contador_1), utf8_encode($rowEmp['927_Opcion'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94  + 2, $contador_1), utf8_encode($rowEmp['928_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95  + 2, $contador_1), ($rowEmp['928_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96  + 2, $contador_1), ($rowEmp['928_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97  + 2, $contador_1), ($rowEmp['928_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98  + 2, $contador_1), ($rowEmp['928_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99  + 2, $contador_1), ($rowEmp['928_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100  + 2, $contador_1), ($rowEmp['928_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101  + 2, $contador_1), ($rowEmp['928_g'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102  + 2, $contador_1), ($rowEmp['928_h'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103  + 2, $contador_1), ($rowEmp['928_i'] ));

//    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104  + 2, $contador_1), utf8_encode($rowEmp['744_Respuesta'] ));
//    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105  + 2, $contador_1), utf8_encode($rowEmp['745_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104  + 2, $contador_1), utf8_encode($rowEmp['929_comentario'] ));




    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105  + 2, $contador_1), utf8_encode($rowEmp['930_Respuesta'] ));

    if (($rowEmp['930_Foto']) == null || ($rowEmp['930_Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106  + 2, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106  + 2, $contador_1), '=HYPERLINK( "'. ($rowEmp['930_Foto']) .'"  , "Foto" )' );
    }

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107  + 2, $contador_1), utf8_encode($rowEmp['931_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(108  + 2, $contador_1), utf8_encode($rowEmp['932_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(109  + 2, $contador_1), utf8_encode($rowEmp['933_Opciones'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(110  + 2, $contador_1), utf8_encode($rowEmp['933_Comentario'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(111  + 2, $contador_1), utf8_encode($rowEmp['934_Opciones'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(112  + 2, $contador_1), utf8_encode($rowEmp['935_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(113  + 2, $contador_1), utf8_encode($rowEmp['936_Opciones'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(114  + 2, $contador_1), utf8_encode($rowEmp['936_Comentario'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(115  + 2, $contador_1), utf8_encode($rowEmp['937_Opciones'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(116  + 2, $contador_1), utf8_encode($rowEmp['937_Comentario'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(117  + 2, $contador_1), utf8_encode($rowEmp['938_Comentario'] ));


    $objPHPExcel->setActiveSheetIndex(1)->getStyle('B'.$contador_1.':C'.$contador_1)->applyFromArray($style_2);
    $objPHPExcel->setActiveSheetIndex(1)->getStyle('D'.$contador_1.':DP'.$contador_1)->applyFromArray($style_3);
}

$objPHPExcel->getActiveSheet()->setTitle('resumen');

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("REPORTE IBK")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");


// Redirect output to a clients web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Content-Disposition: attachment;filename="REPORTE_IBK_64.xlsx"');
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