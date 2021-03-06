

$(document).ready(function(){
    // --------------------------------------------------------------
    // HOME > VIDEO OVERLAY
    // --------------------------------------------------------------
    if (!tabletWidth.matches) { // Desktop
        $('.open_video_btn').click(function () {
            $('.video_overlay').fadeIn();
            if (typeof(youtube_player) !== 'undefined') {
                youtube_player.playVideo();
            }
            $('body').addClass('overlay');
        });

        $('.video_overlay').click(function (e) {
            if (typeof(youtube_player) !== 'undefined') {
                youtube_player.stopVideo();
            }
            $(this).fadeOut();
            $('body').removeClass('overlay');
        });
    }
    
    $(".faq-section .accordion-arrow").on("click", function() {
    	$(this).find(".fa-angle-down").toggle();
    	$(this).find(".fa-angle-up").toggle();
    	$(this).closest("li").find(".faq-description").toggle();
    });
    
    $(".faq-section .title").on("click", function() {
    	$(this).closest("li").find(".fa-angle-down").toggle();
    	$(this).closest("li").find(".fa-angle-up").toggle();
    	$(this).closest("li").find(".faq-description").toggle();
    });
});
