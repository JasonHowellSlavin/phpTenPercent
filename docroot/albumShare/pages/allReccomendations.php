<?php
/**
 * Created by PhpStorm.
 * User: jslavin
 * Date: 1/11/18
 * Time: 2:24 PM
 */

require '../code/pdo.php';
$connect = pdoConnect::connectToDB();
session_start();

$name = (!empty($_SESSION["userName"])) ? $_SESSION["userName"] : "";
$id = (!empty($_SESSION["userId"])) ? $_SESSION["userId"] : "";
$email = (!empty($_SESSION["userEmail"])) ? $_SESSION["userEmail"] : "";
?>
<link rel="stylesheet" type="text/css" href="../dist/css/form-pages.css">
<article>
    <section>
        <table>
            <tbody>
            <tr>
                <td>Artist</td>
                <td>Album</td>
                <td>Date Reccomended</td>
                <td>Recommended By</td>
                <td>Theme</td>
            </tr>
            <?php
            $recommendationQuery = "SELECT userRecommendations.artist, userRecommendations.album,
                            userRecommendations.recommendationDate,
                            users.userName, userRecommendations.theme
                            FROM userRecommendations
                            JOIN users ON userRecommendations.userId = users.userId
                            AND userRecommendations.recommendedTo = ? ";
            $recommendationStmt = $connect->prepare($recommendationQuery);
            $recommendationStmt->bindParam(1, $currentUserId);
            $currentUserId = $id;

            $recommendationStmt->execute();
            foreach ($recommendationStmt->fetchAll() as $row) {
                printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                    htmlentities($row["artist"]),
                    htmlentities($row["album"]),
                    htmlentities($row["recommendationDate"]),
                    htmlentities($row["userName"]),
                    htmlentities($row["theme"]));
            }
            ?>
            </tbody>
        </table>
    </section>
</article>