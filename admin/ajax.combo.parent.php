<?php
	include("../config/conn.php");
	$level=$_GET['level'];
		
	$queparent=mysql_query("SELECT ID_MENU, NAMA FROM MENU WHERE LEVEL='".($level-1)."' AND ID_MENU>0 AND CONTENT=0");
	while($data=mysql_fetch_assoc($queparent)){
		echo "<option value='".$data['ID_MENU']."'>".$data['NAMA']."</option>";
	}
?>