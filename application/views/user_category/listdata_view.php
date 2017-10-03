<div class="row">
	<div class="col-md-12">
		<h1>Kelola Data Tipe User</h1>
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
					<th>Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no = $number;
			foreach ($user_category as $row) {
				echo '<tr>';
				echo '<td>'.$no.'</td>';
				echo '<td>'.$row['nama_user_type'].'</td>';
				echo '<td><a href="'.base_url().'user_category/edit/'.$row['id_user_type'].'">Edit</a>&nbsp;&nbsp;';
				echo '</td>';//'<a href="'.base_url().'user_category/delete/'.$row['id_user_type'].'" class="delete-link">Delete</a>&nbsp;&nbsp;</td>';
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
		<a href="<?php echo base_url().'user_category/add'; ?>" class="btn btn-primary btn-lg">Tambah Tipe User</a>`
	</div>
</div>