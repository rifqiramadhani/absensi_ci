<div class="row">
	<div class="col-md-12">
		<h1>Kelola Data Master Divisi</h1>
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
					<th>Divisi</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no = $number;
			foreach ($divisi as $row) {
				echo '<tr>';
				echo '<td>'.$no.'</td>';
				echo '<td>'.$row['nama_divisi'].'</td>';
				echo '<td><a href="'.base_url().'master/divisi/edit/'.$row['id_divisi'].'">Edit</a>&nbsp;&nbsp;';
				echo '<a href="'.base_url().'master/divisi/delete/'.$row['id_divisi'].'" class="delete-link">Delete</a>&nbsp;&nbsp;</td>';
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
		<a href="<?php echo base_url().'master/divisi/add'; ?>" class="btn btn-primary btn-lg">Tambah Divisi</a>
	</div>
</div>