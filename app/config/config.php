<?php
//defining database parameters
// const DB_HOST = "fdb1027.runhosting.com";
// const DB_USERNAME = '4310036_biogas';
// const DB_NAME = '4310036_biogas';
// const DB_PASSWORD = 'yolomasters@3D';
// const timezoneId = 'Africa/Dar_es_Salaam';

const DB_HOST = "localhost";
const DB_USERNAME = 'root';
const DB_NAME = 'nutrients';
const DB_PASSWORD = '';
const timezoneId = 'Africa/Dar_es_Salaam';

//APPROOT
define('APPROOT', dirname(dirname(__FILE__)));

//URLROOT (Dynamic links)
// define('URLROOT', 'http://biogas.getenjoyment.net/');
define('URLROOT', 'http://localhost/nutrients/');

//Sitename
define('SITENAME', 'NUTRIENTS');

//paths
const LOGIN = URLROOT . "home/login";
// const REGISTER = URLROOT."home/register";
const REGISTER = "#";
const LOGOUT = URLROOT . "home/logout";
const RESET = URLROOT . "home/reset";
date_default_timezone_set(timezoneId);

?>