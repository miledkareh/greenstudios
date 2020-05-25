$(document).ready(function() {
ID=0;
var serial=0;
var canedit=0;
var candelete=0;
var canview=0;
profile= findGetParameter("x");
function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    var items = location.search.substr(1).split("&");
    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    }
    return result;
}
$(document).on('click',"[id^='Cedit_']",function(){	
	  		strID=$(this).attr('id');			
			ID = strID.substring(6);
			
			if(document.getElementById('Cedit_'+ID).checked==true)
			canedit=1;
			else
			canedit=0;
		
			/////////////////////
			if(document.getElementById('Cdel_'+ID).checked==true)
			candelete=1;
			else
			candelete=0;
			///////////////////////////////
			if(document.getElementById('Cview_'+ID).checked==true)
			canview=1;
			else
			canview=0;
			
	  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_userprofiledetail.php",
			  data: ({serial :ID,canedit :canedit,canview:canview,candelete:candelete,profile:profile}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				  
				  if(data==0)
				  	alert("No Update!");
				  else
  				  	data = JSON.parse(xhr.responseText);				  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  });
		
			
	});
//===================================================================================
$(document).on('click',"[id^='Cdel_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
			if(document.getElementById('Cedit_'+ID).checked==true)
			canedit=1;
			else
			canedit=0;
			/////////////////////
			if(document.getElementById('Cdel_'+ID).checked==true)
			candelete=1;
			else
			candelete=0;
			///////////////////////////////
			if(document.getElementById('Cview_'+ID).checked==true)
			canview=1;
			else
			canview=0;
	  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_userprofiledetail.php",
			  data: ({serial :ID,canedit :canedit,canview:canview,candelete:candelete,profile:profile}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				  
				  if(data==0)
				  	alert("No Update!");
				  else
  				  	data = JSON.parse(xhr.responseText);				  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  });
		
			
	});
//----------------------------------------------------------------------------------
$(document).on('click',"[id^='Cview_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(6);
			if(document.getElementById('Cedit_'+ID).checked==true)
			canedit=1;
			else
			canedit=0;
			/////////////////////
			if(document.getElementById('Cdel_'+ID).checked==true)
			candelete=1;
			else
			candelete=0;
			///////////////////////////////
			if(document.getElementById('Cview_'+ID).checked==true)
			canview=1;
			else
			canview=0;
	  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_userprofiledetail.php",
			  data: ({serial :ID,canedit :canedit,canview:canview,candelete:candelete,profile:profile}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				  
				  if(data==0)
				  	alert("No Update!");
				  else
  				  	data = JSON.parse(xhr.responseText);				  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
		
			  }
			  
		  });
		
			
	});
//=========================================================================================



});

