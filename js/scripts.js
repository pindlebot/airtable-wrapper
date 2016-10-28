$(document).ready(function() {
  $('textarea').trigger('autoresize');
  $(document).on('change', 'td > textarea', function(event) {
    var getVal = $(event.target).val();
    var getId = $(event.target).attr("id").replace("c", ""); 
    var getClass = $(event.target).attr("class").replace("materialize-textarea ", "");
    var arr = getId.split("-");
    var getKey = 'col_' + arr[1]; 

    $.post('post.php', {
      key: getKey,
      value: getVal,
      id: getClass,
      type: 'update',
    }, function(data) {
      console.log(data);
     });
  });
    $(document).on('click', '.delete', function(event) {
    var iId = $(event.target).attr("id");
    console.log(iId);
    iId = iId.replace("i", "r");
    var cId = $("tr#" + iId + " td:nth-of-type(1) textarea").attr("class");
    var airtableId = cId.replace("materialize-textarea ", "");

    $("tr#" + iId).remove();
     $.post('post.php', {
      id: airtableId,
      type: 'delete',
    }, function(data) {
      console.log(data);
     });
     
    });
    
     $(document).on('click', 'a#add', function() {
       var rows = $("table tr").length;
       console.log(rows);
       $("table").append('<tr id="r' + rows  + '"><td><textarea class="materialize-textarea" id="c' + rows + '-1"></textarea></td><td><textarea class="materialize-textarea" id="c' + rows + '-2"></textarea></td><td><textarea class="materialize-textarea" id="c' + rows + '-3"></textarea></td><td><textarea class="materialize-textarea" id="c' + rows + '-4"></textarea></td><td><a class="btn-floating btn waves-effect waves-light"><i class="fig-purple material-icons delete" id="i' + rows + '">delete</i></a></td></tr>'); 
    
       $('textarea').trigger('autoresize');
       $.post('post.php', {
        type: 'create',
       }, function(data) {
       callbackFunc(data);
       });
       
       function callbackFunc(data) {
         var arr = JSON.parse(data);
         var rows = $("table tr").length - 1;
         $("tr#r" + rows + " textarea").addClass(arr.id);
        
       }
    });
  
});
