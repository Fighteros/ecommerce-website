<?php

    function lang($pharse) {
        static $lang = array(
            'message' => "Welcome",
            "admin" => "Administartor"
        );
        return $lang[$pharse];
    }

