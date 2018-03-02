<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 2/23/18
 * Time: 9:59 AM
 */
$name = (!empty($_SESSION["userName"])) ? $_SESSION["userName"] : "";
$id = (!empty($_SESSION["userId"])) ? $_SESSION["userId"] : "";
$email = (!empty($_SESSION["userEmail"])) ? $_SESSION["userEmail"] : "";

require '../../code/pdo.php';

$connect = pdoConnect::connectToDB();

if ($_SERVER["REQUEST_METHOD"] === "GET" ) {

  if ($_GET['action'] === 'getList') {
      $query = "SELECT * FROM userRecommendations;";
      if ($stmt = $connect->prepare($query)) {
          $stmt->bindParam(1,$userID);
          $userID = $id;
          $stmt->execute();

          $jsonReturn = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
  }

  $return = [
      'json' => $jsonReturn,
      'id' => $id,
      'name' => $name,
    ];

  echo json_encode($return);
};