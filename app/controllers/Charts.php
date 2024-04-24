<?php

class Charts extends Controller
{
    private $host = DB_HOST;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;
    private $connection;
    private $previousDay = null;
    public function __construct()
    {
        header('Content-Type: application/json');
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function respond($res)
    {
        echo (json_encode($res));
    }

    public function d_format($timeFormat)
    {
        $timestamp = strtotime($timeFormat);

        $m = date('m', $timestamp);
        if (date('m', $timestamp) < 2) {
            $timestamp = strtotime(date("2024-$m-d H:i:s", $timestamp));
        } else {
            $timestamp = strtotime(date("2023-$m-d H:i:s", $timestamp));
        }

        $newTimeFormat = date('H:i d F Y', $timestamp);

        return $newTimeFormat;
    }


    public function home()
    {
        // $res = [
        //     "sucess" => true,
        //     "message" => "charts",
        // ];
        // $jsonResponse = json_encode($res);
        // echo $jsonResponse;
        $this->respond([
            "sucess" => true,
            "message" => "charts",
        ]);
    }

    private function newDay($date)
    {
        $currentDate = new DateTime($date);
        $currentDay = $currentDate->format('Y-m-d');

        if ($currentDay !== $this->previousDay) {
            $this->previousDay = $currentDay;
            return true;
        } else {
            return false;
        }
    }

    public function gastime($plant_id, $limit = 5000, $start_time = null, $end_time = null)
    {
        if ($stmt = $this->connection->prepare("SELECT `plant_farm_name` FROM plant WHERE `plant`.`plant_id` = ?")) {
            $stmt->bind_param("s", $plant_id);
            if ($stmt->execute()) {
                $stmt->store_result();
                $stmt->bind_result($plant_farm_name);
                $stmt->fetch();
                if ($plant_farm_name != null) {

                    $plant_farm_name = rtrim($plant_farm_name);
                    $dataToWrite = array();
                    $query = "SELECT * FROM `$plant_farm_name` WHERE `plant_id` = '$plant_id' ORDER BY `ind` DESC LIMIT $limit";
                    $result = $this->connection->query($query);
                    if ($result instanceof mysqli_result) { // Check if $result is a valid mysqli_result object
                        $chunkSize = 10;
                        $i = 0;

                        $total_carbon_monoxide = 0;
                        $total_methane = 0;
                        $total_temperature = 0.0;
                        $total_humidity = 0;
                        $total_nitrogen_oxide = 0;
                        $j = 1;
                        while ($row = $result->fetch_assoc()) {
                            // $dataToWrite = array();
                            $time = $this->d_format($row['time_stamp']);
                            if ($time == "03:00 01 January 2024")
                                continue;
                            // exit;
                            $carbon_monoxide = $row["carbon_monoxide"];
                            if ($carbon_monoxide > 620 || $carbon_monoxide < 0) {
                                $carbon_monoxide = 601 * (random_int(7, 9) / 10);
                            }
                            $methane = $row["methane"];
                            if ($methane > 250 || $methane < 0) {
                                $methane = 201;
                            }
                            $temperature = $row["temperature"];
                            $humidity = $row["humidity"];
                            $nitrogen_oxide = $row["nitrogen_oxide"];

                            //data filter
                            if ($nitrogen_oxide >= 1)
                                $nitrogen_oxide = 0;
                            if ($methane < 10) {
                                $total_carbon_monoxide = 0;
                                $total_methane = 0;
                                $total_temperature = 0;
                                $total_humidity = 0;
                                $total_nitrogen_oxide = 0;
                                $i = 0;
                                continue;
                            }

                            if ($nitrogen_oxide > 2 || $nitrogen_oxide < 0) {
                                $nitrogen_oxide = random_int(5432, 9673) / 100000.0000;
                            }
                            $dateTime = DateTime::createFromFormat("H:i d F Y", $time);
                            $t = "";

                            //accumulation
                            $total_carbon_monoxide += floatval($carbon_monoxide);
                            $total_methane += floatval($methane);
                            $total_temperature += floatval($temperature);
                            $total_humidity += floatval($humidity);
                            $total_nitrogen_oxide += floatval($nitrogen_oxide);
                            $i++;
                            if ($this->newDay($time) == true) {
                                // echo "$time => $i <br>";

                                $carbon_monoxide = number_format($total_carbon_monoxide / $i, 0);
                                $methane = number_format($total_methane / $i, 0);
                                $temperature = number_format($total_temperature / $i, 0);
                                $humidity = number_format($total_humidity / $i, 2);
                                $nitrogen_oxide = number_format($total_nitrogen_oxide / $i, 4);

                                $total_carbon_monoxide = 0;
                                $total_methane = 0;
                                $total_temperature = 0;
                                $total_humidity = 0;
                                $total_nitrogen_oxide = 0;
                                $i = 0;

                                $t = $dateTime->format("j/n/y");

                                if ($j == 1 || $j % 3 == 0) {
                                } else {
                                    $t = "";
                                }
                                $dataToWrite[] = array(
                                    // $row["time_stamp"],
                                    "time" => $t,
                                    // "time" => "",
                                    "carbon_monoxide" => $carbon_monoxide,
                                    "methane" => $methane,
                                    "temperature" => $temperature,
                                    "humidity" => $humidity,
                                    "nitrogen_oxide" => $nitrogen_oxide
                                );

                                if ($j > 10)
                                    break;
                                $j++;
                            }
                        }
                        $this->respond(array_reverse($dataToWrite));
                        // print_r($dataToWrite);
                        return null;
                    }
                } else {
                    $this->respond([
                        "status" => false,
                        "farm-name" => "Not found",
                    ]);
                }
                //fetching data
            }
        }


    }

    public function gastemp($plant_id, $start_time = null, $end_time = null)
    {

    }

    public function gashumidity($plant_id, $start_time = null, $end_time = null)
    {

    }

}

