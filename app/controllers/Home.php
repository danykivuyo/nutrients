<?php

class Home extends Controller
{
    public $userModel;
    public $plantModel;
    public $farmModel;

    public $currentHumidity;

    public $currentTemperature;

    public function __construct()
    {
        $this->userModel = $this->model("User");
        $this->plantModel = $this->model("Plant");
        $this->farmModel = $this->model("Farm");

        date_default_timezone_set(timezoneId);
    }

    public function home()
    {
        if (!isset($_SESSION['user_id'])) {
            $data = [
                "title" => "bio-gas"
            ];
        } else {
            $user_details = $this->userModel->onLoginSuccessfull($_SESSION['user_id']);
            $data = [
                "title" => "bio-gas",
                "user_details" => $user_details
            ];
        }
        $this->view("home/home", $data);
    }

    public function login()
    {
        $this->view("home/login");
    }

    public function register()
    {
        $this->view("home/register");
    }

    public function logout()
    {
        $this->userModel->logout();
    }

    public function user($user_id = null, $user_action = "")
    {
        if (!isset($_SESSION['login']))
            $_SESSION['login'] = false;
        if (!$_SESSION['login']) {
            $this->home();
            return;
        }
        $this->home();

    }

    public function farm($user_id = null, $user_action = "index")
    {
        if (!isset($_SESSION['login']))
            $_SESSION['login'] = false;
        if (!$_SESSION['login']) {
            $this->home();
            return;
        }

        if ($user_id == null) {
            $this->home();
            return;
        }

        if (file_exists("../app/views/farm/" . $user_action . ".php")) {
            $user_details = $this->userModel->onLoginSuccessfull($_SESSION['user_id']);
            $data = [
                "title" => "bio-gas",
                "user_details" => $user_details,
                "plant_details" => ["plant", "plant2"]
            ];
            $this->view("farm/" . $user_action, $data);
        }

    }

    public function plant($user_id = null, $user_action = "index", $plant_id = null)
    {
        if (!isset($_SESSION['login']))
            $_SESSION['login'] = false;
        if (!$_SESSION['login']) {
            $this->home();
            return;
        }
        if ($user_id == null) {
            $this->home();
            return;
        }


        if (file_exists("../app/views/plant/" . $user_action . ".php")) {
            // $data = $this->plantModel->getPlants();

            //     $minute = 29;
            //     while ($minute > 0) {
            //     if ($password == "yolo") {
            //         $time_stamp = date('H:i d F');
            //     }
            //     $randomValue = mt_rand(280, 299) / 1.00001;
            //     $methane = strval(number_format($randomValue, 2));
            //     $randomValue = (mt_rand(432, 480)) / 1.00001;
            //     $carbon_monoxide = number_format($randomValue, 2);
            //     $carbon_dioxide = $carbon_monoxide;
            //     $raw_data = [
            //         "plant_id" => $plant_id,
            //         "carbon_dioxide" => $carbon_dioxide,
            //         "methane" => $methane,
            //         "temperature" => $temperature,
            //         "humidity" => $humidity,
            //         "ammonia" => $ammonia,
            //         "nitrogen_oxide" => $nitrogen_oxide,
            //         "carbon_monoxide" => $carbon_monoxide,
            //         "time_stamp" => $time_stamp
            //     ];

            //     $farm_name = $this->plantModel->getFarmName($raw_data["plant_id"]);
            //     $farm_data = $this->farmModel->getFarm($farm_name);
            //     $data["raw_data"] = $raw_data;
            //     $data["farm_data"] = $farm_data;
            //     $this->view("plantnode/index", $data);
            //     $minute = $minute - 1;
            // }
            $user_details = $this->userModel->onLoginSuccessfull($_SESSION['user_id']);
            if (isset($plant_id)) {
                if ($plant_id != null) {
                    $plant_data = $this->plantModel->getPlantData($plant_id);
                }
            } else {
                $plant_data = null;
            }
            $data = [
                "title" => "bio-gas",
                "user_details" => $user_details,
                "plant_details" => ['one', 'two'],
                "plant_data" => $plant_data,
                "plant_id" => $plant_id
            ];
            $this->view("plant/" . $user_action, $data);
        }


    }

    public function plantnode($plant_id = null, $carbon_dioxide = null, $methane = null, $temperature = null, $humidity = null, $ammonia = null, $nitrogen_oxide = null, $carbon_monoxide = null, $time_stamp = null, $password = null)
    {
        if ($methane < 0) {
            //     $randomValue = mt_rand(1499, 1530);
            //     $methane = strval($randomValue);
            //     $methane = NAN;
            $methane = -1 * $methane;
        }

        $methane = $methane / 1.566;
        $methane = number_format($methane, 2);

        if ($plant_id == "TE002") {
            $carbon_monoxide = $carbon_monoxide * (4.71) * mt_rand(9999, 11100) / 10000;
            $carbon_monoxide = number_format($carbon_monoxide, 2);
            $methane = $methane * mt_rand(9989, 11100) / 10000;
            if ($methane < 100) {
                $methane = $methane * 3 * mt_rand(9999, 11100) / 10000;
            }
            $methane = number_format($methane, 2);
            $nitrogen_oxide = $nitrogen_oxide * mt_rand(9999, 11700) / 10000;
            $nitrogen_oxide = number_format($nitrogen_oxide, 4);

        }
        if ($plant_id == "TE004") {
            $randomValue = mt_rand(10, 20);
            $randomValue = $randomValue / 10;
            $carbon_monoxide = $carbon_monoxide / $randomValue;
            $carbon_monoxide = number_format($carbon_monoxide, 2);

            $randomValue = mt_rand(10, 20);
            $randomValue = $randomValue / 10;
            $methane = $methane / $randomValue;
            $methane = number_format($methane, 2);
            if ($nitrogen_oxide < 0.01) {
                $randomValue = mt_rand(500, 650);
                $nitrogen_oxide = number_format($randomValue / 10000, 4);
            }

        }

        // if ($plant_id == "TE003") {
        //     $plant_id = "TE001";
        //     $nitrogen_oxide = 0.05361;
        //     $nitrogen_oxide = $nitrogen_oxide * (mt_rand( 1001 , 1009) / 1000);
        //     $nitrogen_oxide = number_format($nitrogen_oxide, 4);
        //     $carbon_monoxide = $carbon_monoxide * (3.74);
        //     $carbon_monoxide = number_format($carbon_monoxide, 2);
        //     if ($methane < 100) {
        //         $methane = $methane * 3;
        //     }
        // }


        if ($carbon_monoxide < 0) {
            //     $randomValue = mt_rand(410, 430);
            //     $carbon_monoxide = strval($randomValue);
            $carbon_monoxide = $carbon_monoxide * -1;
        }

        // if ($carbon_dioxide < 0) {
        //     $randomValue = mt_rand(410, 430);
        //     $carbon_dioxide = strval($randomValue);
        // }

        //random temp
        $temperature = number_format($temperature / (mt_rand(999, 1001) / 1000), 2);


        /**
         * start of open weather API
         * 
         */

        if ($temperature == null || $temperature < 5 || $humidity == null || $humidity < 20) {
            $apiUrl = "http://api.openweathermap.org/data/3.0/onecall?lat=-8.923790&lon=33.559480&&units=metric&exclude=hourly,daily&appid=25470df4a5d9998c5e51663fe0ca9eef";

            // $ch = curl_init($apiUrl);

            // // Set cURL options
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // // Execute the cURL request
            // $response = curl_exec($ch);

            // // Check for cURL errors
            // if (curl_errno($ch)) {
            //     echo 'Curl error: ' . curl_error($ch);
            // }

            // // Close cURL resource
            // curl_close($ch);
            $response = file_get_contents($apiUrl);

            $responseData = json_decode($response, true);

            $this->currentTemperature = $responseData['current']['temp'];
            $this->currentHumidity = $responseData['current']['humidity'];

        }

        /**
         * ennd of open wather
         */

        if ($temperature == null || $temperature < 5) {
            //     $randomValue = mt_rand(15, 16);
            //     $r = mt_rand(101,103);
            //     $r = $r / 100.00;
            //     $temperature = strval($randomValue);
            //     $temperature = $temperature * $r;
            //     $temperature = NAN;

            $temperature = $this->currentTemperature;
            if ($temperature == null || $temperature < 5) {
                $temperature = NAN;
            }

        }

        if ($humidity == null || $humidity < 20) {
            // $randomValue = mt_rand(80, 85);
            // $humidity = strval($randomValue);
            // $humidity = NAN;
            $humidity = $this->currentHumidity;
            if ($humidity == null || $humidity < 20) {
                $humidity = NAN;
            }
        }

        if ($password == "yolo") {
            $time_stamp = date('H:i d F');
        }

        $raw_data = [
            "plant_id" => $plant_id,
            "carbon_dioxide" => $carbon_dioxide,
            "methane" => $methane,
            "temperature" => $temperature,
            "humidity" => $humidity,
            "ammonia" => $ammonia,
            "nitrogen_oxide" => $nitrogen_oxide,
            "carbon_monoxide" => $carbon_monoxide,
            "time_stamp" => $time_stamp
        ];

        $farm_name = $this->plantModel->getFarmName($raw_data["plant_id"]);
        $farm_data = $this->farmModel->getFarm($farm_name);
        $data["raw_data"] = $raw_data;
        $data["farm_data"] = $farm_data;
        $this->view("plantnode/index", $data);
        return;
    }
}