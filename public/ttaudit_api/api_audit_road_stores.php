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
$user_id = $_POST['user_id'];
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


//$statement=$pdo->prepare('SELECT
//  `audit_road_stores`.`id`,
//  `audit_road_stores`.`road_id`,
//  `audit_road_stores`.`audit_id`,
//  `audit_road_stores`.`store_id`,
//  `audit_road_stores`.`visit_id`,
//  `audit_road_stores`.`audit`
//FROM
//  `roads`
//  LEFT OUTER JOIN `audit_road_stores` ON (`roads`.`id` = `audit_road_stores`.`road_id`)
//  INNER JOIN `road_details` ON (`audit_road_stores`.`company_id` = `road_details`.`company_id`)
//  AND (`audit_road_stores`.`store_id` = `road_details`.`store_id`)
//  AND (`audit_road_stores`.`road_id` = `road_details`.`road_id`)
//WHERE
//  `audit_road_stores`.`company_id` =:company_id AND
//  `roads`.`user_id` = :user_id AND
//  `road_details`.`audit` = 0');

$statement=$pdo->prepare('SELECT 
  `audit_road_stores`.`id`,
  `audit_road_stores`.`road_id`,
  `audit_road_stores`.`audit_id`,
  `audit_road_stores`.`store_id`,
  `audit_road_stores`.`visit_id`,
  `audit_road_stores`.`audit`,
  `company_audits`.`orden`
FROM
  `roads`
  LEFT OUTER JOIN `audit_road_stores` ON (`roads`.`id` = `audit_road_stores`.`road_id`)
  INNER JOIN `road_details` ON (`audit_road_stores`.`company_id` = `road_details`.`company_id`)
  AND (`audit_road_stores`.`store_id` = `road_details`.`store_id`)
  AND (`audit_road_stores`.`road_id` = `road_details`.`road_id`)
  INNER JOIN `company_audits` ON (`audit_road_stores`.`audit_id` = `company_audits`.`audit_id`)
  AND (`audit_road_stores`.`company_id` = `company_audits`.`company_id`)
WHERE
  `audit_road_stores`.`company_id` = :company_id AND 
  `roads`.`user_id` = :user_id AND 
  `road_details`.`audit` = 0');

$statement->bindValue(':company_id', $company_id);
$statement->bindValue(':user_id', $user_id);

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
    "audits"=>$results
];

$json=json_encode($data);
//$json=json_encode($results);

header('Content-Type: application/json');
echo $json;