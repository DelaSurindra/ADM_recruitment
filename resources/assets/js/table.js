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
		            	    data = '<span class="status status-success">Aktif</span>';
		            	} else {
		            	    data = '<span class="status status-delete">Deaktif</span>';
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
				{'data':'work_time'},
				{'data':'active_date'},
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
					"targets": 7,
					"data": "status",
					"render": function(data, type, full, meta){
						var data = ''
		            	if (full.status == 1) {
		            	    data = '<strong>Publised</strong>';
		            	}else{
							data = "<p>Deaktif</p>"
						}
		               	return data;
					}
				},
				{
					"targets": 8,
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

		if ($('#tableCandidate').length) {
			var value = $('#filterCandidate').serialize();
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
						var data = '<a href="/HR/candidate/detail-candidate/'+id+'" class="name-candidate"><img class="img-candidate" src="'+image+'" />'+'&nbsp'+full.name+'</a';
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
							data = "Proses to Written Test";
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
							data = "Process to User Interview 3";
						}else if (full.status == 9) {
							data = "Process to MCU";
						}else if (full.status == 10) {
							data = "Process to Doc Sign";
						}else if (full.status == 11) {
							data = "Failed";
						}else{
							data = "Hired";
						}
						return data;
					}
				},
				{
					"targets": 13,
					"data": "job_application_id",
					"className": "action-poster-news",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.job_application_id));
						// var konfirm = '';
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/candidate/edit-candidate/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Candidate"> Edit&nbsp</a></button>';
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

		 	table.serverSide('tableCandidate',column,'HR/candidate/list-candidate',value,columnDefs)
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

		if (id == 'filterCandidate') {
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
						var data = '<input type="checkbox">';
						return data;
					}
				},
				{
					"targets": 2,
					"data": "name",
					"render": function(data, type, full, meta){
						var image = '';
						if (full.foto_profil == null || full.foto_profil == "") {
							image = baseUrl+'image/icon/homepage/dummy-profile.svg';
						}else{
							image = baseImage+'/'+full.foto_profil;
						}
						var data = '<img class="img-candidate" src="'+image+'" />'+' '+full.name;
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
							data = "Proses to Written Test";
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
							data = "Process to User Interview 3";
						}else if (full.status == 9) {
							data = "Process to MCU";
						}else if (full.status == 10) {
							data = "Process to Doc Sign";
						}else if (full.status == 11) {
							data = "Failed";
						}else{
							data = "Hired";
						}
						return data;
					}
				},
				{
					"targets": 13,
					"data": "id",
					"className": "action-poster-news",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.job_id));
						// var konfirm = '';
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/candidate/edit-candidate/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Candidate"> Edit&nbsp</a></button>';
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

		 	table.serverSide('tableCandidate',column,'HR/candidate/list-candidate',value,columnDefs)
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
		
		if (id == "tableVacancy") {
			urutan = false;
			ordering = false;
		}

		if (id == "tableCandidate") {
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
						// if untuk menampilkan respon summary ketika servicenya jadi 1
						if (id == 'tableReport') {
							$('#summary_unpaid').html(result.summary.unpaid)
							$('#summary_paid').html(result.summary.paid)
							$('#summary_expired').html(result.summary.expired)
						}
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
			if (id == 'tableFitur') {

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


$("#tableCandidate tbody").on('click', 'input', function(e) {
	var table = $('#tableCandidate').DataTable();
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
	// alert(jumlah);
	// console.log(this.className, this.id);
})