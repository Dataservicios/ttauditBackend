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
$customer_id= $_POST['customer_id'];

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
  `store_types`.`id`,
  `store_types`.`parent_type_id`,
  `store_types`.`fullname`,
  `store_types`.`customer_id`,
  `store_types`.`created_at`,
  `store_types`.`updated_at`
FROM
  `store_types`
WHERE
  `store_types`.`customer_id` =:customer_id 
');
$statement->bindValue(':customer_id', $customer_id);

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
    "store_types"=>$results
];

$json=json_encode($data);
//$json=json_encode($results);

header('Content-Type: application/json');
echo $json;