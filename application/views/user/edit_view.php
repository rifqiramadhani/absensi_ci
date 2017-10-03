<div class="row">
	<div class="col-md-12">
		<h1>Edit Data karyawan</h1>
		<?php echo validation_errors(); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<form class="form-horizontal" role="form" method="POST" action="">
			<div class="form-group">
				<label for="nomor_induk" class="col-sm-3 control-label">Nomor Induk</label>
				<div class="col-sm-6">
					<input type="text" name="nomor_induk" class="form-control" id="nomor_induk" required="required" placeholder="Nomor Induk" value="<?php echo $user['nomor_induk']; ?>">
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-group">
				<label for="kode_mesin" class="col-sm-3 control-label">Kode Mesin</label>
				<div class="col-sm-6">
					<input type="text" name="kode_mesin" class="form-control" id="kode_mesin" required="required" placeholder="Kode Mesin" value="<?php echo $user['kode_mesin']; ?>">
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-group">
				<label for="nama_karyawan" class="col-sm-3 control-label">Nama Pegawai</label>
				<div class="col-sm-6">
					<input type="text" name="nama_karyawan" class="form-control" id="nama_karyawan" required="required" placeholder="Nama karyawan" value="<?php echo $user['nama']; ?>">
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-group">
				<label for="tempat_lahir" class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
				<div class="col-sm-3">
					<input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" required="required" placeholder="Tempat Lahir" value="<?php echo $user['tempat_lahir']; ?>">
				</div>
				<div class="col-sm-3">
					<input type="text" name="tanggal_lahir" class="form-control date" id="tanggal_lahir" data-date-format="DD/MM/YYYY" required="required" placeholder="dd/mm/yyyy" value="<?php echo $this->tanggal->tanggal_indo($user['tanggal_lahir']); ?>">
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-group">
				<label for="jenis_kelamin1" class="col-sm-3 control-label">Jenis Kelamin</label>
				<div class="col-sm-6">	
					<label class="radio-inline">
						<input type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="1" <?php echo $jenis_kelamin[1]; ?>> Pria 
					</label>
					<label class="radio-inline">
						<input type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="2" <?php echo $jenis_kelamin[2]; ?>> Wanita
					</label>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-group">
				<label for="alamat" class="col-sm-3 control-label">Alamat</label>
				<div class="col-sm-6">
					<textarea name="alamat" id="alamat" class="form-control" required="required" placeholder="Alamat"><?php echo $user['alamat']; ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="no_telepon" class="col-sm-3 control-label">No Telepon / No Handphone</label>
				<div class="col-sm-3">
					<input type="text" name="no_telepon" id="no_telepon" class="form-control" placeholder="No Telepon" maxlength="15" value="<?php echo $user['no_telp']; ?>">
				</div> 
				<div class="col-sm-3">
					<input type="text" name="no_handphone" id="no_handphone" class="form-control" required="required" placeholder="No Handphone" maxlength="15" value="<?php echo $user['no_handphone']; ?>">
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-6">
					<input type="email" name="email" id="email" class="form-control" required="required" placeholder="mail@example.com" value="<?php echo $user['email']; ?>">
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-group">
				<label for="status_perkawinan" class="col-sm-3 control-label">Status Perkawinan</label>
				<div class="col-sm-6">
					<?php echo $status_perkawinan; ?>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-group">
				<label for="id_divisi" class="col-sm-3 control-label">Divisi</label>
				<div class="col-sm-6">
					<?php echo $divisi; ?>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-group">
				<label for="id_jabatan" class="col-sm-3 control-label">Jabatan</label>
				<div class="col-sm-6">
					<?php echo $jabatan; ?>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-group">
				<label for="id_golongan" class="col-sm-3 control-label">Golongan</label>
				<div class="col-sm-6">
					<?php echo $golongan; ?>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-group">
				<label for="id_jam_kerja" class="col-sm-3 control-label">Jam Kerja</label>
				<div class="col-sm-6">
					<?php echo $jam_kerja; ?>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-group">
				<label for="tanggal_masuk" class="col-sm-3 control-label">Tanggal Masuk</label>
				<div class="col-sm-6">
					<input type="text" name="tanggal_masuk" class="form-control date" data-date-format="DD/MM/YYYY" id="tanggal_masuk" required="required" placeholder="dd/mm/yyyy" value="<?php echo $this->tanggal->tanggal_indo($user['tanggal_masuk']); ?>">
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<input type="submit" name="submit_user_add" id="submit_user_add" class="btn btn-primary" value="Save">&nbsp;
					<a href="<?php echo base_url().'user/listdata'; ?>" class="btn btn-default">Cancel</a>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-4">&nbsp;</div>
</div>