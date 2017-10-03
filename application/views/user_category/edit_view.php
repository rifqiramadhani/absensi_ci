<div class="row">
	<div class="col-md-12">
		<h1>Edit Data Tipe User</h1>
		<?php echo validation_errors(); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<form class="form-horizontal" role="form" method="POST" action="">
			<div class="form-group">
				<label for="user_type_name" class="col-sm-4 control-label">Nama Tipe User</label>
				<div class="col-sm-8">
					<input type="text" name="user_type_name" class="form-control" id="user_type_name" required="required" placeholder="Nama Tipe User" value="<?php echo $user_category['nama_user_type']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="id_jabatan" class="col-sm-4 control-label">Jabatan</label>
				<div class="col-sm-8">
					<?php echo $jabatan; ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Update">&nbsp;
					<a href="<?php echo base_url().'user_category/listdata'; ?>" class="btn btn-default">Cancel</a>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-6">&nbsp;</div>
</div>