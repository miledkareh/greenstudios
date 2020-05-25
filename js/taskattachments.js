$(document).ready(function() {


ID=0;
//fillSections();
//getUsers();
task=findGetParameter('x');
$('#images').on('filebeforedelete', function(event, key, data) {
		return swal({
   position: 'top',
  title: "Are You Sure You Want To Delete This Image !",
  text: "Once deleted, you will not be able to recover this information!",
  type: 'warning',
  showCancelButton: true,
  cancelButtonColor: '#d33',
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
  return false;
  } 
  else{return true;}
});
        return abort;
});
$("#myModal").on('shown.bs.modal', function () {
		$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage9.php',
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
    maxImageWidth: 1200,
    resizeImage: true,
     initialPreview: [],
    initialPreviewConfig: [],
			uploadExtraData: function() {
            return {
                serial: task
            };
           }
        });
        UpdateAtt();
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
function UpdateAtt()
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_ttaskattachments.php",
			  data: ({action:4}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				  }
  				  				  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } 

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
//----------------------------------------------------------------------------------	
$("#add1").click(function(){



task=findGetParameter('x');

		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,task);
			//location.reload();
				
	//	}
	


});
//===================================================================================

function UpdateAttachment(serial,maintenance)
	{

		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_ttaskattachments.php",
			  data: ({action:3,serial :serial,maintenance:maintenance}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				  else
				  {
  				  	data = JSON.parse(xhr.responseText);	
  				  	location.reload();
				 }					

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
function addAttachment(attachment,maintenance)
	{		
	
	
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_ttaskattachments.php",
			  data: ({action:1,attachment :attachment,maintenance:maintenance}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				 	  {
  				  	data = JSON.parse(xhr.responseText);	
				 }		  
				
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
			  url: "../../ws/ws_taskattachments.php",
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
			  url: "../../ws/ws_ttaskattachments.php",
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
		
				var initialPreview = [];
var initialPreviewConfig = [];
				 for(var i= 0; i < data.length; i++)
{

initialPreview.push(data[i]["url"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=taskattachments"   , key: data[i]["serial"],downloadUrl: data[i]["url"]});
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=taskattachments"   , key: data[i]["serial"],downloadUrl: data[i]["url"] });
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=taskattachments"   , key: data[i]["serial"],downloadUrl: data[i]["url"] });
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=taskattachments"   , key: data[i]["serial"],downloadUrl: data[i]["url"] });
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=taskattachments"   , key: data[i]["serial"],downloadUrl: data[i]["url"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=taskattachments",
            key: 3,
            downloadUrl: data[i]["url"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=taskattachments",
            key: 3,
            downloadUrl: data[i]["url"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=taskattachments"   , key: data[i]["serial"],downloadUrl: data[i]["url"]});
				break;
}}	
				  		if(data.length>0){
				$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
               'uploadUrl': '../../ws/ws_uploadimage9.php',
          overwriteInitial: false,
        validateInitialCount: true,
		 initialPreviewAsData: true,
		 		
    maxImageWidth: 1200,
    resizeImage: true,
            initialPreview: initialPreview,
            initialPreviewConfig: initialPreviewConfig,
			uploadExtraData: function() {
            return {
               serial: task
            };
           }
        });
		}

			}
	}
	else
	
		showError(serial);
		}
	

});

