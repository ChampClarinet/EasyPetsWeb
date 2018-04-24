<?php
session_start();
$me->name = "Wallop";
$me->surname = "opasakhun";
$_SESSION['me'] = $me;
?>
<html>
    <body>
        <button onclick="window.location.href = 'testRetrieveSession.php'">GO</button>
    </body>
</html>
