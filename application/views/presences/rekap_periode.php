<div class="row">
	<div class="col-md-12">
		<h1>Rekap Data Absensi</h1>
		<hr>
	Dokumentasi data absensi dapat diunduh sebagai file .pdf
	
	<?php
	echo form_open_multipart('report_to_pdf/print_rekap');
	echo form_upload('userfile');
	echo '</br>';
	echo form_submit(null,'i');
	echo form_close();
	?>
	</div>
</div>
<div class="row">
</div>
