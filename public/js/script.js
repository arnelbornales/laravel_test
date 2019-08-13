
/**FOR FILE UPLOAD*/

$(function () {
  $('#file').fileupload({
      dataType: 'json',
      add: function (e, data) {
      $('#loading').text('Uploading...');
      data.submit();
      },
      done: function (e, data) {
      $.each(data.result.files, function (index, file) {
             $('<p/>').html(file.name + ' (' + file.size + ' KB)').appendTo($('#files_list'));
             if ($('#file_ids').val() != '') {
             $('#file_ids').val($('#file_ids').val() + ',');
             }
             $('#file_ids').val($('#file_ids').val() + file.fileID);
             });
      $('#loading').text('');
      }
  });
});

/** FOR USER TASKS */
(function() {
    var table = document.getElementById('table-users');
    var clicked_rows = [];
    if(typeof(table) != 'undefined' && table != null){
        table.addEventListener('dblclick', function(event) {
             event.preventDefault();
             var _targetElement= event.target;
             while(_targetElement !== table){
                if(_targetElement.nodeName === "TR" && _targetElement.parentNode && _targetElement.parentNode.nodeName === "TBODY"){
                   var id = _targetElement.id.split("user-")[1];
                   if (id == 'undefined' || id == null) {
                       break;
                   }
                   if (clicked_rows.includes(_targetElement.rowIndex)) {
                       break;
                   }
                   clicked_rows.push(_targetElement.rowIndex);
                   var new_row_class = "user-tasks";
                   var row_index = _targetElement.rowIndex+1;
                   var xhttp = new XMLHttpRequest();
                   xhttp.open("GET", "user/"+id+"/tasks", true);
                   xhttp.setRequestHeader('X-Requested-With','XMLHttpRequest');
                   xhttp.onreadystatechange = function() {
                       if (this.readyState == 4) {
                            if (this.status == 200) {
                               
                               var tasks = JSON.parse(this.responseText);
                               if(tasks.length === 0) {
                                    swal({
                                        title: "Tasks",
                                        text: "No tasks for this user.",
                                        confirmButtonText: "ok",
                                        allowOutsideClick: "true"
                                    });
                                    //data = ["","No Tasks for this User",""];
                                    //addRow(table,row_index,data,new_row_class);
                               } else {
                                   var tasks_txt = '';
                                   tasks.forEach((task, t) => {
                                        tasks_txt += '<p>'+ task.subject + '</p>';
                                        //data = ["",task.subject,task.body];
                                        //addRow(table,row_index,data,new_row_class);
                                   });
                                    swal({
                                        title: "Tasks",
                                        html: tasks_txt,
                                        confirmButtonText: "ok",
                                        allowOutsideClick: "true"
                                    });
                               }
                            } else {
                               
                            }
                       } else {
                       }
                    };
                    xhttp.send();
                    xhttp.onerror = function() {
                               
                    };
                }
                _targetElement = _targetElement.parentNode;
          }
       }, false);
    }
}());

/*** FOR TASK USERS */
$(function() {
  var clicked_rows = [];
  $( ".task-col" ).dblclick(function(event) {
        var table = document.getElementById('table-tasks');
        var task_col = event.target;
        var row_index = task_col.parentNode.rowIndex;
        var task_id = task_col.id.split('task-')[1];
        var new_row_class = "task-users";
        if (task_id == 'undefined' || task_id == null) {
            return false;;
        }
        if (clicked_rows.includes(row_index)) {
            return false;
        }
        clicked_rows.push(row_index);
        row_index = row_index+1;
        event.preventDefault();
        ajaxCall("get","task/"+task_id+"/users")
            .then( users => {
                  if (users.length == 0) {
                      swal({
                           title: "Users",
                           //html: true,
                           text: "No users for this user.",
                           confirmButtonText: "ok",
                           allowOutsideClick: "true"
                      });
                      //data = ["","No tasks for this user.",""];
                      //addRow(table,row_index,data,new_row_class);
                  } else {
                       var users_txt = '';
                       users.forEach((user, i) => {
                           //data = ["",user.fullname,user.email];
                           //addRow(table,row_index,data,new_row_class);
                           users_txt += '<p>'+ user.fullname + '</p>';
                       });
                       swal({
                           title: "Users",
                           html: users_txt,
                           //text: users_txt,
                           confirmButtonText: "ok",
                           allowOutsideClick: "true"
                       });
                   }
             })
             .catch( error => { });
    });
 });

function ajaxCall(method,url){
    return new Promise((resolve, reject) => {
        var data = [];
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: method,
            success: function(users){
               console.log(users);
               resolve(users);
            },
            error: function(xhr, status, error){
               reject(error);
            }
        });
   });
}

function addRow(table,row_index,data,new_row_class) {
    var row = table.insertRow(row_index++);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = data[0];
    cell2.innerHTML = data[1];
    cell3.innerHTML = data[2];
    row.className = new_row_class;
}
