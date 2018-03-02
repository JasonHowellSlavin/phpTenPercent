<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 3/2/18
 * Time: 1:06 PM
 */

require '../../code/pdo.php';

$connect = pdoConnect::connectToDB();

if ($_SERVER["REQUEST_METHOD"] === "GET" ) {

    if ($_GET['action'] === 'seeRecommendations') {
        $recommender = $_GET['current'];
        $reccommendedTo = $_GET['selected'];

        $query = "SELECT * FROM userRecommendations WHERE userId = ? AND recommendedTo = ?;";
        if ($stmt = $connect->prepare($query)) {
            $stmt->bindParam(1,$userID);
            $stmt->bindParam(2,$recommendedID);
            $userID = $recommender;
            $recommendedID = $reccommendedTo;
            $stmt->execute();

            $jsonReturn = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    echo json_encode($jsonReturn);
};