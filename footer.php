<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
	<!--footer starts-->
	<div id="footer">
	<?php get_sidebar(); ?>
  <div class="container footer_inner clearfix"> 
    
    <!--about starts-->
    <div class="grid_3">
      <h4>About softone</h4>
      <p>SOFTONE is a  Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam est usus legentis in iis qui facit eorum claritatem. </p>
      <a href="#"><img src="<?php echo TDU; ?>/images/logo.png" width="125" height="35" alt="logo" class="logo"></a> </div>
    <!--about ends--> 
    
    <!--list starts-->
    <div class="grid_3">
      <h4>Some links here</h4>
      <ul class="list1">
        <li> Nam liber tempor cum nobis eleind.</li>
        <li>Praesent zzril delenit augue.</li>
        <li>Claritas est processus dynamicus.</li>
        <li>Lorem ipsum dolor sit amet.</li>
        <li>Suscipit lobortis aliquip excomm</li>
        <li>Duis autem vel eum iriure dolor</li>
      </ul>
    </div>
    <!--list ends--> 
    
    <!--testimonial starts-->
    <div class="grid_3">
      <h4>What they say...</h4>
      <div class="testimonial_style1"> 
        
        <!--first testimonial starts-->
        <div>
          <p>" Praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim "</p>
          <span>John Doe <br/>
          http://companyname.com</span> </div>
        <!--first testimonial ends--> 
        
        <!--second testimonial starts-->
        <div>
          <p>" Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram decima. "</p>
          <span>Jenny<br/>
          http://companyname.com</span> </div>
        <!--second testimonial ends--> 
        
      </div>
    </div>
    <!--testimonial ends--> 
    
    <!--social starts-->
    <div class="grid_3">
      <h4>Socialise with us</h4>
      <div class="twitter"></div>
    </div>
    <!--social ends-->
    
    <div class="clear"></div>
  </div>
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
