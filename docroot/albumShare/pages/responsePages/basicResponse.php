<link rel="stylesheet" type="text/css" href="../../dist/css/form-pages.css">
<article>
    <section>
        <?php
        /**
         * This page is here to have the functionality of saying "Thank you" waiting three seconds, and then redirecting to the
         * home page.
         */
        $loot = $_SERVER['HTTP_HOST'];


        echo "<h2>Thank You! Your submission is processed!</h2>";


        $serverName = trim($_SERVER['SERVER_NAME']);

        if (strpos($serverName, 'localhost') !== false) {
            header("refresh:3;url=../home.php");
        } else {
            header("refresh:3;url=http://ec2-52-203-38-207.compute-1.amazonaws.com/phpTenPercent/docroot/albumShare/pages/home.php");
        }
        ?>
    </section>
</article>











