<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8 ie-lt10 ie-lt9 no-js" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="ie ie9 ie-lt10 no-js" lang="en"><![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="A12 Observatory">
  <meta name="keywords" content="A12 Observatory, James Irwin, 5709065329">
  <meta name="author" content="James Irwin">
  <title>AI&sup2; Observatory - Home</title> <!-- website title -->
  <link type='text/css' href="<?php echo get_theme_file_uri('assets/css/bootstrap.min.css');?>" rel='stylesheet'>
  <link type='text/css' href="<?php echo get_theme_file_uri('assets/css/style.css');?>" rel='stylesheet'>
  <!--[if lt IE 9]>
  <script type="text/javascript" src="js/ie/html5shiv.min.js"></script>
  <![endif]-->
  <link rel="icon" href="<?php echo get_theme_file_uri('assets/img/favicon.ico');?>"> <!-- website icon -->
</head>

<body <?php echo (is_home())? 'onload="FadeAudio(); hideControls();"': '';?>>

<!--  I added this div to source my own video & poster -->
<div id="wrapper"> 
 

<?php dynamic_sidebar( 'home-header-sidebar' ); ?> 
<?php if(is_home()):?>
<?php the_ai2_observatory_poster();?>
<?php endif; ?>
</div> 


  <div class="overlay1"></div> <!-- overlay  I added "1" to supress -->
  <div class="pattern1"></div> <!-- pattern  I added "1" to supress -->
<?php if(is_home()):?>
  <!-- preloader - spinning cog when site opens-->
  <div id="preloader">
    <div id="preloader-img"></div>
  </div>
  <!-- /preloader -->
<?php endif;?>

<button class="menu-toggle"></button>
<nav class="mob-nav" id="">

    <?php
if(!is_home()):
        $main_menu = array(
        'menu'            => 'Main Menu',
        'container'       => '',
        'container_class' => '',
        'menu_class'      => 'menu',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        //'items_wrap'      => '<ul id=\"%1$s\" class=\"%2$s\">%3$s</ul>',
        'depth'           => 1,

    );
        wp_nav_menu($main_menu);
else:
echo '';
endif;
?>

</nav>
  <!-- header -->
  <header id="header">
    <?php the_ai2_observatory_logo();?>
  </header>
  <!-- /header -->
