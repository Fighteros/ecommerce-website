<?php
    /* title of the page */
    // $pageTitle
    function getPageTitle(){
        global $pageTitle;
        if(isset($pageTitle)){
            echo $pageTitle;
        }
        else {
            echo 'Default';
        }
    }