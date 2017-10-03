<div class="row">
	<div class="col-md-12">
		<h1>Kehadiran Pegawai</h1>
		<hr/>
	</div>
</div>
<div class="row">
	<div class="col-md-6">

		<?php
			if($this->session->userdata('user_type_id')=='1'){
		?>
		<form class="form-horizontal" method="POST" role="form" action="">
			<div class="form-group">
				<label for="presences_date_start" class="col-sm-4 control-label">Date Start</label>
				<div class="col-md-4">
					<input type="text" name="presences_date_start" id="presences_date_start" class="form-control date" data-date-format="DD/MM/YYYY" required="required" placeholder="dd/mm/yyyy" maxlength="10" value="<?php echo $date_start; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="presences_date_end" class="col-sm-4 control-label">Date End</label>
				<div class="col-md-4">
					<input type="text" name="presences_date_end" id="presences_date_end" class="form-control date" data-date-format="DD/MM/YYYY" required="required" placeholder="dd/mm/yyyy" maxlength="10" value="<?php echo $date_end; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="presences_nama_pegawai" class="col-sm-4 control-label">Nama Pegawai</label>
				<div class="col-md-4">
					<select class="form-control" name="nomor_induk">
							<option value="">Nama Pegawai</option>
					<?php
						foreach ($listPegawai as $key => $eachPegawai) {
							echo "<option value=".$eachPegawai['nomor_induk'].">".$eachPegawai['nama']."</option>";
						}
					 ?>
					</select>
				</div>
				<div class="col-md-4">
					<input type="submit" name="submit" value="Search" class="btn btn-primary">
				</div>
				<!-- <div class="col-md-4">
					<input type="submit" name="submit_name" value="Search" class="btn btn-primary">
				</div> -->
			</div>
		</form>
		<?php }
		else{?>
		<form class="form-horizontal" method="POST" role="form" action="">
			<div class="form-group">
				<label for="presences_date_start" class="col-sm-4 control-label">Date Start</label>
				<div class="col-md-4">
					<input type="text" name="presences_date_start" id="presences_date_start" class="form-control date" data-date-format="DD/MM/YYYY" required="required" placeholder="dd/mm/yyyy" maxlength="10" value="<?php echo $date_start; ?>">
				</div>
				<div class="col-md-4">
					<input type="submit" name="submit" value="Search" class="btn btn-primary">
				</div>
			</div>
			<div class="form-group">
				<label for="presences_date_end" class="col-sm-4 control-label">Date End</label>
				<div class="col-md-4">
					<input type="text" name="presences_date_end" id="presences_date_end" class="form-control date" data-date-format="DD/MM/YYYY" required="required" placeholder="dd/mm/yyyy" maxlength="10" value="<?php echo $date_end; ?>">
				</div>
			</div>
		</form>
		<?php }?>
	</div>
	<div class="col-md-6">
		<div class="row">
			<!--NIK<div class="col-md-4">
				
			</div>
			<div class="col-md-8">
				<?php echo $user['nomor_induk']; ?>
			</div>
		</div>
		<div class="row">-->
			<div class="col-md-2">
				Nama
			</div>
			<div class="col-md-8" style="font-weight:bold;">
				<?php echo $user['nama']; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				Periode
			</div>
			<div class="col-md-8">
				<?php echo $date_start.' - '.$date_end; ?>
			</div>
		</div>
		<!--<div class="row">
			<div class="col-md-2">
				Jam Kerja
			</div>
			<div class="col-md-8">
				<?php echo $jam_kerja['keterangan']; ?>
			</div>
		</div>-->
	</div>
</div>
<hr>
<?php
	if($this->session->userdata('user_type_id')=='1'){
?>
<div class="row">
	<div class="col-md-8">
	</div>
	<div class="col-md-2">
		<button class="btn btn-primary"><a target="_blank" href="<?php echo base_url().'report_to_pdf/print_laporan_eachPegawai'; ?>?date_start=<?php echo $date_start?>&date_end=<?php echo $date_end?>&nomor_induk=<?php echo $nomor_induk ?>"" style="color: #ffffff">Download Data Absensi</a></button>
	</div>
	<div class="col-md-2">
		<button class="btn btn-primary"><a target="_blank" href="<?php echo base_url().'report_to_pdf/print_rekap'; ?>?date_start=<?php echo $date_start?>&date_end=<?php echo $date_end?>&nomor_induk=199402142017092002"" style="color: #ffffff">Download Rekap Absensi</a></button>
	</div>
</div>
<hr>
<?php }?>
<div class="row">
	<div class="col-md-12">
<h3 align="center">Absensi Kehadiran Dalam 30 Hari Terakhir</h3>
<br></div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th style="text-align:center;">Tanggal</th>
					<th style="text-align:center;">Hari</th>
					<th style="text-align:center;">Jam Masuk</th>
					<th style="text-align:center;">Jam Pulang</th>
					<th style="text-align:center;">Alasan</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach($kehadiran as $row){
					echo '<tr>';
					echo '<td>'.$row['tanggal'].'</td>';
					echo '<td>'.$row['hari'].'</td>';
					echo '<td>'.$row['datang'].'</td>';
					echo '<td>'.$row['pulang'].'</td>';
					echo '<td>'.$row['alasan'].'</td>';
					echo '</tr>';
				}
			?>
			</tbody>
		</table>
	</div>
</div>