<?php
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="email">Email</label>
    <input type="text" name="email">
    <?php
        if (isset($_GET['new_account'])) {
            echo "<label for='userName'>User Name</label><input type='text' name='userName'>";
        }
    ?>
    <label for="password">Password</label>
    <input type="password" name="password">
    <?php
    if (isset($_GET['new_account'])) {
        echo "<label for='rPassword'>Repeat Password</label><input type='password' name='rPassword'>";
        echo "<input type='submit' value='Create account'>";
    } else {
        echo "<input type='submit' value='Sign in'>";
    }
    ?>
</form>
