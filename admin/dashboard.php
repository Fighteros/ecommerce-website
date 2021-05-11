<?php
    session_start();
    if (isset($_SESSION['Username'])) {
        $pageTitle = "Dashboard";
        include 'init.php';
        print_r($_SESSION);
        include $admin_templates . 'footer.php';
    } else {
        header('Location: index.php');
        exit();
    }
