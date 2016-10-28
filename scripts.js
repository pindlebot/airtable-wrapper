$(document).ready(function() {
  $(document).on('change', 'td > input', function(event) {
    var getVal = $(event.target).val();
    var getId = $(event.target).attr("id"); // e.g., c{row}-column
    var getClass = $(event.target).attr("class"); //e.g., asfjkdsafjsa
    var getId = getId.replace("c", "");
    var arr = getId.split("-");
    var getKey = 'col_' + arr[1]; 
    console.log(getKey);
    
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
    var firstId = $("tr#" + iId + " td:nth-of-type(1) input").attr("class");
    console.log(firstId);
    $("tr#" + iId).remove();
     $.post('post.php', {
      id: firstId,
      type: 'delete',
    }, function(data) {
      console.log(data);
     });
     
    });
    
     $(document).on('click', 'a#add', function() {
       var rows = $("table tr").length;
       console.log(rows);
       $("table").append('<tr id="r' + rows  + '"><td><input id="c' + rows + '-1"></td><td><input id="c' + rows + '-2"></td><td><input id="c' + rows + '-3"></td><td><a class="btn-floating btn waves-effect waves-light red"><i class="material-icons delete" id="i' + rows + '">delete</i></a></td></tr>'); 
       $.post('post.php', {
        type: 'create',
       }, function(data) {
       callbackFunc(data);
       });
       
       function callbackFunc(data) {
         var arr = JSON.parse(data);
         console.log(arr);
         var rows = $("table tr").length - 1;
         console.log(rows);
         $("tr#r" + rows + " input").attr("class", arr['id']);
        
       }
    });
  
});
