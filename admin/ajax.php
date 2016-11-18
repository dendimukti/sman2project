<?php
	include("../config/conn.php");
	
	$idmenu=0;
	$nama="";
	$icon="";
	$level="";
	$parent="";
	$content=0;
	$ket="";
	$idmenu=$_REQUEST['idmenu'];
	if($idmenu==0){
		echo "
		<div class='row'>
			<div class='col-md-6'>
			  <div class='form-group'>			    
			    <h3>Tambah Menu</h3>
			  </div>
			</div>
		</div>";
	}
	else{
		echo "
		<div class='row'>
			<div class='col-md-6'>
			  <div class='form-group'>			    
			    <button type=\"button\" class=\"btn btn-danger\" id='btnDel' onClick='document.location=\"./?del=".$idmenu."\"'>Delete</button>
			  </div>
			</div>
		</div>";
		$que=mysql_query("SELECT * FROM MENU WHERE ID_MENU='$idmenu'");
		$data=mysql_fetch_assoc($que);
		$nama=$data['NAMA'];
		$icon=$data['LOGO'];
		$level=$data['LEVEL'];
		$parent=$data['PARENT'];
		$content=$data['CONTENT'];
		$ket=$data['KET'];
	}
	
?>

<form method="post" enctype="multipart/form-data">
<input type="hidden" name="idmenu" id="idmenu" value="<?php echo $idmenu;?>">
<div class="row">
	<div class="col-md-6">
	  <div class="form-group">
	    <label for="title">Nama Menu</label>
	    <input type="text" class="form-control" name="title" id="title" value="<?php echo $nama;?>">
	  </div>
	</div>
	<div class="col-md-6">
	  <div class="form-group">
	    <label for="cblevel">Pilih Level Menu</label>
	    <select class="form-control" name="cblevel" id="cblevel" onchange="changeparent(this.value)">
		<?php
			$datalevel=mysql_fetch_assoc(mysql_query("SELECT MAX(LEVEL) AS LV FROM MENU WHERE CONTENT='0'"));
			$datalevel=$datalevel['LV'];
			for($i=1;$i<=$datalevel+1;$i++){
				if($i==$level)
					echo "<option value='$i' selected>$i</option>";
				else
					echo "<option value='$i'>$i</option>";
			}
		?>
		</select>
	  </div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">

	  <div class="form-group">
	    <label for="cbparent">Pilih Induk</label>
			<select class="form-control" name="cbparent" id="cbparent">
			<?php
				$queparent=mysql_query("SELECT ID_MENU, NAMA FROM MENU WHERE LEVEL='".($level-1)."'");
				while($data=mysql_fetch_assoc($queparent)){
					if($data['ID_MENU']==$parent)
						echo "<option value='".$data['ID_MENU']."' selected>".$data['NAMA']."</option>";
					else
						echo "<option value='".$data['ID_MENU']."'>".$data['NAMA']."</option>";
				}
			?>
			 
			</select>
	  </div>
	  <div class="form-group">
	    <label for="cbcontent">Konten</label>
			<select class="form-control" name="cbcontent" id="cbcontent" onchange="pakaikonten(this.value, <?php echo $idmenu;?>)">
				<option value="0">Tidak</option>
				<option value="1" <?php echo ($content==1)?'selected':''; ?>>Ya</option>
			</select> 
	  </div>
	</div>
	<div class="col-md-6">
  <div class="form-group">
    <label for="ket">Keterangan</label>
    <textarea name="ket" id="ket" class="form-control" rows="5"><?php echo $ket;?></textarea>
  </div>
	</div>
</div>
  <div class="form-group">
  	<div id="divtabel"></div>
  </div>
  <div class="form-group">
	<?php
		if($idmenu==0)	echo "<input type='submit' name='addmenu' id='addmenu' class='btn btn-default' value='Simpan'>";
		else	echo "<input type='submit' name='editmenu' id='editmenu' class='btn btn-default' value='Simpan'>";
	?>
  </div>
</form>

<script type="text/javascript">
	pakaikonten(<?php echo $content.", ".$idmenu;?>);
</script>