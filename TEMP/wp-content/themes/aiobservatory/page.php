<?php
/**
 * The template for displaying all pagesz
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<!-- fullpage -->
<div id="fullpage"> 
  
  <!-- homey -->
  <div class="section active home-section">
    <div class="section-entry">
      <div class="container">
        <div class="row">
          <div class="col-md-12"> 
            <!-- section title -->
            <div class="section-heading sn-2">
              <h1 class="section-title animated" 
                  data-animation="fadeInDown" 
                  data-delay="0"><?php echo get_aio_page_title();?><!-- put text in span for purple glow --> 
              </h1>
            </div>
            <!-- /section title --> 
           
            
       <div class="home-btn-wrapper"> <!-- 5 BUTTONS -->
			  
			     <div id="append-sub-menu"></div>
				  


                   </div>
            <!-- 5 BUTTONS  -->
            <br>
            <br>
            <br>
            <br>
            <div class="conten-wrap"> 
             <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
				endwhile; endif; 
				?>
		
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /home --> 
  
</div>
<!-- /fullpage --> 

<?php get_footer();
