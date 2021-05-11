<?php
    /*    Manage members page [add | edit | delete]    */

    session_start();
    $pageTitle = "Members";
    if(isset($_SESSION['Username'])){
        include "init.php";
        $do = isset($_GET['do'])? $_GET['do'] : 'Manage';
        if ($do == 'Manage'){
            echo 'Manage';
        }elseif($do == "Edit"){?>
            <div class="container">
                <h1 class="text-center">Edit Member</h1>
                <form action="" class="form-horizontal">
                    <!-- Username -->
                    <div class="form-group form-group-lg ">
                        <label for="" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10 col-md-4"><input class=" form-control" type="text" name="username" autocomplete="off"></div>
                    </div>
                    <!--  password -->
                    <div class="form-group form-group-lg">
                        <label for="" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10 col-md-4"><input class=" form-control" type="password" name="password" autocomplete="new-password"></div>
                    </div>
                    <!-- Email -->
                    <div class="form-group form-group-lg">
                        <label for="" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10 col-md-4"><input class=" form-control" type="email" name="email"></div>
                    </div>
                    <!-- Full name -->
                    <div class="form-group form-group-lg">
                        <label for="" class="col-sm-2 control-label">Full name</label>
                        <div class="col-sm-10 col-md-4"><input class=" form-control" type="text" name="fullName"></div>
                    </div>
                    <!-- Button -->
                    <div class="form-group form-group-lg">
                        <div class="col-md-offset-3 col-sm-10 col-md-4"><input class="btn btn-primary btn-lg" type="submit" value="Save"></div>
                    </div>
                </form>
            </div>

        <?php }

        include $admin_templates . "footer.php";
    }
    else {
        header('Location: index.php');
        exit();
    }