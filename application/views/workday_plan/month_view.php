<div class="row">
	<div class="col-md-12">
		<input type="hidden" id="month_view_bulan" value="<?php echo $month_view_bulan; ?>">
		<input type="hidden" id="month_view_tahun" value="<?php echo $month_view_tahun; ?>">
		<div id="calendar_month_view"></div>
	</div>
</div>
<div class="modal fade" id="modal_calendar_month_view" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2>Edit Tanggal</h2>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label class="col-md-3 control-label" for="month_view_tanggal">Tanggal</label>
						<div class="col-md-9">
							<input type="hidden" name="month_view_id_perencanaan" id="month_view_id_perencanaan" value="">
							<input type="text" name="month_view_tanggal" id="month_view_tanggal" class="form-control" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="month_view_status">Status</label>
						<div class="col-md-9">
							<select name="month_view_status" id="month_view_status" class="form-control">
								<option value="0">Libur</option>
								<option selected="selected" value="1">Masuk</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="month_view_keterangan">Keterangan</label>
						<div class="col-md-9">
							<input type="text" name="month_view_keterangan" id="month_view_keterangan" class="form-control" value="">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-default" id="month_view_save_changes">Simpan Perubahan</button>
			</div>
		</div>
	</div>
</div>