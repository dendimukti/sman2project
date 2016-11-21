	<tr align="center">
		<td align="left">		
		<?php
			$jenis=$_GET['jenis'];
			if($jenis=='teks'){
//				echo "<input type='hidden' name='name[]' value=''>
//				<input type='hidden' name='jenis[]' value='teks'>
//				<input type='file' name='data[]' value='' style='display:none'>
//				New Text:<br><textarea name='desc[]' class='mceEditor'></textarea><br>";

				echo "<div class='form-group'>
				<input type='hidden' name='name[]' value=''>
				<input type='hidden' name='jenis[]' value='teks'>
				<input type='file' name='data[]' value='' style='display:none'>
				New Text:<br><textarea name='desc[]' class='mceEditor'></textarea>
				</div>";
			}
			else if($jenis=='pdf'){
//				echo "Nama Pdf: <input type='text' name='name[]'><br>
//				<input type='hidden' name='jenis[]' value='pdf'>	
//				Data Pdf: <input type='file'' name='data[]' accept='.pdf'>	
//				Deskripsi Pdf: <input type='text' name='desc[]' size='30'><br>";
				echo "<div class='form-group'>
					    <label>Nama Pdf:</label>
					    <input type='text' class='form-control' name='name[]' placeholder='Nama'>
					  </div>
						<input type='hidden' name='jenis[]' value='pdf'>
					  <div class='form-group'>
					    <label>File Pdf</label>
					    <input type='file' name='data[]' accept='.pdf'>
					  </div>
					
					  <div class='form-group'>
					    <label>Deskripsi Pdf:</label>
					    <input type='text' class='form-control' name='desc[]' placeholder='Deskripsi'>
					  </div>";
			}
			else if($jenis=='gbr'){
//				echo "Nama Gambar: <input type='text' name='name[]'><br>
//				<input type='hidden' name='jenis[]' value='gbr'>
//				Data Gambar: <input type='file'' name='data[]' accept='image/*'>
//				Deskripsi Gambar: <input type='text' name='desc[]' size='30'><br>";
				echo "<div class='form-group'>
					    <label>Nama Gambar:</label>
					    <input type='text' class='form-control' name='name[]' placeholder='Nama'>
					  </div>					
					  <input type='hidden' name='jenis[]' value='gbr'>
					  <div class='form-group'>
					    <label>File Gambar</label>
					    <input type='file' name='data[]' accept='image/*'>
					  </div>					
					  <div class='form-group'>
					    <label>Deskripsi Gambar:</label>
					    <input type='text' class='form-control' name='desc[]' placeholder='Deskripsi'>
					  </div>";
			}
			else if($jenis=='vid'){
//				echo "Nama Video: <input type='text' name='name[]'><br>
//				<input type='hidden' name='jenis[]' value='vid'>
//				Data Video: <input type='file'' name='data[]' accept='video/*'>
//				Deskripsi Video: <input type='text' name='desc[]' size='30'><br>";
				echo "<div class='form-group'>
					    <label>Nama Video:</label>
					    <input type='text' class='form-control' name='name[]' placeholder='Nama'>
					  </div>					
					  <input type='hidden' name='jenis[]' value='vid'>
					  <div class='form-group'>
					    <label>File Video</label>
					    <input type='file' name='data[]' accept='video/*'>
					  </div>					
					  <div class='form-group'>
					    <label>Deskripsi Video:</label>
					    <input type='text' class='form-control' name='desc[]' placeholder='Deskripsi'>
					  </div>";
			}
			//, <?php echo $jenis; ? >, 0
		?>
		</td>
		<td>
			<i class="fa fa-trash-o" onclick="del(this, '<?php echo $jenis; ?>', 0);"/>
		</td>
	</tr>