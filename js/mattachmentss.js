$(document).ready(function() {

ID=0;
//fillSections();
//getUsers();

$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';
$("#btnsearch").val("Select Attachment");
$("#add1").val("Save");
 if(ID > 0)
	 
	{
		$("#title").html("Edit Attachment");

		bringData(ID);
		}
	else
	$("#title").html("Add Attachment");
		
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
$("#fileToUpload").change(function(){
var str = document.getElementById("fileToUpload").value;
var n = str.lastIndexOf('\\');
var result = str.substring(n + 1);

	document.getElementById("attachment12").value= result;
	
	//OpenUserEdit(Id);
});
	//delete a selcted person
	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			
			var answer = confirm("Are You Sure You Want To Delete This Attachment");
    if (answer)
			deleteAttachment(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
	});
	//-----------------------------------------------------------------------------

//----------------------------------------------------------------------------------	
$("#add1").click(function(){

attachment=$("#attachment12").val();
x = location.search.split('x=')[1].split('&y=');
detail=x[0];
maintenance=x[1];
if(attachment=='')
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					
					addAttachment(attachment,detail,maintenance);
				//	location.reload();
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,attachment,detail,maintenance);
			//location.reload();
			}	
	//	}
	
}

});
//===================================================================================

function UpdateAttachment(serial,attachment,detail,maintenance)
	{

		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tmattachments.php",
			  data: ({action:3,serial :serial,attachment :attachment,detail:detail,maintenance:maintenance}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				  else
				  {
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
function addAttachment(attachment,detail,maintenance)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tmattachments.php",
			  data: ({action:1,attachment :attachment,detail:detail,maintenance:maintenance}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				 	  {
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
			  url: "../../ws/ws_mattachments.php",
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
			  url: "../../ws/ws_tmattachments.php",
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
document.getElementById("attachment12").value=data[0]["description"];
			}
	}
	else
		showError(serial);
		}
	

});

