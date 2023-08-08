<?php
/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 9/05/2017
 * Time: 01:42
 */
header('Content-Type: application/json');
$company_id = $_POST['company_id'];
$store_id= $_POST['store_id'];
$visit_id= $_POST['visit_id'];
include("includes/configure.php");
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
$statement=$pdo->prepare('SELECT 
  `stores`.`id`,
  `stores`.`cadenaRuc`,
  `stores`.`fullname`,
  `stores`.`address`,
  `stores`.`district`,
  `stores`.`region`,
  `stores`.`codClient`,
  `visit_stores`.`company_id`,
  `companies`.`fullname` AS `nomb_company`,
  `visit_stores`.`road_id`,
  `visit_stores`.`visit_id`,
  `roads`.`fullname` as road_name,
  `roads`.`user_id`,
  `users`.`fullname` as user_name
FROM
  `stores`
  RIGHT OUTER JOIN `visit_stores` ON (`stores`.`id` = `visit_stores`.`store_id`)
  LEFT OUTER JOIN `companies` ON (`visit_stores`.`company_id` = `companies`.`id`)
  LEFT OUTER JOIN `roads` ON (`visit_stores`.`road_id` = `roads`.`id`)
  LEFT OUTER JOIN `users` ON (`roads`.`user_id` = `users`.`id`)
WHERE
  `visit_stores`.`store_id` = :store_id AND 
  `visit_stores`.`company_id` = :company_id AND 
  `visit_stores`.`visit_id` = :visit_id');

$statement->bindValue(':company_id', $company_id);
$statement->bindValue(':store_id',  $store_id);
$statement->bindValue(':visit_id',  $visit_id);

$statement->execute();
$results=$statement->fetchAll(PDO::FETCH_ASSOC);
//sizeof($results);
$data=[
    "success"=> sizeof($results),
    "stores"=>$results
];
$json=json_encode($data);
//$json=json_encode($results);


echo $json;