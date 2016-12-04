<?php
	include("../config/conn.php");
	$level=$_GET['level'];
	$idmenu=$_GET['idmenu'];
		
	$queparent=mysqli_query($con, "SELECT ID_MENU, NAMA FROM MENU WHERE LEVEL='".($level-1)."' AND ID_MENU>0 AND CONTENT=0 AND ID_MENU!='".$idmenu."'");
	while($data=mysqli_fetch_assoc($queparent)){
		echo "<option value='".$data['ID_MENU']."'>".$data['NAMA']."</option>";
	}
?>