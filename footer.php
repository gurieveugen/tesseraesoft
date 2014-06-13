<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
	<!--footer starts-->
<div id="footer">
	<?php get_sidebar(); ?> 
</div>
<!--footer ends--> 

<!--copyright starts-->
<div id="copyright">
  <div class="container clearfix"> 
    
    <!--copyright text and general links-->
    <div class="grid_6">
      <p>Copyright © 2011 . All the respective rights reserved</p>		
    </div>
    
    <!--social links-->
    <div class="grid_6">      
    </div>
    <div class="clear"></div>
  </div>
</div>
<!--copyright ends--> 

<div id="buy-success" class="modal fade" style="display: none;">
    <div class="header">
        <a data-dismiss="modal" class="close">×</a>
    </div>
    <div class="body text-center">
        <h1>Thank you for shopping!</h1>
        <h2>Can go to the cart or continue shopping.</h2>
    </div>
    <div class="footer">
        <a href="<?php echo get_bloginfo('url'); ?>/cart" class="button button-black"><i class="fa fa-shopping-cart"></i> Cart</a>
        <a href="#" class="button button-black" data-dismiss="modal"><i class="fa fa-money"></i> Continue shopping</a>
    </div>
</div>

<div id="buy-error" class="modal fade" style="display: none;">
    <div class="header">
        <a data-dismiss="modal" class="close">×</a>
    </div>
    <div class="body text-center">
        <h1>Error!</h1>
        <h2>Something went wrong! Try to contact the administrator!</h2>
    </div>
    <div class="footer">       
        <a href="#" class="button button-black" data-dismiss="modal"><i class="fa fa-money"></i> Continue shopping</a>
    </div>
</div>

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = '152782';
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->

<?php wp_footer(); ?>
</body>
</html>
