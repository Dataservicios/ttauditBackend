<?php
/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 8/05/2017
 * Time: 01:00
 */
include("includes/configure.php");

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

//$stmt = $pdo->query('SELECT fullname FROM users');
//while ($row = $stmt->fetch())
//{
//    echo $row['fullname'] . "\n";
//}

$statement=$pdo->prepare('SELECT 
  `s`.`id`,
  `s`.`cadenaRuc`,
  `s`.`ruc`,
  `s`.`fullname`,
  `s`.`type`,
  `s`.`tipo_bodega`,
  `s`.`chanel`,
  `s`.`client`,
  `s`.`DNI`,
  `s`.`fnac`,
  `s`.`address`,
  `s`.`urbanization`,
  `s`.`district`,
  `s`.`region`,
  `s`.`ubigeo`,
  `s`.`codclient`,
  `s`.`latitude` as `latitud`,
  `s`.`longitude` as  `longitud`,
  `s`.`ruteado`,
  `s`.`rubro`
FROM
  `stores` `s`
  INNER JOIN `company_stores` `c` ON (`s`.`id` = `c`.`store_id`)
WHERE
  `c`.`company_id` = 85 AND 
  `c`.`ruteado` = 0');
$statement->execute();
$results=$statement->fetchAll(PDO::FETCH_ASSOC);
//sizeof($results);
$data=[
    "success"=> sizeof($results),
    "companies"=>$results
];
//$json=json_encode($data);
$json=json_encode($results);
//$json=json_encode($results);

header('Content-Type: application/json');
echo $json;