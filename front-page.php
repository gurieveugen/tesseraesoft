<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>

<?php get_header(); ?>



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
              <iframe src="http://player.vimeo.com/video/7449107" width="512" height="302"></iframe>
            </div>
            <div class="slide-2">
              <p>Claritas est etiam processus dynamicus</p>
              <h1>Softone advantage.</h1>
              <h3>Make your app visible to plethora of <span class="color">accumsan etiusto</span> odio.</h3>
              <a href="#" class="button_appstore"></a> </div>
          </li>
          <!--first slide starts--> 
          
        </ul>
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
      <h2>Few reasons why you'll love softone </h2>
      <div class="grid_4 first">
        <h4>Clean design</h4>
        <img src="<?php echo TDU; ?>/images/icons/features/feature-icon-9.png" width="64" height="64" alt="icon">
        <p>Lorem ipsum dolor sit amet elit, sed diam nonummy nibh zzril laoreet dolore magna aliquam erat volutpat praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
      </div>
      <div class="grid_4">
        <h4>Easy to customize</h4>
        <img src="<?php echo TDU; ?>/images/icons/features/feature-icon-8.png" width="64" height="64" alt="icon">
        <p>Duis autem vel eum iriure dolor in vulputate velit molestie consequat, consuetudium lectorum. Mirum est notare quam littera gothica vel illum feugiat nulla facilisis</p>
      </div>
      <div class="grid_4 last">
        <h4>Cost effective</h4>
        <img src="<?php echo TDU; ?>/images/icons/features/feature-icon-10.png" width="64" height="64" alt="icon">
        <p>Nam liber tempor cum soluta nobis eleifend option ullamcorper suscipit lobortis nisl commodo consequat doming quod mazim placerat facer possim assum.</p>
      </div>
      
      <!--spacer here-->
      <div class="spacer_30px"></div>
      <!--spacer ends-->
      
      <div class="grid_4 first">
        <h4>W3C valid </h4>
        <img src="<?php echo TDU; ?>/images/icons/features/feature-icon-7.png" width="64" height="64" alt="icon">
        <p>Nam liber tempor cum soluta nobis eleifend option ullamcorper suscipit lobortis nisl commodo consequat doming quod mazim placerat facer possim assum.</p>
      </div>
      <div class="grid_4">
        <h4>Feature goes here</h4>
        <img src="<?php echo TDU; ?>/images/icons/features/feature-icon-12.png" width="64" height="64" alt="icon">
        <p>Lorem ipsum dolor sit amet elit, sed diam nonummy nibh zzril laoreet dolore magna aliquam erat volutpat praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
      </div>
      <div class="grid_4 last">
        <h4>24 X 7 support</h4>
        <img src="<?php echo TDU; ?>/images/icons/features/feature-icon-11.png" width="64" height="64" alt="icon">
        <p>Duis autem vel eum iriure dolor in vulputate velit molestie consequat, consuetudium lectorum. Mirum est notare quam littera gothica vel illum feugiat nulla facilisis</p>
      </div>
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
            <p>Nam liber tempor duis soluta imperdiet doming mazim placerat facer assum.</p>
          </div>
          <?php echo do_shortcode('[contact-form-7 id="625" title="Subscribe"]'); ?>
          <!--subscribe form here-->
          <!-- <form id="subform" method="post" action="subscribe-form.php">
            <fieldset>
              <p>
                <input name="email" id="email" placeholder="Enter Email id here" class="required email" />
              </p>
              <input type="submit" class="sub_submit" name="submit" value="subscribe" />
              <div id="result_sub"></div>
            </fieldset>
          </form> -->
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
    
    <!--requirements starts-->
    <div class="grid_3">
      <h2>Basic requirements</h2>
      <ul class="list3">
        <li>Active internet connection for online activation.</li>
        <li>Macintosh computer with Mac OS X 10.5.8 or later.</li>
        <li>Intel computer with at least 1GB of RAM. </li>
      </ul>
    </div>
    <!--requirements ends--> 
    
    <!--gallery starts-->
    <div class="grid_9">
      <h2>Take a look at softone screencast</h2>
      <ul id="mycarousel" class="jcarousel-skin-tango">
        <li>
          <div class="thumb"><a href="#"><img src="<?php echo TDU; ?>/images/preview/thumb-4.jpg" width="200" height="125" alt="Image"/></a><a href="http://vimeo.com/7449107" data-rel="prettyPhoto[mixed]" title="This is title of vimeo video" class="play first_icon"></a> <a href="http://tanshcreative.com" target="_blank" class="link second_icon"></a></div>
        </li>
        <li>
          <div class="thumb"><a href="#"><img src="<?php echo TDU; ?>/images/preview/thumb-2.jpg" width="200" height="125" alt="Image"/></a><a href="<?php echo TDU; ?>/images/preview/large-2.jpg" data-rel="prettyPhoto[mixed]" title="This is title of image" class="zoom first_icon"></a> <a href="http://tanshcreative.com" target="_blank" class="link second_icon"></a></div>
        </li>
        <li>
          <div class="thumb"><a href="#"><img src="<?php echo TDU; ?>/images/preview/thumb-3.jpg" width="200" height="125" alt="Image"/></a><a href="<?php echo TDU; ?>/images/preview/large-3.jpg" data-rel="prettyPhoto[mixed]" title="This is title of image" class="zoom first_icon"></a> <a href="http://tanshcreative.com" target="_blank" class="link second_icon"></a></div>
        </li>
        <li>
          <div class="thumb"><a href="#"><img src="<?php echo TDU; ?>/images/preview/thumb-1.jpg" width="200" height="125" alt="Image"/></a><a href="http://www.youtube.com/watch?v=GgR6dyzkKHI" data-rel="prettyPhoto[mixed]" title="This is title of youtube video" class="play first_icon"></a> <a href="http://tanshcreative.com" target="_blank" class="link second_icon"></a></div>
        </li>
      </ul>
    </div>
    <!--gallery ends--> 
    
  </div>
</div>
<!--section for requirements and gallery ends--> 



<?php get_footer(); ?>