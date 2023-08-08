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
include("includes/configure.php");
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
$statement=$pdo->prepare('
SELECT 
  `orders`.`id`,
  `orders`.`code`,
  `orders`.`store_id`,
  `orders`.`provider_id`,
  `orders`.`company_id`,
  `orders`.`visit_id`,
  `orders`.`type_payment`,
  `orders`.`created_at`,
  `orders`.`updated_at`,
  `users`.`fullname`
FROM
  `users`
  INNER JOIN `orders` ON (`users`.`id` = `orders`.`provider_id`)
WHERE

  `orders`.`company_id` = :company_id  AND 
  `orders`.`store_id` = :store_id 
  ');

$statement->bindValue(':company_id', $company_id);
$statement->bindValue(':store_id',  $store_id);

$statement->execute();

$results =$statement->fetchAll(PDO::FETCH_ASSOC);
//sizeof($results);

$data=[
    "success"=> sizeof($results),
    "orders"=>$results
];
$json=json_encode($data);
//$json=json_encode($results);


echo $json;