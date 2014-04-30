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
		<?php 
			wp_nav_menu(array(
			'container'      => false,
			'theme_location' => 'footer_nav',
			'menu_id'        => '',
			'menu_class'     => 'copyright'));
		?>     
    </div>
    
    <!--social links-->
    <div class="grid_6">
      <ul class="social">
      	<!-- AddThis Button BEGIN -->
      	<div class="addthis_toolbox addthis_default_style addthis_16x16_style">
	      	<a class="addthis_button_twitter"></a>
	      	<a class="addthis_button_facebook"></a>
	      	<a class="addthis_button_google_plusone_share"></a>
	      	<a class="addthis_button_digg"></a>
      	</div>
      	<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>      	
      	<!-- AddThis Button END -->       
      </ul>
    </div>
    <div class="clear"></div>
  </div>
</div>
<!--copyright ends--> 
<?php wp_footer(); ?>
</body>
</html>
