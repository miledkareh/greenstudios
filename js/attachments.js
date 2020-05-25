$(document).ready(function() {

ID=0;
offerid = location.search.split('x=')[1];
//fillSections();
//getUsers();
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
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage4.php',
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
               'uploadUrl': '../../ws/ws_uploadimage5.php',
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
			  url: "../../ws/ws_tattachments.php",
			  data: ({action:6,offerid:offerid}),
			  
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
offerid = location.search.split('x=')[1];
if(document.getElementById('private').checked==true)
	privatee = 1;
	else privatee=0;
	if(document.getElementById('main').checked==true)
	main = 1;
	else main=0;
	if(document.getElementById('confidential').checked==true)
	confidential = 1;
	else confidential=0;
		
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,privatee,offerid,main,confidential,today);
			//location.reload();
			
	//	}
	


});
//===================================================================================

function UpdateAttachment(serial,privatee,offerid,main,confidential,today)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tattachments.php",
			  data: ({action:3,serial:serial,today:today,privatee:privatee,offerid:offerid,main:main,confidential:confidential}),
			  
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
			  url: "../../ws/ws_tattachments.php",
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
			  url: "../../ws/ws_attachments.php",
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
			  url: "../../ws/ws_tattachments.php",
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

initialPreview.push('../../att/wip/'+data[i]["offerid"]+"/"+data[i]["description"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment",
            key: 3,
            downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment",
            key: 3,
            downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
}}	
				  		if(data.length>0){
				$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
               'uploadUrl': '../../ws/ws_uploadimage4.php',
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

initialPreview.push('../../att/regular/'+data[i]["offerid"]+"/"+data[i]["description"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment",
            key: 3,
            downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment",
            key: 3,
            downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
}}	
				  		if(data.length>0){
				$('#images1').fileinput('destroy');
		        $("#images1").fileinput({
		        	
		        	theme: "explorer",
               'uploadUrl': '../../ws/ws_uploadimage5.php',
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
		
		
		if(	data[0]["Private"]==1)
			
			document.getElementById("private").checked = true;
			else
			document.getElementById("private").checked = false;
				if(	data[0]["Main"]==1)
			
			document.getElementById("main").checked = true;
			else
			document.getElementById("main").checked = false;
			if(	data[0]["confidential"]==1)
			
			document.getElementById("confidential").checked = true;
			else
			document.getElementById("confidential").checked = false;
			
			}
	}
	else
	
		showError(serial);
		}
	

});

