<html>
    <body>
        <?php require_once 'helpers/navbar.php'?>

        <?php 
        echo '
        <br /><br /><br /><br /><br /><br />
        <div id="before" class="section scrollspy">
            <div class="container row z-depth-5 hoverable">
                <form class="form" method="POST">
                        <label for="user_name_or_email">Email</label>
                        <input type="text"  class="iput" id="user_name_or_email" name="user_name_or_email" placeholder="Email" />
                    
                        <center>
                        <input class="indigo btn" type="submit" id="user_login_submit" name="user_login_submit" value="Submit">
                        </center>
                </form>
            </div>
        </div>
        <div id="after" style = "display:none" class="section scrollspy">
            <div class="container row z-depth-5 hoverable">
                <form class="form" method="POST">
                        <label for="verification_code">Verification Code</label>
                        <input type="text"  class="iput" id="verification_code" name="verification_code" placeholder="Verification Code" />
                    
                        <center>
                        <input class="indigo btn" type="submit" id="submit" name="submit" value="Submit">
                        </center>
                </form>
            </div>
        </div>
        <div id="last" style = "display:none" class="section scrollspy">
            <div class="container row z-depth-5 hoverable">
                <form class="form" method="POST">
                        <input style="display:none" type="text" id ="id" name="id" value="" readonly />
                        <label for="last">New password</label>
                        <input type="password"  class="iput" id="new_password" name="new_password" />
                    
                        <label for="last">Comfirm password</label>
                        <input type="password"  class="iput" id="comfirm_password" name="comfirm_password" />

                        <center>
                        <input class="indigo btn" type="submit" id="comfirm" name="comfirm" value="Comfirm">
                        </center>
                </form>
            </div>
        </div>
        <br /><br /><br /><br /><br /><br />
        ';
        
        if(isset($_POST['user_login_submit'])){
            $homeController = new Home;
            $user_email = $_POST['user_name_or_email'];
            $homeController->userModel->user_reset_set($user_email);
            $homeController->userModel->userReset();
        }

        if(isset($_POST['submit'])){
            $homeController = new Home;
            $verification_code = $_POST['verification_code'];
            $homeController->userModel->user_verification_set($verification_code);
            $homeController->userModel->userVerify();
            unset($_POST['submit']);
        }

        if(isset($_POST['comfirm'])){
            $homeController = new Home;
            $new_password = $_POST['new_password'];
            $user_id = $_POST["id"];
            $homeController->userModel->passwordChange($user_id , $new_password);
            unset($_POST['submit']);
        }
        
        ?>

        <?php require_once 'helpers/footer.php'?>
    </body>
</html>