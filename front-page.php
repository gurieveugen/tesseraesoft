<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>

<?php get_header(); ?>

<?php
$options = $GLOBALS['front_page']->
getAll();
extract($options['front_page_options']);
$basic_requirements_html = explode("\n", $basic_requirements_html);

?>
<!--header_bottom starts-->
<div id="header_bottom">
    <div class="container clearfix">
        <div class="grid_12">

            <!--flexslider starts-->
            <div class="image-slider">
                <ul class="slides">

                    <!--first slide starts-->
                    <li>
                        <div class="image_slide_frame1">                           
                        <?php echo $video_html; ?></div>
                    <div class="slide-2">                       
                <?php echo $video_description_html; ?></li>
            <!--first slide starts--> </ul>
    </div>
    <!--flexslider ends-->

    <div class="clear"></div>
</div>
</div>
</div>
<!--header_bottom ends-->

<!--section for features starts-->
<div class="section">
<div class="container clearfix">

<!--features starts-->
<div class="grid_12 features_style2">
    <h2>Few reasons why you'll love softone</h2>
    <!-- <div class="grid_4 first">
        <h4>Clean design</h4>
        <img src="<?php echo TDU; ?>/images/icons/features/feature-icon-9.png" width="64" height="64" alt="icon">
        <p>
            Lorem ipsum dolor sit amet elit, sed diam nonummy nibh zzril laoreet dolore magna aliquam erat volutpat praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
        </p>
    </div>
    <div class="grid_4">
        <h4>Easy to customize</h4>
        <img src="<?php echo TDU; ?>/images/icons/features/feature-icon-8.png" width="64" height="64" alt="icon">
        <p>
            Duis autem vel eum iriure dolor in vulputate velit molestie consequat, consuetudium lectorum. Mirum est notare quam littera gothica vel illum feugiat nulla facilisis
        </p>
    </div>
    <div class="grid_4 last">
        <h4>Cost effective</h4>
        <img src="<?php echo TDU; ?>/images/icons/features/feature-icon-10.png" width="64" height="64" alt="icon">
        <p>
            Nam liber tempor cum soluta nobis eleifend option ullamcorper suscipit lobortis nisl commodo consequat doming quod mazim placerat facer possim assum.
        </p>
    </div> -->
    <?php if (is_active_sidebar('front-page-first-row')) dynamic_sidebar( 'front-page-first-row' ); ?>
    <!--spacer here-->
    <div class="spacer_30px"></div>
    <!--spacer ends-->

    <!-- <div class="grid_4 first">
        <h4>W3C valid</h4>
        <img src="<?php echo TDU; ?>/images/icons/features/feature-icon-7.png" width="64" height="64" alt="icon">
        <p>
            Nam liber tempor cum soluta nobis eleifend option ullamcorper suscipit lobortis nisl commodo consequat doming quod mazim placerat facer possim assum.
        </p>
    </div>
    <div class="grid_4">
        <h4>Feature goes here</h4>
        <img src="<?php echo TDU; ?>/images/icons/features/feature-icon-12.png" width="64" height="64" alt="icon">
        <p>
            Lorem ipsum dolor sit amet elit, sed diam nonummy nibh zzril laoreet dolore magna aliquam erat volutpat praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
        </p>
    </div>
    <div class="grid_4 last">
        <h4>24 X 7 support</h4>
        <img src="<?php echo TDU; ?>/images/icons/features/feature-icon-11.png" width="64" height="64" alt="icon">
        <p>
            Duis autem vel eum iriure dolor in vulputate velit molestie consequat, consuetudium lectorum. Mirum est notare quam littera gothica vel illum feugiat nulla facilisis
        </p>
    </div> -->
    <?php if (is_active_sidebar('front-page-second-row')) dynamic_sidebar( 'front-page-second-row' ); ?>
    <div class="clear"></div>
</div>
<!--features ends-->

</div>
</div>
<!--section for features ends-->

<!--section for subscribe starts-->
<div class="section colored">
<div class="container clearfix">
<div class="grid_12">
    <div class="box">
        <div class="box_inner clearfix">

            <!--subscribe text here-->
            <div class="subscribe_text">
                <h3>Subscribe for product updates and promotions!</h3>
                <p>
                    Nam liber tempor duis soluta imperdiet doming mazim placerat facer assum.
                </p>
            </div>
            <?php echo do_shortcode('[contact-form-7 id="625" title="Subscribe"]'); ?>
            <!--subscribe form here-->
            
        <!--subscribe form ends-->

        <div class="clear"></div>
    </div>
</div>
</div>
</div>
</div>
<!--section for subscribe ends-->

<!--section for requirements and gallery starts-->
<div class="section">
<div class="container clearfix">

<?php 
        if($basic_requirements_html)
        {
            ?>
            <!--requirements starts-->
            <div class="grid_3">
            <h2>Basic requirements</h2>
            <ul class="list3">
                <?php
                        foreach ($basic_requirements_html as $li) 
                        {
                            printf('<li>%s</li>', $li);
                        }
                        ?>
            </ul>
            </div>
            <!--requirements ends-->
            <?
        }
      ?>

<!--gallery starts-->
<div class="grid_9">
<h2>Take a look at softone screencast</h2>
<?php echo do_shortcode('[screencasts]'); ?>
</div>
<!--gallery ends-->

</div>
</div>
<!--section for requirements and gallery ends-->

<?php get_footer(); ?>