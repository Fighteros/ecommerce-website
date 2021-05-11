<?php
    /*
     Categories => [Manage | Edit | Update | Add | Insert | Delete | Stats ]
     * /
     *
     */
    $do = isset($_GET['do'])? $_GET['do']:'Manage' ;
    //    if the page is the main
    if($do == 'Manage'){
        echo "welcome You are in Manage category page ";
        echo "<a href='page.php?do=Add'>Add New Category</a>";
    }elseif ($do == 'Add'){
        echo "welcome You are in add category page";
    }elseif ($do == 'Edit'){
        echo "welcome You are in Edit category page";
    }elseif ($do == 'Update'){
        echo "welcome You are in Update category page";
    }else {
        echo "Error there is no page with this name";
    }