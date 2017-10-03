<?php
	if($this->session->userdata('user_type_id')=='1'){
?>

<div class="row">
	<div class="col-md-12">
		<h1>Hari Libur</h1>
		<hr/>
	</div>
</div>
<div class="row">
	<?php
	if($this->session->flashdata('message_alert')){
		echo $this->session->flashdata('message_alert');
	}
	?>
	<?php echo validation_errors(); ?>
	<div class="col-md-1">
	</div>
	<div class="col-md-11">
		<h4>Tambah hari libur sesuai tanggal kalender nasional</h4>
	</div>
	<form class="form-horizontal" role="form" action="" method="POST">
		<div class="form-group">
			<div class="col-sm-offset-1 col-sm-9">
				<input type="hidden" name="count_libur_request" id="count_libur_request" value="0">
				<table class="table table-bordered" id="tabel_libur">
					<thead>
						<tr>
							<th style="width:20%;text-align:center;padding:10px;">Tanggal</th>
							<th style="width:40%;text-align:center;padding:10px;">Keterangan Hari Libur</th>
							<th style="width:10%;text-align:center;padding:10px;">Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<div class="col-sm-offset-1 col-sm-9">
				<table>
					<tr>
						<td style="width:20%;text-align:center;padding:10px;">
							<input type="text" name="tanggal_libur" id="tanggal_libur" class="form-control date" placeholder="dd/mm/yyyy" maxlength="10">
						</td>
						<td style="width:10%;text-align:center;padding:10px;">
							<select name="status_libur" id="status_libur" class="form-control">
								<option value="0">Libur</option>
								<option value="1">Masuk</option>
							</select>
						</td>
						<td style="width:40%;text-align:center;padding:10px;">
							<input type="text" name="keterangan_libur" id="keterangan_libur" class="form-control" placeholder="Keterangan">
						</td>
						<td style="width:10%;text-align:center;padding:10px;">
							<button id="add_day_off" class="btn btn-default">Tambah</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-1 col-sm-2">
				<input type="submit" name="submit" id="submit_day_off" class="btn btn-primary" value="Konfirmasi" disabled="true">
			</div>
		</div>
	</form>
</div>
<?php
}
?>