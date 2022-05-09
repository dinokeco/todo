var TodoService = {

  add: function(todo){
    $.ajax({
      url: 'rest/todos',
      type: 'POST',
      data: JSON.stringify(todo),
      contentType: "application/json",
      dataType: "json",
      success: function(result) {
        // append to the list
        $("#notes-todos").append(`<div class="list-group-item note-todo-`+result.id+`">
          <button class="btn btn-danger btn-sm float-end" onclick="TodoService.delete(`+result.id+`)">delete</button>
          <p class="list-group-item-text">`+result.description+`</p>
        </div>`);
        toastr.success("Added !");
      }
    });
  },

  list_by_note_id: function(note_id){
    $("#notes-todos").html('loading ...');

    $.ajax({
       url: "rest/notes/"+note_id+"/todos",
       type: "GET",
       beforeSend: function(xhr){
         xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
       },
       success: function(data) {
         var html = "";
         for(let i = 0; i < data.length; i++){
           html += `<div class="list-group-item note-todo-`+data[i].id+`">
             <button class="btn btn-danger btn-sm float-end" onclick="TodoService.delete(`+data[i].id+`)">delete</button>
             <p class="list-group-item-text">`+data[i].description+`</p>
           </div>`;
         }
         $("#notes-todos").html(html);
       },
       error: function(XMLHttpRequest, textStatus, errorThrown) {
         toastr.error(XMLHttpRequest.responseJSON.message);
         UserService.logout();
       }
    });
    // note id populate and form validation
    $('#add-todo-form input[name="note_id"]').val(note_id);
    $('#add-todo-form input[name="created"]').val(TodoService.current_date());

    $('#add-todo-form').validate({
      submitHandler: function(form) {
        var entity = Object.fromEntries((new FormData(form)).entries());
        TodoService.add(entity);
        $('#add-todo-form input[name="description"]').val("");
        toastr.info("Adding ...");
      }
    });
    $("#todoModal").modal('show');
  },

  delete: function(id){
    var old_html = $("#notes-todos").html();
    $('.note-todo-'+id).remove();
    toastr.info("Deleting in background ...");
    $.ajax({
      url: 'rest/todos/'+id,
      type: 'DELETE',
      beforeSend: function(xhr){
        xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
      },
      success: function(result) {
        toastr.success("Deleted !");
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest.responseJSON.message);
        $("#notes-todos").html(old_html);
        //alert("Status: " + textStatus); alert("Error: " + errorThrown);
      }
    });
  },

  current_date: function(){
    const today = new Date();
    const yyyy = today.getFullYear();
    let mm = today.getMonth() + 1; // Months start at 0!
    let dd = today.getDate();

    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;

    return yyyy+"-"+mm+"-"+dd;
  }

}
