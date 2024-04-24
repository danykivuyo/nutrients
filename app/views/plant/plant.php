<?php

$homeController = new Home;

$plants = $homeController->plantModel->getPlants();

require_once "helpers/navbar.php";

?>

<body>
    <div class="row">
        <br />
        <div class="container s12 m12">
            <table class="stripped">
                <thead>
                    <th>
                        Node Name
                    </th>
                    <th>
                        Farm Name
                    </th>
                    <th>
                        Node Id
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        More
                    </th>
                </thead>
                <tbody>
                    <?php
                    foreach ($plants as $plant) {
                        echo "<tr>";
                        echo "<td>" . trim($plant["plant_name"]) . "</td>";
                        echo "<td>" . trim($plant["plant_farm_name"]) . "</td>";
                        echo "<td>" . trim($plant["plant_id"]) . "</td>";
                        echo "<td>" . trim($plant["plant_created_at"]) . "</td>";
                        echo "<td><a style='text-decoration:none' href='" . URLROOT . "home/plant/" . $_SESSION['user_id'] . "/data/" . $plant['plant_id'] . "'><button class='btn waves-effect waves-light green'>ZAIDI</button></a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="center container s12 m12">
                <a href="<?php echo URLROOT . 'home/plant/' . $_SESSION["user_id"] . '/plantregister'; ?>">
                    <button class="btn waves-effect waves-light green">
                        Register Node <i class="material-icons right">send</i>
                    </button>
                </a>
            </div>
        </div>
    </div>
</body>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<?php
require_once "helpers/footer.php";
?>