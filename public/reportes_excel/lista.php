<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Lima');
include("includes/configure.php");

$query_detalle_puntos = "call sp_consulta_reporte_company_61";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<ul>
<?php

while ($rowEmp = mysql_fetch_assoc($resEmp)) {



    echo "<li>" .$rowEmp['store_id'] . " " .$rowEmp['fullname'] . "</li>" ;
//    for ($row = 0; $row < count($campos) ; $row++) {
//        $campo = $campos[$row][0];
//        $tipo_campo = $campos[$row][1];
//
//        if ($tipo_campo == "0") {
//            $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo]) );
//        } else if ($tipo_campo == "1") {
//            if ($rowEmp[$campo] == null || $rowEmp[$campo]   == "") {
//                $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '' );
//            } else {
//                $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Foto" )' );
//            }
//        }
//
//        $contador_columna++;
//    }
}

?>
</ul>
</body>
</html>
