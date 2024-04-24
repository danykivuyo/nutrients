<?php 
// require_once "helpers/navbar.php";
// // echo "<h1>HERRE<h1>";
// // var_dump(json_decode(json_encode($data["plant_data"]), true));
// $arrayData = json_decode(json_encode($data["plant_data"]), true);
// $plant_id = $data["plant_id"];
// // Open a file for writing
// $file = fopen($plant_id.'.csv', 'w');
// $primaryColls = array();
// $title = array(
//     '',
//     '',
//     "Plant $plant_id",
//     '',
//     ''    
// );

// array_push($primaryColls, $title);

// $Colls = array(
//     "Time",
//     "Carbon Dioxide",
//     "Methane",
//     "Temp",
//     "Humidity",
//     "Nitrogen Oxide"
// );

// array_push($primaryColls, $Colls);

// foreach ($arrayData as $row) {
//     $row2 = array(
//         $row["time_stamp"],
//         $row["carbon_monoxide"],
//         $row ["methane"],
//         $row["temperature"],
//         $row["humidity"],
//         $row["nitrogen_oxide"]
//     );
//     array_push($primaryColls, $row2);

// } 
// // var_dump($primaryColls);
// // Loop through the array and write each row to the CSV file
// $primaryColls = json_decode(json_encode($primaryColls), true);
// foreach ($primaryColls as $row) {
//     fputcsv($file, $row);
// }

// // Close the file
// fclose($file);

// // Set the appropriate headers for file download
// // header('Content-Type: application/csv');
// // header('Content-Disposition: attachment; filename="data.csv"');
// // header('Pragma: no-cache');

// // Read the file and data its contents
// // readfile('data.csv');

// echo '
// <script>
// window.location.replace("http://biogas.getenjoyment.net/public/'.$plant_id.'.csv");
// </script>

// ';
// // Delete the file from the server
// // unlink('data.csv');

// require_once "helpers/navbar.php";
$plant_id = $data["plant_id"];

// Open a file for writing
$file = fopen($plant_id . '.csv', 'w');

// Initialize the header row
$primaryColls = array(
    array('', '', "Plant $plant_id", '', ''),
    array("Time", "Carbon Dioxide", "Methane", "Temp", "Humidity", "Nitrogen Oxide")
);

// Write the header to the CSV file
foreach ($primaryColls as $row) {
    fputcsv($file, $row);
}

// Function to write data to the CSV file
function writeDataToCSV($file, $data) {
    foreach ($data as $row) {
        fputcsv($file, $row);
    }
}

// Database connection setup (replace with your own database configuration)
$host = DB_HOST;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$database = DB_NAME;

// Create a database connection
$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Query to retrieve plant data in chunks (modify this query as needed)
$plant_id = $data["plant_id"];

// Open a file for writing
$file = fopen($plant_id . '.csv', 'w');

// Initialize the header row
$primaryColls = array(
    array('', '', "Plant $plant_id", '', ''),
    array("Time", "Carbon Dioxide", "Methane", "Temp", "Humidity", "Nitrogen Oxide")
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
    die("Connection failed: " . $connection->connect_error);
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

        if ($result->num_rows > 0) {
            $chunkSize = 100; // Adjust the chunk size as needed

            // Read and write data in chunks
            while ($rows = $result->fetch_assoc()) {
                $dataToWrite = array();
                for ($i = 0; $i < $chunkSize && $row = $rows->fetch_assoc(); $i++) {
                    $dataToWrite[] = array(
                        $row["time_stamp"],
                        $row["carbon_monoxide"],
                        $row["methane"],
                        $row["temperature"],
                        $row["humidity"],
                        $row["nitrogen_oxide"]
                    );
                }
                writeDataToCSV($file, $dataToWrite);
            }
        }

        // Close the database connection
        $connection->close();

        // Close the CSV file
        fclose($file);

        echo '
        <script>
        window.location.replace("http://biogas.getenjoyment.net/public/' . $plant_id . '.csv");
        </script>
        ';
    }
}


?>