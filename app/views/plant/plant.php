<?php

$homeController = new Home;

$plants = $homeController->plantModel->getPlants();

require_once "helpers/navbar.php";

?>

<body class="purple darken-3">
    <div class="container">
        <div class="section scrollspy">
            <br><br><br>
            <div class="row">
                <div class="container s12 m12">
                    <div class="card-panel purple white z-depth-5">

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
                                <!-- <th>
                                    Date
                                </th> -->
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
                                    // echo "<td>" . trim($plant["plant_created_at"]) . "</td>";
                                    echo "<td><a style='text-decoration:none' href='" . URLROOT . "home/plant/" . $_SESSION['user_id'] . "/data/" . $plant['plant_id'] . "'><button class='btn waves-effect waves-light purple'>MORE</button></a></td>";
                                    // echo '<td><a style="text-decoration:none" href="#"><button class="btn waves-effect waves-light purple">MORE</button></a></td>';
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="center">
                            <br />
                            <a href="<?php echo URLROOT . 'home/plant/' . $_SESSION["user_id"] . '/plantregister'; ?>">
                                <button class="btn waves-effect waves-light purple">
                                    Register Node <i class="material-icons right">send</i>
                                </button>
                            </a>
                            <br>
                        </div>
                    </div>
                </div>
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
<?php
require_once "helpers/footer.php";
?>