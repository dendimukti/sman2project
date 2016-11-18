<?php

function delfiles($del){
	$que=mysql_query("SELECT URL FROM DATA_FILES WHERE ID_MENU='$del'");
	while($datafile=mysql_fetch_assoc($que)){				
		if($jenis=="pdf"){
			$file_to_delete = '../data/pdf/'.$datafile['URL'];
			unlink($file_to_delete);						
		}
		else if($jenis=="vid"){
			$file_to_delete = '../data/vid/'.$datafile['URL'];
			unlink($file_to_delete);							
		}
		else if($jenis=="gbr"){
			$file_to_delete = '../data/gbr/'.$datafile['URL'];
			unlink($file_to_delete);							
		}					
	}
	mysql_query("DELETE FROM DATA_FILES WHERE ID_MENU='$del'");
}

	extract($_GET);
	if(!empty($do)){		
		$queid=mysql_query("SELECT LEVEL, PARENT, URUTAN FROM MENU WHERE ID_MENU='$id'");
		$dataid=mysql_fetch_assoc($queid);
		$level=$dataid['LEVEL'];
		$parent=$dataid['PARENT'];
		$urutan=$dataid['URUTAN'];
//		echo "level:".$level." - parent:".$parent." - urutan:".$urutan."<br>";
		if($do=="up"){
			$quedo=mysql_query("SELECT ID_MENU, URUTAN FROM MENU WHERE PARENT='$parent' AND LEVEL='$level' AND URUTAN<'$urutan' ORDER BY URUTAN DESC LIMIT 1");
			$datado=mysql_fetch_assoc($quedo);
			$idup=$datado['ID_MENU'];
			$urutanup=$datado['URUTAN'];
//			echo "idup:".$idup." - urutanup:".$urutanup."<br>";
			mysql_query("UPDATE MENU SET URUTAN='$urutan' WHERE ID_MENU='$idup'");
			mysql_query("UPDATE MENU SET URUTAN='$urutanup' WHERE ID_MENU='$id'");
		}
		else if($do=="down"){			
			$quedo=mysql_query("SELECT ID_MENU, URUTAN FROM MENU WHERE PARENT='$parent' AND LEVEL='$level' AND URUTAN>'$urutan' ORDER BY URUTAN ASC LIMIT 1");
			$datado=mysql_fetch_assoc($quedo);
			$iddown=$datado['ID_MENU'];
			$urutandown=$datado['URUTAN'];
//			echo "iddown:".$iddown." - urutandown:".$urutandown."<br>";
			mysql_query("UPDATE MENU SET URUTAN='$urutan' WHERE ID_MENU='$iddown'");
			mysql_query("UPDATE MENU SET URUTAN='$urutandown' WHERE ID_MENU='$id'");
		}	
		echo "<script>document.location='./';</script>";
	}
	
	function movemenu($id_menu, $level){
		$level=$level+1;
		$queun=mysql_query("SELECT * FROM MENU WHERE PARENT='$id_menu'");
		while($dataun=mysql_fetch_assoc($queun)){
			uncategorized($dataun['ID_MENU'], ($level));			
		}
		mysql_query("UPDATE MENU SET LEVEL='$level' WHERE PARENT='$id_menu'");
		//echo "UPDATE MENU SET LEVEL='$level' WHERE PARENT='$id_menu'<br>";
	}
	
	if(!empty($del)){
		$datadel=mysql_fetch_assoc(mysql_query("SELECT * FROM MENU WHERE ID_MENU='$del'"));
		if($datadel['CONTENT']>0){
			mysql_query("DELETE FROM MENU WHERE ID_MENU='$del'");
			delfiles($del);			
		}else{
			mysql_query("DELETE FROM MENU WHERE ID_MENU='$del'");
			
			$queun=mysql_query("SELECT * FROM MENU WHERE PARENT='$del'");
			while($dataun=mysql_fetch_assoc($queun)){
				movemenu($dataun['ID_MENU'], 3);
			}
			mysql_query("UPDATE MENU SET PARENT='-1', LEVEL='2' WHERE PARENT='$del'");
		}
		echo "<script>document.location='./';</script>";
	}
	
	if(isset($_POST['addmenu'])){
		$queurutan=mysql_query("SELECT MAX(URUTAN) AS NO FROM MENU WHERE PARENT='$cbparent' AND ID_MENU>0");
		$urutan=mysql_fetch_assoc($queurutan);
		$urutan=$urutan['NO']+1;
		extract($_POST);
		if(empty($title)){
			echo "<script type='text/javascript'>alert('Title Harus Di Isi');</script>";
		}else{
			if($cbcontent==0){
				mysql_query("INSERT INTO MENU VALUES ('','$title','$cbicon','$cblevel','$cbparent','$cbcontent','','$urutan','$ket')");
			}else{
				mysql_query("INSERT INTO MENU VALUES ('','$title','$cbicon','$cblevel','$cbparent','$cbcontent','','$urutan','$ket')");
				$quedata=mysql_query("SELECT MAX(ID_MENU) AS ID FROM MENU");
				$idmenu=mysql_fetch_assoc($quedata);
				$idmenu=$idmenu['ID'];
				$confirm="";
				for($i=0; $i<count($_POST['jenis']); $i++){
					$jns = $_POST['jenis'][$i];
					$name = $_POST['name'][$i];
					$desc = $_POST['desc'][$i];
					
					if($jns!="teks"){
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
					        mysql_query("INSERT INTO DATA_FILES VALUES('', 'pdf', '$idmenu', '$name', '$url', '$desc', '".($i+1)."')");
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
					        mysql_query("INSERT INTO DATA_FILES VALUES('', 'gbr', '$idmenu', '$name', '$url', '$desc', '".($i+1)."')");
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
					        mysql_query("INSERT INTO DATA_FILES VALUES('', 'vid', '$idmenu', '$name', '$url', '$desc', '".($i+1)."')");
							$confirm.="\n1 Video have been uploaded,";
					    } else {
							$confirm.="\n1 Video failed to upload,";
					    }
					}					
					else if($jns=="teks"){
					    mysql_query("INSERT INTO DATA_FILES VALUES('', 'teks', '$idmenu', '$name', '', '$desc', '".($i+1)."')");
						$confirm.="\n1 text data have been uploaded,";
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
		
		$queurutan=mysql_query("SELECT MAX(URUTAN) AS NO FROM MENU WHERE PARENT='$cbparent' AND ID_MENU>0");
		$urutan=mysql_fetch_assoc($queurutan);
		$urutan=$urutan['NO']+1;
		
		$queid=mysql_query("SELECT LEVEL, PARENT FROM MENU WHERE ID_MENU='$idmenu'");
		$dataid=mysql_fetch_assoc($queid);
		$level=$dataid['LEVEL'];
		$parent=$dataid['PARENT'];
		if($level!=$cblevel){
			$level=$cblevel+1;
			$quemv=mysql_query("SELECT * FROM MENU WHERE PARENT='$idmenu'");
//			echo "SELECT * FROM MENU WHERE PARENT='$idmenu'";
			while($datamv=mysql_fetch_assoc($quemv)){
				movemenu($datamv['ID_MENU'], $level);
			}
			mysql_query("UPDATE MENU SET LEVEL='$level' WHERE PARENT='$idmenu'");
			//echo "UPDATE MENU SET LEVEL='$level' WHERE PARENT='$idmenu'<br>";
		}
		
		mysql_query("UPDATE MENU SET NAMA='$title', LOGO='$cbicon', LEVEL='$cblevel', PARENT='$cbparent', URUTAN='$urutan', CONTENT='$cbcontent', KET='$ket' WHERE ID_MENU='$idmenu'");
		
		if($cbcontent==0){
			delfiles($idmenu);
		}else{
			$queurutan=mysql_query("SELECT MAX(URUTAN) AS NO FROM DATA_FILES WHERE ID_MENU='$idmenu'");
			$urutan=mysql_fetch_assoc($queurutan);
			$no=$urutan['NO'];
			for($i=0; $i<count($_POST['jenis']); $i++){
				$jns = $_POST['jenis'][$i];
				$name = $_POST['name'][$i];
				$desc = $_POST['desc'][$i];
				$urutan=$no+$i+1;
				if($jns!="teks"){
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
				        mysql_query("INSERT INTO DATA_FILES VALUES('', 'pdf', '$idmenu', '$name', '$url', '$desc', '".($urutan)."')");
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
				        mysql_query("INSERT INTO DATA_FILES VALUES('', 'gbr', '$idmenu', '$name', '$url', '$desc', '".($urutan)."')");
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
				        mysql_query("INSERT INTO DATA_FILES VALUES('', 'vid', '$idmenu', '$name', '$url', '$desc', '".($urutan)."')");
						$confirm.="\n1 Video have been uploaded,";
				    } else {
						$confirm.="\n1 Video failed to upload,";
				    }
				}					
				else if($jns=="teks"){
				    mysql_query("INSERT INTO DATA_FILES VALUES('', 'teks', '$idmenu', '$name', '', '$desc', '".($urutan)."')");
					$confirm.="\n1 text data have been uploaded,";
				}
			}
			//echo "<script>alert('".$confirm."');</script>";				
		}
		echo "<script>document.location='./?id=".$idmenu."';</script>";	
	}

?>

<a href="./?page=logout">Log Out</a>
<br><br>
<script type="text/javascript">
	
	function updkonten(data){
		$("#konten").fadeOut();
		var id = parseInt(data);
	    $.ajax({
	        url: "ajax.php",
	        data: "idmenu="+id,
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
		$("#cbparent").fadeOut();
	    $.ajax({
	        url: "ajax.combo.parent.php?level=" + level,
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
		tinymce.init({selector:'textarea'});
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
		setTimeout(styleTextarea, 1000)		
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
	
	$(document).ready(function(){
		updkonten(<?php if($_GET['id']>0) 
							echo $_GET['id'];
						else
							echo "0";
			?>);
		//pakaikonten(0);
	});
	
</script>

<?php
	function menu($content, $level, $parent){
	    $que2=mysql_query("SELECT * FROM MENU WHERE LEVEL='".$level."' AND PARENT='".$parent."' ORDER BY URUTAN ASC");
	    $jum=mysql_num_rows($que2);	
	    if($jum>0){
			echo '<ul>';
			$n=1;
			while($data=mysql_fetch_assoc($que2)){
				echo '<li>'.$data['NAMA'].' ';		
				echo '<a href="#" onclick="updkonten('.$data['ID_MENU'].')"><img src="../plugins/ckeditor/skins/moono/images/refresh.png"/></a> ';
				if($n>1)
					echo '<a href="./?do=up&id='.$data['ID_MENU'].'"><img src="../plugins/datatables/images/sort_asc.png"/></a> ';
				if($n<$jum)
					echo '<a href="./?do=down&id='.$data['ID_MENU'].'"><img src="../plugins/datatables/images/sort_desc.png"/></a> ';
				
				if($data['CONTENT']==0){
					menu($data['CONTENT'], ($level+1), $data['ID_MENU']);
				}
				echo '</i>';
				$n++;
			}
			echo '</ul>';
		}
		return;	
	}
?>
<table width="100%" border="1">
	<tr valign="top">
		<td width="30%">
<?php
	echo '<ul style="list-style-type:square">';
	$que1=mysql_query("SELECT * FROM MENU WHERE LEVEL='1' ORDER BY URUTAN ASC");
	$tot=mysql_num_rows($que1);
	$n=1;
	while($data=mysql_fetch_assoc($que1)){
		echo '<li>'.$data['NAMA'].' ';
		if($data['ID_MENU']>0){ 
			echo '<a href="#" onclick="updkonten('.$data['ID_MENU'].')"><img src="../plugins/ckeditor/skins/moono/images/refresh.png"/></a> ';
			if($n>1)
				echo '<a href="./?do=up&id='.$data['ID_MENU'].'"><img src="../plugins/datatables/images/sort_asc.png"/></a> ';
			if($n<$tot-1)
				echo '<a href="./?do=down&id='.$data['ID_MENU'].'"><img src="../plugins/datatables/images/sort_desc.png"/></a> ';
		}
        $max=mysql_fetch_assoc(mysql_query("SELECT MAX(LEVEL) AS LV FROM MENU"));
        $max=$max['LV'];        
        menu($data['CONTENT'], 2, $data['ID_MENU']);
		echo '</li>';
		$n++;
	}
	echo '</ul>';
?>
	<input type="button" value="Add New Menu" onclick="updkonten(0)"/>
		</td>
		<td>
			<div id="konten">
			</div>
		</td>
	</tr>
</table>