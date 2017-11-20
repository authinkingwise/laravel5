tinymce.init({
    selector: 'textarea',
    height: 220,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code help'
    ],
    toolbar: 'insert | undo redo |  styleselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
});

var schedule = {
    "new": 1,
    "todo": 2,
    "in_progress": 3,
    "awaiting": 4,
    "rejected": 5,
    "completed": 6
};

$(function(){

    // Ajax Loader
    var ajax_loader = $(".ajax-loader");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('[data-toggle="tooltip"]').tooltip();

	/*
	* On Add a new project.
	*/
	$("#visible_1").on('click', function(){
    	$(".visible_to_users_group").fadeOut();
    });
    $("#visible_0").on('click', function(){
    	$(".visible_to_users_group").fadeIn();
    });

    $("#due_date_picker").datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function(dateText) {
            $("#due_date_time").val(dateText + " 18:00:00");
        }
    });


    /*
    * View and edit task.
    * Click the task name, the modal loads the details of the relevant task.
    */
    if (typeof url_get_task !== "undefined") {
        $(".task-name").on("click", function(){
            var task_id = $(this).data("task");
            var action_url = $("#edit-task-form").attr("action"); // Retrieve the post action url.
            $.getJSON(url_get_task + "/" + task_id, function(data){
                $("#task-name").val(data.name);
                //$("#task-description").val(data.description);
                tinyMCE.get("task-description").setContent(data.description); // Set content inside TinyMCE editor.
                if ($("#task-description").hasClass("no-editor")) {
                    tinymce.get('task-description').getBody().setAttribute('contenteditable', 'false');
                    tinymce.get('task-description').getBody().style.backgroundColor = "#f5f8fa";
                }
                
                $("#task-schedule_id").val(data.schedule_id);
                $("#task-user_id").val(data.user_id);

                if (typeof data.due_date_time !== "undefined" && data.due_date_time !== null) {
                    $("#task-due_date_picker").val(data.due_date_time.slice(0, -8));
                    $("#task-due_date_time").val(data.due_date_time);
                } else {
                    $("#task-due_date_picker").val("");
                    $("#task-due_date_time").val("");
                }
                var post_url = $("#edit-task-form").attr("action", action_url + "/" + task_id); // Dynamically add task_id to the url as the new POST url.
            });
        });
    }

    /*
    * Sort (drag and drop) the task list on Project Page.
    */
    $( ".list-tasks" ).sortable({
        connectWith: ".list-tasks",

        start: function( event, ui ) {
            
        },

        // stop: the former is the event target.
        stop: function( event, ui ) {
            if ( $(ui.item).hasClass("no-permission") ) {
                $(this).sortable("cancel");
                var task_name = ui.item.attr("data-name");
                $("#dialog-permission").modal();
                $("#dialog-permission-task-name").text(task_name);
                $(".reject-reason").text("No permission to drag this task.");
                return;
            }

            var task_id = $(ui.item).attr('data-task');

            // Update each task's index for the former event target
            $(this).find("li").each(function(index, el) {
                $.ajax({
                    type: "POST",
                    url: url_get_task + "/" + $(el).attr('data-task'),
                    data: {"order_index": $(el).index()},
                    headers: {"X-HTTP-Method-Override": "PUT"},
                    success: function( msg ) {
                        //ajax_loader.hide();
                    }
                });
            });

            ajax_loader.hide();
        },

        // receive: the latter is the event target.
        receive: function( event, ui ) {
            // Check if the user has permission to edit this task.
            if ( ui.item.hasClass("no-permission") ) {
                ui.sender.sortable("cancel");
                return;
            }

            ajax_loader.show();

            var task_id = $(ui.item).attr('data-task');
            var schedule_id = $(ui.item).attr('data-schedule');

            var new_schedule_id = $(this).attr('data-schedule');

            var button = $(ui.item).find("button");

            // Update the schedule status of the task
            if (schedule_id !== new_schedule_id) {
                $.ajax({
                    type: "POST",
                    url: url_get_task + "/" + task_id,
                    data: {"schedule_id": new_schedule_id},
                    headers: {"X-HTTP-Method-Override": "PUT"},
                    success: function( msg ) {
                        
                        // Update Button color and text
                        if (new_schedule_id == schedule.new) { // Schedule: New
                            if (schedule_id == schedule.completed)
                                button.css("visibility", "visible");
                            button.attr('class', 'btn btn-xs btn-info new-button');
                            button.html("Start");
                        }
                        if (new_schedule_id == schedule.todo) { // Schedule: To do
                            if (schedule_id == schedule.completed)
                                button.show();
                            button.attr('class', 'btn btn-xs btn-danger new-button');
                            button.html("Start");
                        }
                        if (new_schedule_id == schedule.in_progress) { // Schedule: In progress
                            if (schedule_id == schedule.completed)
                                button.show();
                            button.attr('class', 'btn btn-xs btn-warning finish-button');
                            button.html("Finish");
                        }
                        if (new_schedule_id == schedule.completed) { // Schedule: Completed
                            button.css("visibility", "hidden");
                            button.attr('class', 'btn btn-xs btn-success completed-button');
                            button.html("Completed");
                        }
                    }
                });
            }
            
            // Update each task's index for the latter event target
            $(this).find("li").each(function(index, el) {
                $.ajax({
                    type: "POST",
                    url: url_get_task + "/" + $(el).attr('data-task'),
                    data: {"order_index": $(el).index()},
                    headers: {"X-HTTP-Method-Override": "PUT"},
                    success: function( msg ) {
                    
                    }
                });

            });
        }
    }).disableSelection();

    // Update the schedule status of the task if clicking the button
    $(".tasks .action .btn").on("click", function(){
        ajax_loader.show();

        var task_id = $(this).data("task");
        var task_name = $(this).closest("li").find('.task-name').text();

        // Set the new schedule status depending on clicking which button
        var schedule_id;
        var ul_list_tasks;
        if ($(this).hasClass("new-button")) {
            schedule_id = schedule.in_progress;
            ul_list_tasks = $("#list-workingon-tasks li");
        }

        if ($(this).hasClass("finish-button")) {
            schedule_id = schedule.awaiting;
        }
        if ($(this).hasClass("reject-button")) {
            schedule_id = schedule.rejected;
        }
        if ($(this).hasClass("accept-button")) {
            schedule_id = schedule.completed;
        }

        // ajax upating the schedule statsu of the task
        if (typeof url_get_task !== "undefined") {
            $.ajax({
                type: "POST",
                url: url_get_task + "/" + task_id,
                data: {"schedule_id": schedule_id},
                headers: {"X-HTTP-Method-Override": "PUT"},
                success: function(response) {
                    if ($(this).hasClass("new-botton")) {
                        $.ajax({
                            type: "POST",
                            url: url_get_task + "/" + task_id,
                            data: {"order_index": ul_list_tasks.length},
                            headers: {"X-HTTP-Method-Override": "PUT"},
                            success: function( msg ) {

                            }
                        });
                    }
                    ajax_loader.hide();
                    setTimeout(function() {
                        window.location.reload();
                    }, 200);  
                }
            });
        }


    });


    /* Add more file attachment */
    $("#add-file").on("click", function() {
        var html_file = '<input type="file" class="form-control" name="files[]">';
        $(html_file).insertBefore($(this));
    });

    $(".plan-list .toggle").on("click", function(){
        $(this).closest("li").find(".item-details").toggle();
    });

    /*
    * View and edit planning.
    * Click the ticket or task schedule button, the modal loads the details of the relevant planning.
    */
    $(".schedule_date").datepicker({
        dateFormat: "yy-mm-dd"
    });

    $(".actions .schedule-ticket").on("click", function(){
        var ticket_id = $(this).data("ticket");
        $.getJSON(url_get_ticket + "/get/" + ticket_id, function(data){
            $("#schedule-ticket #ticket_id").val(data.id);
            if (typeof data.title !== "undefined" && data.title !== null) {
                $(".modal-dialog .ticket-name").html(data.title);
            }
        });
    });

    $(".actions .schedule-task").on("click", function(){
        var task_id = $(this).data("task");
        var project_id = $(this).data("project");
        $.getJSON(url_get_task + "/" + task_id, function(data){
            $("#schedule-task #task_id").val(data.id);
            $("#schedule-task #project_id").val(project_id);
            if (typeof data.name !== "undefined" && data.name !== null) {
                $(".modal-dialog .task-name").html(data.name);
            }
        });
    });

    $(".schedule-hour-num, .actual-hour-num").hover(function(){
        $(this).addClass("hover");
    }, function(){
        $(this).removeClass("hover");
    });

    $(".schedule-hour-num").on("click", function(){

        if($(this).hasClass("sum")) {
            return;
        }

        if ($(this).hasClass("no-schedule")) {
            var ticket_id = $(this).data("ticket");
            $("input[name='ticket_id']").val(ticket_id);

            var title_text = $(this).closest("li.single").find(".ticket-title").text();
            $(".modal-dialog .ticket-name").html(title_text); // show ticket title

            var planning_date = $(this).data('date');
            $("input[name='actual_date']").val(planning_date);

            if (typeof $(this).data("planning") !== "undefined" && $(this).data("planning") !== null) {
                var form = $(".modal-dialog form");
                var planning_id = $(this).data("planning");
                var action_url = $("#schedule-ticket").attr("action");
                var post_url = $("#schedule-ticket").attr("action", action_url + "/" + planning_id);
                form.append('<input type="hidden" name="_method" value="PUT">');
            }

            return;
        }

        var planning_id = $(this).data("planning");
        var action_url = $("#edit-schedule-ticket").attr("action"); // Retrieve the post action url.
        
        var title_text = $(this).closest("li.single").find(".ticket-title").text();
        $(".modal-dialog .ticket-name").html(title_text); // show ticket title

        $.getJSON(url_get_planning + "/" + planning_id, function(data){
            $("#edit-schedule-ticket #schedule_hours").val(data.schedule_hours);
            $("#edit-schedule-ticket .schedule_date").val(data.schedule_date);

            if (typeof data.actual_hours !== "undefined" && data.actual_hours != null) {
                $("#edit-schedule-ticket #actual_hours").val(data.actual_hours);
            } else {
                $("#edit-schedule-ticket #actual_hours").val(null);
            }

            if (typeof data.description !== "undefined" && data.description !== null) {
                tinyMCE.get("planning-description").setContent(data.description); // Set content inside TinyMCE editor.
            } else {
                tinyMCE.get("planning-description").setContent("");
            }
            
            var post_url = $("#edit-schedule-ticket").attr("action", action_url + "/" + planning_id); // Dynamically add planning_id to the url as the new POST url.
        });
    });

    $(".schedule-hour-num, .actual-hour-num").tooltip();

    // validate the input is numeric.
    $("input[name='actual_hours'], input[name='schedule_hours']").keyup(function(){
        if (this.value != this.value.replace(/[^0-9\.]/g,'')) {
            this.value = this.value.replace(/[^0-9\.]/g,'')
        }
    });

    $(".actual-hour-num").on("click", function(){
        if($(this).hasClass("sum")) {
            return;
        }

        var planning_id = $(this).data("planning");
        var action_url = $("#edit-actual-hours-ticket").attr("action"); // Retrieve the post action url.

        var title_text = $(this).closest("li.single").find(".ticket-title").text();
        $(".modal-dialog .ticket-name").html(title_text); // show ticket title

        $.getJSON(url_get_planning + "/" + planning_id, function(data){
            $("#edit-actual-hours-ticket .schedule_date").val(data.schedule_date);

            if (typeof data.actual_hours !== "undefined" && data.actual_hours != null) {
                $("#edit-actual-hours-ticket #actual_hours").val(data.actual_hours);
            } else {
                $("#edit-actual-hours-ticket #actual_hours").val(null);
            }

            var post_url = $("#edit-actual-hours-ticket").attr("action", action_url + "/" + planning_id); // Dynamically add planning_id to the url as the new POST url.
            var delete_url = $("#delete-planning").attr("action", action_url + "/" + planning_id);
        });
    });

});
