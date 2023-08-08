<?php
/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 9/05/2017
 * Time: 01:42
 */
header('Content-Type: application/json');
$order_id = $_POST['order_id'];

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
$statement->bindValue(':order_id', $order_id);
$statement->execute();
$results=$statement->fetchAll(PDO::FETCH_ASSOC);


$data=[
    "success"=> sizeof($results),
    "order_detail"=>$results
];
$json=json_encode($data);
//$json=json_encode($results);


echo $json;