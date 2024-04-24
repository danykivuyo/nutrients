<html>
<script>
    window.onload = function() {
        var loggedIn = <?php echo json_encode(isset($_SESSION["login"]));?>;
        console.log(loggedIn);
    }
</script>
    <body>
    <?php include_once 'helpers/navbar.php'; ?>
<?php
        if(isset($_SESSION['login'])) if($_SESSION['login']) echo '<script>location.href = "'.URLROOT.'home/";</script>';
    
    echo '
    <br /><br /><br /><br /><br /><br />
    <div class="section scrollspy">
        <div class="container row z-depth-5 hoverable">
            <form class="form" method="POST">
                    <label for="user_name_or_email">Username or Email</label>
                    <input type="text"  class="iput" id="user_name_or_email" name="user_name_or_email" placeholder="Username or email" />
                
                    <label for="user_password">Password:</label>
                    <input type="password"  class="iput" id="user_password" name="user_password" placeholder="Password" /><br /><br />
                
                    <center>
                    <input class="indigo btn" type="submit" id="user_login_submit" name="user_login_submit" value="Login">
                    </center>
                    <center>
                    <p style="color:red" id = "wrong_password"></p>
                    </center>
                    <center>
                        <a href="'.RESET.'"><p id="reset_button"></p></a>
                    </center>
        </form>
    </div>
    <br /><br /><br /><br /><br /><br />
    ';

    if(isset($_POST['user_login_submit'])){
        $homeController = new Home;
        $user_name_or_email = $_POST['user_name_or_email'];
        $user_password = $_POST['user_password'];
        $homeController->userModel->user_login_set($user_name_or_email , $user_password);
        $homeController->userModel->userLogin();
    }
?>

<?php require_once 'helpers/footer.php'?>