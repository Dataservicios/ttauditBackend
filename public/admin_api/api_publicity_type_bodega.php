<?php
/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 8/05/2017
 * Time: 01:00
 */
header('Content-Type: application/json');
//$visible = $_POST['visible'];
$company_id = $_POST['company_id'];
include("includes/configure.php");
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
$statement=$pdo->prepare('SELECT 
  `publicity_store`.`id`,
  `publicities`.`fullname`,
  `publicity_store`.`publicity_id`,
  `publicity_store`.`tipo_bodega`,
  `publicity_store`.`type`,
  `publicity_store`.`company_id`,
  `publicities`.`category_product_id`,
  `publicities`.`imagen`,
  `category_products`.`fullname` AS `category_name`
FROM
  `publicity_store`
  LEFT OUTER JOIN `publicities` ON (`publicity_store`.`publicity_id` = `publicities`.`id`)
  INNER JOIN `category_products` ON (`publicities`.`category_product_id` = `category_products`.`id`)
WHERE
  `publicity_store`.`active` = 0 AND
  `publicity_store`.`company_id` =:company_id');

$statement->bindValue(':company_id', $company_id, PDO::PARAM_INT);
$statement->execute();
$results=$statement->fetchAll(PDO::FETCH_ASSOC);

//$results = [
//    "id"=> "75",
//    "fullname"=> "Cliente Perfecto Estudio 5 2017",
//    "logo"=> "ali.jpg",
//    "markerPoint"=> "http://ttaudit.com/rutas-auditor/img/marker_app_alicorp.png",
//
//];

$data=[
    "success"=> sizeof($results),
    "publicities"=>$results
];

$json=json_encode($data);
//$json=json_encode($results);

header('Content-Type: application/json');
echo $json;