<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 10/10/2014
 * Time: 03:26 PM
 */
error_reporting(E_ALL);

$conexion_db = mysql_connect("108.179.206.163", "ttaudit_admin", "franbrsj09");
//$conexion_db = mysql_connect("localhost", "retotec_admin", "franbrsj09");
mysql_select_db("ttaudit_auditors", $conexion_db);
//mysql_select_db("ttaudit_bd", $conexion_db);
//Activa el para salida en el buffering
ob_start();
// Inicia Sesion en el browser
//session_name('mision-tec');// Nonbre de inicio de seion
//session_start(); //inicia la session
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE); ?>
<!doctype html>
<html lang="sp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>Document</title>
    <link rel="apple-touch-icon" sizes="57x57" href="favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="favicons/favicon-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="favicons/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="favicons/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="favicons/favicon-32x32.png" sizes="32x32">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="favicons/mstile-144x144.png">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/stylesheet.min.css"/>

</head>
<body>
<div class="container-full-width">
<header>
    <div class="logo-header">
        <img src="img/logo.png" alt=""/>
    </div>
    <div class="zona-menu">
        <nav class="menu">
            <ul>
                <li><a href="#" class="active"><span class="icon-user activate"></span><span class="menu-text">USUARIO</span></a></li>
                <li><a href="#"><span class="icon-client"></span><span  class="menu-text">EMPRESA</span></a></li>
                <li><a href="#"><span class="icon-puntoventa"></span><span  class="menu-text">PUNTOS DE VENTA</span></a></li>
                <li><a href="#"><span class="icon-auditoria"></span><span  class="menu-text">AUDITORIAS</span></a></li>
                <li><a href="#"><span class="icon-reporte"></span><span class="menu-text">REPORTES</span></a></li>
            </ul>
        </nav>
        <div class="zona-login">
            <div class="zona-user">
                <a href=""><span class="icon-user"></span>Jaime</a>
                <li role="presentation" class="dropdown">
                    <a id="drop4" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">

                        <span class="caret"></span>
                    </a>
                    <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Something else here</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Separated link</a></li>
                    </ul>
                </li>
            </div>
            <div class="salir"><a href=""><span class="icon-salir"></span>Salir</a></div>
        </div>

    </div>
</header>
<section>
<div class="zona-menu-left">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluidxxxxxx">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand" href="#">Brand</a>-->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="users.html"> <span class="icon-listausuario"></span> Usario <span class="sr-only">(current)</span></a></li>
                    <li><a href="users-nuevo.html"> <span class="icon-nuevousuario"></span>  Nuevo Usuario</a></li>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
</div>
<div class="cuerpo">
    <div class="cuerpo-content">
        <!--sección titulo y buscador-->
        <div class="row">
            <div class="col-sm-12">

                <h4>Lista de Usuarios</h4>


            </div>

        </div>

        <div class="row pt pb">
            <div class="col-sm-12">
                <h4 class="report-title">Audios</h4>


                <div class="row pt pb">
                    <div class="col-sm-12">

                        <?php
                        $conatador=0;
                        $directorio = opendir("/home/ttaudit/public_html/media/audio/"); //ruta actual

                        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
                        {

                            if (!is_dir($archivo)){
                                $conatador ++;
                                //echo $archivo . "<br />";
                                $trozos = explode(".", $archivo);
                                $queEmp = "SELECT id, fullname ,address, district, region , ubigeo, codclient FROM ttaudit_auditors.stores s where codclient = '". $trozos[0] ."'; ";
                                $resEmp = mysql_query($queEmp, $conexion_db) or die(mysql_error());
                                $totEmp = mysql_num_rows($resEmp);
                                $rowEmp = mysql_fetch_assoc($resEmp);


                        ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><span class="badge"><?php echo $conatador; ?></span> <?php echo $rowEmp['fullname']; ?></h3>
                                    </div>
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-sm-8">
                                                <b> CODIGO:  </b><?php echo $rowEmp['codclient']; ?> <br/>
                                                <b> DIRECCION:  </b><?php echo $rowEmp['address']; ?> <br/>
                                                <b> UBIGEO:  </b><?php echo $rowEmp['ubigeo']; ?> <br/>
                                            </div>
                                            <div class="col-sm-4">
                                                <audio src="../../media/audio/<?php echo $archivo ; ?>" controls preload="none"  >
                                                    "HTML5 audio not supported";
                                                </audio>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                         <?php
                                //echo "<audio src=\"../../media/audio/$archivo \" controls preload=\"none\"  >";
                                //echo "HTML5 audio not supported";
                                //echo "</audio>";
                            }
                        }
                        ?>



                    </div>

                </div>
            </div>

        </div>



    </div>

</div>
</section>
<footer>

</footer>
</div>
<script type="text/javascript" src="lib/jquery.min.js"></script>
<script type="text/javascript" src="js/scrollspy.js"></script>
<script type="text/javascript" src="js/dropdown.js"></script>
<script type="text/javascript" src="js/collapse.js"></script>
<script type="text/javascript" src="js/tooltip.js"></script>
<script type="text/javascript" src="js/alert.js"></script>
<script type="text/javascript" src="lib/bootstrap.min.js"></script>


<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();

        $('.dropdown-toggle').dropdown()
    });




</script>
</body>
</html>