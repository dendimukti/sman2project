<?php
	include "config/conn.php";
//anim@inagata.com
//an46smart@gmail.com	
//	mkdir("data	/a/b/c", 0700, true);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="./data/favicon.png">
  
  <title>SMAN 2 Malang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="ionicons-2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!--  AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

	<link rel="stylesheet" href="dist/css/public.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <style type="text/css">
  	.teks .futer{
		font-family: Source Sans Pro;
		font-size: 16px;
		font-weight: 600;
		font-style: normal;
		font-stretch: normal;
		line-height: 1.5;
		text-align: center;
		color: #1e282c;
		padding-left: 200px;
		padding-right: 200px;
	}
	.judul{
		width: 399px;
		height: 24px;
		font-family: Source Sans Pro;
		font-size: 36px;
		font-weight: 600;
		font-style: normal;
		font-stretch: normal;
		line-height: 1;
		text-align: center;
		color: #1e282c;
	}
    h1 {
      font-size: 44pt;
      font-weight: 600;
      color: #1e282c;
    }
    h2 {
      font-size: 55px;
      opacity: 0.9;
      color: rgba(30, 40, 44, 0.9);
    }
    .skin-green-light .main-header .logo {
    	background-color: #e5f3e9;
	    color: #000000;
    }
    .user-panel {
    	padding: 0;
    }
    .user-panel>.info {
        padding: 0;
        left: 45px;
        font-size: 10pt;
        margin-top: 8px;
    }
	a{
	    color: #00a65a; 
	    text-decoration: none;
	}
	a:hover{
	    color: #38db4e; 
	    text-decoration: none;
	}
	.main-header .logo {
	    -webkit-transition: width .3s ease-in-out;
	    -o-transition: width .3s ease-in-out;
	    transition: width .3s ease-in-out;
	    display: block;
	    float: left;
	    height: 50px;
	    font-size: 20px;
	    line-height: 50px;
	    text-align: center;
	    width: 230px;
	    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	    padding: 0 10px;
	    font-weight: 300;
	    overflow: hidden;
	}
	.sidebar-mini.sidebar-collapse .sidebar-menu>li:hover>a>span:not(.pull-right), .sidebar-mini.sidebar-collapse .sidebar-menu>li:hover>.treeview-menu {
	    display: block !important;
	    position: absolute;
	    width: 250px;
	    left: 50px;
	}
	
    .skin-green-light .sidebar-menu>li:hover>a, .skin-green-light .sidebar-menu>li.active>a {
	    color: #2c3b41;
	    background: #f9fafc;
	    border-left-color: #00a65a;
	}
	.skin-green-light .sidebar-menu>li>.treeview-menu {
	    background: #e5f3e9;
	}
	.skin-green-light .main-header .logo:hover {
	    background-color: #f9fafc;
	}
	.main-footer {
	    background: #fff;
	    padding: 10px 15px 30px 15px;
	    color: #444;
	    border-top: 1px solid #d2d6de;
	}
	/*
	.skin-green-light .main-header .logo {
	    background-color: #f9fafc;
	    color: #000000;
	}*/
</style>

<script type="text/javascript">

var tim = 0;
var wkt = 300000;			// 5 minutes	#	1 Sec = 1000	//300000
var waktu = wkt;
var durtime = 0;
var curtime = 0;
var rmntime = 0;
var statepause=true;
function reload(){
	if(statepause){
		window.location.replace('./');	
	}
	else{
		statepause=true;
		normcanceltimer();
	}
}

function beforeload() {
	//if(!statepause)	alert(wkt);	
	tim = setTimeout("reload();",waktu);
}

function myFunc(state, dt, ct, seek){
	var vid = state;
	var seeking = seek.toString();
	durtime = (parseFloat(dt) * 1000).toString();
	curtime = (parseFloat(ct) * 1000).toString();
	rmntime = parseInt(durtime-curtime);
	//alert("Pause: "+vid+"\nSeeking: "+vid+"\nDurasi: "+durtime+"\nCurTime: "+curtime+"\nRemainTime: "+rmntime);
	
	if(vid){
		waktu = wkt;
		statepause=true;
		canceltimer();	
	}else{
		waktu=wkt+rmntime;
		statepause=false;
		canceltimer();	
	}
}

function canceltimer() {
	window.clearTimeout(tim);  // cancel the timer on each mousemove/click
	beforeload();  // and restart it		
}

function normcanceltimer(){
	if(statepause){
		waktu = wkt;
		canceltimer();
	}
}

function changeval(data){
	var teks = data.toString();
	//alert(teks);
	if(teks=="Full Screen"){
		document.getElementByClassName("btn btn-success").value="Exit Full Screen";
	}else{
		document.getElementByClassName("btn btn-success").value="Full Screen";
	}
}
</script>
</head>
<body class="hold-transition skin-green-light fixed sidebar-mini" onclick="normcanceltimer()" onmouseover="normcanceltimer()" onkeypress="normcanceltimer()">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="./" class="logo">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="data/logos2.png" style="width: 30px;" alt="User Image">
        </div>
        <div class="pull-left info">
          <p style="text-align: left;line-height: 19px;color: #000000;">Integrated Data Service<br><span style="color: #000000;font-size: 9pt;font-weight: 100;">SMA N 2 Malang</span></p>
        </div>
      </div>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      	</a>
      	    
	    <div class="navbar-custom-menu">
	    	<ul class="nav navbar-nav">
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-clock-o"></i> &nbsp; 
		<?php
			$today = getdate();
			$hari=array("", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
			$bulan=array("", "Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
			echo $hari[$today['wday']].", ".$today['mday']." ".$bulan[$today['mon']]." ".$today['year'];
			
		?>
			</a>
          </li>
          <li> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</li>
        </ul>
	    </div>
    </nav>
    
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">  
  <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
<?php

function menu($content, $level, $parent, $con){
    $que2=mysqli_query($con, "SELECT * FROM MENU WHERE LEVEL='".$level."' AND PARENT='".$parent."' ORDER BY URUTAN ASC");
    $jum=mysqli_num_rows($que2);
    if($jum>0){
		echo '
		<ul class="treeview-menu">';
		while($data=mysqli_fetch_assoc($que2)){
			if($data['CONTENT']==1)
				$link='./?id='.$data['ID_MENU'];
			else
				$link='#';
				
			echo '
			<li>
				<a href="'.$link.'">
					<i class="fa '.$data['LOGO'].'"></i> '.$data['NAMA'];
				    if($data['CONTENT']==0){
						echo '
						<span class="pull-right-container">
				        	<i class="fa fa-angle-left pull-right"></i>
				        </span>';
					}
			    echo '
				</a>';
				menu($data['CONTENT'], ($level+1), $data['ID_MENU'], $con);
		    echo '
			</li>';
		}
		echo '
		</ul>';
	}
	return;	
}
	
$que1=mysqli_query($con, "SELECT * FROM MENU WHERE LEVEL='1' AND ID_MENU>0 ORDER BY URUTAN ASC");
while($data=mysqli_fetch_assoc($que1)){
	//redirect('.$data['ID_MENU'].');
	if($data['CONTENT']==1)
		$link='./?id='.$data['ID_MENU'];
	else
		$link='#';
	
	echo '
	<li class="treeview">
    	<a href="'.$link.'">';
		echo '
			<i class="fa '.$data['LOGO'].'"></i><span> '.$data['NAMA'].'</span>';        
	
		if($data['CONTENT']==0){
			echo '
			<span class="pull-right-container">
	        	<i class="fa fa-angle-left pull-right"></i>
			</span>';
		}
		echo '
		</a>';
    $max=mysqli_fetch_assoc(mysqli_query($con, "SELECT MAX(LEVEL) AS LV FROM MENU"));
	$max=$max['LV'];
    menu($data['CONTENT'], 2, $data['ID_MENU'], $con);
	echo '
	</li>';
}

?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->

      <div class="row">
        <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">               
                <!-- /.col -->
              <!-- /.row -->
              <center>
<?php
if(isset($_REQUEST['id'])){
	$idmenu=$_REQUEST['id'];
	$que=mysqli_query($con, "SELECT * FROM DATA_FILES WHERE ID_MENU='$idmenu' ORDER BY URUTAN ASC");
	//echo "<h1>".."</h1>"
	$jenis="teks";
	while($datafile=mysqli_fetch_assoc($que)){
		if($datafile['JENIS']=="teks"){
			echo "<br>";
			echo "<div class='teks'>".$datafile['KET']."</div><br><br><br>";
		}
		else if($datafile['JENIS']=="link"){
			echo "<br>";
			echo "<a href='".$datafile['KET']."'><h3>".$datafile['NAMA']."</h3></a><br><br><br>";
		}
		else if($datafile['JENIS']=="vid"){
			echo "<div class='judul'>".$datafile['NAMA']."</div><br><br>";
			echo '<video controls class="vdeo" onplaying="myFunc(this.paused, this.duration, this.currentTime, this.seeking)" onpause="myFunc(this.paused, this.duration, this.currentTime, this.seeking)">
					  <source src="data/vid/'.$datafile['URL'].'" type="video/mp4">
					Your browser does not support the video tag.
				  </video> ';
			echo "<br><br><br>";
		}
		else if($datafile['JENIS']=="pdf"){
			echo "<div class='judul'>".$datafile['NAMA']."</div><br><br>";
			echo '<embed src="data/pdf/'.$datafile['URL'].'" width="100%" height="750" type="application/pdf"/>';
			echo '<br><br><br>';
		}
		else if($datafile['JENIS']=="gbr"){
			echo "<div class='judul'>".$datafile['NAMA']."</div><br><br>";
			echo "<img src='data/gbr/".$datafile['URL']."' class='gbr'/>
			<br><br><br>";
		}
		else if($datafile['JENIS']=="html"){
			echo "<div class='judul'>".$datafile['NAMA']."</div><br><br>";
			echo "<div class='rst'>";
			include "data/html/".$datafile['URL'];
			echo "</div><br><br><br>";
		}
		else if($datafile['JENIS']=="flash"){
			echo "<div class='judul'>".$datafile['NAMA']."</div><br><br>";
			echo '
			<object width="800" height="600" data="data/flash/'.$datafile['URL'].'"></object>
			<br><br>';
		}
	}              
}
else{
?>
<b><h1>INTEGRATED DATA SERVICE</h1></b>
<img src="data/logos2.png" style="width:214px;margin: 32px;">
<h2>SMA NEGERI 2 MALANG</h2>
<h3>Jalan Laksamana Laut RE Martadinata No. 84, Malang, Jawa Timur, Indonesia</h3>
<?php
}
mysqli_close($con);
?>
</center>
            <!-- ./box-body -->
            
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
          <!-- /.box -->
          <div class="row">
            <div class="col-md-6">
              <!-- DIRECT CHAT -->
              
              <!--/.direct-chat -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
              <!-- USERS LIST -->
              
              <!--/.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- TABLE: LATEST ORDERS -->
          
          <!-- /.box -->
        </div>
        <!-- /.col -->      
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right">
      <strong>Website Resmi SMAN 2 Malang <a href="http://smandua.com">http://smandua.com</a></strong>
    </div>
    <div class="pull-left">
		<strong>Copyright &copy; 2016 <a href="http://inagata.com">Inagata Technosmith</a>.</strong> All rights reserved.
	</div>
	
  </footer>
</div>
</div>
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</style>
</body>
</html>
