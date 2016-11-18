<?php
	
	include("../config/conn.php");
	$del=$_GET['id'];
	$jenis=$_GET['jenis'];
	if($del>0){
		$que=mysql_query("SELECT URL FROM DATA_FILES WHERE ID_FILES='$del'");
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
		mysql_query("DELETE FROM DATA_FILES WHERE ID_FILES='$del'");
	}
	
?>