<?php
require('core/libraries.php');
include 'core/renderer/header_inc.php';
loadJQuery();
loadFirebaseLibraries();
session_destroy();
?>
</head>
<script type="text/javascript">
    firebase.auth().signOut().then(function () {
        $("body").html('กำลังออกจากระบบ');
        window.location.href = "login.php";
    }, function (error) {
        console.log(error);
    });
</script>
</html>