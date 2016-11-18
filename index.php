<?php
	include "config/conn.php";
//anim@inagata.com
//an46smart@gmail.com	

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SMAN 2 Malang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
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
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
<table cellpadding="10">
	<tr>
		<td width="30%" height="100%"><img src="data/logos2.png"/ style="width: 35px;margin-left: 15px;"> &nbsp;&nbsp;</td>
		<td>
			<font color="#FFFFF">
				<b>Integrated Data Service</b><br>
				SMA Negeri 2 Malang
			</font>
		</td>
	</tr>
</table>
  <br>
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
<?php

	function menu($content, $level, $parent){
	    $que2=mysql_query("SELECT * FROM MENU WHERE LEVEL='".$level."' AND PARENT='".$parent."' ORDER BY URUTAN ASC");
	    $jum=mysql_num_rows($que2);
	    if($jum>0){
			echo '<ul class="treeview-menu">';
			while($data=mysql_fetch_assoc($que2)){				
				if($data['CONTENT']==1)
					$link='./?id='.$data['ID_MENU'];
				else
					$link='#';
					
				echo '<li class="active"><a href="'.$link.'">
				<i class="fa fa-circle-o"></i> '.$data['NAMA'];
			    if($data['CONTENT']==0){
					echo '<span class="pull-right-container">
			        	<i class="fa fa-angle-left pull-right"></i>
			            </span>';
			        menu($data['CONTENT'], ($level+1), $data['ID_MENU']);
				}
			    echo '</a></li>';
			}
			echo '</ul>';
		}
		return;	
	}
	
	$que1=mysql_query("SELECT * FROM MENU WHERE LEVEL='1' AND ID_MENU>0 ORDER BY URUTAN ASC");
	while($data=mysql_fetch_assoc($que1)){
		//redirect('.$data['ID_MENU'].');
		if($data['CONTENT']==1)
			$link='./?id='.$data['ID_MENU'];
		else
			$link='#';
		
		echo '<li class="treeview active">
          <a href="'.$link.'">';
        echo '<i class="fa '.$data['LOGO'].'"></i>'.$data['NAMA'];        
        
		if($data['CONTENT']==0){
			echo '<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>';
		}
        echo '</a>';
        $max=mysql_fetch_assoc(mysql_query("SELECT MAX(LEVEL) AS LV FROM MENU"));
        $max=$max['LV'];
        
        menu($data['CONTENT'], 2, $data['ID_MENU']);
		
		echo '</li>';
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
	$que=mysql_query("SELECT * FROM DATA_FILES WHERE ID_MENU='$idmenu' ORDER BY URUTAN ASC");
	$jenis="teks";
	while($datafile=mysql_fetch_assoc($que)){
		if($datafile['JENIS']=="teks"){
			echo " ".$datafile['KET']."<br><br>";
		}
		else if($datafile['JENIS']=="vid"){
			echo '<video controls>
					  <source src="data/vid/'.$datafile['URL'].'" type="video/mp4">
					Your browser does not support the video tag.
				  </video> ';
			echo "<br><br>";
		}
		else if($datafile['JENIS']=="pdf"){
			//echo " <a href='data/pdf/".$datafile['URL']."'>(PDF) ".$datafile['NAMA']."</a><br><br>";
			echo '<embed src="data/pdf/'.$datafile['URL'].'" width="80%" height="800" /><br><br>';
		}
		else if($datafile['JENIS']=="gbr"){
			echo " <img src='data/gbr/".$datafile['URL']."'/><br><br>";
		}
	}              
}
else{
?>
<b><h1>INTEGRATED DATA SERVICE</h1></b>
<img src="data/logos2.png" style="width:214px;margin: 32px;">
<h2>SMA NEGERI 2 MALANG</h2>
<?php
}
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
    <div class="pull-right hidden-xs">
      
    </div>
    <strong>Copyright &copy; 2016 <a href="http://inagata.com">Inagata Technosmith</a>.</strong> All rights
    reserved.
  </footer>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.js"></script>
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
</body>
</html>
