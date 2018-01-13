<?php

$albumShareDB = 'mysql:dbname=albumShare;host=mysql';
$dbUser = 'developer';
$dbPassword = 'developer';

$connect = new PDO($albumShareDB, $dbUser, $dbPassword);

//foreach($connect->query('SELECT * FROM userRecommendations WHERE recommendedTo = 1') as $row) {
//                printf("<tr><td> %s </td><td> %s </td><td> %s </td></tr>",
//                htmlentities($row["artist"]),
//                htmlentities($row["album"]),
//                htmlentities($row["recommendationDate"]),
//)};

session_start();
$_SESSION['currentUser'] = 1;

echo $_SESSION['currentUser'];

?>
<link rel="stylesheet" type="text/css" href="../src/styles/homepage.css">

<article>
    <h1>AlbumShare</h1>
    <section class="recs-this-week">
     <h3>Albums reccomended to you this week!</h3>
        <table>
            <tbody>
            <tr>
                <td>Artist</td>
                <td>Album</td>
                <td>Date Reccomended</td>
            </tr>
            <?php
            foreach( $connect->query("SELECT * FROM userRecommendations WHERE recommendedTo = 1;") as $row) {
                printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>",
                    htmlentities($row["artist"]),
                    htmlentities($row["album"]),
                    htmlentities($row["recommendationDate"]));
            };
            ?>
            </tbody>
        </table>
    </section>
    <section class="add-friend">
        <h3>Add a friend</h3>
        <input type="text" name="friendSearch">
        <label for="friendSearch"> Search for and Add a Friend!</label>
    </section>
    <section class="share-album">
        <h3>Share an Album with Someone</h3>
        <form action="shareAlbum.php" method="POST">
            <p>Choose a friend</p>
            <select name="friend">
                <option value="default">------</option>
                <option value="deafult2">default</option>
                <?php
                foreach( $connect->query("SELECT * FROM users;") as $row) {
                    printf("<option value='%s'>%s %s</option>",
                        htmlentities($row["userId"]),
                        htmlentities($row["userNameFirst"]),
                        htmlentities($row["userNameLast"]));
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
