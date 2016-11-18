<center>

<img src="img/sucofindo.png">
<br>Login<br><br>

<?php
//	if(!empty($_SESSION[LOGGED])){
//		echo "<script>document.location='./'</script>";			
//	}
	
	extract($_POST);	
	if(isset($login)){
		$dat=mysql_fetch_assoc(mysql_query("SELECT * FROM USER WHERE USN='$usn' AND PWD='$pwd' AND STATUS=1"));
		if(!empty($dat['ID'])){
			$_SESSION['LOGGED']=$dat['ID'];
			echo "<script>document.location='./'</script>";
		}else{
			echo "<font color==red>Login Gagal !</font>";
		}
	}
?>
<form method="post">
	<table>
		<tr>
			<td>USERNAME</td>
			<td>:</td>
			<td><input type="text" name="usn" placeholder="username"></td>
		</tr>
		<tr>			
			<td>PASSWORD</td>
			<td>:</td>
			<td><input type="password" name="pwd" placeholder="***********"></td>
		</tr>
		<tr>
			<td colspan="3" align="right">
				<input type="submit" value="Login" name="login">
			</td>
		</tr>
	
	</table>

</form>

</center>