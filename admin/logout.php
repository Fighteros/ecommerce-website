<?php

    // Start the Session
    session_start();
    // unset the data
    session_unset();
    // fully destroy the session
    session_destroy();
    header('Location: index.php');

    exit();
