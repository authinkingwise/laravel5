var tabletWidth = window.matchMedia( "(max-width: 1024px)" );

var youtube_id = "vg0vMCsZt4o";
var youtube_player;
window.onYouTubeIframeAPIReady = function() {
    youtube_player = new YT.Player('video_player', {
        height: '460',
        width: '750',
        videoId: youtube_id,
        playerVars: {
            'controls'       : 1,
            'modestbranding' : 1,
            'rel'            : 0,
            'showinfo'       : 1
        }
    });
}

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