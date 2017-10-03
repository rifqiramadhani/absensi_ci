<div class="row">
	<div class="col-md-12">
		<h1>Ubah Data Alasan</h1>
		<?php echo validation_errors(); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<form class="form-horizontal" role="form" method="POST" action="">
			<div class="form-group">
				<label for="alasan_name" class="col-sm-4 control-label">Nama Alasan</label>
				<div class="col-sm-8">
					<input type="text" name="alasan_name" class="form-control" id="alasan_name" required="required" placeholder="Nama Alasan" value="<?php echo $alasan['nama_alasan']; ?>">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Update">&nbsp;
					<a href="<?php echo base_url().'master/alasan/listdata'; ?>" class="btn btn-default">Cancel</a>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-6">&nbsp;</div>
</div>