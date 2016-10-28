$(document).ready(function() {
  $(document).on('change', 'td > input', function(event) {
    var getVal = $(event.target).val();
    var getClass = $(event.target).attr("class");
    var getId = $(event.target).attr("id");
    var arr = getClass.split('-');
    var name = 'col_' + arr[1];
    $.post('post.php', {
      update: getVal,
      id: getId,
    }, function(data) {
      console.log(data);
     });
  });
});
