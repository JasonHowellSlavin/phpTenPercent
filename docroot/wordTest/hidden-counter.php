<body>
    <h1>Hidden Fields</h1>
    <form action="hidden-counter.php" method="GET">
        <input type="submit" name="Count" value="Count">
        <?php
        if (! isset($_GET['hiddencounter'])) {
            $count = 0;
        } else {
            $count = $_GET['hiddencounter'];
        }
        $count = $count + 1;
        echo '<input type="hidden" value="' . $count . '" name="hiddencounter">';
        echo "count is $count";
        ?>
    </form>
</body>