$(document).ready(function() {

ID=0;
imgname="";
//fillSections();
//getUsers();

$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';
 if(ID > 0)
	 
	{
		$("#title").html("Edit Palette");

		bringData(ID);
		}
	 
		
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
			 
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			var answer = confirm("Are You Sure You Want To Delete This Palette?");
    if (answer)
			deleteAttachment(ID);
		
			
	});



$(document).on('click',"[id^='delll1_']",function(){	
			 
	  		strID=$(this).attr('id');			
			ID2 = strID.substring(7);
			var answer = confirm("Are You Sure You Want To Delete This Plant?");
    if (answer)
			deleteAttachmentt(ID2);
		
			
	});





	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
	});
	//-----------------------------------------------------------------------------
	
$("#add1").click(function(){

description= $("#description").val();
plantselect= $("#plantselect").val();
if( description=='')
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment(description,plantselect);
					
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,description,plantselect);
			
			}	
	//	}
	
}

});
//===================================================================================

function UpdateAttachment(serial,description,plantselect)
	{
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_newpalette.php",
			  data: ({action:3,serial:serial,description:description,plantselect:plantselect}),
			  
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
				   $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	

//=====================================================================================
function addAttachment(description,plantselect)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tpwork.php",
			  data: ({action:1,description:description,plantselect:plantselect}),
			  
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
			  url: "../../ws/ws_sspalette.php",
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
			  url: "../../ws/ws_tsavepalette.php",
			  data: ({action:2,id:idval}),
			  
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
				 
			 
				   alert(status + errorThrown);
			  }
		  });  //	

	}






	function deleteAttachmentt(idval)
	{
  
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tsavepalette.php",
			  data: ({action:3,id:idval,ID:ID}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  filltable(ID);
			
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
			 
				   alert(status + errorThrown);
			  }
		  });  //	

	}
////////////////////////////////////////////////////////////////////////////////////
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   $.ajax({
    url:"upload.php",
    method:"POST",
    data:  form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
    },   
    success:function(data)
    {
    	 imgname=data;
     $('#uploaded_image').html('<img src="'+data+'" height="150" width="225" class="img-thumbnail" />');

    }
   });
  }
 });


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
			document.getElementById("description").value=data[0]["palettename"];
		 
	  var values=data[0]["plants"];
			 $.each(values.split(","), function(i,e){
			 	 
	     $("#plantselect option[value='" + e + "']").prop("selected", true);
	    });
			filltable(serial);
			
			
			}
	}
	else
	
		showError(serial);
		}
	


	function filltable(serial)
	{

 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_savepalette.php",
			  data: ({action:2,id:serial}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				populate(data);
				  
			
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
			 
				   alert(status + errorThrown);
			  }
		  });  //	








	}



	function populate(data)
	{		
	$("#tblplants").empty();
		count=data.length;
		var item;
item= "<tr><th>Plante Name</th><th>Delete</th></tr>";
		if(count>0)
		{			
			
		   $.each(data, function(index, row) {
		   	
		    

				item+= "<tr id='tr_"+row.serial+"'>";
                item+=   "<td>"+row.scientic+"</td>";
               
                
             
               item+="<td><a  id='delll1_"+row.serial+"' ><p class='fa fa-trash-o'></p> Delete</a></td>";
                item+= "</tr>";
			
			});
				$("#tblplants").append(item);
		}
	}

});
