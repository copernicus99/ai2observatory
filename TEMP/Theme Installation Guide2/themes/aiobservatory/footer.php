<!-- footer -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!--  text before and in ahref to show as a footer  -->
          <span class="animated copyright"
            data-delay="900">   <a href="#" target="_blank">  </a> <!-- copyright text and link -->
          </span>
        </div>
      </div>
    </div>
  </footer>
  <!-- /footer -->

  <!-- social icon -->
  <?php the_social_icon();?>
  <!-- /social icon -->
  <?php if(!is_home()):?>
<div id="fp-nav" class="left full-nav" style="margin-top: -144px;">

  <?php ai2_observatory_menu();?>
</div>
<?php endif;?>
  <!-- video control -->
  <div id="video-control">
    <i id="play" class="fa fa-fw fa-pause"></i>
    <i id="volume" class="fa fa-fw"></i>
  </div>
  <!-- /video control -->

  <!-- video -->
  <div id="bg-video"></div>
  <!-- /video -->
<?php if(is_home()):?>
  <!-- audio control -->
  <div id="audio-control">
    <i id="audio-play" class="fa fa-fw"></i>
  </div>
  <!-- /audio control -->

  <!-- audio -->
  <audio id="audio-player" src="<?php echo get_theme_file_uri('assets/audio/01.mp3');?>" loop></audio>
  <!-- /audio -->
<?php endif;?>
<input type="hidden" id="bg-img" value="<?php echo get_theme_file_uri('assets/img/bg/video-desktop4.jpg'); ?>">
<!-- script start -->
<script type='text/javascript' src="<?php echo get_theme_file_uri('assets/js/jquery-1.11.2.min.js');?>"></script>
<!--[if lt IE 10]>
<script type='text/javascript' src='js/ie/jquery.placeholder.js'></script>
<script type='text/javascript' src='js/ie/ie.js'></script>
<![endif]-->
<script type='text/javascript' src="<?php echo get_theme_file_uri('assets/js/variable.js');?>"></script>
<?php if(is_home()):?>
<script type='text/javascript' src="<?php echo get_theme_file_uri('assets/js/plugin.js');?>"></script>
<script type='text/javascript' src="<?php echo get_theme_file_uri('assets/js/main.js');?>"></script>
<?php else:?>
<script type='text/javascript' src="<?php echo get_theme_file_uri('assets/js/main-n.js');?>"></script>

<?php endif;?>
<?php if(is_home()):?>
<!-- script end -->
<script>
$('button.menu-toggle').on('click', function(){
  $('body').toggleClass('open');
});

</script>
<?php endif;?>
</body>
</html>