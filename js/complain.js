$(document).ready(function() {

$(document).on('click',"[id^='Col_']",function(){	
			//$(this).parent().parent().remove();
			
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			UpdateNotification(ID);
	//OpenUserEdit(Id);
});
function UpdateNotification(serial)
	{
	
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tcomplain.php",
			  data: ({action:3,serial :serial}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				 
				location.reload();	  				 			  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	
});

