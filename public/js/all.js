function _defineProperty(e,a,t){return a in e?Object.defineProperty(e,a,{value:t,enumerable:!0,configurable:!0,writable:!0}):e[a]=t,e}function reload(){location.reload()}function formatRupiahRp(e){var a=e.replace(/[^,\d]/g,"").toString(),t=a.split(","),n=t[0].length%3,i=t[0].substr(0,n),o=t[0].substr(n).match(/\d{3}/gi);return o&&(separator=n?".":"",i+=separator+o.join(".")),"Rp "+(i=void 0!=t[1]?i+t[1]:i)}function formatRupiahKoma(e){var a=e.replace(/[^.\d]/g,"").toString(),t=a.split("."),n=t[0].length%3,i=t[0].substr(0,n),o=t[0].substr(n).match(/\d{3}/gi);return o&&(separator=n?",":"",i+=separator+o.join(",")),i=void 0!=t[1]?i+t[1]:i}function readFile(e){if(console.log(e.files,e.files[0]),e.files&&e.files[0]){var a=new FileReader;a.onload=function(a){var t='<img src="'+a.target.result+'" style="width:100%;height:auto" />',n=$(e).parent(),i=$(e).parent().parent().find(".preview-zone"),o=$(e).parent().find(".dropzone-desc");Math.floor(75);n.removeClass("dragover"),i.removeClass("hidden"),o.empty(),o.css("top","0"),o.append(t)},a.readAsDataURL(e.files[0])}}function reset(e){e.wrap("<form>").closest("form").get(0).reset(),e.unwrap()}$(document).ready(function(){if(_ajax.init(),table.init(),form.init(),ui.slide.init(),validation.addMethods(),$(document).ajaxError(function(e,a,t,n){console.log("exception = "+n)}),moveOnMax=function(e,a){1==e.value.length&&document.getElementById(a).focus()},$("#notif").length){var e=$("#notif").data("status"),a=$("#notif").data("message"),t=$("#notif").data("url");ui.popup.show(e,a,t)}}),window.onload=function(){if("performance"in window)if("timing"in window.performance){var e=window.performance.timing.loadEventStart-window.performance.timing.domLoading,a=e/1e3;parseInt(a/3600);a%=3600;parseInt(a/60);a%=60,document.getElementById("total_render_time").innerHTML="Load Time: "+a+" seconds"}else document.getElementById("result").innerHTML="Page Timing API not supported";else document.getElementById("result").innerHTML="Page Performance API not supported"},$(".modal").on("hidden.bs.modal",function(e){$(this).find("form")[0].reset(),$(".select").val("").trigger("change")});var baseUrl=$("meta[name=base]").attr("content")+"/",baseImage=$("meta[name=baseImage]").attr("content")+"/",cdn=$("meta[name=cdn]").attr("content"),other={encrypt:function(e,a){$.ajax({url:baseUrl+"s",type:"post",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},success:function(t){var n=t;if("error"!==n.status&&"reload"!==n.status){var i=n.password,o=CryptoJS.lib.WordArray.random(16),r=CryptoJS.PBKDF2("Secret Passphrase",o,{keySize:8,iterations:500}),s=CryptoJS.enc.Hex.parse(i[2]);if(e.indexOf("&captcha=")){var l=e.split("&captcha="),d=l[1];e=l[0]}var u=CryptoJS.AES.encrypt(e+"&safer=",r,{iv:s}),c=u.ciphertext.toString(CryptoJS.enc.Base64),m=u.iv.toString(CryptoJS.enc.Base64),p=u.key.toString(CryptoJS.enc.Base64),f=c+i[0]+m+i[1]+p+i[2],t={data:f};"undefined"!=d&&(t.captcha=d),a(null,t)}else swal({title:n.messages.title,text:n.messages.message,type:"error",html:!0,showCancelButton:!0,confirmButtonColor:"green",confirmButtonText:"Refresh"},function(){location.reload()})}})},notification:{init:function(){$("#buttonNotif").length&&$.ajax({url:baseUrl+"notif/check",type:"POST",cache:!1,beforeSend:function(e){},success:function(e){var a,t=0;for(a in e)e.hasOwnProperty(a)&&t++;if(t>0){var n=$(".drop-content-notif");n.empty(),$.each(e.notif,function(e,a){var t=null;t="1"==a.status_notif?$("<li>"):$("<li>").addClass("unread"),t.append('<a href="'+baseUrl+"notif/get/"+a.id_notif+'" class="aNotif"><b class="font-notif">'+a.message_notif+'</b> </br><span class="font-notif">'+a.created_at+"</span></a>"),n.append(t)})}else li_element.append('<li class="dropdown-item-notif"><span>Belum ada notifikasi</span></li>'),n.append(li_element);e.countNotif>0?($("#total-notif").show(),$("#totalNotif").html(e.countNotif)):$("#total-notif").hide()}})}},checkSession:{stat:!1,init:function(){function e(){0==t?other.checkSession.action():t--}function a(){t=905}var t=905;$(document).on("mousemove keypress",function(){a()}),setInterval(function(){e()},1e3)},action:function(){other.checkSession.stat||(other.checkSession.stat=!0,$.ajax({url:baseUrl+"checkSession",global:!1,type:"get",beforeSend:function(e){},success:function(e){"1"==e?(other.checkSession.idler=0,other.checkSession.stat=!1):ui.popup.show("warning","Anda sudah tidak aktif dalam waktu 15 menit","/logout")}}))}}},_ajax={init:function(){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},beforeSend:function(e){ui.popup.showLoader()},timeout:3e4,error:function(e,a,t,n){ui.popup.show("error","Sedang Gangguan Jaringan","Error"),ui.popup.hideLoader()},complete:function(){},global:!0})},getData:function(e,a,t,n){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),null==t&&(t={}),$.ajax({type:a,url:baseUrl+e,data:t,success:function(e){ui.popup.hideLoader(),"success"==e.status&&(ui.popup.hideLoader(),"redirect"==e.callback&&ui.popup.show(e.status,e.message,e.url)),"error"==e.status?ui.popup.show("error",e.messages.message,e.messages.title):"reload"==e.status?ui.popup.alert(e.messages.title,e.messages.message,"refresh"):"logout"==e.status?ui.popup.alert(e.messages.title,e.messages.message,"logout"):401==e?(ui.popup.show("warning","Sesi Anda telah habis, harap login kembali","Session Expired"),2==$(".toast-warning").length&&$(".toast-warning")[1].remove(),setInterval(function(){window.location="/logout"},3e3)):n(e instanceof Array||e instanceof Object?e:JSON.parse(e))}})},submitData:function(e,a,t){other.encrypt(a,function(a,n){a?callback(a):$.ajax({url:e,type:"post",data:n,error:function(e,a,t){ui.popup.hideLoader(),ui.popup.show("error",t,"Error")},success:function(e,a){null==e?(ui.popup.show(e.status,"Error"),ui.popup.hideLoader()):401==e?(ui.popup.show("warning","Sesi anda habis, mohon login kembali","Session Expired"),ui.popup.hideLoader(),setInterval(function(){window.location="/logout"},3e3)):"success"==e.status?($(".modal").modal("hide"),ui.popup.hideLoader(),"redirect"==e.callback?ui.popup.show(e.status,e.message,e.url):"login"==e.callback&&setInterval(function(){window.location=e.url},2e3)):"info"==e.status?ui.popup.hideLoader():"warning"==e.status?(ui.popup.hideLoader(),"redirect"==e.callback&&ui.popup.show(e.status,e.message,e.url)):"<p>Error: Validation</p>"==e.messages?(ui.popup.hideLoader(),$("#"+t).validate().showErrors(e.errors),ui.popup.show(e.status,"Harap cek isian")):(ui.popup.show(e.status,e.message),ui.popup.hideLoader())}})})},submitImage:function(e,a,t,n){}},form={init:function(){$("form").attr("autocomplete","off"),$(".select2").length&&$(".select2").select2(),$("input").focus(function(){$(this).parents(".form-group").addClass("focused")}),$("textarea").focus(function(){$(this).parents(".form-group").addClass("focused")}),$("input").blur(function(){""==$(this).val()?($(this).removeClass("filled"),$(this).parents(".form-group").removeClass("focused")):$(this).addClass("filled")}),$("textarea").blur(function(){""==$(this).val()?($(this).removeClass("filled"),$(this).parents(".form-group").removeClass("focused")):$(this).addClass("filled")}),$.validator.addMethod("lettersonly",function(e,a){return this.optional(a)||/^[a-z]+$/i.test(e)},"Letters only please"),$.validator.addMethod("regexp",function(e,a,t){return t.test(e)},""),$.each($("form"),function(e,a){$(this).validate(formrules[$(this).attr("id")])}),$("form").submit(function(e){e.preventDefault(),console.log("masuk");var a=$(this).attr("id");form.validate(a)})},validate:function(e){var a=$("#"+e),t=a.attr("message"),n=a.attr("agreement"),i={errorPlacement:function(e,a){if(a.parent().hasClass("input-group"))e.appendTo(a.parent().parent());else{var t=a.parents(".form-group").find(".help-block");t.length?e.appendTo(t):e.appendTo(a.parents(".form-group"))}},highlight:function(e,a,t){alert("test"),$(e).parents(".form-group").addClass("has-error")},unhighlight:function(e,a,t){$(e).parents(".form-group").removeClass("has-error")}},o=Object.assign(i,formrules[e]),r=a.validate(o);if($("button[type=reset]").click(function(){r.resetForm()}),a.valid())if(console.log(e),null!=t&&""!=t){if(t.indexOf("|")>-1){var s=t.split("|"),l=s[0],d=s[1],u=d.split(";"),c='<table class="table">';$.each(u,function(e,a){var t=a.split(":")[0],n=form.find("input[name="+a.split(":")[1]+"],select[name="+a.split(":")[1]+"]").val();c+="<tr><td>"+t+"</td><td>"+n+"</td></tr>"}),c+="</table>",t=l+c}ui.popup.confirm("Konfirmasi",t,'form.submit("'+e+'")')}else null!=n&&""!=n?(t=$("#"+n).html(),ui.popup.agreement("Persetujuan Agen Baru",t,'form.submit("'+e+'")')):form.submit(e);else ui.popup.show("error","Harap cek isian","Form Tidak Valid")},submit:function(e){var a=$("#"+e),t=a.attr("action"),n=formrules[e];null==n&&(n={});var i=($(".form-control"),a.serialize()),o=a.attr("ajax"),r=a.attr("filter");"true"==o?("payform"==e&&(e=$("#"+e).attr("for")),_ajax.submitData(t,i,e)):"true"==r?table.filter(e,i):other.encrypt(i,function(e,t){if(e)callback(e);else{var n=$('<input type="hidden" name="data" />');$(n).val(t.data),a.find('select,input:not("input[type=file],input[type=hidden][name=_token],input[name=captcha]")').attr("disabled","true").end().append(n).unbind("submit").submit()}})}};if($("#formAddVa").length){var billing_amount=document.getElementById("billing_amount");billing_amount.addEventListener("keyup",function(e){billing_amount.value=formatRupiahRp(this.value)})}if($("#formAddEventNews").length&&($("#tglMulaiNewsEvent").datetimepicker({format:"DD-MM-YYYY"}),$("#tglSelesaiNewsEvent").datetimepicker({format:"DD-MM-YYYY"}),$("#descriptionNewsEvent").summernote({height:200}),$("#descriptionNewsEvent").each(function(){var e=$(this);$("form").on("submit",function(){e.summernote("isEmpty")?e.val(""):"<br>"==e.val()&&e.val("")})})),$("#formEditEventNews").length&&($("#tglMulaiNewsEvent").datetimepicker({format:"DD-MM-YYYY"}),$("#tglSelesaiNewsEvent").datetimepicker({format:"DD-MM-YYYY"}),$("#descriptionNewsEvent").summernote({height:200}),$("#descriptionNewsEvent").each(function(){var e=$(this);$("form").on("submit",function(){e.summernote("isEmpty")?e.val(""):"<br>"==e.val()&&e.val("")})})),$("#formAddVacancy").length){var minSalary=document.getElementById("minSalaryVacancy");minSalary.addEventListener("keyup",function(e){minSalary.value=formatRupiahKoma(this.value)});var maxSalary=document.getElementById("maxSalaryVacancy");maxSalary.addEventListener("keyup",function(e){maxSalary.value=formatRupiahKoma(this.value)}),$("#activatedDate").datetimepicker({format:"DD-MM-YYYY"}),$("#descriptionVacancy").summernote({height:200}),$("#descriptionVacancy").each(function(){var e=$(this);$("form").on("submit",function(){e.summernote("isEmpty")?e.val(""):"<br>"==e.val()&&e.val("")})})}if($("#formEditVacancy").length){var minSalary=document.getElementById("minSalaryVacancy");minSalary.addEventListener("keyup",function(e){minSalary.value=formatRupiahKoma(this.value)});var maxSalary=document.getElementById("maxSalaryVacancy");maxSalary.addEventListener("keyup",function(e){maxSalary.value=formatRupiahKoma(this.value)}),$("#activatedDate").datetimepicker({format:"DD-MM-YYYY"}),$("#descriptionVacancy").summernote({height:200}),$("#descriptionVacancy").each(function(){var e=$(this);$("form").on("submit",function(){e.summernote("isEmpty")?e.val(""):"<br>"==e.val()&&e.val("")})})}$(".dropzone").change(function(){readFile(this)}),$(".dropzone-wrapper").on("dragover",function(e){e.preventDefault(),e.stopPropagation(),$(this).addClass("dragover")}),$(".dropzone-wrapper").on("dragleave",function(e){e.preventDefault(),e.stopPropagation(),$(this).removeClass("dragover")}),$(".remove-preview").on("click",function(){var e=$(this).parents(".preview-zone").find(".box-body"),a=$(this).parents(".preview-zone"),t=$(this).parents(".form-group").find(".dropzone");e.empty(),a.addClass("hidden"),reset(t)}),$("#tipeNewsEvent").change(function(){"1"==$("#tipeNewsEvent").val()?($("#divDateNewsEvent").addClass("hidden"),$(".dateNewsEvent").attr("disabled",!0)):($("#divDateNewsEvent").removeClass("hidden"),$(".dateNewsEvent").attr("disabled",!1))});var table={init:function(){if($("#tableNewsEvent").length){var e=[{data:"created_at"},{data:"title"},{data:"start_date"},{data:"end_date"}];columnDefs=[{targets:3,data:"type",render:function(e,a,t,n){return 1==t.type?"-":t.end_date}},{targets:4,data:"type",render:function(e,a,t,n){return 1==t.type?"News":"Event"}},{targets:5,data:"status",render:function(e,a,t,n){return 1==t.status?'<span class="status status-success">Aktif</span>':'<span class="status status-delete">Deaktif</span>'}},{targets:6,data:"id",render:function(e,a,t,n){var i=encodeURIComponent(window.btoa(t.id)),o="",e='<button type="button" class="btn btn-table btn-transparent"><a href="/news_event/detail-news-event/'+i+'"><img style="margin-right: 1px;" src="/image/icon/main/lingkarEdit_icon.svg" title="Edit News/Event"></a></button>';return o="1"==t.status?'<button type="button" class="btn btn-table btn-transparent konfirmNewsEvent"><img style="margin-right: 1px;" src="/image/icon/main/lingkarHapus_icon.svg" title="Deaktif News/Event"></button>':'<button type="button" class="btn btn-table btn-transparent konfirmNewsEvent"><img style="margin-right: 1px;" src="/image/icon/main/lingkarAktif_icon.svg" title="Aktifkan News/Event"></button>',e+o}}],table.serverSide("tableNewsEvent",e,"news_event/list-news-event",null,columnDefs)}if($("#tableVacancy").length){var e=[{data:null},{data:null},{data:null}];columnDefs=[{targets:0,orderable:!1,className:"img-poster-news",data:"job_poster",render:function(e,a,t,n){t.job_poster;return'<img src="/image/icon/main/logo-astra.svg" alt="img" style="width:95%;height:auto" />'}},{targets:1,data:"job_title",className:"title-poster-news",render:function(e,a,t,n){return'<h5 style="font-style: normal;font-weight: bold;font-size: 20px;line-height: 130%;letter-spacing: -0.02em;color: #282A2C;margin-bottom: 1px;">Database Administrator</h5><p style="font-style: normal;font-weight: 200;font-size: 16px;line-height: 130%;letter-spacing: -0.02em;color: #282A2C;">Banten, Indonesia</p><p style="font-style: normal;font-weight: 500;font-size: 16px;line-height: 130%;letter-spacing: -0.02em;color: #EF4A3C;margin-bottom: 1px;">IDR 8,000,000 - 12,000,000</p><p style="font-style: normal;font-weight: 500;font-size: 14px;line-height: 130%;letter-spacing: -0.02em;color: #333333;">Diploma, Bachelors Degree in Engineering</p><p style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 130%;letter-spacing: -0.02em;color: #333333;">DevOps & Cloud Management Software, Enterprise Resource Planning</p>'}},{targets:2,data:"id",className:"action-poster-news",render:function(e,a,t,n){var i=encodeURIComponent(window.btoa(t.job_id)),o="",e='<button type="button" class="btn btn-table btn-transparent mr-2"><a href="/vacancy/detail-vacancy/'+i+'"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit News/Event"></a></button>';return o="1"==t.status?'<button type="button" class="btn btn-table btn-transparent konfirmNewsEvent"><img style="margin-right: 1px;" src="/image/icon/main/delete.svg" title="Deaktif News/Event"></button>':'<button type="button" class="btn btn-table btn-transparent konfirmNewsEvent"><img style="margin-right: 1px;" src="/image/icon/main/delete.svg" title="Aktifkan News/Event"></button>','<div style="position:absolute;top:20px;right:5px">'+e+o+"</div>"}}],table.serverSide("tableVacancy",e,"vacancy/list-vacancy",null,columnDefs)}},filter:function(e,a){if($(".modal").modal("hide"),"filterCabang"==e){var t=[{data:"kode_cabang"},{data:"nama_cabang"},{data:"alamat"},{data:"kota"},{data:"provinsi"},{data:"no_telp"},{data:null}];columnDefs=[{targets:6,data:"status",render:function(e,a,t,n){var e="";return"Deactive"==t.status?e='<span class="badge-table badge-grey">Deactive</span>':"Active"==t.status&&(e='<span class="badge-table badge-blue">Active</span>'),e}},{targets:7,data:"id",render:function(e,a,t,n){var i=encodeURIComponent(window.btoa(t.id));if("Active"==t.status)var o='<a class="dropdown-item deactiveCabang" href="#"><div class="icon-dropdown-menu d-inline-block"><img src="../image/icon/main/deactive.png" /></div><span class="ml-2 d-inline-block">Deactive</span></a>';else var o='<a class="dropdown-item activeCabang" href="#"><div class="icon-dropdown-menu d-inline-block"><img src="../image/icon/main/activae.png" /></div><span class="ml-2 d-inline-block">Active</span></a>';return'<div class="dropleft"><button type="button" class="dropdown-toggle table-dropdown-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button><div class="dropdown-menu dropdown-menu-table py-2"><a class="dropdown-item detailCabang" href="#" type="button"><div class="icon-dropdown-menu d-inline-block"><img src="../image/icon/main/eye-solid.png" /></div><span class="ml-2 d-inline-block">Detail</span></a><a class="dropdown-item" href="/cabang/edit-cabang/'+i+'"><div class="icon-dropdown-menu d-inline-block"><img src="../image/icon/main/pen-square-solid.png" /></div><span class="ml-2 d-inline-block">Edit</span></a>'+o+"</div></div>"}}],table.serverSide("tableCabang",t,"cabang/get-cabang",a,columnDefs)}},getData:function(e,a,t){$.ajax({url:e,type:"post",data:a,success:function(e){e.error?t(data):t(null,e.data)}})},clear:function(e){$("#"+e).find("tbody").html("")},serverSide:function(e,a,t){var n=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,i=arguments.length>4&&void 0!==arguments[4]?arguments[4]:null,o=[0,"asc"],r=!0;"tableVacancy"==e&&(o=!1,r=!1);var s=$("#"+e).DataTable({drawCallback:function(a){"tableVacancy"==e&&($(".dataTables_scrollHead").remove(),$(".dataTables_scrollBody table thead").hide())},serverSide:!0,columnDefs:i,columns:a,scrollX:!0,ajax:function(a,i,o){a.param=n,_ajax.getData(t,"post",a,function(a){console.log(a),"reload"==a.status?ui.popup.show("confirm",a.messages.title,a.messages.message,"refresh"):"logout"==a.status?ui.popup.alert(a.messages.title,a.messages.message,"logout"):("tableReport"==e&&($("#summary_unpaid").html(a.summary.unpaid),$("#summary_paid").html(a.summary.paid),$("#summary_expired").html(a.summary.expired)),i(a))})},bDestroy:!0,searching:!0,order:o,ordering:r});$("div.dataTables_filter input").unbind(),$("div.dataTables_filter input").bind("keyup",function(e){13==e.keyCode&&s.search(this.value).draw()})},setAndPopulate:function(e,a,t,n,i,o){var r,s=o||[0,"asc"],l=(r={data:t,drawCallback:function(e){},tableTools:{sSwfPath:"assets/plugins/datatables/TableTools/swf/copy_csv_xls_pdf.swf",aButtons:["xls","csv","pdf"]},columns:a,pageLength:10,order:[s],bDestroy:!0,lengthMenu:[[5,10,25,50,-1],[5,10,25,50,"All"]],aoColumnDefs:n,scrollX:!0,scrollY:!0},_defineProperty(r,"lengthMenu",[[10,25,50,-1],[10,25,50,"All"]]),_defineProperty(r,"buttons",["csv","pdf"]),_defineProperty(r,"rowCallback",function(a,t){"tbl_notification"==e&&"1"==t.read&&$(a).css("background-color","#D4D4D4"),"tbl_mitra"!=e&&"tbl_user"!=e&&"tbl_agent_approved"!=e||"0"==t.status&&$(a).css("background-color","#FF7A7A")}),r);null!=i&&$.extend(l,i);var d=($("#"+e).find("tbody"),$("#"+e).DataTable(l));d.on("order.dt search.dt",function(){"tableFitur"==e||d.column(0,{search:"applied",order:"applied"}).nodes().each(function(e,a){e.innerHTML=a+1})}).draw()}};$("#tableNewsEvent tbody").on("click","button.konfirmNewsEvent",function(e){var a=$("#tableNewsEvent").DataTable(),t=a.row($(this).closest("tr")).data();"1"==t.status?($("#titleKonfirmasiEventNews").html('Apakah Anda yakin akan menonaktifkan News/Event "'+t.title+'" ?'),$("#tipeDeleteNewsEvent").val("0"),$("#titleModalKonfirmEventNews").html("Nonaktifkan News/Event"),$("#btnKonfirmasiNewsEvent").html("Nonaktifkan"),document.getElementById("btnKonfirmasiNewsEvent").classList.remove("btn-submit-modal"),document.getElementById("btnKonfirmasiNewsEvent").classList.add("btn-hapus-modal")):"0"==t.status&&($("#titleKonfirmasiEventNews").html('Apakah Anda yakin akan mengaktifkan News/Event "'+t.title+'" ?'),$("#tipeDeleteNewsEvent").val("1"),$("#titleModalKonfirmEventNews").html("Aktifkan News/Event"),$("#btnKonfirmasiNewsEvent").html("Aktifkan"),document.getElementById("btnKonfirmasiNewsEvent").classList.remove("btn-hapus-modal"),document.getElementById("btnKonfirmasiNewsEvent").classList.add("btn-submit-modal")),$("#idDeleteNewsEvent").val(t.id),$("#modalKonfirmEventNews").modal("show")});var ui={popup:{show:function(e,a,t){"error"==e?Swal.fire({title:a,type:e,confirmButtonText:"OK",allowOutsideClick:!1}):"success"==e?"close"==t?Swal.fire({title:a,type:e,confirmButtonText:"OK",allowOutsideClick:!1}):Swal.fire({title:a,type:e,confirmButtonText:"OK",allowOutsideClick:!1}).then(function(){window.location=t}):"initActivation"==e?Swal.fire({html:a,showConfirmButton:!0,confirmButtonText:"Submit",showCancelButton:!0,cancelButtonText:"Tutup",allowOutsideClick:!1}):"warning"==e?"close"==t?Swal.fire({title:a,type:e,confirmButtonText:"OK",allowOutsideClick:!1}):Swal.fire({title:a,type:e,confirmButtonText:"OK",allowOutsideClick:!1}).then(function(){window.location=t}):Swal.fire({title:a,type:e,confirmButtonText:"OK",allowOutsideClick:!1})},showLoader:function(){$("#loading-overlay").addClass("active"),$("body").addClass("modal-open")},hideLoader:function(){$("#loading-overlay").removeClass("active"),$("body").removeClass("modal-open")},hide:function(e){$("."+e).toggleClass("submitted")}},slide:{init:function(){$(".carousel-control").on("click",function(e){e.preventDefault();var a=$(this),t=a.parent();a.hasClass("right")?ui.slide.next(t):ui.slide.prev(t)}),$(".slideBtn").on("click",function(e){e.preventDefault();var a=$(this),t=$("#"+a.attr("for"));a.hasClass("btn-next")?ui.slide.next(t):ui.slide.prev(t)})},next:function(e){var a=e.next();e.toggle({slide:{direction:"left"}}),a.toggle({slide:{direction:"right"}})},prev:function(e){var a=e.prev();e.toggle({slide:{direction:"right"}}),a.toggle({slide:{direction:"left"}})}}},formrules={formAddEventNews:{ignore:null,rules:{imageNewsEvent:{required:!0},titleNewsEvent:{required:!0},tipeNewsEvent:{required:!0},tglMulaiNewsEvent:{required:!0},tglSelesaiNewsEvent:{required:!0},descriptionNewsEvent:{required:!0}},submitHandler:!1,messages:{imageNewsEvent:{required:"Mohon isi Image"},titleNewsEvent:{required:"Mohon isi Title"},tipeNewsEvent:{required:"Mohon pilih Tipe"},tglMulaiNewsEvent:{required:"Mohon isi Start Date"},tglSelesaiNewsEvent:{required:"Mohon isi Start Date"},descriptionNewsEvent:{required:"Mohon isi Description"}},errorPlacement:function(e,a){a.is("#tipeNewsEvent")?e.appendTo(a.parents("#tipeNewsEventDiv")):e.insertAfter(a)}},formEditEventNews:{ignore:null,rules:{titleNewsEvent:{required:!0},tipeNewsEvent:{required:!0},tglMulaiNewsEvent:{required:!0},tglSelesaiNewsEvent:{required:!0},descriptionNewsEvent:{required:!0}},submitHandler:!1,messages:{titleNewsEvent:{required:"Mohon isi Title"},tipeNewsEvent:{required:"Mohon pilih Tipe"},tglMulaiNewsEvent:{required:"Mohon isi Start Date"},tglSelesaiNewsEvent:{required:"Mohon isi Start Date"},descriptionNewsEvent:{required:"Mohon isi Description"}},errorPlacement:function(e,a){a.is("#tipeNewsEvent")?e.appendTo(a.parents("#tipeNewsEventDiv")):e.insertAfter(a)}}},validation={messages:{required:function(){return'<i class="fa fa-exclamation-circle"></i> Mohon isi kolom ini'},minlength:function(e){return'<i class="fa fa-exclamation-circle"></i> Isi dengan minimum '+e},maxlength:function(e){return'<i class="fa fa-exclamation-circle"></i> Isi dengan maximum '+e},max:function(e,a){return'<i class="fa fa-exclamation-circle"></i> '+e+a},email:function(){return'<i class="fa fa-exclamation-circle"></i> Email Anda salah. Email harus terdiri dari @ dan domain'},digits:function(){return'<i class="fa fa-exclamation-circle"></i> Mohon isi hanya dengan nomor'},numbers2:function(){return'<i class="fa fa-exclamation-circle"></i> Mohon isi hanya dengan nomor'},nameCheck:function(){return'<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung A-Z dan \''},numericsSlash:function(){return'<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung 0-9 dan /'},alphaNumeric:function(){return'<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung 0-9, A-Z dan spasi'},alphaNumericNS:function(){return'<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung 0-9 dan A-Z'},alpha:function(){return'<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung A-Z dan spasi'},alphaNS:function(){return'<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung A-Z'},equalTo:function(){return'<i class="fa fa-exclamation-circle"></i> Mohon mengisi dengan isian yang sama'},addresscheck:function(){return'<i class="fa fa-exclamation-circle"></i> Input harus mengandung satu nomor, satu huruf kecil dan satu huruf besar'},pwcheck:function(){return'<i class="fa fa-exclamation-circle"></i> Input minimum 8 dan mengandung satu nomor, satu huruf kecil dan satu huruf besar'},pwcheck_alfanum:function(){return'<i class="fa fa-exclamation-circle"></i> Input antara 8-14 karakter dan harus merupakan kombinasi antara angka dan huruf'},pwcheck2:function(){return'<i class="fa fa-exclamation-circle"></i> Input antara 8-14 karakter dan harus mengandung nomor, huruf kecil, huruf besar dan simbol kecuali ("#<>/\\=\')'},notEqual:function(e){return'<i class="fa fa-exclamation-circle"></i> '+e},checkDate:function(){return'<i class="fa fa-exclamation-circle"></i> Format tanggal salah'},checkTime:function(){return'<i class="fa fa-exclamation-circle"></i> Format time (HH:mm) salah'},formatSeparator:function(){return'<i class="fa fa-exclamation-circle"></i> Contoh format: Ibu rumah tangga, pedagang, tukang jahit'},acceptImage:function(){return'<i class="fa fa-exclamation-circle"></i> Mohon upload hanya gambar'},filesize:function(e){return'<i class="fa fa-exclamation-circle"></i> Max file size: '+e},extension:function(e){return'<i class="fa fa-exclamation-circle"></i> Format yang Anda pilih tidak sesuai'},minValue:function(e){return'<i class="fa fa-exclamation-circle"></i> Minimal Amount: '+e},ageCheck:function(e){return'<i class="fa fa-exclamation-circle"></i> Minimal Age '+e},checkDateyyyymmdd:function(){return'<i class="fa fa-exclamation-circle></i> Format tanggal YYYY-MM-DD, contoh: 2016-01-30'},checkDateddmmyyyy:function(){return'<i class="fa fa-exclamation-circle></i> Format tanggal DD/MM/YYYY, contoh: 17/08/1945'}},addMethods:function(){jQuery.extend(jQuery.validator.messages,{required:"Mohon isi kolom ini.",remote:"Please fix this field.",email:"Email Anda salah. Email harus terdiri dari @ dan domain.",url:"Please enter a valid URL.",date:"Please enter a valid date.",dateISO:"Please enter a valid date (ISO).",number:"Please enter a valid number.",digits:"Mohon isi hanya dengan angka.",creditcard:"Please enter a valid credit card number.",equalTo:"Mohon isi dengan value yang sama.",accept:"Format yang Anda pilih tidak sesuai.",maxlength:jQuery.validator.format("Mohon isi dengan tidak melebihi {0} karakter."),minlength:jQuery.validator.format("Mohon isi dengan minimal {0} karakter."),rangelength:jQuery.validator.format("Please enter a value between {0} and {1} characters long."),range:jQuery.validator.format("Please enter a value between {0} and {1}."),max:jQuery.validator.format("Mohon isi tidak melebihi {0}."),min:jQuery.validator.format("Mohon isi minimal {0}."),extension:"Format yang Anda pilih tidak sesuai.",alphaNumeric:"Hanya boleh mengandung 0-9, A-Z dan spasi"}),$.validator.addMethod("maxDateRange",function(e,a,t){var n=new Date(e),i=new Date($(t[0]).val()),o=(n-i)/864e5;return/Invalid|NaN/.test(new Date(e))?isNaN(e)&&isNaN($(t[0]).val())||o<=t[1]:o<=t[1]},"Melebihi maksimal range {1} hari."),jQuery.validator.addMethod("greaterThan",function(e,a,t){return console.log(e,a,t),/Invalid|NaN/.test(new Date(e))?isNaN(e)&&isNaN($(t).val())||Number(e)>Number($(t).val()):new Date(e)>new Date($(t).val())},"Must be greater than {0}."),$.validator.addMethod("ageCheck",function(e,a,t){return moment().diff(function(e){var a=e.split("-");return moment([a[2],a[1]-1,a[0]])}(e),"years")>=t},"Check Umur"),jQuery.validator.addMethod("numbers2",function(e,a){return this.optional(a)||/^-?(?!0)(?:\d+|\d{1,3}(?:\.\d{3})+)$/.test(e)},"Mohon isi hanya dengan nomor"),jQuery.validator.addMethod("nameCheck",function(e,a){return this.optional(a)||/^([a-zA-Z' ]+)$/.test(e)},"Nama hanya boleh mengandung A-Z dan '"),jQuery.validator.addMethod("numericsSlash",function(e,a){return this.optional(a)||/^([0-9\/]+)$/.test(e)},"Nama hanya boleh mengandung 0-9 dan /"),jQuery.validator.addMethod("numericDot",function(e,a){return this.optional(a)||/^([0-9.]+)$/.test(e)},"Nama hanya boleh mengandung 0-9 dan ."),jQuery.validator.addMethod("numericKoma",function(e,a){return this.optional(a)||/^([0-9,]+)$/.test(e)},"Nama hanya boleh mengandung 0-9 dan ,"),jQuery.validator.addMethod("alphaNumeric",function(e,a){return this.optional(a)||/^[a-zA-Z0-9. ]*$/.test(e)},"Hanya boleh mengandung 0-9, A-Z, Titik dan spasi"),jQuery.validator.addMethod("alphaNumericNS",function(e,a){return this.optional(a)||/^[a-zA-Z0-9]*$/.test(e)},"Nama hanya boleh mengandung 0-9 dan A-Z"),jQuery.validator.addMethod("alamatFormat",function(e,a){return this.optional(a)||/^[a-zA-Z0-9 .,-\/]*$/.test(e)},"Nama hanya boleh mengandung A-Z, 0-9, titik, koma, dan strip"),jQuery.validator.addMethod("defaultText",function(e,a){return this.optional(a)||/^[a-zA-Z0-9 ',-.:\/?!&%()+=_\n]*$/.test(e)},"Inputan hanya boleh mengandung A-Z, 0-9, spasi dan simbol .,:'/?!&%()-+=_"),jQuery.validator.addMethod("defaultName",function(e,a){return this.optional(a)||/^[a-zA-Z0-9 .']*$/.test(e)},"Inputan hanya boleh mengandung A-Z, 0-9, spasi dan simbol .'"),jQuery.validator.addMethod("arabic",function(e,a){return this.optional(a)||/^[\u0600-\u06FF\u0750-\u077F ]*$/.test(e)},"Inputan hanya boleh bahasa Arab."),jQuery.validator.addMethod("defaultPhone",function(e,a){return this.optional(a)||/^[0-9-\/']*$/.test(e)},"Inputan hanya boleh mengandung 0-9, spasi, dan simbol-/'"),jQuery.validator.addMethod("alpha",function(e,a){return this.optional(a)||/^[a-zA-Z ]*$/.test(e)},"Nama hanya boleh mengandung A-Z dan spasi"),jQuery.validator.addMethod("alphaNS",function(e,a){return this.optional(a)||/^[a-zA-Z]*$/.test(e)},"Nama hanya boleh mengandung A-Z"),jQuery.validator.addMethod("addresscheck",function(e,a){return this.optional(a)||/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\s).{8,}$/.test(e)},"Input harus mengandung satu nomor, satu huruf kecil dan satu huruf besar"),jQuery.validator.addMethod("pwcheck",function(e,a){return this.optional(a)||/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}$/.test(e)},"Input harus mengandung satu nomor, satu huruf kecil dan satu huruf besar"),jQuery.validator.addMethod("pwcheck_alfanum",function(e,a){return this.optional(a)||/^(?=.*\d)(?=.*\D)(?!.*\s).{8,14}$/.test(e)},"Input harus merupakan kombinasi antara angka dan huruf"),jQuery.validator.addMethod("pwcheck2",function(e,a){return this.optional(a)||/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w])(?!.*[#<>\/\\=”’"'])(?!.*\s).{8,14}$/.test(e)},'Input harus mengandung satu nomor, satu huruf kecil, satu huruf besar, simbol kecuali "#<>/\\="\''),jQuery.validator.addMethod("pwcheck3",function(e,a){return this.optional(a)||/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w])(?!.*\s).{8,12}$/.test(e)},"Input harus mengandung satu nomor, satu huruf kecil, satu huruf besar, simbol"),jQuery.validator.addMethod("max",function(e,a,t){var n=parseFloat(e.replace(/\./g,""));return this.optional(a)||n<=t},jQuery.validator.format("Maksimal {0}")),jQuery.validator.addMethod("maxDec",function(e,a,t){var n=e.replace(",",".");return this.optional(a)||n<=t},jQuery.validator.format("Maksimal {0}")),jQuery.validator.addMethod("maxDecMargin",function(e,a,t){var n=e.replace(",",".");return this.optional(a)||n<=t
},jQuery.validator.format("Margin tidak valid")),jQuery.validator.addMethod("notEqual",function(e,a,t){return this.optional(a)||e!=$(t).val()},"This has to be different..."),jQuery.validator.addMethod("notZero",function(e,a,t){var n=parseFloat(e.replace(/\./g,""));e.substr(0,1);return this.optional(a)||n!=t},jQuery.validator.format("Value Tidak Boleh 0")),jQuery.validator.addMethod("zeroValid",function(e,a,t){var n=e.substr(0,1),i=parseFloat(e.replace(/\./g,""));return 1==e.length?this.optional(a)||i==n:this.optional(a)||n!=t},jQuery.validator.format("Angka pertama tidak boleh 0")),jQuery.validator.addMethod("minValue",function(e,a,t){return e>=t},"Min Value needed"),jQuery.validator.addMethod("checkDate",function(e,a){return this.optional(a)||/^(((0[1-9]|[12]\d|3[01])\-(0[13578]|1[02])\-((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\-(0[13456789]|1[012])\-((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\-02\-((19|[2-9]\d)\d{2}))|(29\-02\-((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/.test(e)},"Format tanggal salah"),jQuery.validator.addMethod("checkTime",function(e,a){return this.optional(a)||/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/.test(e)},"Format time (HH:mm) salah"),jQuery.validator.addMethod("formatSeparator",function(e,a){return this.optional(a)||/^[A-Za-z ]+(,[A-Za-z ]+){0,2}$/.test(e)},"Contoh format: Ibu rumah tangga,pedagang,tukang jahit"),jQuery.validator.addMethod("checkDateyyyymmdd",function(e,a){return this.optional(a)||/^\d{4}-((0\d)|(1[012]))-(([012]\d)|3[01])$/.test(e)},"Format tanggal YYYY-MM-DD, contoh: 2016-01-30"),jQuery.validator.addMethod("checkDateddmmyyyy",function(e,a){return this.optional(a)||/^\d{2}\/\d{2}\/\d{4}$/.test(e)},"Format tanggal Bulan/Tanggal/Tahun, contoh: 06/08/1945"),jQuery.validator.addMethod("emailType",function(e,a){return e=e.toLowerCase(),this.optional(a)||/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(e)},"Email Anda salah. Email harus terdiri dari @ dan domain"),jQuery.validator.addMethod("symbol",function(e,a){return this.optional(a)||/^[a-zA-Z0-9!@#$%^&()]*$/.test(e)},"Password hanya boleh mengandung A-Z, a-z, 0-9 dan simbol dari 0-9"),jQuery.validator.addMethod("filesize",function(e,a,t){return this.optional(a)||a.files[0].size<=t},"Ukuran Maksimal Gambar 1 MB")},validateMe:function(e,a,t){validation.addMethods(),$("#"+e).validate({rules:a,messages:t,errorPlacement:function(e,a){var t=a.parents(".input");a.parents(".inputGroup").children(".alert.error").remove(),e.insertAfter(t),e.addClass("alert error")},success:function(e){e.parents("span.alert.error").remove()},wrapper:"span"})},validateMultiple:function(e,a,t){validation.addMethods(),$("#"+e).removeData("validator"),$("#"+e).removeData("check"),$("#"+e).removeData("confirm"),$("#"+e).find("input").removeClass("error"),$("#"+e).validate({rules:a,messages:t,errorPlacement:function(e,a){var t=a.parents(".input");a.parents(".inputGroup").children(".alert.error").remove(),e.insertAfter(t),e.addClass("alert error")},success:function(e){e.parents("span.alert.error").remove()},wrapper:"span"}).resetForm()},submitTry:function(e){if($(".nio_select").length&&$(".nio_select").show(),$(".added_photo").length&&!$(".imageAttachmentWrap.noApi").length&&$(".added_photo").show(),$(".tinymce").length&&$(".tinymce").show(),$(".stepForm").length){$(".stepForm.active").index();$(".stepForm").addClass("active")}return $("#"+e).valid()?($(".nio_select").hide(),$(".tinymce").hide(),validation.FileApiSupported()&&$(".added_photo").hide(),"vPassed"):($(".nio_select").hide(),$(".tinymce").hide(),validation.FileApiSupported()&&$(".added_photo").hide(),"vError")},FileApiSupported:function(){return!!(window.File&&window.FileReader&&window.FileList&&window.Blob)}};
