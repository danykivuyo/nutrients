<!-- plantnode index -->
<?php 

// print_r($data["raw_data"]);
// print_r($data);

$homeController = new Home;

$homeController->farmModel->putFarmNode($data["farm_data"]["farm_name"], $data["farm_data"]["farm_id"], $data["raw_data"]);
// $data["raw_data"]["plant_id"] = "TE003";
// $homeController->farmModel->putFarmNode($data["farm_data"]["farm_name"], $data["farm_data"]["farm_id"], $data["raw_data"]);