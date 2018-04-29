<?php
function drawNavBar($pageTitle)
{
    echo '<nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute fixed-top"><div class="container-fluid">';
    echo '<div class="navbar-wrapper"><a class="navbar-brand" href="#">' . $pageTitle . '</a></div>';
    echo '</div></nav>';
}

function drawSideBar($currentPage, $service)
{
    $active = 'active';
    $dashboardActive = '';
    $detailActive = '';
    $animalActive = '';
    if (strcmp($currentPage, "dashboard") == 0) {
        $dashboardActive = $active;
    } else if (strcmp($currentPage, "detail") == 0) {
        $detailActive = $active;
    } else if (strcmp($currentPage, "animal") == 0) {
        $animalActive = $active;
    }
    echo '<div class="sidebar" data-color="azure" data-background-color="white"><div class="logo">';
    echo '<a href="' . $service->facebook_url . '" class="simple-text logo-normal">' . $service->name . '</a></div>';
    echo '<div class="sidebar-wrapper"><ul class="nav">';
    //dashboard
    echo '<li class="nav-item ' . $dashboardActive . ' "><a class="nav-link" href="dashboard.php">';
    echo '<i class="material-icons">dashboard</i><p>Dashboard</p></a></li>';
    //service detail
    echo '<li class="nav-item ' . $detailActive . '"><a class="nav-link" href="service_detail.php">';
    echo '<i class="material-icons">store</i><p>ข้อมูลสถานบริการ</p></a></li>';
    //animal
    echo '<li class="nav-item ' . $animalActive . '"><a class="nav-link" href="animal.php">';
    echo '<i class="material-icons">check</i><p>การรองรับสัตว์พิเศษ</p></a></li>';
    //logout
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