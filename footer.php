<?php
/*
 * This file adds the custom footer links to the Divi child theme.
 * Author:   Brad Dalton http://wpsites.net
 * @example   http://wpsites.net/
 * @package Divi Parent Theme by Elegant Themes
*/
if ( ! is_page_template( 'page-template-blank.php' ) ) : ?>

			<footer id="main-footer" class="foot">
				<?php get_sidebar( 'footer' ); ?>


		<?php
			if ( has_nav_menu( 'footer-menu' ) ) : ?>

				<div id="et-footer-nav">
					<div class="container">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'footer-menu',
								'depth'          => '1',
								'menu_class'     => 'bottom-nav',
								'container'      => '',
								'fallback_cb'    => '',
							) );
						?>
					</div>
				</div> <!-- #et-footer-nav -->

			<?php endif; ?>

			</footer><!-- #main-footer -->
			<div class="bottom-bar">
				<div class="container">
				<?php 
					dynamic_sidebar('Bottom Bar');
				?>
					
					<div class="bb-copyright">
						<p>&copy;Lumencor, Inc. <?php echo date('Y'); ?></p>
					</div>
				</div>

			</div>
		</div> <!-- #et-main-area -->

<?php endif; // ! is_page_template( 'page-template-blank.php' ) ?>

	</div> <!-- #page-container -->

	<?php wp_footer(); ?>
  <style type="text/css">
  .gform_wrapper .ginput_complex .ginput_full input[type="text"], .gform_wrapper .ginput_complex .ginput_full input[type="url"], .gform_wrapper .ginput_complex .ginput_full input[type="email"], .gform_wrapper .ginput_complex .ginput_full input[type="tel"], .gform_wrapper .ginput_complex .ginput_full input[type="number"], .gform_wrapper .ginput_complex .ginput_full input[type="password"] { width:97.6%!important; }
  .gform_wrapper ul.gfield_checkbox li, .gform_wrapper ul.gfield_radio li {padding-left:10px!important; }

  .gform_wrapper .datepicker,
  .gform_wrapper .top_label input.medium, 
  .gform_wrapper .top_label select.medium,
  .gform_wrapper .ginput_complex .ginput_full input[type="text"], .gform_wrapper .ginput_complex .ginput_full input[type="url"], .gform_wrapper .ginput_complex .ginput_full input[type="email"], .gform_wrapper .ginput_complex .ginput_full input[type="tel"], .gform_wrapper .ginput_complex .ginput_full input[type="number"], .gform_wrapper .ginput_complex .ginput_full input[type="password"] {
   width:99.2%!important;
   }
   .gform_wrapper .ginput_complex .ginput_right input[type=text], .gform_wrapper .ginput_complex .ginput_right input[type=url], .gform_wrapper .ginput_complex .ginput_right input[type=email], .gform_wrapper .ginput_complex .ginput_right input[type=tel], .gform_wrapper .ginput_complex .ginput_right input[type=number], .gform_wrapper .ginput_complex .ginput_right input[type=password], .gform_wrapper .ginput_complex .ginput_right select {
     width:98%!important;
     }
    .ui-datepicker { display:none;}
    .red-buttons .et_pb_more_button {
      border:2px solid #c5402e !important;
      }
      .white-buttons .et_pb_more_button {
      border:2px solid #fff !important;
      color:#fff!important;
      }
       .red-buttons .et_pb_more_button:after {
      color: #c5402e !important;
      
      }
      .white-buttons .et_pb_more_button:after {
      color: #fff !important;
      
      }
      .et_pb_column_1_2 { width:45%; }
    
  </style>
  <script type="text/javascript">
  jQuery(document).ready(function($) {
   

    $(".sixth").parent().parent().addClass('sixth-wrap');
    $(".fifth").parent().parent().addClass('fifth-wrap');
    $(".see-all").click(function(){
      $(this).parent().parent().parent().find(".product-wrap").slideToggle();
      $('html, body').animate({scrollTop: ($(window).scrollTop() + 400) + 'px'}, 300);
    });
    $(".product").parent().parent().addClass("product-wrap");
    $("label").each(function() {
        var label = $(this);
        var placeholder = label.text();
        if(placeholder == "First") {
          placeholder = "First Name";
        }
        if(placeholder == "Last") {
          placeholder = "Last Name";
        }
        var input_id = label.attr("for");
        $("#"+input_id).attr("placeholder", placeholder).val("").focus().blur();
    });
     $(".product a img").parent().addClass('img-link');
	 
	 
	 
	 
	 function sameHeight(){
		 
		$(".et_pb_slider").each(function(){ 
			var sliderHeight = heightCheck = 0;
	  
			//get height from slide content, make all the same height
			$(this).find(".et_pb_slide").each(function(){
				
				var previousCss  = $(this).attr("style");
				
				$(this).css({'position':'absolute','visibility':'hidden','display':'block'});
				
				heightCheck = $(this).height();
				
				if(heightCheck>sliderHeight){
					sliderHeight = heightCheck;  
				}
				
				$(this).attr("style", previousCss ? previousCss : "");
			  
			});
			
			$(this).find(".et_pb_slide").css("height",sliderHeight);
			
			$(this).find(".et-pb-arrow-prev").not(".home .et-pb-arrow-prev").css("height",sliderHeight);
			$(this).find(".et-pb-arrow-next").not(".home .et-pb-arrow-next").css("height",sliderHeight);
			
			if($(window).width() < 480){
				
				var mainH = $(".main-carouselContainer").height();
				
				$(".home .et-pb-arrow-prev").css("height",mainH);
				$(".home .et-pb-arrow-next").css("height",mainH);
				
			}
			else{
				$(".home .et-pb-arrow-prev").css("height","500px");
				$(".home .et-pb-arrow-next").css("height","500px");
			}
			
			
			
		 });
	
	 }
	 
	 sameHeight();
		
		
		$(window).resize(function () {
		
			$(".et_pb_slide").css("height","auto");
			sameHeight();
			
		
		}); 
		
		
  });
  </script>
</body>
</html>