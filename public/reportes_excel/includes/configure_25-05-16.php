<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 10/10/2014
 * Time: 03:26 PM
 */
error_reporting(E_ALL ^ E_DEPRECATED);

//$conexion_db = mysql_connect("108.179.206.163", "ttaudit_admin", "franbrsj09");

$conexion_db = mysql_connect("localhost", "ttaudit_admin", "franbrsj09");
mysql_select_db("ttaudit_auditors", $conexion_db);
ini_set('max_execution_time', 300);
//Activa el para salida en el buffering

ob_start();
// Inicia Sesion en el browser
//session_name('mision-tec');// Nonbre de inicio de seion
//session_start(); //inicia la session