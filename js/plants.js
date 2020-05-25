$(document).ready(function() {

Dup=0;





ID=0;
pot=0;
$('body').on('hidden.bs.modal', function () {
    if($('.modal.in').length > 0)
    {
        $('body').addClass('modal-open');
    }
});
//fillSections();
//getUsers();
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
function deleteImages(idval,page)
	{
		
		//$("#LoadingImage").show();
			$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
               'uploadUrl': '../../ws/ws_uploadimage11.php',
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
		
            initialPreview: [
            ],
            initialPreviewConfig: [
                  ],
			uploadExtraData: function() {
            return {
                page: 'offerattachment',serial: ID
            };
           }
        });  //	

	}
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
 if(pot > 0)
	 
	{
		$("#title2").html("Edit POT/Tray");

		bringData1(pot);
		}
	else
	$("#title2").html("Add POT/Tray");
		
});
function bringData1(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getplantpot.php",
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
				document.getElementById("date").value=data[0]["dat"];
document.getElementById("type").value=data[0]["type"];
		document.getElementById("size").value=data[0]["size"];
		document.getElementById("qty").value=data[0]["qty"];
		document.getElementById("cost").value=data[0]["cost"];
		document.getElementById("country1").value=data[0]["country"];
	
		
			
			
			
			}
	}
	else
	
		showError(serial);
		}	
$("#myModal").on('shown.bs.modal', function () {
		$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage11.php',
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
		$("#title").html("Edit Plants");

		bringData(ID);
		getPlantPot(ID);
		}
	else
	$("#title").html("Add Plants");
		
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
	$(document).on('click',"[id='Ad1']",function(){

			if(ID==0)
					document.getElementById("lblalert2").style.visibility='visible';	
			else
			{
			pot=0;
			$('#myModal2').modal('show');		//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
			}

	});

	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			var answer = confirm("Are You Sure You Want To Delete This Plant");
    if (answer)
			deleteAttachment(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
	});



$(document).on('click',"[id^='Dup_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			Dup=1;
	});







	$(document).on('click',"[id^='Editt_']",function(){
		
	  		strID=$(this).attr('id');			
			pot = strID.substring(6);
			
	});
	//-----------------------------------------------------------------------------
	$("#add4").click(function(){

type= $("#type").val();
date= $("#date").val();
size= $("#size").val();
qty= $("#qty").val();
cost= 0+$("#cost").val();
country= $("#country1").val();
if( type=='')
document.getElementById("lblalert3").style.visibility='visible';
else{
if(pot==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addNote(type,ID,size,qty,cost,country,date);
		
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateNote(pot,type,ID,size,qty,cost,country,date);
			
			}	
	//	}

}

});	

function addNote(type,plantid,size,qty,cost,country,date)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tplantpot.php",
			  data: ({action:1,type:type,plantid:plantid,size:size,qty:qty,cost:cost,country:country,date:date}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				    document.getElementById("type").value='';
		document.getElementById("size").value='';
		document.getElementById("qty").value=0;
		document.getElementById("cost").value=0;
				getPlantPot(plantid);}			  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	//========================================================
	function UpdateNote(serial,type,plantid,size,qty,cost,country,date)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tplantpot.php",
			  data: ({action:3,serial :serial,type:type,plantid:plantid,size:size,qty:qty,cost:cost,country:country,date:date}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	
				getPlantPot(plantid);
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
		  	function getPlantPot(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getplantpot.php",
			  data: ({action:2,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  populatePlantPot(data);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				// alert(status + errorThrown);
				  
			  }
		  });  	
	} 
function populatePlantPot(data)
	{		
	$("#followup").empty();
		count=data.length;
		var item;

		if(count>0)
		{			
			
			diff_pot=0;
			lastqty_pot=0;

			diff_tray=0;
			lastqty_tray=0;
			country=0;
		   $.each(data, function(index, row) {

if(index==0)
	country=row.country;

				item = "<tr id='tr_"+row.serial+"'>";
                item+=   "<td>"+row.type+"</td>";
                item+=   "<td>"+row.country+"</td>";
				item+=   "<td>"+row.size+"</td>";
				item+=   "<td>"+row.dat+"</td>";
				item+=   "<td>"+row.qty+"</td>";
if(country!=row.country){
	diff_pot=0;
			lastqty_pot=0;

			diff_tray=0;
			lastqty_tray=0;
}
	


 if(row.type=='POT'){
if(lastqty_pot==0)
	diff_pot=0;
else
diff_pot=Number(row.qty)-Number(lastqty_pot);
item+=   "<td>"+diff_pot+"</td>";
}
else{
	if(lastqty_tray==0)
	diff_tray=0;
else
diff_tray=Number(row.qty)-Number(lastqty_tray);
item+=   "<td>"+diff_tray+"</td>";
}

				
				if(row.ViewQuantity==1){
				item+="<td><a  id='Editt_"+row.serial+"'  data-toggle='modal' data-target='#myModal2' ><p class='fa fa-edit'></p></a>&nbsp;";
  
				item+="<a  id='dell1_"+row.serial+"' ><p class='fa fa-trash-o'></p></a></td>";
				}
                item+= "</tr>";
				$("#followup").append(item);
			// 	alert((row.qty).substring(0,1));
			// 	if((row.qty).substring(0,1)=='-')
			// 	diff-=Number(row.qty);
			// else 	
			// 	diff+=Number(row.qty);
 if(row.type=='POT'){
			lastqty_pot=Number(row.qty);
		}
		else
lastqty_tray=Number(row.qty);

country=row.country;

			});
			
		}
	}	
	$(document).on('click',"[id^='dell1_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			pot = strID.substring(6);
			var answer = confirm("Are You Sure You Want To Delete This record");
    if (answer)
			deletePot(pot);
		
			
	});
	function deletePot(idval)
	{
		
		//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tplantpot.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
				  	
			getPlantPot(ID);
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
		
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	//=============================================================================================
	$("#uncheck").click(function(){
		$('input[name="Cedit"]').each(function() { 
			this.checked = false; 
		});
	});
//===============================================================================================
$("#savepalette").click(function(){
	serial=0;
	
$("input:checkbox[name=Cedit]:checked").each(function(){
	
	serial=serial+','+$(this).val();
});	
if(serial!='0'){


swal("Enter Palette name", {
  content: "input",
})
.then((value) => {
  

	if(value==null){swal("please enter Palette Name!");}
	else{ 

 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tsavepalette.php",
			  data: ({action:1,palettename:value,link:serial}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			 	window.open("./Transaction.php?x="+serial,"_blank");
				  //location.reload(); 
  				  				  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				  alert(status + errorThrown);
			  }
			  
		  }); 






	}
});






  




}
else{
	alert("Please Choose Plants !!");
}
});






$("#check").click(function(){
	serial=0;
	
$("input:checkbox[name=Cedit]").each(function(){
	
	document.getElementById("Cedit_"+$(this).val()).checked = true;
});	

});





$("#print").click(function(){
	serial=0;
	
$("input:checkbox[name=Cedit]:checked").each(function(){
	
	serial=serial+','+$(this).val();
});	
if(serial!='0')
window.open("./Transaction.php?x="+serial,"_blank");
else{
	alert("Please Choose Plants !!");
}
});
$("#add1").click(function(){

ref= $("#ref").val();
scientic= $("#scientic").val();
common= $("#common").val();
location1= $("#location1").val();
luminosity= $("#luminosity").val();
hardiness= $("#hardiness").val();
growthhabit= $("#growthhabit").val();
density= $("#density").val();
color= $("#color").val();
color1= $("#color1").val();
tolerance= $("#tolerance").val();
resistance= $("#resistance").val();
growthspeed= $("#growthspeed").val();
dtolerance= $("#dtolerance").val();
tolerance1= $("#tolerance1").val();
total= $("#total").val();
artificial= $("#artificial").val();
maintenance= $("#maintenance").val();
production= $("#production").val();
availability= $("#availability1").val();
remarks= $("#remarks").val();
country= $("#country").val();
if(country=='')
country="";
tray= $("#tray").val();
pot= $("#pot").val();
if(document.getElementById('used').checked==true)
	used = 1;
	else used=0;
if( scientic=='')
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment(country,used,ref,scientic,common,location1,luminosity,hardiness,growthhabit,density,color,color1,tolerance,resistance,growthspeed,dtolerance,tolerance1,total,artificial,maintenance,production,availability,remarks,tray,pot,0);
					
					
				}
		else{ 

			if(Dup==1){addAttachment(country,used,ref,scientic,common,location1,luminosity,hardiness,growthhabit,density,color,color1,tolerance,resistance,growthspeed,dtolerance,tolerance1,total,artificial,maintenance,production,availability,remarks,tray,pot,ID);
					}
				else
			//alert(ID+' '+used+' '+ref+' '+scientic+' '+common+' '+location1+' '+luminosity+' '+hardiness+' '+growthhabit+' '+density+' '+color+' '+color1+' '+tolerance+' '+resistance+' '+growthspeed+' '+dtolerance+' '+tolerance1+' '+total+' '+artificial+' '+maintenance+' '+production+' av'+availability+' rema'+remarks+' tra'+tray+' pot'+pot);
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,country,used,ref,scientic,common,location1,luminosity,hardiness,growthhabit,density,color,color1,tolerance,resistance,growthspeed,dtolerance,tolerance1,total,artificial,maintenance,production,availability,remarks,tray,pot);
			
			}	
	//	}
	
}

});
//===================================================================================

function UpdateAttachment(serial,country,used,ref,scientic,common,location1,luminosity,hardiness,growthhabit,density,color,color1,tolerance,resistance,growthspeed,dtolerance,tolerance1,total,artificial,maintenance,production,availability,remarks,tray,pot)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tplants.php",
			  data: ({action:3,serial :serial,country:country,used:used,ref:ref,scientic:scientic,common:common,location1:location1,luminosity:luminosity,hardiness:hardiness,growthhabit:growthhabit,density:density,color:color,color1:color1,tolerance:tolerance,resistance:resistance,growthspeed:growthspeed,dtolerance:dtolerance,tolerance1:tolerance1,total:total,artificial:artificial,maintenance:maintenance,production:production,availability:availability,remarks:remarks,tray:tray,pot:pot}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			if(data==-1){
			alert("plant allready exists!!");
		}
				
				 else if(data==0)
				  	alert("No Update!");
				  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				  location.reload();}
  				  				  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	

//=====================================================================================
function addAttachment(country,used,ref,scientic,common,location1,luminosity,hardiness,growthhabit,density,color,color1,tolerance,resistance,growthspeed,dtolerance,tolerance1,total,artificial,maintenance,production,availability,remarks,tray,pot,duplicate)
	{		
	//alert(ref+' '+scientic+' '+common+' '+location1 +' '+luminosity+' '+hardiness+' '+growthhabit+' '+density+' '+color+' '+color1+' '+tolerance+' '+resistance+' '+growthspeed+' '+dtolerance+' '+tolerance1+' '+total+' '+artificial+' '+maintenance+' '+production+' '+availability+' '+remarks+' '+tray+' '+pot);
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tplants.php",
			  data: ({action:1,duplicate:duplicate,country:country,used:used,ref:ref,scientic:scientic,common:common,location1:location1,luminosity:luminosity,hardiness:hardiness,growthhabit:growthhabit,density:density,color:color,color1:color1,tolerance:tolerance,resistance:resistance,growthspeed:growthspeed,dtolerance:dtolerance,tolerance1:tolerance1,total:total,artificial:artificial,maintenance:maintenance,production:production,availability:availability,remarks:remarks,tray:tray,pot:pot}),
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		if(data==-1){
			alert("plant allready exists!!");
		}
				else  if(data==0)
					  alert("Data is not inserted");  
				  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				  location.reload();}			  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	
	function bringData(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_plants.php",
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
			  url: "../../ws/ws_tplants.php",
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
				 
			document.getElementById("ref").value=data[0]["ref"];
			var values=data[0]["country"];
values=values.split(',');
$("#country").val(values).trigger("change");
		document.getElementById("scientic").value=data[0]["scientic"];
		document.getElementById("common").value=data[0]["common"];
		document.getElementById("location1").value=data[0]["location1"];
		document.getElementById("luminosity").value=data[0]["luminosity"];
		document.getElementById("hardiness").value=data[0]["hardiness"];
		document.getElementById("growthhabit").value=data[0]["growth"];
		document.getElementById("density").value=data[0]["density"];
		document.getElementById("color").value=data[0]["color"];
		document.getElementById("color1").value=data[0]["foliagecolor"];
		document.getElementById("tolerance").value=data[0]["spray"];
		document.getElementById("resistance").value=data[0]["windresistance"];
		document.getElementById("growthspeed").value=data[0]["growthspeed"];
		document.getElementById("dtolerance").value=data[0]["tolerance"];
		document.getElementById("tolerance1").value=data[0]["tolerance1"];
		document.getElementById("total").value=data[0]["totalin"];
		document.getElementById("artificial").value=data[0]["artificiallight"];
		document.getElementById("total").value=data[0]["totalin"];
		document.getElementById("maintenance").value=data[0]["maintenanceneeds"];
		document.getElementById("production").value=data[0]["production"];
		document.getElementById("availability1").value=data[0]["availability1"];
		document.getElementById("remarks").value=data[0]["remarks"];
		document.getElementById("tray").value=data[0]["tray"];
		document.getElementById("pot").value=data[0]["pot"];
		if(	data[0]["nouse"]==1)
			document.getElementById("used").checked = true;
			else
			document.getElementById("used").checked = false;
		
			 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_plantattachment.php",
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
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage11.php',
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

initialPreview.push('../../att/Plants/'+data[i]["description"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=plantattachment"   , key: data[i]["serial"],downloadUrl: "../../att/Plants/"+data[i]["description"] });
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=plantattachment"   , key: data[i]["serial"],downloadUrl: "../../att/Plants/"+data[i]["description"] });
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=plantattachment"   , key: data[i]["serial"],downloadUrl: "../../att/Plants/"+data[i]["description"] });
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=plantattachment"   , key: data[i]["serial"],downloadUrl: "../../att/Plants/"+data[i]["description"] });
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=plantattachment"   , key: data[i]["serial"],downloadUrl: "../../att/Plants/"+data[i]["description"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=plantattachment",
            key: 3,
            downloadUrl: "../../att/Plants/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=plantattachment",
            key: 3,
            downloadUrl: "../../att/Plants/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=plantattachment"   , key: data[i]["serial"],downloadUrl: "../../att/Plants/"+data[i]["description"] });
				break;
}}	
				  		if(data.length>0){
				$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
               'uploadUrl': '../../ws/ws_uploadimage11.php',
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
	

});

