<?php
include("../config/conn.php");
$idmenu=$_GET['idmenu'];
echo "
<table border='1' cellspacing='0' id='table'>
	<tr>
		<td>
			<select name='jeniskonten' id='jeniskonten'>
				<option value='teks'>Teks</option>
				<option value='pdf'>PDF</option>
				<option value='gbr'>Gambar</option>
				<option value='vid'>Video</option>
			</select>
		</td>
		<td>
			<input type='button' id='btn' value='Add' onclick='add()'/>
		</td>
	</tr>";
if($idmenu>0){
	$que=mysql_query("SELECT * FROM DATA_FILES WHERE ID_MENU='$idmenu' ORDER BY URUTAN ASC");
	$jenis="teks";
	$tot=mysql_num_rows($que);
	$n=1;
	while($datafile=mysql_fetch_assoc($que)){
		echo '<tr align="center">
		<td align="left">';
		if($datafile['JENIS']=="teks"){
			echo $datafile['KET']."<br>";
		}
		else if($datafile['JENIS']=="vid"){
			echo " <a href='../data/vid/".$datafile['URL']."'>(VID) ".$datafile['NAMA']."</a><br>";
		}
		else if($datafile['JENIS']=="pdf"){
			echo " <a href='../data/pdf/".$datafile['URL']."'>(PDF) ".$datafile['NAMA']."</a><br>";
		}
		else if($datafile['JENIS']=="gbr"){
			echo " <a href='../data/gbr/".$datafile['URL']."'>(GBR) ".$datafile['NAMA']."</a><br>";
		}
		
		echo '</td>
		<td>
			<img onclick="del(this, \''.$datafile['JENIS'].'\', \''.$datafile['ID_FILES'].'\');" src="../plugins/ckeditor/skins/moono/images/close.png" width="16" height="16" border="0" title="Hapus" /> ';
if($n>1)
	echo '<img onclick="changeOrder(\'up\', \''.$datafile['ID_FILES'].'\', \''.$datafile['ID_MENU'].'\');" src="../plugins/datatables/images/sort_asc.png"/> ';
if($n<$tot)
	echo '<img onclick="changeOrder(\'down\', \''.$datafile['ID_FILES'].'\', \''.$datafile['ID_MENU'].'\');" src="../plugins/datatables/images/sort_desc.png"/> ';
		$n++;		
		echo '</td>
	</tr>';
	}
}
echo "</table>";

?>	