$(document).ready(function() {
	 $.ajax({
			  type: 'POST',
			  url: "ws/ws_CheckIsAdmin.php",
			  data: ({}),
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
  				  	data = JSON.parse(xhr.responseText);
  				  	
				  if(data==1){
				  	  oTable=  $('#dataTables-example').DataTable({
				  	  	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    	 dom: 'Bfrtip',
    buttons: [
      {
         extend: 'collection',
         text: 'Export',
         buttons: [ 'pdfHtml5', 'csvHtml5', 'copyHtml5', 'excelHtml5' ]
      }
   ],
    responsive: true,
			"aaSorting": [],
				"stateSave": true
    });
				  }
				 else{
				 	 oTable=  $('#dataTables-example').DataTable({
				 	 	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    responsive: true,
			"aaSorting": [],
				"stateSave": true
    });
				 }
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  }
		  });
});
	