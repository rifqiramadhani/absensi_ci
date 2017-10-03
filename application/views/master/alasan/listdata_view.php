<div class="row">
	<div class="col-md-12">
		<h1>Kelola Data Master Alasan</h1>
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
					<th>Alasan</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no = $number;
			foreach ($alasan as $row) {
				echo '<tr>';
				echo '<td>'.$no.'</td>';
				echo '<td>'.$row['nama_alasan'].'</td>';
				echo '<td><a href="'.base_url().'master/alasan/edit/'.$row['id_alasan'].'">Edit</a>&nbsp;&nbsp;';
				echo '<a href="'.base_url().'master/alasan/delete/'.$row['id_alasan'].'" class="delete-link">Delete</a>&nbsp;&nbsp;</td>';
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
		<a href="<?php echo base_url().'master/alasan/add'; ?>" class="btn btn-primary btn-lg">Tambah Alasan</a>
	</div>
</div>