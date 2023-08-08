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
$keyword = $_POST['keyword'];
include("includes/configure.php");
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
//$statement=$pdo->prepare('SELECT
//  `audit_road_stores`.`id`,
//  `audit_road_stores`.`road_id`,
//  `audit_road_stores`.`audit_id`,
//  `audit_road_stores`.`store_id`,
//  `audit_road_stores`.`visit_id`,
//  `audit_road_stores`.`audit`
//FROM
//  `audit_road_stores`
//  INNER JOIN `roads` ON (`audit_road_stores`.`road_id` = `roads`.`id`)
//WHERE
//  `audit_road_stores`.`company_id` =:company_id AND
//  `roads`.`user_id` =:user_id');
$statement=$pdo->prepare('SELECT * FROM (
                SELECT 
                  `s`.`id`,
                  `s`.`cadenaRuc`,
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
                  `s`.`fnac`,
                  `s`.`store_type_id`
              
                FROM
                  `company_stores` `cs`
                  LEFT OUTER JOIN `stores` `s` ON (`cs`.`store_id` = `s`.`id`)
				WHERE
  					`cs`.`company_id` = :company_id ) `x`
                    
  WHERE
  	  `x`.`cadenaRuc`  like :keyword1   or 
  	  `x`.`codclient`  like :keyword3   or 
      `x`.`fullname`  like :keyword2  ');


$keyword = '%'.$keyword.'%';
$statement->bindValue(':company_id', $company_id);
$statement->bindValue(':keyword1',  $keyword,PDO::PARAM_STR);
$statement->bindValue(':keyword2',  $keyword,PDO::PARAM_STR);
$statement->bindValue(':keyword3',  $keyword,PDO::PARAM_STR);

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

