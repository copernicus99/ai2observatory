<?php 
get_header();?>
<?php
$categories = get_terms([
    'taxonomy' => 'instagram_category',
    'hide_empty' => false,
]);
$get_category = clean($_GET['pid']);
$search_name = $get_category;
$pagination = array();
$count = 0;
$posts = array();
global $instagramObject;
global $instagramPostPerPage;
if(is_object($instagramObject)){
if(isset($search_name)){
        
        $data = $instagramObject->getTagMedia($search_name,$instagramPostPerPage);
        if($data->data){
            $posts = $data->data;
            $pagination = $data->pagination;
            $count++;
        }
    

}
}
?>
<div id="main">
                       <div class="common-head">
                <nav class="category overhide">
                    <section class="container">
                        <i class="icon-left"></i>
                        <i class="icon-right"></i>
                        <div class="scroll-bar">
                            <a href="<?php echo site_url('discover');?>">All</a>
                            <?php if($categories):
                            foreach ($categories as $category):
                            ?>
                            <a href="<?php echo site_url('discover/?pid='.$category->slug);?>" class="<?php echo ($category->slug==$get_category)? 'curr':'';?>"><?php echo $category->name;?></a>
                            <?php 
                            endforeach;
                            endif;
                            ?>
                        </div>
                    </section>
                </nav>
            </div>
            <div class="container grid posts overhide">
                <div class="row">
                    <?php if($posts){ 
                    foreach ($posts as $post) {                 
                    ?>
                    <article>
                        <div class="card">
                            <a href="<?php echo site_url('media/?pid='.$post->id);?>" class="media" target="_blank">
                            <?php echo ($post->type=='video')? '<i class="icon-play"></i>':'';?>
                                <div class="pic picUrl" style="background-image:url('<?php echo $post->images->thumbnail->url;?>');"></div>
                            </a>
                            <section class="caption">
                                <small><?php echo human_time_diff( $post->created_time, current_time('timestamp') ) . ' ago'; ?></small>
                                <p>
                        <?php if($post->tags):?>
                                
                                <?php foreach($post->tags as $tag):?>
                                 <a href="<?php echo site_url('tag/?pid='.$tag);?>" title="<?php echo $tag;?>">#<?php echo $tag;?></a>
                            <?php endforeach;?>
                        <?php endif;?></p>
                            </section>
                            <footer class="clearfix">
                                <span>
                                    <i class="icon-like"></i>
                                    <?php echo $post->likes->count;?>
                                </span>
                                <span>
                                    <i class="icon-comment"></i>
                                    <?php echo $post->comments->count;?>
                                </span>
                                <span>
                                    <a href="#" id="<?php echo site_url('media/?pid='.$post->id);?>" class="share">
                                        <i class="icon-share"></i>
                                        Share
                                    </a>
                                </span>
                            </footer>
                        </div>
                    </article>
                    <?php 
                }  
            } 
                    ?>
            <?php if ( is_active_sidebar( 'post-ads' ) ) : ?>
                <article class="ad"><div class="card"><div class="top">Advertisement</div>
                    <?php dynamic_sidebar( 'post-ads' ); ?>
                    <div class="bottom"></div></div></article>
            <?php endif; ?>

                    <div class="ajax-data"></div> 
                </div>
                <?php if($count==0):?>
                    <div class="grid-loading"><label class="btn">No data available.</label></div>
                <?php endif;?>
            

                <?php if(!empty($pagination->next_max_id)):?>
                <div class="grid-loading">
                    <div class="grid-load-btn button">
                        Load More                      
                    </div>
                    <div class="grid-load" data-web="posts" data-end="You’ve reached the end of the list." style="display: none;"><span><i class="icon-spinner"></i>Loading More...</span></div>                   
                </div>
                <?php endif;?>
                
            </div>
        </div>
        <!-- modal -->
<div class="modal hide" id="modal">
   <div class="modal-dialog" id="share">
      <div class="modal-header"><b class="title">Share</b><span class="close" id="close">×</span></div>
      <div class="modal-body">

    
      </div>
   </div>
</div>
<!-- end modal -->
<input type="hidden" id="tag" value="<?php echo $search_name;?>" />
<input type="hidden" id="object" value="get_tag_media" />
<?php if(!empty($pagination->next_max_id)):?>
<input type="hidden" id="more" value="<?php echo $pagination->next_max_id;?>" />
<?php endif;?>
        <?php 
get_footer();?>