<?php
	
include("../config/conn.php");
$idfiles=$_GET['id'];
$jenis=$_GET['tipe'];
	
$queid=mysqli_query($con, "SELECT ID_MENU, URUTAN FROM DATA_FILES WHERE ID_FILES='$idfiles'");
$dataid=mysqli_fetch_assoc($queid);
$urutan=$dataid['URUTAN'];
$idmenu=$dataid['ID_MENU'];
		
if($jenis=="up"){
	$quedo=mysqli_query($con, "SELECT ID_FILES, URUTAN FROM DATA_FILES WHERE ID_MENU='$idmenu' AND URUTAN<'$urutan' ORDER BY URUTAN DESC LIMIT 1");
	$datado=mysqli_fetch_assoc($quedo);
	$idup=$datado['ID_FILES'];
	$urutanup=$datado['URUTAN'];
	
	mysqli_query($con, "UPDATE DATA_FILES SET URUTAN='$urutan' WHERE ID_FILES='$idup'");
	mysqli_query($con, "UPDATE DATA_FILES SET URUTAN='$urutanup' WHERE ID_FILES='$idfiles'");
}
else if($jenis=="down"){			
	$quedo=mysqli_query($con, "SELECT ID_FILES, URUTAN FROM DATA_FILES WHERE ID_MENU='$idmenu' AND URUTAN>'$urutan' ORDER BY URUTAN ASC LIMIT 1");
	$datado=mysqli_fetch_assoc($quedo);
	$iddown=$datado['ID_FILES'];
	$urutandown=$datado['URUTAN'];
	
	mysqli_query($con, "UPDATE DATA_FILES SET URUTAN='$urutan' WHERE ID_FILES='$iddown'");
	mysqli_query($con, "UPDATE DATA_FILES SET URUTAN='$urutandown' WHERE ID_FILES='$idfiles'");
}
	echo "ok";
?>