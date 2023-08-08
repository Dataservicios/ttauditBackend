<?php
/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 9/05/2017
 * Time: 03:46
 */
header('Content-Type: application/json');
$user_id      = $_POST['user_id'];
$company_id   = $_POST['company_id'];
$imei         = $_POST['imei'];
$image_open   = $_POST['image_open'];
$image_close  = $_POST['image_close'];
$lat_open     = $_POST['lat_open'];
$lon_open     = $_POST['lon_open'];
$lat_close    = $_POST['lat_close'];
$lon_close    = $_POST['lon_close'];
$date_open    = $_POST['date_open'];
$date_close   = $_POST['date_close'];
$created_at   = $_POST['created_at'];
$updated_at   = $_POST['updated_at'];


include("includes/configure.php");
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$statement=$pdo->prepare('INSERT INTO `ttaudit_auditors`.`assist_controls`
    (`user_id`,
    `company_id`,
    `imei`,
    `image_open`,
    `image_close`,
    `lat_open`,
    `lon_open`,
    `lat_close`,
    `lon_close`,
    `date_open`,
    `date_close`,
    `created_at`,
    `updated_at`)
    VALUES
    (
    :user_id,
    :company_id,
    :imei,
    :image_open,
    :image_close,
    :lat_open,
    :lon_open,
    :lat_close,
    :lon_close,
    :date_open,
    :date_close,
    :created_at,
    :updated_at
    )');
$statement->bindValue(':user_id'    ,$user_id       , PDO::PARAM_INT);
$statement->bindValue(':company_id' ,$company_id    , PDO::PARAM_INT);
$statement->bindValue(':imei'       ,$imei          , PDO::PARAM_STR);
$statement->bindValue(':image_open' ,$image_open    , PDO::PARAM_STR);
$statement->bindValue(':image_close',$image_close   , PDO::PARAM_STR);
$statement->bindValue(':lat_open'   ,$lat_open      , PDO::PARAM_STR);
$statement->bindValue(':lon_open'   ,$lon_open      , PDO::PARAM_STR);
$statement->bindValue(':lat_close'  ,$lat_close     , PDO::PARAM_STR);
$statement->bindValue(':lon_close'  ,$lon_close     , PDO::PARAM_STR);
$statement->bindValue(':date_open'  ,$date_open     , PDO::PARAM_STR);
$statement->bindValue(':date_close' ,$date_close    , PDO::PARAM_STR);
$statement->bindValue(':created_at' ,$created_at    , PDO::PARAM_STR);
$statement->bindValue(':updated_at' ,$updated_at    , PDO::PARAM_STR);


$statement->execute();
$newId = $pdo->lastInsertId();
$results=$statement->rowCount();


//sizeof($results);
$data=[
    "id"=>$newId,
    "success"=> 1,
];




$json=json_encode($data);
//$json=json_encode($results);


echo $json;