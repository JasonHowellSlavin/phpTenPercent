<body>
<form action="counter.php" method="GET">
    <input type="submit" name="Count" value="Count">
    <?php
        session_start();
        if (! isset($_SESSION['counter'])) {
            $_SESSION['counter'] = 0;
            echo "no count";
        } else {
            $count = $_SESSION['counter'];
            $count = $count +1;
            $_SESSION['counter'] = $count;
            echo "count is $count";
        }
    ?>
</form>
</body>
