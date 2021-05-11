<?php

    // configuration file
    include "conf.php";

    // Routes to static files
    $admin_templates =  'includes/templates/';
    $css_dir = 'layout/css/';
    $js_dir  = 'layout/js/';
    $lang_dir = 'includes/languages/';


    // include important files
    include $lang_dir . 'English.php';
    include $admin_templates ."header.php";
    // include navbar on all pages that has noNavBar
    if (!isset($noNavBar)){
        include $admin_templates ."navbar.php";
    }

