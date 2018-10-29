$(document).ready(function() {
    $.ajaxSetup({data: {token: CFG.token}});
    $(document).ajaxSuccess(function(e,x) {
        var result = $.parseJSON(x.responseText);
        $('input:hidden[name="token"]').val(result.token);
        $.ajaxSetup({data: {token: result.token}});
    });
    
    flatpickr('#taskDate',{
        dateFormat: 'Y-m-d'
    });

    
    initializeTaskData();

    $('body').on('click','.removeTask',function(){
        console.log('removing the current task ...')
        var index = $('i.removeTask').index(this);
        console.log(index);
        removeTask(index);
    });
});

function initializeTaskData() {
    console.log('initializing task data from localstorage ...')
    var task_data = JSON.parse(localStorage.getItem('taskData'));
    var task_content = '';
    
    if (task_data) {
        task_data.forEach(function(e) {
            task_content += '<div class="task-item">';
            task_content += '<div class="task-title">' + e.name + '</div>';
            task_content += '<div class="task-date">' + e.date + '</div>';
            task_content += '<div class="task-desc">' + e.desc + '</div>';
            task_content += '<i class="fas fa-times-circle removeTask"></i>';
            task_content += '</div>';
        });
        
        $('.tasks-content').html(task_content);
    }
}

function removeTask(index) {
    var task_data = JSON.parse(localStorage.getItem('taskData'));
    task_data.splice(index, 1);  

    localStorage.setItem('taskData', JSON.stringify(task_data));
    initializeTaskData();
}

function addTask() {
    console.log('adding the task ...')
    var task_name = $('#taskName').val();
    var task_date = $('#taskDate').val();
    var task_desc = $('#taskDesc').val();
    var task_data = JSON.parse(localStorage.getItem('taskData'));
    
    if(task_data === null) {
        task_data = [
            {
                'name': task_name,
                'date': task_date,
                'desc': task_desc
            }
        ];
    } else {
        task_data.push(
            {
                'name': task_name,
                'date': task_date,
                'desc': task_desc
            }
        );
    }

    $.ajax({
        url: CFG.url + 'ajax/backup/',
        type: 'POST',
        data: {post_data: task_data[task_data.length - 1]},
        dataType: 'json',
        success: function(data) {
            if(data.result == "success") {
                localStorage.setItem('taskData', JSON.stringify(task_data));
                $('#taskName').val('');
                $('#taskDate').val('');
                $('#taskDesc').val('');
                initializeTaskData();
            } else {
                alert("Failed to backup task on ERP. Please try again.");
            }
        }
    });
}