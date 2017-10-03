<div class="row">
	<div class="col-md-12">
		<h1>Input Kehadiran</h1>
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
	<form class="form-horizontal" role="form" action="" method="POST">
		<div class="form-group">
			<label for="nik" class="col-sm-2 control-label">NIK</label>
			<div class="col-sm-4">
				<input type="text" name="nik" id="nik" class="form-control" placeholder="NIK" required="required" maxlength="6" readonly="true" value="<?php echo $this->session->userdata('user_nik'); ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="pwd" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-4">
				<input type="password" name="pwd" id="pwd" class="form-control" placeholder="Password" required="required">
			</div>
		</div>
		<div class="form-group">
			<label for="type_absen" class="col-sm-2 control-label">Type</label>
			<div class="col-sm-4">
				<input type="radio" name="type_absen" id="type_absen" value="1">&nbsp;Datang&nbsp;
				<input type="radio" name="type_absen" id="type_absen" value="2">&nbsp;Pulang&nbsp;
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-4 col-sm-offset-2">
				<input type="submit" name="submit" value="Submit" id="btn_submit" class="btn btn-primary">
			</div>
		</div>
	</form>
</div>