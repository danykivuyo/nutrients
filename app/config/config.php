<?php
    //defining database parameters
    const DB_HOST = "fdb1027.runhosting.com";
    const DB_USERNAME = '4310036_biogas';
    const DB_NAME = '4310036_biogas';
    const DB_PASSWORD = 'yolomasters@3D';
    const timezoneId = 'Africa/Dar_es_Salaam';

    //APPROOT
    define('APPROOT' , dirname(dirname(__FILE__)));

    //URLROOT (Dynamic links)
    define('URLROOT' , 'http://biogas.getenjoyment.net/');

    //Sitename
    define('SITENAME' , 'MLRS');

    //paths
    const LOGIN = URLROOT."home/login";
    // const REGISTER = URLROOT."home/register";
    const REGISTER = "#";
    const LOGOUT = URLROOT."home/logout";
    const RESET = URLROOT."home/reset";
    date_default_timezone_set(timezoneId);

?>