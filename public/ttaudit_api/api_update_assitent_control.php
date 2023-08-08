<?php
/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 9/05/2017
 * Time: 03:46
 */
header('Content-Type: application/json');
$id             = $_POST['id'];
$image_close    = $_POST['image_close'];
$lat_close      = $_POST['lat_close'];
$lon_close      = $_POST['lon_close'];
$date_close     = $_POST['date_close'];
$updated_at     = $_POST['updated_at'];

include("includes/configure.php");
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$statement=$pdo->prepare('UPDATE `ttaudit_auditors`.`assist_controls`
SET
`image_close` = :image_close,
`lat_close`   = :lat_close,
`lon_close`   = :lon_close,
`date_close`  = :date_close,
`updated_at`  = :updated_at
WHERE `id` = :id');

$statement->bindValue(':id'         ,$id         , PDO::PARAM_INT);
$statement->bindValue(':image_close',$image_close, PDO::PARAM_STR);
$statement->bindValue(':lat_close'  ,$lat_close  , PDO::PARAM_STR);
$statement->bindValue(':lon_close'  ,$lon_close  , PDO::PARAM_STR);
$statement->bindValue(':date_close' ,$date_close , PDO::PARAM_STR);
$statement->bindValue(':updated_at' ,$updated_at , PDO::PARAM_STR);

$statement->execute();
$results=$statement->rowCount();

//sizeof($results);
$data=[
    "success"=> $results,
];

$json=json_encode($data);
//$json=json_encode($results);

echo $json;