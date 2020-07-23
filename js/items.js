$(document).ready(function() {
var Longitude=0;
var Latitude=0;
duplicate=0;
ID=0;//fillSections();
ID2=0;
$('body').on('hidden.bs.modal', function () {
    if($('.modal.in').length > 0)
    {
        $('body').addClass('modal-open');
    }
});
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
$("#myModal2").on('hidden.bs.modal', function (e) {
	document.getElementById("lblalert").style.visibility='hidden';
	document.getElementById("lblalert3").style.visibility='hidden';
	  $(this)
		.find("input,textarea,select")
		   .val('')
		   .end()
		.find("input[type=checkbox], input[type=radio]")
		   .prop("checked", "")
		   .end();
		   
	});
		$("#myModal2").on('shown.bs.modal', function () {
	document.getElementById("lblalert3").style.visibility='hidden';
	 if(ID2 > 0)
		 
		{
			$("#title2").html("Edit Quantity");
	
			bringData1(ID2);
			}
		else
		$("#title2").html("Add Quantity");
			
	});
	function bringData1(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getitemquantity.php",
			  data: ({action:1,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  decide1(data,serial);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				// alert(status + errorThrown);
				  
			  }
		  });  	
	}	
	function decide1(data,serial)
	{		

		count=data.length;
	if(count>0)
	{
		if( serial==0)
			alert("user exist");	
		else 
			{		
			

		document.getElementById("size").value=data[0]["size"];
		document.getElementById("qty").value=data[0]["qty"];
			}
	}
	else
	
		showError(serial);
		}	
$("#myModal").on('shown.bs.modal', function () {
	$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage12.php',
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
    maxImageWidth: 1200,
    resizeImage: true,
     initialPreview: [],
    initialPreviewConfig: [],
			uploadExtraData: function() {
            return {
                serial: ID
            };
           }
        });
document.getElementById("lblalert").style.visibility='hidden';

 if(ID > 0)
	 
	{
		$("#title").html("Edit Item");

		bringData(ID);
		getQuantity(ID);
		}
	else
	{$("#title").html("Add Item");
	bringData1();
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
		duplicate=0;

	});

	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			var answer = confirm("Are You Sure You Want To Delete This Item");
    if (answer)
			deleteAttachment(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
			duplicate=0;
	});
	$(document).on('click',"[id^='Dup_']",function(){
		strID=$(this).attr('id');			
	  ID = strID.substring(4);
	  duplicate=1;
});
$(document).on('click',"[id='Ad1']",function(){

	if(ID==0)
			document.getElementById("lblalert2").style.visibility='visible';	
	else
	{
	ID2=0;
	$('#myModal2').modal('show');		//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
	}

});
$(document).on('click',"[id^='Editt_']",function(){
		
	strID=$(this).attr('id');			
  ID2 = strID.substring(6);
  
});
	//-----------------------------------------------------------------------------
	$("#add4").click(function(){

		
	
		size= $("#size").val();
		qty= $("#qty").val();
	

		if( qty=='')
		document.getElementById("lblalert3").style.visibility='visible';
		else{
		if(ID2==0)	
						{
								
							//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
							addNote(ID,size,qty);
				
							
						}
				else{ 
				//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
				UpdateNote(ID2,ID,size,qty);
					
					}	
			//	}
		
		}
		
		});	
		function addNote(itemid,size,qty)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_titemquantity.php",
			  data: ({action:1,itemid:itemid,size:size,qty:qty}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				 
		document.getElementById("size").value='';
		document.getElementById("qty").value=0;
	
				getQuantity(itemid);}			  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	//========================================================
	function UpdateNote(serial,itemid,size,qty)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_titemquantity.php",
			  data: ({action:3,serial :serial,itemid:itemid,size:size,qty:qty}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	
						getQuantity(itemid);
				$('#myModal2').modal('hide');
				  }
  				  				  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  }
		  	function getQuantity(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getitemquantity.php",
			  data: ({action:2,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  populateQuantity(data);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				// alert(status + errorThrown);
				  
			  }
		  });  	
	} 
function populateQuantity(data)
	{		
	$("#followup").empty();
		count=data.length;
		var item;
 
		if(count>0)
		{			
			
			
		   $.each(data, function(index, row) {
				item = "<tr id='tr_"+row.serial+"'>";
				item+=   "<td>"+row.dat+"</td>";
              
				item+=   "<td>"+row.size+"</td>";
				
                item+=   "<td>"+row.qty+"</td>";
 				item+=   "<td>"+row.diff+"</td>";
                  
				if(row.ViewQuantity==1){
                item+="<td><a  id='Editt_"+row.serial+"'  data-toggle='modal' data-target='#myModal2' ><p class='fa fa-edit'></p></a>&nbsp;";
  
               item+="<a  id='dell1_"+row.serial+"' ><p class='fa fa-trash-o'></p></a></td>";
				}  
			   item+= "</tr>";

 
			   
				$("#followup").append(item);
			});
			
		}
	}	
	$(document).on('click',"[id^='dell1_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID2 = strID.substring(6);
			var answer = confirm("Are You Sure You Want To Delete This record");
    if (answer)
			deleteQuantity(ID2);
		
			
	});
	function deleteQuantity(idval)
	{
		
		//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_titemquantity.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
				  	
			getQuantity(ID);
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
		
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	//=================================================================================
	
$("#add1").click(function(){

cat= $("#cat").val();

//title= $("#title1").val();
description= $("#description").val();
code= $("#code").val();
ccode= $("#ccode").val();
ddescription= $("#ddescription").val();
unit= $("#unit").val();
priceusd= 0+$("#priceusd").val();
pricekd=0+ $("#pricekd").val();
priceaed= 0+$("#priceaed").val();
cost= 0+$("#cost").val();
usupplier= $("#usupplier").val();
dimension= $("#dimension").val();
	group= 0+$("#group").val();
	currency= 0+$("#currency1").val();
	if(document.getElementById('idol').checked==true)
	idol = 1;
	else idol=0;

if(document.getElementById('default1').checked==true)
	default1 = 1;
	else default1=0;



	if( description=='' || code=='')
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment(cost,usupplier,idol,description,code,ccode,ddescription,unit,priceusd,dimension,group,currency,pricekd,priceaed,0,cat,default1);
					
					
				}
		else{ 
			if(duplicate==1)
			addAttachment(cost,usupplier,idol,description,code,ccode,ddescription,unit,priceusd,dimension,group,currency,pricekd,priceaed,ID,cat,default1);
			else
			//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,cost,usupplier,idol,description,code,ccode,ddescription,unit,priceusd,dimension,group,currency,pricekd,priceaed,cat,default1);
			
			}	
	//	}
	
}

});
//===================================================================================

function UpdateAttachment(serial,cost,usupplier,idol,description,code,ccode,ddescription,unit,priceusd,dimension,group,currency,pricekd,priceaed,cat,default1)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_titems.php",
			  data: ({action:3,serial :serial,cost:cost,usupplier:usupplier,idol:idol,currency:currency,description:description,code:code,ccode:ccode,cat:cat,default1:default1,ddescription:ddescription,unit:unit,priceusd:priceusd,dimension:dimension,group:group,pricekd:pricekd,priceaed:priceaed}),
			  
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
function addAttachment(cost,usupplier,idol,description,code,ccode,ddescription,unit,priceusd,dimension,group,currency,pricekd,priceaed,duplicate,cat,default1)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_titems.php",
			  data: ({action:1,duplicate:duplicate,cost:cost,usupplier:usupplier,cat:cat,default1:default1,idol:idol,currency:currency,description:description,code:code,ccode:ccode,ddescription:ddescription,unit:unit,priceusd:priceusd,dimension:dimension,group:group,pricekd:pricekd,priceaed:priceaed}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	location.reload();
  				//  	bringData2();
  				  
  				  
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
			  url: "../../ws/ws_items.php",
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
			  url: "../../ws/ws_titems.php",
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
			
		document.getElementById("ddescription").value=data[0]["ddescription"];
			document.getElementById("code").value=data[0]["code"];
			document.getElementById("ccode").value=data[0]["ccode"];
			document.getElementById("dimension").value=data[0]["dimension"];
			document.getElementById("unit").value=data[0]["unit"];
			document.getElementById("priceusd").value=data[0]["priceusd"];
			document.getElementById("pricekd").value=data[0]["pricekd"];
			document.getElementById("priceaed").value=data[0]["priceaed"];
			document.getElementById("group").value=data[0]["group1"];
			document.getElementById("cost").value=data[0]["cost"];
			document.getElementById("usupplier").value=data[0]["usupplier"];
			document.getElementById("currency1").value=data[0]["currency"];
			if(	data[0]["idol"]==1)
			document.getElementById("idol").checked = true;
			else
			document.getElementById("idol").checked = false;





		document.getElementById("cat").value=data[0]["cat"];


if(	data[0]["default1"]==1)
			document.getElementById("default1").checked = true;
			else
			document.getElementById("default1").checked = false;

		
		
			 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_itemattachment.php",
			  data: ({id:ID,action:1}),			  
			  dataType: 'json',
			   cache: false,
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				  				  data = JSON.parse(xhr.responseText);	
				  				  
				  				  if(data==null){
				  				  	$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage12.php',
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
 
     initialPreview: [],
    initialPreviewConfig: [],
			uploadExtraData: function() {
            return {
                serial: ID
            };
           }
        });
				  				  }
				  				  else{
		var initialPreview = [];
var initialPreviewConfig = [];
				 for(var i= 0; i < data.length; i++)
{

initialPreview.push('../../att/Items/'+data[i]["description"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=itemattachment"   , key: data[i]["serial"],downloadUrl: "../../att/Items/"+data[i]["description"] });
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=itemattachment"   , key: data[i]["serial"],downloadUrl: "../../att/Items/"+data[i]["description"] });
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=itemattachment"   , key: data[i]["serial"],downloadUrl: "../../att/Items/"+data[i]["description"] });
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=itemattachment"   , key: data[i]["serial"],downloadUrl: "../../att/Items/"+data[i]["description"] });
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=itemattachment"   , key: data[i]["serial"],downloadUrl: "../../att/Items/"+data[i]["description"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=itemattachment",
            key: 3,
            downloadUrl: "../../att/Items/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=itemattachment",
            key: 3,
            downloadUrl: "../../att/Items/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=itemattachment"   , key: data[i]["serial"],downloadUrl: "../../att/Items/"+data[i]["description"] });
				break;
}}	
				  		if(data.length>0){
				$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
               'uploadUrl': '../../ws/ws_uploadimage12.php',
          overwriteInitial: false,
        validateInitialCount: true,
		 initialPreviewAsData: true,
		 		
   
   
            initialPreview: initialPreview,
            initialPreviewConfig: initialPreviewConfig,
			uploadExtraData: function() {
            return {
               serial: ID
            };
           }
        });
		}}
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
				   
			  }
		  }); 
			}
			
	}
	else
	
		showError(serial);
		}

			$(document).on('click',"[id^='default1']",function(){



if (document.getElementById('default1').checked) 
  {
       
      $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getdefault.php",
			  data: ({ID:ID}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		 
			 
			 if(data!==null){

			 	alert('Another Item is set as default for this category!');
			 	document.getElementById('default1').checked=false;
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









});
	

});

