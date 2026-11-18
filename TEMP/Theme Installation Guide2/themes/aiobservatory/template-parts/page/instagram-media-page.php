<?php
get_header(); 
$array = array();
$count = 0;
$likes = array();
$comments = array();
global $instagramObject;
if(isset($_GET['pid'])){

    $search_name = $_GET['pid'];
  if(is_object($instagramObject)){
$data = $instagramObject->getMedia($_GET['pid']);
if($data->data){
    $array = $data->data;
    $count++;
    if($array){
        $data = $instagramObject->getMediaLikes($_GET['pid']);
        if($data->data){
            $likes = $data->data;
        }
        $data = $instagramObject->getMediaComments($_GET['pid']);
        if($data->data){
            $comments = $data->data;
        }
    }

}
}  

}
$url = site_url('media/?pid='.$search_name);
//dd($array);
//die;
?>
<div id="main">
            <div class="container media">
                <div class="row">                    
                    <!--img-->
                    <?php if($array):?>
                    <article class="left grid" data-url="">
                        <div class="card">
                            <section class="header">
                                <div>
                                    <a href="<?php echo site_url('profile/?pid='.$array->user->username);?>" title="">
                                        <img src="<?php echo $array->user->profile_picture;?>" width="40" height="40" rel="nofollow">
                                        <strong title=""><?php echo $array->user->full_name;?> &nbsp;@<?php echo $array->user->username;?></strong>
                                    </a>
                                    <small><?php echo human_time_diff( $array->created_time, current_time('timestamp') ) . ' ago'; ?> &nbsp;·&nbsp;<?php echo isset($array->location)? $array->location->name:'';?></small>
                                </div>
                            </section>
                            <div class="m-pic">
                            <?php if($array->type=='image'):?>
                                <img src="<?php echo $array->images->standard_resolution->url;?>" class="picUrl">
                            <?php endif;?>
                            <?php if($array->type=='video'):?>
                                <video width="100%" height="100%" poster="<?php echo $array->images->standard_resolution->url;?>?ig_cache_key=MTQ0NTA3NTYxMTgxODIxNTA2OA%3D%3D.2" class="picUrl" controls="" autoplay="" loop="" __idm_id__="988694529"><source src="<?php echo $array->videos->standard_resolution->url;?>" type="video/mp4">Your browser does not support the video tag.</video>
                                <img src="" class="picUrl">
                            <?php endif;?>
                            
                                <ul class="share-fix">
                                    <li class="share icon-more"></li>
                            
                                </ul>
                            </div>
                            <section class="caption">
                                <p class="m-p">
                                    <p><?php echo $array->caption->text;?></p>
                                    <?php if($array->tags):
                                    foreach ($array->tags as $tag):
                                    ?>
                                    <a href="<?php echo site_url('tag/?pid='.$tag);?>" title="wiw">#<?php echo $tag;?></a>
                                    <?php 
                                    endforeach;
                                    endif;
                                    ?>
                                
                                </p>
                            </section>
                            <footer class="clearfix">
                                <span>
                                    <i class="icon-like"></i>
                                    <?php echo isset($array->likes)? $array->likes->count:''; ?>
                                </span>
                                <span>
                                    <i class="icon-comment"></i>
                                    <?php echo isset($array->comments)? $array->comments->count:''; ?>
                                </span>
                                <span>
                                    <a href="javascript:;" id="<?php echo $url;?>" class="share" rel="nofollow" data-title="Share">
                                        <i class="icon-share"></i>
                                        Share
                                    </a>
                                </span>
                                <span>
                                <?php if($array->type=='video'):?>
                                    <a href="<?php echo $array->videos->standard_resolution->url;?>" target="_blank" rel="nofollow">
                                        <i class="icon-down"></i>
                                        Download
                                    </a>
                            
                            <?php endif;?>
                            <?php if($array->type=='image'):?>
                                    <a href="<?php echo $array->images->standard_resolution->url;?>" target="_blank" rel="nofollow">
                                        <i class="icon-down"></i>
                                        Download
                                    </a>
                            
                            <?php endif;?>
                                    
                                </span>
                            </footer>
                        </div>
                       
                    </article>
                <?php endif;?>
                    <!--featured-->
                    <article class="right">
                        <div class="card">
                            <h3 class="title">Ads</h3>
                            <ul class="list clearfix">
                            <?php dynamic_sidebar( 'sidebar-1' ); ?>
                               
                            </ul>
                        </div>
                        
                    </article>
                    <!--like-->
                    <article class="left like">
                        <div class="card">
                            <h3 class="title"><?php echo isset($array->likes)? $array->likes->count:'0'; ?> Likes</h3>
                            <section class="clearfix">
                            <?php if($likes):
                            foreach ($likes as $like):
                            ?>
                                <a href="#" title="">
                                    <img src="<?php echo $like->profile_picture;?>" width="30" height="30" rel="nofollow">
                                    <span><?php echo $like->username;?></span>
                                </a>
                             <?php endforeach;
                             endif;
                             ?>
                            </section>
                        </div>
                    </article>
                    <!--comment-->
                    <article class="left comment">
                        <div class="card">
                            <h3 class="title"><?php echo isset($array->comments)? $array->comments->count:'0'; ?> Comments</h3>
                            <section>
                                <ul>
                                <?php if($comments):
                            foreach ($comments as $comment):
                            ?>
                        <li>
                                <a href="#" title="">
                                    <img src="<?php echo $comment->from->profile_picture;?>" width="40" height="40" rel="nofollow">
                                    <strong><?php echo $comment->from->username;?></strong>
                                </a>
                                <small><?php echo human_time_diff( $comment->created_time, current_time('timestamp') ) . ' ago'; ?></small>
                                        <p><?php echo $comment->text;?></p>
                                        </li>
                             <?php endforeach;
                             endif;
                             ?>
                                    
                                </ul>
                            </section>
                            <div class="comment-more" data-name="Show Less">Show More</div>
                        </div>
                        
                    </article>
                    
                    
                </div>
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
<?php
get_footer(); 
?>