<?php
//header('Content-Type: application/json');
//$active = $_POST['active'];
//$visible = $_POST['visible'];
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
// Motrar todos los errores de PHP
include("includes/configure.php");
//$company_id = $_GET['company_id'];
$date_ini = $_GET['date_ini'];
$date_end = $_GET['date_end'];
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
$statement=$pdo->prepare("SELECT 
  `companies`.`fullname`,
  `medias`.`archivo`
FROM
  `companies`
  RIGHT OUTER JOIN `medias` ON (`companies`.`id` = `medias`.`company_id`)
WHERE
  `medias`.`created_at` BETWEEN :date_ini AND :date_end 
  "
);

$statement->bindValue(':date_ini', $date_ini);
$statement->bindValue(':date_end', $date_end);
$statement->execute();
$results=$statement->fetchAll(PDO::FETCH_ASSOC);

function filesize_formatted($file)
{
    $bytes = filesize($file);

    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        return $bytes . ' bytes';
    } elseif ($bytes == 1) {
        return '1 byte';
    } else {
        return '0 bytes';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="http://ttaudit.com/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://ttaudit.com/css/stylesheet.min.css">
</head>
<body>
<div class="container-full-width">

    <div class="cuerpo-content">
        <!--sección titulo y buscador-->
        <div class="row">
            <div class="col-sm-12">
                <table class="table-responsive table table-hover">
                    <thead>
                    <tr>
                        <td>
                            N.
                        </td>
                        <td>
                            Campaña
                        </td>
                        <td>
                            Archivo
                        </td>
                        <td>
                            Tamaño
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $contador = 0;
                    $bytes_contador = 0;
                    $bytes_format ="";
                    $string=null;
                    foreach ($results as $row) {
                        $file =   $_SERVER['DOCUMENT_ROOT'] . '/media/fotos/' . $row["archivo"];
//                         echo  $contador;
                        // echo $_SERVER['DOCUMENT_ROOT'];
                        if (file_exists($file)) {
                            $contador ++ ;
                            if($contador < 8000){
                                echo  '<tr>';
                                echo '<td>'.$contador. '</td>' ;
                                echo  '<td>'.$row['fullname'].'</td>' ;
                                echo '<td>'  . $row['archivo'] . '</td>';
                                echo  '<td>'  . filesize_formatted($file) . '</td>';
                                echo '</tr>';
                            }


                            $bytes_contador = $bytes_contador + filesize($file) ;

                        }
                    }


                        echo  '<tr>';
                        echo '<td>'.$contador. '</td>' ;
                        echo  '<td>...</td>' ;
                        echo '<td>...</td>';
                        echo  '<td>...</td>';
                        echo '</tr>';
                   



//                    if ($bytes_contador > 0 ) {
//                        $bytes_format  = number_format($bytes_contador / 1073741824, 2) . ' GB';
//                    }

//                    if ($bytes_contador >= 1073741824) {
                        $bytes_format = number_format($bytes_contador / 1073741824, 2)*2 . ' GB';
//                    }

                    ?>

                    </tbody>
                </table>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <h3>
                    Tamaño total: <?php echo $bytes_format ; ?>
                </h3>
            </div>
        </div>

        <!--Lista de usuario-->

        <!-- Paginador-->
    </div>
</div>

</body>
</html>
