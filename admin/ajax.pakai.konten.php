<?php
include("../config/conn.php");
$idmenu=$_GET['idmenu'];
echo "
<hr>
<table class='table table-bordered' id='table' witdh='70%'>
	<tr>
		<th witdh='70%'>
			<select name='jeniskonten' id='jeniskonten' class='form-control'>
				<option value='teks'>Teks</option>
				<option value='pdf'>PDF</option>
				<option value='gbr'>Gambar</option>
				<option value='vid'>Video</option>
			</select>
		</th>
		<th witdh='30%'>
			<button type='button' class='btn btn-primary' id='btn' onclick='add()'>Tambah Data Konten</button>
		</th>
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
			<i class="fa fa-trash-o" onclick="del(this, \''.$datafile['JENIS'].'\', \''.$datafile['ID_FILES'].'\');"/> &nbsp;&nbsp;&nbsp;&nbsp;';
if($n>1)
	echo '<i class="fa fa-caret-up" onclick="changeOrder(\'up\', \''.$datafile['ID_FILES'].'\', \''.$datafile['ID_MENU'].'\');"/> &nbsp;&nbsp;&nbsp;&nbsp;';
else
	echo '<i class="fa fa-caret-up" onclick="changeOrder(\'up\', \''.$datafile['ID_FILES'].'\', \''.$datafile['ID_MENU'].'\');"/> &nbsp;&nbsp;&nbsp;&nbsp;';
if($n<$tot)
	echo '<i class="fa fa-caret-down"/>';
else
	echo '<i class="fa fa-caret-down"/>';
		$n++;		
		echo '</td>
	</tr>';
	}
}
echo "</table>";
?>	