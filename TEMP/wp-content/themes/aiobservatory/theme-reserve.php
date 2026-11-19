<!--Start Theme-->	



<!--call header from theme-->	
<?php 
/**
* Template Name: theme-reserve
*/

//call the header
 get_header('reserve');
 ?>   
              <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
				endwhile; endif; 
				?>
<!--end call header from theme-->
		
	
	
	
	
	
	
<!--call footer from theme-->	
<?php 
//call the footer
get_footer('reserve'); 
?>
<!--end call footer from theme-->






<!--End Theme-->