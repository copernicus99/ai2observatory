<?php /* Template Name: Profile */ 
get_header();
$search_name = str_replace("#", "", get_the_title());
$array = 0;
$count = 0;
$posts = array();
$pagination = array();

global $instagramObject;
global $instagramPostPerPage;

if(is_object($instagramObject)){
if(isset($search_name)){
        $data = $instagramObject->getTag($search_name);
        if($data->data->media_count>0){
            $array = $data->data->media_count;
        $data = $instagramObject->getTagMedia($search_name,$instagramPostPerPage);
        if($data->data){
            $posts = $data->data;
            $pagination = $data->pagination;
            $count++;
        }
    }

}
}
?>
 
<div id="main">
<div class="common-head bg">
   <div class="container">
      <div class="row">
         <h1>#<?php echo $search_name;?></h1>
         <p><?php echo number_format($array);?>&nbsp;Posts</p>
      </div>
   </div>
</div>
            <div class="container grid overhide">
            
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
                                    <a href="#" class="share">
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

        
<input type="hidden" id="tag" value="<?php echo $search_name;?>" />
<input type="hidden" id="object" value="get_tag_media" />
<?php if(!empty($pagination->next_max_id)):?>
<input type="hidden" id="more" value="<?php echo $pagination->next_max_id;?>" />
<?php endif;?>
<?php
get_footer(); 
?>