<?php

class Plant
{
    private $db;
    public $plant_id;
    public $plant_name;
    public $plant_farm_name;
    public $plant_created_at;
    public $plant_modified_at;

    public function __construct()
    {
        $this->db = new Database;
        $this->plant_id = uniqid("plant.", true);
        $this->plant_created_at = date("H:i d F Y");
        $this->plant_modified_at = $this->plant_created_at;
    }

    public function getPlants()
    {
        $res = array();
        $this->db->query("SELECT * FROM plant");
        $result = $this->db->resultSet();
        $res = json_decode(json_encode($result), true);
        return $res;
    }

    public function plant_set($plant_name, $plant_farm_name, $plant_id)
    {
        $this->plant_id = $plant_id;
        $this->plant_name = $plant_name;
        $this->plant_farm_name = $plant_farm_name;
    }

    public function getFarmName($plant_id)
    {
        $this->plant_id = $plant_id;
        $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($stmt = $mysqli->prepare("SELECT `plant_farm_name` FROM plant WHERE `plant`.`plant_id` = ?")) {
            $stmt->bind_param("s", $this->plant_id);
            if ($stmt->execute()) {
                $stmt->store_result();
                $stmt->bind_result($this->plant_farm_name);
                $stmt->fetch();
                return $this->plant_farm_name;
            }

        }
    }

    public function getPlantData($plant_id)
    {
        $this->plant_id = $plant_id;
        $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($stmt = $mysqli->prepare("SELECT `plant_farm_name` FROM plant WHERE `plant`.`plant_id` = ?")) {
            $stmt->bind_param("s", $this->plant_id);
            if ($stmt->execute()) {
                $stmt->store_result();
                $stmt->bind_result($this->plant_farm_name);
                $stmt->fetch();
                $this->plant_farm_name= rtrim($this->plant_farm_name);

                //fetching data
                $this->db->query("SELECT * FROM `$this->plant_farm_name` WHERE `plant_id` = '$this->plant_id' ORDER BY `ind` DESC LIMIT 100");
                $result = $this->db->resultSet();
                $res = json_decode(json_encode($result));
                return $res;
            }
        }

    }

    public function putPlant()
    {
        $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($stmt = $mysqli->prepare("SELECT `plant_name` FROM plant WHERE `plant_id` = ?")) {
            $stmt->bind_param("s", $this->plant_id);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows === 1) {
                    $user_register_err =
                        [
                            "success" => false,
                            "message" => "This id is already taken."
                        ];
                    echo $user_register_err["message"];
                    return 0;
                }
            }
        }
        $this->db->query(
            "INSERT INTO `plant` (
                    `plant_id`, 
                    `plant_name`,
                    `plant_farm_name`,
                    `plant_created_at`, 
                    `plant_modified_at`) VALUES 
                    ('$this->plant_id',
                    '$this->plant_name', 
                    '$this->plant_farm_name',
                    '$this->plant_created_at',
                    '$this->plant_modified_at'
                    )"
        );
        if ($this->db->execute()) {
            $user_register_err =
                [
                    "success" => true,
                    "message" => "Successful registered."
                ];
        }
        if ($user_register_err["success"]) {
        }

        if ($user_register_err["success"]) {
            echo $user_register_err['message']; //'<br /> <button><a href="' . URLROOT . 'home/login">Login</a></button>';
            echo "
            <script>
            M.toast({html: '" . $user_register_err['message'] . "', classes: 'rounded'});
            </script>
            ";
        }
    }



}