<?php
require_once "helpers/navbar.php";

function download()
{

}
?>

<body>
    <br />
    <br />
    <br />
    <?php
    $plant_data = json_decode(json_encode($data['plant_data']), true);
    // print_r($plant_data);
    // $plant_data = $data['plant_data'];
    // $plant_data = null;
    // var_dump(json_decode(json_encode($data['plant_data']) , true));
    
    ?>
    <script>
        function handleClick() {
            alert("you are about to download a CSV");
            Make an AJAX request to a PHP file
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '; ?>download.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Display the response from the PHP file
                    alert(xhr.responseText);
                    // var response = xhr.responseText;

                    // Display the PHP echo output in a HTML element
                    // document.getElementById('output').innerHTML = response;
                }
            };
            xhr.send();
        }
    </script>

    <body>
        <div class="row">
            <br />
            <div class="container s12 m12">
                <table class="stripped">
                    <thead>
                        <th>
                            Time
                        </th>
                        <th>
                            CO<sub>2</sub>
                        </th>
                        <th>
                            CH<sub>4</sub>
                        </th>
                        <th>
                            <sup>o</sup>C
                        </th>
                        <th>
                            %H
                        </th>
                        <th>
                            NO<sub>2</sub>
                        </th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($plant_data as $plant) {
                            echo "<tr>";
                            echo "<td>" . trim($plant["time_stamp"]) . "</td>";
                            echo "<td>" . trim($plant["carbon_monoxide"]) . "</td>";
                            echo "<td>" . trim($plant["methane"]) . "</td>";
                            echo "<td>" . trim($plant["temperature"]) . "</td>";
                            echo "<td>" . trim($plant["humidity"]) . "</td>";
                            // echo "<td>" . trim($plant["ammonia"]) . "</td>";
                            echo "<td>" . trim($plant["nitrogen_oxide"]) . "</td>";
                            // echo "<td><a style='text-decoration:none' href='" . URLROOT . "home/plant/" . $_SESSION['user_id'] . "/data/" . $plant['plant_id'] . "'><button class='btn waves-effect waves-light green'>ZAIDI</button></a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="center container s12 m12">
                    <!-- <a href='<?php echo URLROOT . "home/plant/" . $_SESSION["user_id"] . "/download/" . $plant_data[0]["plant_id"]; ?>' > -->
                    <a href="#">
                        <!-- <button onclick="handleClick()" disabled class="btn waves-effect waves-light green"> -->
                        <button onclick="handleClick()" class="btn waves-effect waves-light green"> Export CSV <i
                                class="material-icons right">cloud_download</i>
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