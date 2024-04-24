<?php

$homeController = new Home;

$farms = $homeController->farmModel->getFarms();

require_once "helpers/navbar.php";

?>

<body>
    <div class="row">
        <br />
        <div class="container s12 m12">
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
        </div>
        <div class="row">
            <div class="center container s12 m12">
                <a href="<?php echo URLROOT . 'home/farm/' . $_SESSION["user_id"] . '/farmregister'; ?>">
                    <button class="btn waves-effect waves-light green">
                        Add New Farm <i class="material-icons right">send</i>
                    </button>
                </a>
            </div>
        </div>
    </div>

    <br />
    <br />
    <?php
    require_once "helpers/footer.php";
    ?>