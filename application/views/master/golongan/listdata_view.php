<div class="row">
	<div class="col-md-12">
		<h1>Kelola Data Master Golongan</h1>
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
					<th>Golongan</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no = $number;
			foreach ($golongan as $row) {
				echo '<tr>';
				echo '<td>'.$no.'</td>';
				echo '<td>'.$row['nama_golongan'].'</td>';
				echo '<td><a href="'.base_url().'master/golongan/edit/'.$row['id_golongan'].'">Edit</a>&nbsp;&nbsp;';
				echo '<a href="'.base_url().'master/golongan/delete/'.$row['id_golongan'].'" class="delete-link">Delete</a>&nbsp;&nbsp;</td>';
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
		<a href="<?php echo base_url().'master/golongan/add'; ?>" class="btn btn-primary btn-lg">Tambah Golongan</a>
	</div>
</div>