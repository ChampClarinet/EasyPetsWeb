<?php

require('strings.php');

function setTitle($title){
    echo '<title>' . $title . ' - ' . $GLOBALS['easypets'] . '</title>';
}
function loadJQuery(){
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
}
function loadLoginPageBootstrap()
{
    //bootstrap
    echo '<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />';
    echo '<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />';
}

function loadMaterialDashboardLibraries(){
    echo '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>';
    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>';
    echo '<link rel="stylesheet" href="css/material-dashboard.css?v=2.0.0">';
}

function loadFirebaseLibraries(){
    echo '<script src="https://www.gstatic.com/firebasejs/4.13.0/firebase.js"></script>';
    echo '<script src="js/firebase-config.js"></script>';
}