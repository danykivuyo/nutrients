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
    <!-- <script>
        // function handleClick() {
        //     alert("you are about to download a CSV");
        //     Make an AJAX request to a PHP file
        //     var xhr = new XMLHttpRequest();
        //     xhr.open('GET', '; ?>download.php', true);
        //     xhr.onreadystatechange = function () {
        //         if (xhr.readyState === 4 && xhr.status === 200) {
        //             // Display the response from the PHP file
        //             alert(xhr.responseText);
        //             // var response = xhr.responseText;

        //             // Display the PHP echo output in a HTML element
        //             // document.getElementById('output').innerHTML = response;
        //         }
        //     };
        //     xhr.send();
        // }
    </script> -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <body>
        <div class="row">
            <br />
            <!-- <div class="container s6 m12">
                <div class="container row z-depth-5 hoverable">
                    <form class="form">
                        <label for="ppmtime">Choose Graph</label>
                        <select id="ppmtime" name="ppmtime">
                            <option value="ppmtime" selected>ppm VS time</option>
                            <option value="ppmtemperature">ppm VS temp </option>
                        </select>
                    </form>
                </div>
            </div> -->
            <div class="container">
                <div class="row">
                    <div class="input-field col s12">
                        <select id="mySelect" onchange="handleSelectChange()">
                            <option value="ppmtime" selected>ppm VS time</option>
                            <option value="ppmtemperature">ppm VS temp </option>
                        </select>
                        <label for="mySelect">Choose Graph</label>
                    </div>
                </div>
            </div>
            <div class="container s6 m12">
                <div style="max-width: 40% !important, align:center" align="center">
                    <canvas id="lineChart" width="100" height="50" style="width:60%"></canvas>
                </div>
            </div>
            <div class="container s12 m12">
                <table class="stripped">
                    <thead>
                        <th>
                            Date
                        </th>
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
                            N<sub>2</sub>O
                        </th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($plant_data as $plant) {
                            $i++;
                            if ($i == 30) {
                                break;
                            }
                            // if (preg_match('/(\d{2}:\d{2}) (\d{2} [A-Za-z]+)/', $string, $matches)) echo "Time: {$matches[1]}<br>Date: {$matches[2]}<br>";
                            echo "<tr>";
                            if (preg_match('/(\d{2}:\d{2}) (\d{2} [A-Za-z]+)/', trim($plant["time_stamp"]), $matches)) {
                                if ($i == 1) {
                                    $m = trim($matches[2]);
                                    echo "<td style='max-width:10px'> {$m}</td>";
                                } else {
                                    echo "<td></td>";
                                }
                                echo " <td>{$matches[1]} </td> ";
                            }
                            // echo "" . trim($plant["time_stamp"]) . "</td>";
                            echo "<td>" . trim(number_format($plant["carbon_monoxide"], 2)) . "</td>";
                            echo "<td>" . trim(number_format($plant["methane"], 2)) . "</td>";
                            echo "<td>" . trim($plant["temperature"]) . "</td>";
                            echo "<td>" . trim($plant["humidity"]) . "</td>";
                            // echo "<td>" . trim($plant["ammonia"]) . "</td>";
                            echo "<td>" . trim(number_format($plant["nitrogen_oxide"], 4)) . "</td>";
                            // echo "<td><a style='text-decoration:none' href='" . URLROOT . "home/plant/" . $_SESSION['user_id'] . "/data/" . $plant['plant_id'] . "'><button class='btn waves-effect waves-light green'>ZAIDI</button></a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="center container s12 m12">
                    <a
                        href='<?php echo URLROOT . "home/plant/" . $_SESSION["user_id"] . '/' . 'download/' . $plant_data[0]["plant_id"]; ?>'>
                        <!-- <a href="#"> -->
                        <!-- <button onclick="handleClick()" disabled class="btn waves-effect waves-light green"> -->
                        <button class="btn waves-effect waves-light green"> Export CSV <i
                                class="material-icons right">cloud_download</i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                // Use jQuery to make an AJAX request
                $.ajax({
                    url: 'http://biogas.getenjoyment.net/charts/gastime/<?php echo $plant_data[0]["plant_id"]; ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Handle the JSON data and create the line chart
                        createLineChart(data);
                    },
                    error: function (error) {
                        // Handle errors
                        console.log('Error:', error);
                    }
                });

                // Function to create a line chart
                function createLineChart(data) {
                    // console.log(data);
                    // return;
                    data.sort((a, b) => b - a);
                    var ctx = document.getElementById('lineChart').getContext('2d');
                    // Assuming data is an array of numbers or objects with a numeric property
                    var labels = data.map(function (item) {
                        return item.time; // Replace with the property name in your data
                    });

                    var methaneValues = data.map(function (item) {
                        return item.methane; // Replace with the property name in your data
                    });

                    var temperatureValues = data.map(function (item) {
                        return item.temperature;
                    });

                    var noValues = data.map(function (item) {
                        return (item.nitrogen_oxide * 100);
                    });

                    var humidityValues = data.map(function (item) {
                        return item.humidity;
                    });

                    var co2Values = data.map(function (item) {
                        return item.carbon_monoxide;
                    });

                    var lineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Carbon dioxide',
                                data: co2Values,
                                borderColor: 'rgba(100, 102, 192, 1)',
                                borderWidth: 3,
                                fill: false,
                                pointRadius: 0,
                                backgroundColor: 'rgba(100, 102, 192, 1)'
                            },
                            {
                                label: 'Methane',
                                data: methaneValues,
                                borderColor: 'rgba(16, 161, 52, 1)',
                                borderWidth: 3,
                                fill: false,
                                pointRadius: 0,
                                backgroundColor: 'rgba(16, 161, 52, 1)'
                            },

                            {
                                label: "Temperature",
                                data: temperatureValues,
                                borderColor: 'rgba(224, 210, 22, 1)',
                                borderWidth: 3,
                                fill: true,
                                pointRadius: 0,
                                backgroundColor: 'rgba(224, 210, 22, .5)'
                            },
                            {
                                label: "Humidity",
                                data: humidityValues,
                                borderColor: 'rgba(200, 100, 202, 1)',
                                borderWidth: 0,
                                fill: true,
                                pointRadius: 0,
                                backgroundColor: 'rgba(200, 100, 202, .3)'
                            },
                            {
                                label: "Nitrous Oxide(x100)",
                                data: noValues,
                                borderColor: 'rgba(245, 15, 26, 1)',
                                borderWidth: 3,
                                fill: false,
                                pointRadius: 0,
                                backgroundColor: 'rgba(245, 15, 26, 1)'
                            }

                            ]
                        },
                        option: {
                            scales: {
                                x: {
                                    ticks: {
                                        display: false
                                    },
                                    gridLines: {
                                        display: false
                                    }
                                }
                            }
                        },
                    });
                }
            });

        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Initialize the select element
                var selectElement = document.getElementById('mySelect');
                var instance = M.FormSelect.init(selectElement);
            });

            function handleSelectChange() {

                // Get the selected value
                var selectedValue = document.getElementById('mySelect').value;
                if (selectedValue == "ppmtime") {
                    $.ajax({
                        url: 'http://biogas.getenjoyment.net/charts/gastime/<?php echo $plant_data[0]["plant_id"]; ?>',
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            // Handle the JSON data and create the line chart
                            createLineChart(data);
                        },
                        error: function (error) {
                            // Handle errors
                            console.log('Error:', error);
                        }
                    });
                }

                if (selectedValue == "ppmtemperature") {
                    $.ajax({
                        url: 'http://biogas.getenjoyment.net/charts/gastemp/<?php echo $plant_data[0]["plant_id"]; ?>',
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            // Handle the JSON data and create the line chart
                            console.log('success');
                            createLineChartTemp(data);
                        },
                        error: function (error) {
                            // Handle errors
                            console.log('Error:', error);
                        }
                    });
                }
                // Perform actions based on the selected value
                console.log("Selected value: " + selectedValue);
                // Add your custom logic here
            }
        </script>
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