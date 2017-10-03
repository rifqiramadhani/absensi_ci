<div class="row">
	<div class="col-md-12">
		<h1>Buat Rencana Hari Kerja</h1>
		<?php echo validation_errors(); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<form class="form-horizontal" role="form">
			<div class="form-group">
				<label for="bulan_plan" class="col-sm-3 control-label">Bulan</label>
				<div class="col-sm-6">
					<select name="bulan_plan" id="bulan_plan" class="form-control">
						<option value="">Pilih Bulan</option>
						<option value="1">Januari</option>
						<option value="2">Februari</option>
						<option value="3">Maret</option>
						<option value="4">April</option>
						<option value="5">Mei</option>
						<option value="6">Juni</option>
						<option value="7">Juli</option>
						<option value="8">Agustus</option>
						<option value="9">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="tahun_plan" class="col-sm-3 control-label">Tahun</label>
				<div class="col-sm-6">
					<input type="text" name="tahun_plan" id="tahun_plan" class="form-control" maxlength="4" placeholder="Tahun">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-3">&nbsp;</div>
				<div class="col-sm-6">
					<button type="button" id="generate_plan" class="btn btn-primary">Generate</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-6" id="result_plan_date_section">
		<form action="" method="post">
			<div class="form-group">
				<input type="hidden" name="hidden_bulan_plan" id="hidden_bulan_plan" value="" required>
				<input type="hidden" name="hidden_tahun_plan" id="hidden_tahun_plan" value="" required>
				<table id="workday_plan_generated" class="table table-bordered">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Status</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
			<div class="form-group">
				<div class="col-sm-6">
					<input type="submit" name="submit_plan" class="btn btn-primary" value="Save Plan">
				</div>
			</div>
		</form>
	</div>
</div>