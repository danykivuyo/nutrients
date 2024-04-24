<html>

<body>
    <?php require_once 'helpers/navbar.php' ?>
    <?php

    echo '
<br /><br />
<div class="row">
    <form class="col s12" method="POST">
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="user_name"  id="user_name" /><br />
                <label for= "user_name">Username</label><br />
            </div>
            <div class="input-field col s6">   
                <input type="email" name="user_email"  id="user_email" /><br />
                <label for= "user_email">Email: </label><br />
            </div>
            <div class="input-field col s6">
                <input type="text" name="user_phone"  id="user_phone" /><br />
                <label for= "user_phone">Phone: </label><br />
            </div>
            <div class="input-field col s6">
                <input type="password" name="user_password"  id="user_password" /><br /><br />
                <label for= "user_password">Password</label><br />
            </div>
            <div class="input-field col s6"></div>
            <div align="center" class="input-field col s12">
                <button class="btn waves-effect waves-light green" type="submit" name="user_submit" id="user_submit">
                    Register <i class="material-icons right">send</i>
                </button>
            </div>
        </button>
    
  </button>
        </div>
    </form>
</div>    
';

    if (isset($_POST["user_submit"])) {
        $homeController = new Home;
        $homeController->userModel->user_set($_POST['user_name'], $_POST['user_email'], $_POST['user_phone'], $_POST['user_password']);
        $homeController->userModel->putUser();
    }
    ?>
    <?php require_once 'helpers/footer.php' ?>
</body>

</html>