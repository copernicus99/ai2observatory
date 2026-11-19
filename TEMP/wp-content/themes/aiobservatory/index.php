<?php get_header(); ?>

  <!-- fullpage -->
  <div id="fullpage">

    <!-- home -->
    <div class="section active home-section">
      <div class="section-entry">
        <div class="container">
          <div class="row">
            <?php dynamic_sidebar( 'home-widget-sidebar' ); ?> 
          </div>
        </div>
      </div>
    </div>
    <!-- /home -->





   <!-- service -->
    <div class="section service-section">
      <div class="section-entry">
        <?php dynamic_sidebar( 'home-services-sidebar' ); ?> 
      </div>
    </div>
    <!-- /service -->







    <!-- subscribe-->
    <div class="section subscribe-section">
      <div class="section-entry">
        <div class="container">
          <div class="row">
            <?php dynamic_sidebar( 'home-subscriber-sidebar' ); ?> 
            <!-- /subscribe-form -->
          </div>
        </div>
      </div>
    </div>
    <!-- /subscribe -->




 






    <!-- contact -->
    <div class="section contact-section">
      <div class="section-entry">
        <div class="container">
          <div class="row">
            <?php dynamic_sidebar( 'home-contact-sidebar' ); ?> 
            <div class="col-md-6 col-md-offset-3">
            <?php bruter_cf_contact_add_content_in_footer(); ?>
             
            </div>

            <!-- /contact form -->


            <!-- contact way -->
            <div class="contact-way col-md-12">
              <div class="row">
                <div class="col-md-4">
                  <p class="animated" 
                    data-animation="fadeInUp" 
                    data-delay="500"><i class="fa fa-map-marker"></i> <?php echo get_ai2_address();?></p>
                </div>
                <div class="col-md-4">
                  <p class="animated" 
                    data-animation="fadeInUp" 
                    data-delay="600"><i class="fa fa-phone"></i> <?php echo get_ai2_contact();?></p>
                </div>
                <div class="col-md-4">
                  <p class="animated" 
                    data-animation="fadeInUp" 
                    data-delay="700"><i class="fa fa-envelope-o"></i> <?php echo get_ai2_email();?></p>
                </div>
              </div>
            </div>
            <!-- /contact way -->

          </div>
        </div>
      </div>
    </div>
    <!-- /contact -->

  </div>
  <!-- /fullpage -->

  <?php 
  get_footer();?>