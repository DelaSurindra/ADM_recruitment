$(document).ready(function() {
	$('#table1').DataTable({
        responsive: true,
		language: {
        	search: "_INPUT_",
        	searchPlaceholder: "Search data...",
        	"paginate": {
     			 "previous": "<<",
     			 "next": ">>"
    		}
    	}
	});
	$('#table2').DataTable({
        responsive: true,
		language: {
        	search: "_INPUT_",
        	searchPlaceholder: "Search data...",
        	"paginate": {
     			 "previous": "<<",
     			 "next": ">>"
    		}
    	} 
	});
	$('#table3').DataTable({
		language: {
        	search: "_INPUT_",
        	searchPlaceholder: "Search data...",
        	"paginate": {
     			 "previous": "<<",
     			 "next": ">>"
    		}
    	} 
	});
	$('#table4').DataTable({
		language: {
        	search: "_INPUT_",
        	searchPlaceholder: "Search data...",
        	"paginate": {
     			 "previous": "<<",
     			 "next": ">>"
    		}
    	} 
	});
})
