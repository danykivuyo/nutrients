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
        // $this->home();
        // return $this->view('home/users');

        if ($user_action == "notification") {
            return $this->home();
        } else if ($user_action == "") {
            $user_details = $this->userModel->onLoginSuccessfull($_SESSION['user_id']);
            $data = [
                "title" => "bio-gas",
                "user_id" => $_SESSION['user_id'],
                "user_details" => $user_details
            ];
            return $this->view('home/users', $data);
        }

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

    public function plantnode($plant_id = null, $api_key = null, $mode = "test", $nitrohen = null, $phosphorus = null, $pottasium = null, $soil_ph = null, $soil_temperature = null, $soil_humidity = null, $electrical_conductivity = null, $salinity = null, $time_stamp = null)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $payload = @file_get_contents('php://input');
            $object = json_decode($payload, TRUE);
            header('Content-Type: application/json');
            echo $payload;
            return;
        } else {
            header('Content-Type: application/json');
            if ($api_key == "yolo") {
                $time_stamp = date('H:i d F');

                $raw_data = [
                    "plant_id" => $plant_id,
                    "nitrohen" => $nitrohen,
                    "phosphorus" => $phosphorus,
                    "pottasium" => $pottasium,
                    "soil_ph" => $soil_ph,
                    "soil_temperature" => $soil_temperature,
                    "soil_humidity" => $soil_humidity,
                    "electrical_conductivity" => $electrical_conductivity,
                    "salinity" => $salinity,
                    "time_stamp" => $time_stamp
                ];
                $farm_name = $this->plantModel->getFarmName($raw_data["plant_id"]);
                $farm_data = $this->farmModel->getFarm($farm_name);
                $data["raw_data"] = $raw_data;
                $data["farm_data"] = $farm_data;
                if (!isset($data["farm_data"]["farm_name"])) {
                    echo json_encode(
                        [
                            "success" => false,
                            "message" => "Device Not Registered",
                        ]
                    );
                    return;
                }
                echo json_encode($data);
                return;
                // $this->view("plantnode/index", $data);
                // $this->farmModel->putFarmNode($data["farm_data"]["farm_name"], $data["farm_data"]["farm_id"], $data["raw_data"]);
                // return;
            }
            echo json_encode(
                [
                    "success" => false,
                    "message" => "Not allowed",
                ]
            );
            return;

        }
    }
}