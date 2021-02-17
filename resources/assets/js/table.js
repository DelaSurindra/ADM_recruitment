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
						var data = '<button type="button" class="btn btn-table btn-transparent"><a href="/news_event/detail-news-event/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/lingkarEdit_icon.svg" title="Edit News/Event"></a></button>';
						if (full.status == '1') {
							konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmNewsEvent"><img style="margin-right: 1px;" src="/image/icon/main/lingkarHapus_icon.svg" title="Deaktif News/Event"></button>';
							
						} else {
							konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmNewsEvent"><img style="margin-right: 1px;" src="/image/icon/main/lingkarAktif_icon.svg" title="Aktifkan News/Event"></button>';
						}
		               	return data+konfirm;
					}
				}
			];

		 	table.serverSide('tableNewsEvent',column,'news_event/list-news-event',null,columnDefs)
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
						var img = full.job_poster;
						var data = '<img src="/image/icon/main/logo-astra.svg" alt="img" style="width:95%;height:auto" />'
		            	
		               	return data;
					}
				},
				{
					"targets": 1,
					"data": "job_title",
					"className": "title-poster-news",
					"render": function(data, type, full, meta){
						// var data = full.job_title;
						var data = '<h5 style="font-style: normal;font-weight: bold;font-size: 20px;line-height: 130%;letter-spacing: -0.02em;color: #282A2C;margin-bottom: 1px;">Database Administrator</h5>'+
                        			'<p style="font-style: normal;font-weight: 200;font-size: 16px;line-height: 130%;letter-spacing: -0.02em;color: #282A2C;">Banten, Indonesia</p>'+
									'<p style="font-style: normal;font-weight: 500;font-size: 16px;line-height: 130%;letter-spacing: -0.02em;color: #EF4A3C;margin-bottom: 1px;">IDR 8,000,000 - 12,000,000</p>'+
									'<p style="font-style: normal;font-weight: 500;font-size: 14px;line-height: 130%;letter-spacing: -0.02em;color: #333333;">Diploma, Bachelors Degree in Engineering</p>'+
									'<p style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 130%;letter-spacing: -0.02em;color: #333333;">DevOps & Cloud Management Software, Enterprise Resource Planning</p>';
		            	
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
						var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a href="/vacancy/detail-vacancy/'+id+'"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit News/Event"></a></button>';
						if (full.status == '1') {
							konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmNewsEvent"><img style="margin-right: 1px;" src="/image/icon/main/delete.svg" title="Deaktif News/Event"></button>';
						} else {
							konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmNewsEvent"><img style="margin-right: 1px;" src="/image/icon/main/delete.svg" title="Aktifkan News/Event"></button>';
						}
						var hasil = '<div style="position:absolute;top:20px;right:5px">'+
										data+konfirm+
									'</div>';

		               	return hasil;
					}
				}
			];

		 	table.serverSide('tableVacancy',column,'vacancy/list-vacancy',null,columnDefs)
        }


	},
	filter:function(id,value){
		var imageDetail = '../image/icon/main/eye-solid.png';
		var imageEdit = '../image/icon/main/pen-square-solid.png';
		var imageDeactive = '../image/icon/main/deactive.png';
		var imageActive = '../image/icon/main/activae.png';

		$('.modal').modal('hide'); // ketika fitur filternya menggunakan modal
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
		var urutan = [0, 'asc'];
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

