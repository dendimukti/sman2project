<?php
	
	include("../config/conn.php");
	$del=$_GET['id'];
	$jenis=$_GET['jenis'];
	if($del>0){
		$que=mysqli_query($con, "SELECT URL FROM DATA_FILES WHERE ID_FILES='$del'");
		while($datafile=mysqli_fetch_assoc($que)){				
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
			else if($jenis=="html"){
				$file_to_delete = '../data/html/'.$datafile['URL'];
				unlink($file_to_delete);							
			}
			else if($jenis=="flash"){
				$file_to_delete = '../data/flash/'.$datafile['URL'];
				unlink($file_to_delete);							
			}
		}
		mysqli_query($con, "DELETE FROM DATA_FILES WHERE ID_FILES='$del'");
	}
	
?>