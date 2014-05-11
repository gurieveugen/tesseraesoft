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
    // =========================================================
    // Some slider. 
    // =========================================================
    $('#slider').nivoSlider({
        effect: 'fold',
        slices:15,
        boxCols:7,
        boxRows:4,
        animSpeed:600,
        pauseTime:5000,
        captionOpacity:1,
        directionNav:true,
        directionNavHide:true,
        controlNav:false,
        afterLoad: function(){
            $(".nivo-caption").animate({right:"50"}, {easing:"easeOutBack", duration: 500})
        },
        beforeChange: function(){
            $(".nivo-caption").animate({right:"-350"}, {easing:"easeInBack", duration: 500})
        },
        afterChange: function(){
            $(".nivo-caption").animate({right:"50"}, {easing:"easeOutBack", duration: 500})
        }
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
    // =========================================================
    // BUY
    // =========================================================
    $('.buy').click(function(e){
        if(!defaults.is_logged_in) alert('Only registered users can buy!');
        else
        {
            jQuery.ajax({
                type: "POST",
                url: defaults.ajaxurl + '?action=buy',
                dataType: 'json',
                data: { id : $(this).data('id') },              
                success: function(data){  
                    if(data.result) $('#buy-success').modal();        
                    else $('#buy-error').modal();
                }
            });            
        }
        e.preventDefault();
    });
    // =========================================================
    // REMOVE ITEM
    // =========================================================
    $('.remove-item').click(function(e){
        var price = $(this).data('price');
        var sum   = $(this).data('sum');
        var tr    = $(this).parent().parent();
        
        price = parseInt(price);
        sum   = parseInt(sum);

        jQuery.ajax({
            type: "POST",
            url: defaults.ajaxurl + '?action=remove',
            dataType: 'json',
            data: { id : $(this).data('id') },              
            success: function(data){  
                if(data.result) 
                {
                    $('#sum').text(sum-price);
                    tr.remove();
                }
            }
        });      
    });

    // =========================================================
    // SUBMIT CART
    // =========================================================
    $('#cart-form').submit(function(e){
        jQuery.ajax({
            type: "POST",
            url: defaults.ajaxurl + '?action=checkout',
            dataType: 'json',
            data: $('#cart-form').serialize(),              
            success: function(data){ 
                if(data.result)
                {
                    window.location = data.url;
                } 
                else
                {
                    console.log(data);    
                }
            }
        });      
        e.preventDefault();
    });
});