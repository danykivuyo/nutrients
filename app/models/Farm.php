<?php
class Farm
{
    private $db;
    public $farm_id;
    public $farm_name;
    public $farm_region;
    public $farm_ward;
    public $farm_place;
    public $farm_created_at;
    public $farm_modified_at;
    public $time_stamp;

    //raw data
    private $plant_id;
    private $carbon_dioxide;
    private $methane;
    private $temperature;
    private $humidity;
    private $ammonia;
    private $nitrogen_oxide;
    private $carbon_monoxide;

    public function __construct()
    {
        $this->db = new Database;
        $this->farm_id = uniqid("farm.", true);
        $this->farm_created_at = date("H:i d F Y");
        $this->farm_modified_at = $this->farm_created_at;
    }

    public function createTable($table_name)
    {
        $sql = 'CREATE TABLE `' . $table_name . '` ( 
            `ind` INT(255) NOT NULL AUTO_INCREMENT , 
            `farm_id` VARCHAR(50) NULL DEFAULT NULL , 
            `plant_id` VARCHAR(50) NULL DEFAULT NULL , 
            `nitrohen` VARCHAR(20) NULL DEFAULT NULL , 
            `phosphorus` VARCHAR(20) NULL DEFAULT NULL , 
            `pottasium` VARCHAR(20) NULL DEFAULT NULL , 
            `soil_ph` VARCHAR(20) NULL DEFAULT NULL , 
            `soil_temperature` VARCHAR(20) NULL DEFAULT NULL , 
            `soil_humidity` VARCHAR(20) NULL DEFAULT NULL , 
            `electrical_conductivity` VARCHAR(20) NULL DEFAULT NULL , 
            `salinity` VARCHAR(20) NULL DEFAULT NULL , 
            `time_stamp` VARCHAR(20) NULL DEFAULT NULL ,
            PRIMARY KEY (`ind`))';
        $this->db->query($sql);
        $this->db->execute();
    }

    public function farm_set($farm_name, $farm_region, $farm_ward, $farm_place)
    {
        $this->farm_name = $farm_name;
        $this->farm_region = $farm_region;
        $this->farm_ward = $farm_ward;
        $this->farm_place = $farm_place;
    }

    public function putFarm()
    {
        $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($stmt = $mysqli->prepare("SELECT `farm_id` FROM farm WHERE `farm_name` = ?")) {
            $stmt->bind_param("s", $this->farm_name);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows === 1) {
                    $user_register_err =
                        [
                            "success" => false,
                            "message" => "This farm name is already taken."
                        ];
                    echo $user_register_err["message"];
                    return 0;
                }
            }
        }

        $this->db->query(
            "INSERT INTO `farm` (
                    `farm_id`, 
                    `farm_name`,
                    `farm_region`,
                    `farm_ward`, 
                    `farm_place`,
                    `farm_created_at`, 
                    `farm_modified_at`) VALUES 
                    ('$this->farm_id',
                    '$this->farm_name', 
                    '$this->farm_region',
                    '$this->farm_ward',
                    '$this->farm_place',
                    '$this->farm_created_at',
                    '$this->farm_modified_at'
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

        $this->createTable($this->farm_name);

        return;

    }

    public function getFarms()
    {
        $res = array();
        $this->db->query("SELECT * FROM farm");
        $result = $this->db->resultSet();
        $res = json_decode(json_encode($result), true);
        return $res;
    }

    public function getFarm($farm_name)
    {
        $this->farm_name = $farm_name;
        $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $stmt = $mysqli->prepare(
            'SELECT
                    `farm_id`,
                    `farm_name`,
                    `farm_region`,
                    `farm_ward`,
                    `farm_place`,
                    `farm_created_at`
                FROM farm WHERE `farm_name` = ?'
        );
        $stmt->bind_param("s", $this->farm_name);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result(
            $this->farm_id,
            $this->farm_name,
            $this->farm_region,
            $this->farm_ward,
            $this->farm_place,
            $this->farm_created_at
        );
        $stmt->fetch();

        return [
            "farm_id" => $this->farm_id,
            "farm_name" => $this->farm_name,
            "farm_region" => $this->farm_region,
            "farm_ward" => $this->farm_ward,
            "farm_place" => $this->farm_place,
            "farm_created_at" => $this->farm_created_at
        ];
    }

    public function getFarmNames()
    {
        $res = array();
        $this->db->query("SELECT `farm_name` FROM farm");
        $result = $this->db->resultSet();
        // echo "<br /><br /><br />";
        // print_r($result[0]->farm_name);
        foreach ($result as $r) {
            array_push($res, strval($r->farm_name));
        }
        // echo $result[0]->farm_name;
        // print_r($res);
        return $res;
    }

    public function putFarmNode($farm_name = null, $farm_id = null, $raw_data = null)
    {
        if ($farm_name == null) {
            return;
        }
        $this->farm_name = $farm_name;

        //raw data
        $this->farm_id = $farm_id;
        $this->plant_id = $raw_data["plant_id"];
        $this->carbon_dioxide = $raw_data["carbon_dioxide"];
        $this->methane = $raw_data["methane"];
        $this->temperature = $raw_data["temperature"];
        $this->humidity = $raw_data["humidity"];
        $this->ammonia = $raw_data["ammonia"];
        $this->nitrogen_oxide = $raw_data["nitrogen_oxide"];
        $this->carbon_monoxide = $raw_data["carbon_monoxide"];
        $this->time_stamp = $raw_data["time_stamp"];

        $this->db->query(
            "INSERT INTO `" . $farm_name . "` (
                    `farm_id`,
                    `plant_id`, 
                    `carbon_dioxide`,
                    `methane`,
                    `temperature`, 
                    `humidity`,
                    `ammonia`,
                    `nitrogen_oxide`,
                    `carbon_monoxide`,
                    `time_stamp` ) VALUES
                    ('$this->farm_id',
                    '$this->plant_id', 
                    '$this->carbon_dioxide',
                    '$this->methane',
                    '$this->temperature',
                    '$this->humidity',
                    '$this->ammonia',
                    '$this->nitrogen_oxide',
                    '$this->carbon_monoxide',
                    '$this->time_stamp'
                    )"
        );
        if ($this->db->execute()) {
            $res =
                [
                    "success" => true,
                    "message" => "Successful added."
                ];
        } else {
            $res =
                [
                    "success" => false,
                    "message" => "Error."
                ];
        }

        if ($res["success"]) {
            echo "1";
        }
        if (!$res["success"]) {
            echo "0";
        }
    }

}