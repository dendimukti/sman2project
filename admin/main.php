<?php
function cekhtml($data){
	$data=strip_tags($data);
	$data=str_replace("'","\'",$data);
	$data=str_replace('"','\"',$data);
	return $data;
}
function delfiles($del, $con){
	$que=mysqli_query($con ,"SELECT URL, JENIS FROM DATA_FILES WHERE ID_MENU='$del'");
	while($datafile=mysqli_fetch_assoc($que)){				
		if($datafile['JENIS']=="pdf"){
			$file_to_delete = '../data/pdf/'.$datafile['URL'];
			unlink($file_to_delete);
		}
		else if($datafile['JENIS']=="vid"){
			$file_to_delete = '../data/vid/'.$datafile['URL'];
			unlink($file_to_delete);
		}
		else if($datafile['JENIS']=="gbr"){
			$file_to_delete = '../data/gbr/'.$datafile['URL'];
			unlink($file_to_delete);
		}
		else if($datafile['JENIS']=="html"){
			$file_to_delete = '../data/html/'.$datafile['URL'];
			unlink($file_to_delete);
		}
		else if($datafile['JENIS']=="flash"){
			$file_to_delete = '../data/flash/'.$datafile['URL'];
			unlink($file_to_delete);
		}
	}
	mysqli_query($con ,"DELETE FROM DATA_FILES WHERE ID_MENU='$del'");
}
extract($_GET);
if(!empty($do)){		
	$queid=mysqli_query($con ,"SELECT LEVEL, PARENT, URUTAN FROM MENU WHERE ID_MENU='$id'");
	$dataid=mysqli_fetch_assoc($queid);
	$level=$dataid['LEVEL'];
	$parent=$dataid['PARENT'];
	$urutan=$dataid['URUTAN'];
//		echo "level:".$level." - parent:".$parent." - urutan:".$urutan."<br>";
	if($do=="up"){
		$quedo=mysqli_query($con ,"SELECT ID_MENU, URUTAN FROM MENU WHERE PARENT='$parent' AND LEVEL='$level' AND URUTAN<'$urutan' ORDER BY URUTAN DESC LIMIT 1");
		$datado=mysqli_fetch_assoc($quedo);
		$idup=$datado['ID_MENU'];
		$urutanup=$datado['URUTAN'];
//			echo "idup:".$idup." - urutanup:".$urutanup."<br>";
		mysqli_query($con ,"UPDATE MENU SET URUTAN='$urutan' WHERE ID_MENU='$idup'");
		mysqli_query($con ,"UPDATE MENU SET URUTAN='$urutanup' WHERE ID_MENU='$id'");
	}
	else if($do=="down"){			
		$quedo=mysqli_query($con ,"SELECT ID_MENU, URUTAN FROM MENU WHERE PARENT='$parent' AND LEVEL='$level' AND URUTAN>'$urutan' ORDER BY URUTAN ASC LIMIT 1");
		$datado=mysqli_fetch_assoc($quedo);
		$iddown=$datado['ID_MENU'];
		$urutandown=$datado['URUTAN'];
//			echo "iddown:".$iddown." - urutandown:".$urutandown."<br>";
		mysqli_query($con ,"UPDATE MENU SET URUTAN='$urutan' WHERE ID_MENU='$iddown'");
		mysqli_query($con ,"UPDATE MENU SET URUTAN='$urutandown' WHERE ID_MENU='$id'");
	}	
	echo "<script>document.location='./';</script>";
}
	
function movemenu($id_menu, $level, $con){
	$level=$level+1;
	$queun=mysqli_query($con ,"SELECT * FROM MENU WHERE PARENT='$id_menu'");
	while($dataun=mysqli_fetch_assoc($queun)){
		movemenu($dataun['ID_MENU'], ($level), $con);			
	}
	mysqli_query($con ,"UPDATE MENU SET LEVEL='$level' WHERE PARENT='$id_menu'");
}
	
if(!empty($del)){
	$datadel=mysqli_fetch_assoc(mysqli_query($con ,"SELECT * FROM MENU WHERE ID_MENU='$del'"));
	if($datadel['CONTENT']>0){
		mysqli_query($con ,"DELETE FROM MENU WHERE ID_MENU='$del'");
		delfiles($del, $con);			
	}else{
		mysqli_query($con ,"DELETE FROM MENU WHERE ID_MENU='$del'");
		
		$quemv=mysqli_query($con ,"SELECT * FROM MENU WHERE PARENT='$del'");
		while($datamv=mysqli_fetch_assoc($quemv)){ 
			movemenu($datamv['ID_MENU'], 2, $con);
		}
		mysqli_query($con ,"UPDATE MENU SET PARENT='-1', LEVEL='2' WHERE PARENT='$del'");
		
	}
	echo "<script>document.location='./';</script>";
}
	
if(isset($_POST['addmenu'])){
	$queurutan=mysqli_query($con ,"SELECT MAX(URUTAN) AS NO FROM MENU WHERE PARENT='$cbparent' AND ID_MENU>0");
	$urutan=mysqli_fetch_assoc($queurutan);
	$urutan=$urutan['NO']+1;
	extract($_POST);		
		
	if($cblevel=="1"){
		$cbicon="fa-home";
	}else{
		if($cbcontent=="1")
			$cbicon="fa-file";
		else
			$cbicon="fa-folder-o";
	}
		
	if(empty($title)){
		echo "<script type='text/javascript'>alert('Nama Menu Harus Di Isi');</script>";
	}else{
		if($cbcontent==0){
			mysqli_query($con ,"INSERT INTO MENU VALUES ('','$title','$cbicon','$cblevel','$cbparent','$cbcontent','','$urutan','$ket')");
		}else{
			mysqli_query($con ,"INSERT INTO MENU VALUES ('','$title','$cbicon','$cblevel','$cbparent','$cbcontent','','$urutan','$ket')");
			$quedata=mysqli_query($con ,"SELECT MAX(ID_MENU) AS ID FROM MENU");
			$idmenu=mysqli_fetch_assoc($quedata);
			$idmenu=$idmenu['ID'];
			$confirm="";
			for($i=0; $i<count($_POST['jenis']); $i++){
				$jns = cekhtml($_POST['jenis'][$i]);
				$name = cekhtml($_POST['name'][$i]);
				$desc = cekhtml($_POST['desc'][$i]);
				
				if($jns=="teks"){
				    mysqli_query($con ,"INSERT INTO DATA_FILES VALUES('', 'teks', '$idmenu', '$name', '', '$desc', '".($i+1)."')");
					$confirm.="\n1 text data have been uploaded,";
				}else{
					$data=$_FILES["data"]["name"][$i]; 
					$tmp_name=$_FILES["data"]["tmp_name"][$i];
				}
				if($jns=="pdf"){
					$url=acak(10,"pdf");
					$target_dir = "../data/pdf/";
					$target_file = $target_dir . basename($data);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				    $check = getimagesize($tmp_name);
				    if($imageFileType=="pdf") {
				    	$url.=".".$imageFileType;
				        move_uploaded_file($tmp_name, $target_dir.$url);
				        mysqli_query($con ,"INSERT INTO DATA_FILES VALUES('', 'pdf', '$idmenu', '$name', '$url', '$desc', '".($i+1)."')");
						$confirm.="\n1 PDF have been uploaded,";
				    } else {
						$confirm.="\n1 PDF failed to upload,";
				    }
				}
				else if($jns=="gbr"){
					$url=acak(10,"gbr");
					$target_dir = "../data/gbr/";
					$target_file = $target_dir . basename($data);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				    $check = getimagesize($tmp_name);
				    if($check) {
				    	$url.=".".$imageFileType;
				        move_uploaded_file($tmp_name, $target_dir.$url);
				        mysqli_query($con ,"INSERT INTO DATA_FILES VALUES('', 'gbr', '$idmenu', '$name', '$url', '$desc', '".($i+1)."')");
						$confirm.="\n1 Image have been uploaded,";
				    } else {
						$confirm.="\n1 Image failed to upload,";
				    }
				}
				else if($jns=="vid"){
					$url=acak(10,"vid");
					$target_dir = "../data/vid/";
					$target_file = $target_dir . basename($data);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				    $check = getimagesize($tmp_name);
				    if($imageFileType=="mp4" || $imageFileType=="mpg" || $imageFileType=="mpeg" || $imageFileType=="avi" || $imageFileType=="flv") {
				    	$url.=".".$imageFileType;
				        move_uploaded_file($tmp_name, $target_dir.$url);
				        mysqli_query($con ,"INSERT INTO DATA_FILES VALUES('', 'vid', '$idmenu', '$name', '$url', '$desc', '".($i+1)."')");
						$confirm.="\n1 Video have been uploaded,";
				    } else {
						$confirm.="\n1 Video failed to upload,";
				    }
				}					
				else if($jns=="html"){
					$url=acak(10,"html");
					$target_dir = "../data/html/";
					$target_file = $target_dir . basename($data);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				    $check = getimagesize($tmp_name);
				    if($imageFileType=="html") {
				    	$url.=".".$imageFileType;
				        move_uploaded_file($tmp_name, $target_dir.$url);
				        mysqli_query($con ,"INSERT INTO DATA_FILES VALUES('', 'html', '$idmenu', '$name', '$url', '$desc', '".($i+1)."')");
						$confirm.="\n1 HTML have been uploaded,";
				    } else {
						$confirm.="\n1 HTML failed to upload,";
				    }
				}					
				else if($jns=="flash"){
					$url=acak(10,"flash");
					$target_dir = "../data/flash/";
					$target_file = $target_dir . basename($data);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				    $check = getimagesize($tmp_name);
				    if($imageFileType=="swf") {
				    	$url.=".".$imageFileType;
				        move_uploaded_file($tmp_name, $target_dir.$url);
				        mysqli_query($con ,"INSERT INTO DATA_FILES VALUES('', 'flash', '$idmenu', '$name', '$url', '$desc', '".($i+1)."')");
						$confirm.="\n1 Flash have been uploaded,";
				    } else {
						$confirm.="\n1 Flash failed to upload,";
				    }
				}
			}
				//	alert('".$confirm."');
			echo "<script>
				document.location='./';</script>";
		}
	}
}
	
if(isset($_POST['editmenu'])){
	extract($_POST);
	$idmenu=$_POST['idmenu'];
	
	$queid=mysqli_query($con ,"SELECT LEVEL, PARENT FROM MENU WHERE ID_MENU='$idmenu'");
	$dataid=mysqli_fetch_assoc($queid);
	$level=$dataid['LEVEL'];
	$parent=$dataid['PARENT'];
				
	if($cblevel=="1"){
		$cbicon="fa-home";
		$cbparent="0";
	}else{
		if($cbcontent=="1")
			$cbicon="fa-file";
		else
			$cbicon="fa-folder-o";
	}
	
	if($level!=$cblevel){
		$level=$cblevel+1;
		$quemv=mysqli_query($con ,"SELECT * FROM MENU WHERE PARENT='$idmenu'");
		while($datamv=mysqli_fetch_assoc($quemv)){
			movemenu($datamv['ID_MENU'], $level, $con);
		}
		mysqli_query($con ,"UPDATE MENU SET LEVEL='$level' WHERE PARENT='$idmenu'");
				
		$queurutan=mysqli_query($con ,"SELECT MAX(URUTAN) AS NO FROM MENU WHERE PARENT='$cbparent' AND ID_MENU>0");
		$urutan=mysqli_fetch_assoc($queurutan);
		$urutan=$urutan['NO']+1;
		mysqli_query($con ,"UPDATE MENU SET NAMA='$title', LOGO='$cbicon', LEVEL='$cblevel', PARENT='$cbparent', URUTAN='$urutan', CONTENT='$cbcontent', KET='$ket' WHERE ID_MENU='$idmenu'");
	}else if(($level==$cblevel)&&($cbparent!=$parent)){
		$urutan=0;
		$queurutan=mysqli_query($con ,"SELECT MAX(URUTAN) AS NO FROM MENU WHERE PARENT='$cbparent' AND ID_MENU>0");
		$urutan=mysqli_fetch_assoc($queurutan);
		$urutan=$urutan['NO']+1;
		mysqli_query($con ,"UPDATE MENU SET NAMA='$title', LOGO='$cbicon', PARENT='$cbparent', CONTENT='$cbcontent', URUTAN='$urutan', KET='$ket' WHERE ID_MENU='$idmenu'");	
	}else{
		mysqli_query($con ,"UPDATE MENU SET NAMA='$title', LOGO='$cbicon', CONTENT='$cbcontent', KET='$ket' WHERE ID_MENU='$idmenu'");
	}
		
	if($cbcontent==0){
		delfiles($idmenu, $con);
	}else{
		$queurutan=mysqli_query($con ,"SELECT MAX(URUTAN) AS NO FROM DATA_FILES WHERE ID_MENU='$idmenu'");
		$urutan=mysqli_fetch_assoc($queurutan);
		$no=$urutan['NO'];
		for($i=0; $i<count($_POST['jenis']); $i++){
			$jns = cekhtml($_POST['jenis'][$i]);
			$name = cekhtml($_POST['name'][$i]);
			$desc = cekhtml($_POST['desc'][$i]);
			$urutan=$no+$i+1;
			
			if($jns=="teks"){
			    mysqli_query($con ,"INSERT INTO DATA_FILES VALUES('', 'teks', '$idmenu', '$name', '', '$desc', '".($urutan)."')");
				$confirm.="\n1 text data have been uploaded,<br>";
				//$confirm.="\n1 INSERT INTO DATA_FILES VALUES('', 'teks', '$idmenu', '$name', '', '$desc', '".($urutan)."')<br>";
			}else{
				$data=$_FILES["data"]["name"][$i]; 
				$tmp_name=$_FILES["data"]["tmp_name"][$i];
			}
			
			if($jns=="pdf"){
				$url=acak(10,"pdf");
				$target_dir = "../data/pdf/";
				$target_file = $target_dir . basename($data);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			    $check = getimagesize($tmp_name);
			    if($imageFileType=="pdf") {
			    	$url.=".".$imageFileType;
			        move_uploaded_file($tmp_name, $target_dir.$url);
			        mysqli_query($con ,"INSERT INTO DATA_FILES VALUES('', 'pdf', '$idmenu', '$name', '$url', '$desc', '".($urutan)."')");
					$confirm.="\n1 PDF have been uploaded,";
			    } else {
					$confirm.="\n1 PDF failed to upload,";
			    }
			}
			else if($jns=="gbr"){
				$url=acak(10,"gbr");
				$target_dir = "../data/gbr/";
				$target_file = $target_dir . basename($data);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			    $check = getimagesize($tmp_name);
			    if($check) {
			    	$url.=".".$imageFileType;
			        move_uploaded_file($tmp_name, $target_dir.$url);
			        mysqli_query($con ,"INSERT INTO DATA_FILES VALUES('', 'gbr', '$idmenu', '$name', '$url', '$desc', '".($urutan)."')");
					$confirm.="\n1 Image have been uploaded,";
			    } else {
					$confirm.="\n1 Image failed to upload,";
			    }
			}
			else if($jns=="vid"){
				$url=acak(10,"vid");
				$target_dir = "../data/vid/";
				$target_file = $target_dir . basename($data);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			    $check = getimagesize($tmp_name);
			    if($imageFileType=="mp4" || $imageFileType=="mpg" || $imageFileType=="mpeg" || $imageFileType=="avi" || $imageFileType=="flv") {
			    	$url.=".".$imageFileType;
			        move_uploaded_file($tmp_name, $target_dir.$url);
			        mysqli_query($con ,"INSERT INTO DATA_FILES VALUES('', 'vid', '$idmenu', '$name', '$url', '$desc', '".($urutan)."')");
					$confirm.="\n1 Video have been uploaded,";
			    } else {
					$confirm.="\n1 Video failed to upload,";
			    }
			}
			else if($jns=="html"){
				$url=acak(10,"html");
				$target_dir = "../data/html/";
				$target_file = $target_dir . basename($data);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			    $check = getimagesize($tmp_name);
			    if($imageFileType=="html") {
			    	$url.=".".$imageFileType;
			        move_uploaded_file($tmp_name, $target_dir.$url);
			        mysqli_query($con ,"INSERT INTO DATA_FILES VALUES('', 'html', '$idmenu', '$name', '$url', '$desc', '".($urutan)."')");
					$confirm.="\n1 HTML have been uploaded,";
			    } else {
					$confirm.="\n1 HTML failed to upload,";
			    }
			}
			else if($jns=="flash"){
				$url=acak(10,"flash");
				$target_dir = "../data/flash/";
				$target_file = $target_dir . basename($data);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			    $check = getimagesize($tmp_name);
			    if($imageFileType=="swf") {
			    	$url.=".".$imageFileType;
			        move_uploaded_file($tmp_name, $target_dir.$url);
			        mysqli_query($con ,"INSERT INTO DATA_FILES VALUES('', 'flash', '$idmenu', '$name', '$url', '$desc', '".($urutan)."')");
					$confirm.="\n1 Flash have been uploaded,";
			    } else {
					$confirm.="\n1 Flash failed to upload,";
			    }
			}
		}
			//echo "<script>alert('".$confirm."');</script>";				
	}
	//echo $confirm."<br>";
	//print_r($_POST['jenis']);
	echo "<script>document.location='./?id=".$idmenu."';</script>";	
}
?>
<script type="text/javascript">
	
	function updkonten(data){
		$("#konten").fadeOut();
		var id = data.toString();
		//alert(id);
	    $.ajax({
	        url: "ajax.php?idmenu="+id,
			type	:	"GET",
	        success: function(data){
	            $("#konten").html(data);
			    $("#konten").fadeIn(500);
	        }
	    });	    
	}
	function del(obj, jeniskonten, id){
		var jenis = jeniskonten.toString();
		var iddata = parseInt(id);		
		//alert(jenis+": "+iddata);
		$.ajax({
			url		:	"ajax.del.konten.php?jenis=" + jenis + "&id=" + iddata,
			type	:	"GET",
			success	:	function(text){				
				$(obj).parent().parent().html("");
			}
		});	
	}
	
	function changeparent(data){
		var level=parseInt(data);
		var idmenu = $("#idmenu").val();
		//alert("SELECT ID_MENU, NAMA FROM MENU WHERE LEVEL='' AND ID_MENU>0 AND CONTENT=0 AND ID_MENU!=''");
		$("#cbparent").fadeOut();
	    $.ajax({
	        url: "ajax.combo.parent.php?level=" + level + "&idmenu=" + idmenu,
			type:	"GET",
	        success: function(data){
	            $("#cbparent").html(data);
			    $("#cbparent").fadeIn(100);
	        }
	    });
	}
	
	function pakaikonten(data, id){
		var pakai = parseInt(data);
		var idmenu = parseInt(id);
		
		if(pakai==1){
			$.ajax({
				url		:	"ajax.pakai.konten.php?idmenu="+idmenu,
				type	:	"GET",
				success	:	function(text){
					$("#divtabel").html(text);
				}
			});	
		}
		else{
			$("#divtabel").html("");
		}
	}
	
	function styleTextarea(){
		tinymce.init({
		        mode : "textareas",
		        editor_selector : "mceEditor"
		});
	}
		
	function add(){
		var jenis = $("#jeniskonten").val();
		
		//tinymce.init({selector:'textarea'});
		//alert(jenis);
		$.ajax({
			url		:	"ajax.add.konten.php?jenis="+jenis,
			type	:	"GET",
			success	:	function(text){
				$("#table").append(text);
				}
			});
		setTimeout(styleTextarea, 1000);
	}
	
	function changeOrder(tipe, id, idmenu){
		var jenis = tipe.toString();
		var iddata = parseInt(id);
		var id_menu = parseInt(idmenu);
//		alert('jenis: '+jenis+'\nid data: '+iddata);
		$.ajax({
			url		:	"ajax.order.konten.php?tipe="+jenis+"&id="+iddata,
			type	:	"GET",
			success	:	function(text){
				pakaikonten('1', id_menu);
			}
		});		
	}
	
			
  	function redirect(id){
		var idmenu=id.toString();
		alert(idmenu);
		//document.location="./?id="+$idmenu;		
	}
  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">  
<div class="wrapper"> 
  <header class="main-header">

    <!-- Logo -->
    <a href="./" class="logo">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../data/logos2.png" style="width: 30px;margin-top: 5px;" alt="User Image">
        </div>
        <div class="pull-left info">
          <p style="text-align: left;line-height: 19px;">Integrated Data Service<br><span style="color: #95adb7;font-size: 9pt;font-weight: 100;">SMA N 2 Malang</span></p>
        </div>
      </div>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
   	<a class="pull-right btn btn-success" href="?page=logout" style="margin-right: 25px;top: 15px;position: relative;"><i class="fa fa-sign-out"></i>Keluar</a>
</nav>

  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">  
  <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->

<?php
	function menu($content, $level, $parent, $con){
	    $que2=mysqli_query($con ,"SELECT * FROM MENU WHERE LEVEL='".$level."' AND PARENT='".$parent."' ORDER BY URUTAN ASC");
	    $jum=mysqli_num_rows($que2);	
	    if($jum>0){
			echo '<ul class="treeview-menu">';
			$n=1;
			while($data=mysqli_fetch_assoc($que2)){				
				echo '<li class="active"><a href="#">
				<i class="fa '.$data['LOGO'].'"></i> '.$data['NAMA'];
						
				if($n>1){
					echo '<i class="fa fa-caret-up" aria-hidden="true" onclick="location.href=\'./?do=up&id='.$data['ID_MENU'].'\'"></i> ';
				}else{
					echo '<i class="fa fa-caret-up disabled" aria-hidden="true" onclick="javascript:void(0)"></i> ';
				}
				if($n<$tot-1){
					echo '<i class="fa fa-caret-down" aria-hidden="true" onclick="location.href=\'./?do=down&id='.$data['ID_MENU'].'\'"></i> ';
				}else{
					echo '<i class="fa fa-caret-down disabled" aria-hidden="true" onclick="javascript:void(0)"></i> ';
				}
				echo '&nbsp;&nbsp;&nbsp; <i class="fa fa-pencil" aria-hidden="true" onclick="updkonten('.$data['ID_MENU'].')"></i>';
				if($data['CONTENT']==0){					
					// echo '<span class="pull-right-container">
			  //       	<i class="fa fa-angle-left pull-right"></i>
			  //           </span>';
					menu($data['CONTENT'], ($level+1), $data['ID_MENU'], $con);
				}
				echo '</a></i>';
				$n++;
			}
			echo '</ul>';
		}
		return;	
	}
?>
      <ul class="sidebar-menu">
        <li class="header">
	        <div class="pull-left">
	          <h1>Daftar Menu</h1>
	        </div>
	        <div class="pull-right">
	          <button style="margin-top:5px;width: 136px;" type="button" class="btn btn-success" onclick="updkonten(0)">Tambah Menu</button>
	        </div>
		</li>
<?php
	$que1=mysqli_query($con ,"SELECT * FROM MENU WHERE LEVEL='1' ORDER BY URUTAN ASC");
	$tot=mysqli_num_rows($que1);
	$n=1;
	while($data=mysqli_fetch_assoc($que1)){
		echo '
		<li class="treeview active">
			<a href="#">
			<i class="fa '.$data['LOGO'].'"></i>'.$data['NAMA'].' ';
		if($data['ID_MENU']>0){ 
			if($n>1){
				echo '<i class="fa fa-caret-up" aria-hidden="true" onclick="location.href=\'./?do=up&id='.$data['ID_MENU'].'\'"></i> ';
			}else{
				echo '<i class="fa fa-caret-up disabled" aria-hidden="true" onclick="javascript:void(0)"></i> ';
			}
			if($n<$tot-1){
				echo '<i class="fa fa-caret-down" aria-hidden="true" onclick="location.href=\'./?do=down&id='.$data['ID_MENU'].'\'"></i> ';
			}else{
				echo '<i class="fa fa-caret-down disabled" aria-hidden="true" onclick="javascript:void(0)"></i> ';
			}
			echo '&nbsp;&nbsp;&nbsp; <i class="fa fa-pencil" aria-hidden="true" onclick="updkonten('.$data['ID_MENU'].')"></i>';
		}
		if($data['CONTENT']==0){
			// echo '<span class="pull-right-container">
   //            <i class="fa fa-angle-left pull-right"></i>
   //          </span>';  
        }
        echo '</a>';        
	    $max=mysqli_fetch_assoc(mysqli_query($con ,"SELECT MAX(LEVEL) AS LV FROM MENU"));
		$max=$max['LV'];        
        menu($data['CONTENT'], 2, $data['ID_MENU'], $con);
		echo '</li>';
		$n++;
	}
?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->

      <div class="row">
        <div class="col-md-12">
<?php	
	$nama="";
	$idmenu="";
	if(isset($_REQUEST['id'])){
		$idmenu=$_REQUEST['id'];
		$que=mysqli_query($con ,"SELECT * FROM MENU WHERE ID_MENU='$idmenu'");
		$data=mysqli_fetch_assoc($que);
		$nama=$data['NAMA'];
		$icon=$data['LOGO'];
		$level=$data['LEVEL'];
		$parent=$data['PARENT'];
		$content=$data['CONTENT'];
		$ket=$data['KET'];
	}			  
//	echo $nama;			  
?>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">               
                <!-- /.col -->
              </div>
              <!-- /.row -->
			<div id="konten">
			</div>    
				
            </div>
            <!-- ./box-body -->
            
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

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="../plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script type="text/javascript">
	updkonten('<?php if($_GET['id']>0) 
							echo $_GET['id'];
						else
							echo "0";
			?>');
</script>
</body>