<!DOCTYPE html>
<html>
<head>
	<title>SISTEM INFORMASI ABSENSI</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/selectize.bootstrap3.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/bootstrap-datetimepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.min.css">

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script>
</head>
<body>
	<header class="navbar navbar-inverse navbar-static-top bs-docs-nav" id="top" role="banner">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">ABSENSI</a>
			</div>
			<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
				<ul class="nav navbar-nav">
					<li class="<?php echo ($this->uri->segment(1)=='home') ? 'active' : ''; ?>"><a href="<?php echo base_url().'home'; ?>">Dashboard</a></li>
					<?php
						if($this->session->userdata('user_type_id')==1){
					?>
					<li class="dropdown <?php echo ($this->uri->segment(1)=='master'||$this->uri->segment(1)=='user_category') ? 'active' : ''; ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Data Master <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<!--<li><a href="<?php echo base_url().'master/divisi/listdata'; ?>">Kelola Divisi</a></li>-->
							<li><a href="<?php echo base_url().'master/jabatan/listdata'; ?>">Kelola Jabatan</a></li>
							<li><a href="<?php echo base_url().'master/golongan/listdata'; ?>">Kelola Golongan</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo base_url().'master/jam_kerja/listdata'; ?>">Kelola Jam Kerja</a></li>
							<li><a href="<?php echo base_url().'master/alasan/listdata'; ?>">Kelola Alasan</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo base_url().'user_category/listdata'; ?>">Kelola Tipe User</a></li>
						</ul>
					</li>
					<li class="<?php echo ($this->uri->segment(1)=='user') ? 'active' : ''; ?>"><a href="<?php echo base_url().'user/listdata'; ?>">Data Pegawai</a></li>
					<!-- <li class="<?php echo ($this->uri->segment(1)=='workday_plan') ? 'active' : ''; ?>"><a href="<?php echo base_url().'workday_plan/listdata'; ?>">Perencanaan Hari Kerja</a></li> -->
					<!-- <li class="<?php echo ($this->uri->segment(1)=='day_off') ? 'active' : ''; ?>"><a href="<?php echo base_url().'day_off/day_off'; ?>">Hari Libur</a></li> -->
					<!--Perencanaan Kalender Nasional Dropdown>-->
					<li class="dropdown <?php echo ($this->uri->segment(1)=='day_off')||$this->uri->segment(1)=='workday_plan' ? 'active' : ''; ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Perencanaan Tanggal<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo base_url().'workday_plan'; ?>">Tambah Kalender</a></li>
							<li><a href="<?php echo base_url().'day_off/day_off'; ?>">Tambah Hari Libur</a></li>
						</ul>
					<?php
						}
					?>
					<li class="dropdown <?php echo ($this->uri->segment(1)=='presences'||$this->uri->segment(1)=='attendance') ? 'active' : ''; ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Kehadiran <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo base_url().'presences'; ?>">Daftar Kehadiran</a></li>
							<!--<li><a href="<?php echo base_url().'presences/input'; ?>">Input Kehadiran</a></li>-->
							<?php
							if($this->session->userdata('user_type_id')=='1'){
							?>
							<li><a href="<?php echo base_url().'Excel_import'; ?>">Upload Data Absensi</a></li>
							<!-- <li><a href="<?php echo base_url().'report_to_pdf'; ?>">Rekap Data Absensi</a></li> -->
							<?php
							}
							?>
							<li><a href="<?php echo base_url().'attendance/request'; ?>">Absen Susulan</a></li>
							<?php
							if($this->session->userdata('user_type_id')=='1'){
							?>
							<li><a href="<?php echo base_url().'attendance/pending'; ?>">Absen Susulan - Pending</a></li>
							<?php
							}
							?>
							
							<?php
							if($this->session->userdata('user_type_id')!='99'){
							?>
							<li class="divider"></li>
							<li><a href="<?php echo base_url().'attendance/list_approval'; ?>">Approval Absen Susulan</a></li>
							<?php
							}
							?>
						</ul>
					</li>
					<li><a href="<?php echo base_url().'user/logout'; ?>" onclick="return confirm('Are you sure want to exit?')">Logout</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<div class="container">
		<?php echo $_content; ?>
	</div>
	<script type="text/javascript">
	var base_url = '<?php echo base_url(); ?>';
	</script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/selectize.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/moment-develop/moment.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/fullcalendar/fullcalendar.js"></script>
	<script type="text/javascript">$('#select_id_atasan').selectize();</script>
</body>
</html>