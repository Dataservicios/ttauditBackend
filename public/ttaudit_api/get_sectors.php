<?php
/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 8/05/2017
 * Time: 01:00
 */
header('Content-Type: application/json');
//$visible = $_POST['visible'];
$user_id    = $_POST['user_id'];
include("includes/configure.php");
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
//$statement=$pdo->prepare('SELECT
//  `roads_resume`.`road_id`,
//  `roads_resume`.`store_id` AS `id`,
//  `roads_resume`.`cadenaRuc`,
//  CASE
//	when `roads_resume`.`cadenaRuc` is null or `roads_resume`.`cadenaRuc` = \'\'  then `roads_resume`.`DNI` else `roads_resume`.`cadenaRuc` end documento,
//  CASE
//	when `roads_resume`.`cadenaRuc` is null or `roads_resume`.`cadenaRuc` = \'\' then \'DNI\' else \'RUC\' end  tipo_documento,
//  `roads_resume`.`fullname`,
//  `roads_resume`.`region`,
//  `roads_resume`.`tipo_bodega`,
//  `roads_resume`.`address`,
//  `roads_resume`.`district`,
//  `roads_resume`.`audit` AS `status`,
//  `roads_resume`.`codclient`,
//  `roads_resume`.`urbanization`,
//  `roads_resume`.`type`,
//  `roads_resume`.`ejecutivo`,
//  `roads_resume`.`latitude`,
//  `roads_resume`.`longitude`,
//  `roads_resume`.`telephone`,
//  `roads_resume`.`cell`,
//  `roads_resume`.`comment`,
//  `roads_resume`.`owner`,
//  `roads_resume`.`fnac`
//FROM roads_resume  where `roads_resume`.`company_id`=:company_id and `roads_resume`.`user_id`=:user_id and  `roads_resume`.`nivel` = 1');
//
//$statement->bindValue(':company_id', $company_id);
//$statement->bindValue(':user_id', $user_id);
//
//$statement->execute();
//$results=$statement->fetchAll(PDO::FETCH_ASSOC);

$results[] = [
    "id"=> "1",
    "event_id"=> "75",
    "user_id"=> "1",
    "fullname"=> "Sector 1",
];

$results[] = [
    "id"=> "2",
    "event_id"=> "75",
    "user_id"=> "1",
    "fullname"=> "Sector 2",
];

$results[] = [
    "id"=> "3",
    "event_id"=> "75",
    "user_id"=> "1",
    "fullname"=> "Sector 3",
];

$results[] = [
    "id"=> "4",
    "event_id"=> "75",
    "user_id"=> "1",
    "fullname"=> "Sector 4",
];



$data=[
    "success"=> "1",
    "sector"=> $results
];

$json=json_encode($data);
//$json=json_encode($results);

header('Content-Type: application/json');
echo $json;