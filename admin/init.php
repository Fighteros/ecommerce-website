<?php

    // configuration file
    include "conf.php";

    // Routes to static files
    $admin_templates    = 'includes/templates/';
    $lang_dir           = 'includes/languages/';
    $func_dir          = 'includes/functions/';
    $css_dir            = 'layout/css/';
    $js_dir             = 'layout/js/';


    // include important files
    include $func_dir . "functions.php";
    include $lang_dir . 'English.php';
    include $admin_templates ."header.php";
    // stop including navbar on all pages that has noNavBar
    if (!isset($noNavBar)){
        include $admin_templates ."navbar.php";
    }

