<?php

//configuration files
require_once "config/config.php";


if (isset($_GET['url'])) {
    $url = rtrim($_GET['url'], '/');
    $url = rtrim($url, '.php');
    $url = rtrim($url, '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);
    // print_r($url[0]);
}
if (isset($url) && ($url[0] == "charts" || $url[0] == "Charts")) {

} else {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta Charset="utf-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0" >
    <link href="' . URLROOT . 'public/css/materialize.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="' . URLROOT . 'public/js/materialize.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!--   Core JS Files   -->
    <script src="' . URLROOT . 'public/js/core/popper.min.js"></script>
    <script src="' . URLROOT . 'public/js/core/bootstrap.min.js"></script>
    <script src="' . URLROOT . 'public/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="' . URLROOT . 'public/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="' . URLROOT . 'public/js/plugins/chartjs.min.js"></script>

    <link href="' . URLROOT . 'public/css/style.css" rel="stylesheet">
    <script src="' . URLROOT . 'public/js/loader.js"></script>';
}

//Requiring libraries
// require_once '../vendor/autoload.php';
require_once 'libraries/Core.php';
require_once 'libraries/Controller.php';
require_once 'libraries/Database.php';

//instatiate the core
$init = new Core;
if (isset($url) && ($url[0] == "charts" || $url[0] == "Charts")) {

} else {
    echo '<title>' . SITENAME . '</title><link rel="shortcut icon" href="http://sstatic.net/stackoverflow/img/favicon.ico">';
}