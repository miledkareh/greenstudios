$(document).ready(function(){
$(document).ready(function(){
    $("#btnExport").trigger("click");
});

	window.close();

 $("#btnExport").click(function(e) {
    e.preventDefault();

    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div =document.getElementById('dataTables-example');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
	var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd='0'+dd
} 

if(mm<10) {
    mm='0'+mm
} 

today = dd+'-'+mm+'-'+yyyy;
    a.download = 'offers' + today + '.xls';
    a.click();
	window.close();
  });
});

