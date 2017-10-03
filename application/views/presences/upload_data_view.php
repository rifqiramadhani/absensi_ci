<div class="row">
	<div class="col-md-12">
		<h1>Unggah Data Absensi</h1>
		<hr/>
	Unggah file absensi .xlsx

	<?php
	echo form_open_multipart('Excel_import/do_upload');
	echo form_upload('userfile');
	echo '</br>';
	echo form_submit(null,'Upload');
	echo form_close();
	?>
	</div>
</div>
<div class="row">
	
</div>
