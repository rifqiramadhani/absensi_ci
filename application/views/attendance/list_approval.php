<div class="row">
	<div class="col-md-12">
		<h1>Approval Request Absensi Susulan</h1>
		<hr/>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php
		if($this->session->flashdata('message_alert')){
			echo $this->session->flashdata('message_alert');
		}
		?>
		<table class="table table-bordered table-hovered">
			<thead>
				<tr>
					<th style="width:15%;text-align:center;">Tanggal</th>
					<th style="width:20%;text-align:center;">Nama karyawan</th>
					<th style="width:20%;text-align:center;">Alasan</th>
					<th style="width:30%;text-align:center;">Keterangan</th>
					<th style="width:15%;text-align:center;">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				if($count > 0){
					foreach($list_approval as $row){
						echo '<tr>';
						echo '<td>'.$this->tanggal->tanggal_indo($row['tanggal_absen']).'</td>';
						echo '<td>'.$row['nama'].'</td>';
						echo '<td>'.$row['nama_alasan'].'</td>';
						echo '<td>'.$row['keterangan'].'</td>';
						echo '<td style="width:15%;text-align:center;"><a href="'.base_url().'attendance/approve/'.$row['id_absen_susulan'].'" class="btn btn-default" onclick="return confirm(\'Ijinkan Absensi Susulan?\')">Setujui</a></td>';
						echo '<td style="width:15%;text-align:center;"><a href="'.base_url().'attendance/tolak/'.$row['id_absen_susulan'].'" class="btn btn-default" onclick="return confirm(\'Apakah Anda yakin menolak Absensi Susulan?\')">Tolak</a></td>';
						echo '</tr>';
					}
				}else{
					echo '<tr><td colspan="5">Tidak ada data.</td></tr>';
				}
			?>
			</tbody>
		</table>
	</div>
</div>