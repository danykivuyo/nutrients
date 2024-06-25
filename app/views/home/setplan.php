<html>

<body class="purple darken-3">
    <?php require_once 'helpers/navbar.php' ?>
    USAGE PLAN SET PAGE
    <?php
    /**
     * reading the meter table from the database and assinign the values to initial variables
     * displaying variable to user in a good and pleasing way (creative way)
     * assining the variables according to user defined values
     * updating the database by uploading the current variables
     * 
     */

    $homeController = new Home;
    echo "<br /><br />";
    $daily_warning = "5";
    $daily_limit = "15";
    $monthly_warning = "60";
    $monthly_limit = "100";

    if (isset($_POST["daily-warning"])) {
        echo "OK";
        $daily_warning = $_POST["daily-warning"];
        $daily_limit = $_POST["daily-limit"];
        $monthly_warning = $_POST["monthly-warning"];
        $monthly_limit = $_POST["monthly-limit"];
        $homeController->meterModel->meter_set($_SESSION["user_id"], $data["meter_details"][2]);
        $homeController->meterModel->meterRead($_SESSION["user_id"]);
        $homeController->meterModel->setMeter($daily_warning, $daily_limit, $monthly_warning, $monthly_limit);
        $homeController->meterModel->putMeter($_SESSION["user_id"]);
        if (isset($_SESSION['login'])) if ($_SESSION['login'])
            echo '<script>location.href = "' . URLROOT . 'home/' . $data["user_id"] . '/usage";</script>';
    }

    //$homeController->meterModel->putMeter($homeController->userModel->user_id);
    ?>
    <div class="container">
        <br /><br />
        <form method="POST">
            <input
                style="border: none;outline: none;font-size: 1rem;font-weight: 600;color: #000;width: 100%;min-width: unset;background-color: transparent;border-color: transparent;margin: 0;"
                type="text" id="daily-warning" name="daily-warning" placeholder="daily warning" />
            <label style="font-weight: bold;font-size: 0.9rem" for="daily-warning">Today's warnig
                set</label><br /><br />
            <input
                style="border: none;outline: none;font-size: 1rem;font-weight: 600;color: #000;width: 100%;min-width: unset;background-color: transparent;border-color: transparent;margin: 0;"
                type="text" id="monthly-warning" name="monthly-warning" placeholder="monthly warning" />
            <label style="font-weight: bold;font-size: 0.9rem" for="monthly-warning">This month warnig
                set</label><br /><br />
            <input
                style="border: none;outline: none;font-size: 1rem;font-weight: 600;color: #000;width: 100%;min-width: unset;background-color: transparent;border-color: transparent;margin: 0;"
                type="text" id="daily-limit" name="daily-limit" placeholder="daily limit" />
            <label style="font-weight: bold;font-size: 0.9rem" for="daily-limit">Today's limit set</label><br /><br />
            <input
                style="border: none;outline: none;font-size: 1rem;font-weight: 600;color: #000;width: 100%;min-width: unset;background-color: transparent;border-color: transparent;margin: 0;"
                type="text" id="monthly-limit" name="monthly-limit" placeholder="monthly limit" />
            <label style="font-weight: bold;font-size: 0.9rem" for="daily-warning">This month limir
                set</label><br /><br />
            <input type="submit" class="indigo btn" name="submit"
                value="confirm and save changes" /><br /><br /><br /><br /><br />
        </form>
    </div>

    <?php require_once 'helpers/footer.php'; ?>
</body>

</html>