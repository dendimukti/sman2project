<html>
	<head>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../fontawesome-iconpicker-1.2.2/dist/css/fontawesome-iconpicker.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../dist/css/admin.css">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
<!--	<div id="test">
		<textarea>Easy (and free!) You should check out our premium features.</textarea>
	</div>	-->
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
			$data1=mysql_num_rows(mysql_query("SELECT URL_GBR FROM DATA_GBR WHERE URL_GBR'".$data.".jpg' or URL_GBR'".$data.".jpeg' or URL_GBR'".$data.".png'"));
		}
		else if($tipe=="pdf"){
			$data1=mysql_num_rows(mysql_query("SELECT URL_PDF FROM DATA_PDF WHERE URL_PDF'".$data.".pdf'"));
		}
		else if($tipe=="vid"){
			$data1=mysql_num_rows(mysql_query("SELECT URL_VID FROM DATA_VID WHERE URL_VID'".$data.".mp4'"));
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
	</body>
</html>