<html>

<body class="purple darken-3">
    <div id="toast-container" class="toast-container green"></div>
    <?php require_once 'helpers/navbar.php' ?>
    <br /><br /><br /><br /><br /><br />
    <div class="container">
        <div class="section scrollspy">
            <div class="row">
                <div class="col s12 m3">
                </div>
                <div class="col s12 m6">
                    <div class="card-panel purple white z-depth-5">
                        <form class="form" method="POST"> <label for="user_name">Username</label>
                            <input type="text" class="iput black-text" name="user_name" id="user_name" /><br />

                            <label for="user_email">Email: </label>
                            <input type="email" class="iput black-text" name="user_email" id="user_email" /><br />

                            <label for="user_phone">Phone: </label>
                            <input type="text" class="iput black-text" name="user_phone" id="user_phone" /><br />

                            <label for="user_password">Password</label>
                            <input type="password" class="iput black-text" name="user_password"
                                id="user_password" /><br /><br />
                            <div class="center">
                                <button class="btn waves-effect waves-light purple" type="submit" name="user_submit"
                                    id="user_submit">
                                    Register <i class="material-icons right">send</i>
                                </button>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
                <div class="col s12 m3">
                </div>
            </div>
        </div>
    </div>
    <br /><br /><br /><br />
    <?php

    if (isset($_POST["user_submit"])) {
        $homeController = new Home;
        $homeController->userModel->user_set(
            $_POST['user_name'],
            $_POST['user_email'],
            $_POST['user_phone'],
            $_POST['user_password']
        );
        $homeController->userModel->putUser();
    }
    ?>
    <?php require_once 'helpers/footer.php' ?>
</body>

</html>