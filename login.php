<?php
require('core/libraries.php');
include 'core/renderer/header_inc.php';
setTitle($GLOBALS['login']);
//fonts
echo '<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">';
//css
echo '<link rel="stylesheet" type="text/css" href="css/style.css" />';
loadLoginPageBootstrap();
loadJQuery();
?>
</head>
<body class="login-body">
<div class="container" align="center">
    <div class="login-block">
        <div class="login-block-header">
            <img class="center-block" src="res/Logo.png" alt="Logo">
        </div>
        <div class="input-group " style="margin-bottom: 20px;">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input id="tbx-user" type="text" class="form-control" placeholder="<?php echo $GLOBALS['username'] ?>">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input id="tbx-pwd" type="password" class="form-control" placeholder="<?php echo $GLOBALS['password'] ?>" onkeypress="keyPressed(event);">
        </div>
        <hr>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <button id="btn-login" type="submit" class="button"><?php echo $GLOBALS['login_button'] ?></button>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <a href="create_email.php"><button id="btn-login" type="button" class="button"><?php echo $GLOBALS['register_button'] ?></button></a>
            </div>
        </div>
    </div>
</div>
</body>
<?php loadFirebaseLibraries(); ?>
<script type="text/javascript">

    document.getElementById("btn-login").onclick = function(e) {
        e.preventDefault();
        handleSignUp();
    };

    function keyPressed(e) {
        if (e.keyCode === 13) {
            handleSignUp();
        }
    }

    function handleSignUp() {
        let email = document.getElementById('tbx-user').value;
        let password = document.getElementById('tbx-pwd').value;
        let warnings = "";

        if (email.length < 4) {
            warnings += 'You need a valid email \n';
        }
        if (password.length < 4) {
            warnings += 'You need a valid password';
        }

        if (warnings != "") {
            alert(warnings);
        } else {
            firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error) {
                alert("error");
                console.log(error);
            });
        }
    }

    firebase.auth().onAuthStateChanged(user => {
        if (user) {
            console.log("logged in as "+user.email);
            loadService(user.uid);
        }
    });

    function loadService(uid) {
        let data = {uid: uid};
        $.post('core/serviceLoaderMain.php', data,
            function (data, status) {
            console.log(data);
                if(status === 'success') {
                    window.location.href = 'index.php';
                }
                else alert('error: '+data);
            }
        );
    }

</script>
</html>
