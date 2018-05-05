<?php
require('core/libraries.php');
require('core/renderer/barsAndFooter.php');
require('core/model/Service.php');
require('core/db_config.php');
require('core/getService.php');
include 'core/renderer/header_inc.php';
$page_title = 'ลงทะเบียน';
setTitle($page_title);
loadMaterialDashboardLibraries();
loadJQuery();
$service_id = $_SESSION['service_id'];
$service = loadService($service_id);
?>
</head>
<body>
<div class="wrapper">
    <div class="sidebar" data-color="azure" data-background-color="white">
        <div class="logo">';
            <a href="login.php" class="simple-text"><?php echo $GLOBALS['easypets'];?></a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">
                        <i class="material-icons">undo</i><p>กลับไปหน้าแรก</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <?php drawNavBar($page_title); ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title">สร้างอีเมลล์</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <!--Email & password-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">อีเมลล์</label>
                                            <input id="email" name="email" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">รหัสผ่าน</label>
                                            <input id="password" name="password" type="password" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">ยืนยันรหัสผ่าน</label>
                                            <input id="recheck-password" name="password" type="password" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <button id="submit" type="button" class="btn btn-info pull-right">ยืนยัน</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php drawFooter(); ?>
    </div>
</div>

</body>
<?php
loadFirebaseLibraries();
?>
<script>

    function validateEmail(){
        let email = $('#email').val();
        if(!(email.includes("@") && email.includes(".") )) {
            alert("โปรดกรอกอีเมลล์ที่ถูกต้อง");
            return false;
        }
        return true;
    }

    function validatePassword(){
        let password = $('#password').val();
        if(password.length < 8){
            alert("พาสเวิร์ดต้องมีความยาวมากกว่า 8 ตัวอักษร");
            return false;
        }
        return true;
    }

    function validateConfirmPassword() {
        let password = $('#password').val();
        let confirmPassword = $('#recheck-password').val();
        if(password !== confirmPassword) {
            alert("พาสเวิร์ดกับการยืนยันพาสเวิร์ดไม่ตรงกัน");
            return false;
        }
    }

    $('#email').change(function () {
        validateEmail();
    });

    $('#password').change(function () {
        validatePassword();
    });

    $('#recheck-password').change(function () {
        validateConfirmPassword();
    });

    $('#submit').click(function () {
        if(validateEmail() && validatePassword()){
            signIn();
        }
    });

    function signIn(){
        const email = $('#email').val();
        const pass = $('#password').val();
        const auth = firebase.auth();

        const promise = auth.createUserWithEmailAndPassword(email, pass);
        promise.then(user => console.log(user)).catch(e => console.log(e.message));
    }

    firebase.auth().onAuthStateChanged(firebaseUser => {
        if(firebaseUser){
            console.log(firebaseUser);
            window.location.href = "register.php";
        }else console.log("not logged in");
    });

</script>
</html>
