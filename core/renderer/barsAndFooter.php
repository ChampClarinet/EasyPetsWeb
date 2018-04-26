<?php
function drawNavBar($pageTitle)
{
    echo '<nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute fixed-top"><div class="container-fluid">';
    echo '<div class="navbar-wrapper"><a class="navbar-brand" href="#pablo">'.$pageTitle.'</a></div>';
    echo '</div></nav>';
    //echo '<div class="collapse navbar-collapse justify-content-end" id="navigation">';
    //echo '<ul class="navbar-nav"><li class="nav-item"><a class="nav-link" href="dashboard.php">';
    //echo '<i class="material-icons">dashboard</i><p><span class="d-lg-none d-md-block">Stats</span></p></a></li>';
    //echo '<li class="nav-item"><a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
    //echo '<i class="material-icons">comments</i><span class="notification">5</span></a></li><li class="nav-item">';
    //echo '<a class="nav-link" href="service_detail.php"><i class="material-icons">person</i></a></li></ul></div></div></nav>';
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
    echo '<li class="nav-item"><a class="nav-link" href="logout.php">';
    echo '<i class="material-icons">exit_to_app</i><p>ออกจากระบบ</p></a></li>';
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