<?php

    // connect to Db
    $DataSource = "mysql:host=localhost;dbname=shop";
    $user= "root";
    $pass= "";
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    );


    try {
        $conn = new PDO($DataSource, $user, $pass, $option);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        echo  'Failed to connect To DB, ERROR: ' . $e -> getMessage();
    }
