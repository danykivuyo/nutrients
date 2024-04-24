<?php require_once 'helpers/navbar.php'?>
<br /><br /><br /><br />
<?php if(isset($_POST["unit"])){
    $units = $_POST["unit"];
    $meterModel = new Meter();
    $meterModel->readLocalMeter($data["meter_details"][1]);
    $meterModel->putLocalMeter($data["meter_details"][1] , $units);
    echo '<br /><br />
        <div class="row row-1" style="margin: 0;overflow: hidden;border: 1px solid rgba(0, 0, 0, 0.137);padding: 0.5rem;outline: none;width: 100%;min-width: unset;border-radius: 5px;background-color: rgba(221, 228, 236, 0.301);border-color: rgba(221, 228, 236, 0.459);margin: 2vh 0;overflow: hidden;">
            <div class="col-2"><img class="img-fluid" src="https://img.icons8.com/office/16/000000/open-envelope.png" /></div>
            <div class="col-7"> <p>You have successfull bought '.$units.' kWh. Cost '.$units * 350 .'Tsh</p></div>
            <div class="col-3 d-flex justify-content-center"> <a style="color: grey;text-decoration: none;font-size: 0.87rem;font-weight: bold;" href="#"></a> </div>
        </div>';
    }
?>