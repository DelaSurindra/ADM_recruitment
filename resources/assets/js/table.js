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
				{
					'data': null
				}, {
					'data': null
				}, {
					'data': null
				},
			];

			columnDefs = [
				{
					"targets": 0,
					"orderable": false,
					"className": "img-poster-news",
					"data": "job_poster",
					"render": function(data, type, full, meta){
						var data = '<img src="/image/icon/main/logo-astra.svg" alt="img" style="width:75%;height:auto" />'
		            	
		               	return data;
					}
				},
				{
					"targets": 1,
					"data": "job_title",
					"className": "title-poster-news",
					"render": function(data, type, full, meta){
						// var data = full.job_title;
						var degree = '';
						if (full.degree == "1") {
							degree = "D3";
						}else if (full.degree == "2") {
							degree = "S1";
						}else if (full.degree == "3"){
							degree = "S2";
						}
						var data = '<h5 style="font-style: normal;font-weight: bold;font-size: 20px;line-height: 130%;letter-spacing: -0.02em;color: #282A2C;margin-bottom: 1px;">'+full.job_title+'</h5>'+
                        			'<p style="font-style: normal;font-weight: 200;font-size: 16px;line-height: 130%;letter-spacing: -0.02em;color: #282A2C;">'+full.lokasi+', Indonesia</p>'+
									'<p style="font-style: normal;font-weight: 500;font-size: 14px;line-height: 130%;letter-spacing: -0.02em;color: #333333;">'+degree+', Bachelors Degree in '+full.job_title+'</p>'+
									'<p style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 130%;letter-spacing: -0.02em;color: #333333;">'+full.major+'</p>';
		            	
		               	return data;
					}
				},
				{
					"targets": 2,
					"data": "id",
					"className": "action-poster-news",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.job_id));
						var konfirm = '';
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a href="/HR/vacancy/detail-vacancy/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Vacancy"></a></button>';
						if (full.status == '1') {
							konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy"><img style="margin-right: 1px;" src="/image/icon/main/delete.svg" title="Deaktif Vacancy"></button>';
						} else {
							konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy"><img style="margin-right: 1px;" src="/image/icon/main/delete.svg" title="Aktifkan Vacancy"></button>';
						}
						var hasil = '<div style="position:absolute;top:20px;right:5px">'+
										data+konfirm+
									'</div>';

		               	return hasil;
					}
				}
			];

		 	table.serverSide('tableVacancy',column,'HR/vacancy/list-vacancy',null,columnDefs)
        }


	},
	filter:function(id,value){
		var imageDetail = '../image/icon/main/eye-solid.png';
		var imageEdit = '../image/icon/main/pen-square-solid.png';
		var imageDeactive = '../image/icon/main/deactive.png';
		var imageActive = '../image/icon/main/activae.png';

		$('.modal').modal('hide'); // ketika fitur filternya menggunakan modal

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

		if (id == 'filterCabang') {
			var column = [
				{'data':'kode_cabang'},
				{'data':'nama_cabang'},
				{'data':'alamat'},
				{'data':'kota'},
				{'data':'provinsi'},
				{'data':'no_telp'},
				{'data':null},
			];

			columnDefs = [
				{
					"targets": 6,
					"data": "status",
					"render": function(data, type, full, meta){
						var data = ''
		            	if (full.status == 'Deactive') {
			               data = '<span class="badge-table badge-grey">Deactive</span>';
		            	}else if (full.status == 'Active') {
			               data = '<span class="badge-table badge-blue">Active</span>';
		            	}
		               	return data;
					}
				},
				{
					"targets": 7,
					"data": "id",
					"render": function(data, type, full, meta){
						var id = encodeURIComponent(window.btoa(full.id));
						if (full.status == "Active") {
							var link_item = '<a class="dropdown-item deactiveCabang" href="#">'+
												'<div class="icon-dropdown-menu d-inline-block">'+
													'<img src="'+imageDeactive+'" />'+
												'</div>'+
												'<span class="ml-2 d-inline-block">Deactive</span>'+
											'</a>'
						}else{
							var link_item = '<a class="dropdown-item activeCabang" href="#">'+
												'<div class="icon-dropdown-menu d-inline-block">'+
													'<img src="'+imageActive+'" />'+
												'</div>'+
												'<span class="ml-2 d-inline-block">Active</span>'+
											'</a>'
						}
						var data = '<div class="dropleft">'+
										'<button type="button" class="dropdown-toggle table-dropdown-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
											'<i class="fa fa-ellipsis-v"></i>'+
										'</button>'+
										'<div class="dropdown-menu dropdown-menu-table py-2">'+
											'<a class="dropdown-item detailCabang" href="#" type="button">'+
												'<div class="icon-dropdown-menu d-inline-block">'+
													'<img src="'+imageDetail+'" />'+
												'</div>'+
												'<span class="ml-2 d-inline-block">Detail</span>'+
											'</a>'+
											'<a class="dropdown-item" href="/cabang/edit-cabang/'+id+'">'+
												'<div class="icon-dropdown-menu d-inline-block">'+
													'<img src="'+imageEdit+'" />'+
												'</div>'+
												'<span class="ml-2 d-inline-block">Edit</span>'+
											'</a>'+
											link_item+
										'</div>'+
					  				'</div>';
		               	return data;
					}
				}
			];

		 	table.serverSide('tableCabang',column,'cabang/get-cabang',value,columnDefs)
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

		var search = true;

		var svrTable = $("#"+id).DataTable({
			"drawCallback": function( settings ) {
				if (id == "tableVacancy") {
					$('.dataTables_scrollHead').remove()
					$('.dataTables_scrollBody table thead').hide()
				}
			},
			// processing:true,
			serverSide:true,
			columnDefs:columnDefs,
			columns:columns,
			// responsive: true,
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

