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
$market_id = $_POST['market_id'];
$user_id = $_POST['user_id'];

include("includes/configure.php");
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

if ($user_id == 0) {
    $statement=$pdo->prepare(' 
               SELECT 
                  `s`.`id`,
                  `s`.`cadenaRuc`,
                  `s`.`distributor`,
                  `s`.`fullname`,
                  `s`.`ruc` as `documento`,
                  `s`.`region`,
                  `s`.`tipo_bodega`,
                  `s`.`address`,
                  `s`.`district`,
                  `s`.`codclient`,
                  `s`.`urbanization`,
                  `s`.`type`,
                  `s`.`ejecutivo`,
                  `s`.`latitude`,
                  `s`.`longitude`,
                  `s`.`telephone`,
                  `s`.`cell`,
                  `s`.`comment`,
                  `s`.`owner`,
                  `s`.`fnac`
                FROM
                  `market_details` `md`
                  LEFT OUTER JOIN `stores` `s` ON (`md`.`point_id` = `s`.`id`)
				WHERE
  					`md`.`company_id` = :company_id AND 
                    
                    `md`.`store_id` = :market_id    ORDER BY fullname');

    $statement->bindValue(':company_id', $company_id);
    $statement->bindValue(':market_id',  $market_id,PDO::PARAM_STR);
} else {
    $statement=$pdo->prepare(' 
               SELECT 
                  `s`.`id`,
                  `s`.`cadenaRuc`,
                  `s`.`distributor`,
                  `s`.`fullname`,
                  `s`.`ruc` as `documento`,
                  `s`.`region`,
                  `s`.`tipo_bodega`,
                  `s`.`address`,
                  `s`.`district`,
                  `s`.`codclient`,
                  `s`.`urbanization`,
                  `s`.`type`,
                  `s`.`ejecutivo`,
                  `s`.`latitude`,
                  `s`.`longitude`,
                  `s`.`telephone`,
                  `s`.`cell`,
                  `s`.`comment`,
                  `s`.`owner`,
                  `s`.`fnac`
                FROM
                  `market_details` `md`
                  LEFT OUTER JOIN `stores` `s` ON (`md`.`point_id` = `s`.`id`)
				WHERE
  					`md`.`company_id` = :company_id AND 
                    `md`.`user_id` = :user_id AND  
                    `md`.`store_id` = :market_id  ORDER BY fullname');

    $statement->bindValue(':company_id', $company_id);
    $statement->bindValue(':market_id',  $market_id,PDO::PARAM_STR);
    $statement->bindValue(':user_id',  $user_id,PDO::PARAM_STR);
}



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
    "stores"=>$results
];

$json=json_encode($data);
//$json=json_encode($results);

header('Content-Type: application/json');
echo $json;

