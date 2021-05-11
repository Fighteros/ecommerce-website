<?php


    // start session
    session_start();
    $noNavBar = '';
    $pageTitle = 'Login';
    if(isset($_SESSION['Username'])){
        header('Location: dashboard.php');
    }
    include "init.php";

    // check if user Coming from POST Request
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $hashed_password = sha1($password);
        // check if user exists in DB
        // check if user is an admin
        $stmt = $conn -> prepare("SELECT Username, Password FROM users WHERE Username = ? AND Password = ? AND GroupID = 1");
        $stmt -> execute(array($username, $hashed_password));
        $count = $stmt -> rowCount();

        // if user found

        if ($count > 0){
            // register session name
            $_SESSION['Username'] = $username;
            // redirect to dashboard
            header('Location: dashboard.php');
            exit();
        }

    }
?>

    <form class="login" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <h4 class="text-center ">Admin | Login</h4>
        <input class="form-control" type="text" name="user" placeholder="username" autocomplete="off">
        <input class="form-control" type="password" name="pass" placeholder="Password" autocomplete="new-password">
        <input class="btn btn-primary btn-block" type="submit" value="Login">
    </form>

<?php

    include $admin_templates . "footer.php";


?>