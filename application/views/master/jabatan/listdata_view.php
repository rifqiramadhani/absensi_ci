<div class="row">
	<div class="col-md-12">
		<h1>Kelola Data Master Jabatan</h1>
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
					<th>Jabatan</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no = $number;
			foreach ($jabatan as $row) {
				echo '<tr>';
				echo '<td>'.$no.'</td>';
				echo '<td>'.$row['nama_jabatan'].'</td>';
				echo '<td><a href="'.base_url().'master/jabatan/edit/'.$row['id_jabatan'].'">Edit</a>&nbsp;&nbsp;';
				echo '<a href="'.base_url().'master/jabatan/delete/'.$row['id_jabatan'].'" class="delete-link">Delete</a>&nbsp;&nbsp;</td>';
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
		<a href="<?php echo base_url().'master/jabatan/add'; ?>" class="btn btn-primary btn-lg">Tambah Jabatan</a>
	</div>
</div>