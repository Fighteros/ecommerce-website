<?php
    /*    Manage members page [add | edit | delete]    */

    session_start();
    $pageTitle = "Members";
    if(isset($_SESSION['Username'])){
        include "init.php";
        $do = isset($_GET['do'])? $_GET['do'] : 'Manage';
        if ($do == 'Manage'){
            echo 'Manage';
        }elseif($do == "Edit"){
            // assure that id is numeric
            $userId = (isset($_GET['userid']) && is_numeric($_GET['userid']))?$_GET['userid']: 0;
            $stmt = $conn -> prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");
            $stmt -> execute(array($userId));
            // fetch record
            $row = $stmt -> fetch();
            $count = $stmt -> rowCount();
            if($count > 0){
                ?>
                <div class="container">
                    <h1 class="text-center">Edit Member</h1>
                    <form action="?do=Update" method="post" class="form-horizontal">
                        <input type="hidden" name="userid" value="<?php echo $userId; ?>">
                        <!-- Username -->
                        <div class="form-group form-group-lg ">
                            <label  class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10 col-md-4"><input class="form-control" type="text" name="username" value="<?php echo $row['Username']; ?>" autocomplete="off"></div>
                        </div>
                        <!--  password -->
                        <div class="form-group form-group-lg">
                            <label  class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10 col-md-4">
                                <input class=" form-control" type="password" name="new-password" autocomplete="new-password">
                                <input type="hidden" name="old-password" value="<?php echo $row['Password']; ?>">
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="form-group form-group-lg">
                            <label  class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10 col-md-4"><input class=" form-control" type="email" value="<?php echo $row['Email']; ?>" name="email"></div>
                        </div>
                        <!-- Full name -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">FullName</label>
                            <div class="col-sm-10 col-md-4"><input class=" form-control" type="text" value="<?php echo $row['FullName']; ?>" name="FullName"></div>
                        </div>
                        <!-- Button -->
                        <div class="form-group form-group-lg">
                            <div class="col-md-offset-3 col-sm-10 col-md-4"><input class="btn btn-primary btn-lg" type="submit" value="Save"></div>
                        </div>
                    </form>
                </div>

                <?php
                // if there's no such id
            }else {
                echo "There's no such Person with that ID";
            }
        }
        elseif ($do == 'Update'){
            echo "<h1 class=\"text-center\">Update Member</h1>";
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // get vars form the form
                $id         = $_POST['userid'];
                $username   = $_POST['username'];
                $email      = $_POST['email'];
                $FullName   = $_POST['FullName'];

                // password
                $pass = empty($_POST['new-password'])? $_POST['old-password'] :$pass = sha1($_POST['new-password']);

                // Form validation


                // connect to DB
                $stmt = $conn -> prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ? WHERE UserID = ?");
                $stmt -> execute(array($username, $email, $FullName, $pass ,$id));
                // echo success
                echo $stmt -> rowCount(). "Record Updated";

            }else {
                echo "You are not Authorized to Access this";
            }

        }


        include $admin_templates . "footer.php";
    }
    else {
        header('Location: index.php');
        exit();
    }