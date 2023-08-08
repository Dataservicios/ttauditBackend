<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Lima');
include("includes/configure.php");


$dir = "../media/fotos/";
// Open a directory, and read its contents
$contador_file_db =0;
$contador_file = 0;
$total_rows = null;

$query = "select archivo from  medias"  ;

$resEmp = mysql_query($query, $conexion_db) or die(mysql_error());
$total_rows = mysql_num_rows($resEmp);
$rowEmp = mysql_fetch_assoc($resEmp) ;

$fotos_db = null;

while ($result = mysql_fetch_assoc($resEmp)) {
    $fotos_db[] =  $result['archivo'];
}

$success = false ;
$file_fotos = null;
$fileDeletes= null;
//if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'xml')

if (is_dir($dir)){
    if ($dh = opendir($dir)){
        while (($file = readdir($dh)) !== false){
            if ($file != "." && $file != ".." ) {
                $file_fotos[] = $file ;
            }

        } ;
        closedir($dh);
    }
}

//print_r($file_fotos) ;

if(isset($_POST['action']) && $_POST['action'] = 'delete' ){



    for ($i = 80000; $i <= 90000; $i++) {
        //echo $file_fotos[$i];
        $clave = array_search($file_fotos[$i], $fotos_db);
//                        if ($clave != null) {
//                            echo '<li>' . $file_fotos[$clave] . '</li>' ;
//                        }

        if ($clave == null) {
           // echo '<li>' . $file_fotos[$i] . '</li>' ;
            unlink($dir . $file_fotos[$i]);
            //$fileDeletes[] = $file_fotos[$i] ;
        }

    }


    $success = true;
    
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container" style="padding-top: 40px">

    <div class="starter-template">

        <h1>Eliminar archivos</h1>
        <?php

        if (glob($dir . "*.jpg") != false)   $filecount = count(glob($dir . "*.jpg"));
        else  $filecount = 0;

        ?>

        <?php
        if ($success==true) {
        ?>
            <div class="alert  alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Se eliminaron: <strong><?php echo $contador_file ?></strong>  correctamente.
            </div>

            <p>
                <a href="maintenance-of-images.php" class="btn-default btn">VOLVER</a>
            </p>

        <?php
        } else  {


        ?>

                    <p>Se encontraron en base de datos: <?php echo $total_rows ?> (<?php echo count($fotos_db) ?>) imágenes registradas</p>
                    <p>Se encontraron en en el directorio media: <?php echo count($file_fotos)?> (<?php echo count($file_fotos) ?>) imágenes registradas</p>
                    <p>Archivos que no se encuentran en la base de datos:</p>


                    <ol>

                    <?php

                    //for ($i = 0; $i <= count($file_fotos) -1; $i++) {
                    for ($i = 80000; $i <= 90000; $i++) {
                        //echo $file_fotos[$i];
                        $clave = array_search($file_fotos[$i], $fotos_db);
//                        if ($clave != null) {
//                            echo '<li>' . $file_fotos[$clave] . '</li>' ;
//                        }

                        if ($clave == null) {
                            echo '<li>' . $file_fotos[$i] . '</li>' ;
                        }
                       // if ($i)
                    }


                    ?>
                    </ol>

                    <form  method="post">

                        <input type="hidden" name="action" value="delete">
                        <button class="btn btn-default" type="submit" >ELIMINAR FOTOS</button>

                    </form>

        <?php } ?>
    </div>

</div><!-- /.container -->

<script>

    $("form" ).submit(function( event ) {
        //event.preventDefault();
        message = confirm("Esta seguro que de eliminar las fotos") ;

        if(message){
            return true;
        } else {
            return false;
        }
    });
</script>
</body>
</html>
