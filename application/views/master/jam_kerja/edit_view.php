<div class="row">
	<div class="col-md-12">
		<h1>Edit Jam Kerja</h1>
		<?php echo validation_errors(); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<form class="form-horizontal" role="form" method="POST" action="">
			<div class="form-group">
				<label for="master_jam_masuk" class="col-sm-4 control-label">Jam Masuk</label>
				<div class="col-sm-8">
					<input type="text" name="master_jam_masuk" class="form-control" id="master_jam_masuk" required="required" placeholder="hh:mm" maxlength="5" value="<?php echo $jam_masuk; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="master_jam_keluar" class="col-sm-4 control-label">Jam Keluar</label>
				<div class="col-sm-8">
					<input type="text" name="master_jam_keluar" class="form-control" id="master_jam_keluar" required="required" placeholder="hh:mm" maxlength="5" value="<?php echo $jam_keluar; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="master_keterangan" class="col-sm-4 control-label">Keterangan</label>
				<div class="col-sm-8">
					<input type="text" name="master_keterangan" class="form-control" id="master_keterangan" placeholder="Keterangan" value="<?php echo $jam_kerja['keterangan']; ?>">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Update">&nbsp;
					<a href="<?php echo base_url().'master/jam_kerja/listdata'; ?>" class="btn btn-default">Cancel</a>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-6">&nbsp;</div>
</div>