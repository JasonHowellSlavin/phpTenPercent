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
<link rel="stylesheet" type="text/css" href="../src/styles/homepage.css">

<article>
    <section>
        <h1>AlbumShare</h1>
        <section class="user-panel">
            <h3><a href="userActions/logout.php">Logout</a></h3>
            <h3><a href="userActions/changePassword.php">Change Password</a></h3>
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
                <td>Date Reccomended</td>
            </tr>
            <?php
            $withinAWeek = date('Y-m-d', strtotime("-8 days"));
            foreach( $connect->query("SELECT * FROM userRecommendations WHERE recommendedTo = $id AND recommendationDate > '$withinAWeek';") as $row) {
                printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>",
                    htmlentities($row["artist"]),
                    htmlentities($row["album"]),
                    htmlentities($row["recommendationDate"]));
            };
            ?>
            </tbody>
        </table>
        <h5><a href="allReccomendations.php">See all albums you've been recommended!</a></h5>
    </section>
    <section class="add-friend">
        <h3>Under Construction</h3>
    </section>
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

    </section>
</article>
