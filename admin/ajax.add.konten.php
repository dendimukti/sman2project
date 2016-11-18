	<tr align="center">
		<td align="left">		
		<?php
			$jenis=$_GET['jenis'];
			if($jenis=='teks'){
				echo "<input type='hidden' name='name[]' value=''>";
				echo "<input type='hidden' name='jenis[]' value='teks'>";
				echo "<input type='file' name='data[]' value='' style='display:none'>";
				echo "New Text:<br><textarea name='desc[]'></textarea><br>";
//				echo '<textarea>Easy (and free!) You should check out our premium features.</textarea>';
			}
			else if($jenis=='pdf'){
				echo "Nama Pdf: <br><input type='text' name='name[]'><br>";
				echo "<input type='hidden' name='jenis[]' value='pdf'>";
				echo "Data Pdf:<br><input type='file'' name='data[]' accept='.pdf'><br>";
				echo "Deskripsi Pdf: <br><input type='text' name='desc[]' size='30'><br>";
			}
			else if($jenis=='gbr'){
				echo "Nama Gambar: <br><input type='text' name='name[]'><br>";
				echo "<input type='hidden' name='jenis[]' value='gbr'>";
				echo "Data Gambar:<br><input type='file'' name='data[]' accept='image/*'><br>";
				echo "Deskripsi Gambar: <br><input type='text' name='desc[]' size='30'><br>";
			}
			else if($jenis=='vid'){
				echo "Nama Video: <br><input type='text' name='name[]'><br>";
				echo "<input type='hidden' name='jenis[]' value='vid'>";
				echo "Data Video:<br><input type='file'' name='data[]' accept='video/*'><br>";
				echo "Deskripsi Video: <br><input type='text' name='desc[]' size='30'><br>";
			}
			//, <?php echo $jenis; ? >, 0
		?>
		</td>
		<td>
			<img onclick="del(this, '<?php echo $jenis; ?>', 0);" src="../plugins/ckeditor/skins/moono/images/close.png" width="16" height="16" border="0" title="Hapus" />
		</td>
	</tr>