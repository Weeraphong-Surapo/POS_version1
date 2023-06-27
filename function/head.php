<?php 
session_start();
if(!isset($_SESSION['employee_id'])){
	echo '<script>window.location.href="login.php"</script>';
}
include('config/connect.php');
$emp = $conn->query("SELECT * FROM tb_employee WHERE employee_id = '$_SESSION[employee_id]'");
$row_emp = $emp->fetch_array();
$name = $row_emp['fname'].' '.$row_emp['lname'];
$username = $row_emp['username'];
$img = $row_emp['user_img'];

$shop = $conn->query("SELECT * FROM tb_shop");
$row_shop = $shop->fetch_array();
$shop_img = $row_shop['shop_img'];
$shop_name = $row_shop['shop_name'];
?>
<!DOCTYPE html>
<html lang="en">

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
	<title>ระบบ POS ขายสินค้า</title>

	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png" />
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
	<link href="./vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="waviy">
		   <span style="--i:1">กำ</span>
		   <span style="--i:2">ลั</span>
		   <span style="--i:3">ง</span>
		   <span style="--i:4">โ</span>
		   <span style="--i:5">ห</span>
		   <span style="--i:6">ล</span>
		   <span style="--i:7">ด</span>
		   <span style="--i:8">.</span>
		   <span style="--i:9">.</span>
		   <span style="--i:10">.</span>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">