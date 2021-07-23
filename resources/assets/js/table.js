var table = {
	init:function(){

		if ($('#tableNewsEvent').length) {
			var column = [
				{'data':'created_at'},
				{'data':'title'},
				{'data':'start_date'},
				{'data':'end_date'},
			];

			columnDefs = [
				{
					"targets": 2,
					"data": "type",
					"render": function(data, type, full, meta){
						var data = ''
		            	if (full.type == 1) {
		            	    data = '-';
		            	} else {
		            	    data = full.start_date;
		            	}
		               	return data;
					}
				},
				{
					"targets": 3,
					"data": "type",
					"render": function(data, type, full, meta){
						var data = ''
		            	if (full.type == 1) {
		            	    data = '-';
		            	} else {
		            	    data = full.end_date;
		            	}
		               	return data;
					}
				},
				{
					"targets": 4,
					"data": "type",
					"render": function(data, type, full, meta){
						var data = ''
		            	if (full.type == 1) {
		            	    data = 'News';
		            	} else {
		            	    data = 'Event';
		            	}
		               	return data;
					}
				},
                {
					"targets": 5,
					"data": "status",
					"render": function(data, type, full, meta){
						var data = ''
		            	if (full.status == 1) {
		            	    data = '<span class="status status-success">Active</span>';
		            	} else {
		            	    data = '<span class="status status-delete">Deactive</span>';
		            	}
		               	return data;
					}
				},
				{
					"targets": 6,
					"data": "id",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.id));
						var konfirm = '';
						var data = '<button type="button" class="btn btn-table btn-transparent"><a href="/HR/news_event/detail-news-event/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/lingkarEdit_icon.svg" title="Edit News/Event"></a></button>';
						if (full.status == '1') {
							konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmNewsEvent"><img style="margin-right: 1px;" src="/image/icon/main/lingkarHapus_icon.svg" title="Deaktif News/Event"></button>';
							
						} else {
							konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmNewsEvent"><img style="margin-right: 1px;" src="/image/icon/main/lingkarAktif_icon.svg" title="Aktifkan News/Event"></button>';
						}
		               	return data+konfirm;
					}
				}
			];

		 	table.serverSide('tableNewsEvent',column,'/HR/news_event/list-news-event',null,columnDefs)
        }

		if ($('#tableVacancy').length) {
			var column = [
				{'data':'created_at'},
				{'data':'job_title'},
				{'data':'type'},
				{'data':'degree'},
				{'data':'major'},
				{'data':'lokasi'},
				{'data':'work_time'},
				{'data':'active_date'},
				{'data':'total_applicant'},
				{'data':'status'},
			];

			columnDefs = [
				{
					"targets": 2,
					"data": "type",
					"render": function(data, type, full, meta){
						var data = ''
		            	if (full.type == 1) {
		            	    data = 'Full Time';
		            	} else {
		            	    data = 'Intership';
		            	}
		               	return data;
					}
				},
				{
					"targets": 3,
					"data": "degree",
					"render": function(data, type, full, meta){
						var data = ''
		            	if (full.degree == 1) {
		            	    data = 'D3';
		            	} else if(full.degree == 2) {
		            	    data = 'S1';
		            	}else{
							data = "S2"
						}
		               	return data;
					}
				},
				{
					"targets": 9,
					"data": "status",
					"render": function(data, type, full, meta){
						var data = ''
		            	if (full.status == 1) {
		            	    data = '<strong>Published</strong>';
		            	}else{
							data = "<p>Deactive</p>"
						}
		               	return data;
					}
				},
				{
					"targets": 10,
					"data": "id",
					"className": "action-poster-news",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.job_id));
						var konfirm = '';
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/vacancy/detail-vacancy/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Vacancy"> Edit&nbsp</a></button>';
						if (full.status == '1') {
							konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy edit-table"><img style="margin-right: 1px;" src="/image/icon/main/deactive.svg" title="Deaktif Vacancy">Deactive</button>';
						} else {
							konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy edit-table"><img style="margin-right: 1px;" src="/image/icon/main/active.svg" title="Aktifkan Vacancy">Active</button>';
						}
						var hasil = data+konfirm
		               	return hasil;
					}
				}
			];

		 	table.serverSide('tableVacancy',column,'HR/vacancy/list-vacancy',null,columnDefs)
        }

		if ($('#tableTest').length) {
			// $("#modalSuccessAddTest").modal('show')
			var column = [
				{'data':'created_at'},
				{'data':'event_id'},
				{'data':'date_test'},
				{'data':'time'},
				{'data':'city'},
				{'data':'location'},
				{'data':'set_test'},
				{'data':'status_test'},
			];

			columnDefs = [
				{
					"targets": 1,
					"data": "event_id",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.id));
						var data = '<a href="/HR/test/detail-test/'+id+'" class="name-candidate">'+full.event_id+'</a';
						return data;
					}
				},
				{
					"targets": 7,
					"data": "status_test",
					"render": function(data, type, full, meta){
						var data = ''
		            	if (full.status_test == 1 || full.status_test == 0) {
		            	    data = '<strong>New</strong>';
		            	}else if (full.status_test == 2) {
		            	    data = '<strong>In Progress</strong>';
						}else{
							data = "<p>Closed</p>"
						}
		            	return data;
					}
				},
				{
					"targets": 8,
					"data": "id",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.id));
						if (full.status_test == 1) {
							var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/test/edit-test/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Test">&nbsp Edit</a></button>';
						}else{
							data = '';
						}
		            	return data;
					}
				}
			];

			table.serverSide('tableTest',column,'HR/test/list-test',null,columnDefs)
        }

		if($('#tableAlternatifTest').length){
			var column = [
				{'data':null},
				{'data':'created_at'},
				{'data':'event_id'},
				{'data':'date_test'},
				{'data':'time'},
				{'data':'city'},
				{'data':'location'},
				{'data':'set_test'},
				{'data':'status_test'},
			];
	
			columnDefs = [
				{
					"targets": 0,
					"data": "id",
					"render": function(data, type, full, meta){
						var data = '<input class="check" type="checkbox" id="alternative_'+full.id+'">';
						return data;
					}
				},
				{
					"targets": 8,
					"data": "status_test",
					"render": function(data, type, full, meta){
						var data = ''
		            	if (full.status_test == 1 || full.status_test == 0) {
		            	    data = '<strong>New</strong>';
		            	}else if (full.status_test == 2) {
		            	    data = '<strong>In Progress</strong>';
						}else{
							data = "<p>Closed</p>"
						}
		            	return data;
					}
				},
				
			];
	
			table.serverSide('tableAlternatifTest',column,'HR/test/list-test',null,columnDefs)
		}

		if ($('#tableCandidate').length) {
			var column = [
				{'data':'created_at'},
				{'data':'first_name'},
				{'data':'email'},
				{'data':'tanggal_lahir'},
				{'data':'gender'},
				{'data':'telp'},
				{'data':'kota'}
			];

			columnDefs = [
				{
					"targets": 1,
					"data": "first_name",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.kandidat_id));
						var image = '';
						if (full.foto_profil == null || full.foto_profil == "") {
							image = baseUrl+'image/icon/homepage/dummy-profile.svg';
						}else{
							image = baseImage+'/'+full.foto_profil;
						}
						var data = '<img class="img-candidate" src="'+image+'" />'+'&nbsp'+full.first_name+' '+full.last_name;
						return data;
					}
				},
				{
					"targets": 4,
					"data": "gender",
					"render": function(data, type, full, meta){
						var data = '';
						if (full.gender == "1") {
							data = "Male";
						}else if (full.gender == "2") {
							data = "Female";
						}
						return data;
					}
				},
				{
					"targets": 7,
					"data": "id",
					"className": "action-poster-news",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.id));
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/candidate/edit-candidate/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Detail Job Application"> Edit&nbsp</a></button>';
		            	return data;
					}
				}
			];

		 	table.serverSide('tableCandidate',column,'HR/candidate/list-candidate',null,columnDefs)
        }

		if ($('#tableJob').length) {
			var value = $('#filterJob').serialize();
			var column = [
				{'data':null},
				{'data':'submit_date'},
				{'data':'name'},
				{'data':'age'},
				{'data':'gelar'},
				{'data':'universitas'},
				{'data':'fakultas'},
				{'data':'jurusan'},
				{'data':'gpa'},
				{'data':'graduate_year'},
				{'data':'job_position'},
				{'data':'area'},
				{'data':'status'},
			];

			columnDefs = [
				{
					"targets": 0,
					"orderable": false,
					"data": "job_application_id",
					"render": function(data, type, full, meta){
						var data = '<input class="check box'+full.status+'" type="checkbox" id="job_'+full.job_application_id+'_'+full.kandidat_id+'">';
						return data;
					}
				},
				{
					"targets": 2,
					"data": "name",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.kandidat_id));
						var image = '';
						if (full.foto_profil == null || full.foto_profil == "") {
							image = baseUrl+'image/icon/homepage/dummy-profile.svg';
						}else{
							image = baseImage+'/'+full.foto_profil;
						}
						var data = '<img class="img-candidate" src="'+image+'" />'+'&nbsp'+full.name;
						return data;
					}
				},
				{
					"targets": 4,
					"data": "gelar",
					"render": function(data, type, full, meta){
						var data = '';
						if (full.gelar == "1") {
							data = "D3";
						}else if (full.gelar == "2") {
							data = "S1";
						}else{
							data = "S2"
						}
						return data;
					}
				},
				{
					"targets": 12,
					"data": "status",
					"render": function(data, type, full, meta){
						var data = '';
						if (full.status == 0) {
							data = "Application Resume";
						}else if (full.status == 1) {
							data = "Process To Written Test";
						}else if (full.status == 2) {
							data = "Scheduled to Written Test";
						}else if (full.status == 3) {
							data = "Written Test Pass";
						}else if (full.status == 4) {
							data = "Written Test failed";
						}else if (full.status == 5) {
							data = "Process to HR interview";
						}else if (full.status == 6) {
							data = "Process to User Interview 1";
						}else if (full.status == 7) {
							data = "Process to User Interview 2";
						}else if (full.status == 8) {
							data = "Process to Direktur Interview";
						}else if (full.status == 9) {
							data = "Process to MCU";
						}else if (full.status == 10) {
							data = "Process to Doc Sign";
						}else if (full.status == 11) {
							data = "Failed";
						}else if (full.status == 13) {
							data = "HR interview Pass";
						}else if (full.status == 14) {
							data = "HR interview Fail";
						}else if (full.status == 15) {
							data = "User Interview 1 Pass";
						}else if (full.status == 16) {
							data = "User Interview 1 Fail";
						}else if (full.status == 17) {
							data = "User Interview 2 Pass";
						}else if (full.status == 18) {
							data = "User Interview 2 Fail";
						}else if (full.status == 19) {
							data = "Direktur Interview Pass";
						}else if (full.status == 20) {
							data = "Direktur Interview Fail";
						}else if (full.status == 21) {
							data = "MCU Pass";
						}else if (full.status == 22) {
							data = "MCU Fail";
						}else{
							data = "Hired";
						}
						return data;
					}
				},
				{
					"targets": 13,
					"data": "kandidat_id",
					"className": "action-poster-news",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.job_application_id));
						// var konfirm = '';
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/job/edit-job/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Detail Job Application"> Detail&nbsp</a></button>';
						// if (full.status == '1') {
						// 	konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy edit-table"><img style="margin-right: 1px;" src="/image/icon/main/deactive.svg" title="Deaktif Vacancy">Deactive</button>';
						// } else {
						// 	konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy edit-table"><img style="margin-right: 1px;" src="/image/icon/main/active.svg" title="Aktifkan Vacancy">Active</button>';
						// }
						// var hasil = data+konfirm
		               	return data;
					}
				}
			];

		 	table.serverSide('tableJob',column,'HR/job/list-job',value,columnDefs)
        }

		if ($('#tableParticipantTest').length) {
			var value = $("#idData").val();
			var column = [
				{'data':null},
				{'data':'name'},
				{'data':'universitas'},
				{'data':'jurusan'},
				{'data':'job_position'},
				{'data':'type'},
				{'data':'set_test'},
				{'data':'area'}
			];

			columnDefs = [
				{
					"targets": 0,
					"orderable": false,
					"data": "test_participant_id",
					"render": function(data, type, full, meta){
						var data = '<input type="checkbox" id="participant_'+full.test_participant_id+'">';
						return data;
					}
				},
				{
					"targets": 1,
					"data": "name",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.kandidat_id));
						var image = '';
						if (full.foto_profil == null || full.foto_profil == "") {
							image = baseUrl+'image/icon/homepage/dummy-profile.svg';
						}else{
							image = baseImage+'/'+full.foto_profil;
						}
						var data = '<img class="img-candidate" src="'+image+'" />'+'&nbsp'+full.name;
						return data;
					}
				},
				{
					"targets": 5,
					"data": "type",
					"render": function(data, type, full, meta){
						var data = ''
		            	if (full.type == 1) {
		            	    data = 'Full Time';
		            	} else {
		            	    data = 'Intership';
		            	}
		               	return data;
					}
				},
				{
					"targets": 6,
					"data": "set_test",
					"render": function(data, type, full, meta){
						var data = "";
						if (full.set_test == null) {
							data = "<span class='test-status-notset'>Not Set</span>"
						}else{
							data = "<span class='test-status-attend'>"+full.set_test+"</span>"
						}
						return data;
					}
				},
				{
					"targets": 8,
					"data": "status_participant",
					"render": function(data, type, full, meta){
						var data = "";
						if(full.status_participant == "0"){
							data = "<span class='test-status-notset'>Not Set</span>"
						}else if (full.status_participant == "2") {
							data = '<button type="button" class="btn btn-acc-reschedule">Request Reschedule</button>';
						}else if (full.status_participant == "7") {
							data = "<span class='test-status-notset'>Reschedule Decline</span>"
						}else{
							data = "<span class='test-status-attend'>Confirmed</span>"
						}
						return data;
					}
				},
			];

			table.serverSide('tableParticipantTest',column,'HR/test/list-candidate',value,columnDefs)
        }

		if ($('#tableParticipantTestTheDay').length) {
			
			var value = $("#idData").val();
			ajax.getData('HR/test/list-candidate-theday', 'post', {value:value}, function(data){
				var column = [
					{'data':null},
					{'data':'name'},
					{'data':'universitas'},
					{'data':'jurusan'},
					{'data':'job_position'},
					{'data':'type'},
					{'data':'set_test'},
					{'data':'area'},
					{'data':'status_participant'},
					{'data':'location_start_radius'},
				];

				columnDefs = [
					{
						"targets": 0,
						"orderable": false,
						"data": "test_participant_id",
						"render": function(data, type, full, meta){
							var data = '<input type="checkbox" class="check-all" id="participant_'+full.test_participant_id+'">';
							return data;
						}
					},
					{
						"targets": 1,
						"data": "name",
						"render": function(data, type, full, meta){
							var id = encodeURIComponent(window.btoa(full.kandidat_id));
							var image = '';
							if (full.foto_profil == null || full.foto_profil == "") {
								image = baseUrl+'image/icon/homepage/dummy-profile.svg';
							}else{
								image = baseImage+'/'+full.foto_profil;
							}
							var data = '<img class="img-candidate" src="'+image+'" />'+'&nbsp'+full.name;
							return data;
						}
					},
					{
						"targets": 5,
						"data": "type",
						"render": function(data, type, full, meta){
							var data = ''
							if (full.type == 1) {
								data = 'Full Time';
							} else {
								data = 'Intership';
							}
							return data;
						}
					},
					{
						"targets": 6,
						"data": "set_test",
						"render": function(data, type, full, meta){
							var data = "";
							if (full.set_test == null) {
								data = "<span class='test-status-notset'>Not Set</span>"
							}else{
								data = "<span class='test-status-attend'>"+full.set_test+"</span>"
							}
							return data;
						}
					},
					{
						"targets": 8,
						"data": "status_participant",
						"render": function(data, type, full, meta){
							var data = "";
							if(full.status_participant == "3"){
								data = "<span class='test-status-attend'>Attend</span>"
							}else if (full.status_participant == "4") {
								data = "<span class='test-status-absen'>Absence</span>"
							}else if (full.status_participant == "5") {
								data = "<span class='test-status-attend'>End Test</span>"
							}else if (full.status_participant == "6") {
								data = "<span class='test-status-absen'>Block</span>"
							}else if(full.status_participant == "1"){
								data = "<span class='test-status-attend'>Confirmed</span>"
							}else{
								data = "<span class='test-status-notset'>Not Set</span>"
							}
							return data;
						}
					},
					{
						"targets": 10,
						"data": "test_participant_id",
						"render": function(data, type, full, meta){
							var id = encodeURIComponent(window.btoa(full.test_participant_id));
							// var konfirm = '';
							var data = '<button type="button" class="btn btn-table btn-transparent edit-table send-otp-one"><img style="margin-right: 1px;" src="/image/icon/main/icon_send_otp.svg" title="Send OTP">&nbsp Send OTP</button>';
							return data;
						}
					}
				];
				table.setAndPopulate('tableParticipantTestTheDay', column, data, columnDefs, null, [1,'desc']);
			})
        }

		if ($('#tableParticipantFinish').length) {
			var value = $("#idData").val();
			var column = [
				{'data':'name'},
				{'data':'universitas'},
				{'data':'jurusan'},
				{'data':'job_position'},
				{'data':'type'},
				{'data':'set_test'},
				{'data':'area'},
			];

			columnDefs = [
				{
					"targets": 0,
					"data": "name",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.kandidat_id));
						var image = '';
						if (full.foto_profil == null || full.foto_profil == "") {
							image = baseUrl+'image/icon/homepage/dummy-profile.svg';
						}else{
							image = baseImage+'/'+full.foto_profil;
						}
						var data = '<img class="img-candidate" src="'+image+'" />'+'&nbsp'+full.name;
						return data;
					}
				},
				{
					"targets": 4,
					"data": "type",
					"render": function(data, type, full, meta){
						var data = ''
		            	if (full.type == 1) {
		            	    data = 'Full Time';
		            	} else {
		            	    data = 'Intership';
		            	}
		               	return data;
					}
				},
				{
					"targets": 5,
					"data": "set_test",
					"render": function(data, type, full, meta){
						var data = "";
						if (full.set_test == null) {
							data = "<span class='test-status-notset'>Not Set</span>"
						}else{
							data = "<span class='test-status-attend'>"+full.set_test+"</span>"
						}
						return data;
					}
				},
				{
					"targets": 7,
					"data": "status_participant",
					"render": function(data, type, full, meta){
						var data = "";
						if(full.status_participant == "3"){
							data = "<span class='test-status-attend'>Attend</span>"
						}else if (full.status_participant == "4") {
							data = "<span class='test-status-absen'>Absence</span>"
						}else if (full.status_participant == "5") {
							data = "<span class='test-status-attend'>End Test</span>"
						}else if (full.status_participant == "6") {
							data = "<span class='test-status-absen'>Block</span>"
						}else{
							data = "<span class='test-status-notset'>Not Set</span>"
						}
						return data;
					}
				},
				{
					"targets": 8,
					"data": "location_start_radius",
					"render": function(data, type, full, meta){
						return full.location_start_radius;
					}
				},
				{
					"targets": 9,
					"data": "location_end_radius",
					"render": function(data, type, full, meta){
						return full.location_end_radius;
					}
				},
				{
					"targets": 10,
					"data": "skor",
					"render": function(data, type, full, meta){
						return full.skor;
					}
				},
				{
					"targets": 11,
					"data": "start_time_participant",
					"render": function(data, type, full, meta){
						return full.start_time_participant;
					}
				},
				{
					"targets": 12,
					"data": "end_time_participant",
					"render": function(data, type, full, meta){
						return full.end_time_participant;
					}
				},
				{
					"targets": 13,
					"data": "test_participant_id",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.test_participant_id));
						// var konfirm = '';
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/test/view-result-test/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/icon_view.svg" title="View Result">&nbsp View</a></button>';
		            	return data;
					}
				}
			];

		 	table.serverSide('tableParticipantFinish',column,'HR/test/list-candidate-finish',value,columnDefs)
        }

		$(".setTest").click(function(){
			var row = $("#"+this.id).data('value');
			// console.log($("#"+this.id).data('value'))
			ajax.getData('/HR/question_bank/list-question', 'post', {set:row}, function(data){
				// console.log(data);
				var verbal = '';
				var numeric = '';
				var abstrak = '';
				var inventory = '';

				if (data.verbal.length) {
					var dataVerbal = '';
					for(var i = 0; i < data.verbal.length; i++){
						var id = encodeURIComponent(window.btoa(data.verbal[i].master_subtest_id+'_'+data.verbal[i].set+'_'+data.verbal[i].test_type+'_'+data.verbal[i].id));
						dataVerbal = dataVerbal+
									'<div class="col-lg-3 col-md-4 col-sm-12">'+
										'<a href="/HR/question_bank/detail-question-bank/'+id+'">'+
											'<div class="card-question-inside">'+
												'<div class="d-flex justify-content-between align-items-center">'+
													'<h5 class="mb-0">Verbal</h5>'+
												'</div>'+
												'<div class="content-question">'+
													'<p><b>'+data.verbal[i].sub_type+'</b>: '+data.verbal[i].name+'</p>'+
												'</div>'+
											'</div>'+
										'</a>'+
									'</div>'
					}
					verbal = '<div class="card-accordion">'+
										'<div class="card-accordion-head" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">'+
											'<h4 class="subtitle mb-0">Verbal</h4>'+
										'</div>'+
										'<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">'+
											'<div class="card-accordion-body">'+
												'<div class="row">'+
													dataVerbal+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'
				}

				if (data.numeric.length) {
					var dataNumeric = '';
					for(var i = 0; i < data.numeric.length; i++){
						var id = encodeURIComponent(window.btoa(data.numeric[i].master_subtest_id+'_'+data.numeric[i].set+'_'+data.numeric[i].test_type+'_'+data.numeric[i].id));
						dataNumeric = dataNumeric+
									'<div class="col-lg-3 col-md-4 col-sm-12">'+
										'<a href="/HR/question_bank/detail-question-bank/'+id+'">'+
											'<div class="card-question-inside">'+
												'<div class="d-flex justify-content-between align-items-center">'+
													'<h5 class="mb-0">Numeric</h5>'+
												'</div>'+
												'<div class="content-question">'+
													'<p><b>'+data.numeric[i].sub_type+'</b>: '+data.numeric[i].name+'</p>'+
												'</div>'+
											'</div>'+
										'</a>'+
									'</div>'
					}
					numeric = '<div class="card-accordion">'+
										'<div class="card-accordion-head" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">'+
											'<h4 class="subtitle mb-0">Numeric</h4>'+
										'</div>'+
										'<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">'+
											'<div class="card-accordion-body">'+
												'<div class="row">'+
													dataNumeric+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'
				}

				if (data.abstrak.length) {
					var dataAbstrak = '';
					for(var i = 0; i < data.abstrak.length; i++){
						var id = encodeURIComponent(window.btoa(data.abstrak[i].master_subtest_id+'_'+data.abstrak[i].set+'_'+data.abstrak[i].test_type+'_'+data.abstrak[i].id));
						dataAbstrak = dataAbstrak+
									'<div class="col-lg-3 col-md-4 col-sm-12">'+
										'<a href="/HR/question_bank/detail-question-bank/'+id+'">'+
											'<div class="card-question-inside">'+
												'<div class="d-flex justify-content-between align-items-center">'+
													'<h5 class="mb-0">Abstrak</h5>'+
												'</div>'+
												'<div class="content-question">'+
													'<p><b>'+data.abstrak[i].sub_type+'</b>: '+data.abstrak[i].name+'</p>'+
												'</div>'+
											'</div>'+
										'</a>'+
									'</div>'
					}
					abstrak = '<div class="card-accordion">'+
										'<div class="card-accordion-head" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">'+
											'<h4 class="subtitle mb-0">Abstrak</h4>'+
										'</div>'+
										'<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">'+
											'<div class="card-accordion-body">'+
												'<div class="row">'+
													dataAbstrak+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'
				}

				if (data.inventory.length) {
					var dataInventory = '';
					for(var i = 0; i < data.inventory.length; i++){
						var id = encodeURIComponent(window.btoa(data.inventory[i].master_subtest_id+'_'+data.inventory[i].set+'_'+data.inventory[i].test_type+'_'+data.inventory[i].id));
						dataInventory = dataInventory+
									'<div class="col-lg-3 col-md-4 col-sm-12">'+
										'<a href="/HR/question_bank/detail-question-bank/'+id+'">'+
											'<div class="card-question-inside">'+
												'<div class="d-flex justify-content-between align-items-center">'+
													'<h5 class="mb-0">Inventory</h5>'+
												'</div>'+
												'<div class="content-question">'+
												'<p><b>'+data.inventory[i].sub_type+'</b></p>'+
												'</div>'+
											'</div>'+
										'</a>'+
									'</div>'
					}
					inventory = '<div class="card-accordion">'+
										'<div class="card-accordion-head" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">'+
											'<h4 class="subtitle mb-0">Inventory</h4>'+
										'</div>'+
										'<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">'+
											'<div class="card-accordion-body">'+
												'<div class="row">'+
													dataInventory+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'
				}

				var head = '<div class="accordion accordion-question-bank">'+
								verbal+
								numeric+
								abstrak+
								inventory+
							'</div>'

				$("#bodyTest"+row).empty();
				$("#bodyTest"+row).append(head);
			});
		})

		if ($('#tableInterview').length) {
			var column = [
				{'data':'interview_date'},
				{'data':'first_name'},
				{'data':'job_title'},
				{'data':'area_vacancy'},
				{'data':'type_name'},
				{'data':'interviewer'},
				{'data':'time'},
				{'data':'city'},
				{'data':'location'},
				{'data':'status'},
				{'data':'note'},
			];

			columnDefs = [
				{
					"targets": 1,
					"data": "first_name",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.kandidat_id));
						var image = '';
						if (full.foto_profil == null || full.foto_profil == "") {
							image = baseUrl+'image/icon/homepage/dummy-profile.svg';
						}else{
							image = baseImage+'/'+full.foto_profil;
						}
						var data = '<img class="img-candidate" src="'+image+'" />'+'&nbsp'+full.first_name+' '+full.last_name;
						return data;
					}
				},
				{
					"targets": 9,
					"data": "status",
					"render": function(data, type, full, meta){
						var data = '';
						if (full.status == 1) {
							data = "<span class='test-status-attend'>New</span>"
						}else if (full.status == 2) {
							data = "<span class='test-status-attend'>Pass</span>";
						}else if (full.status == 3) {
							data = "<span class='test-status-absen'>Fail</span>";
						}else if (full.status == 4) {
							data = "<span class='test-status-notset'>Reschedule</span>";
						}else if (full.status == 5) {
							data = "<span class='test-status-absen'>Reschedule Decline</span>";
						}else{
							data = "<span class='test-status-attend'>Confirm</span>";
						}
						return data;
					}
				},
				{
					"targets": 10,
					"data": "note",
					"render": function(data, type, full, meta){
						var data = '';
						if (full.note != null) {
							if (full.note.length > 25) {
								data = full.note.substring(0, 24) + "...";
							}else{
								data = full.note;
							}
						}
						return data;
					}
				},
				{
					"targets": 11,
					"data": "id",
					"className": "action-poster-news",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.id));
						var konfirm = "";
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/interview/edit-interview/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Interview"> Edit&nbsp</a></button>';
						if (full.status == "1" || full.status == "6") {
							konfirm = '<button type="button" class="btn btn-table btn-transparent btn-update-status edit-table"><img style="margin-right: 1px;" src="/image/icon/main/icon_update_status.svg" title="Update Status">Update Status</button>';
						}
						var hasil = data+konfirm
		               	return hasil;
					}
				}
			];

		 	table.serverSide('tableInterview',column,'HR/interview/list-interview',null,columnDefs)
        }

		if ($("#tableChooseInterview").length) {
			var value = $("#typeInterview").val()
			var column = [
				{'data':null},
				{'data':'first_name'},
				{'data':'gender'},
				{'data':'telp'},
				{'data':'kota'},
				{'data':'job_title'},
				{'data':'status'},
			];
	
			columnDefs = [
				{
					"targets": 0,
					"orderable": false,
					"data": "job_application_id",
					"render": function(data, type, full, meta){
						var data = '<input class="choose" type="checkbox" id="interview_'+full.job_application_id+'">';
						return data;
					}
				},
				{
					"targets": 1,
					"data": "name",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.kandidat_id));
						var image = '';
						if (full.foto_profil == null || full.foto_profil == "") {
							image = baseUrl+'image/icon/homepage/dummy-profile.svg';
						}else{
							image = baseImage+'/'+full.foto_profil;
						}
						var data = '<img class="img-candidate" src="'+image+'" />'+'&nbsp'+full.first_name+' '+full.last_name;
						return data;
					}
				},
				{
					"targets": 2,
					"data": "gender",
					"render": function(data, type, full, meta){
						var data = '';
						if (full.gender == "1") {
							data = "Male";
						}else if (full.gender == "2") {
							data = "Female";
						}
						return data;
					}
				},
				{
					"targets": 6,
					"data": "status",
					"render": function(data, type, full, meta){
						var data = '';
						if (full.status == 0) {
							data = "Application Resume";
						}else if (full.status == 1) {
							data = "Process To Written Test";
						}else if (full.status == 2) {
							data = "Scheduled to Written Test";
						}else if (full.status == 3) {
							data = "Written Test Pass";
						}else if (full.status == 4) {
							data = "Written Test failed";
						}else if (full.status == 5) {
							data = "Process to HR interview";
						}else if (full.status == 6) {
							data = "Process to User Interview 1";
						}else if (full.status == 7) {
							data = "Process to User Interview 2";
						}else if (full.status == 8) {
							data = "Process to Direktur Interview";
						}else if (full.status == 9) {
							data = "Process to MCU";
						}else if (full.status == 10) {
							data = "Process to Doc Sign";
						}else if (full.status == 11) {
							data = "Failed";
						}else if (full.status == 13) {
							data = "HR interview Pass";
						}else if (full.status == 14) {
							data = "HR interview Fail";
						}else if (full.status == 15) {
							data = "User Interview 1 Pass";
						}else if (full.status == 16) {
							data = "User Interview 1 Fail";
						}else if (full.status == 17) {
							data = "User Interview 2 Pass";
						}else if (full.status == 18) {
							data = "User Interview 2 Fail";
						}else if (full.status == 19) {
							data = "Direktur Interview Pass";
						}else if (full.status == 20) {
							data = "Direktur Interview Fail";
						}else if (full.status == 21) {
							data = "MCU Pass";
						}else if (full.status == 22) {
							data = "MCU Fail";
						}else{
							data = "Hired";
						}
						return data;
					}
				},
			];
	
			table.serverSide('tableChooseInterview',column,'HR/interview/list-candidate-pick',value,columnDefs)
		}

		if ($('#tableUniv').length) {
			var column = [
				{'data':'universitas'},
			];

			columnDefs = [
				{
					"targets": 1,
					"data": "id",
					"className": "action-poster-news",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.id));
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2 edit-table edit-master"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Data Master">&nbsp Edit&nbsp</button>';
						var konfirm = '<button type="button" class="btn btn-table btn-transparent edit-table delete-master"><img style="margin-right: 1px;" src="/image/icon/main/delete_red.svg" title="Delete Data Master">&nbspDelete</button>';
						var hasil = data+konfirm
		               	return hasil;
					}
				}
			];

		 	table.serverSide('tableUniv',column,'HR/master/list-universitas',null,columnDefs)
        }

		$("#tabMajor").click(function(){
			var column = [
				{'data':'major'},
			];

			columnDefs = [
				{
					"targets": 1,
					"data": "id",
					"className": "action-poster-news",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.id));
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2 edit-table edit-master"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Data Master">&nbsp Edit&nbsp</button>';
						konfirm = '<button type="button" class="btn btn-table btn-transparent edit-table delete-master"><img style="margin-right: 1px;" src="/image/icon/main/delete_red.svg" title="Delete Data Master">&nbspDelete</button>';
						var hasil = data+konfirm
		               	return hasil;
					}
				}
			];

		 	table.serverSide('tableMajor',column,'HR/master/list-major',null,columnDefs)
		})

		$("#tabUniv").click(function(){
			var column = [
				{'data':'universitas'},
			];

			columnDefs = [
				{
					"targets": 1,
					"data": "id",
					"className": "action-poster-news",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.id));
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2 edit-table edit-master"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Data Master">&nbsp Edit&nbsp</button>';
						konfirm = '<button type="button" class="btn btn-table btn-transparent edit-table delete-master"><img style="margin-right: 1px;" src="/image/icon/main/delete_red.svg" title="Delete Data Master">&nbspDelete</button>';
						var hasil = data+konfirm
		               	return hasil;
					}
				}
			];

		 	table.serverSide('tableUniv',column,'HR/master/list-universitas',null,columnDefs)
		})

		if ($("#formFilterDashboard").length) {
			$('#dateStart').datetimepicker({
				format: 'DD-MM-YYYY',
			});
		
			$('#dateEnd').datetimepicker({
				format: 'DD-MM-YYYY',
			});

			var dateStart = $("#dateStart").val();
			var dateEnd = $("#dateEnd").val();
			var dateTopScore = encodeURIComponent(window.btoa(dateStart+'_'+dateEnd+'_1'));
			var dateCandidatePass = encodeURIComponent(window.btoa(dateStart+'_'+dateEnd+'_2'));
			var dateAverage = encodeURIComponent(window.btoa(dateStart+'_'+dateEnd+'_3'));
			var dateUniversitas = encodeURIComponent(window.btoa(dateStart+'_'+dateEnd+'_4'));
			var dateMajor = encodeURIComponent(window.btoa(dateStart+'_'+dateEnd+'_5'));

			$("#downloadTopScore").attr('href', '/HR/download-dashboard/'+dateTopScore)
			$("#downloadCandidatePass").attr('href', '/HR/download-dashboard/'+dateCandidatePass)
			$("#downloadAverage").attr('href', '/HR/download-dashboard/'+dateAverage)
			$("#downloadUniversitas").attr('href', '/HR/download-dashboard/'+dateUniversitas)
			$("#downloadMajor").attr('href', '/HR/download-dashboard/'+dateMajor)

			var value = $("#formFilterDashboard").serialize();
			// console.log(value);
			ajax.getData('/HR/top-score', 'post', value, function(data){
				if (data.length) {
					for (let i = 0; i < data.length; i++) {
						if (data[i].foto_profil == null || data[i].foto_profil == "") {
							var image = baseUrl+'image/icon/homepage/dummy-profile.svg';
						}else{
							var image = baseImage+'/'+data[i].foto_profil;
						}
						var dataTopScore = '<div class="row">'+
												'<div class="col-md-10">'+
													'<p class="text-name"><img class="img-candidate" src="'+image+'" alt="">&nbsp'+data[i].first_name+'&nbsp'+data[i].last_name+'</p>'+
												'</div>'+
												'<div class="col-md-2">'+
													'<p class="text-nilai">'+parseInt(data[i].skor)+'</p>'+
												'</div>'+
											'</div>';
						$("#dataTopScore").append(dataTopScore);
					}
					
				}
			})

			ajax.getData('/HR/candidate-pass', 'post', value, function(data){

				var bar = new ProgressBar.Circle(progressCandidate, {
					color: '#DF0E2C',
					// This has to be the same size as the maximum width to
					// prevent clipping
					strokeWidth: 4,
					trailWidth: 1,
					easing: 'easeInOut',
					duration: 1400,
					text: {
						autoStyleContainer: false
					},
					from: { color: '#DF0E2C', width: 4 },
					to: { color: '#DF0E2C', width: 4 },
					// Set default step function for all animate calls
					step: function(state, circle) {
						circle.path.setAttribute('stroke', state.color);
						circle.path.setAttribute('stroke-width', state.width);
						var value = Math.round(data.persentase * 100);
						circle.setText(value+'%');
					}
				});
				bar.text.style.fontFamily = '"inter_bold", sans-serif';
				bar.text.style.fontSize = '16px';
				bar.animate(data.persentase); 

				$("#candidatePass").html(data.pass);
				$("#candidateAll").html(data.total)
			})

			ajax.getData('/HR/average-score', 'post', value, function(data){
				$("#averageVerbal").html(data.verbal)
				$("#averageNumeric").html(data.numeric)
				$("#averageAbstrak").html(data.abstrak)
			})

			ajax.getData('/HR/application-university', 'post', value, function(univ){
				var color = [];
				function dynamicColors() {
					var r = Math.floor(Math.random() * 255);
					var g = Math.floor(Math.random() * 255);
					var b = Math.floor(Math.random() * 255);
					
					return "rgb(" + r + "," + g + "," + b + ")";
				};
				if (univ.label.length) {
					for (let i = 0; i < univ.label.length; i++) {
						color.push(dynamicColors());
						
					}
				}
				var data = {
					labels: univ.label,
					datasets: [
						{
							backgroundColor: color,
							pointBackgroundColor: color,
							data: univ.result
						}
					]
				};
				
				var ctx = document.getElementById("chartApplicantUniversity");
				
				var myRadarChart = new Chart(ctx, {
					type: 'doughnut',
					data: data,
					options: {
						responsive: true,
						plugins: {
							legend: {
								display: false,
							},
							title: {
								display: false
							}
						}
					}
				});
			})

			ajax.getData('/HR/application-major', 'post', value, function(major){
				var color = [];
				function dynamicColors() {
					var r = Math.floor(Math.random() * 255);
					var g = Math.floor(Math.random() * 255);
					var b = Math.floor(Math.random() * 255);
					
					return "rgb(" + r + "," + g + "," + b + ")";
				};
				if (major.label.length) {
					for (let i = 0; i < major.label.length; i++) {
						color.push(dynamicColors());
						
					}
				}
				var data = {
					labels: major.label,
					datasets: [
						{
							backgroundColor: color,
							pointBackgroundColor: color,
							data: major.result
						}
					]
				};
				
				var ctx = document.getElementById("chartApplicantMajor");
				
				var majorChart = new Chart(ctx, {
					type: 'doughnut',
					data: data,
					options: {
						responsive: true,
						plugins: {
							legend: {
								display: false,
							},
							title: {
								display: false
							}
						}
					}
				});
			})
		}

		if ($('#tableUser').length) {
			var column = [
				{'data':'created_at'},
				{'data':'first_name'},
				{'data':'last_name'},
				{'data':'email'},
				{'data':'gender'},
				{'data':'telp'},
				{'data':'role_name'},
				{'data':'status'},
			];

			columnDefs = [
				{
					"targets": 4,
					"data": "id",
					"render": function(data, type, full, meta){
						var data = '';
						if (full.gender == "1") {
							data = "Male"
						}else{
							data = "Female"
						}
						return data;
					}
				},
				{
					"targets": 7,
					"data": "id",
					"render": function(data, type, full, meta){
						var data = '';
						if (full.status == "1") {
							data = "<span class='test-status-attend'>Active</span>";
						}else{
							data = "<span class='test-status-absen'>Deactive</span>";
						}
						return data;
					}
				},
				{
					"targets": 8,
					"data": "id",
					"className": "action-poster-news",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.id));
						var konfirm = '';
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/user/edit-user/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit User"> Edit&nbsp</a></button>';
						if (full.status == '1') {
							konfirm = '<button type="button" class="btn btn-table btn-transparent delete-user edit-table"><img style="margin-right: 1px;" src="/image/icon/main/deactive.svg" title="Deaktif User">Deactive</button>';
						} else {
							konfirm = '<button type="button" class="btn btn-table btn-transparent delete-user edit-table"><img style="margin-right: 1px;" src="/image/icon/main/active.svg" title="Aktifkan User">Active</button>';
						}
						var hasil = data+konfirm
		               	return hasil;
					}
				}
			];

		 	table.serverSide('tableUser',column,'HR/user/list-user',null,columnDefs)
        }

	},
	filter:function(id,value){
		if (id == 'filterSearchList' || id == 'filterJobList') {
			$('.loadMoreJob').hide();
			ajax.getData('/job-more', 'post', {value:value}, function(data){
				$('#loadJobs').empty()
				if (data.length > 0) {
					for (let i = 0; i < data.length; i++) {
						var id = encodeURIComponent(window.btoa(data[i]['job_id']));
			
						if (data[i]['type'] == 1) {
							var type = '<div class="fulltime-badge mb-3">Full-time</div>';
						} else if (data[i]['type'] == 2) {
							var type = '<div class="internship-badge mb-3">Internship</div>'
						}
			
						var option = '<div class="col-lg-4 col-md-6 col-sm-12 my-3">'+
										'<div class="card card-job-list">'+
											'<a href="/job/detail/'+id+'" class="text-decoration-none">'+
												'<div class="card-body">'+
													type+
													'<label class="label-no-margin mb-1">'+data[i]['lokasi']+', Indonesia</label>'+
													'<h4 class="candidate-page-subtitle mb-3">'+data[i]['job_title']+'</h4>'+
													
													'<div class="d-flex align-items-center job-list-detail mb-1">'+
														'<div class="icon-wrapper">'+
															'<img src="/image/icon/homepage/icon-graduate.svg" alt="icon">'+
														'</div>'+
														'<p class="text">'+data[i]['education_req']+'</p>'+
													'</div>'+
													'<div class="d-flex align-items-center job-list-detail">'+
														'<div class="icon-wrapper">'+
															'<img src="/image/icon/homepage/icon-book.svg" alt="icon">'+
														'</div>'+
														'<p class="text">'+data[i]['major']+'</p>'+
													'</div>'+
												'</div>'+
											'</a>'+
										'</div>'+
									'</div>';
			
						$('#loadJobs').append(option)
					}
				} else {
					var option = '<div class="col-12 my-3">'+
									'<div class="card card-job-list">'+
										'<p style="font-size: 23px;margin: 2rem 0px;text-align: center;">Data Not Found</p>'+
									'</div>'+
								'</div>';
			
					$('#loadJobs').append(option)
				}
			})
		}

		if (id == 'filterJob') {
			$("#btnDownloadJob").attr('href', '/HR/job/download-job/'+value)
			var column = [
				{'data':null},
				{'data':'submit_date'},
				{'data':'name'},
				{'data':'age'},
				{'data':'gelar'},
				{'data':'universitas'},
				{'data':'fakultas'},
				{'data':'jurusan'},
				{'data':'gpa'},
				{'data':'graduate_year'},
				{'data':'job_position'},
				{'data':'area'},
				{'data':'status'},
			];

			columnDefs = [
				{
					"targets": 0,
					"orderable": false,
					"data": "job_application_id",
					"render": function(data, type, full, meta){
						var data = '<input class="check box'+full.status+'" type="checkbox" id="job_'+full.job_application_id+'_'+full.kandidat_id+'">';
						return data;
					}
				},
				{
					"targets": 2,
					"data": "name",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.kandidat_id));
						var image = '';
						if (full.foto_profil == null || full.foto_profil == "") {
							image = baseUrl+'image/icon/homepage/dummy-profile.svg';
						}else{
							image = baseImage+'/'+full.foto_profil;
						}
						var data = '<img class="img-candidate" src="'+image+'" />'+'&nbsp'+full.name;
						return data;
					}
				},
				{
					"targets": 4,
					"data": "gelar",
					"render": function(data, type, full, meta){
						var data = '';
						if (full.gelar == "1") {
							data = "D3";
						}else if (full.gelar == "2") {
							data = "S1";
						}else{
							data = "S2"
						}
						return data;
					}
				},
				{
					"targets": 12,
					"data": "status",
					"render": function(data, type, full, meta){
						var data = '';
						if (full.status == 0) {
							data = "Application Resume";
						}else if (full.status == 1) {
							data = "Process To Written Test";
						}else if (full.status == 2) {
							data = "Scheduled to Written Test";
						}else if (full.status == 3) {
							data = "Written Test Pass";
						}else if (full.status == 4) {
							data = "Written Test failed";
						}else if (full.status == 5) {
							data = "Process to HR interview";
						}else if (full.status == 6) {
							data = "Process to User Interview 1";
						}else if (full.status == 7) {
							data = "Process to User Interview 2";
						}else if (full.status == 8) {
							data = "Process to Direktur Interview";
						}else if (full.status == 9) {
							data = "Process to MCU";
						}else if (full.status == 10) {
							data = "Process to Doc Sign";
						}else if (full.status == 11) {
							data = "Failed";
						}else if (full.status == 13) {
							data = "HR interview Pass";
						}else if (full.status == 14) {
							data = "HR interview Fail";
						}else if (full.status == 15) {
							data = "User Interview 1 Pass";
						}else if (full.status == 16) {
							data = "User Interview 1 Fail";
						}else if (full.status == 17) {
							data = "User Interview 2 Pass";
						}else if (full.status == 18) {
							data = "User Interview 2 Fail";
						}else if (full.status == 19) {
							data = "Direktur Interview Pass";
						}else if (full.status == 20) {
							data = "Direktur Interview Fail";
						}else if (full.status == 21) {
							data = "MCU Pass";
						}else if (full.status == 22) {
							data = "MCU Fail";
						}else{
							data = "Hired";
						}
						return data;
					}
				},
				{
					"targets": 13,
					"data": "kandidat_id",
					"className": "action-poster-news",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.job_application_id));
						// var konfirm = '';
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/job/edit-job/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Detail Job Application"> Detail&nbsp</a></button>';
						// if (full.status == '1') {
						// 	konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy edit-table"><img style="margin-right: 1px;" src="/image/icon/main/deactive.svg" title="Deaktif Vacancy">Deactive</button>';
						// } else {
						// 	konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy edit-table"><img style="margin-right: 1px;" src="/image/icon/main/active.svg" title="Aktifkan Vacancy">Active</button>';
						// }
						// var hasil = data+konfirm
		               	return data;
					}
				}
			];

		 	table.serverSide('tableJob',column,'HR/job/list-job',value,columnDefs)
		}

		if (id == 'formFilterDashboard') {
			var dateStart = $("#dateStart").val();
			var dateEnd = $("#dateEnd").val();
			var dateTopScore = encodeURIComponent(window.btoa(dateStart+'_'+dateEnd+'_1'));
			var dateCandidatePass = encodeURIComponent(window.btoa(dateStart+'_'+dateEnd+'_2'));
			var dateAverage = encodeURIComponent(window.btoa(dateStart+'_'+dateEnd+'_3'));
			var dateUniversitas = encodeURIComponent(window.btoa(dateStart+'_'+dateEnd+'_4'));
			var dateMajor = encodeURIComponent(window.btoa(dateStart+'_'+dateEnd+'_5'));

			$("#downloadTopScore").attr('href', '/HR/download-dashboard/'+dateTopScore)
			$("#downloadCandidatePass").attr('href', '/HR/download-dashboard/'+dateCandidatePass)
			$("#downloadAverage").attr('href', '/HR/download-dashboard/'+dateAverage)
			$("#downloadUniversitas").attr('href', '/HR/download-dashboard/'+dateUniversitas)
			$("#downloadMajor").attr('href', '/HR/download-dashboard/'+dateMajor)

			$("#dataTopScore").empty();
			$("#divChartUniv").empty();
			$("#divProgressCandidate").empty();
			$("#divProgressCandidate").append('<div id="progressCandidate" class="progress-bar-dashboard"></div>');
			$("#divChartUniv").append('<canvas class="chart-dashboard" id="chartApplicantUniversity" width="50" height="50"></canvas>');
			$("#divChartMajor").empty();
			$("#divChartMajor").append('<canvas class="chart-dashboard" id="chartApplicantMajor" width="50" height="50"></canvas>');
			ajax.getData('/HR/top-score', 'post', value, function(data){
				if (data.length) {
					for (let i = 0; i < data.length; i++) {
						if (data[i].foto_profil == null || data[i].foto_profil == "") {
							var image = baseUrl+'image/icon/homepage/dummy-profile.svg';
						}else{
							var image = baseImage+'/'+data[i].foto_profil;
						}
						var dataTopScore = '<div class="row">'+
												'<div class="col-md-10">'+
													'<p class="text-name"><img class="img-candidate" src="'+image+'" alt="">&nbsp'+data[i].first_name+'&nbsp'+data[i].last_name+'</p>'+
												'</div>'+
												'<div class="col-md-2">'+
													'<p class="text-nilai">'+parseInt(data[i].skor)+'</p>'+
												'</div>'+
											'</div>';
						$("#dataTopScore").append(dataTopScore);
					}
					
				}
			})

			ajax.getData('/HR/candidate-pass', 'post', value, function(data){

				var bar = new ProgressBar.Circle(progressCandidate, {
					color: '#DF0E2C',
					// This has to be the same size as the maximum width to
					// prevent clipping
					strokeWidth: 4,
					trailWidth: 1,
					easing: 'easeInOut',
					duration: 1400,
					text: {
						autoStyleContainer: false
					},
					from: { color: '#DF0E2C', width: 4 },
					to: { color: '#DF0E2C', width: 4 },
					// Set default step function for all animate calls
					step: function(state, circle) {
						circle.path.setAttribute('stroke', state.color);
						circle.path.setAttribute('stroke-width', state.width);
						var value = Math.round(data.persentase * 100);
						circle.setText(value+'%');
					}
				});
				bar.text.style.fontFamily = '"inter_bold", sans-serif';
				bar.text.style.fontSize = '16px';
				bar.animate(data.persentase); 

				$("#candidatePass").html(data.pass);
				$("#candidateAll").html(data.total)
			})

			ajax.getData('/HR/average-score', 'post', value, function(data){
				$("#averageVerbal").html(data.verbal)
				$("#averageNumeric").html(data.numeric)
				$("#averageAbstrak").html(data.abstrak)
			})

			ajax.getData('/HR/application-university', 'post', value, function(univ){
				var color = [];
				function dynamicColors() {
					var r = Math.floor(Math.random() * 255);
					var g = Math.floor(Math.random() * 255);
					var b = Math.floor(Math.random() * 255);
					
					return "rgb(" + r + "," + g + "," + b + ")";
				};
				if (univ.label.length) {
					for (let i = 0; i < univ.label.length; i++) {
						color.push(dynamicColors());
						
					}
				}
				var data = {
					labels: univ.label,
					datasets: [
						{
							backgroundColor: color,
							pointBackgroundColor: color,
							data: univ.result
						}
					]
				};
				
				var ctx = document.getElementById("chartApplicantUniversity");
				
				var myRadarChart = new Chart(ctx, {
					type: 'doughnut',
					data: data,
					options: {
						responsive: true,
						plugins: {
							legend: {
								display: false,
							},
							title: {
								display: false
							}
						}
					}
				});
			})

			ajax.getData('/HR/application-major', 'post', value, function(major){
				var color = [];
				function dynamicColors() {
					var r = Math.floor(Math.random() * 255);
					var g = Math.floor(Math.random() * 255);
					var b = Math.floor(Math.random() * 255);
					
					return "rgb(" + r + "," + g + "," + b + ")";
				};
				if (major.label.length) {
					for (let i = 0; i < major.label.length; i++) {
						color.push(dynamicColors());
						
					}
				}
				var data = {
					labels: major.label,
					datasets: [
						{
							backgroundColor: color,
							pointBackgroundColor: color,
							data: major.result
						}
					]
				};
				
				var ctx = document.getElementById("chartApplicantMajor");
				
				var majorChart = new Chart(ctx, {
					type: 'doughnut',
					data: data,
					options: {
						responsive: true,
						plugins: {
							legend: {
								display: false,
							},
							title: {
								display: false
							}
						}
					}
				});
			})
		}

		if (id == "filterReport") {
			var type = $("#categoryReport").val();
			var dateStart = $("#dateStartReport").val();
			var dateEnd = $("#dateEndReport").val();
			var kota = $("#kotaReport").val();
			var univ = $("#universitasReport").val();
			var linkDonwload = encodeURIComponent(window.btoa(dateStart+'_'+dateEnd+'_'+type+'_'+kota+'_'+univ));
			$(".btn-download-report").attr('href', '/HR/report/download-report/'+linkDonwload)
			$(".div-report").addClass('hidden');
			$(".tbody-data").empty();
			// $("#modalFilterReport").modal('hide');
			if (type == "1") {
				ajax.getData('/HR/report/get-report', 'post', value, function(report){
					$("#divTrenKelulusan").removeClass('hidden')
					if (report.length) {
						var data = ''
						for (let i = 0; i < report.length; i++) {
							data = '<tr>'+
									'<td>'+report[i].date_test+'</td>'+
									'<td>'+report[i].event_id+'</td>'+
									'<td>'+report[i].city+'</td>'+
									'<td>'+report[i].total_peserta+'</td>'+
									'<td>'+report[i].verbal+'</td>'+
									'<td>'+report[i].abstrak+'</td>'+
									'<td>'+report[i].numerical+'</td>'+
									'<td>'+report[i].jumlah_lulus+'</td>'+
								'</tr>'
							$("#tableTrenKelulusan").append(data);
						}
						
					}
				})
			}else if (type == "2") {
				ajax.getData('/HR/report/get-report', 'post', value, function(report){
					$("#divAverageScore").removeClass('hidden')
					if (report.length) {
						var data = ''
						for (let i = 0; i < report.length; i++) {
							data = '<tr>'+
									'<td>'+report[i].jurusan+'</td>'+
									'<td>'+report[i].verbal+'</td>'+
									'<td>'+report[i].abstrak+'</td>'+
									'<td>'+report[i].numerical+'</td>'+
								'</tr>'
							$("#tableAverageScore").append(data);
						}
						
					}
				})
			}else if (type == "3") {
				ajax.getData('/HR/report/get-report', 'post', value, function(report){
					$("#divTingkatUniv").removeClass('hidden')
					if (report.length) {
						var data = ''
						for (let i = 0; i < report.length; i++) {
							data = '<tr>'+
									'<td>'+report[i].universitas+'</td>'+
									'<td>'+report[i].total_peserta+'</td>'+
									'<td>'+report[i].jumlah_lulus+'</td>'+
									'<td>'+report[i].jumlah_gagal+'</td>'+
									'<td>'+report[i].persentase_lulus+'%</td>'+
								'</tr>'
							$("#tableTingkatUniv").append(data);
						}
						
					}
				})
			}else if (type == "4") {
				ajax.getData('/HR/report/get-report', 'post', value, function(report){
					$("#divTingkatJurusan").removeClass('hidden')
					if (report.length) {
						var data = ''
						for (let i = 0; i < report.length; i++) {
							data = '<tr>'+
									'<td>'+report[i].jurusan+'</td>'+
									'<td>'+report[i].total_peserta+'</td>'+
									'<td>'+report[i].jumlah_lulus+'</td>'+
									'<td>'+report[i].jumlah_gagal+'</td>'+
									'<td>'+report[i].persentase_lulus+'%</td>'+
								'</tr>'
							$("#tableTingkatJurusan").append(data);
						}
						
					}
				})
			}else if (type == "5") {
				ajax.getData('/HR/report/get-report', 'post', value, function(report){
					$("#divTrenAverage").removeClass('hidden')
					if (report.length) {
						var data = ''
						for (let i = 0; i < report.length; i++) {
							data = '<tr>'+
									'<td>'+report[i].periode+'</td>'+
									'<td>'+report[i].verbal+'</td>'+
									'<td>'+report[i].abstrak+'</td>'+
									'<td>'+report[i].numerical+'</td>'+
								'</tr>'
							$("#tableTrenAverage").append(data);
						}
						
					}
				})
			}else if (type == "6") {
				ajax.getData('/HR/report/get-report', 'post', value, function(report){
					$("#divAverageFull").removeClass('hidden')
					if (report.length) {
						var data = ''
						for (let i = 0; i < report.length; i++) {
							data = '<tr>'+
									'<td>'+report[i].job_title+'</td>'+
									'<td>'+report[i].average_wirrten_test+'</td>'+
									'<td>'+report[i].average_hr_review+'</td>'+
									'<td>'+report[i].average_final_review+'</td>'+
									'<td>'+report[i].average_user_review+'</td>'+
									'<td>'+report[i].average_mcu+'</td>'+
									'<td>'+report[i].average_hired+'</td>'+
									'<td>'+report[i].total_time+'</td>'+
								'</tr>'
							$("#tableAverageFull").append(data);
						}
						
					}
				})
			}else if (type == "7") {
				ajax.getData('/HR/report/get-report', 'post', value, function(report){
					$("#divTrenApplicant").removeClass('hidden')
					if (report.length) {
						var data = ''
						for (let i = 0; i < report.length; i++) {
							data = '<tr>'+
									'<td>'+report[i].periode+'</td>'+
									'<td>'+report[i].d3+'</td>'+
									'<td>'+report[i].s1+'</td>'+
									'<td>'+report[i].s2+'</td>'+
								'</tr>'
							$("#tableTrenApplicant").append(data);
						}
						
					}
				})
			}else if (type == "8") {
				ajax.getData('/HR/report/get-report', 'post', value, function(report){
					$("#divApply").removeClass('hidden')
					if (report.length) {
						var data = ''
						for (let i = 0; i < report.length; i++) {
							data = '<tr>'+
									'<td>'+report[i].kota+'</td>'+
									'<td>'+report[i].universitas+'</td>'+
									'<td>'+report[i].jurusan+'</td>'+
									'<td>'+report[i].gender+'</td>'+
									'<td>'+report[i].total_kandidat+'</td>'+
								'</tr>'
							$("#tableApply").append(data);
						}
						
					}
				})
			}
		}
	},
	getData:function(url,params,callback){
		$.ajax({
			url:url,
			type:'post',
			data:params,
			success:function(result){
				if(!result.error){
					callback(null,result.data);
				}else{
					callback(data);
				}
			}
		})
	},
	clear:function(id){
		var tbody = $('#'+id).find('tbody');
		tbody.html('');
	},
	serverSide:function(id,columns,url,custParam=null,columnDefs=null){
		var urutan = [0, 'desc'];
		var ordering = true;

		if (id == "tableJob" || id == "tableChooseCandidate" || id == "tableParticipantTest" || id=="tableParticipantTestTheDay" || id == "tableChooseInterview" || id == "tableAlternatifTest") {
			urutan = [1, 'desc'];
		}

		var search = true;

		var svrTable = $("#"+id).DataTable({
			// "drawCallback": function( settings ) {
			// 	if (id == "tableVacancy") {
			// 		$('.dataTables_scrollHead').remove()
			// 		$('.dataTables_scrollBody table thead').hide()
			// 	}
			// },
			// processing:true,
			scrollY: "325px",
			scrollCollapse: true,
			serverSide:true,
			columnDefs:columnDefs,
			columns:columns,
			responsive: false,
			scrollX: true,
			// scrollY: true,
			ajax:function(data, callback, settings){
				data.param = custParam
				ajax.getData(url,'post',data,function(result){
					console.log(result)
					if(result.status=='reload'){
						ui.popup.show('confirm',result.messages.title,result.messages.message,'refresh');
					}else if(result.status=='logout'){
	        			ui.popup.alert(result.messages.title,result.messages.message,'logout');
	        		}else{
						callback(result);
					}
				})
			},
			bDestroy: true,
			searching:search,
			order:urutan,
			ordering:ordering,
		})

		$('div.dataTables_filter input').unbind();
        $('div.dataTables_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13){
	          svrTable.search(this.value).draw();
            }
        });
	},
	setAndPopulate:function(id,columns,data,columnDefs,ops,order){

		var orderby = order? order:[0,"asc"];
		var option = {
			"data": data,
			"drawCallback": function( settings ) {

			},
			tableTools: {
				"sSwfPath": "assets/plugins/datatables/TableTools/swf/copy_csv_xls_pdf.swf",
					"aButtons": [ "xls", "csv", "pdf" ]
			},
			"columns": columns,
			"pageLength": 10,
			"order": [orderby],
			"bDestroy": true,
			"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			"aoColumnDefs": columnDefs,
			"scrollX": true,
			"scrollY": true,
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	        "buttons": [
	            'csv','pdf'
	        ],
			"rowCallback": function( row, data ) {
				if(id == "tbl_notification") {
					if(data.read == "1") {
						$(row).css('background-color', '#D4D4D4');
					}
				}
				if(id == "tbl_mitra" || id == "tbl_user" || id == "tbl_agent_approved") {
					if(data.status == "0") {
						$(row).css('background-color', '#FF7A7A');
					}
				}
			}
		};
		if(ops!=null){
			$.extend(option,ops);
		}
		var tbody = $('#'+id).find('tbody');

		var t = $('#' + id).DataTable(option);
		t.on( 'order.dt search.dt', function () {
			if (id == 'tableParticipantTestTheDay') {

			}else{
		        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
		            cell.innerHTML = i+1;
		        } );
			}
	    } )
	    .draw();
	}
}

$('#tableNewsEvent tbody').on( 'click', 'button.konfirmNewsEvent', function (e) {
	var table = $('#tableNewsEvent').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();

	if (dataRow.status == '1') {
		$('#titleKonfirmasiEventNews').html('Apakah Anda yakin akan menonaktifkan News/Event "'+dataRow.title+ '" ?');
		$('#tipeDeleteNewsEvent').val('0');
		$('#titleModalKonfirmEventNews').html('Nonaktifkan News/Event');
		$('#btnKonfirmasiNewsEvent').html('Nonaktifkan');
		document.getElementById("btnKonfirmasiNewsEvent").classList.remove('btn-submit-modal');
		document.getElementById("btnKonfirmasiNewsEvent").classList.add('btn-hapus-modal');
	}else if(dataRow.status == '0'){
		$('#titleKonfirmasiEventNews').html('Apakah Anda yakin akan mengaktifkan News/Event "'+dataRow.title+ '" ?');
		$('#tipeDeleteNewsEvent').val('1');
		$('#titleModalKonfirmEventNews').html('Aktifkan News/Event');
		$('#btnKonfirmasiNewsEvent').html('Aktifkan');
		document.getElementById("btnKonfirmasiNewsEvent").classList.remove('btn-hapus-modal');
		document.getElementById("btnKonfirmasiNewsEvent").classList.add('btn-submit-modal');
	}

	$('#idDeleteNewsEvent').val(dataRow.id);

	$('#modalKonfirmEventNews').modal('show');
	
});

$('#tableVacancy tbody').on( 'click', 'button.konfirmVacancy', function (e) {
	var table = $('#tableVacancy').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();

	if (dataRow.status == '1') {
		$('#titleKonfirmasiVacancy').html('Apakah Anda yakin akan menonaktifkan Vacancy "'+dataRow.job_title+ '" ?');
		$('#tipeDeleteVacancy').val('0');
		$('#titleModalKonfirmVacancy').html('Nonaktifkan Vacancy');
		$('#btnKonfirmasiVacancy').html('Nonaktifkan');
		document.getElementById("btnKonfirmasiVacancy").classList.remove('btn-submit-modal');
		document.getElementById("btnKonfirmasiVacancy").classList.add('btn-hapus-modal');
	}else if(dataRow.status == '0'){
		$('#titleKonfirmasiVacancy').html('Apakah Anda yakin akan mengaktifkan Vacancy "'+dataRow.job_title+ '" ?');
		$('#tipeDeleteVacancy').val('1');
		$('#titleModalKonfirmVacancy').html('Aktifkan Vacancy');
		$('#btnKonfirmasiVacancy').html('Aktifkan');
		document.getElementById("btnKonfirmasiVacancy").classList.remove('btn-hapus-modal');
		document.getElementById("btnKonfirmasiVacancy").classList.add('btn-submit-modal');
	}

	$('#idDeleteVacancy').val(dataRow.job_id);

	$('#modalKonfirmVacancy').modal('show');
	
});


$("#tableJob tbody").on('click', 'input', function(e) {
	var table = $('#tableJob').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	var count = $("#countCheck").val();
	var jumlah = "";
	$('.check').attr('disabled', true)
	$('.box'+dataRow.status).attr('disabled', false)
	if ($("#job_"+dataRow.job_application_id+"_"+dataRow.kandidat_id).is(":checked")) {
		jumlah = parseInt(count)+1;
		$("#countCheck").val(jumlah);
		$("#inputID").append('<input type="hidden" id="input_'+dataRow.job_application_id+'_'+dataRow.kandidat_id+'" name="idJob[]" value="'+dataRow.job_application_id+'_'+dataRow.kandidat_id+'">')
	} else {
		jumlah = parseInt(count)-1;
		$("#countCheck").val(jumlah);
		$("#input_"+dataRow.job_application_id+"_"+dataRow.kandidat_id).remove();
	}
	$("#textItem").html(jumlah+" item selected")
	if (jumlah > 1) {
		$(".btn-bulk-candidate").removeClass('hidden');
	}else{
		if (jumlah == 0) {
			$('.check').attr('disabled', false)
		}
		$(".btn-bulk-candidate").addClass('hidden');
	}

	$("#btnBulkUpdate").click(function(){
		// console.log(dataRow.status)
		if (dataRow.status == "11" || dataRow.status == "12") {
			$("#aplicationStatus").attr('disabled', true)
			$("#btnUpdateStatusBulk").addClass('hidden')
		}else{
			$("#aplicationStatus").attr('disabled', false)
			$("#btnUpdateStatusBulk").removeClass('hidden')
		}
		$("#aplicationStatus").val(dataRow.status).trigger('change')
		$("#modalUpdateBulk").modal('show')
	})
	// alert(jumlah);
	// console.log(this.className, this.id);
})

$("#tableAlternatifTest tbody").on('click', 'input', function(e) {
	var table = $('#tableAlternatifTest').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	var count = $("#countTest").val();
	var jumlah = "";
	if ($("#alternative_"+dataRow.id).is(":checked")) {
		jumlah = parseInt(count)+1;
		$("#alternative_"+dataRow.id).addClass("checkActive");
		$("#countTest").val(jumlah);
		$("#divAlternatif").append(
			'<div class="div-alternatif hidden" id="setAlternatif'+dataRow.id+'">'+
				'<input type="hidden" name="alternatifTest" class="id-alternatif-test" value="'+dataRow.id+'">'+
				'<input type="hidden" name="alternatifTestDate" class="id-alternatif-test" value="'+dataRow.date+'">'+
				'<div class="dropdown-divider mb-4"></div>'+
				'<div class="row">'+
					'<div class="col-md-5">'+
						'<p class="title-alternatif title-id">Test Alternative 1 ID</p>'+
						'<p class="content-alternatif">'+dataRow.event_id+'</p>'+
					'</div>'+
					'<div class="col-md-5">'+
						'<p class="title-alternatif title-date">Date Test Alternative 1</p>'+
						'<p class="content-alternatif">'+dataRow.date_test+'</p>'+
					'</div>'+
					'<div class="col-md-2 pt-2">'+
					'<button id="delete'+dataRow.id+'" value="'+dataRow.id+'" type="button" class="btn btn-delete-alternatif btn-transparent"><img style="margin-right: 1px;" src="/image/icon/main/delete_red.svg" title="Delete Alternative Test">&nbspDelete</button>'+
					'</div>'+
				'</div>'+
				'<div class="dropdown-divider mt-4 mb-4"></div>'+
			'</div>'
		)
	} else {
		jumlah = parseInt(count)-1;
		$("#alternative_"+dataRow.id).removeClass("checkActive");
		$("#countTest").val(jumlah);
		$("#setAlternatif"+dataRow.id).remove();
	}
	$("#textItem").html(jumlah+" item selected")
	if (jumlah == 0) {
		$("#btnAddAlternative").addClass("hidden")
	}else{
		$("#btnAddAlternative").removeClass("hidden")
		if (jumlah == 3) {
			$('.check').attr('disabled', true)
			$('.checkActive').attr('disabled', false)
		}else{
			$('.check').attr('disabled', false)
		}
	}

	$("#delete"+dataRow.id).click(function(){
		$("#alternative_"+this.value).prop('checked', false);
		var count = $("#countTest").val();
		$("#setAlternatif"+this.value).remove();
		jumlah = parseInt(count)-1;
		$("#countTest").val(jumlah);
		$("#addAlternative").removeClass("hidden");
		$("#alternative_"+this.value).removeClass("checkActive");
		$('.check').attr('disabled', false);
	})
	
})

$("#tableParticipantTest tbody").on('click', 'input', function(e) {
	var table = $('#tableParticipantTest').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	var count = $("#countParticipant").val();
	var jumlah = "";
	if ($("#participant_"+dataRow.test_participant_id).is(":checked")) {
		jumlah = parseInt(count)+1;
		$("#countParticipant").val(jumlah);
		$("#listPart").append('<input type="hidden" id="input_'+dataRow.test_participant_id+'" name="idPart[]" value="'+dataRow.test_participant_id+'">')
	} else {
		jumlah = parseInt(count)-1;
		$("#countParticipant").val(jumlah);
		$("#input_"+dataRow.test_participant_id).remove();
	}
	$(".textItem").html(jumlah+" item selected")
	if (jumlah == 0) {
		$("#btnUpdateSet").addClass('hidden');
	}else{
		$("#btnUpdateSet").removeClass('hidden');
	}
})

$("#tableParticipantTestTheDay tbody").on('click', 'input', function(e) {
	var table = $('#tableParticipantTestTheDay').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	var count = $("#countParticipant").val();
	var jumlah = "";
	
	if ($("#participant_"+dataRow.test_participant_id).is(":checked")) {
		$("#participant_"+dataRow.test_participant_id).prop('checked', true)
		jumlah = parseInt(count)+1;
		$("#countParticipant").val(jumlah);
		$("#listPart").append('<input type="hidden" id="input_'+dataRow.test_participant_id+'" name="idPart[]" value="'+dataRow.test_participant_id+'">')
		$("#listAbsen").append('<input type="hidden" id="absen_'+dataRow.test_participant_id+'" name="absenPart[]" value="'+dataRow.test_participant_id+'">')
		$("#listSendOtp").append('<input type="hidden" id="send_'+dataRow.kandidat_id+'" name="idSend[]" value="'+dataRow.kandidat_id+'">')
		$("#countSend").val(jumlah);
	} else {
		$("#participant_"+dataRow.test_participant_id).prop('checked', false)
		jumlah = parseInt(count)-1;
		$("#countParticipant").val(jumlah);
		$("#input_"+dataRow.test_participant_id).remove();
		$("#absen_"+dataRow.test_participant_id).remove();
		$("#send_"+dataRow.kandidat_id).remove();
		$("#countSend").val(jumlah);
	}
	$(".textItem").html(jumlah+" item selected")
	if (jumlah == 0) {
		$("#btnUpdateSet").addClass('hidden');
		$("#btnSendOtp").addClass('hidden');
		$("#btnSetAbsen").addClass('hidden');
	}else{
		$("#btnUpdateSet").removeClass('hidden');
		$("#btnSendOtp").removeClass('hidden');
		$("#btnSetAbsen").removeClass('hidden');
	}
})

$("#tableParticipantTestTheDay tbody").on('click', 'button.send-otp-one', function(e) {
	var table = $('#tableParticipantTestTheDay').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	// alert(dataRow.test_participant_id)
	var idData = $("#idData").val();
	var value = dataRow.kandidat_id+'_'+idData;
	ajax.getData('/HR/test/send-otp-one', 'post', {value:value}, function(data){
		if (data.status == "success") {
			ui.popup.show(data.status, data.message, data.url);
		}else{
			ui.popup.show(data.status, data.message);
		}
	})
})

$('#tableParticipantTest tbody').on( 'click', 'button.btn-acc-reschedule', function (e) {
	var table = $('#tableParticipantTest').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	ajax.getData('/HR/test/detail-reschedule', 'post', {idParticipant:dataRow.test_participant_id}, function(data){
		$("#spanName").html(dataRow.name);
		$("#spanDate").html(data.date+' - '+data.event_id);
		$("#idParticipant").val(data.id_participant);
		$("#idTestRechedule").val(data.id)
	})
	$("#modalReschedule").modal('show');
});

$("#tableChooseInterview tbody").on('click', 'input', function(e) {
	var table = $('#tableChooseInterview').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	var count = $("#countChoose").val();
	var jumlah = "";
	if ($("#interview_"+dataRow.job_application_id).is(":checked")) {
		if (dataRow.foto_profil == null || dataRow.foto_profil == "") {
			image = baseUrl+'image/icon/homepage/dummy-profile.svg';
		}else{
			image = baseImage+'/'+dataRow.foto_profil;
		}
		var dataNama = '<img class="img-candidate" src="'+image+'" />'+'&nbsp'+dataRow.first_name+' '+dataRow.last_name;
		var gender = "";
		if (dataRow.gender == "1") {
			gender = "Male";
		} else {
			gender = "Female"
		}

		var status = "";

		if (dataRow.status == 0) {
			status = "Application Resume";
		}else if (dataRow.status == 1) {
			status = "Process To Written Test";
		}else if (dataRow.status == 2) {
			status = "Scheduled to Written Test";
		}else if (dataRow.status == 3) {
			status = "Written Test Pass";
		}else if (dataRow.status == 4) {
			status = "Written Test failed";
		}else if (dataRow.status == 5) {
			status = "Process to HR interview";
		}else if (dataRow.status == 6) {
			status = "Process to User Interview 1";
		}else if (dataRow.status == 7) {
			status = "Process to User Interview 2";
		}else if (dataRow.status == 8) {
			status = "Process to Direktur Interview";
		}else if (dataRow.status == 9) {
			status = "Process to MCU";
		}else if (dataRow.status == 10) {
			status = "Process to Doc Sign";
		}else if (dataRow.status == 11) {
			status = "Failed";
		}else if (dataRow.status == 13) {
			status = "HR interview Pass";
		}else if (dataRow.status == 14) {
			status = "HR interview Fail";
		}else if (dataRow.status == 15) {
			status = "User Interview 1 Pass";
		}else if (dataRow.status == 16) {
			status = "User Interview 1 Fail";
		}else if (dataRow.status == 17) {
			status = "User Interview 2 Pass";
		}else if (dataRow.status == 18) {
			status = "User Interview 2 Fail";
		}else if (dataRow.status == 19) {
			status = "Direktur Interview Pass";
		}else if (dataRow.status == 20) {
			status = "Direktur Interview Fail";
		}else if (dataRow.status == 21) {
			status = "MCU Pass";
		}else if (dataRow.status == 22) {
			status = "MCU Fail";
		}else{
			status = "Hired";
		}

		jumlah = parseInt(count)+1;
		$("#countChoose").val(jumlah);
		$("#chooseInterview").append('<input type="hidden" class="choose-candidate-list" id="input_'+dataRow.job_application_id+'" name="idJOb[]" value="'+dataRow.job_application_id+'">')
		$("#tbodyInterview").append(
			'<tr id="tr_'+dataRow.job_application_id+'">'+
				'<td>'+dataNama+'</td>'+
				'<td>'+gender+'</td>'+
				'<td>'+dataRow.telp+'</td>'+
				'<td>'+dataRow.kota+'</td>'+
				'<td>'+dataRow.job_title+'</td>'+
				'<td>'+status+'</td>'+
			'</tr>'
		)

	} else {
		jumlah = parseInt(count)-1;
		$("#countChoose").val(jumlah);
		$("#input_"+dataRow.job_application_id).remove();
		$("#tr_"+dataRow.job_application_id).remove();
	}
	if (jumlah == 0) {
		$("#btnAddCandidateInterview").addClass('hidden');
	}else{
		$("#btnAddCandidateInterview").removeClass('hidden');
	}
})

$('#tableInterview tbody').on( 'click', 'button.btn-update-status', function (e) {
	var table = $('#tableInterview').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	$("#idUpdateStatus").val(dataRow.id);
	$("#idJobApp").val(dataRow.id_job_application);
	$("#statusJobApp").val(dataRow.status_job);
	$("#idKandidat").val(dataRow.kandidat_id);
	$("#modalUpdateStatus").modal('show');
});

$('#tableUniv tbody').on( 'click', 'button.edit-master', function (e) {
	var table = $('#tableUniv').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	$("#idEdit").val(dataRow.id);
	$("#typeEdit").val("1");
	$("#nameEdit").val(dataRow.universitas);
	$("#labelMaster").html("University Name");
	$("#modalEditMaster").modal('show');
});

$('#tableUniv tbody').on( 'click', 'button.delete-master', function (e) {
	var table = $('#tableUniv').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	$("#idDelete").val(dataRow.id);
	$("#typeDelete").val("1");
	$("#spanMaster").html(dataRow.universitas);
	$("#modalDeleteMaster").modal('show');
});

$('#tableMajor tbody').on( 'click', 'button.edit-master', function (e) {
	var table = $('#tableMajor').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	$("#idEdit").val(dataRow.id);
	$("#typeEdit").val("2");
	$("#nameEdit").val(dataRow.major);
	$("#labelMaster").html("Major Name");
	$("#modalEditMaster").modal('show');
});

$('#tableMajor tbody').on( 'click', 'button.delete-master', function (e) {
	var table = $('#tableMajor').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	$("#idDelete").val(dataRow.id);
	$("#typeDelete").val("2");
	$("#spanMaster").html(dataRow.major);
	$("#modalDeleteMaster").modal('show');
});

$('#tableUser tbody').on( 'click', 'button.delete-user', function (e) {
	var table = $('#tableUser').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	if (dataRow.status == "1") {
		$("#typeDeleteUser").val("0");
		$("#titleDeleteUser").html("Deactive?");
		$("#textDeleteUser").html('Are you sure to deactive " <span class="span-reschedule">'+dataRow.first_name+' '+dataRow.last_name+'</span> " ?');
		$("#btnDeleteUser").html('Deactive Now');
	}else{
		$("#typeDeleteUser").val("1");
		$("#titleDeleteUser").html("Active?");
		$("#textDeleteUser").html('Are you sure to active " <span class="span-reschedule">'+dataRow.first_name+' '+dataRow.last_name+'</span> " ?');
		$("#btnDeleteUser").html('Active Now');
	}
	$("#idDeleteUser").val(dataRow.user_id);
	$("#modalDeleteUser").modal('show');
});