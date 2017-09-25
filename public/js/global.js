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
