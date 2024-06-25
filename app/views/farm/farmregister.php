<html>

<body class="purple darken-3">
    <?php require_once 'helpers/navbar.php' ?>
    <br /><br />
    <div id="toast-container" class="toast-container green"></div>
    <div class="container">
        <div class="section scrollspy">
            <div class="row">
                <div class="card horizontal z-depth-5 hoverable">
                    <form class="col s12" method="POST">
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" name="farm_name" id="farm_name" required /><br />
                                <label for="farm_name">Farm name</label><br />
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="farm_region" id="farm_region" required /><br />
                                <label for="farm_region">Region: </label><br />
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="farm_ward" id="farm_ward" required /><br />
                                <label for="farm_ward">Ward: </label><br />
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="farm_place" id="farm_place" required /><br /><br />
                                <label for="farm_place">Place: </label><br />
                            </div>
                            <div class="input-field col s12 m12">
                                <div class="input-field col s12 center">
                                    <button class="btn waves-effect waves-light purple" type="submit" name="user_submit"
                                        id="user_submit">
                                        Register <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <?php
    if (isset($_POST["user_submit"])) {
        $homeController = new Home;
        $homeController->farmModel->farm_set($_POST['farm_name'], $_POST['farm_region'], $_POST['farm_ward'], $_POST['farm_place']);
        $homeController->farmModel->putFarm();
    }

    require_once 'helpers/footer.php';
    ?>
</body>

</html>