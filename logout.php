<?php
require('core/libraries.php');
include 'core/renderer/header_inc.php';
loadJQuery();
loadFirebaseLibraries();
?>
</head>
<script type="text/javascript">
    firebase.auth().signOut().then(function () {
        $("body").html('กำลังออกจากระบบ');
        window.location.href = "index.php";
    }, function (error) {
        console.log(error);
    });
</script>
</html>