$(document).ready(function() {
	var Longitude=0;
	var Latitude=0;
	requirement=0;
	including=0;
	ID=0;
	$('body').on('hidden.bs.modal', function () {
		if($('.modal.in').length > 0)
		{
			$('body').addClass('modal-open');
		}
	});
	//fillSections();
	//getUsers();
	$(document).on('click',"[id^='Adrequirement']",function(){
	
				if (ID==0)
				document.getElementById("lblalert4").style.visibility='visible';
				else{
				requirement=0;
				$('#myModal2').modal('show');}		//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
	
		});
		$(document).on('click',"[id^='Adincluding']",function(){
	
				if (ID==0)
				document.getElementById("lblalert1").style.visibility='visible';
				else{
				including=0;
				$('#myModal3').modal('show');
				}		//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
	
		});
	$("#myModal2").on('shown.bs.modal', function () {
	
	 if(requirement > 0)
		 
		{
			$("#title2").html("Edit Requirement");
	
			bringData1(requirement);
			}
		else
		{$("#title2").html("Add Requirement");
		
		}
	});
	$("#myModal3").on('shown.bs.modal', function () {
	
	 if(including > 0)
		 
		{
			$("#title3").html("Edit Including");
	
			bringData2(including);
			}
		else
		{$("#title3").html("Add Including");
		
		}
	});
	
	$("#myModal").on('shown.bs.modal', function () {
	document.getElementById("lblalert").style.visibility='hidden';
	document.getElementById("lblalert1").style.visibility='hidden';
	document.getElementById("lblalert4").style.visibility='hidden';
	$("#tblrequirement").html('');
	$("#tblincluding").html('');
	$("#lblalert5").show().delay(-1).fadeOut();
	 if(ID > 0)
		 
		{
			$("#title").html("Edit Report");
	
			bringData(ID);
			getrequirement(ID);
			getincluding(ID);
			}
		else
		{$("#title").html("Add Report");
		
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
	$("#myModal2").on('hidden.bs.modal', function (e) {
	document.getElementById("lblalert2").style.visibility='hidden';
	  $(this)
		.find("input,textarea,select")
		   .val('')
		   .end()
		.find("input[type=checkbox], input[type=radio]")
		   .prop("checked", "")
		   .end();
		   
	});
	$("#myModal3").on('hidden.bs.modal', function (e) {
	document.getElementById("lblalert3").style.visibility='hidden';
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
				var answer = confirm("Are You Sure You Want To Delete This Company Information");
		if (answer)
				deleteAttachment(ID);
			
				
		});
		
		//Update users
		$(document).on('click',"[id^='Edit_']",function(){
				  strID=$(this).attr('id');			
				ID = strID.substring(5);
		});
		//=============================================================================
		$(document).on('click',"[id^='Edit2_']",function(){
				  strID=$(this).attr('id');			
				requirement = strID.substring(6);
				
		});
		//================================================================================
		$(document).on('click',"[id^='Edit3_']",function(){
				  strID=$(this).attr('id');			
				including = strID.substring(6);
				
		});
		//================================================================================
		$(document).on('click',"[id^='del2_']",function(){	
				//$(this).parent().parent().remove();
				  strID=$(this).attr('id');			
				requirement = strID.substring(5);
				var answer = confirm("Are You Sure You Want To Delete This Requirement");
		if (answer)
				deleteAttachment1(requirement);
			
				
		});
		//============================================================================
		$(document).on('click',"[id^='del3_']",function(){	
				//$(this).parent().parent().remove();
				  strID=$(this).attr('id');			
				including = strID.substring(5);
				var answer = confirm("Are You Sure You Want To Delete This including");
		if (answer)
				deleteAttachment2(including);
			
				
		});
		//-----------------------------------------------------------------------------
		
	$("#add1").click(function(){
	
	
	company= $("#company").val();
	city= $("#city").val();
	building= $("#building").val();
	street= $("#street").val();
	floor= $("#floor").val();
	vat= $("#vat").val();
	bank= $("#bank").val();
	bankname= $("#bankname").val();
	bankaddress= $("#bankaddress").val();
	address=$("#address").val();
	accountNum=$("#accountNum").val();
	account=$("#account").val();
	ibanusd=$("#ibanusd").val();
	ibanlbp=$("#ibanlbp").val();
	ibaneuro=$("#ibaneuro").val();
	commercial=$("#commercial").val();
	swift=$("#swift").val();
	phone=$("#phone").val();
	website=$("#website").val();
	body1=$("#body1").val();
	body2=$("#body2").val();
	offerV= $("#offerV").val();
	warranty= $("#warranty").val();
	if(company=='')
	document.getElementById("lblalert").style.visibility='visible';
	else
	if(ID==0)	
					{
							
						//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
						addAttachment(company,city,building,street,floor,vat,bank,bankaddress,bankname,accountNum,address,body1,body2,account,ibanusd,ibanlbp,ibaneuro,swift,phone,website,commercial,offerV,warranty);
						
						
					}
			else{ 
			//	alert(company+city+building+requirement+including+street+floor+vat+bank+accountNum+address+body1+body2+account+iban+swift+phone+website+commercial);
			//	window.open("../pages/upload.php?x="+ attachment,"_blank","widh=0,height=0")
			UpdateAttachment(ID,company,city,building,street,floor,vat,bank,bankaddress,bankname,accountNum,address,body1,body2,account,ibanusd,ibanlbp,ibaneuro,swift,phone,website,commercial,offerV,warranty);
				
				}	
		//	}
		
	
	
	});
	//===================================================================================
	$("#add2").click(function(){
	
	
	requirementdesc= $("#requirementdesc").val();
	
	
	if(document.getElementById('rg_checkbox').checked==true)
		rg_checkbox=1;
	else rg_checkbox=0;
	 
	if(document.getElementById('gw_checkbox').checked==true)
		gw_checkbox=1;
	else gw_checkbox=0;
	
	if(requirement==0)	
					{
							
						//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
						addAttachment1(requirementdesc,ID,rg_checkbox,gw_checkbox);
						
						
					}
			else{ 
			//	alert(company+city+building+requirement+including+street+floor+vat+bank+accountNum+address+body1+body2+account+iban+swift+phone+website+commercial);
			//	window.open("../pages/upload.php?x="+ attachment,"_blank","widh=0,height=0")
			UpdateAttachment1(requirement,requirementdesc,ID,rg_checkbox,gw_checkbox);
				
				}	
		//	}
		
	
	
	});
	//===================================================================================
	$("#add3").click(function(){
	
	
	includingdesc= $("#includingdesc").val();
	
	if(document.getElementById('rg_checkbox1').checked==true)
		rg_checkbox=1;
	else rg_checkbox=0;
	 
	if(document.getElementById('gw_checkbox1').checked==true)
		gw_checkbox=1;
	else gw_checkbox=0;
	
	if(including==0)	
					{
							
						//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
						addAttachment2(includingdesc,ID,gw_checkbox,rg_checkbox);
						
						
					}
			else{ 
			//	alert(company+city+building+requirement+including+street+floor+vat+bank+accountNum+address+body1+body2+account+iban+swift+phone+website+commercial);
			//	window.open("../pages/upload.php?x="+ attachment,"_blank","widh=0,height=0")
			UpdateAttachment2(including,includingdesc,ID,gw_checkbox,rg_checkbox);
				
				}	
		//	}
		
	
	
	});
	//=======================================================================================
	function addAttachment2(includingdesc,companyid,gw_checkbox,rg_checkbox)
		{		
		
	//	alert(attachment+" "+paperid+" "+notes);
			  $.ajax({
				
				  type: 'GET',
				  url: "../../ws/ws_tincluding.php",
				  data: ({action:1,includingdesc:includingdesc,companyid:companyid,gw_checkbox:gw_checkbox,rg_checkbox:rg_checkbox}),
				  
				  dataType: 'json',
				  timeout: 5000,
				  success: function(data, textStatus, xhr) 
				  {
		//	alert("1");
					  if(data==0)
						  alert("Data is not inserted");  
						   else	  {
							data = JSON.parse(xhr.responseText);	
					  document.getElementById("includingdesc").value='';
					  getincluding(ID);}		  
					
				  },
				  error: function(xhr, status, errorThrown) 
				  {
				//	alert("2");
					//  alert(status + errorThrown);
				  }
			  });  //	
	
		}
	//=========================================================================================
	function addAttachment1(requirementdesc,genparid,rg_checkbox,gw_checkbox)
		{		
		
	//	alert(attachment+" "+paperid+" "+notes);
			  $.ajax({
				
				  type: 'GET',
				  url: "../../ws/ws_trequirement.php",
				  data: ({action:1,requirementdesc:requirementdesc,genparid:genparid,rg_checkbox:rg_checkbox,gw_checkbox:gw_checkbox}),
				  
				  dataType: 'json',
				  timeout: 5000,
				  success: function(data, textStatus, xhr) 
				  {
		//	alert("1");
					  if(data==0)
						  alert("Data is not inserted");  
						   else	  {
							data = JSON.parse(xhr.responseText);	
					  document.getElementById("requirementdesc").value='';
					  getrequirement(ID);}		  
					
				  },
				  error: function(xhr, status, errorThrown) 
				  {
				//	alert("2");
					//  alert(status + errorThrown);
				  }
			  });  //	
	
		}
	
	//=========================================================================================
	function UpdateAttachment1(serial,requirementdesc,genparid,rg_checkbox,gw_checkbox)
		{
			 
			  $.ajax({
				  type: 'GET',
				  url: "../../ws/ws_trequirement.php",
				  data: ({action:3,serial :serial,requirementdesc:requirementdesc,genparid:genparid,rg_checkbox:rg_checkbox,gw_checkbox:gw_checkbox}),
				  
				  dataType: 'json',
				  timeout: 5000,
				  success: function(data, textStatus, xhr) 
				  {
				
					
					  if(data==0)
						  alert("No Update!");
						   else	  {
							data = JSON.parse(xhr.responseText);	
					 getrequirement(ID);
					$('#myModal2').modal('hide');}			  				 			  
	
				  },
				  error: function(xhr, status, errorThrown) 
				  {
				  //	alert("2");
					 // $("#LoadingImage").hide();
					//  alert(status + errorThrown);
				  }
				  
			  }); 
			  
			  }
			  //================================================================================
			  function UpdateAttachment2(serial,includingdesc,companyid,gw_checkbox,rg_checkbox)
		{
			
			  $.ajax({
				  type: 'GET',
				  url: "../../ws/ws_tincluding.php",
				  data: ({action:3,serial :serial,includingdesc:includingdesc,companyid:companyid,gw_checkbox:gw_checkbox,rg_checkbox:rg_checkbox}),
				  
				  dataType: 'json',
				  timeout: 5000,
				  success: function(data, textStatus, xhr) 
				  {
				
					
					  if(data==0)
						  alert("No Update!");
						   else	  {
							data = JSON.parse(xhr.responseText);	
					 getincluding(ID);
					$('#myModal3').modal('hide');}			  				 			  
	
				  },
				  error: function(xhr, status, errorThrown) 
				  {
				  //	alert("2");
					 // $("#LoadingImage").hide();
					//  alert(status + errorThrown);
				  }
				  
			  }); 
			  
			  }
	//=======================================================================================
	function UpdateAttachment(serial,company,city,building,street,floor,vat,bank,bankaddress,bankname,accountNum,address,body1,body2,account,ibanusd,ibanlbp,ibaneuro,swift,phone,website,commercial,offerV,warranty)
		{
			
			  $.ajax({
				  type: 'GET',
				  url: "../../ws/ws_tgenpar.php",
				  data: ({action:3,serial :serial,company:company,city:city,building:building,street:street,floor:floor,vat:vat,bank:bank,bankname:bankname,bankaddress:bankaddress,accountNum:accountNum,address:address,body1:body1,body2:body2,account:account,ibanusd:ibanusd,ibanlbp:ibanlbp,ibaneuro:ibaneuro,swift:swift,phone:phone,website:website,commercial:commercial,offerV:offerV,warranty:warranty}),
				  
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
	function addAttachment(company,city,building,street,floor,vat,bank,bankaddress,bankname,accountNum,address,body1,body2,account,ibanusd,ibanlbp,ibaneuro,swift,phone,website,commercial,offerV,warranty)
		{		
		
	//	alert(attachment+" "+paperid+" "+notes);
			  $.ajax({
				
				  type: 'GET',
				  url: "../../ws/ws_tgenpar.php",
				  data: ({action:1,company:company,city:city,building:building,street:street,floor:floor,vat:vat,bank:bank,bankname:bankname,bankaddress:bankaddress,accountNum:accountNum,address:address,body1:body1,body2:body2,account:account,ibanusd:ibanusd,ibanlbp:ibanlbp,ibaneuro:ibaneuro,swift:swift,phone:phone,website:website,commercial:commercial,offerV:offerV,warranty:warranty}),
				  
				  dataType: 'json',
				  timeout: 5000,
				  success: function(data, textStatus, xhr) 
				  {
		$("#lblalert5").show().delay(1000).fadeOut();
					  if(data==0)
						  alert("Data is not inserted");  
						   else	  {
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
		function getrequirement(serial)
		{
		
		//$("#LoadingImage").show();
			  $.ajax({
				  type: 'GET',
				  url: "../../ws/ws_requirement.php",
				  data: ({action:2,id:serial}),			  
				  dataType: 'json',
				  timeout: 5000,
				  success: function(data, textStatus, xhr) 
				 
				  {
				  
					// $("#LoadingImage").hide();
					  data = JSON.parse(xhr.responseText);	
					  populate(data);				  
				  },
				  
				  error: function(xhr, status, errorThrown) 
				  {
				  
					  //  $("#LoadingImage").hide();
					 alert(status + errorThrown);
					  
				  }
			  });  	
		}
		function getincluding(serial)
		{
		
		//$("#LoadingImage").show();
			  $.ajax({
				  type: 'GET',
				  url: "../../ws/ws_including.php",
				  data: ({action:0,id:serial}),			  
				  dataType: 'json',
				  timeout: 5000,
				  success: function(data, textStatus, xhr) 
				 
				  {
				  
					// $("#LoadingImage").hide();
					  data = JSON.parse(xhr.responseText);	
					  populate1(data);				  
				  },
				  
				  error: function(xhr, status, errorThrown) 
				  {
				  
					  //  $("#LoadingImage").hide();
					 alert(status + errorThrown);
					  
				  }
			  });  	
		}
		function bringData(serial)
		{
		
		//$("#LoadingImage").show();
			  $.ajax({
				  type: 'GET',
				  url: "../../ws/ws_genpar.php",
				  data: ({action:1,id:serial}),			  
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
		///////////////////////////////////////////////////////////////////////////
			function bringData2(serial)
		{
		
		//$("#LoadingImage").show();
			  $.ajax({
				  type: 'GET',
				  url: "../../ws/ws_including.php",
				  data: ({action:1,serial:serial}),			  
				  dataType: 'json',
				  timeout: 5000,
				  success: function(data, textStatus, xhr) 
				 
				  {
				  
					// $("#LoadingImage").hide();
					  data = JSON.parse(xhr.responseText);	
					  decide2(data,serial);				  
				  },
				  
				  error: function(xhr, status, errorThrown) 
				  {
				  
					  //  $("#LoadingImage").hide();
					 alert(status + errorThrown);
					  
				  }
			  });  	
		}
		//==========================================================================
		
		function bringData1(serial)
		{
		
		//$("#LoadingImage").show();
			  $.ajax({
				  type: 'GET',
				  url: "../../ws/ws_requirement.php",
				  data: ({action:1,serial:serial}),			  
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
				  url: "../../ws/ws_tgenpar.php",
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
		//=================================================================================
			function deleteAttachment1(idval)
		{
			
			//$("#LoadingImage").show();
			 
			  $.ajax({
				  type: 'GET',
				  url: "../../ws/ws_trequirement.php",
				  data: ({action:2,id :idval}),
				  
				  dataType: 'json',
				  timeout: 5000,
				  success: function(data, textStatus, xhr) 
				  {
					 // $("#LoadingImage").hide();
					
					  if(data==0)
						  alert("Row not deleted!");
				getrequirement('');
				  },
				  error: function(xhr, status, errorThrown) 
				  {
					 getrequirement('');
				
					//  alert(status + errorThrown);
				  }
			  });  //	
	
		}
		//=================================================================================
		function deleteAttachment2(idval)
		{
			
			//$("#LoadingImage").show();
			 
			  $.ajax({
				  type: 'GET',
				  url: "../../ws/ws_tincluding.php",
				  data: ({action:2,id :idval}),
				  
				  dataType: 'json',
				  timeout: 5000,
				  success: function(data, textStatus, xhr) 
				  {
					 // $("#LoadingImage").hide();
					
					  if(data==0)
						  alert("Row not deleted!");
				getincluding();
				  },
				  error: function(xhr, status, errorThrown) 
				  {
					 getincluding();
				
					//  alert(status + errorThrown);
				  }
			  });  //	
	
		}
	////////////////////////////////////////////////////////////////////////////////////
	function populate1(data)
		{		
			$("#tblincluding").html('');
			count=data.length;
			var item;
	
			if(count>0)
			{			
			
			   $.each(data, function(index, row) {
					item = "<tr id='tr_"+row.serial+"'>";
					item+=   "<td>"+row.description+"</td>";
					if(row.rg==1)
					  item+=   "<td>Yes</td>";
				  else
						  item+=   "<td>No</td>";
					  if(row.gw==1)
					  item+=   "<td>Yes</td>";
				  else
						  item+=   "<td>No</td>";
					//item+=   "<td>"+row.admin+"</td>";
					item+=   "<td><a  id='Edit3_"+row.serial+"'  data-toggle='modal' data-target='#myModal3' ><p class='fa fa-edit'></p> Edit</a></td>";
				   item+="<td><a  id='del3_"+row.serial+"' ><p class='fa fa-trash-o'></p> Delete</a></td>";
					item+= "</tr>";
					$("#tblincluding").append(item);
				});
				
			}
		}
	//===================================================================================
	function populate(data)
		{		
			$("#tblrequirement").html('');
			count=data.length;
			var item;
	
			if(count>0)
			{			
				
			   $.each(data, function(index, row) {
					item = "<tr id='tr_"+row.serial+"'>";
					item+=   "<td>"+row.description+"</td>";
	if(row.rg_checkbox==1)
					  item+=   "<td>Yes</td>";
				  else
						  item+=   "<td>No</td>";
					  if(row.gw_checkbox==1)
					  item+=   "<td>Yes</td>";
				  else
						  item+=   "<td>No</td>";
					  
					//item+=   "<td>"+row.admin+"</td>";
					item+=   "<td><a  id='Edit2_"+row.serial+"'  data-toggle='modal' data-target='#myModal2' ><p class='fa fa-edit'></p> Edit</a></td>";
				   item+="<td><a  id='del2_"+row.serial+"' ><p class='fa fa-trash-o'></p> Delete</a></td>";
					item+= "</tr>";
					$("#tblrequirement").append(item);
				});
				
			}
		}
		//======================================================================
		function decide2(data,serial)
		{		
	
			count=data.length;
		if(count>0)
		{
			if( serial==0)
				alert("user exist");	
			else 
				{		
			
			document.getElementById("includingdesc").value=data[0]["description"];
			if(data[0]["rg"]==1)document.getElementById("rg_checkbox1").checked=true;
		if(data[0]["gw"]==1)	document.getElementById("gw_checkbox1").checked=true;
	
		
				}
		}
		else
		
			showError(serial);
			}
	////////////////////////////////////////////////////////////////////////////////////////
		function decide1(data,serial)
		{		
	
			count=data.length;
		if(count>0)
		{
			if( serial==0)
				alert("user exist");	
			else 
				{		
			
			document.getElementById("requirementdesc").value=data[0]["description"];
				if(data[0]["rg_checkbox"]==1)document.getElementById("rg_checkbox").checked=true;
		if(data[0]["gw_checkbox"]==1)	document.getElementById("gw_checkbox").checked=true;
				}
		}
		else
		
			showError(serial);
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
			
			document.getElementById("company").value=data[0]["company"];
				document.getElementById("address").value=data[0]["address"];
				document.getElementById("city").value=data[0]["city"];
				document.getElementById("street").value=data[0]["street"];
				document.getElementById("building").value=data[0]["building"];
				document.getElementById("floor").value=data[0]["floor"];
				document.getElementById("phone").value=data[0]["phone"];
				document.getElementById("website").value=data[0]["website"];
				document.getElementById("accountNum").value=data[0]["accountnumber"];
				document.getElementById("body1").value=data[0]["body1"];
				document.getElementById("body2").value=data[0]["body2"];
				document.getElementById("account").value=data[0]["accountname"];
				document.getElementById("vat").value=data[0]["vat"];
				document.getElementById("commercial").value=data[0]["commercialNum"];
				document.getElementById("bank").value=data[0]["bank"];
				document.getElementById("bankname").value=data[0]["bankname"];
				document.getElementById("bankaddress").value=data[0]["bankaddress"];
				document.getElementById("ibanusd").value=data[0]["ibanusd"];
				document.getElementById("ibanlbp").value=data[0]["ibanlbp"];
				document.getElementById("ibaneuro").value=data[0]["ibaneuro"];
				document.getElementById("swift").value=data[0]["swift"];
				document.getElementById("warranty").value=data[0]["warranty"];
				document.getElementById("offerV").value=data[0]["offerV"];
				}
		}
		else
		
			showError(serial);
			}
		
	
	});
	
	