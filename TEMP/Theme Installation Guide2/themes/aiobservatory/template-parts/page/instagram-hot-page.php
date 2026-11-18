<?php 
get_header();?>
<?php
$tags = get_terms([
    'taxonomy' => 'instagram_tag',
    'hide_empty' => false,
]);
?>
<div id="main">
   <div class="container grid hotB overhide">
      <h3 class="name"><span>All Time Most Popular tags</span></h3>
      <div class="row">
      <?php if($tags):
      foreach ($tags as $tag):
      ?>
         <article><a href="<?php echo site_url('tag/?pid='.$tag->name);?>" title="<?php echo $tag->name;?>" target="_blank"><strong><?php echo $tag->name;?></strong></a></article>
     <?php endforeach;
     endif;
     ?>
         
      </div>
   </div>
</div>

<?php
get_footer(); 
?>