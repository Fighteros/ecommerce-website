<?php

    function lang($pharse) {
        static $lang = array(
            // dashboard
            'nav-brand' => 'Admin',
            'users-col' => 'Users',
            'logs-col' => 'Logs',
            'profile-col' => 'Edit Profile',
            'settings-col' => 'Settings',
            'logout-col' => 'Log Out',
        );
        return $lang[$pharse];
    }

