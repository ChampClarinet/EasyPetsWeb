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

function addLogoutEventJQuery(){
    echo '<script>$("#logout").click(function () {';
    echo 'firebase.auth().signOut().then(function(){';
    echo 'alert("signed out");';
    echo 'window.location.href = "index.html";';
    echo '}, function(error) {});});</script>';
}

function drawNavBar($pageTitle)
{
    echo '<nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute fixed-top"><div class="container-fluid">';
    echo '<div class="navbar-wrapper"><a class="navbar-brand" href="#pablo">'.$pageTitle.'</a></div>';
    echo '<div class="collapse navbar-collapse justify-content-end" id="navigation">';
    echo '<ul class="navbar-nav"><li class="nav-item"><a class="nav-link" href="dashboard.php">';
    echo '<i class="material-icons">dashboard</i><p><span class="d-lg-none d-md-block">Stats</span></p></a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
    echo '<i class="material-icons">comments</i><span class="notification">5</span></a></li><li class="nav-item">';
    echo '<a class="nav-link" href="service_detail.php"><i class="material-icons">person</i></a></li></ul></div></div></nav>';
}

function drawSideBar($currentPage, $service){
    $active = 'active';
    $dashboardActive = '';
    $detailActive = '';
    $reviewActive = '';
    $replyActive = '';
    if(strcmp($currentPage, "dashboard") == 0){
        $dashboardActive = $active;
    }else if(strcmp($currentPage, "detail") == 0){
        $detailActive = $active;
    }else if(strcmp($currentPage, "review") == 0){
        $reviewActive = $active;
    }else if(strcmp($currentPage, "reply") == 0){
        $replyActive = $active;
    }
    echo '<div class="sidebar" data-color="azure" data-background-color="white"><div class="logo">';
    echo '<a href="'.$service->facebook_url.'" class="simple-text logo-normal">'.$service->name.'</a></div>';
    echo '<div class="sidebar-wrapper"><ul class="nav">';
    //dashboard
    echo '<li class="nav-item '.$dashboardActive.' "><a class="nav-link" href="dashboard.php">';
    echo '<i class="material-icons">dashboard</i><p>Dashboard</p></a></li>';
    //service detail
    echo '<li class="nav-item '.$detailActive.'"><a class="nav-link" href="service_detail.php">';
    echo '<i class="material-icons">store</i><p>ข้อมูลสถานบริการ</p></a></li>';
    //review
    echo '<li class="nav-item '.$reviewActive.'"><a class="nav-link" href="review.php">';
    echo '<i class="material-icons">comment</i><p>รีวิว</p></a></li>';
    //reply
    echo '<li class="nav-item '.$replyActive.'"><a class="nav-link" href="reply.php">';
    echo '<i class="material-icons">reply</i><p>การตอบกลับ</p></a></li>';
    //logout
    echo '<li class="nav-item"><a class="nav-link" href="index.php">';
    echo '<i id="logout" class="material-icons">exit_to_app</i><p>ล็อคเอาท์</p></a></li>';
    echo '</ul></div></div>';
}

function drawFooter()
{
    echo '<footer class="footer ">';
    echo '<div class="container-fluid">';
    echo '<div class="copyright pull-right">';
    echo '&copy';
    echo '<script>document.write(new Date().getFullYear())</script>';
    echo ', ' . $GLOBALS['easypets'];
    echo '</div></div></footer>';
}