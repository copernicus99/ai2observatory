<!--Start header-->
<!DOCTYPE html>

<head>

<?php
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); // remove emoji stuff
remove_action( 'wp_print_styles', 'print_emoji_styles' );  // remove emoji stuff
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // Remove shortlink
?>


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="A12 Observatory">
  <meta name="keywords" content="A12 Observatory, James Irwin, 5709065329">
  <meta name="author" content="James Irwin">
  <title>AI&sup2; Observatory</title> <!-- website title -->
  
  



<!--Start wp_head-->
<?php wp_head(); ?>
<!--End wp_head-->





<script>
window.onload = function() {
    if (window.jQuery) {  
        // jQuery is loaded  
       // alert("Yeah!");
    } else {
        // jQuery is not loaded
       // alert("Doesn't Work");
    }
}
</script>



 <style>
 
  body {
    background-color: black;
    color:grey;
  } 
  
  img {
    display: block;
    margin: 0 auto;
}
  
  .nf-form-fields-required {
  display: none;
  }

.ninja-forms-req-symbol {
  display: none;
  }

 </style> 



</head>







<body>


  <center>
  <header id="header">
    <a href="http://ai2observatory.com">
    <?php the_ai2_observatory_logo();?>
    </a>
  </header>
  </center>


<!--End header-->	





