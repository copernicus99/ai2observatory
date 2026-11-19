<?php /* Template Name: Profile */ 
get_header();
$array = array();
$count = 0;
$posts = array();
$pagination = array();
$private = false;
global $instagramObject;
global $instagramPostPerPage;
if(isset($_GET['pid'])){

    $search_name = $_GET['pid'];
  if(is_object($instagramObject)){
$data = $instagramObject->searchUser($search_name);
if($data->data){
    $array = $data->data;
    $user = $instagramObject->getUser($array[0]->id);
    $count++;
    if($array[0]->id){
    	$data = $instagramObject->getUserMedia($array[0]->id,$instagramPostPerPage);
    	if($data->data){
    		$posts = $data->data;
            $pagination = $data->pagination;
    	} 
        if($user->meta->code==400){
            $private = true;
        } else {
            $user = $user->data;
        }

    }

}
}  

}
$url = site_url('profile/?pid='.$search_name);

//dd($user); die;
?>
 
<div id="main">
<?php if($array){ ?>
  <div class="<?php echo ($private==true)? 'not':'user-profile';?>">
  <div class="container">
    <article class="row">
    <?php if($private!=true):?>
      <header><span class="button share" id="<?php echo $url;?>"><i class="icon-share"></i>Share</span></header>
     <?php endif;?> 
      <img class="picUrl" src="<?php echo $array[0]->profile_picture;?>" width="75" height="75">
      <h1><?php echo $array[0]->full_name;?></h1>
      <p rel=""><b>@<?php echo $array[0]->username;?></b><?php echo $array[0]->bio;?></p>
      <?php if($private==true):?>
        <p>No photos to show, or this account is private.</p>
      <a href="<?php echo site_url('/');?>" rel="nofollow" class="button">Check out our homepage ›</a>
  <?php endif;?>
    </article>
  </div>
  <?php if($user->counts>0){ ?>
  <nav><span class="curr" title="<?php echo $user->counts->media;?> Posts"><strong><?php echo $user->counts->media;?></strong><small>Posts</small></span><span class="c" title="<?php echo $user->counts->followed_by;?> Followers"><strong><?php echo $user->counts->followed_by;?></strong><small>Followers</small></span><span title="<?php echo $user->counts->follows;?> Following"><strong><?php echo $user->counts->follows;?></strong><small>Following</small></span></nav>
  <?php } ?>
</div>
<?php } ?>
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

      <a href="http://www.facebook.com/sharer.php?u=<?php echo $url;?>" target="_blank" class="facebook" ><i class="icon-facebook"></i>Facebook</a>

      <a href="https://twitter.com/intent/tweet?url=<?php echo $url;?>" target="_blank" class="twitter" ><i class="icon-twitter"></i>Twitter</a>

      <a href="http://pinterest.com/pin/create/button/?url=<?php echo $url;?>" target="_blank" class="pinterest" ><i class="icon-pinterest"></i>Pinterest</a>

      <a href="http://www.tumblr.com/share/photo?source=<?php echo $url;?>&amp;click_thru=<?php echo $url;?>" target="_blank" class="tumblr" ><i class="icon-tumblr"></i>Tumblr</a>

      <a href="https://plus.google.com/share?url=<?php echo $url;?>" target="_blank" class="googleplus" ><i class="icon-google-plus"></i>Goolge+</a>

      <a href="http://v.t.sina.com.cn/share/share.php?url=<?php echo $url;?>" target="_blank" class="weibo" ><i class="icon-weibo"></i>Weibo</a>

      <input type="url" class="copyurl" value="<?php echo $url;?>" onclick="this.select();">
      </div>
   </div>
</div>
<!-- end modal -->
<input type="hidden" id="tag" value="<?php echo $array[0]->id;?>" />
<input type="hidden" id="object" value="get_user_media" />
<?php if(!empty($pagination->next_max_id)):?>
<input type="hidden" id="more" value="<?php echo $pagination->next_max_id;?>" />
<?php endif;?>

        

<?php
get_footer(); 
?>