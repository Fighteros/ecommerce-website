<?php

    function lang($pharse) {
        static $lang = array(
            // navBar
            'nav-brand'     => 'Admin',
            'users-col'     => 'Users',
            'logs-col'      => 'Logs',
            'profile-col'   => 'Edit Profile',
            'settings-col'  => 'Settings',
            'logout-col'    => 'Log Out',
            'cat-col'       => 'Categories',
            'items-col'     => 'Items',
            'stats-col'     => 'Statistics',
        );
        return $lang[$pharse];
    }

