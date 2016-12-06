	<tr align="center">
		<td align="left">		
		<?php
			$jenis=$_GET['jenis'];
			if($jenis=='teks'){
				echo "<div class='form-group'>
				<input type='hidden' name='name[]' value=''>
				<input type='hidden' name='jenis[]' value='teks'>
				<input type='file' name='data[]' value='' style='display:none'>
				New Text:<br><textarea name='desc[]' class='mceEditor'></textarea>
				</div>";
			}
			else if($jenis=='pdf'){
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
			else if($jenis=='html'){
				echo "<div class='form-group'>
					    <label>Nama HTML:</label>
					    <input type='text' class='form-control' name='name[]' placeholder='Nama'>
					  </div>					
					  <input type='hidden' name='jenis[]' value='html'>
					  <div class='form-group'>
					    <label>File HTML</label>
					    <input type='file' name='data[]' accept='.html'>
					  </div>					
					  <div class='form-group'>
					    <label>Deskripsi HTML:</label>
					    <input type='text' class='form-control' name='desc[]' placeholder='Deskripsi'>
					  </div>";
			}
			else if($jenis=='link'){
				echo "<div class='form-group'>
					    <label>Nama Link:</label>
					    <input type='text' class='form-control' name='name[]' placeholder='Nama Link'>
					  </div>					
					  <input type='hidden' name='jenis[]' value='link'>
					  <input type='file' name='data[]' value='' style='display:none'>
					  <div class='form-group'>
					    <label>Alamat URL:</label>
					    <input type='text' class='form-control' name='desc[]' placeholder='Alamat URL'>
					  </div>";
			}
			else if($jenis=='flash'){
				echo "<div class='form-group'>
					    <label>Nama Flash:</label>
					    <input type='text' class='form-control' name='name[]' placeholder='Nama'>
					  </div>					
					  <input type='hidden' name='jenis[]' value='flash'>
					  <div class='form-group'>
					    <label>File Flash</label>
					    <input type='file' name='data[]' accept='.swf'>
					  </div>					
					  <div class='form-group'>
					    <label>Deskripsi Flash:</label>
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