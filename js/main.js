$(window).load(function () {
    //Image Slider
    $('.image-slider').flexslider({
        animation: "slide",
        slideshowSpeed: 4000,
        animationDuration: 600,
        controlNav: true,
        keyboardNav: true,
        directionNav: true,
        pauseOnHover: true,
        pauseOnAction: true,
    });
});

$(document).ready(function() {  
    // =========================================================
    // jCarousel
    // =========================================================
    $('#mycarousel').jcarousel({
             easing: 'easeInOutQuint',
             animation: 600
    });
    // =========================================================
    // PrettyPhoto
    // =========================================================
    $('a[data-rel]').each(function() {
            $(this).attr('rel', $(this).data('rel'));
    });
    $("a[rel^='prettyPhoto[mixed]']").prettyPhoto({
            animation_speed: 'fast',
            slideshow: 5000,
            autoplay_slideshow: false,
            opacity: 0.80,
            show_title: false,
            theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            overlay_gallery: false,
            social_tools: false
    });
    // =========================================================
    // Validate form
    // =========================================================
    $(function() {
        var v = $("#subform").validate({
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    target: "#result_sub",
                    clearForm: true
                });
            }
        });
    }); 
    //To clear form field on page refresh
    $('#subform #email').val('');
});