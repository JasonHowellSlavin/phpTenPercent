<?php
if (isset($_COOKIE['counter'])) {
    $count = $_COOKIE['counter'];
} else {
    $count = 0;
}
$count = $count + 1;
setcookie('counter', $count, 0, '/', 'localhost', false);
?>
<h1>Hidden Fields</h1>
<form action="cookie.php" method="GET">
    <input type="submit" name="Count" value="Count">
    <?php
    echo "count is $count";
    ?>
</form>
