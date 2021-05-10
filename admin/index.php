<?php

include "init.php";

include $admin_templates ."header.php";
include 'includes/Languages/English.php';

?>

<form class="login">
    <h4 class="text-center ">Admin Login</h4>
    <input class="form-control" type="text" name="user" placeholder="username" autocomplete="off">
    <input class="form-control" type="password" name="pass" placeholder="Password" autocomplete="new-password">
    <input class="btn btn-primary btn-block" type="submit" value="Login">
</form>

<?php

include $admin_templates . "footer.php";


?>