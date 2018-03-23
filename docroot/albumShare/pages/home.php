<?php

require '../code/pdo.php';
$connect = pdoConnect::connectToDB();
session_start();


if (!isset($_SESSION["userName"]) || empty($_SESSION['userName'])) {
    header("Location: ../loginPages/initialLogin.php");
    exit;
}

$name = $_SESSION["userName"];
$id = $_SESSION["userId"];
$email = (!empty($_SESSION["userEmail"])) ? $_SESSION["userEmail"] : '';

?>
<link rel="stylesheet" type="text/css" href="../dist/css/homepage.css">
<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<!--<script type="text/javascript" src="../dist/scripts/hello_world.js"></script>-->
<script type="text/javascript" src="../dist/scripts/homepage.js"></script>

<article>
<!--    TODO: Break this section out into an actualy header-->
    <section class="header">
        <h1>albumShare</h1>
        <section class="user-panel">
            <h3 class="menu-item"><a href="userActions/logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></h3>
            <h3 class="menu-item"><a href="userActions/changePassword.php"><i class="fas fa-user-secret"></i><span>Change Password</span></a></h3>
            <h3 class="menu-item change-details"><a href="userActions/changeDetails.php"><i class="fas fa-address-card"></i><span>Change Details</span></a></h3>
        </section>
    </section>



    <section class="recs-this-week">
        <h2>Welcome <?php echo $name ?></h2>
         <h3>Albums reccomended to you this week!</h3>
        <table>
            <tbody>
            <tr>
                <td>Artist</td>
                <td>Album</td>
                <td>Date Recommended</td>
                <td>Recommended By</td>
                <td>Theme</td>
            </tr>
            <?php
            $withinAWeek = date('Y-m-d', strtotime("-8 days"));
            $recommendationQuery = "SELECT userRecommendations.artist, userRecommendations.album,
                            userRecommendations.recommendationDate,
                            users.userName, userRecommendations.theme
                            FROM userRecommendations
                            JOIN users ON userRecommendations.userId = users.userId
                            AND userRecommendations.recommendedTo = ? 
                            WHERE userRecommendations.recommendationDate > '$withinAWeek'";
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
        <h5><a href="allReccomendations.php">See all albums you've been recommended!</a></h5>
    </section>
<!--    <section class="add-friend">-->
<!--        <h3>Under Construction</h3>-->
<!--    </section>-->
    <section class="share-album">
        <h3>Share an Album with Someone</h3>
        <form action="shareAlbum.php" method="POST">
            <p>Choose a friend</p>
            <select name="friend">
                <option value="default">------</option>
                <?php
                foreach( $connect->query("SELECT * FROM users;") as $row) {
                    printf("<option value='%s'>%s</option>",
                        htmlentities($row["userId"]),
                        htmlentities($row["userName"]));
                };
                ?>
            </select>
            <p>How many reccomendations?</p>
            <select name="number-of-recs">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            <input type="submit" name="submit" value="Recommend Something!">
        </form>
        <div class="share-track" data-current-user="<?php echo $id ?>">
            <h3>See what you've recommended!</h3>
            <select name="share-track">
                <option value="default">------</option>
                <?php
                foreach( $connect->query("SELECT * FROM users;") as $row) {
                    printf("<option value='%s'>%s</option>",
                        htmlentities($row["userId"]),
                        htmlentities($row["userName"]));
                };
                ?>
            </select>
            <input type="submit" name="shares"  value="go">
            <div class="results"></div>
        </div>
    </section>
</article>
