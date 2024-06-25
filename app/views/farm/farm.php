<?php

$homeController = new Home;

$farms = $homeController->farmModel->getFarms();

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
                                    Farm Name
                                </th>
                                <th>
                                    Region
                                </th>
                                <th>
                                    Ward
                                </th>
                                <th>
                                    Place
                                </th>
                                <th>
                                    Created
                                </th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($farms as $farm) {
                                    echo "<tr>";
                                    echo "<td>" . trim($farm["farm_name"]) . "</td>";
                                    echo "<td>" . trim($farm["farm_region"]) . "</td>";
                                    echo "<td>" . trim($farm["farm_ward"]) . "</td>";
                                    echo "<td>" . trim($farm["farm_place"]) . "</td>";
                                    echo "<td>" . trim($farm["farm_created_at"]) . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>

                        <div class="center">
                            <br>
                            <a href="<?php echo URLROOT . 'home/farm/' . $_SESSION["user_id"] . '/farmregister'; ?>">
                                <button class="btn waves-effect waves-light purple">
                                    Add New Farm <i class="material-icons right">send</i>
                                </button>
                            </a>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br>
    <?php
    require_once "helpers/footer.php";
    ?>
</body>

</html>