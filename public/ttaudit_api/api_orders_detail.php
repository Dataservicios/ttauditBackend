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

foreach ($results as $index=>$value) {
    //echo $value['id'] . "-" . $index . "<br>";
    $statement=$pdo->prepare('
            SELECT 
              `order_details`.`id`,
              `order_details`.`order_id`,
              `order_details`.`product_id`,
              `order_details`.`quantity`,
              `order_details`.`price`,
              `order_details`.`amount`,
              `order_details`.`created_at`,
              `order_details`.`updated_at`,
              `products`.`fullname`
            FROM
              `products`
              INNER JOIN `order_details` ON (`products`.`id` = `order_details`.`product_id`)
            WHERE 
              `order_details`.`order_id` = :order_id
          ');
    $statement->bindValue(':order_id', $value['id']);
    $statement->execute();
    $results2=$statement->fetchAll(PDO::FETCH_ASSOC);
    // $order_detail = array("oreders"=>[["order_detail" =>"nada","order_detail-2" =>"nada-df"],["order_detail" =>"nada","order_detail-2" =>"nada-df"]]);
    $results[$index]['orders_detail']=$results2 ;
   // $results[$index]['id2'=>$results2]   ;
}

$statement=$pdo->prepare('
SELECT 
  `stores`.`id`,
  `stores`.`cadenaRuc`,
  `stores`.`ruc`,
  `stores`.`fullname`,
  `stores`.`type`,
  `stores`.`chanel`,
  `stores`.`address`,
  `stores`.`address1`,
  `stores`.`urbanization`,
  `stores`.`district`,
  `stores`.`region`
FROM
  `stores`
WHERE
  `stores`.`id` = :store_id
  ');

$statement->bindValue(':store_id',  $store_id);

$statement->execute();

$resultsStore =$statement->fetch(PDO::FETCH_ASSOC);

$data=[
    "success"=> sizeof($results),
    "store"=>$resultsStore,
    "orders"=>$results
];
$json=json_encode($data);
//$json=json_encode($results);


echo $json;