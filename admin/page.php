<?php
    /*
     Categories => [Manage | Edit | Update | Add | Insert | Delete | Stats ]
     * /
     *
     */
    $do = '';
    if(isset($_GET['do'])){
        $do = $_GET['do'];
    } else {
        $do = 'Manage';
    }
    //    if the page is the main
    if($do == 'Manage'){
        echo "welcome You are in Manage category page ";
        echo "<a href='page.php?do='>Add New Category</a>";
    }elseif ($do == 'Add'){
        echo "welcome You are in add category page";
    }elseif ($do == 'Edit'){
        echo "welcome You are in Edit category page";
    }elseif ($do == 'Update'){
        echo "welcome You are in Update category page";
    }else {
        echo "Error there\'s no page with this name";
    }