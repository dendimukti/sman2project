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
				<option value='link'>Link</option>
				<option value='html'>Html</option>
				<option value='flash'>Flash</option>
				<option value='pdf'>PDF</option>
				<option value='gbr'>Gambar</option>
				<option value='vid'>Video</option>
			</select>
		</th>
		<th witdh='30%'>
			<button type='button' class='btn btn-success' id='btn' onclick='add()'>Tambah Data Konten</button>
		</th>
	</tr>";
if($idmenu>0){
	$que=mysqli_query($con, "SELECT * FROM DATA_FILES WHERE ID_MENU='$idmenu' ORDER BY URUTAN ASC");
	$jenis="teks";
	$tot=mysqli_num_rows($que);
	$n=1;
	while($datafile=mysqli_fetch_assoc($que)){
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
		else if($datafile['JENIS']=="html"){
			echo " <a href='../data/html/".$datafile['URL']."'>(HTML) ".$datafile['NAMA']."</a><br>";
		}
		else if($datafile['JENIS']=="flash"){
			echo " <a href='../data/flash/".$datafile['URL']."'>(FLASH) ".$datafile['NAMA']."</a><br>";
		}
		else if($datafile['JENIS']=="link"){
			echo " <a href='".$datafile['KET']."'>(LINK) ".$datafile['NAMA']."</a><br>";
		}
		
		echo '</td>
		<td>
			<i class="fa fa-trash-o" onclick="del(this, \''.$datafile['JENIS'].'\', \''.$datafile['ID_FILES'].'\');"/> &nbsp;&nbsp;&nbsp;&nbsp;';
if($n>1)
	echo '<i class="fa fa-caret-up" onclick="changeOrder(\'up\', \''.$datafile['ID_FILES'].'\', \''.$datafile['ID_MENU'].'\');"/> &nbsp;&nbsp;&nbsp;&nbsp;';
else
	echo '<i class="fa fa-caret-up" /> &nbsp;&nbsp;&nbsp;&nbsp;';
if($n<$tot)
	echo '<i class="fa fa-caret-down" onclick="changeOrder(\'down\', \''.$datafile['ID_FILES'].'\', \''.$datafile['ID_MENU'].'\');"/> &nbsp;&nbsp;&nbsp;&nbsp;';
else
	echo '<i class="fa fa-caret-down" );"/> &nbsp;&nbsp;&nbsp;&nbsp;';
		$n++;		
		echo '</td>
	</tr>';
	}
}
echo "</table>";
?>	