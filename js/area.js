$(document).ready(function() {

ID=0;
var invoice= findGetParameter("y");
//fillSections();
//getUsers();

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
 $('select[id="offer"]').change(function () {
 	serial=$("#offer").val();

 	//fillOffer(serial);
 	
    });
    function fillOffer(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_offers.php",
			  data: ({id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  	count=data.length;
				  
	if(count>0)
	{
		
		if( serial==0)
			alert("user exist");	
		else 
			{	
				alert(data[0]['GW']);
				$("#tableareas").empty();
				item = "<tr id='tr_"+data[0]['Serial']+"'>";
               	if(data[0]['GW']==1)
                item+=   "<td style='width:30%;'>  Gw INDOOR  </td>";
                else 	if(data[0]['RG']==1)
                item+=   "<td style='width:30%;'>  RG INDOOR  </td>";
                item+=   "<td style='width:30%;'>Area</td>";                        
				item+=   "<td style='width:15%;'>Save</td>";
                item+= "</tr>";
                item+= "<tr><td><input type='text'   name='title'  id='title' style='width:100%;'></td><td><input type='text'   name='title'  id='title' style='width:100%;'></td><td><button type='button' style='width:100%;' id='addarea'  >Save</button></td></tr>";
                item+=   "<tr><td style='width:30%;' align='right'>  Total Area  </td><td colspan='2'>&nbsp;</td></tr>";
				$("#tableareas").append(item);
				}
	}				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';
 if(ID > 0)
	 
	{
		$("#title").html("Edit Area");

		bringData(ID);
		}
	else
	$("#title").html("Add Area");
		
});


$("#myModal").on('hidden.bs.modal', function (e) {
document.getElementById("lblalert").style.visibility='hidden';
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});


// ADD User
$(document).on('click',"[id^='Add']",function(){

			ID=0;
		

	});

	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			var answer = confirm("Are You Sure You Want To Delete This Area");
    if (answer)
			deleteAttachment(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
	});
	//-----------------------------------------------------------------------------
	
$("#add1").click(function(){


description= $("#description").val();
total= $("#total").val();
if( description=='' || total=='')
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment(description,total,invoice);
					
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,description,total,invoice);
			
			}	
	//	}
	
}

});
//===================================================================================

function UpdateAttachment(serial,description,total,invoice)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tarea.php",
			  data: ({action:3,serial :serial,description:description,total:total,invoice:invoice}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				  location.reload();}			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	

//=====================================================================================
function addAttachment(description,total,invoice)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tarea.php",
			  data: ({action:1,description:description,total:total,invoice:invoice}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				  location.reload();}		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	
	function bringData(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_area.php",
			  data: ({id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  decide(data,serial);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
	
	//delete person from server
	function deleteAttachment(idval)
	{
		
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tarea.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
			location.reload();
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 location.reload();
			
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
////////////////////////////////////////////////////////////////////////////////////
function populate(data)
	{		
		
		count=data.length;
		var item;

		if(count>0)
		{			
			
		   $.each(data, function(index, row) {
				item = "<tr id='tr_"+row.serial+"'>";
                item+=   "<td>"+row.projectN+"</td>";
                item+=   "<td>"+row.title+"</td>";
                item+=   "<td>"+row.subject+"</td>";
    
				//item+=   "<td>"+row.admin+"</td>";
                item+=   "<td><a  id='Edit_"+row.serial+"'  data-toggle='modal' data-target='#myModal' ><p class='fa fa-edit'></p> Edit</a></td>";
               item+=   "<td><button type='button' class='btn btn-success del' id='del_"+row.serial+"'> Delete</button></td>";
                item+= "</tr>";
				$("#tableareas").append(item);
			});
			
		}
	}
////////////////////////////////////////////////////////////////////////////////////////	

		function decide(data,serial)
	{		

		count=data.length;
	if(count>0)
	{
		if( serial==0)
			alert("user exist");	
		else 
			{		
		
		document.getElementById("description").value=data[0]["description"];
			document.getElementById("total").value=data[0]["total"];
			
			}
	}
	else
	
		showError(serial);
		}
	

});

