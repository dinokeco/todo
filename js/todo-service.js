var TodoService = {

  add: function(todo){

  },

  list_by_note_id: function(note_id){
    $("#notes-todos").html('loading ...');
    $.get("rest/notes/"+note_id+"/todos", function(data) {
      var html = "";
      for(let i = 0; i < data.length; i++){
        html += `<div class="list-group-item note-todo-`+data[i].id+`">
          <button class="btn btn-danger btn-sm float-end" onclick="TodoService.delete(`+data[i].id+`)">delete</button>
          <p class="list-group-item-text">`+data[i].description+`</p>
        </div>`;
      }
      $("#notes-todos").html(html);
    });
    $("#todoModal").modal('show');
  },

  delete: function(id){
    $('.note-todo-'+id).remove();
    $.ajax({
      url: 'rest/todos/'+id,
      type: 'DELETE',
      success: function(result) {
        alert("deleted")
      }
    });
  },

}
