var table = {
	init:function(){
		var imageDetail = '../image/icon/main/eye-solid.png';
		var imageEdit = '../image/icon/main/pen-square-solid.png';
		var imageDeactive = '../image/icon/main/deactive.png';
		var imageActive = '../image/icon/main/activae.png';
		var ops ={};

		// contoh 1 tabel
		if ($('#tableCabang').length) {
			var value = $('#filterCabang').serialize();
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

		var search = true;
		// if unutk non aktif fitur search datatable
		if (id == 'tableRekapPoint' || id == 'tableRekapSaldo' || id == 'tableSlider') {
			search = false;
		}

		var svrTable = $("#"+id).DataTable({
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
			ordering:true,
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

