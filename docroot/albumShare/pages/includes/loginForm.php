<?php
?>
<form>
    <label for="email">Email</label>
    <input type="text" name="email">
    <label for="password">Password</label>
    <input type="text" name="password">
    <?php
    if (isset($_GET['new_account'])) {
        echo "<label for='rPassword'>Repeat Password</label><input type='text' name='rPassword'>";
    }

    ?>
</form>
