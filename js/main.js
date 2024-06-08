$('#datetimepicker').datetimepicker({
  format: 'Y-M-D HH:mm:ss'
});
$('#datetimepicker1').datetimepicker({
  format: 'Y-M-D HH:mm:ss'
});
function checkPasswordMatch() {
  var password = $('#inputPassword').val();
  var repassword = $('#inputRetypePassword').val();
  if(password != repassword){
    $('.invalid-password').show();
    $('.valid-password').hide();
  }else{
    $('.invalid-password').hide();
    $('.valid-password').show();
  }

}
$(document).ready(function(){
  $('#inputPassword, #inputRetypePassword').keyup(checkPasswordMatch);

  $('ul.nav-menu li').click(function(){ // handle menu clicked ui
    var id = $(this).attr('id');

    // change value id taks session
    $.post("changeIdTaskSession.php",
      {
        id:id
      }
    );

    // set id to add list button
    $('#id-task-list').val(id);

    // change menu active without refreshing
    // var elements = document.getElementsByTagName('li');
    // for(var i=0; i<elements.length; i++){
    //   if(elements[i].id==id){
    //     elements[i].className = 'active';
    //   }else{
    //     elements[i].className = '';
    //   }
    // }

    // refresh to change list item
    location.href="main.php";
  });
  // listener task menu select to change ui end

  $('.remove-to-do').click(function(){
    const id = $(this).attr('id');
    $.post("remove.php",
      {
        id:id
      }, (data) => {
        $(this).parent().hide(600);
        // check total list item
        const total = document.querySelectorAll('.todo-item').length - 1;
        console.log(total);
        // if total == 0 do add illustration for there is no list information
      }
    );
  });
  // remove list listener end

  $('.check-box').click(function(e){
    const id = $(this).attr('data-todo-id');

    $.post("doChecked.php",
      {
        id:id
      }, (data) => {
        if(data != "error"){
          const h2 = $(this).next();
          if(data === '1'){
            h2.removeClass('checked');
          }else{
            h2.addClass('checked');
          }
        }
      }
    );
  });
  // update list listener end

  $('.remove-task').click(function(){
    const id = $(this).attr('id');
    // alert(id);
    $.post("removeTask.php",
      {
        id: id
      }, (data) => {
        if(data){
          $(this).parent().hide(600);
          location.href="main.php";
        }else{
          alert('Deleting task failed!');
        }

      }
    );

  });
  // remove task listener end

  $('.edit-task').click(function(){
    var id = $(this).attr('id');
    var title = prompt("Task Name:","");
    if(title == ""){
      alert('Nama task harus diisi');
    }else{
      // alert(title);
      $.post("updateTask.php",
        {
          id:id,
          title: title
        }, (data) => {
          if(data){
            // alert('Task update completed!');
          }else{
            alert('Deleting task failed!');
          }
        }
      );
    }

  });

  $('.edit-to-do').click(function(){
    $div = $(this).closest('div');

    var text = $div.children('h2').text();
    var deadline = $div.children('input#result-deadline').val();
    var id = $(this).attr('id');
    console.log(text);
    console.log(deadline);
    console.log(id);

    // set Data
    $('#edit-list-title').val(text);
    $('#edit-list-deadline').val(deadline);
    $('#edit-list-id').val(id);

    $('#editListModal').modal('show');
  });

  $('.menu-profile').click(function(){
    $('#editProfileModal').modal('show');
  });

  $('.menu-change-password').click(function(){
    // alert("clicked");
    $('.invalid-password').hide();
    $('.valid-password').hide();
    $('#changePasswordModal').modal('show');
  });
});
