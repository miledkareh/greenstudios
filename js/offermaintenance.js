$(document).ready(function() {

ID=0;
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
$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';
document.getElementById("email").value="hello@greenstudios.net";
document.getElementById("phone").value="+96170411331";
document.getElementById("visits").value="12 monthly visits";
 if(ID > 0)
	 
	{
		$("#title").html("Edit Maintenance");

		bringData(ID);
		}
	else
	$("#title").html("Add Maintenance");
		
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
			var answer = confirm("Are You Sure You Want To Delete This Note");
    if (answer)
			deleteNote(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
	});
	//-----------------------------------------------------------------------------
	
$("#add1").click(function(){
invoiceid = findGetParameter('y');
visits= $("#visits").val();
email= $("#email").val();
phone= $("#phone").val();
currency= 0+$("#currency1").val();
total= $("#total").val();
fees= $("#fees").val();
spotfees= $("#spotfees").val();
agreement= $("#agreement").val();
if( agreement=='')
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addNote(invoiceid,visits,currency,total,fees,agreement,email,phone,spotfees);
					
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateNote(ID,invoiceid,visits,currency,total,fees,agreement,email,phone,spotfees);
			
			}	
	//	}
	
}

});
//===================================================================================

function UpdateNote(serial,offerid,visits,currency,total,fees,agreement,email,phone,spotfees)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_toffermaintenance.php",
			  data: ({action:3,serial :serial,spotfees:spotfees,offerid:offerid,visits:visits,currency:currency,total:total,fees:fees,agreement:agreement,email:email,phone:phone}),
			  
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
function addNote(offerid,visits,currency,total,fees,agreement,email,phone,spotfees)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_toffermaintenance.php",
			  data: ({action:1,spotfees:spotfees,offerid:offerid,visits:visits,currency:currency,total:total,fees:fees,agreement:agreement,email:email,phone:phone}),
			  
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
			  url: "../../ws/ws_offermaintenance.php",
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
	function deleteNote(idval)
	{

		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_toffermaintenance.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
			
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
			
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
////////////////////////////////////////////////////////////////////////////////////

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
			
		//document.getElementById("project").value=data[0]["offerid"];
		document.getElementById("currency1").value=data[0]["currency"];
		document.getElementById("fees").value=data[0]["fees"];
		document.getElementById("visits").value=data[0]["visits"];
		document.getElementById("agreement").value=data[0]["agreement"];
		document.getElementById("total").value=data[0]["total"];
		document.getElementById("email").value=data[0]["email"];
		document.getElementById("phone").value=data[0]["phone"];
		document.getElementById("spotfees").value=data[0]["spotfees"];
		
			
			
			
			}
	}
	else
	
		showError(serial);
		}
	

});

