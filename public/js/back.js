tinymce.init({
    selector: 'textarea',
    height: 250,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code help'
    ],
    toolbar: 'insert | undo redo |  styleselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
});

$(document).ready(function(){

	/*
	* On Add a new project.
	*/
	$("#visible_1").on('click', function(){
    	$(".visible_to_users_group").fadeOut();
    });
    $("#visible_0").on('click', function(){
    	$(".visible_to_users_group").fadeIn();
    });
});