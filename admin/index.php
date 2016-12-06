<html>
	<head>
	
  <link rel="icon" type="image/png" href="../data/favicon.png">
<link href="../jquery-ui-1.8.1.custom/css/custom-theme/jquery-ui-1.8.1.custom.css" rel="stylesheet" type="text/css" />
<script src="../jquery-ui-1.8.1.custom/js/jquery-1.4.2.min.js"></script>
<script src="../jquery-ui-1.8.1.custom/js/jquery-ui-1.8.1.custom.min.js"></script>
<script src="../tinymce/tinymce.min.js"></script>
<script src="../fontawesome-iconpicker-1.2.2/dist/js/fontawesome-iconpicker.min.js"></script>
  <title>Admin SMAN 2 Malang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->

  <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../ionicons-2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../dist/css/admin.css">

<?php
	include "../config/conn.php";
	
	error_reporting(0);
	session_start();
	
	function acak($jum, $tipe){
		$dat=array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
		$data="";
		for($i=0;$i<$jum;$i++){
			$data .= $dat[rand(0,35)];
		}
		if($tipe=="gbr"){
			$data1=mysqli_num_rows(mysqli_query($con, "SELECT URL FROM DATA_FILES WHERE URL'".$data.".jpg' OR URL_GBR'".$data.".jpeg' OR URL_GBR'".$data.".png'"));
		}
		else if($tipe=="pdf"){
			$data1=mysqli_num_rows(mysqli_query($con, "SELECT URL FROM DATA_FILES WHERE URL'".$data.".pdf'"));
		}
		else if($tipe=="vid"){
			$data1=mysqli_num_rows(mysqli_query($con, "SELECT URL FROM DATA_FILES WHERE URL'".$data.".mp4'"));
		}
		else if($tipe=="html"){
			$data1=mysqli_num_rows(mysqli_query($con, "SELECT URL FROM DATA_FILES WHERE URL'".$data.".html'"));
		}
		else if($tipe=="flash"){
			$data1=mysqli_num_rows(mysqli_query($con, "SELECT URL FROM DATA_FILES WHERE URL'".$data.".swf'"));
		}
				
		if($data1>0){
			acak($jum, $tipe);
		}else{
			return $data;
		}		
	}
	
	if(empty($_SESSION['LOGGED'])){
		include("login.php");
	}else{
		if($_GET['page']=="logout"){
			session_unset();
			session_destroy();
			echo "<script>document.location='./'</script>";
		}else{
			include("main.php");	
		}
	}
?>
	
</html>