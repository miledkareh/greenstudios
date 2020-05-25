$(document).ready(function() {

ID=0;
offerid = findGetParameter('x');
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
$('#images1').on('filebeforedelete', function(event, key, data) {
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


//======================================================================================	
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
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage7.php',
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
    maxImageWidth: 1200,
    resizeImage: true,
     initialPreview: [],
    initialPreviewConfig: [],
			uploadExtraData: function() {
            return {
                serial: offerid
            };
           }
        });
        
        $('#images1').fileinput('destroy');
		        $("#images1").fileinput({
		        	
		        	theme: "explorer",
               'uploadUrl': '../../ws/ws_uploadimage8.php',
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
    maxImageWidth: 1200,
    resizeImage: true,
     initialPreview: [],
    initialPreviewConfig: [],
			uploadExtraData: function() {
            return {
                serial: offerid
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
	{$("#title").html("Add Attachment");
	document.getElementById("confidential").checked = true;
	}
});
function UpdateAtt()
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tmattachments.php",
			  data: ({action:5,offerid:offerid}),
			  
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
maintainancedetail_ID=findGetParameter('x');
		 
				  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_pendingtmattachments.php",
			  data: ({action:4,maintainancedetail_ID:maintainancedetail_ID}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				  else
				  {
  				  	data = JSON.parse(xhr.responseText);	
				 window.history.back();

				 }					

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 

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
			UpdateAttachment(ID,1,1);

	});
	//-----------------------------------------------------------------------------

//----------------------------------------------------------------------------------	
$("#add1").click(function(){
	var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!

var yyyy = today.getFullYear();
if(dd<10){
    dd='0'+dd;
} 
if(mm<10){
    mm='0'+mm;
} 
var today = yyyy+ "-" + mm+'-'+dd;
today=today.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
var d = new Date(),        
        h = d.getHours(),
        m = d.getMinutes();
       
    if(h < 10) h = '0' + h; 
    if(m < 10) m = '0' + m; 
  today=today+" "+h+":"+m;
offerid = findGetParameter('x');

		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,offerid,today);
			//location.reload();
			
	//	}
	


});
//===================================================================================

function UpdateAttachment(serial,offerid,today)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_pendingtmattachments.php",
			  data: ({action:3,serial:serial,today:today,offerid:offerid}),
			  
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
function addAttachment(attachment,privatee,offerid,main,confidential,status,today)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tmattachments.php",
			  data: ({action:1,today:today,attachment :attachment,privatee:privatee,offerid:offerid,main:main,confidential:confidential,status:status}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
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
			  data: ({id:serial,action:4}),			  
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
			  url: "../../ws/ws_pendingtmattachments.php",
			  data: ({action:6,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  
			location.reload();
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
				
				if(data[0]['status']=='wip'){
			  
		var initialPreview = [];
var initialPreviewConfig = [];
				 for(var i= 0; i < data.length; i++)
{

initialPreview.push('../../att/visits/wip/'+data[i]["maintenancedetailid"]+"/"+data[i]["description"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/visits/wip/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"] });
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/visits/wip/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"] });
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/visits/wip/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"] });
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/visits/wip/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"] });
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/visits/wip/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement",
            key: 3,
            downloadUrl: "../../att/visits/wip/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement",
            key: 3,
            downloadUrl: "../../att/visits/wip/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/visits/wip/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"] });
				break;
}}	
				  		if(data.length>0){
				$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
               'uploadUrl': '../../ws/ws_uploadimage7.php',
          overwriteInitial: false,
        validateInitialCount: true,
		 initialPreviewAsData: true,
		 		
    maxImageWidth: 1200,
    resizeImage: true,
            initialPreview: initialPreview,
            initialPreviewConfig: initialPreviewConfig,
			uploadExtraData: function() {
            return {
               serial: offerid
            };
           }
        });
		}
}
		//====================================REGULAR====================================================
	else {		
			  
				  				 // data = JSON.parse(xhr.responseText);	
		var initialPreview = [];
var initialPreviewConfig = [];
				 for(var i= 0; i < data.length; i++)
{

initialPreview.push('../../att/visits/regular/'+data[i]["maintenancedetailid"]+"/"+data[i]["description"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/visits/regular/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"] });
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/visits/regular/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"] });
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/visits/regular/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"] });
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/visits/regular/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"] });
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/visits/regular/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement",
            key: 3,
            downloadUrl: "../../att/visits/regular/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement",
            key: 3,
            downloadUrl: "../../att/visits/regular/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/visits/regular/"+data[i]["maintenancedetailid"]+"/"+data[i]["description"] });
				break;
}}	
				  		if(data.length>0){
				$('#images1').fileinput('destroy');
		        $("#images1").fileinput({
		        	
		        	theme: "explorer",
               'uploadUrl': '../../ws/ws_uploadimage8.php',
          overwriteInitial: false,
        validateInitialCount: true,
		 initialPreviewAsData: true,
		 		
    maxImageWidth: 1200,
    resizeImage: true,
            initialPreview: initialPreview,
            initialPreviewConfig: initialPreviewConfig,
			uploadExtraData: function() {
            return {
               serial: offerid
            };
           }
        });
		}
		}	
		
		
	
			
			}
	}
	else
	
		showError(serial);
		}
	

});

