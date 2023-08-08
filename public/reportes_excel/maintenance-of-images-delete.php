<?php
error_reporting(E_ALL);
//error_reporting(E_ERROR);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
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

if(isset($_POST['action']) && $_POST['action'] = 'delete' ){

    foreach ($file_fotos as $item){

        $find = search($item,$fotos_db);
        if ($find) {
            $contador_file_db ++ ;
        } else{
            if (file_exists($dir . $item)) {
//                unlink($dir . $item);
                $contador_file ++ ;
            }

        }

    }
    $success = true;
    
}



function search($element , $array_asoc ) {
    $i=0 ;
    foreach ($array_asoc as $item){
        if($element == $item){
                $i = $i + 1;
                break;
            }
    }
    if($i >0)   return true ;
    return false ;
} ;
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="http://getbootstrap.com/examples/dashboard/dashboard.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Help</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>


<div class="container-fluid">
    <div class="row">
        <?php include('includes/menu_left.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">


                <h1>Eliminar archivos</h1>
                <?php

                if (glob($dir . "*.jpg") != false)   $filecount = count(glob($dir . "*.jpg"));
                else  $filecount = 0;

                ?>

                <?php
                if ($success) {
                ?>
                    <div class="alert  alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Se eliminaron: <strong><?php echo $contador_file ?></strong>  correctamente.
                    </div>

                    <p>
                        <a href="maintenance-of-imagesXXXX.php" class="btn-default btn">VOLVER</a>
                    </p>

                <?php
                } else  {


                ?>

                            <p>Se encontraron en base de datos: <?php echo $total_rows ?> imágenes registradas</p>
                            <p>Se encontraron en en el directorio media: <?php echo count($file_fotos)?> imágenes registradas</p>
                            <p>Archivos que no se encuentran en la base de datos:</p>

                            <ol>

                            <?php

                            foreach ($file_fotos as $item){

                                    //echo "<li>" .$item . "</li>";

                                    $find = search($item,$fotos_db);
                                        if ($find) {
                                            $contador_file_db ++ ;
                                        } else{
                                             echo '<li>' . $item . '</li>' ;

                                        }

                            }


                            ?>
                            </ol>

                            <form  method="post">

                                <input type="hidden" name="action" value="delete">
                                <button class="btn btn-default" type="submit" >ELIMINAR FOTOS</button>

                            </form>

                <?php } ?>
        </div>

     </div>

</div>
<!-- /.container -->

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
