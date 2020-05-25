
$(document).ready(function() {

filltable();
ID=0;
row=[];
 index=0;
 thiss=0;

$('#dataTables-example tbody').on( 'click', 'tr', function (event) {
	
	thiss=this;

   row= $('#dataTables-example').DataTable().row( this ).data() ;
  
    index= $(event.target.parentNode).index() +1;
 
} );
 function filltable(){

if ( $.fn.DataTable.isDataTable('#dataTables-example') ) {	
  $('#dataTables-example').DataTable().destroy();
}

$('#dataTables-example tbody').empty();


$('#dataTables-example').DataTable({
						"processing": true,
					"serverSide": true,
					"ajax":{
						url :"ws/data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							
							
						}
					},
       dom: 'Bfrtip',
        // Configure the drop down options.
        lengthMenu: [
            [ 10,25, 50, 100, -1 ],
            [ '10 rows','25 rows', '50 rows', '100 rows', 'Show all' ]
        ],
        // Add to buttons the pageLength option.
        buttons: [
            'pageLength','pdfHtml5', 'csvHtml5', 'copyHtml5', 'excelHtml5','print'
        ],
    responsive: true,
			"aaSorting": [],
			"stateSave": true,
               });  
	}
 fillProfile();
var serial=0;
$("#myModal5").on('hidden.bs.modal', function (e) {
document.getElementById("reason1").style.visibility='hidden';
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});
$("#myModal").on('hidden.bs.modal', function (e) {
document.getElementById("lblalert").style.visibility='hidden';
$("#lblalert0").show().delay(-1).fadeOut();
 
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});

// ADD User
$("#Add").click(function(){
	$("#title").html("Add User");
	ID=0;
});
	$(document).on('click',"[id^='delete']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = row['Serial'];
		
		swal({
   position: 'top',
  title: "Are You Sure You Want To Delete This User !",
  text: "Once deleted, you will not be able to recover this information!",
  type: 'warning',
  showCancelButton: true,
  cancelButtonColor: '#d33',
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   deleteUser(ID);
  } else {
  
  }
});
			

			
	});
	
	//Update users
	$(document).on('click',"[id^='edit']",function(){
	
	ID=row['Serial'];
	
	$("#title").html("Edit User");
	document.getElementById("name").value = row["Fullname"];
			document.getElementById("username1").value = row["Username"];
			document.getElementById("password").value = row["password"];
			document.getElementById("profile").value = row["userprofile"];
			$("#profile").val(row["userprofile"]).trigger("change");
			if(	row["isadmin"]==1)
			document.getElementById("admin").checked = true;
			else
			document.getElementById("admin").checked = false;
$('#myModal').modal('show');

	});

$("#add1").click(function(){

name = $("#name").val();
	username = $("#username1").val();
	psw = $("#password").val();
	profile = $("#profile").val();
	if(document.getElementById('admin').checked==true)
	admin = 1;
	else admin=0;
	if( username =='' || psw =='')
	{
	document.getElementById("lblalert").style.visibility='visible';
	
}
	else if(ID==0)	
				{	
			
				addUser(name,username,psw,admin,profile);
					
				}
		else{ 
		UpdateUsers(ID,name,username,psw,admin,profile);
			}	
	//	}
	
	

});

	
//-----------------------------------------------------------------------------------
function UpdateUsers(serial,name,username,psw,admin,profile)
	{
		
		  $.ajax({
			  type: 'POST',
			  url: "ws/ws_tusers.php",
			  data: ({action:3,serial :serial,name:name,username:username,psw:psw,admin:admin,profile:profile}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
  				  	data = JSON.parse(xhr.responseText);	
			row["Username"]=username;
			row["password"]=psw;
			row["userprofile"]=profile;
			row["isadmin"]=admin;
			row['Fullname']=name;
	$('#dataTables-example').DataTable().row( thiss ).data(row) ;
	$('#myModal').modal('hide');
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  }
			  
		  }); 
		  
		  } 

//=====================================================================================
function addUser(name,username,psw,admin,profile)
	{		
	
		
		  $.ajax({
			
			  type: 'POST',
			  url: "ws/ws_tusers.php",
			  data: ({action:1,name:name,username:username,psw:psw,admin:admin,profile:profile}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
  				  	data = JSON.parse(xhr.responseText);

					  $('#dataTables-example').DataTable().ajax.reload();	  
				$('#myModal').modal('hide');	
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			
			  }
		  }); 

	}
	

	
	//delete person from server
	function deleteUser(idval)
	{

		  $.ajax({
			  type: 'POST',
			  url: "ws/ws_tusers.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				
				 $('#dataTables-example').DataTable().row(thiss).remove().draw();
			  },
			  error: function(xhr, status, errorThrown) 
			  {

			  }
		  });  //	

	}
////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////	

		


function fillProfile()
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "ws/ws_userconf.php",
			  data: ({action:1}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
		 			  
		
				  if(data==null){
					
					  $("#profile").html("");
					 }
				  else{
				  	data = JSON.parse(xhr.responseText);				  				 
				  	count=data.length;
				  	
		var items;
	  $("#profile").html("");
		if(count>0)
		{
			items="";
			  $.each(data,function(index,item) 
    {
      $("#profile").append("<option value='"+item.Serial+"'>"+item.Description+"</option>");
    });
    $("#profile").val(1);

		}
				  }
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  	 
			  
			  }
		  });  //	
		
	}
	

});

