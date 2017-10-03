<div class="row">
	<div class="col-md-12">
		<h1>Kelola Data Perencanaan Hari Kerja</h1>
		<?php
		if($this->session->flashdata('message_alert')){
			echo $this->session->flashdata('message_alert');
		}
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Bulan</th>
					<th>Jumlah Hari</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no = $number;
			foreach ($workday_plan as $row) {
				echo '<tr>';
				echo '<td>'.$no.'</td>';
				echo '<td>'.$this->tanggal->get_bulan($row['bulan']).' '.$row['tahun'].'</td>';
				echo '<td>'.$row['hari'].' hari</td>';
				echo '<td><a href="'.base_url().'workday_plan/month_view/'.$row['bulan'].'/'.$row['tahun'].'">View</a>&nbsp;&nbsp;';
				echo '<a href="'.base_url().'workday_plan/edit/'.$row['bulan'].'/'.$row['tahun'].'" class="delete-link">Delete</a>&nbsp;&nbsp;</td>';
				echo '</tr>';
				++$no;
			}
			?>
			</tbody>
		</table>
		<?php echo $paging; ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<a href="<?php echo base_url().'workday_plan/add'; ?>" class="btn btn-primary btn-lg">Buat Perencanaan Hari Kerja</a>
	</div>
</div>