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
		  <div class='form-group'>
		    <div class='col-sm-offset-2 col-sm-10'>
		    	<label class='col-sm-2 control-label'>Menu Baru</label> 
		    </div>
		  </div>";
	}
	else{
		echo "
		  <div class='form-group'>
		    <div class='col-sm-offset-1 col-sm-10'>
		    	<button type=\"button\" class=\"btn btn-danger\" id='btnDel' onClick='document.location=\"./?del=".$idmenu."\"'>Delete</button>
		    	<br><br>
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
<form class="form-horizontal" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">Nama Menu</label>
    <div class="col-sm-6">
      	<input type="hidden" class="form-control" name="idmenu" id="idmenu" value="<?php echo $idmenu;?>">
		<input type="text" name="title" id="title" value="<?php echo $nama;?>">
    </div>
  </div>
<!--
  <div class="form-group">
    <label for="cbicon" class="col-sm-2 control-label">Pilih Ikon Menu</label>
    <div class="col-sm-6">
    	<select class="form-control" name="cbicon" id="cbicon">
			<option value="0" <?php echo ($icon==0)?"selected":""; ?>>ICON 0</option>
			<option value="1" <?php echo ($icon==1)?"selected":""; ?>>ICON 1</option>
			<option value="2" <?php echo ($icon==2)?"selected":""; ?>>ICON 2</option>
			<option value="3" <?php echo ($icon==3)?"selected":""; ?>>ICON 3</option>      
		</select>
    </div>
  </div>  
  <div class="form-group">
    <label for="cbicon" class="col-sm-2 control-label">Pilih Ikon Menu</label>
  	<div class="col-sm-6">
    	<div class="btn-group">
	        <button type="button" class="btn btn-primary iconpicker-component"><i class="fa fa-fw fa-heart"></i></button>
            <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fa-car" data-toggle="dropdown">
        	    <span class="caret"></span>
    	    	<span class="sr-only">Toggle Dropdown</span>
	        </button>
        	<div class="dropdown-menu"></div>
    	</div>
	</div>
 </div>
-->
  <div class="form-group">
    <label for="cblevel" class="col-sm-2 control-label">Pilih Level Menu</label>
    <div class="col-sm-6">
    	<select class="form-control" name="cblevel" id="cblevel" onchange="changeparent(this.value)">
		<?php
			$datalevel=mysql_fetch_assoc(mysql_query("SELECT MAX(LEVEL) AS LV FROM MENU"));
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
  <div class="form-group">
    <label for="cbparent" class="col-sm-2 control-label">Parent</label>
    <div class="col-sm-6">
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
  </div>
  <div class="form-group">
    <label for="ket" class="col-sm-2 control-label">Keterangan</label>
    <div class="col-sm-6">
		<input type="text" name="ket" id="ket" value="<?php echo $ket;?>">
    </div>
  </div>
  <div class="form-group">
    <label for="cbcontent" class="col-sm-2 control-label">Content</label>
    <div class="col-sm-6">
		<select name="cbcontent" id="cbcontent" onchange="pakaikonten(this.value, <?php echo $idmenu;?>)">
			<option value="0">Tidak</option>
			<option value="1" <?php echo ($content==1)?'selected':''; ?>>Ya</option>
		</select> 
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
  		<div id="divtabel"></div>
  	</div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
	<?php
		if($idmenu==0)	echo "<input type='submit' name='addmenu' id='addmenu' class='btn btn-default' value='Submit'>";
		else	echo "<input type='submit' name='editmenu' id='editmenu' class='btn btn-default' value='Edit'>";
	?>
    </div>
  </div>
</form>

<script type="text/javascript">
	pakaikonten(<?php echo $content.", ".$idmenu;?>);
</script>
