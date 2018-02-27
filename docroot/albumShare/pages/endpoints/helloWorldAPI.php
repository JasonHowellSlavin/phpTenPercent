<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 2/23/18
 * Time: 9:59 AM
 */
require '../../code/pdo.php';

$connect = pdoConnect::connectToDB();

if ($_SERVER["REQUEST_METHOD"] == "GET" ) {
  $ourArray = [
      'hello' => 'Hello',
      'world' => 'World',
      'total' => 'Hello World',
  ];

  if ($_GET['action'] == 'getList') {
      $query = "SELECT * FROM userRecommendations;";
      if ($stmt = $connect->prepare($query)) {
          $stmt->execute();

          $jsonReturn = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
  } else {
      $jsonReturn = $ourArray;
  }

  $return = $_POST;

//  $return['array'] = $ourArray;

  $return["db"] = $jsonReturn;
  echo json_encode($return);

};