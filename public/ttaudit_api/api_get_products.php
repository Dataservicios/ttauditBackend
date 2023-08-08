<?php
/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 8/05/2017
 * Time: 01:00
 */
header('Content-Type: application/json');
//$active = $_POST['active'];
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
  `products`.`id`,
  `products`.`eam`,
  `products`.`fullname`,
  `products`.`company_id`,
  `products`.`category_product_id`,
  `products`.`precio`,
  `products`.`imagen`,
  `products`.`composicion`,
  `products`.`fabricante`,
  `products`.`presentacion`,
  `products`.`unidad`,
  `products`.`created_at`,
  `products`.`updated_at`,
  `product_detail`.`competencia`
FROM
  `product_detail`
  LEFT OUTER JOIN `products` ON (`product_detail`.`product_id` = `products`.`id`)
WHERE
  `product_detail`.`company_id` =:company_id
  ');

$statement->bindValue(':company_id', $company_id);

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
    "products"=>$results
];

$json=json_encode($data);
//$json=json_encode($results);

header('Content-Type: application/json');
echo $json;