<?php
require_once "helpers/navbar.php";
$plant_id = $data["plant_id"];

function d_format($timeFormat)
{
    $timestamp = strtotime($timeFormat);

    $m = date('m', $timestamp);
    if (date('m', $timestamp) < 4) {
        $timestamp = strtotime(date("2024-$m-d H:i:s", $timestamp));
    } else {
        $timestamp = strtotime(date("2023-$m-d H:i:s", $timestamp));
    }

    $newTimeFormat = date('H:i d F Y', $timestamp);

    return $newTimeFormat;
}

// Open a file for writing
$file = fopen($plant_id . '.csv', 'w');

// Initialize the header row
$primaryColls = array(
    array('', '', "Plant $plant_id", '', ''),
    array("Time", "Carbon Dioxide", "Methane", "Temp", "Humidity", "Nitrous Oxide")
);

// Write the header to the CSV file
foreach ($primaryColls as $row) {
    fputcsv($file, $row);
}

// Database connection setup (replace with your own database configuration)
$host = DB_HOST;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$database = DB_NAME;

// Create a database connection
$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die ("Connection failed: " . $connection->connect_error);
}

// Query to retrieve plant data in chunks (modify this query as needed)
$plant_farm_name = "";
$db = new Database;
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($stmt = $mysqli->prepare("SELECT `plant_farm_name` FROM plant WHERE `plant`.`plant_id` = ?")) {
    $stmt->bind_param("s", $plant_id);
    if ($stmt->execute()) {
        $stmt->store_result();
        $stmt->bind_result($plant_farm_name);
        $stmt->fetch();
        $plant_farm_name = rtrim($plant_farm_name);

        //fetching data
        $query = "SELECT * FROM `$plant_farm_name` WHERE `plant_id` = '$plant_id' ORDER BY `ind` DESC";
        $result = $connection->query($query);

        if ($result instanceof mysqli_result) { // Check if $result is a valid mysqli_result object
            $chunkSize = 100; // Adjust the chunk size as needed

            // Read and write data in chunks
            while ($row = $result->fetch_assoc()) {
                $dataToWrite = array();
                // print_r($row);
                // for ($i = 0; $i < $chunkSize && $row; $i++) {
                $time = d_format($row['time_stamp']);
                // echo '<br /><br /><br /><br /><br /><br />' . $time;
                // if ($time == "03:00 01 January 2024")
                //     continue;
                // // exit;
                // if (!is_nan($row['carbon_monoxide']))
                //     continue;
                // if (!is_nan($row['methane']))
                //     continue;
                // if (!is_nan($row['nitrogen_oxide']))
                //     continue;

                $dataToWrite[] = array(
                    // $row["time_stamp"],
                    $time,
                    number_format(floatval(str_replace(',', '', $row["carbon_monoxide"])), 2),
                    number_format(floatval(str_replace(',', '', $row["methane"])), 2),
                    $row["temperature"],
                    $row["humidity"],
                    number_format(floatval(str_replace(',', '', $row["nitrogen_oxide"])), 4)
                );
                // echo json_encode($dataToWrite);
                // echo "<br /><br /><br />";
                // }
                writeDataToCSV($file, $dataToWrite);
            }
        } else {
            echo "No data found or an error occurred.";
        }

        // exit;

        // Close the database connection
        $connection->close();

        // Close the CSV file
        fclose($file);

        echo "done";

        echo '
        <script>
        window.location.assign("' . URLROOT . $plant_id . '.csv");
        </script>
        ';
    }
}

// Function to write data to the CSV file
function writeDataToCSV($file, $data)
{
    foreach ($data as $row) {
        fputcsv($file, $row);
    }
}
?>