<?php

class User
{
    private $db;
    public $user_id;
    private $meter_id;
    private $user_name;
    private $user_email;
    private $user_phone;
    private $user_password;
    private $user_created_at;
    private $user_modified_at;
    private $user_role = "client";
    private $user_verification = "0";
    private $user_ref;
    public $user_verification_code;


    public function __construct()
    {
        $this->db = new Database;
        $this->user_id = uniqid("user.", true);
        $this->user_role = "client";
        $this->user_created_at = date("H:i d F Y");
        $this->user_modified_at = $this->user_created_at;
    }

    //function to get all users from the database (for admin only)
    public function getUsers()
    {
        $this->db->query("SELECT * FROM user");
        $result = $this->db->resultSet();
        return $result;
    }

    //called from register page to set variables
    public function user_set($user_name, $user_email, $user_phone, $user_password)
    {
        $this->user_name = $user_name;
        $this->user_email = strval($user_email);
        $this->user_phone = strval($user_phone);
        $this->user_password = password_hash($user_password, 1);
    }

    //called from reset page to set reset variables
    public function user_reset_set($user_email)
    {
        $this->user_email = strval($user_email);
    }

    //called from reset page to set verification variables
    public function user_verification_set($verification_code)
    {
        $this->user_verification_code = $verification_code;
    }

    //called from login page to set login variables
    public function user_login_set($user_name_or_email, $user_password)
    {
        $this->user_email = strval($user_name_or_email);
        $this->user_name = strval($user_name_or_email);
        $this->user_password = $user_password;
    }

    //called from meter read to get all required user detail
    public function user_get_detail($meter_id)
    {
        $this->meter_id = $meter_id;
        $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($stmt = $mysqli->prepare("SELECT `user_id` FROM user WHERE `user`.`meter_id` = ?")) {
            $stmt->bind_param("s", $this->meter_id);
            if ($stmt->execute()) {
                $stmt->store_result();
                $stmt->bind_result($this->user_id);
                $stmt->fetch();
                echo $this->user_id;
            }

        }

    }

    public function putUser()
    {
        $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($stmt = $mysqli->prepare("SELECT `user_id` FROM user WHERE `user_name` = ?")) {
            $stmt->bind_param("s", $this->user_name);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows === 1) {
                    $user_register_err =
                        [
                            "success" => false,
                            "message" => "This username is already taken."
                        ];
                    echo $user_register_err["message"];
                    return 0;
                } else {
                    //checking for email duplicate
                    if ($stmt = $mysqli->prepare("SELECT `user_id` FROM user WHERE `user_email` = ?")) {
                        $stmt->bind_param("s", $this->user_email);
                        if ($stmt->execute()) {
                            $stmt->store_result();
                            if ($stmt->num_rows === 1) {
                                $user_register_err =
                                    [
                                        "success" => false,
                                        "message" => "This email is already taken."
                                    ];
                                echo $user_register_err['message'];
                                return 0;
                            } else {
                                //phone duplicate check
                                $mobile = "xxxxxxxxxx";
                                $a = 9;
                                for ($i = (strlen($this->user_phone) - 1); $i > (strlen($this->user_phone) - 10); $i--) {
                                    $mobile[$a] = $this->user_phone[$i];
                                    $a--;
                                }
                                $mobile[0] = '0';
                                $this->user_phone = $mobile;
                                if ($stmt = $mysqli->prepare("SELECT `user_id` FROM user WHERE `user_phone` = ?")) {
                                    $stmt->bind_param("s", $this->user_phone);
                                    if ($stmt->execute()) {
                                        $stmt->store_result();
                                        if ($stmt->num_rows === 1) {
                                            $user_register_err =
                                                [
                                                    "success" => false,
                                                    "message" => "This phone is already taken."
                                                ];
                                            echo $user_register_err["message"];
                                            return 0;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }


        $this->db->query(
            "INSERT INTO `user` (
                    `user_id`, 
                    `user_name`,
                    `user_email`,
                    `user_phone`, 
                    `user_password`, 
                    `user_created_at`, 
                    `user_modified_at`,
                    `user_role` ,
                    `user_verification`, 
                    `user_ref`) VALUES 
                    ('$this->user_id',
                    '$this->user_name', 
                    '$this->user_email',
                    '$this->user_phone',
                    '$this->user_password',
                    '$this->user_created_at',
                    '$this->user_modified_at',
                    '$this->user_role',
                    '$this->user_verification',
                    '$this->user_ref')"
        );
        if ($this->db->execute()) {
            $user_register_err =
                [
                    "success" => true,
                    "message" => "Successful registered."
                ];
        }
        if ($user_register_err["success"]) {
            echo $user_register_err['message'] . '<br /> <button><a href="' . URLROOT . 'home/login">Login</a></button>';
        }
    }

    public function updateUser()
    {
        $this->db->query("UPDATE `user` SET
            `user_name` = '$this->user_name',
            `user_email` = '$this->user_email',
            `user_phone` = '$this->user_phone',
            `user_password` = '$this->user_password',
            `user_created_at` = '$this->user_created_at',
            `user_modified_at` = '$this->user_modified_at',
            `user_role` = '$this->user_role',
            `user_ref` = '$this->user_ref' WHERE `user`.`user_id` = '" . $this->user_id . "'");
        if ($this->db->execute()) {
        }
    }

    //update user for admin
    // public function adminUpdateUser($user_id, $meter_id, $user_paid_state = '', $user_paid_amount = '')
    // {
    //     //variables synchronization
    //     $this->user_id = $user_id;
    //     $this->meter_id = $meter_id;
    //     $this->user_paid_state = $user_paid_state;
    //     $this->user_paid_amount = $user_paid_amount;
    //     $this->user_paid_date = date("H:i d F Y");
    //     $paid_months = intval($user_paid_amount / 3000.00);
    //     $this->user_payment_expire_date = date("H:i d F Y", strtotime(" + $paid_months months"));
    //     $this->user_paid_days_count_down = $this->user_payment_expire_date - $this->user_paid_date;
    //     $this->db->query("UPDATE `user` SET
    //         `meter_id` = '$this->meter_id',
    //         `user_created_at` = '$this->user_created_at',
    //         `user_modified_at` = '$this->user_modified_at',
    //         `user_paid_state` = '$this->user_paid_state',
    //         `user_paid_date` = '$this->user_paid_date',
    //         `user_payment_expire_date` = '$this->user_payment_expire_date',
    //         `user_paid_amount` = '$this->user_paid_amount',
    //         `user_total_paid_amount` = '$this->user_total_paid_amount',
    //         `user_paid_days_count_down` = '$this->user_paid_days_count_down',
    //         `user_role` = '$this->user_role' WHERE `user`.`user_id` = '" . $this->user_id . "'");
    //     if ($this->db->execute()) {
    //     }
    // }

    public function userLogin()
    {
        //if(!isset($_SESSION['login'])) session_start();
        $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($stmt = $mysqli->prepare("SELECT `user_id` FROM user WHERE `user_name` = ?")) {
            $stmt->bind_param("s", $this->user_name);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows === 1) {
                    $stmt = $mysqli->prepare("SELECT `user_id` , `user_password` FROM user WHERE `user_name` = ?");
                    $stmt->bind_param("s", $this->user_name);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($user_id, $user_password_from_server);
                    $stmt->fetch();
                    if (password_verify($this->user_password, $user_password_from_server)) {
                        //echo "login successfull by username.";
                        $_SESSION['loc'] = "false";
                        $_SESSION['login'] = "true";
                        $_SESSION['user_id'] = $user_id;
                        //header("location: ".URLROOT."home/user/".$user_id."/");
                        if (isset($_SESSION['login'])) if ($_SESSION['login'])
                            echo '<script>location.href = "' . URLROOT . 'home/";</script>';

                    } else {
                        echo '<script>
                                    var wrong = document.getElementById("wrong_password");
                                    wrong.innerHTML = "wrong password";
                                    var reset = document.getElementById("reset_button");
                                    reset.innerText = "reset password";
                                </script>';
                    }
                } else {
                    if ($stmt = $mysqli->prepare("SELECT `user_id` FROM user WHERE `user_email` = ?")) {
                        $stmt->bind_param("s", $this->user_email);
                        if ($stmt->execute()) {
                            $stmt->store_result();
                            if ($stmt->num_rows === 1) {
                                $stmt = $mysqli->prepare("SELECT `user_id` , `user_password` FROM user WHERE `user_email` = ?");
                                $stmt->bind_param("s", $this->user_email);
                                $stmt->execute();
                                $stmt->store_result();
                                $stmt->bind_result($user_id, $user_password_from_server);
                                $stmt->fetch();
                                if (password_verify($this->user_password, $user_password_from_server)) {
                                    // echo "<h1>login successfull by user email.</h1>";
                                    $_SESSION['loc'] = "false";
                                    $_SESSION['login'] = true;
                                    $_SESSION['user_id'] = $user_id;
                                    //header("location: ".URLROOT."home/user/".$user_id."/");
                                    if (isset($_SESSION['login'])) if ($_SESSION['login'])
                                        echo '<script>location.href = "' . URLROOT . 'home/";</script>';

                                } else {
                                    echo '<script>
                                                var wrong = document.getElementById("wrong_password");
                                                wrong.innerHTML = "wrong password";
                                                var reset = document.getElementById("reset_button");
                                                reset.innerText = "reset password";
                                            </script>';
                                }
                            } else {
                                echo "user doesnot exist.";
                            }
                        }
                    }
                }
            }
        }

    }

    public function userReset()
    {
        //fetching user id from user table using email
        $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($stmt = $mysqli->prepare("SELECT `user_id` FROM user WHERE `user_email` = ?")) {
            $stmt->bind_param("s", $this->user_email);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows === 1) {
                    $stmt = $mysqli->prepare("SELECT `user_id` , `user_phone` FROM user WHERE `user_email` = ?");
                    $stmt->bind_param("s", $this->user_email);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($user_id, $user_phone);
                    $stmt->fetch();
                    $this->user_id = $user_id;
                    $user_phone[0] = '5';
                    $user_phone = '25' . $user_phone;
                    $this->user_phone = $user_phone;


                    $this->db->query("DELETE FROM `password_reset` WHERE `password_reset`.`user_id` = '$this->user_id'");
                    $this->db->execute();


                    $reset_code = rand(1231, 7879);
                    $reset_code_created_at = date("H:i d F Y");

                    $reset_code_expires_at = date('H:i d F Y', strtotime($reset_code_created_at . ' +10 minutes'));

                    $this->db->query(
                        "INSERT INTO `password_reset` (
                                    `user_id`, 
                                    `reset_code`,
                                    `reset_code_created_at`,
                                    `reset_code_expires_at`) VALUES 
                                    ('$this->user_id',
                                    '$reset_code',
                                    '$reset_code_created_at',
                                    '$reset_code_expires_at')"
                    );
                    if ($this->db->execute()) {
                        $user_register_err =
                            [
                                "success" => true,
                                "message" => "Successful sent."
                            ];

                        //codes sms sent from here.
                        $api_key = 'bdece28a89335fcf';
                        $secret_key = 'YjhkODRkYWNmNWZmMDgzYWMxODFhYmM2ZTM3NmI4YmU0NTQ3YjQ5ZmFmNmQ0NDY0ODRiZTg2Yjg3YzIwNGNlMw==';

                        $postData = array(
                            'source_addr' => 'INFO',
                            'encoding' => 0,
                            'schedule_time' => '',
                            'message' => 'Your DROID reset code is ' . strval($reset_code) . ' use it before ' . $reset_code_expires_at,
                            'recipients' => [array('recipient_id' => '1', 'dest_addr' => strval($this->user_phone))]
                        );

                        $Url = 'https://apisms.beem.africa/v1/send';

                        $ch = curl_init($Url);
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt_array(
                            $ch,
                            array(
                                CURLOPT_POST => TRUE,
                                CURLOPT_RETURNTRANSFER => TRUE,
                                CURLOPT_HTTPHEADER => array(
                                    'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
                                    'Content-Type: application/json'
                                ),
                                CURLOPT_POSTFIELDS => json_encode($postData)
                            )
                        );

                        $response = curl_exec($ch);

                        if ($response === FALSE) {
                            echo $response;
                            die(curl_error($ch));
                        }
                        //var_dump($response);

                        echo '
                                <script>
                                    const before = document.getElementById("before");
                                    const after = document.getElementById("after");
                                    before.style.display = "none";
                                    after.style.display = "flex";
                                </script>
                            ';

                    }
                    if ($user_register_err["success"]) {
                        //echo $user_register_err['message'] . '<br /> <button><a href="'.URLROOT.'home/login">Login</a></button>';
                    }
                } else {
                    echo "user doesnot exist";
                }
            }
        }

    }

    public function userVerify()
    {
        $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($stmt = $mysqli->prepare("SELECT `reset_code_expires_at` FROM password_reset WHERE `reset_code` = ?")) {
            $stmt->bind_param("s", $this->user_verification_code);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows === 1) {
                    $stmt = $mysqli->prepare("SELECT `user_id` , `reset_code_expires_at` FROM password_reset WHERE `reset_code` = ?");
                    $stmt->bind_param("s", $this->user_verification_code);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($user_id, $reset_code_expires_at);
                    $stmt->fetch();
                    $this->user_id = $user_id;
                    if ($reset_code_expires_at > date("H:i d F Y")) {
                        //reset successfull 
                        echo '
                                <script>
                                    const after = document.getElementById("after");
                                    const last = document.getElementById("last");
                                    const id = document.getElementById("id");

                        
                                    id.value = "' . $this->user_id . '";
                                    before.style.display = "none";
                                    after.style.display = "none";
                                    last.style.display = "flex";
                                </script>
                            ';
                    } else {

                    }
                }
            }
        }
    }

    public function passwordChange($user_id, $new_password)
    {
        $this->user_id = $user_id;
        //echo $this->user_id;
        $this->user_password = password_hash($new_password, 1);
        $this->db->query("UPDATE `user` SET `user`.`user_password` = '$this->user_password' WHERE `user`.`user_id` = '$this->user_id'");
        if ($this->db->execute()) {
            echo '<script> location.href = "' . LOGIN . '" </script>';
        } else {
            echo "<h1>Failed</h1>";
        }
    }

    public function onLoginSuccessfull($user_id)
    {
        if (!isset($_SESSION['login']))
            return null;
        $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $stmt = $mysqli->prepare(
            'SELECT
                    `user_name`,
                    `user_email`,
                    `user_phone`,
                    `user_created_at`,
                    `user_modified_at`,
                    `user_role`,
                    `user_verification`,
                    `user_ref`
                FROM user WHERE `user_id` = ?'
        );
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result(
            $this->user_name,
            $this->user_email,
            $this->user_phone,
            $this->user_created_at,
            $this->user_modified_at,
            $this->user_role,
            $this->user_verification,
            $this->user_ref
        );
        $stmt->fetch();

        return [
            "user_name" => $this->user_name,
            "user_email" => $this->user_email,
            "user_phone" => $this->user_phone,
            "user_created_at" => $this->user_created_at,
            "user_modified_at" => $this->user_modified_at,
            "user_role" => $this->user_role,
            "user_verification" => $this->user_verification,
            "user_ref" => $this->user_ref
        ];
    }

    public function logout()
    {
        session_destroy();
        //header("location: ".URLROOT."home");
        echo '<script>location.href = "' . URLROOT . 'home/";</script>';
    }

}