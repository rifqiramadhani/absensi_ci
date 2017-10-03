<div class="row">
	<div class="col-md-12">
		<h1>Tambah Jabatan</h1>
		<?php echo validation_errors(); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<form class="form-horizontal" role="form" method="POST" action="">
			<div class="form-group">
				<label for="jabatan_name" class="col-sm-4 control-label">Nama Jabatan</label>
				<div class="col-sm-8">
					<input type="text" name="jabatan_name" class="form-control" id="jabatan_name" required="required" placeholder="Nama Jabatan">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Save">&nbsp;
					<a href="<?php echo base_url().'master/jabatan/listdata'; ?>" class="btn btn-default">Cancel</a>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-6">&nbsp;</div>
</div>