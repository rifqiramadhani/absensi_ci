$(document).ready(function(){
	window.setTimeout(alert_hide(),3000);

	$('.delete-link').click(function(){
		return confirm('Are you sure want to delete this data?');
	});

	//USER PAGE
	$('#tanggal_lahir').datetimepicker({
		pickTime: false
	});
	$('#tanggal_masuk').datetimepicker({
		pickTime: false
	});
	/*var status_username = 0;
	$('#submit_user_add').attr('disabled','true');
	$('#user_name').keyup(function(){
		var username = $(this).val();

		$.ajax({
			url : base_url + 'user/check_username_availabilities',
			data : {username : username},
			type : 'POST',
			dataType : 'json',
			success: function(data){
				$('.status_username').empty();
				if(data.status==true){
					$('.status_username').append('Available');
					status_username = 1;
				}else{
					$('.status_username').append('Not Available');
					status_username = 0;
				}

				if(status_username==1){
					$('#submit_user_add').removeAttr('disabled');
				}else{
					$('#submit_user_add').attr('disabled','true');
				}
			}
		});
	});*/


	//WORKDAY GENERATE
	$('#result_plan_date_section').hide();
	$('#generate_plan').click(function(){
		var bulan_plan = $('#bulan_plan').val();
		var tahun_plan = $('#tahun_plan').val();
		var bulan_days = [31,28,31,30,31,30,31,31,30,31,30,31];
		var bulan_name = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
		var hari_name = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
		var availability = true;

		$('#result_plan_date_section').hide();
		$('#workday_plan_generated').find('tbody').empty();

		if(bulan_plan==''){
			alert('Please select a month.');
			$('#bulan_plan').focus();
		}else if(isNaN(tahun_plan)){
			alert('Please input a valid year.');
			$('#tahun_plan').focus();
		}else{

			//checking available month that could be set
			$.ajax({
				url : base_url + 'workday_plan/checking_month_availability',
				data : {bulan : bulan_plan,tahun: tahun_plan},
				type : 'POST',
				dataType : 'json',
				success: function(data){
					if(data.available==true){
						//checking a cabisat year
						if(tahun_plan%4==0){
							bulan_days = [31,29,31,30,31,30,31,31,30,31,30,31];
							//alert('tahun kabisat');
						}

						var jumlah_hari = bulan_days[bulan_plan-1]; //dikurangi 1 karena di js bulan dimulai dari 0 = januari

						for(var x=1;x<=jumlah_hari;x++){
							var today = new Date(tahun_plan,bulan_plan-1,x);
							var hari = hari_name[today.getDay()];
/*							if(hari=='Minggu'){'<option value="0">Libur</option>'}*/
							$('#workday_plan_generated').find('tbody').append('<tr>');
							$('#workday_plan_generated').find('tbody').append('<td>'+hari+', '+x+' '+bulan_name[bulan_plan-1]+' '+tahun_plan+'</td>');
							$('#workday_plan_generated').find('tbody').append('<td><select name="status[]" id="status_'+x+'" class="form-control">'+
																				'<option value="0">Libur</option>'+
																				'<option selected value="1">Masuk</option>'+
																			'</select></td>');
							$('#workday_plan_generated').find('tbody').append('<td><input type="text" name="keterangan[]" id="keterangan_'+x+'" class="form-control"></td>');
							$('#workday_plan_generated').find('tbody').append('</tr>');
						}

						//move to posting side
						$('#hidden_bulan_plan').val(bulan_plan);
						$('#hidden_tahun_plan').val(tahun_plan);

						$('#result_plan_date_section').fadeIn('slow');
					}else{
						alert('Data untuk bulan yg Anda pilih sudah terdaftar, silahkan untuk menggantinya.');
					}
				}
			});
		}

		return false;
	});

	/******** MASTER JAM KERJA *********/
	/***********************************/
	$('#master_jam_masuk').datetimepicker({
		pickDate:false
	});

	$('#master_jam_keluar').datetimepicker({
		pickDate:false
	});

	/***************END*******************/


	//********* PRESENCES ***************/
	$('#presences_date_start').datetimepicker({
		pickTime:false
	});

	$('#presences_date_end').datetimepicker({
		pickTime:false
	});
	//***********************************/


	/*********** HARI LIBUR ************/
	/***********************************/
	$('#tanggal_libur').datetimepicker({
		pickTime:false
	});

	// var count_alasan = parseInt($('#count_libur_request').val());
	var count_libur = parseInt($('#count_libur_request').val());
	var counter = 0;
	var html_add = '';

	$('#add_day_off').click(function(){
		if($('#tanggal_libur').val()==''){
			alert('Tanggal Harus diisi.');
			$('#tanggal_libur').focus();
		}else if($('#keterangan_libur').val()==''){
			alert('Keterangan Harus diisi.');
			$('#keterangan_libur').focus();
		}else{
			count_libur = count_libur + 1;
			counter = counter + 1;

			html_add = '<tr id="row_'+counter+'">';
			html_add += '<td><input type="text" name="send_tanggal_request[]" class="form-control" id="send_tanggal_request_'+counter+'" value="'+$('#tanggal_libur').val()+'" readonly="true"></td>';
			// html_add += '<td><input type="hidden" name="send_id_alasan_request[]" id="send_id_alasan_request_'+counter+'" value="'+$('#alasan_request').val()+'"><input type="text" name="send_alasan_request[]" class="form-control" id="send_alasan_request_'+counter+'" value="'+$('#alasan_request option:selected').text()+'" readonly="true"></td>';
			html_add += '<td><input type="text" name="send_keterangan_request[]" class="form-control" id="send_keterangan_request_'+counter+'" value="'+$('#keterangan_libur').val()+'" readonly="true"></td>';
			html_add += '<td><a href="javascript:void(0)" class="btn btn-warning btn-remove-alasan" data-row="'+counter+'">Hapus</a></td>';
			html_add += '</tr>';

			$('#tabel_libur').append(html_add);

			$('#tanggal_libur').val('');
			// $('#alasan_request').val('');
			$('#keterangan_libur').val('');

			$('#count_libur_request').val(count_libur);

			allow_submit_libur();
		}
		return false;
	});

	//remove alasan row
	$('body').on('click','.btn-remove-alasan',function(){
		count_libur = count_libur - 1;
		$('#row_'+$(this).data('row')).remove();
		allow_submit_libur();
	});

	function allow_submit_libur(){
		if(count_libur > 0){
			$('#submit_day_off').removeAttr('disabled');
		}else{
			$('#submit_day_off').attr('disabled','true');
		}
	}
	//***********************************/


	//************* ATTENDANCE REQUEST **************//
	var count_alasan = parseInt($('#count_alasan_request').val());
	var counter = 0;
	var html_add = '';

	$('#tanggal_request').datetimepicker({
		pickTime:false
	});

	$('#tanggal_requesta').datetimepicker({
		pickTime:false
	});

	$('#nama_atasan').selectize({
	    create: true,
	    sortField: 'text'
	});

	$('#add_alasan_request').click(function(){
		if($('#tanggal_request').val()==''){
			alert('Tanggal Request must be filled in.');
			$('#tanggal_request').focus();
		}
		else if($('#tanggal_requesta').val()==''){
			alert('Tanggal Request must be filled in.');
			$('#tanggal_requesta').focus();
		}
		else if($('#alasan_request').val()==''){
			alert('Alasan Request must be choosen.');
			$('#alasan_request').focus();
		}
		else{
			count_alasan = count_alasan + 1;
			counter = counter + 1;

			html_add = '<tr id="row_'+counter+'">';
			html_add += '<td><input type="text" name="send_tanggal_request[]" class="form-control" id="send_tanggal_request_'+counter+'" value="'+$('#tanggal_request').val()+'" readonly="true"></td>';
			html_add += '<td><input type="text" name="send_tanggal_requesta[]" class="form-control" id="send_tanggal_request_'+counter+'" value="'+$('#tanggal_requesta').val()+'" readonly="true"></td>';
			html_add += '<td><input type="hidden" name="send_id_alasan_request[]" id="send_id_alasan_request_'+counter+'" value="'+$('#alasan_request').val()+'"><input type="text" name="send_alasan_request[]" class="form-control" id="send_alasan_request_'+counter+'" value="'+$('#alasan_request option:selected').text()+'" readonly="true"></td>';
			html_add += '<td><input type="text" name="send_keterangan_request[]" class="form-control" id="send_keterangan_request_'+counter+'" value="'+$('#keterangan_request').val()+'" readonly="true"></td>';
			html_add += '<td><a href="javascript:void(0)" class="btn btn-warning btn-remove-alasan" data-row="'+counter+'">Hapus</a></td>';
			html_add += '</tr>';

			$('#tabel_request').append(html_add);

			$('#tanggal_request').val('');
			$('#alasan_request').val('');
			$('#keterangan_request').val('');

			$('#count_alasan_request').val(count_alasan);

			allow_submit();
		}

		return false;
	});

	//remove alasan row
	$('body').on('click','.btn-remove-alasan',function(){
		count_alasan = count_alasan - 1;
		$('#row_'+$(this).data('row')).remove();
		allow_submit();
	});

	$('#nomor_induk').autocomplete({
		source: function(request, response){
			$.ajax({
				url : base_url + 'user/getUserAPI',
				dataType: 'json',
				data: {
					featureClass: "P",
		            style: "full",
		            maxRows: 12,
		            name_startsWith: request.term
				},
				success : function(data){
					response( $.map( data.data_pergawai, function( item ) {
		              return {
		                nomor_induk: item.nomor_induk,
		                label: item.nomor_induk + ' - ' + item.nama,
		                value: item.nomor_induk,
		                nama_lengkap: item.nama
		              }
		            }));
				}
			});
		},
		minLength: 18,
		select: function(event, ui){
                $('#nomor_induk').val(ui.item.nomor_induk);
                //$('#nik_atasan').val(ui.item.nik);
                $('#nama_atasan').val(ui.item.nama_lengkap);
      	}
	});

	function allow_submit(){
		if(count_alasan > 0){
			$('#submit_attendance_request').removeAttr('disabled');
		}else{
			$('#submit_attendance_request').attr('disabled','true');
		}
	}

	//**********************************************//
	

	//WORKDAYPLAN/MONTH_VIEW
	$('#calendar_month_view').fullCalendar({
		header: {
			left:   'title',
		    center: '',
		    right:  ''
		},
		events: {
			url: base_url + 'workday_plan/getting_month_events',
			type:'POST',
			data: {
				 bulan : $('#month_view_bulan').val(),
				 tahun : $('#month_view_tahun').val()
			},
			error: function(){
				alert('There was error when fetching events!');
			},
			backgroundColor: 'red',
			textColor: 'white'
		},
		dayClick: function(date, jsEvent, view) {
			$('#month_view_tanggal').val(date.format());

			$.ajax({
				url : base_url + 'workday_plan/detail_date',
				data : {tanggal : date.format()},
				type : 'POST',
				dataType : 'json',
				success: function(data){
					$('#month_view_id_perencanaan').val(data.id_perencanaan);
					$('#month_view_status').val(data.status);
					$('#month_view_keterangan').val(data.keterangan);
				}
			});

			$('#modal_calendar_month_view').modal('show');

	        /*alert('Clicked on: ' + date.format());

	        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

	        alert('Current view: ' + view.name);*/

	    }
	});

	var month_view_current_date = $('#month_view_tahun').val() + '-' + $('#month_view_bulan').val() + '-01'; 
	$('#calendar_month_view').fullCalendar('gotoDate',month_view_current_date);


	$('#month_view_save_changes').click(function(){
		//to updating hari kerja
		$.ajax({
			url : base_url + 'workday_plan/update',
			data : {
					id_perencanaan : $('#month_view_id_perencanaan').val(),
					status : $('#month_view_status').val(),
					keterangan : $('#month_view_keterangan').val()
					},
			type : 'POST',
			dataType : 'json',
			success: function(data){
				$('#modal_calendar_month_view').modal('hide');
				alert('Data berhasil diubah');

				$('#month_view_id_perencanaan').val('');
				$('#month_view_status').val('0');
				$('#month_view_keterangan').val('');

				window.location.reload();
			}
		});
	})
});

function alert_hide(){
	if($('.alert').length > 0){
		$('.alert').fadeOut(5000);
	}
}