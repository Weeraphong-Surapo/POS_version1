<?php 
session_start();
if(isset($_SESSION['login'])){
    echo '<script>window.location.href="index.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="admin, dashboard" />
	<meta name="author" content="DexignZone" />
	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Dompet : Payment Admin Template" />
	<meta property="og:title" content="Dompet : Payment Admin Template" />
	<meta property="og:description" content="Dompet : Payment Admin Template" />
	<meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title>ระบบ ขายสินค้าหน้าร้าน</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png" />
    <link href="./css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="images/logo-full.png" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4">เข้าสู่ระบบ</h4>
                                    <form action="" id="formLogin">
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>ชื่อผู้ใช้</strong></label>
                                            <input type="text" class="form-control" id="username" placeholder="ชื่อผู้ใช้ *">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>รหัสผ่าน</strong></label>
                                            <input type="password" class="form-control" id="password" placeholder="รหัสผ่าน *">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/dlabnav-init.js"></script>
	
</body>
</html>
<script>
    $('#formLogin').submit((e)=>{
        e.preventDefault();
        let fd = new FormData();
        let username = $('#username').val();
        let password = $('#password').val();
        fd.append('username',username);
        fd.append('password',password);
        fd.append('login',1);
        let option = {
            url:'controller/action.php',
            type:'post',
            data:fd,
            contentType: false,
            processData: false,
            success:(res)=>{
                if(res == 0){
                    AlertSwal('ไม่พบชื่อผู้ใช้งานนนี้','error')
                }else if(res == 1){
                    $('#password').val('')
                    AlertSwal('รหัสผ่านไม่ถูกต้อง','error')
                }else if(res == 2){
                    AlertSwal('เข้าสู่ระบบสำเร็จ','success')
                    setTimeout(()=>{location.reload()},700)
                }
            }
        }
        $.ajax(option)
    })

    function AlertSwal(title,type) {
		        Swal.fire(
		            title,
		            '',
		            type
		        )
            
		    }
</script>