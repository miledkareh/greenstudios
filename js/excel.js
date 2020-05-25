$(document).ready(function(){
  var table = $('#dataTables-example').DataTable();
  
  $('#copy').on('click', function(){
      $('<table>').append(table.$('tr').clone()).table2excel({
          exclude: ".excludeThisClass",
          name: "Worksheet Name",
          filename: "SomeFile" //do not include extension
      });
  });      
})