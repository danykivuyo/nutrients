<html>

<body>
    <?php require_once 'helpers/navbar.php' ?>
    <?php

    $homeController1 = new Home;
    $options = $homeController1->farmModel->getFarmNames();

    echo '
<br /><br />
<div id="toast-container" class="toast-container green"></div>
<div class="row">
<div class="card horizontal z-depth-5 hoverable">
    <form class="col s12 " method="POST">
        <div class="row">
        <div class="input-field col s6">
            <select id="plant_farm_name" name="plant_farm_name">';

            // $options = array("Option 1", "Option 2", "Option 3");
                foreach ($options as $option) {
                    echo "<option value='" . $option . "'>" . $option . "</option>";
                }
            echo '
            </select>
            <label for="plant_farm_name">Farm Name</label>
            </div>
            <div class="input-field col s6">
                <input type="text" name="plant_name"  id="plant_name" /><br />
                <label for= "user_name">Node Name</label><br />
            </div>
            
            <div class="input-field col s6">
                <input type="text" name="plant_id" id="plant_id" /><br />
                <label for= "user_phone">Node Id</label><br />
            </div>
            <div class="input-field col s6">
                <input type="text" name="user_password"  id="user_password" /><br /><br />
                <label for= "user_password">Uelekeo</label><br />
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
</div>    
';

    if (isset($_POST["user_submit"])) {
        $homeController = new Home;
        $homeController->plantModel->plant_set($_POST['plant_name'], $_POST['plant_farm_name'], $_POST['plant_id']);
        $homeController->plantModel->putPlant();
    }
    ?>
    <?php require_once 'helpers/footer.php' ?>
    <script>
        $(document).ready(function () {
            $('select').formSelect();
        });

    </script>
</body>

</html>