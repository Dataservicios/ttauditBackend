<?php
/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 9/05/2017
 * Time: 03:46
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

$statement=$pdo->prepare('UPDATE   `audit_road_stores` SET  `audit` = 0 WHERE  `company_id` = :company_id AND `store_id` = :store_id');
$statement->bindValue(':company_id',$company_id, PDO::PARAM_INT);
$statement->bindValue(':store_id',$store_id, PDO::PARAM_INT);
$statement->execute();
$results=$statement->rowCount();
$table[] = [
    "table" => "audit_road_stores" ,
    "action" => "UPDATE" ,
    "rows" => $results ,
];

$statement=$pdo->prepare('UPDATE   `road_details`  SET    `audit` = 0 WHERE   `company_id` = :company_id AND  `store_id` = :store_id ');
$statement->bindValue(':company_id',$company_id, PDO::PARAM_INT);
$statement->bindValue(':store_id',$store_id, PDO::PARAM_INT);
$statement->execute();
$results=$statement->rowCount();
$table[] = [
    "table" => "road_details" ,
    "action" => "UPDATE" ,
    "rows" => $results ,
];
$statement=$pdo->prepare('DELETE FROM  `poll_details`  WHERE  `company_id` = :company_id AND  `store_id` = :store_id ');
$statement->bindValue(':company_id',$company_id, PDO::PARAM_INT);
$statement->bindValue(':store_id',$store_id, PDO::PARAM_INT);
$statement->execute();
$results=$statement->rowCount();
$table[] = [
    "table" => "poll_details" ,
    "action" => "DELETE" ,
    "rows" => $results ,
];
//sizeof($results);
$data=[
    "success"=> 1,
    "tables"=>$table
];

$statement=$pdo->prepare('DELETE FROM   `poll_option_details`  WHERE  `company_id` = :company_id AND  `store_id` = :store_id ');
$statement->bindValue(':company_id',$company_id, PDO::PARAM_INT);
$statement->bindValue(':store_id',$store_id, PDO::PARAM_INT);
$statement->execute();
$results=$statement->rowCount();
$table[] = [
    "table" => "poll_option_details" ,
    "action" => "DELETE" ,
    "rows" => $results ,
];

$statement=$pdo->prepare('DELETE FROM   `medias`  WHERE  `company_id` = :company_id AND  `store_id` = :store_id ');
$statement->bindValue(':company_id',$company_id, PDO::PARAM_INT);
$statement->bindValue(':store_id',$store_id, PDO::PARAM_INT);
$statement->execute();
$results=$statement->rowCount();
$table[] = [
    "table" => "medias" ,
    "action" => "DELETE" ,
    "rows" => $results ,
];

$statement=$pdo->prepare('DELETE FROM   `publicity_details`  WHERE  `company_id` = :company_id AND  `store_id` = :store_id ');
$statement->bindValue(':company_id',$company_id, PDO::PARAM_INT);
$statement->bindValue(':store_id',$store_id, PDO::PARAM_INT);
$statement->execute();
$results=$statement->rowCount();
$table[] = [
    "table" => "publicity_details" ,
    "action" => "DELETE" ,
    "rows" => $results ,
];

$statement=$pdo->prepare('DELETE FROM   `scores`  WHERE  `company_id` = :company_id AND  `store_id` = :store_id ');
$statement->bindValue(':company_id',$company_id, PDO::PARAM_INT);
$statement->bindValue(':store_id',$store_id, PDO::PARAM_INT);
$statement->execute();
$results=$statement->rowCount();
$table[] = [
    "table" => "scores" ,
    "action" => "DELETE" ,
    "rows" => $results ,
];


$statement=$pdo->prepare('DELETE FROM   `alerts`  WHERE  `company_id` = :company_id AND  `store_id` = :store_id ');
$statement->bindValue(':company_id',$company_id, PDO::PARAM_INT);
$statement->bindValue(':store_id',$store_id, PDO::PARAM_INT);
$statement->execute();
$results=$statement->rowCount();
$table[] = [
    "table" => "alerts" ,
    "action" => "DELETE" ,
    "rows" => $results ,
];

//sizeof($results);
$data=[
    "success"=> 1,
    "tables"=>$table
];




$json=json_encode($data);
//$json=json_encode($results);


echo $json;