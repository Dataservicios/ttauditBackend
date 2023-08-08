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
    "id"=> "75",
    "user_id"=> "1",
    "fullname"=> "Mana - Vicentico y Cafe Tacuba",
    "imagen"=> "http://defrente.pe/iamges-pronto/fondo-defrente2.png",
    "detail_url" => "http://pareto.pe/detailEvent/taurean-davis",
    "place"=> "Estadio Nacional",
    "address"=> "Calle josé díaz s/n Cercado de lima 14666",
    "latitude"=> "0",
    "longitude"=> "0",
    "vendidos"=> "120",
    "ingresaron"=> "20",
    "validadas"=> "2500",
    "rechazadas"=> "100",
    "created_at"=> "2018-06-30 15:49:39",
    "date_ejecution"=> "2018-07-06",
];

$results[] = [
    "id"=> "76",
    "user_id"=> "1",
    "fullname"=> "Mana - Vicentico y Cafe Tacuba",
    "imagen"=> "http://defrente.pe/iamges-pronto/fondo-defrente2.png",
    "detail_url" => "http://pareto.pe/detailEvent/taurean-davis",
    "place"=> "Estadio Nacional",
    "address"=> "Calle josé díaz s/n Cercado de lima 14666",
    "latitude"=> "0",
    "longitude"=> "0",
    "vendidos"=> "150",
    "ingresaron"=> "10",
    "validadas"=> "1500",
    "rechazadas"=> "10",
    "created_at"=> "2018-06-30 15:49:39",
    "date_ejecution"=> "2018-07-06",
];

$results[] = [
    "id"=> "77",
    "user_id"=> "1",
    "fullname"=> "Mana - Vicentico y Cafe Tacuba",
    "imagen"=> "http://pareto.pe/media/photos/concierto9.jpg",
    "detail_url" => "http://pareto.pe/detailEvent/taurean-davis",
    "place"=> "Estadio Nacional",
    "address"=> "Calle josé díaz s/n Cercado de lima 14666",
    "latitude"=> "0",
    "longitude"=> "0",
    "vendidos"=> "150",
    "validadas"=> "1800",
    "rechazadas"=> "10",
    "ingresaron"=> "10",
    "created_at"=> "2018-06-28 15:49:39",
    "date_ejecution"=> "2018-07-28",
];

$results[] = [
    "id"=> "78",
    "user_id"=> "1",
    "fullname"=> "Mana - Vicentico y Cafe Tacuba",
    "imagen"=> "http://pareto.pe/media/photos/concierto9.jpg",
    "detail_url" => "http://pareto.pe/detailEvent/taurean-davis",
    "place"=> "Estadio Nacional",
    "address"=> "Calle josé díaz s/n Cercado de lima 14666",
    "latitude"=> "0",
    "longitude"=> "0",
    "vendidos"=> "150",
    "ingresaron"=> "10",
    "validadas"=> "1500",
    "rechazadas"=> "10",
    "created_at"=> "2018-06-26 15:49:39",
    "date_ejecution"=> "2018-07-28",
];

$results[] = [
    "id"=> "79",
    "user_id"=> "1",
    "fullname"=> "Mana - Vicentico y Cafe Tacuba",
    "imagen"=> "http://pareto.pe/media/photos/concierto9.jpg",
    "detail_url" => "http://pareto.pe/detailEvent/taurean-davis",
    "place"=> "Estadio Nacional",
    "address"=> "Calle josé díaz s/n Cercado de lima 14666",
    "latitude"=> "0",
    "longitude"=> "0",
    "vendidos"=> "150",
    "ingresaron"=> "10",
    "validadas"=> "1100",
    "rechazadas"=> "30",
    "created_at"=> "2018-06-26 15:49:39",
    "date_ejecution"=> "2018-07-28",
];

$results[] = [
    "id"=> "80",
    "user_id"=> "1",
    "fullname"=> "Mana - Vicentico y Cafe Tacuba",
    "imagen"=> "http://pareto.pe/media/photos/concierto9.jpg",
    "detail_url" => "http://pareto.pe/detailEvent/taurean-davis",
    "place"=> "Estadio Nacional",
    "address"=> "Calle josé díaz s/n Cercado de lima 14666",
    "latitude"=> "0",
    "longitude"=> "0",
    "vendidos"=> "150",
    "validadas"=> "500",
    "rechazadas"=> "20",
    "ingresaron"=> "10",
    "created_at"=> "2018-06-26 15:49:39",
    "date_ejecution"=> "2018-07-29",
];

$data=[
    "success"=> "1",
    "events"=> $results
];

$json=json_encode($data);
//$json=json_encode($results);

header('Content-Type: application/json');
echo $json;