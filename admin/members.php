<?php
    /*    Manage members page [add | edit | delete]    */
    /* link for vid = https://www.youtube.com/watch?v=s0SyCOrd5jE&list=PLDoPjvoNmBAxdiBh6J62wOzEnvC4CNuFU&index=31 */
    /* needs to be cont */
    session_start();
    $pageTitle = "Members";
    if(isset($_SESSION['Username'])){
        include "init.php";
        $do = isset($_GET['do'])? $_GET['do'] : 'Manage';
        if ($do == 'Manage'){
            $stmt = $conn -> prepare("SELECT * FROM users WHERE GroupID != 1");
            $stmt -> execute();
             // select all Users that aren't admins
            $rows = $stmt -> fetchAll();
            ?>
            <div class="container">
                <h4 class="text-center page-title"> Manage Members</h4>
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <!-- Table first row -->
                        <tr>
                            <td>#ID</td>
                            <td>Username</td>
                            <td>Email</td>
                            <td>FullName</td>
                            <td>Register date</td>
                            <td>Control</td>
                        </tr>
                        <!-- table  rows -->
                        <?php
                        foreach ($rows as $row){
                            echo "<tr>";
                                echo "<td>". $row['UserID'] . "</td>";
                                echo "<td>". $row['Username'] . "</td>";
                                echo "<td>". $row['Email'] . "</td>";
                                echo "<td>". $row['FullName'] . "</td>";
                                echo "<td>
                                    <a href='members.php?do=Edit&userid=" .$row['UserID'] ."' class='btn btn-success'>Edit</a>
                                    <a href=\"#\" class=\"btn btn-danger\">Delete</a>
                                        </td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
                <a href="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New Member</a>
            </div>
        <?php }
        // Add member Page
        elseif($do == 'Add'){
            ?>
            <div class="container">
                <h4 class="text-center page-title"> Add New Member</h4>
                <form action="members.php?do=Insert" method="post" class="form-edit text-center">
                    <!-- Username -->
                    <div class="form-group row form-group-lg ">
                        <label  class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10 col-md-8"><input class="form-control" type="text" name="username" placeholder="Username" autocomplete="off" required="required"> </div>
                    </div>
                    <!--  password -->
                    <div class="form-group row form-group-lg">
                        <label  class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10 col-md-8">
                            <input id="password-field" class="form-control" type="password"  name="password" autocomplete="new-password" placeholder="Enter complex password" required="required">
                            <span toggle="#password-field" class="show-pass fa fa-eye-slash"></span>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="form-group row form-group-lg">
                        <label  class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10 col-md-8"><input class="form-control" type="email" name="email" placeholder="Email" required="required"></div>
                    </div>
                    <!-- Full name -->
                    <div class="form-group row form-group-lg">
                        <label class="col-sm-2 col-form-label">FullName</label>
                        <div class="col-sm-10 col-md-8"><input class="form-control" type="text" placeholder="FullName" name="FullName" required="required"></div>
                    </div>
                    <!-- Button -->
                    <div class="form-group form-group-lg">
                        <div class="col-md-offset-3 col-sm-10 col-md-5"><input class="btn btn-primary" type="submit" value="Add Member"></div>
                    </div>
                </form>
            </div>

            <?php
        }
        elseif ($do == 'Insert'){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                echo "<h1 class=\"text-center\">Insert Member</h1>";
                echo  "<div class='container'>" ;
                // get vars form the form
                $user       = $_POST['username'];
                $pass       = $_POST['password'];
                $hPass      = sha1($pass);
                $email      = $_POST['email'];
                $FullName   = $_POST['FullName'];
                $formErrors = array();
                if(strlen($user) < 4){
                    $formErrors[] = "Username can't be less than 4 chars";
                }
                if(strlen($user) > 20){
                    $formErrors[] = "Username can't be more than 20 chars";
                }

                if(empty($user)){
                    $formErrors[] = "Username can't be empty";
                }
                if (empty($FullName)){
                    $formErrors[] = "FullName can't be empty";
                }
                if (empty($email)){
                    $formErrors[] = "email can't be empty";
                }
                if(empty($pass)){
                    $formErrors[] = "Password can't be empty";
                }
                foreach ($formErrors as $error){
                    echo '<div class="alert alert-danger">'.$error .'</div>';
                }
                // if valid
                if(empty($formErrors)) {
                    // connect to DB
                    $stmt = $conn->prepare("INSERT INTO users(Username, Password, Email, FullName) VALUES (:zuser, :zpass, :zemail, :zname)");
                    $stmt->execute(array(
                        'zuser' => $user,
                        'zpass' => $hPass,
                        'zemail' => $email,
                        'zname' => $FullName,
                    ));
                    // echo success
                    echo '<div class="alert alert-success">'.$stmt -> rowCount(). " Record Updated </div>";
                }

            }else {
                echo "<div class='alert alert-danger'> You are not Authorized to Access this </div>";
            }

            echo "</div>";
        }
        // edit Member Page
        elseif($do == "Edit"){
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
                    <h4 class="text-center page-title">Edit Member</h4>
                    <form action="members.php?do=Update" method="post" class="form-edit text-center">
                        <input type="hidden" name="userid" value="<?php echo $userId; ?>">
                        <!-- Username -->
                        <div class="form-group row form-group-lg ">
                            <label  class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10 col-md-8"><input class="form-control" type="text" name="username" value="<?php echo $row['Username']; ?>" autocomplete="off" required="required"> </div>
                        </div>
                        <!--  password -->
                        <div class="form-group row form-group-lg">
                            <label  class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10 col-md-8">
                                <input id="password-field" class="form-control" type="password" name="new-password" autocomplete="new-password" placeholder="leave blank to use your old password">
                                <input type="hidden" name="old-password" value="<?php echo $row['Password']; ?>">
                                <span toggle="#password-field" class="show-pass fa fa-eye-slash"></span>
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="form-group row form-group-lg">
                            <label  class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10 col-md-8"><input class=" form-control" type="email" value="<?php echo $row['Email']; ?>" name="email" required="required"></div>
                        </div>
                        <!-- Full name -->
                        <div class="form-group row form-group-lg">
                            <label class="col-sm-2 col-form-label">FullName</label>
                            <div class="col-sm-10 col-md-8"><input class=" form-control" type="text" value="<?php echo $row['FullName']; ?>" name="FullName" required="required"></div>
                        </div>
                        <!-- Button -->
                        <div class="form-group form-group-lg">
                            <div class="col-md-offset-3 col-sm-10 col-md-5"><input class="btn btn-primary" type="submit" value="Save"></div>
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
            echo  "<div class='container'>" ;
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // get vars form the form
                $id         = $_POST['userid'];
                $username   = $_POST['username'];
                $email      = $_POST['email'];
                $FullName   = $_POST['FullName'];

                // password
                $pass = empty($_POST['new-password'])? $_POST['old-password'] :$pass = sha1($_POST['new-password']);

                // Form validation
                $formErrors = array();
                if(strlen($username) < 4){
                    $formErrors[] = "Username can't be less than 4 chars";
                }
                if(strlen($username) > 20){
                    $formErrors[] = "Username can't be more than 20 chars";
                }
                if(empty($username)){
                    $formErrors[] = "Username can't be empty";
                }
                if (empty($FullName)){
                    $formErrors[] = "FullName can't be empty";
                }
                if (empty($email)){
                    $formErrors[] = "email can't be empty";
                }
                foreach ($formErrors as $error){
                    echo '<div class="alert alert-danger">'.$error .'</div>';
                }
                // if valid
                if(empty($formErrors)) {
                    // connect to DB
                    $stmt = $conn->prepare("UPDATE users SET Username = ?, Email = ?, FullName = ?, Password = ? WHERE UserID = ?");
                    $stmt->execute(array($username, $email, $FullName, $pass, $id));
                    // echo success
                    echo '<div class="alert alert-success">'.$stmt -> rowCount(). " Record Updated </div>";
                }

            }else {
                echo "<div class='alert alert-danger'> You are not Authorized to Access this </div>";
            }

            echo "</div>";
        }
        include $admin_templates . "footer.php";
    }
    else {
        header('Location: index.php');
        exit();
    }